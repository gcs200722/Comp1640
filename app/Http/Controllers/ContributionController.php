<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Contribution;
use App\Models\SubmissionDate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContributionController extends Controller
{
    public function approve($id)
    {
        $contribution = Contribution::find($id);
        $contribution->status = 'accepted';
        $contribution->approval_date = now();
        $contribution->save();

        return redirect()->back()->with('success', '^^!');

    }

    public function reject($id)
    {
        $contribution = Contribution::find($id);
        $contribution->status = 'rejected';
        $contribution->save();

        return redirect()->back()->with('success', '((:');
        // Redirect hoặc trả về thông báo thành công
    }

    public function destroy(Contribution $contribution)
    {
        $contribution->delete();

        return redirect()->back()->with('success', 'Delete successfully!');
    }

    public function edit(Contribution $contribution)
    {
        $submissionDate = SubmissionDate::orderBy('id', 'desc')->first();

        return view('student.edit', compact('contribution', 'submissionDate'));
    }

    public function update(Request $request, Contribution $contribution)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048', // 2MB max
            'word_file' => 'nullable|mimes:doc,docx|max:2048', // Word file
        ]);

        if ($request->hasFile('image')) {
            // Lưu trữ tệp ảnh mới vào thư mục lưu trữ
            $imagePath = $request->file('image')->store('public/images');

            // Cập nhật đường dẫn ảnh mới trong cơ sở dữ liệu
            $contribution->image_path = str_replace('public/', '', $imagePath);
        }

        // Cập nhật các trường dữ liệu cần thiết
        $contribution->title = $request->title;
        $contribution->content = $request->content;

        // Lưu các thay đổi vào cơ sở dữ liệu
        $contribution->save();

        return redirect()->route('student.show')->with('success', 'Contribution updated successfully!');
    }

    public function store_contribution(Request $request, $contribution_id)
    {
        $request->validate([
            'content' => 'required|string',
        ]);
        $comment = new Comment();
        $comment->contribution_id = $contribution_id;
        $comment->user_id = Auth::id();
        $comment->content = $request->input('content');
        $comment->save();

        return redirect()->Route('contribution')->with('success', 'Comment added successfully.');
    }

    public function destroy_comment(Comment $comment)
    {
        // Kiểm tra quyền hạn của người dùng, ví dụ: chỉ cho phép chủ bình luận xóa
        if ($comment->user_id === auth()->id()) {
            $comment->delete();

            return redirect()->back()->with('success', 'Comment deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'You do not have permission to delete this comment.');
        }
    }
}
