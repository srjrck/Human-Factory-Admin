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

class IdentifierController extends Controller 
{
	public function __construct(Request $request)
	{		
	
	}

	public function Identifier()
	{
		$Data['Identifier'] 	= DB::table('identifier')->orderBy('id','DESC')->get();
		$Data['Title'] 		= 'Identifier';
		$Data['Menu'] 		= 'Identifier';
		$Data['SubMenu'] 	= '';
		return View('Admin/Identifier/List')->with($Data);
	}

	public function Add()
	{
		$Data['ResourceList'] 	= DB::table('resource')->get();
		$Data['Title'] 		= 'Identifier';
		$Data['Menu'] 		= 'Identifier';
		$Data['SubMenu'] 	= '';
		return View('Admin/Identifier/Add')->with($Data);
	}
	public function Save(Request $request){
		$Data = $request->all();
		$Save['resource_id'] = $Data['resource_id'];
		$Save['type'] = $Data['type'];
		$Save['value'] = $Data['value'];
		$Save['entry_by'] = 0;
		$Save['is_removed'] = 'false';
		$Save['created_at'] = date('Y-m-d H:i:s');
		DB::table('identifier')->insert($Save);
		$msg = Common::AlertErrorMsg('Success','Save Successfully');
		Session::flash('message', $msg); 
		return Redirect()->back();
	}
	public function Edit($ID){
		$id = base64_decode($ID);
		$Row = DB::table('identifier')->where('id',$id)->first();
		$Data['ResourceList'] 	= DB::table('resource')->get();
		$Data['row'] 			= $Row;
		$Data['Title'] 		= 'Identifier';
		$Data['Menu'] 		= 'Identifier';
		$Data['SubMenu'] 	= '';
		return View('Admin/Identifier/Edit')->with($Data);
	}
	public function SaveData(Request $request){
		$Data = $request->all();

		$edit_id = $Data['edit_id'];
		$Save['resource_id'] = $Data['resource_id'];
		$Save['type'] = $Data['type'];
		$Save['value'] = $Data['value'];
		DB::table('identifier')->where('id',$edit_id)->update($Save);
		$msg = Common::AlertErrorMsg('Success','Save Successfully');
		Session::flash('message', $msg); 
		return Redirect()->back();
	}
	public function Delete($ID){
		$id = base64_decode($ID);
		DB::table('identifier')->where('id',$id)->delete();
		$msg = Common::AlertErrorMsg('Success','Delete Successfully');
		Session::flash('message', $msg); 
		return Redirect()->back();
	}
}