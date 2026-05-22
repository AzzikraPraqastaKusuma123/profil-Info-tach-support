<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_key',
        'user_name',
        'is_active',
    ];

    public function messages()
    {
        return $this->hasMany(ChatMessage::class);
    }
}
