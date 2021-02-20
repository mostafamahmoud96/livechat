<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable=['body','user_id','conversation_id','read'];
    use HasFactory;
    public function conversation()
{
    return $this->belongsTo(Conversation::class);
}

}
