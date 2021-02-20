<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Http\Resources\UserResource;
class UserController extends Controller
{
	public function index(){
		return view('firebase');
	}
	public function sendNotifications(){
		function test(){
			$token = "45|LvrPUqnHpMiwGjJXGwpHMOGzp1k7I6bKnohGRZSL";  
			$from = "AAAAUyMsf5o:APA91bESJLSyDnb50jKJ7V6NA9ojkboCb_Q31mQoS3FbjS2Maed4F0GfHSX9SGj-aN0SpG9rHJxKfW14XCCZIw1reyXfEM032KdZnx8ZNc5pBLZFq80WNG7qbQ_f8uK7ShSYy92PKQeI";

			$msg = array
				  (
					'body'  => "Testing Testing",
					'title' => "Hi, From Raj",
					'receiver' => 'erw',
					'icon'  => "https://image.flaticon.com/icons/png/512/270/270014.png",/*Default Icon*/
					'sound' => 'mySound'/*Default sound*/
				  );
	
			$fields = array
					(
						'to'        => $token,
						'notification'  => $msg
					);
	
			$headers = array
					(
						'Authorization: key=' . $from,
						'Content-Type: application/json'
					);
			//#Send Reponse To FireBase Server 
			$ch = curl_init();
			curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
			curl_setopt( $ch,CURLOPT_POST, true );
			curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
			curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
			curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
			curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
			$result = curl_exec($ch );
			dd($result);
			curl_close( $ch );
		}
	}

  ///////////////////////////////////////////////////////////////

  public function update(Request $request){
		$request->validate([
			'name'=>'required',
			'email'=>'required|email|unique:users,email,'.auth()->id()
		]);
		$user = User::find(auth()->id());
		$user->name = $request['name'];
		$user->email = $request['email'];
		$user->save();
		return new UserResource($user);

	}
  ////////////////////////////////////////////////////////////////////////////

  public function fcmToken(Request $request){

		$user = User::find(auth()->id());
		$user->update(['fcm_token'=>$request['fcm_token']]);

		return response()->json('fcm updated successfully',200);

	}
}
