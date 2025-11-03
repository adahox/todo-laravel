<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    protected $guarded = ['user_id'];
    
    protected $fillable = [
        'item',
        'user_id'
    ];
    
}
