<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use PhpOffice\PhpWord\IOFactory;

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
}
