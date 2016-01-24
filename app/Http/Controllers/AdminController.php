<?php

namespace App\Http\Controllers;

use Validator;
use Redirect;
use Auth;
use Image;
use Hash;
use Response;
use View;
use App\User;
use App\Ticket;
use App\Setting;
use App\Event;
use App\Partner;
use App\Media;
use App\News;

use App\Http\Controllers\MediaController;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AdminController extends Controller
{
	/**
	 * Require authentication
	 */
	public function __construct(){
	    $this->middleware('auth');
	}

	public static function checkPrivilege( ){
		if( Auth::user()->is_admin ){
			return;
		} else{
			Redirect::back();
		}
	}

	public function index( ){

		$totalNumber = 5; // number of items to take for each section

		$data = [
			"events" 	=> Event::where('end_datetime', '>', date(time()) )->get()->take( $totalNumber ),
			"partners" 	=> Partner::all()->take( $totalNumber ),
			"news" 		=> News::all()->take( $totalNumber ),
			"media"		=> Media::where('processed', 0)->get()->take( $totalNumber )->chunk(3),
			"staffs"	=> User::where('is_staff', 1)->get()->take( $totalNumber ),

		];



		return View::make('admin.index')->with($data);
	}
}
