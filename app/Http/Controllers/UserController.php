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

}
