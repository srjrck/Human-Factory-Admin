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
		$Data['Result'] 	= DB::table('resource')->where('is_removed','false')->where('type','Practitioner')->get();
		$Data['Title'] 		= 'Practitioner';
		$Data['Menu'] 		= 'Practitioner';
		$Data['SubMenu'] 	= '';
		return View('Admin/Resource/Practitioner')->with($Data);
	}
	public function AddPractitioner()
	{
		$Data['Title'] 		= 'Add Practitioner';
		$Data['Menu'] 		= 'Practitioner';
		$Data['SubMenu'] 	= '';
		return View('Admin/Resource/AddPractitioner')->with($Data);
	}
	public function InsertPractitioner(Request $request){
		$Data = $request->all();

		$identifier[0]['value'] = $Data['identifier'];
		$identifier[0]['type'] = 'PRN';
		$identifier[1]['value'] = $Data['tax_code'];
		$identifier[1]['type'] = 'TAX';

		$telecom[0]['system'] = 'phone';
		$telecom[0]['value'] = $Data['phone'];
		$telecom[1]['system'] = 'email';
		$telecom[1]['value'] = $Data['email'];

		$name[0]['family'] = $Data['family'];
		$name[0]['given'] = $Data['given'];

		$fields['resourceType'] = 'Practitioner';
		$fields['identifier'] 	= $identifier;
		$fields['telecom'] 			= $telecom;
		$fields['name'] 				= $name;
		$fields_string = json_encode($fields);
		$response = Common::CurlAPI('POST','Practitioner',$fields_string);
		return $response;
	}
	public function CheckPractitioner($ID){
		$id = base64_decode($ID);
		$fields_string = json_encode([]);
		$URL = 'Practitioner/'.$id;
		$response = Common::CurlAPI('HEAD',$URL,$fields_string);
		echo $response;die;
		return $response;
	}
	public function DeletePractitioner($ID){
		$id = base64_decode($ID);
		$fields_string = json_encode([]);
		$URL = 'Practitioner/'.$id;
		$response = Common::CurlAPI('DELETE',$URL,$fields_string);
		Session::flash('message', $response); 
		return Redirect()->back();
	}

	public function ViewPractitioner($Id)
	{
		$id = base64_decode($Id);
		$Data['Result'] 	= DB::table('resource')->where('id',$id)->get();
		$Data['NameList'] = DB::table('name')->where('resource_id',$id)->get();
		$Data['IdentifierList'] = DB::table('identifier')->where('resource_id',$id)->get();
		$Data['TelecomList'] = DB::table('telecom')->where('resource_id',$id)->get();
		$Data['Title'] 		= 'Practitioner Details';
		$Data['Menu'] 		= 'Practitioner';
		$Data['SubMenu'] 	= '';
		return View('Admin/Resource/ViewPractitioner')->with($Data);
	}

	public function AddCareTeam()
	{
		$Data['Title'] 		= 'Add CareTeam';
		$Data['Menu'] 		= 'CareTeam';
		$Data['SubMenu'] 	= '';
		return View('Admin/Resource/AddCareTeam')->with($Data);
	}
	public function InsertCareTeam(Request $request){
		$Data = $request->all();

		$identifier[0]['value'] = $Data['identifier'];
		$identifier[0]['type'] = 'PRN';
		
		$telecom[0]['system'] = 'email';
		$telecom[0]['value'] = $Data['email'];
		
		$fields['resourceType'] = 'CareTeam';
		$fields['identifier'] 	= $identifier;
		$fields['telecom'] 			= $telecom;
		$fields['name'] 				= $Data['name'];
		$fields_string = json_encode($fields);
		$response = Common::CurlAPI('POST','CareTeam',$fields_string);
		return $response;
	}
	public function DeleteCareTeam($ID){
		$id = base64_decode($ID);
		$fields_string = json_encode([]);
		$URL = 'CareTeam/'.$id;
		$response = Common::CurlAPI('DELETE',$URL,$fields_string);
		Session::flash('message', $response); 
		return Redirect()->back();
	}
	public function CareTeam()
	{
		$Data['Result'] 	= DB::table('resource')->where('is_removed','false')->where('type','CareTeam')->get();
		$Data['Title'] 		= 'Care Team';
		$Data['Menu'] 		= 'CareTeam';
		$Data['SubMenu'] 	= '';
		return View('Admin/Resource/CareTeam')->with($Data);
	}

	public function ViewCareTeam($Id)
	{
		$id = base64_decode($Id);
		$Data['Result'] 	= DB::table('resource')->where('id',$id)->get();
		$Data['NameList'] = DB::table('name')->where('resource_id',$id)->get();
		$Data['IdentifierList'] = DB::table('identifier')->where('resource_id',$id)->get();
		$Data['TelecomList'] = DB::table('telecom')->where('resource_id',$id)->get();
		$Data['Title'] 		= 'CareTeam Details';
		$Data['Menu'] 		= 'CareTeam';
		$Data['SubMenu'] 	= '';
		return View('Admin/Resource/ViewCareTeam')->with($Data);
	}
}