<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use PhpOffice\PhpWord\IOFactory;

class CoodinatorController extends Controller
{
    public function home()
    {
        $user = auth()->user();

        return view('coodinator.home', compact('user'));
    }

    public function showcontribution()
    {
        $user = auth()->user();
        $userFaculty = $user->faculty;
        $contributions = Contribution::where('status', 'pending')->whereHas('user', function ($query) use ($userFaculty) {
            $query->where('faculty', $userFaculty);
        })->paginate(2);
        // Chuyển đổi trực tiếp từ tệp Word sang HTML và lưu vào mảng
        $htmlContents = [];
        foreach ($contributions as $contribution) {
            $wordFilePath = storage_path('app/public/'.$contribution->word_file_path);
            $phpWord = IOFactory::load($wordFilePath);
            $htmlWriter = new \PhpOffice\PhpWord\Writer\HTML($phpWord);
            $htmlContents[$contribution->id] = $htmlWriter->getContent();
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
            $phpWord = IOFactory::load($wordFilePath);
            $htmlWriter = new \PhpOffice\PhpWord\Writer\HTML($phpWord);
            $htmlContents[$contribution->id] = $htmlWriter->getContent();
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
            $phpWord = IOFactory::load($wordFilePath);
            $htmlWriter = new \PhpOffice\PhpWord\Writer\HTML($phpWord);
            $htmlContents[$contribution->id] = $htmlWriter->getContent();
        }

        return view('coodinator.rejected', [
            'contributions' => $contributions,
            'htmlContents' => $htmlContents,
        ]);
    }
}
