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
use App\Resource;

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
		//echo $response;die;
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

	/*CareTeam*/
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
	public function AssignCareTeam($Id){
		$careteam_id = base64_decode($Id);
		$Data['Result'] 	= DB::table('assign')->where('careteam_id',$careteam_id)->get();
		$Data['careteam_id'] = $careteam_id;
		$Data['Title'] 		= 'CareTeam';
		$Data['Menu'] 		= 'CareTeam';
		$Data['SubMenu'] 	= '';
		return View('Admin/Resource/AssignCareTeam')->with($Data);
	}
	public function DeleteCareTeamAssign($ID){
		$id = base64_decode($ID);

		$Assign = DB::table('assign')->where('id',$id)->first();

		$practitioner_id = $Assign->participant_id;
		$careteam_id = $Assign->careteam_id;
		
		$identifierData = DB::table('identifier')->where('type','PRN')->where('resource_id',$practitioner_id)->first();

		$TelecomData = DB::table('telecom')->where('system','email')->where('resource_id',$practitioner_id)->first();
		
		$identifier[0]['value'] = $identifierData->value;
		$identifier[0]['type'] = 'PRN';
		
		$telecom[0]['system'] = 'email';
		$telecom[0]['value'] = $TelecomData->value;
		
		$i=0;
		$Coding = [];

		$participant['role'][0]['coding'] = $Coding;

		$member = "{{base}}/{{path}}/Practitioner/";
		$participant['member'] = [$member];
		
		$fields['resourceType'] = 'CareTeam';
		$fields['identifier'] 	= $identifier;
		$fields['telecom'] 			= $telecom;
		$fields['name'] 				= $identifierData->value;
		$fields['participant'] 	= $participant;
		$fields_string = json_encode($fields);
		//echo '<pre>';print_r($fields_string);die;
		$URL = 'CareTeam/'.$careteam_id;
		$response = Common::CurlAPI('PUT',$URL,$fields_string);
		//echo '<pre>';print_r($response);die;

		DB::table('assign')->where('id',$id)->delete();

		Session::flash('message', $response); 
		return Redirect()->back();
 	}
	public function InsertAssign(Request $request){
		$Data = $request->all();
		
		$practitioner_id = $Data['practitioner_id'];
		$careteam_id = $Data['careteam_id'];
		
		$identifierData = DB::table('identifier')->where('type','PRN')->where('resource_id',$practitioner_id)->first();

		$TelecomData = DB::table('telecom')->where('system','email')->where('resource_id',$practitioner_id)->first();
		
		$identifier[0]['value'] = $identifierData->value;
		$identifier[0]['type'] = 'PRN';
		
		$telecom[0]['system'] = 'email';
		$telecom[0]['value'] = $TelecomData->value;
		
		$RoleIdArr = $Data['role_id'];
		$i=0;
		$Coding = [];
		foreach ($RoleIdArr as $role) {

			$RoleData = DB::table('role')->where('id',$role)->first();

			$Coding[$i]['system'] = $RoleData->system;	
			$Coding[$i]['code'] = $RoleData->code;	
			$Coding[$i]['display'] = $RoleData->display;
			$i++;
		}

		$Assign['careteam_id'] 		= $careteam_id;
		$Assign['participant_id'] = $practitioner_id;
		$Assign['role_id'] 				= implode(',', $Data['role_id']);
		$Assign['add_date'] 			= date('Y-m-d H:i:s');
		DB::table('assign')->insert($Assign);

		$participant['role'][0]['coding'] = $Coding;

		$member = "{{base}}/{{path}}/Practitioner/".$practitioner_id;
		$participant['member'] = [$member];
		
		$fields['resourceType'] = 'CareTeam';
		$fields['identifier'] 	= $identifier;
		$fields['telecom'] 			= $telecom;
		$fields['name'] 				= $identifierData->value;
		$fields['participant'] 	= $participant;
		$fields_string = json_encode($fields);

		//echo '<pre>';print_r($fields_string);die;

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
	public function AddEncounter(){
		$Data['Result'] 	= DB::table('resource')->where('is_removed','false')->where('type','Encounter')->get();
		$Data['Title'] 		= 'Encounter';
		$Data['Menu'] 		= 'Encounter';
		$Data['SubMenu'] 	= '';
		return View('Admin/Resource/AddEncounter')->with($Data);
	}
	public function ViewEncounter($ID){
		$id = base64_decode($ID);
		$Data['Result'] 	= DB::table('resource')->where('id',$id)->first();
		$Data['Title'] 		= 'Encounter Details';
		$Data['Menu'] 		= 'Encounter';
		$Data['SubMenu'] 	= '';
		return View('Admin/Resource/ViewEncounter')->with($Data);
	}
	public function DeleteEncounter($ID){
		$id = base64_decode($ID);
		$fields_string = json_encode([]);
		$URL = 'Encounter/'.$id;
		DB::table('resource')->where('id',$id)->delete();
		$response ='Encounter Deleted succesfully.';
		//$response = Common::CurlAPI('DELETE',$URL,$fields_string);
		Session::flash('message', $response); 
		return Redirect()->back();
	}
	public function InsertEncount(Request $request){
		$Data = $request->all();
        //dd($Data);
		$patient_id = $Data['patient_id'];
		$PractitionerData = DB::table('name')->where('resource_id',$patient_id)->first();

		$TelecomEmail = DB::table('telecom')->where('system','email')->where('resource_id',$patient_id)->first();
		$TelecomMobile = DB::table('telecom')->where('system','phone')->where('resource_id',$patient_id)->first();

		$contained[0]['resourceType'] = 'QuestionnaireResponse';
		$contained[0]['id'] = $patient_id;
		$contained[0]['status'] = $Data['mental_status'];
		
		$contained[0]['item'][0]['definition'] = $Data['reason_for_visit'];
		$contained[0]['item'][0]['text'] = $Data['past_illness'];
		//$contained[0]['item'][0]['answer'] = $Data['family_history'];

		$identifier[0]['value'] = $patient_id;
		$identifier[0]['type'] = 'MR';
		
		$reasonCode[0]['system'] = $Data['goal'];
		$reasonCode[0]['code'] = $Data['medication'];
		//$reasonCode[0]['display'] = $Data[''];
		
		$period['start'] 	= date('Y-m-dH:i:s');
	//	$period['end'] 		= $Data['next_date'].''.$Data['next_time'];
		$period['end'] 		= $Data['next_date'];
		
		$contained[1]['resourceType'] = 'Observation';
		$contained[1]['id'] = $patient_id;
		$contained[1]['status'] = $Data['mental_status'];
		$contained[1]['code']['system'] = $Data['test1'];
		$contained[1]['code']['code'] = $Data['mental_status'];
		$contained[1]['code']['display'] = $Data['test1'];
		$contained[1]['valueString'] = $Data['clincial_notes'];
		/*$contained[1]['note']['text'] = $Data['note'];
		$contained[1]['method']['text'] = $Data['method'];*/

		$fields['resourceType'] = 'Encounter';
		$fields['contained'] 		= $contained;
		$fields['identifier'] 	= $identifier;
		$fields['status'] 			= $Data['mental_status'];
		$fields['period'] 			= $period;
		$fields['reasonCode'] 	= $reasonCode;
		//dd($fields);
		$fields_string = json_encode($fields);
		//echo $fields_string;die;
		$response = Common::CurlAPI('POST','Encounter',$fields_string);
		Session::flash('message', $response); 
		return Redirect()->back();
	}
	
	public function EditEncounter(Request $request)
	{
	    
	}
	
	public function EditPatient($ID)
	{
	    $id                 = base64_decode($ID);
		$Data['Result'] 	= DB::table('resource')->where('id',$id)->first();
		$Data['Title'] 		= 'Patient Details';
		$Data['Menu'] 		= 'Patient';
		$Data['SubMenu'] 	= '';
		return View('Admin/Resource/EditPatient')->with($Data);
	}
	
	public function SavePatient(Request $request){
		$Data = $request->all();
		//dd(json_decode($Data['id']));
		$page = Resource::find(json_decode($Data['id']));
		
		$practitioner_id = $Data['practitioner_id'];
		$PractitionerData = DB::table('name')->where('resource_id',$practitioner_id)->first();

		$TelecomEmail = DB::table('telecom')->where('system','email')->where('resource_id',$practitioner_id)->first();
		$TelecomMobile = DB::table('telecom')->where('system','phone')->where('resource_id',$practitioner_id)->first();

		$contained[0]['resourceType'] = 'Practitioner';
		$contained[0]['id'] = $practitioner_id;
		$contained[0]['name'][0]['family'] = $PractitionerData->family;
		$contained[0]['name'][0]['given'] = $PractitionerData->given;

		$contained[0]['telecom'][0]['system'] = "phone";
		$contained[0]['telecom'][0]['value'] = $TelecomMobile->value;

		$contained[0]['telecom'][1]['system'] = "email";
		$contained[0]['telecom'][1]['value'] = $TelecomEmail->value;

		$identifier[0]['value'] = $Data['identifier_prn'];
		$identifier[0]['type'] = 'PRN';
		$identifier[1]['value'] = $Data['identifier_tax'];
		$identifier[1]['type'] = 'TAX';
		
		$name[0]['family'] = $Data['family'];
		$name[0]['given'] = $Data['given'];

		$telecom[0]['system'] = 'email';
		$telecom[0]['value'] = $Data['email'];
		$telecom[1]['system'] = 'phone';
		$telecom[1]['value'] = $Data['phone'];
		
		$address[0]['line'] = $Data['line'];
		$address[0]['city'] = $Data['city'];
		$address[0]['district'] = $Data['district'];
		$address[0]['postalCode'] = $Data['postalcode'];
		$address[0]['country'] = $Data['country'];

		/*$contact[0]['relationship'][0]['coding'] = 'N';
		$contact[0]['relationship'][0]['text'] = $Data['relationship'];*/
		
		$contact[0]['name'][0]['family'] = $Data['r_family'];
		$contact[0]['name'][0]['given'] = $Data['r_given'];

		$contact[0]['telecom'][0]['system'] = 'phone';
		$contact[0]['telecom'][0]['given'] = $Data['r_mobile'];

		$contact[0]['telecom'][1]['system'] = 'email';
		$contact[0]['telecom'][1]['given'] = $Data['r_email'];


		/*$generalPractitioner[0]['reference'] = $Data['reference'];
		$generalPractitioner[0]['type'] = $Data['type'];
*/
		$fields['resourceType']     = 'Patient';
		$fields['contained'] 		= $contained;
		$fields['identifier'] 	    = $identifier;
		$fields['name'] 			= $name;
		$fields['telecom'] 			= $telecom;
		$fields['birthDate'] 		= $Data['dob'];
		$fields['address'] 			= $address;
		$fields['contact'] 			= $contact;
		//$fields['generalPractitioner'] 			= $generalPractitioner;
		$pagedd = json_encode($fields);
		//dd($page);
		if($page) {
            $page['json'] = $pagedd;
            $page->save();
        }
		$msg = Common::AlertErrorMsg('Success','Update Successfully');
		Session::flash('message', $msg); 
		return Redirect()->back();
	}
	
	/*Patient*/
	public function Patient(){
		$Data['Result'] 	= DB::table('resource')->where('is_removed','false')->where('type','Patient')->get();
		$Data['Title'] 		= 'Patient';
		$Data['Menu'] 		= 'Patient';
		$Data['SubMenu'] 	= '';
		return View('Admin/Resource/Patient')->with($Data);
	}
	public function AddPatient(){
		$Data['Title'] 		= 'Add Patient';
		$Data['Menu'] 		= 'Patient';
		$Data['SubMenu'] 	= '';
		return View('Admin/Resource/AddPatient')->with($Data);
	}
	public function InsertPatient(Request $request){
		$Data = $request->all();
		
		$practitioner_id = $Data['practitioner_id'];
		$PractitionerData = DB::table('name')->where('resource_id',$practitioner_id)->first();

		$TelecomEmail = DB::table('telecom')->where('system','email')->where('resource_id',$practitioner_id)->first();
		$TelecomMobile = DB::table('telecom')->where('system','phone')->where('resource_id',$practitioner_id)->first();

		$contained[0]['resourceType'] = 'Practitioner';
		$contained[0]['id'] = $practitioner_id;
		$contained[0]['name'][0]['family'] = $PractitionerData->family;
		$contained[0]['name'][0]['given'] = $PractitionerData->given;

		$contained[0]['telecom'][0]['system'] = "phone";
		$contained[0]['telecom'][0]['value'] = $TelecomMobile->value;

		$contained[0]['telecom'][1]['system'] = "email";
		$contained[0]['telecom'][1]['value'] = $TelecomEmail->value;

		$identifier[0]['value'] = $Data['identifier_prn'];
		$identifier[0]['type'] = 'PRN';
		$identifier[1]['value'] = $Data['identifier_tax'];
		$identifier[1]['type'] = 'TAX';
		
		$name[0]['family'] = $Data['family'];
		$name[0]['given'] = $Data['given'];

		$telecom[0]['system'] = 'email';
		$telecom[0]['value'] = $Data['email'];
		$telecom[1]['system'] = 'phone';
		$telecom[1]['value'] = $Data['phone'];
		
		$address[0]['line'] = $Data['line'];
		$address[0]['city'] = $Data['city'];
		$address[0]['district'] = $Data['district'];
		$address[0]['postalCode'] = $Data['postalcode'];
		$address[0]['country'] = $Data['country'];

		/*$contact[0]['relationship'][0]['coding'] = 'N';
		$contact[0]['relationship'][0]['text'] = $Data['relationship'];*/
		
		$contact[0]['name'][0]['family'] = $Data['r_family'];
		$contact[0]['name'][0]['given'] = $Data['r_given'];

		$contact[0]['telecom'][0]['system'] = 'phone';
		$contact[0]['telecom'][0]['given'] = $Data['r_mobile'];

		$contact[0]['telecom'][1]['system'] = 'email';
		$contact[0]['telecom'][1]['given'] = $Data['r_email'];


		/*$generalPractitioner[0]['reference'] = $Data['reference'];
		$generalPractitioner[0]['type'] = $Data['type'];
*/
		$fields['resourceType'] = 'Patient';
		$fields['contained'] 		= $contained;
		$fields['identifier'] 	= $identifier;
		$fields['name'] 				= $name;
		$fields['telecom'] 			= $telecom;
		$fields['birthDate'] 		= $Data['dob'];
		$fields['address'] 			= $address;
		$fields['contact'] 			= $contact;
		//$fields['generalPractitioner'] 			= $generalPractitioner;
		$fields_string = json_encode($fields);
		//echo $fields_string;die;
		$response = Common::CurlAPI('POST','Patient',$fields_string);
		Session::flash('message', $response); 
		return Redirect()->back();
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
