<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cookie;

class Services extends Model
{
    public $table = "services";

    public $fillable = ['id','name',
        'avatar','summary',
        'language_id',
        'category_id',
        'created_at','updated_at'];

    public $dates = ['created_at','updated_at'];
    public $primaryKey = 'id';

    public function Language(){
        return $this->belongsTo(Language::class,"language_id","id");
    }

    public function Services(){
        return $this->hasMany(ServicesTranslate::class,"services_id","id");
    }

    public function Category(){
        return $this->belongsTo(Category::class,"category_id","id");
    }

    public function City(){
        return $this->belongsTo(City::class,"city_id","id");
    }

    public function Catalogue(){
        return $this->belongsTo(Catalogue::class,"catalogue_id","id");
    }

    public function Translate($o2){
        return $this->hasOne(ServicesTranslate::class,"services_id","id")
            ->where('language_id','=',$o2)->first();
    }

    public function Translatex(){
        return $this->hasOne(ServicesTranslate::class,"services_id","id");
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

    public function route(){
        return route('service',['id'=>$this->id,'name'=>$this->name]);
    }

    public function name(){
        if(app()->getLocale() == $this->select_lang()->dir){
            return $this->name;
        }
        else{
            return $this->Translate($this->select_lan()->id) != null ? $this->Translate($this->select_lan()->id)->name : "";
        }
    }

    public function sub_name(){
        if(app()->getLocale() == $this->select_lang()->dir){
            return $this->sub_name;
        }
        else{
            return $this->Translate($this->select_lan()->id) != null ? $this->Translate($this->select_lan()->id)->sub_name : "";
        }
    }

    public function summary(){
        if(app()->getLocale() == $this->select_lang()->dir){
            return $this->summary;
        }
        else{
            return $this->Translate($this->select_lan()->id) != null ? $this->Translate($this->select_lan()->id)->summary : "";
        }
    }

    public function images(){
        $items = $this->images;
        $array = explode(",",$items);
        if(count($array) != 0){
            foreach($array as $key => $value){
                if($value){
                    return url('/').env('PATH_IMAGE').'upload/gallery_services/'.$value;
                }
            }
        }
        else{
            return url('/').env('PATH_IMAGE').'no.png';
        }
    }

    public function img(){
        return url('/').env('PATH_IMAGE').$this->avatar;
    }

    public function price()
    {
        $select_curr = Currencies::where('select', '=', 1)->first();
        if (Cookie::get('currency') != null) {
            $curenc_cooki = Currencies::where('code', '=', Cookie::get('currency'))->first();
        } else {
            $curenc_cooki = Currencies::where('select', '=', 1)->first();
        }
        if ($curenc_cooki->code == $select_curr->code) {
            $price = $this->price . $select_curr->code;
        } else {
            $price = round($this->price * $curenc_cooki->CurrencyConversions->price, 2) . $curenc_cooki->code;
        }
        return "<a href=\"javascript:void(0)\" class=\"fp_price\">$price</a>";
    }

    public function type()
    {
        $ret = "";
        if($this->type != null){
            $ret = "<li class=\"list-inline-item\"><a href=\"javascript:void(0)\">$this->type</a></li>";
        }
        return $ret;
    }

    public function date($x){
        if($x){
            return date_format($this->created_at,$x);
        }
        else{
            return date_format($this->created_at,'d-M-Y');
        }
    }

    public function type2()
    {
        $ret = "";
        if($this->type != null){
            $ret = $this->type;
        }
        return $ret;
    }

    public function featured($x)
    {
        $ret = "";
        if($this->featured == 1){
            $ret = "<li class=\"list-inline-item\"><a href=\"javascript:void(0)\">$x</a></li>";
        }
        return $ret;
    }

}
