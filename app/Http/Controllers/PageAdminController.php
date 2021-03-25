<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddBannerRequest;
use App\Http\Requests\AddNewsRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\news;
use App\account;
use App\news_crawler;
use App\post;
use App\album;
use App\comment;
use App\like;
use App\Job;
use App\category_crawler;
use Session;
use App\Banner;
use Constants; 
use DB;
use Carbon\Carbon;
use Mail;


class PageAdminController extends Controller
{

    public function ListProject(Request $request)
    {
        if (Session::get('5fb77f190b788f0029513b14') == null)
        {
            return redirect()->route('admin-login');
        }
        else
        {
            $news = news::orderBy('created_at', 'DESC')->get();
            for ($i = 0; $i < count($news); $i++) {

                $news[$i]->news_image  = explode(',', $news[$i]->news_image);

            }
            for ($i = 0; $i < count($news); $i++) {

                $author = account::where('id', '=', $news[$i]->news_author)->get('username');

                $news[$i]->news_author = $author;
            }
            return view('Admin.project', compact('news'));
        }

    }

    public function overall()
    {
        if (Session::get('5fb77f190b788f0029513b14') == null) {
            return redirect()->route('admin-login');
        }
        $account = account::all();
        $quantity_user = count($account);
        $project = news::all();
        $quantity_pro = count($project);
        $news = news_crawler::all();
        $quantity_news = count($news);
        $posts = post::all();
        $quantity_post = count($posts);

        $project = DB::table('like')->selectRaw('id_news, count("id_account_like") as total')->groupBy('id_news')->orderBy('total', 'DESC')->limit(8)->get();
        
        for($i = 0; $i < count($project); $i++)
        {
            $data = news::where('id', $project[$i]->id_news)->first();
            if($data)
            {
                $data->news_image  = explode(',', $data->news_image);

                $author = account::where('id', $data->news_author)->get();

                $data->news_author = $author;
            }
            $project[$i]->id_news = $data;
        }


        $users = account::select(DB::raw("COUNT(*) as count"))
                        ->whereYear('created_at', date('Y'))
                        ->groupBy(DB::raw("Month(created_at)"))
                        ->pluck('count');
        
        $months = account::select(DB::raw("Month(created_at) as month"))
                        ->whereYear('created_at', date('Y'))
                        ->groupBy(DB::raw("Month(created_at)"))
                        ->pluck('month');
        $data = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($months as $index => $month)
        {
            $data[$month] = $users[$index];
        }


        $news = news::select(DB::raw("COUNT(*) as count"))
                        ->whereYear('created_at', date('Y'))
                        ->groupBy(DB::raw("Month(created_at)"))
                        ->pluck('count');
        
        $months = news::select(DB::raw("Month(created_at) as month"))
                        ->whereYear('created_at', date('Y'))
                        ->groupBy(DB::raw("Month(created_at)"))
                        ->pluck('month');
        $datanews = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($months as $index => $month)
        {
            $datanews[$month] = $news[$index];
        }

        $posts = news_crawler::select(DB::raw("COUNT(*) as count"))
                        ->whereYear('created_at', date('Y'))
                        ->groupBy(DB::raw("Month(created_at)"))
                        ->pluck('count');
        
        $months = news_crawler::select(DB::raw("Month(created_at) as month"))
                        ->whereYear('created_at', date('Y'))
                        ->groupBy(DB::raw("Month(created_at)"))
                        ->pluck('month');
        $datapost = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($months as $index => $month)
        {
            $datapost[$month] = $posts[$index];
        }

        return view('Admin.HomePages', compact('quantity_user', 'quantity_pro', 'quantity_news', 'quantity_post', 'project','data', 'datanews', 'datapost'));
    }

    public function detailProject($id)
    {
        if (Session::get('5fb77f190b788f0029513b14') == null)
        {
            return redirect()->route('admin-login');
        }
        else
        {
            $news = news::where('id',$id)->first();

            $news->news_image  = explode(',', $news->news_image);

            $author = account::where('id', '=', $news->news_author)->get();

            $news->news_author = $author;
            
            return view('Admin.DetailProject', compact('news'));
        }
    }

    public function ConfirmProject(Request $req, $id)
    {
        if (Session::get('5fb77f190b788f0029513b14') == null)
        {
            return redirect()->route('admin-login');
        }
        else
        {
            $news = news::find($id);
            $news->news_status = Constants::STATUS_POST_PUBLISHED;
            $user = account::where('id', $news->news_author)->first();
            $link = "http://".$_SERVER['HTTP_HOST']."/view-detail-project/".$id;
            $email = array('emailto' => $user->email, 'project' => $news, 'users' => $user, 'links' => $link);
            Mail::send(['html'=>'confirmProject'],$email, function($message) use ($email){
                $message->to(reset($email), '')->subject('Dự án'.' '.$email['project']->news_title.''.' đã được xác nhận thành công');
                $message->from('noreply.realestateapp@gmail.com', "noreply.realestateapp@gmail.com");
            });
            $news->save();
            return redirect()->back()->with(['flash_message'=>'Dự án được xác nhận thành công!']);
        }
    }

    public function DetailProjectMail($id)
    {
        $news = news::where('id',$id)->first();

        $news->news_image  = explode(',', $news->news_image);

        $author = account::where('id', '=', $news->news_author)->get();

        $news->news_author = $author;

        return view('Admin.DetailViewProject', compact('news'));
    }

    public function BanProject($id)
    {
        if (Session::get('5fb77f190b788f0029513b14') == null)
        {
            return redirect()->route('admin-login');
        }
        else
        {
            $news = news::find($id);
            $news->news_status = Constants::STATUS_POST_ALONE;
            $news->save();
            return redirect()->back()->with(['flash_message'=>'Dự án được hủy bỏ thành công!']);
        }
    }

    //JOB
    public function ListJob()
    {
        if (Session::get('5fb77f190b788f0029513b14') == null)
        {
            return redirect()->route('admin-login');
        }
        else
        {
            $job = Job::orderBy('created_at', 'DESC')->get();
            return view('Admin.ListallJob', compact('job'));
        }
    }

    public function ChangeStatusJob($id)
    {
        if (Session::get('5fb77f190b788f0029513b14') == null)
        {
            return redirect()->route('admin-login');
        }
        else
        {
            $job = Job::find($id);
            $job->status = !$job->status;
            $job->save();
            return redirect()->back()->with(['flash_message'=>'Thay đổi thành công!']);
        }
    }

    public function AddJob(Request $req)
    {
        if (Session::get('5fb77f190b788f0029513b14') == null)
        {
            return redirect()->route('admin-login');
        }
        else
        {
            $job = new Job;
            $job->job_name = $req->job_name;
            $job->save();
            return redirect()->back()->with(['flash_message'=>'Thêm mới thành công!']);
        }
    }

    public function DeleteJob(Request $req, $id)
    {
        if (Session::get('5fb77f190b788f0029513b14') == null)
        {
            return redirect()->route('admin-login');
        }
        else
        {
            $job = Job::find($id);
            $job->delete();
            return redirect()->back()->with(['flash_message'=>'Xóa bỏ thành công!']);
        }
    }

    //CUSTOMER
    public function ListAccount()
    {
        if (Session::get('5fb77f190b788f0029513b14') == null)
        {
            return redirect()->route('admin-login');
        }
        else
        {
            $users = account::orderBy('created_at', 'DESC')->get();
            return view('Admin.ListCustomer', compact('users'));
        }
    }

    public function detailCustomer($id)
    {
        if (Session::get('5fb77f190b788f0029513b14') == null)
        {
            return redirect()->route('admin-login');
        }
        else
        {
            $users = account::where('id',$id)->first();

            $job_name = Job::find($users->job_id);

            $users->job_id = $job_name;
            
            $news = news::where('news_author', $users->id)->get();
            
            for ($i = 0; $i < count($news); $i++) {

                $news[$i]->news_image  = explode(',', $news[$i]->news_image);

            }

            $post = post::where('post_author', $id)->paginate(8);

            for ($i = 0; $i < count($post); $i++) {
                $account = account::where('id', $post[$i]->post_author)->first();
                $post[$i]->post_author = $account;
            }
            for ($i = 0; $i < count($post); $i++) {

                $post[$i]->post_image  = explode(',', $post[$i]->post_image);

            }
            $arrayImage = [];
            $album = album::where('id_account', $id)->get();
            for ($i = 0; $i < count($album); $i++) {
                $album[$i]->album_avt = explode(',', $album[$i]->album_avt);
                for ($j = 0; $j < count($album[$i]->album_avt); $j++) {
                    array_push($arrayImage, $album[$i]->album_avt[$j]);
                }
                $album[$i]->album_cover = explode(',', $album[$i]->album_cover);
                for ($j = 0; $j < count($album[$i]->album_cover); $j++) {
                    array_push($arrayImage, $album[$i]->album_cover[$j]);
                }
            }
            $news_img = news::where('news_author', $id)->get('news_image');
            for ($i = 0; $i < count($news); $i++) {
                $news_img[$i]->news_image = explode(',', $news_img[$i]->news_image);
                for ($j = 0; $j < count($news_img[$i]->news_image); $j++) {
                    array_push($arrayImage, $news_img[$i]->news_image[$j]);
                }
            }
            $posts = post::where('post_author', $id)->get('post_image');
            for ($i = 0; $i < count($posts); $i++) {
                $posts[$i]->post_image = explode(',', $posts[$i]->post_image);
                for ($j = 0; $j < count($posts[$i]->post_image); $j++) {
                    array_push($arrayImage, $posts[$i]->post_image[$j]);
                }
            }
            return view('Admin.DetailCustomer', compact('users', 'news', 'post', 'arrayImage'));
        }
    }

    public function getDetailPost($id)
    {
        if (Session::get('5fb77f190b788f0029513b14') == null)
        {
            return redirect()->route('admin-login');
        }
        else
        {
            $posts = post::where('id', $id)->first();

            $posts->post_image  = explode(',', $posts->post_image);

            $account = account::where('id', $posts->post_author)->first();

            $posts->post_author = $account;

            $likes = like::where('id_post', $id)->count();

            return view('Admin.DetailPost', compact('posts', 'likes'));
        }
    }

    public function DeletePost($id)
    {
        if (Session::get('5fb77f190b788f0029513b14') == null)
        {
            return redirect()->route('admin-login');
        }
        else 
        {
            $post = post::find($id);

            $comment = comment::where('news_id', '=', $id)->get();

            if(count($comment) > 0)
            {
                for ($i = 0; $i < count($comment); $i++) {

                    $comment[$i]->delete();

                }
            }
            

            $like = like::where('id_news', '=', $id)->get();
            if(count($like) > 0)

            {
                for ($j = 0; $j < count($like); $j++) {

                    $like[$j]->delete();

                }
            }

            
            $post->delete();
            return redirect()->back()->with(['flash_message'=>'Bài đăng được xóa thành công!']);
        }
    }

    public function DeleteProject($id)
    {

        if (Session::get('5fb77f190b788f0029513b14') == null)
        {
            return redirect()->route('admin-login');
        }
        else 
        {


            $project = news::find($id);
            
            
            $comment = comment::where('news_id', '=', $id)->get();

            if(count($comment) > 0)
            {
                for ($i = 0; $i < count($comment); $i++) {

                    $comment[$i]->delete();

                }
            }
            

            $like = like::where('id_news', '=', $id)->get();
            if(count($like) > 0)

            {
                for ($j = 0; $j < count($like); $j++) {

                    $like[$j]->delete();

                }
            }

            

            $project->delete();
            return redirect()->back()->with(['flash_message'=>'Dự án được xóa thành công!']);
        }
    }

    public function DeleteAccount($id)
    {
        if (Session::get('5fb77f190b788f0029513b14') == null)
        {
            return redirect()->route('admin-login');
        }
        else
        {
            $account = account::find($id);
            $post = post::where('post_author', $id)->get();
            if(count($post) > 0)
            {
                foreach($post as $data)
                {
                    $posts = post::find($data->id);
                    $posts->delete();
                }
            }

            $news = news::where('news_author', $id)->get();
            if(count($news) > 0)
            {
                foreach($news as $data)
                {
                    $del_news = news::find($data->id);
                    $del_news->delete();
                }
            }

            $likes = like::where('id_account_like', $id)->get();
            if(count($likes) > 0)
            {
                foreach($likes as $data)
                {
                    $del_like = like::find($data->id);
                    $del_like->delete();
                }
            }

            $album = album::where('id_account', $id)->get();
            if(count($album) > 0)
            {
                foreach($album as $data)
                {
                    $del_album = album::find($data->id);
                    $del_album->delete();
                }
            }
            
            $account->delete();
            return redirect()->back()->with(['flash_message'=>'Xóa tài khoản thành công!']);
        }
    }

    public function GetAllNews()
    {
        if (Session::get('5fb77f190b788f0029513b14') == null)
        {
            return redirect()->route('admin-login');
        }
        else
        {
            $news = news_crawler::orderBy('created_at', 'DESC')->get();
            return view('Admin.News', compact('news'));
        }
    }

    public function DetailCategory($id)
    {
        if (Session::get('5fb77f190b788f0029513b14') == null)
        {
            return redirect()->route('admin-login');
        }
        else
        {
            $news = news_crawler::where('category_id', $id)->orderBy('created_at', 'DESC')->get();
            return view('Admin.News', compact('news'));
        }
    }

    public function getDetailNews($id)
    {
        if (Session::get('5fb77f190b788f0029513b14') == null)
        {
            return redirect()->route('admin-login');
        }
        else 
        {
            $news = news_crawler::where('id', $id)->first();
            return view('Admin.DetailNews', compact('news'));
        }
       
    }

    public function LoginView()
    {
        if (Session::get('5fb77f190b788f0029513b14') == null) {
            return view('Admin.Login');
        } else {
            return redirect()->route('statistical-admin');
        }
    }

    public function loginadmins(Request $req)
    {
            $credentials = [
                'email' => $req->input('email'),
                'password' => $req->input('passwords')
            ];
            
            #authentication
            if (!$token = auth('admin')->attempt($credentials))
            {
                return redirect()->route('admin-login')->with('error', 'Đăng nhập không thành công! Vui lòng đăng nhập lại!');
            }
            #Login success
            else {
                //dd(auth('admin')->user());
                if (Session::get('5fb77f190b788f0029513b14') == null) {
                    Session::push('5fb77f190b788f0029513b14', auth('admin')->user());
                    return redirect()->route('statistical-admin');
                } else {
                    return redirect()->route('statistical-admin');
                }
            }
    }

    public function Logout()
    {
        Session::forget('5fb77f190b788f0029513b14');
        return redirect()->route('admin-login');
    }

    public function viewAddNews()
    {
        if (Session::get('5fb77f190b788f0029513b14') == null) {
            return redirect()->route('admin-login');
        } 
        else 
        {
            $allCategories = category_crawler::all();
            return view('Admin.CreateNews', compact('allCategories'));
        }
    }

    public function AddCategory(Request $req)
    {
        $lst = $req->all();
        $data = new category_crawler;
        $data->category_name = $lst['category'];
        $data->save();
        return redirect()->route('category')->with(['flash_message'=>'Thêm mới thành công!']);
    }

    public function ViewCategory()
    {
        if (Session::get('5fb77f190b788f0029513b14') == null) {
            return redirect()->route('admin-login');
        } 
        else 
        {
            $allCategories = category_crawler::all();
            return view('Admin.Category', compact('allCategories'));
        }
    }

    public function UpdateCategory(Request $req, $id)
    {
        if (Session::get('5fb77f190b788f0029513b14') == null) {
            return redirect()->route('admin-login');
        } 
        else 
        {
            $lst = $req->all();
            $category = category_crawler::find($id);
            $category->category_name = $lst['category'];
            $category->save();
            return redirect()->route('category')->with(['flash_message'=>'Cập nhật thành công!']);
        }
    }

    public function DeleteCategory(Request $req, $id)
    {
        if (Session::get('5fb77f190b788f0029513b14') == null) {
            return redirect()->route('admin-login');
        } 
        else 
        {
            $category = category_crawler::find($id);

            $news = news_crawler::where('category_id', $category->id)->get();

            if(count($news) > 0)
            {
                foreach($news as $data)
                {
                   $data->delete();
                }
            }

            $category->delete();
            return redirect()->route('category')->with(['flash_message'=>'Xóa thể loại thành công!']);
        }
    }

    public function binCategory(){
        $Categorydelete = category_crawler::onlyTrashed()->get();
        return view('Admin.RestoreCategory', compact('Categorydelete'));
    }

    public function restoreCategory($id){
        category_crawler::onlyTrashed()->where('id',$id)->restore();

        $news = news_crawler::where('category_id', $id)->onlyTrashed()->get();
        
        if(count($news) > 0)
        {
            foreach($news as $data)
            {
                news_crawler::onlyTrashed()->where('id',$data->id)->restore();
            }
        }
        
        return redirect()->route('restore-category')->with(['flash_message'=>'Khôi phục thành công']);
    }

    public function SearchProject()
    {
        $lst = $_GET;
        if(array_key_exists('news_title', $lst) && $lst['news_title'] != null)
        {
            $news = news::where('news_title', 'like', "%".$lst['news_title']."%")->paginate(8); 
            if(!$news)
            {
                
                $alert='Không tìm thấy dự án!';

                return redirect()->back()->with('flash_message',$alert);

            }
            else 
            {
                for ($i = 0; $i < count($news); $i++) {

                    $news[$i]->news_image  = explode(',', $news[$i]->news_image);
    
                }
                for ($i = 0; $i < count($news); $i++) {
    
                    $author = account::where('id', '=', $news[$i]->news_author)->get('username');
    
                    $news[$i]->news_author = $author;
                }  
                return view('Admin.project', compact('news'));
            }
            
        }
        elseif(array_key_exists('name_customer', $lst) && $lst['name_customer'] != null)
        {
            $users = account::where('username', 'like', "%".$lst['name_customer']."%")->get(); 
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => trans('message.get_success'),
                'data' => $users
            ], 200);
            
            
        }
    }

    function generateRandomString($length = 10) {

        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $charactersLength = strlen($characters);

        $randomString = '';

        for ($i = 0; $i < $length; $i++) {

            $randomString .= $characters[rand(0, $charactersLength - 1)];

        }

        return $randomString;

    }

    public function AddNews(AddNewsRequest $req)
    {
        if (Session::get('5fb77f190b788f0029513b14') == null)
        {
            return redirect()->route('admin-login');
        }
        else
            {
                $lst = $req->all();
                $news = new news_crawler;
                $news->title = $lst['title'];
                $categories = category_crawler::where('category_name', $lst['category'])->first();
            if(!$categories)
            {
                $category = new category_crawler;
                $category->category_name = $lst['category'];
                $category->save();
            }
                $category_id = category_crawler::where('category_name', $lst['category'])->first();
                $news->category_id = $category_id->id;
                $news->short_content = $lst['short_content'];
                $news->content = $lst['editor'];
                $now = Carbon::now('Asia/Ho_Chi_Minh');
            if( array_key_exists('img_news', $lst) || $req->hasFile('img_news') != null )
            {
                $generateName = $this->generateRandomString();

                $now = Carbon::now();

                $photo_name = Carbon::parse($now)->format('YmdHis').$generateName.'.jpg';

                $path = $lst['img_news']->storeAs('./img_news/',$photo_name);//save img resize to image_avata

                $img_url = asset('/storage/img_news/'.$photo_name);

                $news->url_img = $img_url;
            }
                $news->post_date = $now->toDayDateTimeString();;
                $news->title_website = $lst['title'];
                $news->description = $lst['short_content'];
                $news->keyword = $lst['keywords'];
                $news->sort = $lst['title'];
                $news->active = 1;
                $news->post_author = $lst['post_author'];
                $news->post_source = $lst['post_source'];
                // $news->post_author_update = $lst['post_source'];
                // $news->post_author_delete = $author_post;
                $news->save();
            return redirect()->route('get-all-news');
        }
    }

    public function DelNews($id)
    {
        if (Session::get('5fb77f190b788f0029513b14') == null)
        {
            return redirect()->route('admin-login');
        }
        else
        {
            $news = news_crawler::find($id);
            $news->active = 0;
            $news->save();
            $news->delete();
            return redirect()->route('get-all-news');
        }
    }

    public function UpdateNews($id)
    {
        if (Session::get('5fb77f190b788f0029513b14') == null)
        {
            return redirect()->route('admin-login');
        }
        else
        {
            $news = news_crawler::find($id);
            $allCategories = category_crawler::all();
            return view('Admin.CreateNews', compact('news', 'allCategories'));
        }
    }

    public function update(Request $req, $id)
    {
        if (Session::get('5fb77f190b788f0029513b14') == null)
        {
            return redirect()->route('admin-login');
        }
        else
        {
            $news = news_crawler::find($id);
            $lst = $req->all();
            $news->title = $lst['title'];
            $categories = category_crawler::where('category_name', $lst['category'])->first();
            if(!$categories)
            {
                $category = new category_crawler;
                $category->category_name = $lst['category'];
                $category->save();
            }
            $category_id = category_crawler::where('category_name', $lst['category'])->first();
            $news->category_id = $category_id->id;
            $news->short_content = $lst['short_content'];
            $news->content = $lst['editor'];
            $now = Carbon::now('Asia/Ho_Chi_Minh');
            if( array_key_exists('img_news', $lst) || $req->hasFile('img_news') != null )
            {
                $generateName = $this->generateRandomString();

                $now = Carbon::now();

                $photo_name = Carbon::parse($now)->format('YmdHis').$generateName.'.jpg';

                $path = $lst['img_news']->storeAs('./img_news/',$photo_name);//save img resize to image_avata

                $img_url = asset('/storage/img_news/'.$photo_name);

                $news->url_img = $img_url;
            }
            $news->title_website = $lst['title'];
            $news->description = $lst['short_content'];
            $news->keyword = $lst['keywords'];
            $news->sort = $lst['title'];
            $news->active = 1;
            $news->post_author = $lst['post_author'];
            $news->post_source = $lst['post_source'];
            $news->post_author_update = $lst['post_author'];
            $news->save();
            return redirect()->route('get-all-news');
        }
    }

    public function getApartment()
    {
        if (Session::get('5fb77f190b788f0029513b14') == null)
        {
            return redirect()->route('admin-login');
        }
        else
        {
            $news = news::where('news_type', 'Căn hộ')->orderBy('created_at', 'DESC')->paginate(8);
            for ($i = 0; $i < count($news); $i++) {

                $news[$i]->news_image  = explode(',', $news[$i]->news_image);

            }
            for ($i = 0; $i < count($news); $i++) {

                $author = account::where('id', '=', $news[$i]->news_author)->get('username');

                $news[$i]->news_author = $author;
            }
            return view('Admin.project', compact('news'));
        }
    }

    public function getTheground()
    {
        if (Session::get('5fb77f190b788f0029513b14') == null)
        {
            return redirect()->route('admin-login');;
        }
        else
        {
            $news = news::where('news_type', 'Đất nền')->orderBy('created_at', 'DESC')->paginate(8);
                for ($i = 0; $i < count($news); $i++) {

                    $news[$i]->news_image  = explode(',', $news[$i]->news_image);

                }
                for ($i = 0; $i < count($news); $i++) {

                    $author = account::where('id', '=', $news[$i]->news_author)->get('username');

                    $news[$i]->news_author = $author;
                }
                return view('Admin.project', compact('news'));
        }
    }

    public function getTownhouse()
    {
        if (Session::get('5fb77f190b788f0029513b14') == null)
        {
            return redirect()->route('admin-login');
        }
        else
        {
            $news = news::where('news_type', 'Nhà phố')->orderBy('created_at', 'DESC')->paginate(8);
            for ($i = 0; $i < count($news); $i++) {

                $news[$i]->news_image  = explode(',', $news[$i]->news_image);

            }
            for ($i = 0; $i < count($news); $i++) {

                $author = account::where('id', '=', $news[$i]->news_author)->get('username');

                $news[$i]->news_author = $author;
            }
            return view('Admin.project', compact('news'));
        }
    }

    public function getVilla()
    {
        if (Session::get('5fb77f190b788f0029513b14') == null)
        {
            return redirect()->route('admin-login');
        }
        else
        {
            $news = news::where('news_type', 'Biệt thự')->orderBy('created_at', 'DESC')->paginate(8);
            for ($i = 0; $i < count($news); $i++) {

                $news[$i]->news_image  = explode(',', $news[$i]->news_image);

            }
            for ($i = 0; $i < count($news); $i++) {

                $author = account::where('id', '=', $news[$i]->news_author)->get('username');

                $news[$i]->news_author = $author;
            }
            return view('Admin.project', compact('news'));
        }
    }
    
    public function getallApartment()
    {
        if (Session::get('5fb77f190b788f0029513b14') == null)
        {
            return redirect()->route('admin-login');
        }
        else
        {
            $news = news::where('news_type', 'Chung cư')->orderBy('created_at', 'DESC')->paginate(8);
            for ($i = 0; $i < count($news); $i++) {

                $news[$i]->news_image  = explode(',', $news[$i]->news_image);

            }
            for ($i = 0; $i < count($news); $i++) {

                $author = account::where('id', '=', $news[$i]->news_author)->get('username');

                $news[$i]->news_author = $author;
            }
            return view('Admin.project', compact('news'));
        }
    }

    public function getMotel()
    {
        if (Session::get('5fb77f190b788f0029513b14') == null)
        {
            return redirect()->route('admin-login');
        }
        else
        {
            $news = news::where('news_type', 'Nhà trọ')->orderBy('created_at', 'DESC')->paginate(8);
            for ($i = 0; $i < count($news); $i++) {

                $news[$i]->news_image  = explode(',', $news[$i]->news_image);

            }
            for ($i = 0; $i < count($news); $i++) {

                $author = account::where('id', '=', $news[$i]->news_author)->get('username');

                $news[$i]->news_author = $author;
            }
            return view('Admin.project', compact('news'));
        }
    }
    
    public function getLease()
    {
        if (Session::get('5fb77f190b788f0029513b14') == null)
        {
            return redirect()->route('admin-login');
        }
        else
        {
            $news = news::where('news_type', 'Cho thuê')->orderBy('created_at', 'DESC')->paginate(8);
            for ($i = 0; $i < count($news); $i++) {

                $news[$i]->news_image  = explode(',', $news[$i]->news_image);

            }
            for ($i = 0; $i < count($news); $i++) {

                $author = account::where('id', '=', $news[$i]->news_author)->get('username');

                $news[$i]->news_author = $author;
            }
            return view('Admin.project', compact('news'));
        }
    }

    public function ViewBanner()
    {
        if (Session::get('5fb77f190b788f0029513b14') == null)
        {
            return redirect()->route('admin-login');
        }
        else
        {
            $banner = Banner::where('active', 1)->orderBy('created_at', 'DESC')->get();
            $allbanner = Banner::orderBy('created_at', 'DESC')->paginate(5);
            return view('Admin.Banner', compact('banner', 'allbanner'));
        }
    }

    public function ViewAddBanner()
    {
        if (Session::get('5fb77f190b788f0029513b14') == null)
        {
            return redirect()->route('admin-login');
        }
        else
        {
            return view('Admin.AddBanner');
        }
    }

    public function AddBanner(AddBannerRequest $req)
    {
        if (Session::get('5fb77f190b788f0029513b14') == null)
        {
            return redirect()->route('admin-login');
        }
        else
        {
            $lst = $req->all();
            $banner = new Banner();
           
            $banner->name = $lst['name'];

            $now = Carbon::now('Asia/Ho_Chi_Minh');
            if( array_key_exists('img_banner', $lst) || $req->hasFile('img_banner') != null )
            {
                $generateName = $this->generateRandomString();

                $now = Carbon::now();

                $photo_name = Carbon::parse($now)->format('YmdHis').$generateName.'.jpg';

                $path = $lst['img_banner']->storeAs('./img_banner/',$photo_name);//save img resize to image_avata

                $img_url = asset('/storage/img_banner/'.$photo_name);

                $banner->img_banner = $img_url;
            }

            $banner->active = 1;
            $banner->save();

            return redirect()->route('slideshow')->with(['flash_message'=>'Thêm thành công!']);
        }
    }
    
    public function HideBanner($id)
    {
        if (Session::get('5fb77f190b788f0029513b14') == null)
        {
            return redirect()->route('admin-login');
        }
        else
        {
            $banner = Banner::find($id);
            $banner->active = !$banner->active;
            $banner->save();
            return redirect()->route('slideshow');
        }
    }

    public function DelBanner($id)
    {
        if (Session::get('5fb77f190b788f0029513b14') == null)
        {
            return redirect()->route('admin-login');
        }
        else
        {
            $banner = Banner::find($id);
            $banner->delete();
            return redirect()->route('slideshow')->with(['flash_del_message'=>'Xóa thành công!']);
        }
    }

    public function Exception()
    {
        if (Session::get('5fb77f190b788f0029513b14') == null)
        {
            return redirect()->route('admin-login');
        }
        else
        {
            return view('Admin.Exception');
        }
    }
    
}
