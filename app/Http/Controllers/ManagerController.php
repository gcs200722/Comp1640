<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\IOFactory;
use ZipArchive;

class ManagerController extends Controller
{
    public function home()
    {
        return view('manager.home');
    }

    public function dashboard(Request $request)
    {
        // Lấy giá trị tháng từ request
        $selectedMonth = $request->input('month');

        // Nếu không có tháng được chọn, sẽ lấy toàn bộ dữ liệu
        if (! $selectedMonth) {
            $filteredData = Contribution::all();
        } else {
            // Tạo đối tượng Carbon từ tháng đã chọn
            $selectedDate = Carbon::createFromFormat('Y-m', $selectedMonth);

            // Lọc dữ liệu theo tháng và năm đã chọn
            $filteredData = Contribution::whereYear('approval_date', $selectedDate->year)
                ->whereMonth('approval_date', $selectedDate->month)
                ->get();
        }

        // Truy vấn cơ sở dữ liệu để lấy số lượng bài nộp được chấp nhận theo từng khoa
        $contributionsByFaculty = Contribution::where('status', 'accepted')
            ->join('users', 'contributions.user_id', '=', 'users.id');

        // Áp dụng điều kiện lọc tháng và năm nếu có
        if ($selectedMonth) {
            $contributionsByFaculty->whereMonth('approval_date', $selectedDate->month);
        }

        // Hoàn thành truy vấn và lấy dữ liệu
        $contributionsByFaculty = $contributionsByFaculty->select('users.faculty', DB::raw('count(*) as count'))
            ->groupBy('users.faculty')
            ->get();

        // Chuẩn bị dữ liệu cho biểu đồ
        $facultyNames = $contributionsByFaculty->pluck('faculty');
        $contributionCounts = $contributionsByFaculty->pluck('count');
        $totalCount = $contributionsByFaculty->sum('count');

        // Tính toán phần trăm cho mỗi khoa
        $percentageByFaculty = $contributionsByFaculty->map(function ($faculty) use ($totalCount) {
            return [
                'faculty' => $faculty['faculty'],
                'percentage' => ($faculty['count'] / $totalCount) * 100,
            ];
        });

        // Trả về view với dữ liệu cho biểu đồ
        return view('manager.dashboard', compact('filteredData', 'facultyNames', 'contributionCounts', 'percentageByFaculty'));
    }

    public function showcontribution()
    {
        $contributions = Contribution::where('status', 'accepted')
            ->get();
        // Chuyển đổi trực tiếp từ tệp Word sang HTML và lưu vào mảng
        $htmlContents = [];
        foreach ($contributions as $contribution) {
            $wordFilePath = storage_path('app/public/'.$contribution->word_file_path);
            $phpWord = IOFactory::load($wordFilePath);
            $htmlWriter = new \PhpOffice\PhpWord\Writer\HTML($phpWord);
            $htmlContents[$contribution->id] = $htmlWriter->getContent();
        }

        return view('manager.contribution', [
            'contributions' => $contributions,
            'htmlContents' => $htmlContents,
        ]);
    }

    public function downloadContributions()
    {
        try {
            // Lấy danh sách các đóng góp đã được chấp nhận từ cơ sở dữ liệu
            $contributions = Contribution::where('status', 'accepted')->get();
            $zipFileName = 'contributions.zip';
            $zipFilePath = storage_path('app/'.$zipFileName);
            // Tạo đối tượng ZipArchive
            $zip = new ZipArchive;
            if ($zip->open($zipFilePath, ZipArchive::CREATE) !== true) {
                throw new \Exception('Không thể tạo tệp ZIP.');
            }

            // Duyệt qua từng đóng góp để xử lý
            foreach ($contributions as $contribution) {
                // Lấy tiêu đề, nội dung, đường dẫn tới tệp Word và tệp hình ảnh từ cơ sở dữ liệu
                $imagePath = storage_path('app/public/'.$contribution->image_path);
                $title = $contribution->title;
                $content = $contribution->content;

                $wordFilePath = storage_path('app/public/'.$contribution->word_file_path);

                // Kiểm tra xem tệp Word và tệp hình ảnh có tồn tại không
                if (! file_exists($wordFilePath) || ! file_exists($imagePath)) {
                    continue; // Bỏ qua đóng góp nếu không có tệp Word hoặc hình ảnh
                }

                // Load tệp Word
                $phpWord = IOFactory::load($wordFilePath);

                // Tạo một đối tượng HTML writer
                $htmlWriter = new \PhpOffice\PhpWord\Writer\HTML($phpWord);

                // Lấy nội dung HTML từ đối tượng Writer
                $htmlContent = $htmlWriter->getContent();
                $htmlContent .= '<img src="'.$imagePath.'" alt="Hình ảnh đóng góp">';
                // Thêm tiêu đề và nội dung vào nội dung HTML
                $htmlContent = '<h1>'.$title.'</h1><p>'.$content.'</p>'.$htmlContent;

                // Lưu nội dung HTML vào tệp HTML tạm thời
                $htmlFilePath = storage_path('app/temporary_html/contribution_'.$contribution->id.'.html');
                file_put_contents($htmlFilePath, $htmlContent);

                // Thêm tệp HTML vào tệp ZIP
                $zip->addFile($htmlFilePath, 'contribution_'.$contribution->id.'.html');
            }

            // Đóng tệp ZIP
            $zip->close();

            // Trả về tệp ZIP cho người dùng để tải xuống
            return response()->download($zipFilePath)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra: '.$e->getMessage());
        }
    }
}
