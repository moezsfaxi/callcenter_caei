<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avance extends Model
{
    use HasFactory;
    
    protected $fillable =['comment', 'amount','agent_id'];
    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }



}
