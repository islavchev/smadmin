<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seminar extends Model
{
    use HasFactory;
    protected $table = 'seminars';
    protected $primaryKey = 'id';
    protected $fillable = ['period', 'date','subject_id','room_id', 'academic_id', 'group_id'];

    public function room(){
        return $this->belongsTo(Room::class);
    }

    public function group(){
        return $this->belongsTo(Group::class);
    }

    public function academic(){
        return $this->belongsTo(Academic::class);
    }

    public function subject(){
        return $this->belongsTo(Subject::class);
    }
}
