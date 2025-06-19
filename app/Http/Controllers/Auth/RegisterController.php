<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Pipeline\Hub;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Generator\RandomGeneratorFactory;

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
    protected $redirectTo = RouteServiceProvider::LOGIN;

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
    public function showRegistrationForm()
    {
        $data['districts'] = District::orderBy('id', 'desc')->get();
        return view('auth.register', $data);
    }

    protected function validator(array $data)
    {
        if ($data['role_id'] == 2){
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone' => ['required', 'numeric', 'unique:users'],
                'phone2' => ['required', 'numeric', 'unique:hubs'],
                'address' => ['required', 'string'],
                'service_name' => ['required', 'string'],
                'license' => ['required', 'unique:hubs'],
                'identy_no' => ['required', 'unique:hubs'],
                'identy_image' => ['required', 'mimes:jpeg,png,jpg'],
                'role_id' => ['required'],
                'district_id' => ['required'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ]);
        }else{
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone' => ['required', 'digits:11', 'numeric', 'unique:users'],
                'address' => ['required', 'string'],
                'shop_name' => ['required', 'string'],
                'role_id' => ['required'],
                'district_id' => ['required'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ]);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if ($data['role_id'] == 2){
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'role_id' => $data['role_id'],
                'district_id' => $data['district_id'],
                'password' => Hash::make($data['password']),
            ]);
            $file = $data['identy_image'];
            $oriName = $file->getClientOriginalName();
            $filename = time().'.'.$oriName;
            $file->move('agent/', $filename);
            \App\Models\Hub::create([
                'user_id' => $user->id,
                'phone2' => $data['phone2'],
                'service_name' => $data['service_name'],
                'license' => $data['license'],
                'identy_no' => $data['identy_no'],
                'identy_image' => $filename,
            ]);
            return $user;
        }else{
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'shop_name' => $data['shop_name'],
                'address' => $data['address'],
                'role_id' => $data['role_id'],
                'district_id' => $data['district_id'],
                'password' => Hash::make($data['password']),
            ]);
        }
    }
}
