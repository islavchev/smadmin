<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seminar extends Model
{
    use HasFactory;
    protected $table = 'seminars';
    protected $primaryKey = 'id';
    protected $fillable = ['seminar_period', 'seminar_type', 'seminar_code', 'seminar_date','seminar_name','room_id', 'academic_id', 'student_group_id'];

    public function room(){
        return $this->belongsTo(Room::class);
    }

    public function student_group(){
        return $this->belongsTo(StudentGroup::class);
    }

    public function academic(){
        return $this->belongsTo(Academic::class);
    }

    public function subject(){
        return $this->belongsTo(Subject::class);
    }
}
