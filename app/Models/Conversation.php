<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable=['user_id','second_useer_id'];
    use HasFactory;
    public function messages(){
        return $this->hasMany(Message::class);
    }
    public function users(){
        return $this->hasMany(User::class)
    ;    }
}
