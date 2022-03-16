<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGroup extends Model
{
    use HasFactory;
    protected $table = 'student_groups';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];

    public function seminars(){
        return $this->hasMany(Seminar::class);
    }
}
