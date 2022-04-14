<?php

namespace App\Http\Controllers\Dashboard;

use App\Contents;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class AboutPageController extends Controller
{
    public function index(){
        return view('dashboard/about_page_2.index');
    }

    public function get_data_by_id(Request $request){
        $items = Contents::where('type','=','about_page_2')->first();
        return response()->json(['success'=>$items]);
    }

    public function post_data(Request $request){
        $about_page_2 = Contents::where('type','=','about_page_2')->first();
        $validation = Validator::make($request->all(), $this->rules($about_page_2),$this->languags());
        if ($validation->fails())
        {
            return response()->json(['errors'=>$validation->errors()]);
        }
        else{
            if($about_page_2 == null){
                DB::transaction(function()
                {
                    $about_page_2 = new Contents();
                    $about_page_2->type = 'about_page_2';
                    $about_page_2->summary = Input::get('summary');
                    $about_page_2->sub_summary = Input::get('sub_summary');
                    $about_page_2->language_id = parent::GetIdLangEn()->id;
                    $about_page_2->user_id = parent::CurrentID();
                    $about_page_2->save();
                    if( !$about_page_2 )
                    {
                        return response()->json(['error'=> __('language.msg.e')]);
                    }
                });
                return response()->json(['success'=> __('language.msg.s'),'same_page'=>'1','dashboard'=>'1']);
            }
            else{
                DB::transaction(function()
                {
                    $about_page_2 = Contents::where('type','=','about_page_2')->first();
                    $about_page_2->summary = Input::get('summary');
                    $about_page_2->sub_summary = Input::get('sub_summary');
                    $about_page_2->update();
                    if( !$about_page_2 )
                    {
                        return response()->json(['error'=> __('language.msg.e')]);
                    }
                });
                return response()->json(['success'=>__('language.msg.m'),'same_page'=>'1','dashboard'=>'1']);
            }
        }
    }

    private function rules($edit = null,$pass = null){
        $x= [
            'summary' => 'required|string',
            'sub_summary' => 'required|string',
        ];
        if($edit != null){
            $x['id'] ='required|integer|min:1';
            $x['avatar'] ='nullable|mimes:png,jpg,jpeg,PNG,JPG,JPEG';
        }
        return $x;
    }

    private function languags(){
        if(app()->getLocale() == "ar"){
            return [
                'link.required' => 'حقل الرابط مطلوب.',
                'video.required' => 'حقل الفيديو مطلوب.',
                'link.required' => 'حقل الوصف مطلوب.',
                'name.required' => 'حقل الاسم مطلوب.',
                'name.regex' => 'حقل الاسم غير صحيح .',
                'name.min' => 'حقل الاسم مطلوب على الاقل 3 حقول .',
                'name.max' => 'حقل الاسم مطلوب على الاكثر 191 حرف  .',
                'sub_name.required' => 'حقل الاسم الثانوي مطلوب.',
                'sub_name.regex' => 'حقل الاسم الثانوي غير صحيح .',
                'sub_name.min' => 'حقل الاسم الثانوي مطلوب على الاقل 3 حقول .',
                'sub_name.max' => 'حقل الاسم الثانوي مطلوب على الاكثر 191 حرف  .',
                'avatar1.required' => 'حقل الصورة الاولى مطلوب.',
                'avatar2.required' => 'حقل الصورة الثانية مطلوب.',
                'avatar3.required' => 'حقل الصورة الثالثة مطلوب.',
                'avatar4.required' => 'حقل الصورة الرابعة مطلوب.',
                'dir.required' => 'حقل كود الغة مطلوب.',
            ];
        }
        else{
            return [];
        }
    }

}
