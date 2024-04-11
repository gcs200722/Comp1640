<?php

namespace App\Http\Controllers;

use App\Models\Contribution;

class ContributionController extends Controller
{
    public function approve($id)
    {
        $contribution = Contribution::find($id);
        $contribution->status = 'accepted';
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
}
