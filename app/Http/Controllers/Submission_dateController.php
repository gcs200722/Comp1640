<?php

namespace App\Http\Controllers;

use App\Models\SubmissionDate;
use Illuminate\Http\Request;

class Submission_dateController extends Controller
{
    public function index()
    {
        $submissionDate = SubmissionDate::all();

        return view('admin.submission_date.index')->with('submissionDate', $submissionDate);
    }

    public function create()
    {
        return view('admin.submission_date.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'closed_at' => 'required|date',
            'reopen_at' => 'required|date',
        ]);

        SubmissionDate::create([
            'closed_at' => $request->closed_at,
            'reopen_at' => $request->reopen_at,
        ]);

        return redirect()->route('submission_date.index')->with('success', 'Submission dates have been saved.');
    }

    public function edit(SubmissionDate $submissionDate)
    {
        return view('admin.submission_date.edit', compact('submissionDate'));
    }

    public function update(Request $request, SubmissionDate $submissionDate)
    {
        $request->validate([
            'closed_at' => 'required|date',
            'reopen_at' => 'required|date',
        ]);

        $submissionDate->update([
            'closed_at' => $request->closed_at,
            'reopen_at' => $request->reopen_at,
        ]);

        return redirect()->route('submission_date.index')->with('success', 'Submission dates have been updated.');
    }

    public function destroy(SubmissionDate $submissionDate)
    {
        $submissionDate->delete();

        return redirect()->route('submission_date.index')->with('success', 'Submission dates have been deleted.');
    }
}
