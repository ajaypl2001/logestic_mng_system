<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;
use App\Models\Country;
use App\Models\Shipper;
use App\Models\Consignee;
use App\Models\Customer;
use App\Models\Mc;
use App\Models\CarrierFleetType;
use App\Models\CarrierFleetDetail;
use App\Models\Carrier;
use App\Models\LoadCreation;
use App\Models\Charge;
use App\Models\ShipperDetail;
use App\Models\ConsigneeDetail;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

use App\Exports\CustomerExport;
use Maatwebsite\Excel\Facades\Excel;

class SqlActionController extends Controller
{
    public function getStates(Request $request)
    {
        $country_id = $request->query('country_id');
        $bill_country_id = $request->query('bill_country_id');

        $states = State::whereIn('cou_id', [$country_id, $bill_country_id])
            ->where('state_sts', 1)
            ->orderBy('state', 'ASC')
            ->get(['id', 'state as name']);

        return response()->json($states);
    }

    public function add_shipper_form()
    {
        $countries = Country::where('cou_sts', 'active')
            ->orderBy('countries_name', 'ASC')
            ->get(['id', 'countries_name', 'countries_iso_code']);

        return view('add_shipper', compact('countries'));
    }


    public function add_consignee_form()
    {
        $countries = Country::where('cou_sts', 'active')->orderBy('countries_name', 'ASC')->get(['id', 'countries_name', 'countries_iso_code']);

        return view('add_consignee', compact('countries'));
    }


    public function AddLoadCustomer_form()
    {
        $countries = Country::where('cou_sts', 'active')
            ->orderBy('countries_name', 'ASC')
            ->get(['id', 'countries_name', 'countries_iso_code']);

        return view('AddLoadCustomer', compact('countries'));
    }


    public function shipper_get_data()
    {
        $query = Shipper::with('country')->where('acc_sts', 1)->orderBy('id', 'ASC');

        if (Auth::user()->userrole != 'Admin' && Auth::user()->userrole != 'Operations') {
            $query->where('user_id', Auth::user()->id);
        }

        $shipers = $query->get();

        return view('shipper',  compact('shipers'));
    }


    public function consignee_get_data()
    {
        $query = Consignee::with('country')->where('acc_sts', 1)->orderBy('id', 'ASC');

        if (Auth::user()->userrole != 'Admin' && Auth::user()->userrole != 'Operations') {
            $query->where('user_id', Auth::user()->id);
        }

        $Consignees = $query->get();

        return view('consignee',  compact('Consignees'));
    }

    public function customer_get_data()
    {
        $query = Customer::with('country')->orderBy('id', 'ASC');

        if (Auth::user()->userrole != 'Admin' && Auth::user()->userrole != 'Operations') {
            $query->where('user_id', Auth::user()->id);
        }

        $Customers = $query->get();

        return view('customer',  compact('Customers'));
    }
    //-------------- Add Shipper ---------------------
    public function add_shipper_query(Request $request)
    {
        $data = [
            'name' => $request->shipper_name,
            'addressl_1' => $request->address,
            'addressl_2' => $request->address_line2,
            'addressl_3' => $request->address_line3,
            'country_name' => $request->country,
            'state_name' => $request->state,
            'city' => $request->city,
            'zip_code' => $request->zip_code,
            'contact_name' => $request->contact_name,
            'contact_email' => $request->email,
            'tele_phone' => $request->telephone,
            'telephone_ext' => $request->extn,
            'toll_free' => $request->toll_free,
            'fax' => $request->fax,
            'shipping_hours' => $request->shipping_hours,
            'appointments' => $request->appointments,
            'major_inspection_Dir' => $request->MajorInspectionDirections,
            'duplicate_Info' => null,
            'status_ind' => 1,
            'notes' => $request->shipping_notes,
            'internal_notes' => $request->internal_notes,
            'as_consignee' => $request->as_consignee,
            'acc_sts' => 1,
            'user_id' => $request->user_id,
        ];

        Shipper::create($data);

        return redirect()->route('shipper-list')->with('success', 'Shipper added successfully.');
    }

    public function edit_shipper($id)
    {
        $decodedId = base64_decode($id);
        $countries = Country::where('cou_sts', 'active')
            ->orderBy('countries_name', 'ASC')
            ->get(['id', 'countries_name', 'countries_iso_code']);
        $shipper = Shipper::findOrFail($decodedId);
        return view('add_shipper', compact('shipper', 'countries'));
    }

    public function edit_consign($id)
    {
        $decodedId = base64_decode($id);
        $countries = Country::where('cou_sts', 'active')
            ->orderBy('countries_name', 'ASC')
            ->get(['id', 'countries_name', 'countries_iso_code']);
        $Consignees = Consignee::findOrFail($decodedId);
        return view('add_consignee', compact('Consignees', 'countries'));
    }


    public function EditLoadCustomer($id)
    {
        $decodedId = base64_decode($id);
        $countries = Country::where('cou_sts', 'active')
            ->orderBy('countries_name', 'ASC')
            ->get(['id', 'countries_name', 'countries_iso_code']);

        $Customer = Customer::findOrFail($decodedId);

        return view('AddLoadCustomer', compact('Customer', 'countries'));
    }

    //-------------- Update Shipper ------------------
    public function update_shipper(Request $request)
    {
        $data = [
            'name' => $request->shipper_name,
            'addressl_1' => $request->address,
            'addressl_2' => $request->address_line2,
            'addressl_3' => $request->address_line3,
            'country_name' => $request->country,
            'state_name' => $request->state,
            'city' => $request->city,
            'zip_code' => $request->zip_code,
            'contact_name' => $request->contact_name,
            'contact_email' => $request->email,
            'tele_phone' => $request->telephone,
            'telephone_ext' => $request->extn,
            'toll_free' => $request->toll_free,
            'fax' => $request->fax,
            'shipping_hours' => $request->shipping_hours,
            'appointments' => $request->appointments,
            'major_inspection_Dir' => $request->MajorInspectionDirections,
            'as_consignee' => $request->as_consignee,
            'acc_sts' => $request->acc_sts ?? 1,
            'notes' => $request->shipping_notes,
            'internal_notes' => $request->internal_notes,
            'status_ind' => 1,
            'user_id' => $request->user_id,
        ];

        $updated = Shipper::where('id', $request->shipper_id)->update($data);

        if ($updated) {
            return redirect()->route('shipper-list')->with('success', 'Shipper updated successfully.');
        } else {
            return redirect()->route('add_shipper')->with('error', 'No changes were made.');
        }
    }


    // -----------Add Consignee -----------------

    public function add_consignee_query(Request $request)
    {
        $data = [
            'name' => $request->ConsignName,
            'addressl_1' => $request->AddressL1,
            'addressl_2' => $request->AddressL2,
            'addressl_3' => $request->AddressL3,
            'country_name' => $request->country,
            'state_name' => $request->state,
            'city' => $request->City,
            'zip_code' => $request->ZipCode,
            'contact_name' => $request->ContactName,
            'contact_email' => $request->ContactEmail,
            'tele_phone' => $request->Telephone,
            'telephone_ext' => $request->TelephoneExt,
            'toll_free' => $request->TollFree,
            'fax' => $request->Fax,
            'shipping_hours' => $request->strShippingHours,
            'appointments' => $request->strAppointments,
            'major_inspection_Dir' => $request->MajorInspectionDirections,
            'notes' => $request->Notes,
            'internal_notes' => $request->InternalNotes,
            'as_shipper' => $request->as_shipper,
            'acc_sts' => 1,
            'user_id' =>  $request->user_id,
        ];


        $consignee = Consignee::create($data);

        return redirect()->route('consignee-list')->with('success', 'Consignee added successfully.');
    }

    public function update_consignee(Request $request)
    {
        $data = [
            'name' => $request->ConsignName,
            'addressl_1' => $request->AddressL1,
            'addressl_2' => $request->AddressL2,
            'addressl_3' => $request->AddressL3,
            'country_name' => $request->country,
            'state_name' => $request->state,
            'city' => $request->City,
            'zip_code' => $request->ZipCode,
            'contact_name' => $request->ContactName,
            'contact_email' => $request->ContactEmail,
            'tele_phone' => $request->Telephone,
            'telephone_ext' => $request->TelephoneExt,
            'toll_free' => $request->TollFree,
            'fax' => $request->Fax,
            'consignee_hours' => $request->strShippingHours,
            'appointments' => $request->strAppointments,
            'major_inspection_Dir' => $request->MajorInspectionDirections,
            'as_shipper' => $request->as_shipper,
            'acc_sts' => $request->strStatusInd ?? 1,
            'notes' => $request->Notes,
            'internal_notes' => $request->InternalNotes,
            'status_ind' => 1,
            'user_id' => $request->user_id,
        ];

        $updated = Consignee::where('id', $request->consignee_id)->update($data);

        if ($updated) {
            return redirect()->route('consignee-list')->with('success', 'Consignee updated successfully.');
        } else {
            return redirect()->route('add_consignee')->with('error', 'No changes were made.');
        }
    }

    public function AddLoadCustomer_query(Request $request)
    {
        // dd($request->all());
        $data = [
            'customer_name' => $request->customer_name,
            'mc_ff' => $request->mc_ff,
            'mc_ff_hidden' => $request->mc_ff_hidden,
            'customer_id' => $request->customer_id,
            'address' => $request->address,
            'address_line2' => $request->address_line2,
            'address_line3' => $request->address_line3,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'zip_code' => $request->zip_code,
            'ISBillingAddSameAsMailing' => $request->ISBillingAddSameAsMailing,
            'bill_address' => $request->bill_address ?? $request->address,
            'bill_address_line2' => $request->bill_address_line2 ?? $request->address_line2,
            'bill_address_line3' => $request->bill_address_line3 ?? $request->address_line3,
            'bill_country' => $request->bill_country ?? $request->country,
            'bill_state' => $request->bill_state ?? $request->state,
            'bill_city' => $request->bill_city ?? $request->city,
            'bill_zip_code' => $request->bill_zip_code ?? $request->zip_code,
            'primary_contact' => $request->primary_contact,
            'telephone' => $request->telephone,
            'extn' => $request->extn,
            'email' => $request->email,
            'toll_free' => $request->toll_free,
            'fax' => $request->fax,
            'secondary_contact' => $request->secondary_contact,
            'secondary_email' => $request->secondary_email,
            'bill_mail' => $request->bill_mail,
            'secondary_telephone' => $request->secondary_telephone,
            'secondary_extn' => $request->secondary_extn,
            'acc_sts' => $request->acc_sts ?? 1,
            'urs' => $request->urs,
            'black_listed' =>  $request->has('black_listed') ? 'Yes' : 'No',
            'is_broker' => $request->has('is_broker') ? 'Yes' : 'No',
            'curr_setting' => $request->curr_setting,
            'payment_terms' => $request->payment_terms,
            'credit_limit' => $request->credit_limit,
            'sales_rep' => $request->sales_rep,
            'factoring_company' => $request->factoring_company,
            'federal_id' => $request->federal_id,
            'workers_comp' => $request->workers_comp,
            'website_url' => $request->website_url,
            'show_tel_tax' => $request->show_tel_tax,
            'as_shipper' => $request->as_shipper,
            'as_consignee' => $request->as_consignee,
            'internal_notes' => $request->internal_notes,
            'show_miles_quote' => $request->show_miles_quote,
            'rate_type' => $request->rate_type,
            'fsc_type' => $request->fsc_type,
            'fsc_rate' => $request->fsc_rate,
            'created_name' => '',
            'created_date' => now()->toDateString(),
            'created_datetime' => now(),
            'last_update_date' => now()->toDateString(),
            'user_id' => $request->user_id
        ];

        $customer = Customer::create($data);

        return redirect()->route('customer-list')->with('success', 'Customer added successfully!');
    }



    public function update_customer(Request $request)
    {
        $data = [
            'customer_name' => $request->customer_name,
            'mc_ff' => $request->mc_ff,
            'mc_ff_hidden' => $request->mc_ff_hidden,
            'customer_id' => $request->customer_id,
            'address' => $request->address,
            'address_line2' => $request->address_line2,
            'address_line3' => $request->address_line3,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'zip_code' => $request->zip_code,
            'ISBillingAddSameAsMailing' => $request->ISBillingAddSameAsMailing ?? '',
            'bill_address' => $request->bill_address ?? $request->address,
            'bill_address_line2' => $request->bill_address_line2 ?? $request->address_line2,
            'bill_address_line3' => $request->bill_address_line3 ?? $request->address_line3,
            'bill_country' => $request->bill_country ?? $request->country,
            'bill_state' => $request->bill_state ?? $request->state,
            'bill_city' => $request->bill_city ?? $request->city,
            'bill_zip_code' => $request->bill_zip_code ?? $request->zip_code,
            'primary_contact' => $request->primary_contact,
            'telephone' => $request->telephone,
            'extn' => $request->extn,
            'email' => $request->email,
            'toll_free' => $request->toll_free,
            'fax' => $request->fax,
            'secondary_contact' => $request->secondary_contact,
            'secondary_email' => $request->secondary_email,
            'bill_mail' => $request->bill_mail,
            'secondary_telephone' => $request->secondary_telephone,
            'secondary_extn' => $request->secondary_extn,
            'acc_sts' => $request->acc_sts ?? 1,
            'urs' => $request->urs,
            'black_listed' =>  $request->has('black_listed') ? 'Yes' : 'No',
            'is_broker' => $request->has('is_broker') ? 'Yes' : 'No',
            'curr_setting' => $request->curr_setting,
            'payment_terms' => $request->payment_terms,
            'credit_limit' => $request->credit_limit,
            'sales_rep' => $request->sales_rep,
            'factoring_company' => $request->factoring_company,
            'federal_id' => $request->federal_id,
            'workers_comp' => $request->workers_comp,
            'website_url' => $request->website_url,
            'show_tel_tax' => $request->show_tel_tax,
            'as_shipper' => $request->as_shipper,
            'as_consignee' => $request->as_consignee,
            'internal_notes' => $request->internal_notes,
            'show_miles_quote' => $request->show_miles_quote,
            'rate_type' => $request->rate_type,
            'fsc_type' => $request->fsc_type,
            'fsc_rate' => $request->fsc_rate,
            'user_id' => $request->user_id,
            'created_name' => '',
            'created_date' => now()->toDateString(),
            'created_datetime' => now(),
            'last_update_date' => now()->toDateString(),
        ];

        $updated = Customer::where('id', $request->customer_id)->update($data);

        return redirect()->route('customer-list')->with('success', 'Customer Updated successfully!');
    }

    public function mc_get_data()
    {

        $query = Mc::orderBy('id', 'ASC');

        if (Auth::user()->userrole != 'Admin' && Auth::user()->userrole != 'Operations') {
            $query->where('user_id', Auth::user()->id);
        }

        $mc_data = $query->get();

        return view('mc-check', compact('mc_data'));
    }

    public function add_mc_form()
    {

        return view('add_mc');
    }

    public function add_mc_query(Request $request)
    {
        if ($request->hasFile('com_value_prf')) {
            $file = $request->file('com_value_prf');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
        } else {
            $filename = null;
        }

        $mc_data = [
            'mc_no'           => $request->mc_no,
            'user_id'           => $request->user_id,
            'carrier_name'    => $request->carrier_name,
            'commodity_type'  => $request->commodity_type,
            'commodity_value' => $request->commodity_value,
            'equ_type'        => $request->equ_type,
            'com_value_prf'   => $filename,
            'created_datetime' => now(),
        ];

        $customer = Mc::create($mc_data);

        return redirect()->route('mc-check-list')->with('success', 'Mc Created successfully!');
    }


    public function edit_mc($id)
    {
        $decodedId = base64_decode($id);
        $Mc_data = Mc::findOrFail($decodedId);

        return view('add_mc', compact('Mc_data'));
    }

    public function update_mc(Request $request)
    {
        $mc = Mc::findOrFail($request->mc_id);

        if ($request->hasFile('com_value_prf')) {
            $file = $request->file('com_value_prf');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);

            if ($mc->com_value_prf && file_exists(public_path('images/' . $mc->com_value_prf))) {
                unlink(public_path('images/' . $mc->com_value_prf));
            }
        } else {
            $filename = $mc->com_value_prf;
        }

        $mc_data = [
            'mc_no'           => $request->mc_no,
            'user_id'           => $request->user_id,
            'carrier_name'    => $request->carrier_name,
            'commodity_type'  => $request->commodity_type,
            'commodity_value' => $request->commodity_value,
            'equ_type'        => $request->equ_type,
            'com_value_prf'   => $filename,
            'updated_at'      => now(),
        ];

        $mc->update($mc_data);

        return redirect()->route('mc-check-list')->with('success', 'MC updated successfully!');
    }


    public function external_carrier()
    {
        $query = Carrier::with('fleetDetails')->orderBy('id', 'ASC');

        if (Auth::user()->userrole != 'Admin' && Auth::user()->userrole != 'Operations') {
            $query->where('user_id', Auth::user()->id);
        }

        $carrier_data = $query->get();
        return view('external-carrier', compact('carrier_data'));
    }


    public function add_carrier()
    {
        $CarrierFleetType = CarrierFleetType::get();
        $countries = Country::where('cou_sts', 'active')
            ->orderBy('countries_name', 'ASC')
            ->get(['id', 'countries_name', 'countries_iso_code']);
        $CarrierFleetDetails = collect();
        return view('add_carrier', compact('CarrierFleetType', 'countries', 'CarrierFleetDetails'));
    }



    public function add_carrier_query(Request $request)
    {
        $carrierData = $request->only([
            'carrier_name',
            'user_id',
            'mc_ff',
            'mc_ff_hidden',
            'dot',
            'address',
            'address_line2',
            'address_line3',
            'country',
            'state',
            'city',
            'zip_code',
            'contact_name',
            'email',
            'telephone',
            'extn',
            'toll_free',
            'fax',
            'payment_terms',
            'tax_id',
            'username',
            'password',
            'urs',
            'factoring_company',
            'notes',
            'acc_sts',
            'load_type',
            'black_listed',
            'corporation',
            'lib_company',
            'lib_policy_no',
            'lib_exp_date',
            'lib_telephone',
            'lib_extn',
            'lib_contact',
            'lib_liability',
            'lib_notes',
            'ins_com_same_lib',
            'ins_company',
            'ins_policy_no',
            'ins_exp_date',
            'ins_telephone',
            'ins_extn',
            'ins_contact',
            'ins_liability',
            'ins_notes',
            'cargo_com_same_lib',
            'cargo_company',
            'cargo_policy_no',
            'cargo_exp_date',
            'cargo_telephone',
            'cargo_extn',
            'cargo_liability',
            'cargo_contact',
            'cargo_notes',
            'wsib',
            'fmcsa_ins_com',
            'wsib_policy_no',
            'wsib_exp_date',
            'wsib_type',
            'wsib_coverage',
            'wsib_telephone',
            'best_rating',
            'primary_name',
            'primary_telephone',
            'primary_email',
            'sec_name',
            'sec_telephone',
            'sec_email',
            'size_of_fleet',
            'main_notes'
        ]);

        $carrier = Carrier::create($carrierData);


        $isChecked = $request->input('is_checked', []);
        $equipment_name = $request->input('equipment_name', []);
        $quantities = $request->input('quantity', []);

        foreach ($isChecked as $index => $value) {
            CarrierFleetDetail::create([
                'carrier_id' => $carrier->id,
                'equipment_name' => $equipment_name[$index] ?? '',
                'quantity' => $quantities[$index] ?? 0,
                'is_checked' => $value,
            ]);
        }

        return redirect()->route('external_carrier')->with('success', 'Carrier added successfully!');
    }



    public function edit_carrier($id)
    {
        $decodedId = base64_decode($id);

        $countries = Country::where('cou_sts', 'active')->orderBy('countries_name', 'ASC')->get(['id', 'countries_name', 'countries_iso_code']);

        $carrier_data = Carrier::findOrFail($decodedId);
        $CarrierFleetType = CarrierFleetType::get();
        $CarrierFleetDetails = CarrierFleetDetail::where('carrier_id', $decodedId)->get();

        return view('add_carrier', compact('carrier_data', 'countries', 'CarrierFleetType', 'CarrierFleetDetails'));
    }

    public function update_carrier_query(Request $request)
    {
        $carrierData = $request->only([
            'carrier_name',
            'user_id',
            'mc_ff',
            'mc_ff_hidden',
            'dot',
            'address',
            'address_line2',
            'address_line3',
            'country',
            'state',
            'city',
            'zip_code',
            'contact_name',
            'email',
            'telephone',
            'extn',
            'toll_free',
            'fax',
            'payment_terms',
            'tax_id',
            'username',
            'password',
            'urs',
            'factoring_company',
            'notes',
            'acc_sts',
            'load_type',
            'black_listed',
            'corporation',
            'lib_company',
            'lib_policy_no',
            'lib_exp_date',
            'lib_telephone',
            'lib_extn',
            'lib_contact',
            'lib_liability',
            'lib_notes',
            'ins_com_same_lib',
            'ins_company',
            'ins_policy_no',
            'ins_exp_date',
            'ins_telephone',
            'ins_extn',
            'ins_contact',
            'ins_liability',
            'ins_notes',
            'cargo_com_same_lib',
            'cargo_company',
            'cargo_policy_no',
            'cargo_exp_date',
            'cargo_telephone',
            'cargo_extn',
            'cargo_liability',
            'cargo_contact',
            'cargo_notes',
            'wsib',
            'fmcsa_ins_com',
            'wsib_policy_no',
            'wsib_exp_date',
            'wsib_type',
            'wsib_coverage',
            'wsib_telephone',
            'best_rating',
            'primary_name',
            'primary_telephone',
            'primary_email',
            'sec_name',
            'sec_telephone',
            'sec_email',
            'size_of_fleet',
            'main_notes'
        ]);


        $carrier = Carrier::where('id', $request->carrier_id)->update($carrierData);

        $isChecked = $request->input('is_checked', []);
        $equipment_name = $request->input('equipment_name', []);
        $quantities = $request->input('quantity', []);


        CarrierFleetDetail::where('carrier_id', $request->carrier_id)->delete();


        foreach ($isChecked as $index => $value) {
            CarrierFleetDetail::create([
                'carrier_id' => $request->carrier_id,
                'equipment_name' => $equipment_name[$index] ?? '',
                'quantity' => $quantities[$index] ?? 0,
                'is_checked' => $value,
            ]);
        }

        return redirect()->route('external_carrier')->with('success', 'Carrier Update successfully!');
    }


    public function load_creation()
    {
        $query = LoadCreation::with(['charges', 'shippers', 'consignees', 'customer'])->orderBy('id', 'ASC');

        if (Auth::user()->userrole != 'Admin' && Auth::user()->userrole != 'Operations') {
            $query->where('user_id', Auth::user()->id);
        }

        $loads = $query->get();
        return view('load-creation', compact('loads'));
    }


    public function add_load_creation()
    {
        $countries = Country::where('cou_sts', 'active')->orderBy('countries_name', 'ASC')->get(['id', 'countries_name', 'countries_iso_code']);
        $customers = Customer::all();
        $shippers = Shipper::all();
        $consignees = Consignee::all();
        $load = null;
        return view('add_load_creation', compact('customers', 'countries', 'shippers', 'consignees', 'load'));
    }


    public function add_load_creation_query(Request $request)
    {
        $load_Data = $request->only([
            'customer_id',
            'user_id',
            'search_terms',
            'dispatcher',
            'load_status',
            'wo',
            'payment_type',
            'type',
            'shipper_rate',
            'pds',
            'fsc',
            'other_charge_id',
            'adv_payment',
            'load_type',
            'mc_no',
            'equipment_type',
            'carrier_fee',
            'currency',
            'carrier_pds',
            'carrierrate_check',
            'final_carrier_fee'
        ]);

        $load = LoadCreation::create($load_Data);

        $otherCharges = json_decode($request->input('other_charge_id'), true);
        if ($otherCharges && is_array($otherCharges)) {
            foreach ($otherCharges as $charge) {
                Charge::create([
                    'creation_id' => $load->id,
                    'type' => $charge['type'] ?? null,
                    'charge' => $charge['charge'] ?? null,
                    'amount' => $charge['amount'] ?? null,
                ]);
            }
        }


        $shippers = $request->input('shipper_details', []);
        foreach ($shippers as $shipper) {
            if (empty($shipper['shipper_id'])) {
                continue;
            }

            ShipperDetail::create([
                'creation_id' => $load->id,
                'shipper_id' => $shipper['shipper_id'],
                'shipper_location' => $shipper['shipper_location'] ?? null,
                'shipper_date' => $shipper['shipper_date'] ?? null,
                'shipper_chktime' => $shipper['shipper_chktime'] ?? null,
                'shipper_description' => $shipper['shipper_description'] ?? null,
                'shipper_type' => $shipper['shipper_type'] ?? null,
                'shipper_qty' => $shipper['shipper_qty'] ?? null,
                'shipper_weight' => $shipper['shipper_weight'] ?? null,
                'shipper_value' => $shipper['shipper_value'] ?? null,
                'shipping_notes' => $shipper['shipping_notes'] ?? null,
                'po_number' => $shipper['po_number'] ?? null,
                'customer_broker' => $shipper['customer_broker'] ?? null,
            ]);
        }

        $consignees = $request->input('consignee_details', []);
        foreach ($consignees as $consignee) {
            if (empty($consignee['consignee_id'])) {
                continue;
            }

            ConsigneeDetail::create([
                'creation_id' => $load->id,
                'consignee_id' => $consignee['consignee_id'],
                'consignee_location' => $consignee['consignee_location'] ?? null,
                'consignee_date' => $consignee['consignee_date'] ?? null,
                'consignee_time' => $consignee['consignee_time'] ?? null,
                'consignee_description' => $consignee['consignee_description'] ?? null,
                'consignee_type' => $consignee['consignee_type'] ?? null,
                'consignee_quantity' => $consignee['consignee_quantity'] ?? null,
                'consignee_weight' => $consignee['consignee_weight'] ?? null,
                'consignee_value' => $consignee['consignee_value'] ?? null,
                'delivery_notes' => $consignee['delivery_notes'] ?? null,
                'consignee_po_number' => $consignee['consignee_po_number'] ?? null,
                'consignee_pro_miles' => $consignee['consignee_pro_miles'] ?? null,
                'consignee_empty' => $consignee['consignee_empty'] ?? null,
            ]);
        }

        return redirect()->route('load-creation')->with('success', 'Load Creation added successfully!');
    }


    public function edit_load_creation($id)
    {

        $decodedId = base64_decode($id);
        $load = LoadCreation::with(['customer', 'shippers', 'consignees', 'charges'])->findOrFail($decodedId);

        $countries = Country::where('cou_sts', 'active')->orderBy('countries_name', 'ASC')->get(['id', 'countries_name', 'countries_iso_code']);
        $customers = Customer::all();
        $shippers = Shipper::all();
        $consignees = Consignee::all();
        $chargesArray = $load->charges->map(function ($charge) {
            return [
                'type' => $charge->type,
                'charge' => $charge->charge,
                'amount' => $charge->amount,
            ];
        });

        $chargesJson = $chargesArray->toJson();
        $totalAmount = $chargesArray->sum('amount');


        return view('add_load_creation', compact('load', 'customers', 'countries', 'shippers', 'consignees', 'chargesJson', 'totalAmount'));
    }


    public function getshipperLocation($id)
    {
        $shipper = Shipper::find($id);

        if ($shipper) {
            $fullAddress = trim(
                $shipper->addressl_1 . ' ' .
                    $shipper->addressl_2 . ' ' .
                    $shipper->addressl_3
            );

            return response()->json([
                'location' => $fullAddress
            ]);
        }

        return response()->json(['location' => null], 404);
    }

    public function getconsigneeLocation($id)
    {
        $consignee = Consignee::find($id);

        if ($consignee) {
            $fullAddress = trim(
                $consignee->addressl_1 . ' ' .
                    $consignee->addressl_2 . ' ' .
                    $consignee->addressl_3
            );

            return response()->json([
                'location' => $fullAddress
            ]);
        }

        return response()->json(['location' => null], 404);
    }


    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:load_creation,id',
            'status' => 'required|string'
        ]);

        $load = LoadCreation::find($request->id);
        $load->load_status = $request->status;
        $load->save();

        return response()->json(['success' => true, 'message' => 'Status updated']);
    }


    public function update_load_query(Request $request)
    {
        $load_Data = $request->only([
            'customer_id',
            'user_id',
            'search_terms',
            'dispatcher',
            'load_status',
            'wo',
            'payment_type',
            'type',
            'shipper_rate',
            'pds',
            'fsc',
            'other_charge_id',
            'adv_payment',
            'load_type',
            'mc_no',
            'equipment_type',
            'carrier_fee',
            'currency',
            'carrier_pds',
            'carrierrate_check',
            'final_carrier_fee',
            'bill_type'
        ]);

        $load = LoadCreation::findOrFail($request->load_creation_id);
        $load->update($load_Data);

        Charge::where('creation_id', $load->id)->delete();
        $otherCharges = json_decode($request->input('other_charge_id'), true);
        if ($otherCharges && is_array($otherCharges)) {
            foreach ($otherCharges as $charge) {
                Charge::create([
                    'creation_id' => $load->id,
                    'type' => $charge['type'] ?? null,
                    'charge' => $charge['charge'] ?? null,
                    'amount' => $charge['amount'] ?? null,
                ]);
            }
        }

        ShipperDetail::where('creation_id', $load->id)->delete();
        $shippers = $request->input('shipper_details', []);
        foreach ($shippers as $shipper) {
            if (empty($shipper['shipper_id'])) continue;

            ShipperDetail::create([
                'creation_id' => $load->id,
                'shipper_id' => $shipper['shipper_id'],
                'shipper_location' => $shipper['shipper_location'] ?? null,
                'shipper_date' => $shipper['shipper_date'] ?? null,
                'shipper_chktime' => $shipper['shipper_chktime'] ?? null,
                'shipper_description' => $shipper['shipper_description'] ?? null,
                'shipper_type' => $shipper['shipper_type'] ?? null,
                'shipper_qty' => $shipper['shipper_qty'] ?? null,
                'shipper_weight' => $shipper['shipper_weight'] ?? null,
                'shipper_value' => $shipper['shipper_value'] ?? null,
                'shipping_notes' => $shipper['shipping_notes'] ?? null,
                'po_number' => $shipper['po_number'] ?? null,
                'customer_broker' => $shipper['customer_broker'] ?? null,
            ]);
        }

        ConsigneeDetail::where('creation_id', $load->id)->delete();
        $consignees = $request->input('consignee_details', []);
        foreach ($consignees as $consignee) {
            if (empty($consignee['consignee_id'])) continue;

            ConsigneeDetail::create([
                'creation_id' => $load->id,
                'consignee_id' => $consignee['consignee_id'],
                'consignee_location' => $consignee['consignee_location'] ?? null,
                'consignee_date' => $consignee['consignee_date'] ?? null,
                'consignee_time' => $consignee['consignee_time'] ?? null,
                'consignee_description' => $consignee['consignee_description'] ?? null,
                'consignee_type' => $consignee['consignee_type'] ?? null,
                'consignee_quantity' => $consignee['consignee_quantity'] ?? null,
                'consignee_weight' => $consignee['consignee_weight'] ?? null,
                'consignee_value' => $consignee['consignee_value'] ?? null,
                'delivery_notes' => $consignee['delivery_notes'] ?? null,
                'consignee_po_number' => $consignee['consignee_po_number'] ?? null,
                'consignee_pro_miles' => $consignee['consignee_pro_miles'] ?? null,
                'consignee_empty' => $consignee['consignee_empty'] ?? null,
            ]);
        }

        return redirect()->route('load-creation')->with('success', 'Load Creation Updated successfully!');
    }



    public function generatePdf()
    {
        $pdf = Pdf::loadView('pdf.signed_ratecon_pdf');

        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream('signed_ratecon.pdf');
    }


    public function exportCustomers()
    {
        return Excel::download(new CustomerExport, 'customers.xlsx');
    }
}
