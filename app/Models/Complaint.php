<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;
    protected $table = 'complaints';
    public $timestamps = true;
    protected $fillable = ['title', 'dexription', 'status', 'user_id', 'instruction_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function instruction()
    {
        return $this->belongsTo(Instruction::class, 'instruction_id', 'id');
    }
}
