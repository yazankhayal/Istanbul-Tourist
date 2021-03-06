<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Testimonials;

class TestimonialsController extends Controller
{
    public function index()
    {
        return view('dashboard/testimonials.index');
    }

    public function add_edit()
    {
        return view('dashboard/testimonials.add_edit');
    }

    function get_data(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'language',
            3 => 'id',
        );

        $totalData = Testimonials::count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $search = $request->input('search.value');

        $posts = Testimonials::
        Where('name', 'LIKE', "%{$search}%")
            ->offset($start)
            ->limit($limit)
            ->orderBy('id', 'desc')
            ->orderBy($order, $dir)
            ->get();

        if ($search != null) {
            $totalFiltered = Testimonials::
            Where('name', 'LIKE', "%{$search}%")
                ->count();
        }


        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $edit = route('dashboard_testimonials.add_edit', ['id' => $post->id]);
                $langage = $post->Language->name;
                $ava_lan = url(parent::PublicPa() . $post->Language->avatar);

                $edit_title = parent::CurrentLangShow()->Edit;
                $delete_title = parent::CurrentLangShow()->Delete;
                $add_title = parent::CurrentLangShow()->Add_new_language;
                $has_lanageus = $post->Testimonials;
                $langages_reslut = '';
                if ($has_lanageus->count() != 0) {
                    foreach ($has_lanageus as $item2) {
                        $t = url(parent::PublicPa() . $item2->Language->avatar);
                        $langages_reslut = $langages_reslut . "<img class='btn_edit_lan' data-id='{$item2->id}' style='margin: 0 5px;width: 40px;height: 25px;' src='{$t}' />";
                    }
                }
                $nestedData['id'] = $post->id;
                $nestedData['name'] = $post->name;
                $nestedData['language'] = "<img style='width: 40px;height: 25px;' src='{$ava_lan}' />" . $langages_reslut;
                $nestedData['options'] = "&emsp;<a class='btn btn-success btn-sm' href='{$edit}' title='$edit_title' ><span class='color_wi fa fa-edit'></span></a>
                                          &emsp;<a class='btn_delete_current btn btn-danger btn-sm' data-id='{$post->id}' title='$delete_title' ><span class='color_wi fa fa-trash'></span></a>";
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
        $Post = Testimonials::where('id', '=', $id)->first();
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
        $Post = Testimonials::where('id', '=', $id)->first();
        if ($Post == null) {
            return response()->json(['error' => __('language.msg.e')]);
        }
        $Post->delete();
        return response()->json(['error' => __('language.msg.d')]);
    }

    public function post_data(Request $request)
    {
        $edit = $request->id;
        $type_post = $request->type_post;
        $type = $request->type;
        $validation = Validator::make($request->all(), $this->rules($edit, $type_post, $type), $this->languags());
        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()]);
        } else {
            if ($edit != null) {
                $Post = Testimonials::where('id', '=', Input::get('id'))->first();
                $Post->name = Input::get('name');
                $Post->summary = Input::get('summary');
                $Post->bio = Input::get('bio');
                if (Input::hasFile('avatar')) {
                    //Remove Old
                    if ($Post->avatar != 'upload/Why/no.png') {
                        if (file_exists(public_path($Post->avatar))) {
                            unlink(public_path($Post->avatar));
                        }
                    }
                    //Save avatar
                    $Post->avatar = parent::upladImage(Input::file('avatar'), 'testimonials');
                }
                $Post->update();
                return response()->json(['success' => __('language.msg.m'), 'dashboard' => '1', 'redirect' => route('dashboard_testimonials.add_edit',['id'=>$Post->id])]);
            } else {
                $Post = new Testimonials();
                $Post->name = Input::get('name');
                $Post->bio = Input::get('bio');
                $Post->summary = Input::get('summary');
                $Post->language_id = parent::GetIdLangEn()->id;
                $Post->avatar = parent::upladImage(Input::file('avatar'), 'testimonials');
                $Post->save();
                return response()->json(['success' => __('language.msg.s'), 'dashboard' => '1', 'redirect' => route('dashboard_testimonials.add_edit',['id'=>$Post->id])]);
            }
        }
    }

    private function rules($edit = null)
    {
        $x = [
            'name' => 'required|min:3|max:191|regex:/^[??-??a-zA-Z0-9]/',
            'bio' => 'required|min:3|max:191|regex:/^[??-??a-zA-Z0-9]/',
            'summary' => 'required|string',
            'avatar' => 'required|mimes:png,jpg,jpeg,PNG,JPG,JPEG',
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
                'video.required' => '?????? ?????????????? ??????????.',
                'video.regex' => '?????? ?????????????? ?????? ???????? .',
                'video.min' => '?????? ?????????????? ?????????? ?????? ?????????? 3 ???????? .',
                'video.max' => '?????? ?????????????? ?????????? ?????? ???????????? 191 ??????  .',
                'name.required' => '?????? ?????????? ??????????.',
                'name.regex' => '?????? ?????????? ?????? ???????? .',
                'name.min' => '?????? ?????????? ?????????? ?????? ?????????? 3 ???????? .',
                'name.max' => '?????? ?????????? ?????????? ?????? ???????????? 191 ??????  .',
                'bio.required' => '?????? bio ??????????.',
                'bio.regex' => '?????? bio ?????? ???????? .',
                'bio.min' => '?????? bio ?????????? ?????? ?????????? 3 ???????? .',
                'bio.max' => '?????? bio ?????????? ?????? ???????????? 191 ??????  .',
                'type.required' => '?????? ?????? ?????????????? ??????????.',
                'type.numeric' => '?????? ?????? ?????????????? ?????? ???????? .',
                'type.in' => '?????? ?????? ?????????????? ?????? ???????? .',
                'type_post.required' => '?????? ?????? ?????????????? ??????????.',
                'type_post.numeric' => '?????? ?????? ?????????????? ?????? ???????? .',
                'type_post.in' => '?????? ?????? ?????????????? ?????? ???????? .',

                'avatar.required' => '?????? ???????????? ??????????.',
                'summary.required' => '?????? ?????????? ??????????.',
                'dir.required' => '?????? ?????? ???????? ??????????.',

            ];
        } else {
            return [];
        }
    }

}
