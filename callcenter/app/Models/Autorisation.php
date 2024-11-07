<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autorisation extends Model
{
    use HasFactory;
    protected $fillable =['agent_id','start_date','end_date','hours','etat','comment'];

    public function agent()
{
    return $this->belongsTo(User::class, 'agent_id');
}

}
