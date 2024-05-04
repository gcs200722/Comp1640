<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\IOFactory;

class CoodinatorController extends Controller
{
    public function home()
    {
        $user = auth()->user();

        return view('coodinator.home', compact('user'));
    }

    public function show(Contribution $contribution)
    {
        $wordFilePath = storage_path('app/public/'.$contribution->word_file_path);
        $phpWord = IOFactory::load($wordFilePath);
        $htmlWriter = new \PhpOffice\PhpWord\Writer\HTML($phpWord);
        $htmlContents = $htmlWriter->getContent();

        return view('coodinator.show', compact('contribution', 'htmlContents'));
    }

    public function dashboard(Request $request)
    {
        // Lấy người dùng hiện tại và khoa của họ
        $user = Auth::user();
        $faculty = $user->faculty;

        // Lấy giá trị tháng từ request
        $selectedMonth = $request->input('month');
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

        // Truy vấn cơ sở dữ liệu để lấy số lượng bài nộp theo 'status' của người dùng trong khoa của họ
        $query = Contribution::whereHas('user', function ($query) use ($faculty) {
            $query->where('faculty', $faculty);
        });

        // Áp dụng điều kiện lọc theo tháng nếu có
        if ($selectedMonth) {
            $query->whereMonth('approval_date', $selectedDate->month);
        }

        $contributionsByStatus = $query->select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();

        // Chuẩn bị dữ liệu cho biểu đồ
        $statusLabels = $contributionsByStatus->pluck('status')->unique();

        $data = [];
        foreach ($statusLabels as $status) {
            $data[$status] = $contributionsByStatus->where('status', $status)->pluck('count')->toArray();
        }

        return view('coodinator.dashboard', compact('statusLabels', 'data'));
    }

    public function showcontribution()
    {
        $user = auth()->user();
        $userFaculty = $user->faculty;
        $contributions = Contribution::where('status', 'pending')->whereHas('user', function ($query) use ($userFaculty) {
            $query->where('faculty', $userFaculty);
        })->get();
        // Chuyển đổi trực tiếp từ tệp Word sang HTML và lưu vào mảng
        $htmlContents = [];
        foreach ($contributions as $contribution) {
            $wordFilePath = storage_path('app/public/'.$contribution->word_file_path);

            // Kiểm tra xem đường dẫn tới tệp Word có tồn tại không
            if (! empty($contribution->word_file_path) && file_exists($wordFilePath)) {
                $phpWord = IOFactory::load($wordFilePath);
                $htmlWriter = new \PhpOffice\PhpWord\Writer\HTML($phpWord);
                $htmlContents[$contribution->id] = $htmlWriter->getContent();
            } else {
                $comment = 'No comment available'; // Bỏ qua việc xử lý nếu không có đường dẫn tới tệp Word

                continue;
            }
        }

        foreach ($contributions as $contribution) {
            $comment = $contribution->load('comments');
        }

        return view('coodinator.contribution', [
            'contributions' => $contributions,
            'htmlContents' => $htmlContents,
        ]);
    }

    public function approvecontribution()
    {
        $user = auth()->user();
        $userFaculty = $user->faculty;
        $contributions = Contribution::where('status', 'accepted')->whereHas('user', function ($query) use ($userFaculty) {
            $query->where('faculty', $userFaculty);
        })->get();
        // Chuyển đổi trực tiếp từ tệp Word sang HTML và lưu vào mảng
        $htmlContents = [];
        foreach ($contributions as $contribution) {
            $wordFilePath = storage_path('app/public/'.$contribution->word_file_path);

            // Kiểm tra xem đường dẫn tới tệp Word có tồn tại không
            if (! empty($contribution->word_file_path) && file_exists($wordFilePath)) {
                $phpWord = IOFactory::load($wordFilePath);
                $htmlWriter = new \PhpOffice\PhpWord\Writer\HTML($phpWord);
                $htmlContents[$contribution->id] = $htmlWriter->getContent();
            } else {
                $comment = 'No comment available'; // Bỏ qua việc xử lý nếu không có đường dẫn tới tệp Word

                continue;
            }
        }

        return view('coodinator.approve', [
            'contributions' => $contributions,
            'htmlContents' => $htmlContents,
        ]);
    }

    public function rejectedcontribution()
    {
        $user = auth()->user();
        $userFaculty = $user->faculty;
        $contributions = Contribution::where('status', 'rejected')->whereHas('user', function ($query) use ($userFaculty) {
            $query->where('faculty', $userFaculty);
        })->get();
        // Chuyển đổi trực tiếp từ tệp Word sang HTML và lưu vào mảng
        $htmlContents = [];
        foreach ($contributions as $contribution) {
            $wordFilePath = storage_path('app/public/'.$contribution->word_file_path);

            // Kiểm tra xem đường dẫn tới tệp Word có tồn tại không
            if (! empty($contribution->word_file_path) && file_exists($wordFilePath)) {
                $phpWord = IOFactory::load($wordFilePath);
                $htmlWriter = new \PhpOffice\PhpWord\Writer\HTML($phpWord);
                $htmlContents[$contribution->id] = $htmlWriter->getContent();
            } else {
                $comment = 'No comment available'; // Bỏ qua việc xử lý nếu không có đường dẫn tới tệp Word

                continue;
            }
        }

        return view('coodinator.rejected', [
            'contributions' => $contributions,
            'htmlContents' => $htmlContents,
        ]);
    }
}
