<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return view('dashboard/category.index');
    }

    public function add_edit()
    {
        return view('dashboard/category.add_edit');
    }

    function get_data(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'language',
            //4 => 'featured',
            // 5 => 'trending',
            6 => 'id',
        );

        $totalData = Category::count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $search = $request->input('search.value');

        $Category = Category::
        where("name", "like", "%" . $search . "%")
            ->offset($start)
            ->limit($limit)
            ->orderBy('id', 'desc')
            ->orderBy($order, $dir)
            ->get();

        if ($search != null) {
            $totalFiltered = Category::
            where("name", "like", "%" . $search . "%")
                ->count();
        }


        $data = array();
        if (!empty($Category)) {
            foreach ($Category as $Category) {
                $edit = route('dashboard_category.add_edit', ['id' => $Category->id, 'type' => app('request')->input('type')]);
                $langage = $Category->Language->name;
                $ava_lan = url(parent::PublicPa() . $Category->Language->avatar);

                $edit_title = parent::CurrentLangShow()->Edit;
                $delete_title = parent::CurrentLangShow()->Delete;
                $add_title = parent::CurrentLangShow()->Add_new_language;

                $has_lanageus = $Category->Category;
                $langages_reslut = '';
                if ($has_lanageus->count() != 0) {
                    foreach ($has_lanageus as $item2) {
                        $t = url(parent::PublicPa() . $item2->Language->avatar);
                        $langages_reslut = $langages_reslut . "<img class='btn_edit_lan' data-id='{$item2->id}' style='margin: 0 5px;width: 40px;height: 25px;' src='{$t}' />";
                    }
                }

                $nestedData['id'] = $Category->id;
                $nestedData['name'] = $Category->name;
                $nestedData['language'] = "<img style='width: 40px;height: 25px;' src='{$ava_lan}' />" . $langages_reslut;
                $nestedData['options'] = "&emsp;<a class='btn btn-success btn-sm' href='{$edit}' title='$edit_title' ><span class='color_wi fa fa-edit'></span></a>
                                          <a class='btn_delete_current btn btn-danger btn-sm' data-id='{$Category->id}' title='$delete_title' ><span class='color_wi fa fa-trash'></span></a>";
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
        $Category = Category::where('id', '=', $id)->first();
        if ($Category == null) {
            return response()->json(['error' => __('language.msg.e')]);
        }
        return response()->json(['success' => $Category]);
    }

    function deleted(Request $request)
    {
        $id = $request->id;
        if ($id == null) {
            return response()->json(['error' => __('language.msg.e')]);
        }
        $Category = Category::where('id', '=', $id)->first();
        if ($Category == null) {
            return response()->json(['error' => __('language.msg.e')]);
        }
        $Category->delete();
        return response()->json(['error' => __('language.msg.d')]);
    }

    public function post_data(Request $request)
    {
        $edit = $request->id;
        $type = $request->type;
        $validation = Validator::make($request->all(), $this->rules($edit), $this->languags());
        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()]);
        } else {
            $re = 0;
            if ($edit != null) {
                $Category = Category::where('id', '=', Input::get('id'))->first();
                $Category->name = Input::get('name');
                if (Input::hasFile('avatar')) {
                    //Remove Old
                    if ($Category->avatar != 'posts/no.png') {
                        if (file_exists(public_path($Category->avatar))) {
                            unlink(public_path($Category->avatar));
                        }
                    }
                    //Save avatar
                    $Category->avatar = parent::upladImage(Input::file('avatar'), 'category');
                }
                $Category->update();
                $re = $Category->id;
                return response()->json(['success' => __('language.msg.m'), 'dashboard' => '1', 'redirect' => route('dashboard_category.add_edit', ['id' => $re])]);
            } else {
                $Category = new Category();
                $Category->name = Input::get('name');
                $Category->language_id = parent::GetIdLangEn()->id;
                $Category->user_id = parent::CurrentID();
                if (Input::hasFile('avatar')) {
                    $Category->avatar = parent::upladImage(Input::file('avatar'), 'category');
                }
                else{
                    $Category->avatar = "upload/category/no.png";
                }
                $Category->save();
                $re = $Category->id;
                return response()->json(['success' => __('language.msg.s'), 'dashboard' => '1', 'redirect' => route('dashboard_category.add_edit', ['id' => $re])]);
            }
        }
    }

    private function rules($edit = null)
    {
        $x = [
            'name' => 'required|min:3|max:191',
        ];
        if ($edit != null) {
            $x['id'] = 'required|integer|min:1';
        }
        return $x;
    }

    private function languags()
    {
        if (app()->getLocale() == "ar") {
            return [
                'video.required' => 'حقل الفيديو مطلوب.',
                'video.regex' => 'حقل الفيديو غير صحيح .',
                'video.min' => 'حقل الفيديو مطلوب على الاقل 3 حقول .',
                'video.max' => 'حقل الفيديو مطلوب على الاكثر 191 حرف  .',
                'name.required' => 'حقل الاسم مطلوب.',
                'name.regex' => 'حقل الاسم غير صحيح .',
                'name.min' => 'حقل الاسم مطلوب على الاقل 3 حقول .',
                'name.max' => 'حقل الاسم مطلوب على الاكثر 191 حرف  .',
                'type.required' => 'حقل نوع التنصيف مطلوب.',
                'type.numeric' => 'حقل نوع التنصيف غير صحيح .',
                'type.in' => 'حقل نوع التنصيف غير صحيح .',
                'avatar.required' => 'حقل الصورة مطلوب.',
                'summary.required' => 'حقل الوصف مطلوب.',
                'dir.required' => 'حقل كود الغة مطلوب.',
                'keywords' => 'The keywords field is required.',
                'description ' => 'The description  field is required.',

            ];
        } else {
            return [];
        }
    }

    function featured(Request $request)
    {
        $id = $request->id;
        if ($id == null) {
            return response()->json(['error' => __('language.msg.e')]);
        }
        $user = Category::where('id', '=', $id)->first();
        if ($user == null) {
            return response()->json(['error' => __('language.msg.e')]);
        }
        if ($user->featured == 1) {
            $user->featured = 0;
            $user->update();
            return response()->json(['error' => __('table.r-choice')]);
        } else {
            $user->featured = 1;
            $user->update();
            return response()->json(['success' => __('table.choice')]);
        }
    }

    function trending(Request $request)
    {
        $id = $request->id;
        if ($id == null) {
            return response()->json(['error' => __('language.msg.e')]);
        }
        $user = Category::where('id', '=', $id)->first();
        if ($user == null) {
            return response()->json(['error' => __('language.msg.e')]);
        }
        if ($user->trending == 1) {
            $user->trending = 0;
            $user->update();
            return response()->json(['error' => __('table.r-choice')]);
        } else {
            $user->trending = 1;
            $user->update();
            return response()->json(['success' => __('table.choice')]);
        }
    }

}
