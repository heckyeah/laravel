<?php

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
    return view('welcome');
});

Route::get('about', function(){

	// Create some data
	$title = 'About Page TEST';
	$metaDesc = 'We have staff members';
	$staff = [
				['name'=>'Mel', 'age'=>31],
				['name'=>'Brian', 'age'=>14],
				['name'=>'Jake', 'age'=>34]
			];

	return view('about')->with([
		'title' => $title,
		'metaDesc' => $metaDesc,
		'staff' => $staff
	]);
});












