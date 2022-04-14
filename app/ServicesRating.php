<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicesRating extends Model
{
    public $table = "services_rating";

    public $fillable = ['id','name','summary',
        'services_id',
        'language_id',
        'created_at','updated_at'];

    public $dates = ['created_at','updated_at'];
    public $primaryKey = 'id';

    public function User(){
        return $this->belongsTo(User::class,"user_id","id");
    }

    public function Services(){
        return $this->belongsTo(Services::class,"services_id","id");
    }

}
