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
            ->paginate(2);
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
        // Lấy danh sách các đóng góp và nội dung HTML tương ứng từ phương thức showcontribution
        $contributions = Contribution::where('status', 'accepted')->paginate(2);
        $htmlContents = [];
        $imageFiles = [];
        foreach ($contributions as $contribution) {
            $wordFilePath = storage_path('app/public/'.$contribution->word_file_path);
            $phpWord = IOFactory::load($wordFilePath);

            // Lặp qua các phần của tài liệu và trích xuất hình ảnh
            foreach ($phpWord->getSections() as $section) {
                foreach ($section->getElements() as $element) {
                    if ($element instanceof \PhpOffice\PhpWord\Element\Image) {
                        $imageContent = $element->getPath();
                        $imageFileName = 'image_'.uniqid().'.'.pathinfo($imageContent, PATHINFO_EXTENSION);
                        $imageFiles[$imageFileName] = file_get_contents($imageContent);
                        // Thay đổi đường dẫn của hình ảnh trong tài liệu thành tên tệp hình ảnh tạm thời
                        $element->setPath($imageFileName);
                    }
                }
            }

            // Lưu nội dung HTML tạm thời
            $htmlWriter = new \PhpOffice\PhpWord\Writer\HTML($phpWord);
            $htmlContent = $htmlWriter->getContent(); // Lấy nội dung HTML từ đối tượng Writer

            // Lưu nội dung HTML vào một biến chuỗi
            $htmlFilePath = storage_path('app/tempo/temporary_html.html');
            file_put_contents($htmlFilePath, $htmlContent);

            // Thêm hình ảnh vào nội dung HTML
            $htmlContents[$contribution->id] = $htmlContent;
        }

        // Tạo một tệp tin ZIP mới
        $zip = new ZipArchive;
        $zipFileName = 'contributions.zip';

        if ($zip->open(storage_path('app/'.$zipFileName), ZipArchive::CREATE) === true) {
            // Thêm các tệp HTML vào tệp tin ZIP
            foreach ($htmlContents as $contributionId => $htmlContent) {
                $htmlFileName = 'contribution_'.$contributionId.'.html';
                $zip->addFromString($htmlFileName, $htmlContent);
            }

            // Thêm các tệp hình ảnh vào tệp tin ZIP
            foreach ($imageFiles as $imageFileName => $imageFileContent) {
                $zip->addFromString($imageFileName, $imageFileContent);
            }

            // Đóng tệp tin ZIP
            $zip->close();

            // Trả về tệp tin ZIP cho người dùng
            return response()->download(storage_path('app/'.$zipFileName))->deleteFileAfterSend(true);
        } else {
            // Xử lý lỗi nếu không thể tạo tệp tin ZIP
            return back()->with('error', 'Không thể tạo tệp ZIP.');
        }
    }
}
