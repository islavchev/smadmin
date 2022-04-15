<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    use HasFactory;
    protected $table = 'contact_infos';
    protected $primaryKey = 'id';
    protected $fillable = ['type', 'contact_info'];
    // ,'contactable_id','contactable_type' ?

    public function contactable(){

        return $this->morphTo();

    }
}
