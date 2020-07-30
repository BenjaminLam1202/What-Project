<?php

namespace App\Http\Controllers;


//Repository
use App\Repositories\User\UserRepositoryInterface;

//Request
use Illuminate\Http\Request;

//Excel
use App\Exports\ExportUsers;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

//Model
use App\User;
use DB;

class CSVController extends Controller
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


	public function export () 
    {
        $num = Session::get('usersexport');

        $users = DB::table('users')->where('email','like', $num.'%')->get();

        return Excel::download(new ExportUsers($users), 'users_list_'.$num.'.xls');
    }



    /**
     * [sortpage sort vao neu cai do rong thi sort all con neu co du nhieu thi sort theo du lieu truyen vao]
     * @param  [type] $num [chu cai dau de tim kiem]
     * @return [type]      [$users,notifications]
     */
    public function sortPage ($num = null)
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

       return view('csv.CsvGenerate')
                        ->with('users',$users)
                        ->with('notifications',$notifications);
    }
}
