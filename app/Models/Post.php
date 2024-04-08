<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public $timestamps = false;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
    protected $fillable = [
        'id',
        'title',
        'description',
    ];

}
