<?php
namespace App\Http\Controllers\Admin;
use Route;
use Mail;
use Auth, Hash;
use Validator;
use Session;
use Redirect;
use DB;
use Crypt;
use Illuminate\Http\Request;
use Illuminate\Routing\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Helpers\Common;

class PractitionerController extends Controller 
{
	public function __construct(Request $request)
	{		
	
	}

	public function Practitioner()
	{
		$Data['Title'] 		= 'Practitioner';
		$Data['Menu'] 		= 'Practitioner';
		$Data['SubMenu'] 	= '';
		return View('Admin/Practitioner')->with($Data);
	}

	public function CareTeam()
	{
		$Data['Title'] 		= 'CareTeam';
		$Data['Menu'] 		= 'CareTeam';
		$Data['SubMenu'] 	= '';
		return View('Admin/CareTeam')->with($Data);
	}
}