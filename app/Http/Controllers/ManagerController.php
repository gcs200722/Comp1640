<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use PhpOffice\PhpWord\IOFactory;
use ZipArchive;

class ManagerController extends Controller
{
    public function home()
    {
        return view('manager.home');
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
