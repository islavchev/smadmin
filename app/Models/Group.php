<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $table = 'groups';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];

    public function seminars(){
        return $this->hasMany(Seminar::class);
    }

    public function students(){
        return $this->belongsToMany(Student::class, 'student_group');
    }
}
