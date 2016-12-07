<?php
//dd(env('APP_VERSION'));
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
	//nest embeds content like data array, 1st parameter is the end variable
    return view('layout')->nest('content','pages.home');
});

Route::get('/sample', function () {
	//nest embeds content like data array, 1st parameter is the end variable
    return '<h2>content from a sample route</h2>';
});

//Route::get('/', ['middleware'=>'password', function () {
 //   return view('welcome');
//}]);

//Route::get('/home', 'HomeController@home'); //controller@method

//maps ALL controller methods to URI by name
Route::controller('contact', 'Pages\ContactController');

Route::get('testing', function () {
    return "working!";
});

//? marks parameter as optional, be sure to give function a default value
Route::get('users/{name?}', function ($name='Rob') {
    return $name;
})->where('name','[a-zA-Z]+'); //regex in URI pattern


Route::get('redirect', function () {
    return redirect('done'); //a route not a view
});

Route::get('done', function () {
    return "redirected here!";
});


Route::get('json', function() {
	return Response::json(['name' => 'Rob', 'email' => 'rob@aol.com']);
});


//file handling routes
Route::get('download', function() {
	return Response::download(storage_path('files/samplefile.txt'));
});

//displays file in browser instead of downloading
Route::get('file', function() {
	return Response::file(storage_path('files/samplefile.txt'));
});

Route::get('upload', 'FileController@form');
Route::post('file/load', 'FileController@uploadFile');


//Database routes
Route::get('personnel', function () {
	//get() always returns array, first() returns 1 record without an enclosing array
    //$user = DB::table('tbl_users')->where('fname','Robert')->first();
    //$user = DB::table('users')->find(1); //uses id automatically!
    //also look at whereBetween method with get()
    //raw queries with select()
    $user = DB::select('SELECT * FROM users');
    dd($user);
    //return Response::json($user);

});

Route::get('create', function() {
	DB::table('users')->insert([
		'fname' => 'Sally',
		'lname' => 'Anderson',
		'email' => 'sally@aol.com',
		'password' => 'monkey99'
		]);
	return 'new user created';
});

Route::get('edit', function() {
	DB::table('users')->where('id',2)->update([
		'fname' => 'Joe',
		'lname' => 'Blow',
		'email' => 'joe@aol.com',
		'password' => 'monkey99'
		]);
	return 'user info edited';

	DB::table('users')->where('id', 2)->delete();
	//truncate() method deletes and resets IDs to 1 again
});


//email routes
Route::get('mail', function() {
	Mail::raw('just testing', function($message) {
		$message->subject('test')
				->to('rhaaf@fanshawec.ca')
				->from('rob@aol.com');
	});
	return 'email sent';
});

Route::get('mail/view', function() {
	Mail::send('emails.example', ['name' => 'Bob'], function($message) {
		$message->subject('test view')
				->to('rhaaf@fanshawec.ca')
				->from('rob@aol.com');
	});
	return 'email view sent';
});


//Session routes
Route::get('session', function() {
	Session::put('example','testvalue');
	Session::put('array',['one']);
	Session::push('array','two'); //existing array in session
	Session::flash('flashy','flashed');

	});

Route::get('session/read', function() {
	//Session::pull() gets the value and unsets it
	var_dump(Session::pull('example','default'));
	var_dump(Session::get('array'));
	var_dump(Session::get('flashy','nothing flashed'));
});


//form routes
Route::get('form', function() {
	return view('form');
});

Route::post('submitted', function() {
		//dd(Request::input());
		$data = Request::input();
		$validator = Validator::make($data,[
			'fname'=> ['required'],
			'lname'=> ['required'],
			'email'=> ['required']
			]);
		//dd(Request::input('fname'));
		//dd(Request::has('phone'));
		if($validator->passes()) {
		DB::table('tbl_users')->insert([
		'fname' => Request::input('fname'),
		'lname' => Request::input('lname'),
		'email' => Request::input('email')
		]);
		return 'added!';
	}

	return Redirect::back()->withErrors($validator->errors())->withInput();
});

Route::put('submitted', function() {
	return 'submitted by put';
});

Route::delete('submitted', function() {
	return 'submitted by delete';
});
Route::auth();

Route::get('/home', 'HomeController@index');
