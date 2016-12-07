<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;

class ContactController extends Controller {

	public function getIndex() {  //controller default method, but 'get' defines the route parameter
		return view('layout')->nest('content','pages.contact');
	}

	public function getMyDetails() { //uri is 'contact/my-details' via GET
		return 'My Contact Details...';
	}

	public function postCreate() { //uri is 'contact/my-details' via GET
		//return 'My Contact Details...';
		$data = request()->input();
		$validator = validator()->make($data,[
			'fname'=> ['required'],
			'lname'=> ['required'],
			'email'=> ['required'],
			'filefield' => ['required'],
			'password'=> ['required']
			]);
		//dd(Request::input('fname'));
		//dd(Request::has('phone'));
		if($validator->passes()) {
		app('db')->table('users')->insert([
		'fname' => request()->input('fname'),
		'lname' => request()->input('lname'),
		'email' => request()->input('email'),
		'photo' => request()->$file->getClientOriginalName(),
		'password' => request()->input('password')
		]);
		return 'added!';
	}

	return redirect()->back()->withErrors($validator->errors())->withInput();
	}
}