<?php

namespace App\Http\Controllers\Dashboard;

use App\Contents;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class About2Controller extends Controller
{
    public function index(){
        return view('dashboard/about_page.index');
    }

    public function get_data_by_id(Request $request){
        $items = Contents::where('type','=','about_page')->first();
        return response()->json(['success'=>$items]);
    }

    public function post_data(Request $request){
        $about_page = Contents::where('type','=','about_page')->first();
        $validation = Validator::make($request->all(), $this->rules($about_page),$this->languags());
        if ($validation->fails())
        {
            return response()->json(['errors'=>$validation->errors()]);
        }
        else{
            if($about_page == null){
                DB::transaction(function()
                {
                    $about_page = new Contents();
                    $about_page->type = 'about_page';
                    $about_page->summary = Input::get('summary');
                    $about_page->language_id = parent::GetIdLangEn()->id;
                    $about_page->user_id = parent::CurrentID();
                    $about_page->save();
                    if( !$about_page )
                    {
                        return response()->json(['error'=> __('language.msg.e')]);
                    }
                });
                return response()->json(['success'=> __('language.msg.s'),'same_page'=>'1','dashboard'=>'1']);
            }
            else{
                DB::transaction(function()
                {
                    $about_page = Contents::where('type','=','about_page')->first();
                    $about_page->summary = Input::get('summary');
                    $about_page->update();
                    if( !$about_page )
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
        ];
        if($edit != null){
            $x['id'] ='required|integer|min:1';
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