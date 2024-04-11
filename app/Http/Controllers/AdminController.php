<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\IOFactory;

class AdminController extends Controller
{
    public function home()
    {
        $user = Auth::user();

        return view('admin.home', compact('user'));
    }

    public function showcontribution()
    {
        $contributions = Contribution::all();
        $user = auth()->user(); // Lấy thông tin người dùng hiện tại
        // Chuyển đổi trực tiếp từ tệp Word sang HTML và lưu vào mảng
        $htmlContents = [];
        foreach ($contributions as $contribution) {
            $wordFilePath = storage_path('app/public/' . $contribution->word_file_path);
            $phpWord = IOFactory::load($wordFilePath);
            $htmlWriter = new \PhpOffice\PhpWord\Writer\HTML($phpWord);
            if (is_array($htmlContents)) {
                // Tạo một mảng mới để lưu các phần tử đã được xem trước
                $htmlContents[$contribution->id] = $htmlWriter->getContent();
            }
        }

        return view('admin.contribution.show', ['contributions' => $contributions, 'user' => $user, 'htmlContents' => $htmlContents]);
    }
}
