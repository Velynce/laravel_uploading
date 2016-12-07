<?php

namespace App\Http\Middleware;

use Closure; //include Laravel class for middelware passing
use Response; //format middleware response as an instance

class CheckQueryString {

public function __construct() {
	//inject dependencies here if needed
}

public function handle($request, Closure $next) {
	if($request->query('password')=='monkey') {
		$response = $next($request);
		//handle instance of response before returning
		$response->setContent('content overwritten');
		return $response;
		//return $next($request);
	}else{
		return Response::make('password was incorrect', 401);
	}

}


}