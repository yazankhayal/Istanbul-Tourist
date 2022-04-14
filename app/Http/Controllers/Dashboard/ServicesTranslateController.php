<?php

namespace App\Http\Controllers\Dashboard;

use App\ServicesTranslate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ServicesTranslateController extends Controller
{

    function get_data_by_id(Request $request){
        $id = $request->id;
        $language_id = $request->language_id;
        if($id == null){
            return response()->json(['error'=> __('language.msg.e')]);
        }
        if($language_id == null){
            return response()->json(['error'=> __('language.msg.e')]);
        }
        $SubScriptions = ServicesTranslate::
            where('services_id' ,'=',$id)
            ->where('language_id' ,'=',$language_id)
            ->first();
        if($SubScriptions == null){
            return response()->json(['error'=> __('language.msg.e')]);
        }
        return response()->json(['success'=>$SubScriptions]);
    }

    public function post_data(Request $request){
        $edit = $request->id;
        $validation = Validator::make($request->all(), $this->rules($edit),$this->languags());
        if ($validation->fails())
        {
            return response()->json(['errors'=>$validation->errors()]);
        }
        else{
            if($edit != null){
                DB::transaction(function()
                {
                    $PostTranslate = ServicesTranslate::where('id' ,'=',Input::get('id'))->first();
                    $PostTranslate->name = Input::get('name');
                    $PostTranslate->sub_name = Input::get('sub_name');
                    $PostTranslate->summary = Input::get('summary');
                    $PostTranslate->language_id = Input::get('language_id');
                    $PostTranslate->services_id = Input::get('services_id');
                    $PostTranslate->update();
                    if( !$PostTranslate )
                    {
                        return response()->json(['error'=> __('language.msg.e')]);
                    }
                });
                return response()->json(['success' => __('language.msg.m'), 'dashboard' => '1', 'redirect' => route('dashboard_services.add_edit',['id'=>Input::get('services_id')])]);
            }
            else{
                $check = ServicesTranslate::
                where('services_id' ,'=',Input::get('services_id'))
                    ->where('language_id' ,'=',Input::get('language_id'))
                    ->first();
                if($check != null){
                    return response()->json(['error'=> __('language.msg.already')]);
                }
                DB::transaction(function()
                {
                    $PostTranslate = new ServicesTranslate();
                    $PostTranslate->summary = Input::get('summary');
                    $PostTranslate->sub_name = Input::get('sub_name');
                    $PostTranslate->name = Input::get('name');
                    $PostTranslate->language_id = Input::get('language_id');
                    $PostTranslate->services_id = Input::get('services_id');
                    $PostTranslate->save();
                    if( !$PostTranslate )
                    {
                        return response()->json(['error'=> __('language.msg.e')]);
                    }
                });
                return response()->json(['success' => __('language.msg.s'), 'dashboard' => '1', 'redirect' => route('dashboard_services.add_edit',['id'=>Input::get('services_id')])]);
            }
        }
    }

    private function rules($edit = null){
        $x = [
            'name' => 'required|min:3|max:191',
            'sub_name' => 'required|min:3|max:191',
            'summary' => 'required|string',
            'services_id' => 'required|numeric|min:1',
            'language_id' => 'required|numeric|min:1',
        ];
        if($edit != null){
            $x['id'] ='required|integer|min:1';
        }
        return $x;
    }

    private function languags(){
        if(app()->getLocale() == "ar"){
            return [
                'sub_name.max' => 'حقل الاسم الثانوي مطلوب على الاكثر 191 حرف  .',
                'sub_name.required' => 'حقل الاسم الثانوي مطلوب.',
                'sub_name.regex' => 'حقل الاسم الثانوي غير صحيح .',
                'sub_name.min' => 'حقل الاسم الثانوي مطلوب على الاقل 3 حقول .',
                'paragraph.required' => 'حقل المختصر مطلوب.',
                'name.required' => 'حقل الاسم مطلوب.',
                'name.regex' => 'حقل الاسم غير صحيح .',
                'name.min' => 'حقل الاسم مطلوب على الاقل 3 حقول .',
                'name.max' => 'حقل الاسم مطلوب على الاكثر 191 حرف  .',
                'summary.required' => 'حقل الوصف مطلوب.',
                'dir.required' => 'حقل كود الغة مطلوب.',
                'language_id.required' => 'حقل الغة مطلوب.',

            ];
        }
        else{
            return [];
        }
    }


}
