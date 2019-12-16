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
	/*CareTeam*/
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
	public function AssignCareTeam($Id){
		$careteam_id = base64_decode($Id);
		$Data['Result'] 	= DB::table('assign')->where('careteam_id',$careteam_id)->get();
		$Data['careteam_id'] = $careteam_id;
		$Data['Title'] 		= 'CareTeam';
		$Data['Menu'] 		= 'CareTeam';
		$Data['SubMenu'] 	= '';
		return View('Admin/Resource/AssignCareTeam')->with($Data);
	}
	public function InsertAssign(Request $request){
		$Data = $request->all();

		$careteam_id = $Data['careteam_id'];
		$role_id = $Data['role_id'];
		$identifierData = DB::table('identifier')->where('type','PRN')->where('resource_id',$careteam_id)->first();

		$TelecomData = DB::table('telecom')->where('system','email')->where('resource_id',$careteam_id)->first();
		$RoleData = DB::table('role')->where('id',$role_id)->first();
		
		$identifier[0]['value'] = $identifierData->value;
		$identifier[0]['type'] = 'PRN';
		
		$telecom[0]['system'] = 'email';
		$telecom[0]['value'] = $TelecomData->value;
		
		$practitionerArr = $Data['practitioner_id'];
		$i=0;
		foreach ($practitionerArr as $practitioner_id) {
			$Coding[0]['coding'][0]['system'] = $RoleData->system;	
			$Coding[0]['coding'][0]['code'] = $RoleData->code;	
			$Coding[0]['coding'][0]['display'] = $RoleData->display;	

			$member = "{{base}}/{{path}}/Practitioner/".$practitioner_id;

			$participant[$i]['role'] = $Coding;
			$participant[$i]['member'] = [$member];

			$Assign['careteam_id'] 		= $careteam_id;
			$Assign['participant_id'] = $practitioner_id;
			$Assign['add_date'] 			= date('Y-m-d H:i:s');

			DB::table('assign')->insert($Assign);

			$i++;
		}
		
		$fields['resourceType'] = 'CareTeam';
		$fields['identifier'] 	= $identifier;
		$fields['telecom'] 			= $telecom;
		$fields['name'] 				= $identifierData->value;
		$fields['participant'] 	= $participant;
		$fields_string = json_encode($fields);
		$URL = 'CareTeam/'.$careteam_id;
		$response = Common::CurlAPI('PUT',$URL,$fields_string);
		//echo '<pre>';print_r($response);die;
		Session::flash('message', $response); 
		return Redirect()->back();
	}

	/*Encounter*/
	public function Encounter(){
		$Data['Result'] 	= DB::table('resource')->where('is_removed','false')->where('type','Encounter')->get();
		$Data['Title'] 		= 'Encounter';
		$Data['Menu'] 		= 'Encounter';
		$Data['SubMenu'] 	= '';
		return View('Admin/Resource/Encounter')->with($Data);
	}
	public function ViewEncounter($ID){
		$id = base64_decode($ID);
		$Data['Result'] 	= DB::table('resource')->where('id',$id)->first();
		$Data['Title'] 		= 'Encounter Details';
		$Data['Menu'] 		= 'Encounter';
		$Data['SubMenu'] 	= '';
		return View('Admin/Resource/ViewEncounter')->with($Data);
	}
	
	/*Patient*/
	public function Patient(){
		$Data['Result'] 	= DB::table('resource')->where('is_removed','false')->where('type','Patient')->get();
		$Data['Title'] 		= 'Patient';
		$Data['Menu'] 		= 'Patient';
		$Data['SubMenu'] 	= '';
		return View('Admin/Resource/Patient')->with($Data);
	}
	public function ViewPatient($ID){
		$id = base64_decode($ID);
		$Data['Result'] 	= DB::table('resource')->where('id',$id)->get();
		$Data['NameList'] = DB::table('name')->where('resource_id',$id)->get();
		$Data['IdentifierList'] = DB::table('identifier')->where('resource_id',$id)->get();
		$Data['TelecomList'] = DB::table('telecom')->where('resource_id',$id)->get();
		$Data['Title'] 		= 'Patient Details';
		$Data['Menu'] 		= 'Patient';
		$Data['SubMenu'] 	= '';
		return View('Admin/Resource/ViewPatient')->with($Data);
	}
	public function DeletePatient($ID){
		$id = base64_decode($ID);
		$fields_string = json_encode([]);
		$URL = 'Patient/'.$id;
		$response = Common::CurlAPI('DELETE',$URL,$fields_string);
		Session::flash('message', $response); 
		return Redirect()->back();
	}
}