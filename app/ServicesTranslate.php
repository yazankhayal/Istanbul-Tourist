<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicesTranslate extends Model
{
    public $table = "services_translate";

    public $fillable = ['id','name','summary',
        'services_id',
        'language_id',
        'created_at','updated_at'];

    public $dates = ['created_at','updated_at'];
    public $primaryKey = 'id';

    public function Language(){
        return $this->belongsTo(Language::class,"language_id","id");
    }

    public function Services(){
        return $this->belongsTo(Services::class,"services_id","id");
    }

}
