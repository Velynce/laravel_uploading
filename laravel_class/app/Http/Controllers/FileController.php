<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class FileController extends Controller {

	public function form() { //controller default
		return view('upload');
	}

	public function uploadFile() {
		$file = request()->file('filefield');
		$file->move(__DIR__.'/storage', $file->getClientOriginalName());
		//insert into db.
		return 'uploaded!';
	}
}