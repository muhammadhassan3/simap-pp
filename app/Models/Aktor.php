<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aktor extends Authenticatable
{
    use HasFactory;
    protected $fillable = ['username', 'password', 'email', 'role'];
    protected $table = 'aktor';
    public $timestamps = false;
}
