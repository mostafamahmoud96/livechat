<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Firebase\Auth\Token\Exception\InvalidToken;

class ApiAuthController extends Controller
{
    public function register(Request $request)
    {
        validator($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ])->validate();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'fcm_token' => $request->fcm_token,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('secret')->plainTextToken;

        return response(['token' => $token], 200);
	}
        public function login(Request $request){
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:6|',
            ]);
            if ($validator->fails())
            {
                return response(['errors'=>$validator->errors()->all()], 422);
            }

            if (Auth::attempt($request->only(['email', 'password']))) {
                $user = $request->user();
                $token = $user->createToken('secret')->plainTextToken;
                $response = ['token' => $token, 'user' => $user];
                return response($response, 200);

            } else {
                $response = ["message" =>'User does not exist'];
                return response($response, 422);

            }
            // $user = User::where('email', $request->email)->first();
            // if ($user) {
            //     if (Hash::check($request->password, $user->password)) {
            //         $token = $user->createToken('Laravel Password Grant Client')->accessToken;
            //         $response = ['token' => $token, 'user' => $request->user()];
            //         return response($response, 200);
            //     }
            // } else {
            //     $response = ["message" =>'User does not exist'];
            //     return response($response, 422);
            // }
        
}
function logout(Request $request){

   $user=request()->user();
   $user->tokens()->where('id',$user->currentAccessToken()->id)->delete();
    return "success";
}

}


