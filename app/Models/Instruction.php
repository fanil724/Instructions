<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instruction extends Model
{
    use HasFactory;


    protected $fillable = ['title', 'description', 'file', 'is_moderation', 'user_id'];

    public function complaints()
    {
        return $this->hasMany(Complaint::class, 'id', 'instruction_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
