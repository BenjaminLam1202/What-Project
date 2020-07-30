<?php

namespace App\Repositories\User;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Repositories\BaseRepository;
use App\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    /**
    * @var User
    */
    protected $model;

    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * [createAndGetID description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function createAndGetID($data)
    {
    	$user_id = DB::table('users')->insertGetId([
            'name'        => $data['name'],
            'email'       => $data['email'],
            'created_at'  => now(),
            'password'    => Hash::make($data['password']),
            ]);
        
        return $user_id;
    }

    /**
     * [sortWithFirstLetter description]
     * @param  [type] $num [description]
     * @return [type]      [description]
     */
    public function sortWithFirstLetter($num)
    {
        $users = DB::table('users')->where('email','like', $num.'%')->paginate(10);

        Session::put('usersexport', $num);

        return $users;
    }
}