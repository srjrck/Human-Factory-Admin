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

class NameController extends Controller 
{
	public function __construct(Request $request)
	{		
	
	}

	public function List()
	{
		$Data['Result'] 	= DB::table('name')->orderBy('id','DESC')->get();
		$Data['Title'] 		= 'Name';
		$Data['Menu'] 		= 'Name';
		$Data['SubMenu'] 	= '';
		return View('Admin/Name/List')->with($Data);
	}

	public function Add()
	{
		$Data['ResourceList'] 	= DB::table('resource')->get();
		$Data['Title'] 		= 'Name';
		$Data['Menu'] 		= 'Name';
		$Data['SubMenu'] 	= '';
		return View('Admin/Name/Add')->with($Data);
	}
	public function Save(Request $request){
		$Data = $request->all();
		$Save['resource_id'] = $Data['resource_id'];
		$Save['family'] = $Data['family'];
		$Save['given'] = $Data['given'];
		$Save['entry_by'] = 0;
		$Save['is_removed'] = 'false';
		$Save['created_at'] = date('Y-m-d H:i:s');
		DB::table('name')->insert($Save);
		$msg = Common::AlertErrorMsg('Success','Save Successfully');
		Session::flash('message', $msg); 
		return Redirect()->back();
	}
	public function Edit($ID){
		$id = base64_decode($ID);
		$Row = DB::table('name')->where('id',$id)->first();
		$Data['ResourceList'] 	= DB::table('resource')->get();
		$Data['row'] 			= $Row;
		$Data['Title'] 		= 'Name';
		$Data['Menu'] 		= 'Name';
		$Data['SubMenu'] 	= '';
		return View('Admin/Name/Edit')->with($Data);
	}
	public function SaveData(Request $request){
		$Data = $request->all();

		$edit_id = $Data['edit_id'];
		$Save['resource_id'] = $Data['resource_id'];
		$Save['family'] = $Data['family'];
		$Save['given'] = $Data['given'];
		DB::table('name')->where('id',$edit_id)->update($Save);
		$msg = Common::AlertErrorMsg('Success','Save Successfully');
		Session::flash('message', $msg); 
		return Redirect()->back();
	}
	public function Delete($ID){
		$id = base64_decode($ID);
		DB::table('name')->where('id',$id)->delete();
		$msg = Common::AlertErrorMsg('Success','Delete Successfully');
		Session::flash('message', $msg); 
		return Redirect()->back();
	}
}