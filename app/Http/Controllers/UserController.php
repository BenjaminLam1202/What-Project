<?php

namespace App\Http\Controllers;

//Repository
use App\Repositories\User\UserRepositoryInterface;

//Request
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\ImageRequest;

//Model Eloquent
use App\User;
use Auth;

//File system
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

//Helper && Facades
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Cache;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

//collection
use Illuminate\Support\LazyCollection;

//notifications
use App\Notifications\NewUserNotification;
use App\Notifications\UploadImageNotification;
use App\Notifications\RemoveUserNotification;
use Illuminate\Notifications\Notification;

//Job run queue
use App\Jobs\RunFactory;

class UserController extends Controller
{

	private $userRepository;

	/**
	 * [__construct description]
	 * @param UserRepository $userRepository [App\Repositories\UserRepository , middleware = auth]
	 */
    public function __construct (UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;

        $this->middleware('auth');
    }


    /**
     * [index description]
     * @return [type] [admin.manager + $users + $notifications]
     */
    public function index ($num = null)
    {
        //neu co gia tri $num va khong bi blank thi tim het du lieu bat dau bang chu $num truyen vao $user khong thi truyen tat ca vao user
        if ($num != NULL || $num != '') {

        $users = $this->userRepository->sortWithFirstLetter($num);

        } else {

       // $users = User::orderBy('name')->paginate(10);

       //collection eloquent cham qua :(( su dung DB cho le
       $users = DB::table('users')->orderBy('id', 'desc')->paginate(10); 

        }

        $notifications = DB::table('notifications')->get(); 

        return view('admin.manager')
                        ->with('users',$users)
                        ->with('notifications',$notifications);
    }


    /**
     * [userfun description]
     * @param  UserRequest $request [App\Http\Requests\UserRequest]
     * @return [type]               [back]
     */
    public function create (UserRequest $request)
    {
        $admin = auth()   -> user();

        $data  = $request -> all();

        $data?$this-> getModelAfterCreateRequest($data)
             :$this-> returnWithError($data);

        return redirect()->back();
    }


    /**
     * [delete description]
     * @param  [type] $user [param into 'admin/delete/{user}']
     * @return [type]       [back]
     */
    public function delete ($user)
    {
        $user = User::findOrFail($user);

        //doan nay de xem cai hinh do co tung ton tai khong neu co thi day no vao soft delete xong chay crontab moi 7 ngay de xoa luon di
        if(DB::table('users')->where([['id',$user->id],['photo1',null],['photo2',null]])->doesntExist() 
            && DB::table('users')->where([['id',$user->id],['photo1',''],['photo2','']])->doesntExist()) {

            $old_image         = User::findOrFail($user->id)->photo1;

            dd($old_image);

            $old_image_name    = str_replace('http://full.hilton.com/storage/uploads/', '', $old_image);

            $old_path          = "storage/uploads/".$old_image_name;

            $trunk_move        = Storage::putFileAs('public/softRemove',$old_path,$old_image_name);

            $deleteFromStorage = Storage::delete('public/uploads'.$old_image_name);

        }

        \Log::info('delete user id '.$user->id .' successfully');

        $user->notify(new RemoveUserNotification()); 

        $user->delete();

        return redirect()->back();
    }




    /**
     * [update description]
     * @param  ImageRequest $request [App\Http\Requests\ImageRequest]
     * @return [type]                [description]
     */
    public function update (ImageRequest $request)
    {
        $time = Carbon::now()->format('dhi');

        $data = $request->all();
        
        //trong data co du lieu khong && co file khong
        if ($data && $request->hasFile('file'))
        {

            //luu file vao xong lay data update vao
            $image     = $data['file'];

            $extension = $image->getClientOriginalExtension();

            $name      = $time.'-'.basename($image).'.'.$extension;

            $path      = Storage::putFileAs('public/uploads',$image,$image->hashName());

            $na        = $image->hashName();

            $user      = User::findOrFail($data['id']);

            //doan nay de xem cai hinh do co tung ton tai khong neu co thi day no vao soft delete xong chay crontab moi 7 ngay de xoa luon di
            if (DB::table('users')->where([['id',$data['id']],['photo1',null],['photo2',null]])->doesntExist() 
                && DB::table('users')->where([['id',$data['id']],['photo1',''],['photo2','']])->doesntExist()) {

                $old_image         = User::findOrFail($data['id'])->photo1;

                $old_image_name    = str_replace('http://10.11.13.51/storage/uploads', '', $old_image);

                $old_path          = "storage/uploads".$old_image_name;

                $trunk_move        = Storage::putFileAs('public/softRemove',$old_path,$old_image_name);

                $deleteFromStorage = Storage::delete('public/uploads'.$old_image_name);

                \Log::info('Done remove old image');
            }

            //neu moi thu okay het thi update len he thong thoi
            User::where('id', $user->id)->update([

                //url vao photo1 base63 vao photo2
                'name'      =>  $data['name'],

                'address'   =>  $data['address'],

                'role_id'   => $data['role'],

                'photo1'    =>  asset('storage/uploads/'.$na),

                'photo2'    =>  base64_encode($data['file']),
            ]);

            \Log::info('update successfully with image');

            $user_this      =   User::find($data['id']);

            $user_this      ->  notify(new UploadImageNotification()); 

            //neu dung tra ve cai link hinh vao session sai bao loi
            $path?Session::flash('image_status','storage/uploads/'.$na):Session::flash('image_status', 'image uploaded fail!!');

            return redirect()-> back();

        //neu khong co hinh nhung co data thi cap nhat data vao
        } else if (!$request->hasFile('file') && $data) {

            $user = User::findOrFail($data['id']);

            //update du lieu vao nguoi dung theo id truyen vao 
            User::where('id', $user->id)->update([

                'name'      =>  $data['name'],

                'role_id'   => $data['role'],

                'address'   =>  $data['address'],
            ]);

            \Log::info('update successfully without image');

            $user      ->  notify(new UploadImageNotification()); 

            return redirect()->back();
            
        } else {

            \Log::error('cannot update');

            return $this->returnWithError($data);
        }

    }


     /**
     * [markread demo delete a single notification]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function markRead ($id)
    {   

        $noti = DB::table('notifications')->where('id',$id)->delete();

        return redirect()->back(); 

    }

    /**
     * [xoahet make every notification gone fast as yours ex turn over]
     * @return [type] [description]
     */
    public function markReadAll ()
    {

        $noti = DB::table('notifications')->truncate();

        return redirect()->back(); 

    }

    /**
     * [queueadduser do not click /admin/dispatch if you dont want to make thw queue run out of memories]
     * @return [type] [description]
     */
    public function queueAddUser ()
    {

        dispatch(new RunFactory())->onQueue('database');


        return $this->response200("adding database");
    }

    public function changeLanguage($language)
    {
        Session::put('website_language', $language);
        return redirect()->back();
    }




    /////////////////////////config/////////////////////////////////////////
    ///
    /**
     * @param  Request
     * @return response($key, 200)
     */
    public function response200 ($key)
    {
        
        return response($key, 200)
                  ->header('Content-Type', 'text/plain');
    }

    /**
     * [returnWithError description]
     * @param  [type] $data [data wanna show in the display]
     * @return [type]       [description]
     */
    public function returnWithError ($data)
    {

        \Log::error("cannoot add this user ".$user_this);

        return redirect()
                    ->back()
                    ->withErrors($data)
                    ->withInput();
    }


    /**
     * [getModelAfterCreateRequest description]
     * @param  [type] $data [data wanna show in the display]
     * @return [type]       [description]
     */
    public function getModelAfterCreateRequest ($data)
    {
        $user_id       = $this->userRepository->createAndGetID($data);

        $user_this     = User::find($user_id);

        $user_this->notify(new NewUserNotification());

        \Log::info("user has been added ".$user_this);
    }

 	/////////////////////////config/////////////////////////////////////////
}
