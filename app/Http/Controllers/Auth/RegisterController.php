<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Wallet;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'state_code' => ['required', 'unique:profiles', 'max:9'],
            'cds_group' => ['required', 'not_in:*']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
        DB::beginTransaction();

        try{

            $user =  User::create([
                'name' => $data['state_code'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'status_id' => 1 //Active
            ]);
    
            $user->profile()->updateOrCreate([

                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'state_code' => $data['state_code'],
                'phone_number' => $data['phone_number'],
                'group_id' => $data['cds_group'],
                'state' => $data['state'],
                'lga' => $data['lga']
            ]);

            $user->attendance()->create([
                'profile_user_id' => $user->id,
            ]);
    
            $user->assignRole('Member');
        } 
        catch(\Exception $e) {

            DB::rollBack();

            return back()->withErrors($e);
        }

        DB::commit();
        
        return $user;
        
    }
}
