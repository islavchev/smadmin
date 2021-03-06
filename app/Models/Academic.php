<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academic extends Model
{
    use HasFactory;
    protected $table = 'academics';
    protected $primaryKey = 'id';
    protected $fillable = ['first_name', 'middle_name', 'last_name','acad_position','acad_title','room_no','abbreviation', 'image'];

    public function seminars(){
        return $this->hasMany(Seminar::class);
    }


    public function contacts() {
        return $this->morphMany(ContactInfo::class, 'contactable');
    }
    
}
