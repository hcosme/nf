<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Closure extends Model
{
    use HasFactory;

    protected $fillable = [
        'requirement_id',
        'reason'
    ];

    public function requirement()
    {
        return $this->belongsTo(Requirement::class);
    }
}
