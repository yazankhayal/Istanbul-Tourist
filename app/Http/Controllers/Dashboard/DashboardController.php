<?php

namespace App\Http\Controllers\Dashboard;

use App\ContactUS;
use App\CurrencyConversions;
use App\Language;
use App\ServicesRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }


    public function send_email()
    {
        return view('dashboard.send_email');
    }

    public function send_email_send(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|min:1',
            'name_temp' => 'required|string|min:1',
            'email' => 'required|email|string|min:1',
            'summary' => 'required|string|min:1',
        ]);
        if ($validation->fails())
        {
            return response()->json(['errors'=>$validation->errors()]);
        }
        else{
            parent::send_Email_template($request->name_temp,$request->name,$request->email,$request->summary);
            return response()->json(['success' => parent::CurrentLangShow()->Send_Email, 'dashboard' => '1']);
        }
    }

    function request_products(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'address',
            3 => 'phone',
            4 => 'id',
        );

        $totalData = ProductRequest::where("send","!=","3")->count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $search = $request->input('search.value');

        $posts = ProductRequest::
            where(function ($q) use ($search) {
                $q->Where('f_name', 'LIKE', "%{$search}%");
                $q->orWhere('l_name', 'like', "%{$search}%");
                $q->orWhere('address', 'like', "%{$search}%");
                $q->orWhere('phone', 'like', "%{$search}%");
            })
            ->offset($start)
            ->limit($limit)
            ->orderBy('id', 'desc')
            ->orderBy($order, $dir)
            ->where("send","!=","3")
            ->get();

        if ($search != null) {
            $totalFiltered = ProductRequest::
                where(function ($q) use ($search) {
                    $q->Where('f_name', 'LIKE', "%{$search}%");
                    $q->orWhere('l_name', 'like', "%{$search}%");
                    $q->orWhere('address', 'like', "%{$search}%");
                    $q->orWhere('phone', 'like', "%{$search}%");
                })
                ->where("send","!=","3")
                ->count();
        }


        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $s = "<a class='btn btn-warning btn_edit_current btn-sm' data-id='{$post->id}' title='edit' ><span class='color_wi fa fa-edit'></span></a>";
                $r = "<a class='btn btn-success btn_eye btn-sm' data-id='{$post->id}' title='عرض' ><span class='color_wi fa fa-eye'></span></a>";
                $ty = $post->send;
                $st_1 = '<span class="badge badge-primary">New</span>';
                if ($ty == 2) {
                    $st_1 = '<span class="badge badge-warning">On Progress</span>';
                } else if ($ty == 3) {
                    $s = null;
                    $r = null;
                    $st_1 = '<span class="badge badge-primary">Finish</span>';
                }
                $nestedData['id'] = $post->id;
                $nestedData['name'] = $post->f_name . ' ' . $post->l_name;
                $nestedData['type'] = $st_1;
                $nestedData['address'] = $post->address;
                $nestedData['phone'] = $post->phone;
                $nestedData['options'] = "
                    $r . $s
                    <a class='btn_delete_current btn btn-danger btn-sm' data-id='{$post->id}' title='حذف' ><span class='color_wi fa fa-trash'></span></a>";
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

    function request_services(Request $request)
    {
        $columns = array(
            0 =>'id',
            1 =>'name',
            2 =>'address',
            3 =>'phone',
            4 =>'id',
        );

        $totalData = ServicesRequest::where("send","!=","3")->count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $search = $request->input('search.value');

        $posts =  ServicesRequest::
        where(function ($q) use ($search) {
            $q->Where('f_name', 'LIKE', "%{$search}%");
            $q->orWhere('l_name', 'like', "%{$search}%");
            $q->orWhere('address', 'like', "%{$search}%");
            $q->orWhere('phone', 'like', "%{$search}%");
        })
            ->where("send","!=","3")
            ->offset($start)
            ->limit($limit)
            ->orderBy('id','desc')
            ->orderBy($order,$dir)
            ->get();

        if($search != null){
            $totalFiltered = ServicesRequest::
            where(function ($q) use ($search) {
                $q->Where('f_name', 'LIKE', "%{$search}%");
                $q->orWhere('l_name', 'like', "%{$search}%");
                $q->orWhere('address', 'like', "%{$search}%");
                $q->orWhere('phone', 'like', "%{$search}%");
            })
                ->where("send","!=","3")
                ->count();
        }


        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {
                $s = "<a class='btn btn-warning btn_edit_current2 btn-sm' data-id='{$post->id}' title='edit' ><span class='color_wi fa fa-edit'></span></a>";

                $ty = $post->send;
                $st_1 = '<span class="badge badge-primary">New</span>';
                if($ty == 2){
                    $st_1 = '<span class="badge badge-warning">On Progress</span>';
                }
                else if($ty == 3){
                    $s = null;
                    $st_1 = '<span class="badge badge-primary">Finish</span>';
                }
                $nestedData['id'] = $post->id;
                $nestedData['name'] = $post->f_name .' '. $post->l_name;
                $nestedData['type'] = $st_1;
                $nestedData['address'] = $post->address;
                $nestedData['phone'] = $post->phone;
                $nestedData['options'] = "<a class='btn btn-success btn_eye2 btn-sm' data-id='{$post->id}' title='عرض' ><span class='color_wi fa fa-eye'></span></a>
                    $s
                    <a class='btn_delete_current2 btn btn-danger btn-sm' data-id='{$post->id}' title='حذف' ><span class='color_wi fa fa-trash'></span></a>";
                $data[] = $nestedData;

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

    function contact_us(Request $request)
    {
        $columns = array(
            0 =>'id',
            1 =>'name',
            2 =>'email',
            3 =>'phone',
            4 =>'id',
        );

        $totalData = ContactUS::count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $search = $request->input('search.value');

        $posts =  ContactUS::
        where(function ($q) use ($search) {
            $q->Where('f_name', 'LIKE', "%{$search}%");
            $q->orWhere('l_name', 'like', "%{$search}%");
            $q->orWhere('email', 'like', "%{$search}%");
            $q->orWhere('phone', 'like', "%{$search}%");
        })
            ->offset($start)
            ->limit($limit)
            ->orderBy('id','desc')
            ->orderBy($order,$dir)
            ->get();

        if($search != null){
            $totalFiltered = ContactUS::
            where(function ($q) use ($search) {
                $q->Where('f_name', 'LIKE', "%{$search}%");
                $q->orWhere('l_name', 'like', "%{$search}%");
                $q->orWhere('email', 'like', "%{$search}%");
                $q->orWhere('phone', 'like', "%{$search}%");
            })
                ->count();
        }


        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {
                $nestedData['id'] = $post->id;
                $nestedData['name'] = $post->f_name .' '. $post->l_name;
                $nestedData['email'] = $post->email;
                $nestedData['phone'] = $post->phone;
                $nestedData['options'] = "<a class='btn btn-success btn_eye3 btn-sm' data-id='{$post->id}' title='عرض' ><span class='color_wi fa fa-eye'></span></a>
                    <a class='btn_delete_current3 btn btn-danger btn-sm' data-id='{$post->id}' title='حذف' ><span class='color_wi fa fa-trash'></span></a>";
                $data[] = $nestedData;

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

    public function languages()
    {
        return response()->json(['data' => Language::get()]);
    }

    public function languages_exption_em()
    {
        return response()->json(['data' => Language::where('select', '!=', '1')->get()]);
    }
}
