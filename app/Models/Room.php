<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $table = 'rooms';
    protected $primaryKey = 'id';
    protected $fillable = ['room_name', 'capacity', 'internet','multimedia','notes'];

    public function seminars(){
        return $this->hasMany(Seminar::class);
    }
}
