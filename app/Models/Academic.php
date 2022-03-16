<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academic extends Model
{
    use HasFactory;
    protected $table = 'academics';
    protected $primaryKey = 'id';
    protected $fillable = ['first_name', 'last_name', 'email','phone','acad_position','acad_title','room_no', 'abbreviation'];

    public function seminars(){
        return $this->hasMany(Seminar::class);
    }
}
