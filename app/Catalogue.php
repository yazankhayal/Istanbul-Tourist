<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalogue extends Model
{
    public $table = "catalogue";

    public $fillable = ['id','name',
        'type',
        'summary',
        'avatar',
        'language_id',
        'user_id',
        'created_at','updated_at'];

    public $dates = ['created_at','updated_at'];
    public $primaryKey = 'id';

    public function Language(){
        return $this->belongsTo(Language::class,"language_id","id");
    }

    public function User(){
        return $this->belongsTo(User::class,"user_id","id");
    }

    public function Catalogue(){
        return $this->hasMany(CatalogueTranslate::class,"catalogue_id","id");
    }

    public function Services(){
        return $this->hasMany(Services::class,"catalogue_id","id");
    }

    public function Translate($i){
        return $this->hasOne(CatalogueTranslate::class,"catalogue_id","id")
            ->where('language_id','=',$i)->first();
    }
    public function select_lang(){
        return  $select_lan_choice = Language::where('select', '=', '1')->first();
    }

    public function select_lan(){
        $select_lan = Language::where('dir', '=', app()->getLocale())->first();
        if ($select_lan == null) {
            $select_lan = Language::where('select', '=', '1')->first();
        }
        return $select_lan;
    }

    public function name(){
        if(app()->getLocale() == $this->select_lang()->dir){
            return $this->name;
        }
        else{
            return $this->Translate($this->select_lan()->id) != null ? $this->Translate($this->select_lan()->id)->name : "";
        }
    }

    public function img(){
        return url('/').env('PATH_IMAGE').$this->avatar;
    }

    public function route_services(){
        return route('services',['catalogue_id'=>$this->id]);
    }
}
