<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionDate extends Model
{
    use HasFactory;

    protected $fillable = [
        'closed_at', 'reopen_at',
    ];
}
