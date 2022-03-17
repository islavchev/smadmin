<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $table = 'subjects';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'lecture_hours', 'seminar_hours', 'ects', 'note', 'code'];

    public function seminars(){
        return $this->hasMany(Seminar::class);
    }

}
