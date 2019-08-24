<?php

namespace App\Http\Controllers;
use App\User;
use Input;
use Session;
use Validator;

use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;
    public function __construct(User $u) {
    	$this->user = $u;
    }

    public function getUsers(){
    	$users = $this->user->get();
    	if($users->count() == 0) {
    		return response()->json([
				'status' => 'error',
				'code' => 400,
				'msg' => 'Users not found',
				'data' => $users,
			],200);
    	}

    	return response()->json([
			'status' => 'success',
			'code' => 200,
			'msg' => 'Users found',
			'data' => $users
		],200);
    }

    public function register(Request $request) {
 		
 		$validator = Validator::make($request->all(), [
    		'first_name' => 'required|min:2',
    		'last_name' => 'required|min:2',
    		'email' => 'required|email|unique:users',
    		'city' => 'required',
    		'mobile_no' => 'required|numeric',
    		'profession' => 'required',
    		'password' => 'required|min:6'
    	]);

    	if($validator->fails()) {
    		return response()->json([
    			'status' => 'error',
    			'code' => 400,
    			'msg' => 'validation errors occured',
    			'errors' => $validator->errors(),
    			'data' => []
    		],200);
    	}
	 	else {
	    	$this->user->first_name = $request->Input('first_name');
	    	$this->user->last_name = $request->Input('last_name');
	    	$this->user->email = $request->Input('email');
	    	$this->user->city = $request->Input('city');
	    	$this->user->mobile_no = $request->Input('mobile_no');
	    	$this->user->profession = $request->Input('profession');
	    	$this->user->password = dcrypt($request->Input('password'));
	    	
	    	if(!$this->user->save()) {
	    		return response()->json([
	    			'status' => 'error',
	    			'code' => 404,
	    			'msg' => 'Error occurred while registration..!please try again',
	    			'data' => [],
	    			'errors' => []
	    		],200);
	    	}

	    	return response()->json([
				'status' => 'success',
				'code' => 200,
				'msg' => 'User registered successfully',
				'data' => $this->user,
				'errors' => []
			],200);
	 	}	
    }

    public function edit(Request $request,$id) {
    	$user = $this->user->where('id',$id)->first();

    	if($user->count() == 0) {
    		return response()->json([
				'status' => 'error',
				'code' => 400,
				'msg' => 'User not found',
				'data' => $users,
			],200);
    	}

    	return response()->json([
			'status' => 'success',
			'code' => 200,
			'msg' => 'User found',
			'data' => $user
		],200);
    }

    public function update(Request $request) {

    	$validator = Validator::make($request->all(), [
    		'first_name' => 'required|min:2',
    		'last_name' => 'required|min:2',
    		'email' => 'required|email|unique:users',
    		'city' => 'required',
    		'mobile_no' => 'required|numeric|unique:users',
    		'profession' => 'required',
    	]);

    	if($validator->fails()) {
    		return response()->json([
    			'status' => 'error',
    			'code' => 400,
    			'msg' => 'validation errors occured',
    			'errors' => $validator->errors(),
    			'data' => []
    		],200);
    	}
	 	else {
	    	
	    	$arr = [
	    		'first_name' => $request->Input('first_name'),
		    	'last_name' => $request->Input('last_name'),
		    	'email' => $request->Input('email'),
		    	'city' => $request->Input('city'),
		    	'mobile_no' => $request->Input('mobile_no'),
		    	'profession' => $request->Input('profession')
	    	];
	    	
	    	if(!$this->user->save()) {
	    		return response()->json([
	    			'status' => 'error',
	    			'code' => 404,
	    			'msg' => 'Error occurred while registration..!please try again',
	    			'data' => [],
	    			'errors' => []
	    		],200);
	    	}

	    	return response()->json([
				'status' => 'success',
				'code' => 200,
				'msg' => 'User registered successfully',
				'data' => $this->user,
				'errors' => []
			],200);
	 	}
    }

    public function destroy(Request $request,$id) {
    	
    }

}
