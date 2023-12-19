<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'comment',
        'contact_method',
        'image',
        'is_approved',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
