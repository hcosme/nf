<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class file extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'url',
        'requirement_id',
    ];

    public function requirement()
    {
        return $this->belongsTo(Requirement::class);
    }
}
