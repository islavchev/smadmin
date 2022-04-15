<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGroup extends Model
{
    use HasFactory;
    protected $table = 'student_group';
    protected $primaryKey = 'id';
    protected $fillable = ['student_id', 'group_id'];
}
