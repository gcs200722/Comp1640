<?php

namespace App\Http\Middleware;

use App\Models\SubmissionDate;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSubmissionDeadline
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $submissionDate = SubmissionDate::orderBy('id', 'desc')->first();

        if (Carbon::now() > $submissionDate->closed_at) {
            return redirect()->route('submission_closed');
        }

        return $next($request);
    }
}
