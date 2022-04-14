<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatalogueTranslate extends Model
{
    public $table = "catalogue_translate";

    public $fillable = ['id','name',
        'summary',
        'language_id',
        'catalogue_id',
        'created_at','updated_at'];

    public $dates = ['created_at','updated_at'];
    public $primaryKey = 'id';

    public function Language(){
        return $this->belongsTo(Language::class,"language_id","id");
    }

    public function Catalogue(){
        return $this->belongsTo(Catalogue::class,"catalogue_id","id");
    }

}
