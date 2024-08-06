<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'order_id',
        'status'
    ];

    public function file()
    {
        return $this->hasOne(file::class);
    }

    public function closure()
    {
        return $this->hasOne(Closure::class);
    }
}
