<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aktor extends Model
{
    use HasFactory;
    protected $fillable = ['username', 'password', 'email', 'role'];
    protected $table = 'aktor';
    public $timestamps = false;
}
