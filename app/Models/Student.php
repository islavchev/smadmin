<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $primaryKey = 'id';
    protected $fillable = ['first_name', 'middle_name', 'last_name','image','date_of_birth'];


    public function contacts() {
        return $this->morphMany(ContactInfo::class, 'contactable');
    }
    
    public function groups(){
        return $this->belongsToMany(Group::class, 'student_group');
    }
}
