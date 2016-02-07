<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Partner;
use Redirect;

use Auth;

class PartnersController extends Controller
{
	public function index(){
		$partners = Partner::orderBy('id', 'ASC')->get();
		return view('partners.index', ['partners' => $partners]);
	}

	public function show($id){
		$partner = Partner::findOrFail($id);
		return view('partners.show', compact('partner'));
	}

	public function create(){
		if(! Auth::check() || ! Auth::user()->is_admin ){
			return response(view('errors.403', ['error' => 'You do not have permission to edit partners.']), 403);
		}

		return view('partners.create');
	}

	public function store(){
		if(! Auth::check() || ! Auth::user()->is_admin ){
			return response(view('errors.403', ['error' => 'You do not have permission to edit partners.']), 403);
		}

		return view('partners.store');
	}

	public function edit(){
		if(! Auth::check() || ! Auth::user()->is_admin ){
			return response(view('errors.403', ['error' => 'You do not have permission to edit partners.']), 403);
		}


		return view('partners.edit');
	}

	public function update(){
		if(! Auth::check() || ! Auth::user()->is_admin ){
			return response(view('errors.403', ['error' => 'You do not have permission to edit partners.']), 403);
		}

		return view('partners.update');
	}

	/**
	 * @param  int 		$encryptedPartnerId	The encrypted value of the Partner ID to be destroyed
	 * @return Redirect 	Back to the previous page
	 */
	public function destroy( $encryptedPartnerID ){
		if(! Auth::check() || ! Auth::user()->is_admin ){
			return response( view('errors.403', ['error' => 'You do not have permission to edit partners']), 403 );
		}
		/*try {
		    $partnerID = Crypt::decrypt($encryptedPartnerID);
		} catch (Illuminate\Contracts\Encryption\DecryptException ) {
		    //
		}*/
		$partnerID = Crypt::decrypt($encryptedPartnerID);
		Partner::destroy($partnerID);
		return Redirect::back();
	}
}
