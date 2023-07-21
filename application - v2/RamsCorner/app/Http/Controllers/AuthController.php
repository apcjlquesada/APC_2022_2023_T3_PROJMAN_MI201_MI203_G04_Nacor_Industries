<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Reporter;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
class AuthController extends Controller
{
    public function loginPage()
    {
        $user_id = Auth::user();
        // dd($user_id);
        if($user_id == null){
            return view('login');
        }


        $user_info = DB::table('reporters')->where("u_id", $user_id->u_ID)->first();
        // dd($user_info);
        if ($user_info->u_role == 'Admin'){
            return redirect()->route('adminHome');
        }else if ($user_info->u_role == 'Staff') {
            return redirect()->route('staffHome');
        }else{

            return redirect()->route('clientHome');
        }
    }

    public function signout(Request $request)
    {


        $redirect = Auth::user()->u_role;
        auth()->guest();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('loginPage');
    }

    public function dataPrivacy(){

    }
    public function loginUser(Request $request )
    {
        try {
            // dd($request);
            $validateUser = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]
            );

            if ($validateUser->fails()) {
                response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if (!Auth::attempt($request->only(['email', 'password']))) {

                response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
                Alert::error('Oops!', 'Wrong email or Password');
                return redirect()->route('loginPage');

            }

            $user = Reporter::where('email', $request->email)->first();
            if ($user->u_role == 'Admin') {
                response()->json([
                    'status' => true,
                    'message' => 'User Logged In Successfully',
                    'token' => $user->createToken("API TOKEN")->plainTextToken
                ], 200);
                Alert::toast('Login Succcess!', 'success');
                return redirect()->route('adminHome');
                // dd($user);


            }else if ($user->u_role == 'Staff') {
                response()->json([
                    'status' => true,
                    'message' => 'User Logged In Successfully',
                    'token' => $user->createToken("API TOKEN")->plainTextToken
                ], 200);
                Alert::toast('Login Success!', 'success');
                return redirect()->route('staffHome');

            }else{
                response()->json([
                    'status' => true,
                    'message' => 'User Logged In Successfully',
                    'token' => $user->createToken("API TOKEN")->plainTextToken
                ], 200);
                // dd($user->u_role. $user->u_fname. $user->u_lname
                Alert::toast('Login Succcess!', 'success');
                return redirect()->route('clientHome');

            }
            // response()->json([
            //     'status' => true,
            //     'message' => 'User Logged In Successfully',
            //     'token' => $user->createToken("API TOKEN")->plainTextToken
            // ], 200);


        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
