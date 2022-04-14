<?php

namespace App\Http\Controllers;

use App\Language;
use App\ProductRequest;
use App\Products;
use App\ProductsReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function my_request()
    {
        return view('my_request');
    }

    public function home_update(Request $request)
    {
        $user = Auth::user();
        $email = $user->email;
        $img = null;
        $pass = null;
        if($request->password != null){
            $pass = 1;
        }
        if($request->hasFile('avatar')){
            $img = 1;
        }
        $validation = Validator::make($request->all(), $this->rules($img,$pass));
        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()]);
        } else {
            $user->name = Input::get('name');
            if(Input::hasFile('avatar')){
                //Remove Old
                if($user->avatar != 'no.png'){
                    if(file_exists(public_path($user->avatar))){
                        unlink(public_path($user->avatar));
                    }
                }
                //Save avatar
                $user->avatar = parent::upladImage(Input::file('avatar'),'avatar');
            }
            $user->update();
            return response()->json(['success'=>__('language.msg.m'),'redirect' =>route('home')]);
        }
        return view('home');
    }

    public function rules($img = null,$password = null){
        $x = [
            'name' => 'required|string|max:255',
            //'email' => 'required|string|email|max:255|unique:users,email,'.parent::CurrentID(),
        ];
        if($img != null){
            $x['avatar'] = 'required|mimes:png,jpg,jpeg';
        }
        if($password != null){
            $x['password'] = 'required|string|min:6|confirmed';
        }
        return $x;
    }

    function my_request_get_data(Request $request)
    {
        $columns = array(
            0 =>'id',
            1 =>'f_name',
            2 =>'email',
            3 =>'phone',
            4 =>'products_id',
            5 =>'id',
        );

        $totalData = ProductRequest::where('user_id', '=',parent::CurrentID())->count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $search = $request->input('search.value');

        $posts =  ProductRequest::
            where(function ($q) use ($search) {
                $q->orWhere('f_name', 'like', "%{$search}%");
                $q->orWhere('email', 'like', "%{$search}%");
                $q->orWhere('phone', 'like', "%{$search}%");
                $q->orWhere('l_name', 'like', "%{$search}%");
            })
            ->where('user_id', '=',parent::CurrentID())
            ->offset($start)
            ->limit($limit)
            ->orderBy('id','desc')
            ->orderBy($order,$dir)
            ->get();

        if($search != null){
            $totalFiltered = ProductRequest::
                where(function ($q) use ($search) {
                    $q->orWhere('f_name', 'like', "%{$search}%");
                    $q->orWhere('email', 'like', "%{$search}%");
                    $q->orWhere('phone', 'like', "%{$search}%");
                    $q->orWhere('l_name', 'like', "%{$search}%");
                })
                ->where('user_id', '=',parent::CurrentID())
                ->count();
        }


        $data = array();
        if(!empty($posts))
        {
            $count = 1;
            foreach ($posts as $post)
            {

                $state = "";
                $link = null;
                $link_id = null;
                $state_btn = "";
                if($post->send == 0){
                    $state = "Send";
                    $state_btn = "primary";
                }
                if($post->send == 1){
                    $state = "On Progress";
                    $state_btn = "warning";
                }
                else if($post->send == 2){
                    $state = "Finish - Review";
                    $state_btn = "success";
                    $link = $post->id;
                    $link_id = "btn_review";
                }

                $por = route('product',[app()->getLocale(),'id'=>$post->Products->id,'name'=>$post->Products->name]);

                $nestedData['id'] = $count;
                $nestedData['f_name'] = $post->f_name .' '. $post->l_name;
                $nestedData['email'] = $post->email;
                $nestedData['phone'] = $post->phone;
                $nestedData['products_id'] = "<a href='$por' target='_blank'>{$post->Products->name}</a>";
                $nestedData['options'] = "<a style='color: #fff' data-id='$link' class='$link_id btn btn-$state_btn'>$state</a>";
                $data[] = $nestedData;
                $count = $count + 1;

            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }

    public function my_request_rating(Request $request)
    {
        $edit = $request->products_id_rating;
        $validation = Validator::make($request->all(), $this->rules32());
        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()]);
        } else {
            $Post = Products::where('id', '=', $edit)->first();
            if($Post == null){
                return response()->json(['error'=> 'Has Error']);
            }
            $Post_2_Ch = ProductsReview::where('user_id', '=',parent::CurrentID())->where('products_id', '=',$edit)->first();
            if($Post_2_Ch == null){
                $Post_2 = new ProductsReview();
                $Post_2->star = $request->rating;
                $Post_2->user_id = parent::CurrentID();
                $Post_2->text = $request->text;
                $Post_2->products_id = $request->products_id_rating;
                $Post_2->save();
                return response()->json(['success'=>__('language.msg.s')]);
            }
            else{
                return response()->json(['error'=>'Already Review IT']);
            }
        }
    }

    private function rules32($edit = null)
    {
        $x = [
            'rating' => 'required|numeric|between:1,5',
            'products_id_rating' => 'required|numeric',
            'text' => 'required|string',
        ];
        return $x;
    }



}
