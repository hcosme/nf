<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fechamento_teste_final extends Model
{
    use HasFactory;

    protected $table = 'fechamento_teste_final';

    protected $fillable = [
    'fechamento',
    ];
}
