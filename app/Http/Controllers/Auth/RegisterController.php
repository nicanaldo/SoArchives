<?php

namespace App\Http\Controllers\Auth;

use App\Models\Course;
use App\Models\Seller;
use App\Models\Buyer;
use App\Models\UserType;
use App\Models\Admin;
use App\Models\User;
use App\Models\VerifyToken;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use Carbon\Carbon;
use Faker\Calculator\Ean;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Contracts\Session\Session;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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
        //Validator for User Table and for all user type
        $validator = Validator::make($data, [
            'FName' => ['required', 'string', 'max:255'],
            'LName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'regex:/[a-z]/', 'regex:/[0-9]/', 'confirmed'],            
        ]);

        // Validator if the user is seller
        if (isset($data['usertypes']) && $data['usertypes'] == 'seller') {
            $validator->sometimes('CourseID', ['required', 'numeric'], function ($input) {
                return true;
            });
    
            $validator->sometimes('StudentNo', ['required', 'numeric', 'digits:9'], function ($input) {
                return true;
            });
    
            $validator->sometimes('Birthdate', ['required', 'date', 'before_or_equal:' . Carbon::now()->subYears(13)->format('Y-m-d')], function ($input) {
                return true;
            });
    
            $validator->sometimes('Year', ['required'], function ($input) {
                return true;
            });
    
        }
    
        return $validator;
    }

    public function showSellerRegistrationForm(Request $request)
    {

        // For seller registration, set the user_type directly
        $request->merge(['usertypes' => 'seller']);

        // Retrieve courses or initialize to an empty array if not set
        $courses = Course::pluck('CourseName', 'CourseID')->toArray();
        return view('auth.registerseller', ['courses' => $courses]);
    }

    public function showBuyerRegistrationForm(Request $request)
    {
        // For buyer registration, set the user_type directly
        $request->merge(['usertypes' => 'buyer']);
        return view('auth.registerbuyer');
    }

    public function showAdminRegistrationForm(Request $request)
    {
        // For admin registration, set the user_type directly
        $request->merge(['usertypes' => 'admin']);
        return view('auth.registeradmin');
    }

    public function registerSeller(Request $request)
    {
        // For seller registration, set the user_type directly
        $request->merge(['usertypes' => 'seller']);
        return $this->register($request, 'seller');
    }

    public function registerBuyer(Request $request)
    {
        // For buyer registration, set the user_type directly
        $request->merge(['usertypes' => 'buyer']);
        return $this->register($request, 'buyer');
    }

    public function registerAdmin(Request $request)
    {
        // For admin registration, set the user_type directly
        $request->merge(['usertypes' => 'admin']);
        return $this->register($request, 'admin');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all(), $request)));

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data, Request $request)
    {

        // // Validate the request data
        // $validator = $this->validator($data);

        // if ($validator->fails()) {
        //     // If validation fails, redirect back with errors
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        // Determine the UserTypeID based on the user_type
        $userTypeID = $data['usertypes'] == 'seller' ? 2 : ($data['usertypes'] == 'admin' ? 1 : 3);

        // Create user record
        $user = User::create([
            'fname'=>$data['FName'],
            'lname'=>$data['LName'],
            'email'=>$data['email'],
            'password'=> Hash::make($data['password']),
            'usertypeID' => $userTypeID,
            
        ]);

        if ($user) {
            
            // User record created successfully, proceed to create specific user type record
            if ($data['usertypes'] == 'seller') {

                $specificUser = Seller::create([
                    'UserID_Fk' => $user->id,
                    'Course' => $data['CourseID'],
                    'StudentNo' => $data['StudentNo'],
                    'Birthdate' => $data['Birthdate'],
                    'Year' => $data['Year']
                    // Fill other fields as needed
                ]);
            }  elseif ($data['usertypes'] == 'buyer') {
                $specificUser = Buyer::create([
                    'UserID_Fk' => $user->id,
                ]);
            } else {
                // Create admin record
                $specificUser = Admin::create([
                    'UserID_Fk' => $user->id,
                    // Add other admin-specific fields if needed
                ]);
            }

            if ($specificUser) {
                // Handle success scenario (e.g., redirect, display success message, etc.)

                // Generate and save the token
                $validToken = rand(10, 100) . '2022';
                $get_token = new VerifyToken();
                $get_token->token = $validToken;
                $get_token->email = $data['email'];
                $get_token->save();

                // Send welcome email
                $get_user_email = $data['email'];
                $get_f_name = $data['FName'];
                $get_l_name = $data['LName'];
                Mail::to($data['email'])->send(new WelcomeMail($get_user_email, $validToken, $get_f_name, $get_l_name));

                return $user;
            } else {
                // Error creating specific user type record
                // Handle error scenario (e.g., rollback User creation, display error message, etc.)
                $user->delete(); // Rollback user creation
                return back()->withInput()->withErrors(['error' => 'Error creating specific user type record']);
            }
        } else {
            // Error creating User record
            // Handle error scenario (e.g., display error message, etc.)
            return back()->withInput()->withErrors(['error' => 'Error creating User record']);
        }

    }
}

?>

