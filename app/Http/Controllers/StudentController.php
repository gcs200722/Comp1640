<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use App\Models\SubmissionDate;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;

class StudentController extends Controller
{
    public function home()
    {
        $user = auth()->user();

        return view('student.home', compact('user'));
    }

    public function show()
    {
        $user = auth()->user();
        $contributions = contribution::where('user_id', $user->id)->get();
        $htmlContents = [];
        foreach ($contributions as $contribution) {
            $wordFilePath = storage_path('app/public/'.$contribution->word_file_path);
            $phpWord = IOFactory::load($wordFilePath);
            $htmlWriter = new \PhpOffice\PhpWord\Writer\HTML($phpWord);
            $htmlContents[$contribution->id] = $htmlWriter->getContent();
        }

        return view('student.show', compact('user', 'contributions', 'htmlContents'));
    }

    public function close()
    {
        $submissionDate = SubmissionDate::orderBy('id', 'desc')->first();

        return view('student.close', compact('submissionDate'));
    }

    public function formsubmit()
    {
        $submissionDate = SubmissionDate::orderBy('id', 'desc')->first();

        return view('student.submit', compact('submissionDate'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048', // 2MB max
            'word_file' => 'nullable|mimes:doc,docx|max:2048', // Word file
        ]);

        // Upload image file
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/images', 'public');
        } else {
            $imagePath = null;
        }

        // Upload word file
        if ($request->hasFile('word_file')) {
            $wordFilePath = $request->file('word_file')->store('uploads/word_files', 'public');
        } else {
            $wordFilePath = null;
        }

        // Create contribution
        Contribution::create([
            'user_id' => auth()->id(), // Assuming you have authentication
            'title' => $request->title,
            'content' => $request->content,
            'image_path' => $imagePath,
            'word_file_path' => $wordFilePath,
            'submission_date' => now(),
            'status' => 'pending',
        ]);

        return redirect()->route('student.submit')->with('success', 'Contribution submitted successfully!');
    }
}
