<?php

namespace App\Http\Requests;

class ExampleRequest extends Request {

	public function rules() {
		return [
		'fname' => ['required'],
		'lname' => ['required'],
		'email' => ['required']
		];
	}

	public function authorize() {
		return true;
	}


}