<?php



namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Addresstypes;
use App\Models\Asignacionesdiarias;
use App\Models\Contactaddresses;
use App\Models\Contactphones;
use App\Models\Contacts;
use App\Models\Phonetypes;
use App\Models\Sedes;
use App\Models\Userscronograma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AgendaController extends Controller
{
	// home
	public function index()
	{
		$data['phoneTypes'] = Phonetypes::all();
		$data['addressTypes'] =  Addresstypes::all();
		$data['contacs'] = Contacts::all();
		return view('/content/panel/agenda', $data);
	}

	public function data(Contacts $contac)
	{
		$data['phoneTypes'] = Phonetypes::all();
		$data['addressTypes'] =  Addresstypes::all();
		$data['contact'] = $contac;
		$data['contacPhones'] = $contac->phones;
		$data['contacAddress'] = $contac->addresss;

		return view('/content/panel/contac', $data);
	}


	public function create(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required|string',
			'last_name' => 'required|string',
			'type_phone' => 'nullable|array',
			'phone' => 'nullable|array',
			'type_address' => 'nullable|array',
			'address' => 'nullable|array',
			'nickname' => 'nullable|string',
			'business' => 'nullable|string',
			'email' => 'nullable|string|email'
		]);

		if ($validator->fails()) {
			echo json_encode(array("sw_error" => 1, "titulo" => "Error", "type" => "error", "message" => $validator->errors()));
			exit;
		}
		$dataInsert = array();
		$dataInsert['name'] = $request->name;
		$dataInsert['last_name'] = $request->last_name;
		if (isset($request->nickname)) {
			$dataInsert['nickname'] = $request->nickname;
		}
		if (isset($request->business)) {
			$dataInsert['business'] = $request->business;
		}
		if (isset($request->email)) {
			$dataInsert['email'] = $request->email;
		}

		$contact = Contacts::create($dataInsert);

		foreach ($request->phone as $key => $value) {
			$dataInsertPhone = array();
			if (trim($value) != '') {
				$dataInsertPhone['contact_id'] = $contact->id;
				$dataInsertPhone['phonetype_id'] = $request->type_phone[$key];
				$dataInsertPhone['phone'] =  $value;

				Contactphones::create($dataInsertPhone);
			}
		}

		foreach ($request->address as $key => $value) {
			$dataInsertAddress = array();
			if (trim($value) != '') {
				$dataInsertAddress['contact_id'] = $contact->id;
				$dataInsertAddress['addresstype_id'] = $request->type_address[$key];
				$dataInsertAddress['address'] =  $value;
				Contactaddresses::create($dataInsertAddress);
			}
		}
		echo json_encode(array("sw_error" => 0, "titulo" => "Éxito", "type" => "success", "message" => "Se registro correctamente."));
	}

	public function update(Request $request, Contacts $contact)
	{

		$validator = Validator::make($request->all(), [
			'name' => 'required|string',
			'last_name' => 'required|string',
			'type_phone' => 'nullable|array',
			'phone' => 'nullable|array',
			'type_address' => 'nullable|array',
			'address' => 'nullable|array',
			'nickname' => 'nullable|string',
			'business' => 'nullable|string',
			'email' => 'nullable|string|email'
		]);

		if ($validator->fails()) {
			echo json_encode(array("sw_error" => 1, "titulo" => "Error", "type" => "error", "message" => $validator->errors()));
			exit;
		}
		$dataUpdate = array();
		$dataUpdate['name'] = $request->name;
		$dataUpdate['last_name'] = $request->last_name;
		if (isset($request->nickname)) {
			$dataUpdate['nickname'] = $request->nickname;
		} else {
			$dataUpdate['nickname'] = NULL;
		}
		if (isset($request->business)) {
			$dataUpdate['business'] = $request->business;
		} else {
			$dataUpdate['business'] = NULL;
		}
		if (isset($request->email)) {
			$dataUpdate['email'] = $request->email;
		} else {
			$dataUpdate['email'] = NULL;
		}

		$contact->update($dataUpdate);

		Contactphones::where('contact_id', $contact->id)->delete();

		foreach ($request->phone as $key => $value) {
			$dataInsertPhone = array();
			if (trim($value) != '') {
				$dataInsertPhone['contact_id'] = $contact->id;
				$dataInsertPhone['phonetype_id'] = $request->type_phone[$key];
				$dataInsertPhone['phone'] =  $value;

				Contactphones::create($dataInsertPhone);
			}
		}

		Contactaddresses::where('contact_id', $contact->id)->delete();
		foreach ($request->address as $key => $value) {
			$dataInsertAddress = array();
			if (trim($value) != '') {
				$dataInsertAddress['contact_id'] = $contact->id;
				$dataInsertAddress['addresstype_id'] = $request->type_address[$key];
				$dataInsertAddress['address'] =  $value;
				Contactaddresses::create($dataInsertAddress);
			}
		}
		echo json_encode(array("sw_error" => 0, "titulo" => "Éxito", "type" => "success", "message" => "Se guardo correctamente."));
	}


	public function delete(Request $request, Contacts $contact)
	{
		if ($contact) {
			Contactphones::where('contact_id', $contact->id)->delete();
			Contactaddresses::where('contact_id', $contact->id)->delete();
			$contact->delete();
			echo json_encode(array("sw_error" => 0, "message" => "Se elimino el contacto."));
		} else {
			echo json_encode(array("sw_error" => 1, "message" => "Ocurrio un problema, intentelo nuevamente."));
		}
	}
	public function deletephone(Request $request, Contactphones $phone)
	{
		if ($phone) {
			$phone->delete();
			echo json_encode(array("sw_error" => 0, "message" => "Se elimino el numero."));
		} else {
			echo json_encode(array("sw_error" => 1, "message" => "Ocurrio un problema, intentelo nuevamente."));
		}
	}
	public function deleteaddress(Request $request, Contactaddresses $address)
	{
		if ($address) {
			$address->delete();
			echo json_encode(array("sw_error" => 0, "message" => "Se elimino la dirección."));
		} else {
			echo json_encode(array("sw_error" => 1, "message" => "Ocurrio un problema, intentelo nuevamente."));
		}
	}
}
