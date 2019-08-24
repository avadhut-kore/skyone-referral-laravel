<?php

namespace App\Http\Controllers;
use App\User;
use Input;
use Session;
use Validator;
use Hash;

use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;
    public function __construct(User $u) {
    	$this->user = $u;
    }

    public function getUsers(){
		$users = $this->user->get();
		
		$users_data = [];
		foreach($users as $key => $user) {
			array_push($users_data,[
				'id' => $user->id,
				'first_name' => $user->first_name,
				'last_name' => $user->last_name,
				'email' => $user->email,
				'city' => $user->city,
				'mobile_no' => $user->mobile_no,
				'profession' => $user->profession
			]);
		}

    	if($users->count() == 0) {
    		return response()->json([
				'status' => 'error',
				'code' => 400,
				'msg' => 'Users not found',
				'data' => [],
			],200);
    	}

    	return response()->json([
			'status' => 'success',
			'code' => 200,
			'msg' => 'Users found',
			'data' => $users_data
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
	    	$this->user->password = Hash::make($request->Input('password'));
	    	
	    	if(!$this->user->save()) {
	    		return response()->json([
	    			'status' => 'error',
	    			'code' => 404,
	    			'msg' => 'Error occurred while registration..!please try again',
	    			'data' => []
	    		],200);
	    	}

	    	return response()->json([
				'status' => 'success',
				'code' => 200,
				'msg' => 'User registered successfully',
				'data' => [
					'id' => $this->user->id,
					'first_name' => $this->user->first_name,
					'last_name' => $this->user->last_name,
					'email' => $this->user->email,
					'city' => $this->user->city,
					'mobile_no' => $this->user->mobile_no,
					'profession' => $this->user->profession
				]
			],200);
	 	}	
    }

    public function edit($id) {
    	$user = $this->user->where('id',$id)->first();

    	if($user->count() == 0) {
    		return response()->json([
				'status' => 'error',
				'code' => 400,
				'msg' => 'User not found',
				'data' => [],
			],200);
    	}

    	return response()->json([
			'status' => 'success',
			'code' => 200,
			'msg' => 'User found',
			'data' => [
				'id' => $user->id,
				'first_name' => $user->first_name,
				'last_name' => $user->last_name,
				'email' => $user->email,
				'city' => $user->city,
				'mobile_no' => $user->mobile_no,
				'profession' => $user->profession
			]
		],200);
    }

    public function update(Request $request) {
		$id = $request->Input('id');
    	$validator = Validator::make($request->all(), [
    		'first_name' => 'required|min:2',
    		'last_name' => 'required|min:2',
    		'email' => 'required|email|unique:users,id,'.$id,
    		'city' => 'required',
    		'mobile_no' => 'required|numeric|unique:users,id,'.$id,
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

	    	if(!$this->user->where('id',$id)->update($arr)) {
	    		return response()->json([
	    			'status' => 'error',
	    			'code' => 404,
	    			'msg' => 'Error occurred while updating user..!please try again',
	    			'data' => [],
	    		],200);
	    	}

	    	$user = $this->user->where('id',$id)->first();

	    	return response()->json([
				'status' => 'success',
				'code' => 200,
				'msg' => 'User updated successfully',
				'data' => [
					'id' => $user->id,
					'first_name' => $user->first_name,
					'last_name' => $user->last_name,
					'email' => $user->email,
					'city' => $user->city,
					'mobile_no' => $user->mobile_no,
					'profession' => $user->profession
				]
			],200);
	 	}
    }

	// Tempararly commented...will uncomment when it is required
    // public function destroy(Request $request) {
		
	// 	$id = $request->Input('id');
		
	// 	if(!$this->user->where('id',$id)->delete()) {
	// 		return response()->json([
	// 			'status' => 'error',
	// 			'code' => 404,
	// 			'msg' => 'Error occurred while deleting user..!please try again',
	// 			'data' => [],
	// 		],200);
	// 	}

	// 	return response()->json([
	// 		'status' => 'success',
	// 		'code' => 200,
	// 		'msg' => 'User deleted successfully'
	// 	],200);
	// }
	
	public function getUserDetails($id) {

        $user = $this->user->where('id',$id)->first();
        
        if($user->count() == 0) {
    		return response()->json([
				'status' => 'error',
				'code' => 400,
				'msg' => 'User not found',
				'data' => [],
			],200);
    	}

    	return response()->json([
			'status' => 'success',
			'code' => 200,
			'msg' => 'Data found',
			'data' => [
				'id' => $user->id,
				'first_name' => $user->first_name,
				'last_name' => $user->last_name,
				'email' => $user->email,
				'city' => $user->city,
				'mobile_no' => $user->mobile_no,
				'profession' => $user->profession
			]
		],200);
    }
}
