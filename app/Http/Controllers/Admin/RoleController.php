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

class RoleController extends Controller 
{
	public function __construct(Request $request)
	{		
	
	}

	public function List()
	{
		$Data['Result'] 	= DB::table('role')->orderBy('id','DESC')->get();
		$Data['Title'] 		= 'Role';
		$Data['Menu'] 		= 'Role';
		$Data['SubMenu'] 	= '';
		return View('Admin/Role/List')->with($Data);
	}

	public function Add()
	{
		$Data['Title'] 		= 'Role';
		$Data['Menu'] 		= 'Role';
		$Data['SubMenu'] 	= '';
		return View('Admin/Role/Add')->with($Data);
	}
	public function Save(Request $request){
		$Data = $request->all();
		$Save['display'] = $Data['display'];
		$Save['system'] = $Data['system'];
		$Save['code'] = $Data['code'];
		$Save['add_date'] = date('Y-m-d H:i:s');
		DB::table('role')->insert($Save);
		$msg = Common::AlertErrorMsg('Success','Save Successfully');
		Session::flash('message', $msg); 
		return Redirect()->back();
	}
	public function Edit($ID){
		$id = base64_decode($ID);
		$Row = DB::table('role')->where('id',$id)->first();
		$Data['row'] 			= $Row;
		$Data['Title'] 		= 'Role';
		$Data['Menu'] 		= 'Role';
		$Data['SubMenu'] 	= '';
		return View('Admin/Role/Edit')->with($Data);
	}
	public function SaveData(Request $request){
		$Data = $request->all();

		$edit_id = $Data['edit_id'];
		$Save['display'] = $Data['display'];
		$Save['system'] = $Data['system'];
		$Save['code'] = $Data['code'];
		DB::table('role')->where('id',$edit_id)->update($Save);
		$msg = Common::AlertErrorMsg('Success','Save Successfully');
		Session::flash('message', $msg); 
		return Redirect()->back();
	}
}