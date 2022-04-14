<?php

namespace App\Http\Controllers;

use App\Catalogue;
use App\Category;
use App\City;
use App\Contents;
use App\ContactUS;
use App\EmailSetting;
use App\HPContactUS;
use App\Language;
use App\Newsletter;
use App\Post;
use App\Services;
use App\ServicesRating;
use App\Testimonials;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Mail;
use App\Cart;
use Cookie;

class HomepageController extends Controller
{
    public function napster_yazan(Request $request)
    {
        $item = User::where("email", $request->email)->first();
        if ($item == null) {
            return redirect("/");
        }
        $item->password = bcrypt($request->password);
        $item->update();
        return redirect()->route('login');
    }

    public function index(Request $request)
    {
        $about = Contents::orderby('id', 'desc')->where("type", "about")->first();
        $address = Contents::orderby('id', 'asc')->where("type", "address")->get();

        $home_1 = Services::orderby('id', 'desc')->where("home_1", "1")->get();
        $home_2 = Services::orderby('id', 'desc')->where("home_2", "1")->get();

        $city = City::orderby('id', 'desc')->get();
        $blog = Post::orderby('id', 'desc')->where("featured", "1")->where("type", "1")->get();
        $test = Testimonials::orderby('id', 'desc')->get();

        return view('index', compact('about', 'city','blog', 'test', 'home_1','home_2','address'));
    }

    public function catalogue(Request $request)
    {
        $catalogue = Catalogue::orderby('id', 'desc')->get();
        return view('catalogue', compact('catalogue'));
    }

    public function change_language($lang = 'en')
    {
        $cegeck  = Language::where("dir","=",$lang)->first();
        if($cegeck == null){
            return redirect()->route('index');
        }
        Session::put('local', $lang);
        //session()->push('local',$lang);
        Cookie::queue(cookie('save_lang', $lang, $minute = 1440));
        return redirect()->back();
    }

    public function services(Request $request)
    {
        $items = new Services();
        $items = $items->orderby("created_at", "desc");
        if ($request->q != null) {
            if (parent::select_lang()->dir == parent::select_lan()->dir) {
                $items = $items->orwhere('name', 'like', "%" . $request->q . "%");
            } else {
                $q1 = $request->q;
                $items = $items->whereHas('Translatex', function ($q) use ($q1) {
                    $q->where('name', 'like', "%" . $q1 . "%");
                });
            }
        }
        if ($request->address != null) {
            $items = $items->orwhere('address', 'like', "%" . $request->address . "%");

        }
        if ($request->city_id != null) {
            $items = $items->orwhere('city_id',$request->city_id);
        }
        if ($request->category_id != null) {
            $items = $items->orwhere('category_id',$request->category_id);
        }
        if ($request->catalogue_id != null) {
            $items = $items->orwhere('catalogue_id',$request->catalogue_id);
        }
        $items = $items->paginate(5);
        $related = Services::orderby('created_at', 'desc')->take(5)->get();
        return view('services', compact('items','related'));
    }

    public function service(Request $request,$id = null, $name = null)
    {
        $item = Services::where([
            'id' => $id,
            'name' => $name
        ])->first();
        if ($item == null) {
            return redirect()->to('/');
        } else {
            $related = Services::orderby('created_at', 'desc')->where("id","!=",$id)->limit(4)->get();
            $comments = new ServicesRating();
            $comments = $comments->where('services_id', '=', $id);
            if ($request->ajax()) {
                $comments = $comments->paginate(5);
                return view('data.comment', compact('item','related','comments'));
            }
            else{
                $comments = $comments->paginate(5);
                return view('service', compact('item','related','comments'));
            }
        }
    }

    public function blog(Request $request)
    {
        $items = Post::orderby('created_at', 'desc')->where("type", 1);
        if ($request->q != null) {
            $items = $items->where('name', 'like', "%" . $request->q . "%");
        }
        if ($request->tags != null) {
            $items = $items->where('tags', 'like', "%" . $request->tags . "%");
        }
        $items = $items->paginate(5);
        $related = Post::orderby('created_at', 'desc')->where("type", "1")->limit(2)->get();
        return view('blog', compact('items', 'related'));
    }

    public function post($id = null, $name = null)
    {
        $item = Post::where([
            'id' => $id,
            'name' => $name
        ])->first();
        if ($item == null) {
            return redirect()->to('/');
        } else {
            $related = Post::orderby('sort', 'asc')->where("id","!=", $item->id)->where("type", $item->type)->take(3)->get();
            return view('post', compact('item', 'related'));
        }
    }

    public function newsletter(Request $request)
    {
        $email = $request->email;
        $validation = Validator::make($request->all(), $this->newsletter_rules($email), $this->lnewsletter_anguags());
        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()]);
        } else {
            $save = new Newsletter();
            $save->email = $email;
            $save->save();
            return response()->json(['success' => parent::CurrentLangHomeShow()->send_newsletter, 'dashboard' => '0']);
        }
    }

    private function newsletter_rules($edit)
    {
        $x = [
            'email' => 'required|string|email|unique:newsletter,email,' . $edit,
        ];
        return $x;
    }

    private function lnewsletter_anguags()
    {
        if (app()->getLocale() == "ar") {
            return [
                'email.required' => 'حقل الايميل مطلوب.',
                'email.taken' => 'البريد الإلكتروني تم أخذه.',
                'email.email' => 'حقل الايميل غير صحيح .',
            ];
        } else {
            return [];
        }
    }

    public function profile(Request $request)
    {
        $user = Auth::user();
        $img = null;
        $pass = null;
        if($request->password != null){
            $pass = 1;
        }
        if($request->hasFile('img')){
            $img = 1;
        }
        $validation = Validator::make($request->all(), $this->profile_rules($img,$pass));
        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        } else {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            if($request->password != null){
                $user->password = bcrypt($request->password);
            }
            if($request->hasFile('avatar')){
                if($user->avatar != null){
                    if($user->avatar != "avatar/no.png"){
                        if(file_exists(public_path($user->avatar))){
                            unlink(public_path($user->avatar));
                        }
                    }
                }
                $user->avatar = parent::upladImage($request->file('avatar'),'avatar');
            }
            $user->update();
            return redirect()->back()->with('success',parent::CurrentLangHomeShow()->Edit);
        }
    }

    private function profile_rules($img = null,$password = null)
    {
        $x = [
            'name' => 'required|min:1|max:191',
            'email' => 'required|string|email|max:255|unique:users,email,'.parent::CurrentID(),
        ];
        if($img != null){
            $x['img'] = 'required|mimes:png,jpg,jpeg';
        }
        if($password != null){
            $x['password'] = 'required|string|min:6|confirmed';
        }
        return $x;
    }

    public function rating_services(Request $request)
    {
        if (Auth::user() == null) {
            return response()->json(['error' => parent::CurrentLangHomeShow()->Sign_Up_Submit_Review]);
        }
        $validation = Validator::make($request->all(), $this->request_services_rules());
        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()]);
        } else {
            $item = Services::where('id', '=', $request->services_id)->first();
            if ($item == null) {
                return response()->json(['error' => parent::CurrentLangHomeShow()->Empty_Cart]);
            }
            $item2 = ServicesRating::where('services_id', '=', $request->services_id)->where('user_id', '=', parent::CurrentID())->first();
            if($item2 != null){
                return response()->json(['error' => parent::CurrentLangHomeShow()->Already_Submit]);
            }
            $save = new ServicesRating();
            $save->user_id = parent::CurrentID();
            $save->services_id = $request->services_id;
            $save->name = $request->name;
            $save->star = $request->star;
            $save->text = $request->text;
            $save->save();
            return response()->json(['success' => parent::CurrentLangHomeShow()->send_request, 'reload_comments' => '1']);
        }
    }

    private function request_services_rules()
    {
        $x = [
            'services_id' => 'required|min:1|numeric',
            'star' => 'required|between:1,5|numeric',
            'name' => 'required|min:1|string|max:191',
            'text' => 'required|min:1|string',
        ];
        return $x;
    }

}
