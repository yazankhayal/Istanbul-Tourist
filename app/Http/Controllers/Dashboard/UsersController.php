<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\User;

class UsersController extends Controller
{
    public function index()
    {
        return view('dashboard/users.index');
    }

    public function add_edit()
    {
        return view('dashboard/users.add_edit');
    }

    function get_data(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'avatar',
           // 4 => 'avatar',
           // 5 => 'confirm_email',
            6 => 'id',
        );

        $totalData = User::count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $search = $request->input('search.value');

        $filter_role = '2';
        if ($search == 'Admin') {
            $filter_role = '1';
        }

        $posts = User::
        Where('name', 'LIKE', "%{$search}%")
            ->orWhere('role', '=', "{$filter_role}")
            ->orWhere('email', 'like', "%{$search}%")
            ->offset($start)
            ->limit($limit)
            ->orderBy('id', 'desc')
            ->orderBy($order, $dir)
            ->get();

        if ($search != null) {
            $totalFiltered = User::
            Where('name', 'LIKE', "%{$search}%")
                ->orWhere('role', '=', "{$filter_role}")
                ->orWhere('email', 'like', "%{$search}%")
                ->count();
        }


        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $ava = url(parent::PublicPa() . $post->avatar);

                if ($post->type_login != null) {
                    $ava = $post->avatar;
                }

                $Subscription = parent::CurrentLangShow()->Subscription;

                $edit = route('dashboard_users.add_edit', ['id' => $post->id]);

              /*  $role = '';
                if ($post->role == 1) {
                    $role = parent::CurrentLangShow()->Admin;
                }
                else {
                    $role = parent::CurrentLangShow()->User;
                }

                $check = '';
                if ($post->active == 1) {
                    $check = 'checked';
                }*/

                $nestedData['id'] = $post->id;
                $nestedData['name'] = $post->name;
                //$nestedData['confirm_email'] = '<div class="text-center"><input data-id="' . $post->id . '" class="btn_confirm_email_current" type="checkbox" ' . $check . '></div>';
                $nestedData['email'] = $post->email;
                //$nestedData['role'] = '<div class="badge badge-primary">' . $role . '</div>' . '<br>';
                $nestedData['avatar'] = "<img style='width: 50px;height: 50px;' src='{$ava}' class='img-circle img_data_tables'>";
                $nestedData['options'] = "&emsp;<a class='btn btn-success btn-sm' href='{$edit}' title='??????????' ><span class='color_wi fa fa-edit'></span></a>
                                          &emsp;<a class='btn_delete_current btn btn-danger btn-sm' data-id='{$post->id}' title='??????' ><span class='color_wi fa fa-trash'></span></a>";
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
        $user = User::where('id', '=', $id)->first();
        if ($user == null) {
            return response()->json(['error' => __('language.msg.e')]);
        }
        return response()->json(['success' => $user]);
    }

    function deleted(Request $request)
    {
        $id = $request->id;
        if ($id == null) {
            return response()->json(['error' => __('language.msg.e')]);
        }
        $user = User::where('id', '=', $id)->first();
        if ($user == null) {
            return response()->json(['error' => __('language.msg.e')]);
        }

        if ($user->id == parent::CurrentID()) {
            return response()->json(['error' => __('language.msg.e')]);
        }

        $user->delete();
        return response()->json(['error' => __('language.msg.d')]);
    }

    public function post_data(Request $request)
    {
        $edit = $request->id;
        $password = $request->password;
        $validation = Validator::make($request->all(), $this->rules($edit, $password), $this->languags());
        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()]);
        } else {
            if ($edit == null) {
                DB::transaction(function () {
                    $user = new User();
                    $user->name = Input::get('name');
                    $user->email = Input::get('email');
                    $user->role = Input::get('role');
                    if (Input::get('password') != null) {
                        $user->password = bcrypt(Input::get('password'));
                    }
                    $user->avatar = parent::upladImage(Input::file('avatar'), 'avatar');
                    $user->save();
                    if (!$user) {
                        return response()->json(['error' => __('language.msg.e')]);
                    }
                });
                return response()->json(['success' => __('language.msg.s'), 'dashboard' => '1', 'redirect' => route('dashboard_users.index')]);
            } else {
                DB::transaction(function () {
                    $user = User::where('id', '=', Input::get('id'))->first();
                    $user->name = Input::get('name');
                    $user->email = Input::get('email');
                    $user->role = Input::get('role');
                    if (Input::get('password') != null) {
                        $user->password = bcrypt(Input::get('password'));
                    }
                    if (Input::hasFile('avatar')) {
                        //Remove Old
                        if ($user->avatar != 'no.png') {
                            if (file_exists(public_path($user->avatar))) {
                                unlink(public_path($user->avatar));
                            }
                        }
                        //Save avatar
                        $user->avatar = parent::upladImage(Input::file('avatar'), 'avatar');
                    }
                    $user->update();
                    if (!$user) {
                        return response()->json(['error' => __('language.msg.e')]);
                    }
                });
                return response()->json(['success' => __('language.msg.m'), 'dashboard' => '1', 'redirect' => route('dashboard_users.index')]);
            }
        }
    }

    private function rules($edit = null, $pass = null)
    {
        $x = [
            'name' => 'required|min:3|regex:/^[??-??a-zA-Z0-9]/',
            'email' => 'required|string|email|unique:users,email,' . $edit,
            'role' => 'required|integer|in:1,2,3',
            'avatar' => 'required|mimes:png,jpg,jpeg,PNG,JPG,JPEG',
        ];
        if ($edit != null) {
            $x['id'] = 'required|integer|min:1';
            $x['avatar'] = 'nullable|mimes:png,jpg,jpeg,PNG,JPG,JPEG';
            $x['password'] = 'nullable|string|min:6|confirmed';
        } else {
            $x['password'] = 'required|string|min:6|confirmed';
        }

        if ($pass != null) {
            $x['password'] = 'required|string|min:6|confirmed';
        }

        return $x;
    }

    private function languags()
    {
        if (app()->getLocale() == "ar") {
            return [
                'name.required' => '?????? ?????????? ??????????.',
                'name.regex' => '?????? ?????????? ?????? ???????? .',
                'name.min' => '?????? ?????????? ?????????? ?????? ?????????? 3 ???????? .',

                'email.required' => '?????? ?????????????? ??????????.',
                'email.taken' => '???????????? ???????????????????? ???? ????????.',
                'email.email' => '?????? ?????????????? ?????? ???????? .',

                'role.required' => '?????? ?????????? ??????????.',
                'role.integer' => '?????? ?????????? ?????? ???????? .',
                'role.in' => '?????? ?????????? ?????? ???????? .',

                'avatar.required' => '?????? ???????????? ??????????.',
                'avatar.mimes' => '?????? ???????????? ?????? ???????? .',

                'password.required' => '?????? ???????? ???????????? ??????????.',
                'password.min' => '?????? ???????? ???????????? ?????? ?????????? 6 ???????? .',

            ];
        } else {
            return [];
        }
    }


}
