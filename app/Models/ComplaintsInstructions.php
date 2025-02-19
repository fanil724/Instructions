<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintsInstructions extends Model
{
    use HasFactory;

    protected $table = 'complaints__instructions';

    protected $fillable = ['title', 'dexription', 'status', 'users_id', 'instructions_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function instruction()
    {
        return $this->belongsTo(Instructions::class);
    }
}
