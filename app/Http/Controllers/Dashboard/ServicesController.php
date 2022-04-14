<?php

namespace App\Http\Controllers\Dashboard;

use App\Catalogue;
use App\Category;
use App\City;
use App\Services;
use App\ServicesIncludedChecks;
use App\ServicesReview;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ServicesController extends Controller
{
    public function index()
    {
        return view('dashboard/services.index');
    }

    public function add_edit($id = null, Request $request)
    {
        $category_id = Category::get();
        $city_id = City::get();
        $catalogue_id = Catalogue::get();
        return view('dashboard/services.add_edit',compact('category_id','city_id','catalogue_id'));
    }

    function get_data(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'language',
            3 => 'avatar',
            4 => 'home_1',
            5 => 'home_2',
            6 => 'id',
        );

        $totalData = Services::count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $search = $request->input('search.value');

        $Services = Services::
        where("name", "like", "%" . $search . "%")
            ->offset($start)
            ->limit($limit)
            ->orderBy('id', 'desc')
            ->orderBy('home_1', 'desc')
            ->orderBy('home_2', 'desc')
            ->orderBy($order, $dir)
            ->get();

        if ($search != null) {
            $totalFiltered = Services::
            where("name", "like", "%" . $search . "%")
                ->count();
        }


        $data = array();
        if (!empty($Services)) {
            foreach ($Services as $post) {
                $ava = url(parent::PublicPa() . $post->avatar);
                $edit = route('dashboard_services.add_edit', ['id' => $post->id]);

                $langage = $post->Language->name;
                $ava_lan = url(parent::PublicPa() . $post->Language->avatar);

                $edit_title = parent::CurrentLangShow()->Edit;
                $delete_title = parent::CurrentLangShow()->Delete;
                $add_title = parent::CurrentLangShow()->Add_new_language;

                $has_lanageus = $post->Services;
                $langages_reslut = '';
                if($has_lanageus->count() != 0){
                    foreach ($has_lanageus as $item2){
                        $t  = url(parent::PublicPa().$item2->Language->avatar);
                        $langages_reslut = $langages_reslut . "<img class='btn_edit_lan' data-id='{$item2->id}' style='margin: 0 5px;width: 40px;height: 25px;' src='{$t}' />";
                    }
                }

                $check = '';
                $active_or_no = "Disable";
                if($post->home_1 == 1){
                    $check = 'checked';
                    $active_or_no = "Active";
                }
                $add = '<label class="custom-switch"> <input type="checkbox" data-id='. $post->id .' name="custom-switch-checkbox" class="btn_home_1 custom-switch-input" '.$check.'> <span class="custom-switch-indicator"></span> <span class="custom-switch-description">'.$active_or_no.'</span> </label>';

                $check1 = '';
                $active_or_no1 = "Disable";
                if($post->home_2 == 1){
                    $check1 = 'checked';
                    $active_or_no1 = "Active";
                }
                $add1 = '<label class="custom-switch"> <input type="checkbox" data-id='. $post->id .' name="custom-switch-checkbox" class="btn_home_2 custom-switch-input" '.$check1.'> <span class="custom-switch-indicator"></span> <span class="custom-switch-description">'.$active_or_no1.'</span> </label>';

                $nestedData['id'] = $post->id;
                $nestedData['name'] = $post->name;
                $nestedData['home_1'] = $add;
                $nestedData['home_2'] = $add1;
                $nestedData['avatar'] = "<img style='width: 50px;height: 50px;' src='{$ava}' class='img-circle img_data_tables'>";
                $nestedData['language'] = "<img style='width: 40px;height: 25px;' src='{$ava_lan}' />".$langages_reslut;
                $nestedData['options'] = "&emsp;<a class='btn btn-success btn-sm' href='{$edit}' title='$edit_title' ><span class='color_wi fa fa-edit'></span></a>
                                           <a class='btn_delete_current btn btn-danger btn-sm' data-id='{$post->id}' title='$delete_title' ><span class='color_wi fa fa-trash'></span></a>";
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        echo json_encode($json_data);
    }

    function get_data_by_id(Request $request)
    {
        $id = $request->id;
        if ($id == null) {
            return response()->json(['error' => __('language.msg.e')]);
        }
        $Post = Services::where('id', '=', $id)->first();
        if ($Post == null) {
            return response()->json(['error' => __('language.msg.e')]);
        }
        return response()->json(['success' => $Post]);
    }

    function deleted(Request $request)
    {
        $id = $request->id;
        if ($id == null) {
            return response()->json(['error' => __('language.msg.e')]);
        }
        $Post = Services::where('id', '=', $id)->first();
        if ($Post == null) {
            return response()->json(['error' => __('language.msg.e')]);
        }
        $Post->delete();
        return response()->json(['error' => __('language.msg.d')]);
    }

    private function languags2()
    {
        if (app()->getLocale() == "ar") {
            return [
                'rating.required' => 'حقل التقيم مطلوب.',
                'rating.numeric' => 'حقل التقيم غير صحيح .',
                'rating.between' => 'حقل التقيم فقط بين 1 و 5 غير صحيح .',
                'Services_id_rating.required' => 'حقل المنتج مطلوب.',
                'Services_id_rating.numeric' => 'حقل المنتج غير صحيح .',
            ];
        } else {
            return [];
        }
    }

    public function post_data(Request $request)
    {
        $edit = $request->id;
        $validation = Validator::make($request->all(), $this->rules($edit), $this->languags());
        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()]);
        } else {
            if ($edit != null) {
                $Post = Services::where('id', '=', Input::get('id'))->first();
                $Post->name = Input::get('name');
                $Post->sub_name = Input::get('sub_name');
                $Post->summary = Input::get('summary');
                $Post->city_id = Input::get('city_id');
                $Post->category_id = Input::get('category_id');
                $Post->catalogue_id = Input::get('catalogue_id');

                $Post->iframe = Input::get('iframe');
                $Post->address = Input::get('address');
                if(Input::get('verified') == "on"){
                    $Post->verified =1;
                }
                else{
                    $Post->verified = 0;
                }

                $Post->images = $request->old_images . ',' . $request->images;
                if (Input::hasFile('avatar')) {
                    //Remove Old
                    if ($Post->avatar != 'services/no.png') {
                        if (file_exists(public_path($Post->avatar))) {
                            unlink(public_path($Post->avatar));
                        }
                    }
                    //Save avatar
                    $image_copy = parent::upladImage(Input::file('avatar'), 'services');
                    $Post->avatar = $image_copy;
                }

                $Post->update();
                return response()->json(['success' => __('language.msg.m'), 'dashboard' => '1', 'redirect' => route('dashboard_services.add_edit',['id'=>$Post->id])]);
            } else {
                $Post = new Services();
                $Post->name = Input::get('name');
                $Post->sub_name = Input::get('sub_name');
                $Post->summary = Input::get('summary');
                $Post->images = Input::get('images');
                $Post->city_id = Input::get('city_id');
                $Post->category_id = Input::get('category_id');
                $Post->catalogue_id = Input::get('catalogue_id');

                $Post->iframe = Input::get('iframe');
                $Post->address = Input::get('address');
                if(Input::get('verified') == "on"){
                    $Post->verified =1;
                }
                else{
                    $Post->verified = 0;
                }

                $Post->language_id = parent::GetIdLangEn()->id;
                $Post->avatar = parent::upladImage(Input::file('avatar'), 'services');
                $Post->save();
                return response()->json(['success' => __('language.msg.s'), 'dashboard' => '1', 'redirect' => route('dashboard_services.add_edit',['id'=>$Post->id])]);
            }
        }
    }

    private function rules($edit = null)
    {
        $x = [
            'name' => 'required|min:3|max:191',
            'sub_name' => 'required|min:3|max:191',
            'images' => 'nullable|min:1|string',
            'category_id' => 'required|min:1|numeric',
            'city_id' => 'required|min:1|numeric',
            'summary' => 'required|string',
            'avatar' => 'required|mimes:png,jpg,jpeg,jpeg,PNG,JPG,JPEG',
        ];
        if ($edit != null) {
            $x['id'] = 'required|integer|min:1';
            $x['avatar'] = 'nullable|mimes:png,jpg,jpeg,PNG,JPG,JPEG';
        }
        return $x;
    }

    private function languags()
    {
        if (app()->getLocale() == "ar") {
            return [
                'keywords' => 'The keywords field is required.',
                'description ' => 'The description  field is required.',
                'sub_name.required' => 'حقل الاسم الثانوي مطلوب.',
                'sub_name.regex' => 'حقل الاسم الثانوي غير صحيح .',
                'sub_name.min' => 'حقل الاسم الثانوي مطلوب على الاقل 3 حقول .',
                'sub_name.max' => 'حقل الاسم الثانوي مطلوب على الاكثر 191 حرف  .',
                'price.max' => 'حقل الاسم الثانوي مطلوب على الاكثر 191 حرف  .',
                'paragraph.required' => 'حقل المختصر مطلوب.',
                'name.required' => 'حقل الاسم مطلوب.',
                'category_id.required' => 'حقل التنصيف مطلوب.',
                'category_id.numeric' => 'حقل التنصيف غير صحيح .',
                'name.regex' => 'حقل الاسم غير صحيح .',
                'name.min' => 'حقل الاسم مطلوب على الاقل 3 حقول .',
                'name.max' => 'حقل الاسم مطلوب على الاكثر 191 حرف  .',
                'summary.required' => 'حقل الوصف مطلوب.',
                'summary.min' => 'حقل الوصف مطلوب على الاقل 3 حقول .',
                'summary_bunner.required' => 'حقل الوصف البانر مطلوب.',
                'summary_bunner.min' => 'حقل الوصف البانر مطلوب على الاقل 3 حقول .',
                'category_id.required' => 'حقل الاقسام مطلوب.',
                'category_id.regex' => 'حقل الاقسام غير صحيح .',
                'category_id.min' => 'حقل الاقسام مطلوب على الاقل 31 .',
                'price.required' => 'حقل السعر مطلوب.',
                'price.regex' => 'حقل السعر غير صحيح .',
                'price.min' => 'حقل السعر مطلوب على الاقل 1 .',
                'avatar.required' => 'حقل الصورة مطلوب.',
                'avatar.mimes' => 'حقل الصورة غير صحيح .',
                'bunner.required' => 'حقل صورة البانر مطلوب.',
                'bunner.mimes' => 'حقل صورة البانر غير صحيح .',
            ];
        } else {
            return [];
        }
    }

    function home_1(Request $request)
    {
        $id = $request->id;
        if ($id == null) {
            return response()->json(['error' => __('language.msg.e')]);
        }
        $user = Services::where('id', '=', $id)->first();
        if ($user == null) {
            return response()->json(['error' => __('language.msg.e')]);
        }
        if ($user->home_1 == 1) {
            $user->home_1 = 0;
            $user->update();
            return response()->json(['error' => __('table.r-choice')]);
        } else {
            $user->home_1 = 1;
            $user->update();
            return response()->json(['success' => __('table.choice')]);
        }
    }


    function home_2(Request $request)
    {
        $id = $request->id;
        if ($id == null) {
            return response()->json(['error' => __('language.msg.e')]);
        }
        $user = Services::where('id', '=', $id)->first();
        if ($user == null) {
            return response()->json(['error' => __('language.msg.e')]);
        }
        if ($user->home_2 == 1) {
            $user->home_2 = 0;
            $user->update();
            return response()->json(['error' => __('table.r-choice')]);
        } else {
            $user->home_2 = 1;
            $user->update();
            return response()->json(['success' => __('table.choice')]);
        }
    }

    public function uploadjquery(Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('upload/gallery_services'), $imageName);
        return response()->json(['data' => $imageName]);
    }

    public function deleteuploadjquery(Request $request)
    {
        $filename = $request->get('filename');
        $path = public_path() . '/upload/gallery_services/' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }

}
