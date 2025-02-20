<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instruction extends Model
{
    use HasFactory;


    protected $fillable = ['title', 'description', 'file', 'is_moderation', 'users_id'];

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
