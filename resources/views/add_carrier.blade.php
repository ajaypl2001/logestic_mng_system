@include('header')
<!-- ==================================================== -->
<!-- Start right Content here -->
<!-- ==================================================== -->
<div class="page-content">
   <!-- Start Container Fluid -->
   <div class="container-fluid">
      <div class="row">
         <div class="col-xl-12">
            <div class="card">
               <div class="card-header">
                  <div class="d-flex flex-wrap justify-content-between gap-3">
                     @if (!empty($carrier_data->id))
                     <h4 class="card-title d-flex align-items-center gap-1" id="hidden_column"> Update Carrier </h4>
                     @else
                     <h4 class="card-title d-flex align-items-center gap-1" id="hidden_column"> Add Carrier </h4>
                     @endif

                     <a href="{{ route('external_carrier')}}" class="btn btn-primary btn-sm"><i class="bx bx-arrow-back me-1"></i>Back </a>
                  </div>
               </div>
               @php
               $isEdit = isset($carrier_data);
               @endphp
               <div class="card-body">
                  <div class="row">
                     <div class="col-lg-12">

                        <form action="{{ $isEdit ? route('update_carrier_query', $carrier_data->id) : route('add_carrier_query') }}" id="CareerForm" method="post">
                           @csrf
                           <div class="row">
                              <div class="col-md-12">
                                 <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                       <a class="nav-item nav-link active" id="tab01-tab" data-bs-toggle="tab" href="#tab01" role="tab">Account</a>
                                       <a class="nav-item nav-link" id="tab02-tab" data-bs-toggle="tab" href="#tab02" role="tab">Insurance</a>
                                       <a class="nav-item nav-link" id="tab03-tab" data-bs-toggle="tab" href="#tab03" role="tab">Accounting</a>
                                       <a class="nav-item nav-link" id="tab04-tab" data-bs-toggle="tab" href="#tab04" role="tab">Equipment</a>
                                       <a class="nav-item nav-link" id="tab05-tab" data-bs-toggle="tab" href="#tab05" role="tab">Notes</a>
                                    </div>
                                 </nav>
                                 <div class="tab-content carrier_tabs pt-4" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="tab01" role="tabpanel">
                                       <div class="row">
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Carrier Name</label><span style="color:red;">*</span>
                                                <input Placeholder="Carrier Name" class="form-control required" id="carrier_name" name="carrier_name" type="text" value="{{ $isEdit ? $carrier_data->carrier_name : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="row">
                                                <div class="col-md-4 el_small_fld">
                                                   <div class="form-group mb-3">
                                                      <label class="control-label mb-1">M.C. #/F.F. #</label><span style="color:red;">*</span>
                                                      <select class="form-control shadow-none col-12 required" id="mc_ff" name="mc_ff" width="50px" >
                                                         <option value="">Select One</option>
                                                         <option value="MC" {{ $isEdit && $carrier_data->mc_ff == 'MC' ? 'selected' : '' }}>MC</option>
                                                         <option value="FF" {{ $isEdit && $carrier_data->mc_ff == 'FF' ? 'selected' : '' }}>FF</option>
                                                      </select>
                                                   </div>
                                                </div>
                                                <div class="col-md-8">
                                                   <div class="form-group mb-3">
                                                      <label class="control-label mb-1 hidden_label">hidden label</label>
                                                      <input Placeholder="M.C. #/F.F. #" class="form-control required" id="mc_ff_hidden" name="mc_ff_hidden" type="text" value="{{ $isEdit ? $carrier_data->carrier_name : '' }}" />
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">D.O.T.</label>
                                                <input Placeholder="D.O.T." class="form-control required" id="dot" name="dot" type="text" value="{{ $isEdit ? $carrier_data->dot : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Address</label><span style="color:red;">*</span>
                                                <input Placeholder="Address" class="form-control required" id="address" name="address" type="text" value="{{ $isEdit ? $carrier_data->address : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Address Line 2</label>
                                                <input Placeholder="Address Line 2" class="form-control" id="address_line2" name="address_line2" type="text" value="{{ $isEdit ? $carrier_data->address_line2 : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Address Line 3</label>
                                                <input Placeholder="Address Line 3" class="form-control" id="address_line3" name="address_line3" type="text" value="{{ $isEdit ? $carrier_data->address_line2 : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Country</label><span style="color:red;">*</span>
                                                <select class="form-control shadow-none col-12 required" id="strCountryID" name="country" width="100px" >
                                                   <option value="">Please Select</option>
                                                   @foreach($countries as $country)
                                                   <option value="{{ $country->countries_iso_code }}" {{ $isEdit && $carrier_data->country == $country->countries_iso_code ? 'selected' : '' }}>{{ $country->countries_name }}
                                                   </option>
                                                   @endforeach
                                                </select>
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">State</label><span style="color:red;">*</span>
                                                <select class="form-control shadow-none col-12 required" id="strStateID" name="state" width="100px" >
                                                   <option value="">Please Select</option>
                                                </select>
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">City</label><span style="color:red;">*</span>
                                                <input Placeholder="City" class="form-control required" id="city" name="city" type="text" value="{{ $isEdit ? $carrier_data->city : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Zip</label><span style="color:red;">*</span>
                                                <input Placeholder="Zip" class="form-control required" id="zip_code" name="zip_code" type="text" value="{{ $isEdit ? $carrier_data->zip_code : '' }}" />
                                                <span class="field-validation-valid" data-valmsg-for="ZipCode" data-valmsg-replace="true"></span>
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Contact Name</label>
                                                <input Placeholder="Contact Name" class="form-control required" id="contact_name" name="contact_name" type="text" value="{{ $isEdit ? $carrier_data->contact_name : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Email</label>
                                                <input Placeholder="Email" class="form-control required" id="email" name="email" type="text" value="{{ $isEdit ? $carrier_data->email : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Telephone</label><span style="color:red;">*</span>
                                                <input Placeholder="XXX-XXX-XXXX" class="form-control telephone required" id="telephone" name="telephone" type="text" value="{{ $isEdit ? $carrier_data->telephone : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Extn.</label>
                                                <input Placeholder="XXXXX" class="form-control" id="extn" name="extn" type="text" value="{{ $isEdit ? $carrier_data->extn : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Toll Free</label>
                                                <input Placeholder="XXX-XXX-XXXX" class="form-control telephone" id="toll_free" name="toll_free" type="text" value="{{ $isEdit ? $carrier_data->toll_free : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Fax</label>
                                                <input Placeholder="XXX-XXX-XXXX" class="form-control telephone" id="fax" name="fax" type="text" value="{{ $isEdit ? $carrier_data->fax : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Payment Terms</label><span style="color:red;">*</span>
                                                <select class="form-control shadow-none col-12 required" id="payment_terms" name="payment_terms" width="100px" >
                                                   <option value="">Please Select</option>
                                                   <option value=".5/10 Net 30" {{ $isEdit && $carrier_data->payment_terms == '.5/10 Net 30' ? 'selected' : '' }}>.5/10 Net 30</option>
                                                   <option value="1.5/2 Net 30" {{ $isEdit && $carrier_data->payment_terms == '1.5/2 Net 30' ? 'selected' : '' }}>1.5/2 Net 30</option>
                                                   <option value="1.5/15 Net 30" {{ $isEdit && $carrier_data->payment_terms == '1.5/15 Net 30' ? 'selected' : '' }}>1.5/15 Net 30</option>
                                                   <option value="1/7 Net 15" {{ $isEdit && $carrier_data->payment_terms == '1/7 Net 15' ? 'selected' : '' }}>1/7 Net 15</option>
                                                   <option value="1/10 Net 30" {{ $isEdit && $carrier_data->payment_terms == '1/10 Net 30' ? 'selected' : '' }}>1/10 Net 30</option>
                                                   <option value="1/14 Net 30" {{ $isEdit && $carrier_data->payment_terms == '1/14 Net 30' ? 'selected' : '' }}>1/14 Net 30</option>
                                                   <option value="2/7 Net 30" {{ $isEdit && $carrier_data->payment_terms == '2/7 Net 30' ? 'selected' : '' }}>2/7 Net 30</option>
                                                   <option value="2/10 Net 30" {{ $isEdit && $carrier_data->payment_terms == '2/10 Net 30' ? 'selected' : '' }}>2/10 Net 30</option>
                                                   <option value="2/15 Net 30" {{ $isEdit && $carrier_data->payment_terms == '2/15 Net 30' ? 'selected' : '' }}>2/15 Net 30</option>
                                                   <option value="3.5/7 Net 30" {{ $isEdit && $carrier_data->payment_terms == '3.5/7 Net 30' ? 'selected' : '' }}>3.5/7 Net 30</option>
                                                   <option value="3/7 Net 30" {{ $isEdit && $carrier_data->payment_terms == '3/7 Net 30' ? 'selected' : '' }}>3/7 Net 30</option>
                                                   <option value="3/10 Net 30" {{ $isEdit && $carrier_data->payment_terms == '3/10 Net 30' ? 'selected' : '' }}>3/10 Net 30</option>
                                                   <option value="4/7 Net 30" {{ $isEdit && $carrier_data->payment_terms == '4/7 Net 30' ? 'selected' : '' }}>4/7 Net 30</option>
                                                   <option value="5/1 Net 30" {{ $isEdit && $carrier_data->payment_terms == '5/1 Net 30' ? 'selected' : '' }}>5/1 Net 30</option>
                                                   <option value="5/10 Net 30" {{ $isEdit && $carrier_data->payment_terms == '5/10 Net 30' ? 'selected' : '' }}>5/10 Net 30</option>
                                                   <option value="5/28 Net 30" {{ $isEdit && $carrier_data->payment_terms == '5/28 Net 30' ? 'selected' : '' }}>5/28 Net 30</option>
                                                   <option value="ACH" {{ $isEdit && $carrier_data->payment_terms == 'ACH' ? 'selected' : '' }}>ACH</option>
                                                   <option value="ACH 14 Days" {{ $isEdit && $carrier_data->payment_terms == 'ACH 14 Days' ? 'selected' : '' }}>ACH 14 Days</option>
                                                   <option value="ACH 30 Days" {{ $isEdit && $carrier_data->payment_terms == 'ACH 30 Days' ? 'selected' : '' }}>ACH 30 Days</option>
                                                   <option value="COD (Cash or Check on Delivery)" {{ $isEdit && $carrier_data->payment_terms == 'COD (Cash or Check on Delivery)' ? 'selected' : '' }}>COD (Cash or Check on Delivery)</option>
                                                   <option value="COP (Cash or Check on Pick-up)" {{ $isEdit && $carrier_data->payment_terms == 'COP (Cash or Check on Pick-up)' ? 'selected' : '' }}>COP (Cash or Check on Pick-up)</option>
                                                   <option value="Consignment" {{ $isEdit && $carrier_data->payment_terms == 'Consignment' ? 'selected' : '' }}>Consignment</option>
                                                   <option value="Credit Card" {{ $isEdit && $carrier_data->payment_terms == 'Credit Card' ? 'selected' : '' }}>Credit Card</option>
                                                   <option value="Due on Receipt" {{ $isEdit && $carrier_data->payment_terms == 'Due on Receipt' ? 'selected' : '' }}>Due on Receipt</option>
                                                   <option value="Net1" {{ $isEdit && $carrier_data->payment_terms == 'Net1' ? 'selected' : '' }}>Net1</option>
                                                   <option value="Net 2" {{ $isEdit && $carrier_data->payment_terms == 'Net 2' ? 'selected' : '' }}>Net 2</option>
                                                   <option value="Net 3" {{ $isEdit && $carrier_data->payment_terms == 'Net 3' ? 'selected' : '' }}>Net 3</option>
                                                   <option value="Net 4" {{ $isEdit && $carrier_data->payment_terms == 'Net 4' ? 'selected' : '' }}>Net 4</option>
                                                   <option value="Net 5" {{ $isEdit && $carrier_data->payment_terms == 'Net 5' ? 'selected' : '' }}>Net 5</option>
                                                   <option value="Net 6" {{ $isEdit && $carrier_data->payment_terms == 'Net 6' ? 'selected' : '' }}>Net 6</option>
                                                   <option value="Net 7" {{ $isEdit && $carrier_data->payment_terms == 'Net 7' ? 'selected' : '' }}>Net 7</option>
                                                   <option value="Net 8" {{ $isEdit && $carrier_data->payment_terms == 'Net 8' ? 'selected' : '' }}>Net 8</option>
                                                   <option value="Net 9" {{ $isEdit && $carrier_data->payment_terms == 'Net 9' ? 'selected' : '' }}>Net 9</option>
                                                   <option value="Net 10" {{ $isEdit && $carrier_data->payment_terms == 'Net 10' ? 'selected' : '' }}>Net 10</option>
                                                   <option value="Net 11" {{ $isEdit && $carrier_data->payment_terms == 'Net 11' ? 'selected' : '' }}>Net 11</option>
                                                   <option value="Net 12" {{ $isEdit && $carrier_data->payment_terms == 'Net 12' ? 'selected' : '' }}>Net 12</option>
                                                   <option value="Net 13" {{ $isEdit && $carrier_data->payment_terms == 'Net 13' ? 'selected' : '' }}>Net 13</option>
                                                   <option value="Net 14" {{ $isEdit && $carrier_data->payment_terms == 'Net 14' ? 'selected' : '' }}>Net 14</option>
                                                   <option value="Net 15" {{ $isEdit && $carrier_data->payment_terms == 'Net 15' ? 'selected' : '' }}>Net 15</option>
                                                   <option value="Net 16" {{ $isEdit && $carrier_data->payment_terms == 'Net 16' ? 'selected' : '' }}>Net 16</option>
                                                   <option value="Net 17" {{ $isEdit && $carrier_data->payment_terms == 'Net 17' ? 'selected' : '' }}>Net 17</option>
                                                   <option value="Net 18" {{ $isEdit && $carrier_data->payment_terms == 'Net 18' ? 'selected' : '' }}>Net 18</option>
                                                   <option value="Net 19" {{ $isEdit && $carrier_data->payment_terms == 'Net 19' ? 'selected' : '' }}>Net 19</option>
                                                   <option value="Net 20" {{ $isEdit && $carrier_data->payment_terms == 'Net 20' ? 'selected' : '' }}>Net 20</option>
                                                   <option value="Net 21" {{ $isEdit && $carrier_data->payment_terms == 'Net 21' ? 'selected' : '' }}>Net 21</option>
                                                   <option value="Net 22" {{ $isEdit && $carrier_data->payment_terms == 'Net 22' ? 'selected' : '' }}>Net 22</option>
                                                   <option value="Net 23" {{ $isEdit && $carrier_data->payment_terms == 'Net 23' ? 'selected' : '' }}>Net 23</option>
                                                   <option value="Net 24" {{ $isEdit && $carrier_data->payment_terms == 'Net 24' ? 'selected' : '' }}>Net 24</option>
                                                   <option value="Net 25" {{ $isEdit && $carrier_data->payment_terms == 'Net 25' ? 'selected' : '' }}>Net 25</option>
                                                   <option value="Net 26" {{ $isEdit && $carrier_data->payment_terms == 'Net 26' ? 'selected' : '' }}>Net 26</option>
                                                   <option value="Net 27" {{ $isEdit && $carrier_data->payment_terms == 'Net 27' ? 'selected' : '' }}>Net 27</option>
                                                   <option value="Net 28" {{ $isEdit && $carrier_data->payment_terms == 'Net 28' ? 'selected' : '' }}>Net 28</option>
                                                   <option value="Net 29" {{ $isEdit && $carrier_data->payment_terms == 'Net 29' ? 'selected' : '' }}>Net 29</option>
                                                   <option value="Net 30" {{ $isEdit && $carrier_data->payment_terms == 'Net 30' ? 'selected' : '' }}>Net 30</option>
                                                   <option value="Net 30 (From Ship Date)" {{ $isEdit && $carrier_data->payment_terms == 'Net 30 (From Ship Date)' ? 'selected' : '' }}>Net 30 (From Ship Date)</option>
                                                   <option value="Net 35" {{ $isEdit && $carrier_data->payment_terms == 'Net 35' ? 'selected' : '' }}>Net 35</option>
                                                   <option value="Net 37" {{ $isEdit && $carrier_data->payment_terms == 'Net 37' ? 'selected' : '' }}>Net 37</option>
                                                   <option value="Net 45" {{ $isEdit && $carrier_data->payment_terms == 'Net 45' ? 'selected' : '' }}>Net 45</option>
                                                   <option value="Net 60" {{ $isEdit && $carrier_data->payment_terms == 'Net 60' ? 'selected' : '' }}>Net 60</option>
                                                   <option value="Net 80" {{ $isEdit && $carrier_data->payment_terms == 'Net 80' ? 'selected' : '' }}>Net 80</option>
                                                   <option value="Net 90" {{ $isEdit && $carrier_data->payment_terms == 'Net 90' ? 'selected' : '' }}>Net 90</option>
                                                   <option value="Prepaid" {{ $isEdit && $carrier_data->payment_terms == 'Prepaid' ? 'selected' : '' }}>Prepaid</option>
                                                   <option value="Quick Pay .5% 1 Day" {{ $isEdit && $carrier_data->payment_terms == 'Quick Pay .5% 1 Day' ? 'selected' : '' }}>Quick Pay .5% 1 Day</option>
                                                   <option value="Quick Pay 1% 10 Days" {{ $isEdit && $carrier_data->payment_terms == 'Quick Pay 1% 10 Days' ? 'selected' : '' }}>Quick Pay 1% 10 Days</option>
                                                   <option value="Quick Pay 1% 14 Days" {{ $isEdit && $carrier_data->payment_terms == 'Quick Pay 1% 14 Days' ? 'selected' : '' }}>Quick Pay 1% 14 Days</option>
                                                   <option value="Quick Pay 1% 15 Days" {{ $isEdit && $carrier_data->payment_terms == 'Quick Pay 1% 15 Days' ? 'selected' : '' }}>Quick Pay 1% 15 Days</option>
                                                   <option value="Quick Pay 1.5 % 2 Days" {{ $isEdit && $carrier_data->payment_terms == 'Quick Pay 1.5 % 2 Days' ? 'selected' : '' }}>Quick Pay 1.5 % 2 Days</option>
                                                   <option value="Quick Pay 1.5 % 3 Days" {{ $isEdit && $carrier_data->payment_terms == 'Quick Pay 1.5 % 3 Days' ? 'selected' : '' }}>Quick Pay 1.5 % 3 Days</option>
                                                   <option value="Quick Pay 1.5% 7 Days" {{ $isEdit && $carrier_data->payment_terms == 'Quick Pay 1.5% 7 Days' ? 'selected' : '' }}>Quick Pay 1.5% 7 Days</option>
                                                </select>
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Tax ID #</label>
                                                <input Placeholder="Tax ID #" class="form-control required" id="tax_id" name="tax_id" type="text" value="{{ $isEdit ? $carrier_data->tax_id : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Username </label>
                                                <input Placeholder="Username" class="form-control required" id="username" name="username" type="text" value="{{ $isEdit ? $carrier_data->username : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Password</label>
                                                <input Placeholder="Password" class="form-control required" id="password" name="password" type="password" value="{{ $isEdit ? $carrier_data->password : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3" style="display:none;">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">URS #</label>
                                                <input Placeholder="URS #" class="form-control" id="urs" name="urs" type="text" value="{{ $isEdit ? $carrier_data->urs : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Factoring Company</label><span style="color:red;">*</span>
                                                <select class="form-control shadow-none col-12" id="factoring_company" name="factoring_company" >
                                                   <option value="">Please Select</option>
                                                   <option value="No Factoring" {{ $isEdit && $carrier_data->factoring_company == 'No Factoring' ? 'selected' : '' }}>No Factoring</option>
                                                </select>
                                             </div>
                                          </div>
                                          <div class="col-md-9">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Notes</label>
                                                <textarea Placeholder="Notes" class="form-control textareaNotes1 el_textarea100" cols="20" id="notes" name="notes" rows="2" >{{ $isEdit ? $carrier_data->notes : '' }}</textarea>
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Status</label><span style="color:red;">*</span>
                                                <select class="form-control shadow-none col-12 required" id="acc_sts" name="acc_sts" width="100px" >
                                                   <option value="">Please Select</option>
                                                   <option value="2" {{ $isEdit && $carrier_data->acc_sts == 2 ? 'selected' : '' }}>Inactive</option>
                                                   <option value="1" {{ $isEdit && $carrier_data->acc_sts == 1 ? 'selected' : '' }}>Active</option>
                                                </select>
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Load Type</label><span style="color:red;">*</span>
                                                <select class="form-control shadow-none col-12 required" id="load_type" name="load_type" width="100px" >
                                                   <option value="">Please Select</option>
                                                   <option value="OTR" {{ $isEdit && $carrier_data->load_type == 'OTR' ? 'selected' : '' }}>OTR</option>
                                                   <option value="Dray-age" {{ $isEdit && $carrier_data->load_type == 'Dray-age' ? 'selected' : '' }}>Dray-age</option>
                                                </select>
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <label class="control-label mb-1 el_min100">BlackListed</label>
                                             <div class="form-check-inline form-check">
                                                <label class="form-check-label">
                                                   <input class="form-check-input" type="checkbox" value="Yes" name="black_listed" {{ ($isEdit && $carrier_data->black_listed == 'Yes') ? 'checked' : '' }} />
                                                   Carrier is blacklisted
                                                </label>
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1 el_min100">Corporation</label>
                                                <div class="form-check-inline form-check">
                                                   <label class="form-check-label">
                                                      <input class="form-check-input" type="checkbox" value="Yes" name="corporation" {{ ($isEdit && $carrier_data->corporation == 'Yes') ? 'checked' : '' }} />
                                                      Carrier is a corporation
                                                   </label>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="form_bbtns text-end">
                                          <button type="button" class="btn btn-primary text-white commonBtn rounded px-3 nextBtn">Next</button>
                                       </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab02" role="tabpanel">
                                       <h4 class="el_form_headding bg-light mb-3">Liability Company</h4>
                                       <div class="row">
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Company</label>
                                                <input Placeholder="Liability Company" class="form-control required" id="lib_company" name="lib_company" type="text" value="{{ $isEdit ? $carrier_data->lib_company : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Policy # </label>
                                                <input Placeholder="Policy #" class="form-control required" id="lib_policy_no" name="lib_policy_no" type="text" value="{{ $isEdit ? $carrier_data->lib_policy_no : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Expiry Date</label>
                                                <input Placeholder="MM/dd/yyyy" class="form-control datepicker required" id="lib_exp_date" name="lib_exp_date" type="date" value="{{ $isEdit ? $carrier_data->lib_exp_date : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Telephone</label>
                                                <input Placeholder="xxx-xxx-xxxx" class="form-control telephone required" id="lib_telephone" name="lib_telephone" type="text" value="{{ $isEdit ? $carrier_data->lib_telephone : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Extn.</label>
                                                <input Placeholder="XXXXX" class="form-control required" id="lib_extn" name="lib_extn" type="text" value="{{ $isEdit ? $carrier_data->lib_extn : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Contact </label>
                                                <input Placeholder="Contact" class="form-control required" id="lib_contact" name="lib_contact" type="text" value="{{ $isEdit ? $carrier_data->lib_contact : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Liablity</label>
                                                <input Placeholder="$0.00" class="form-control required" id="lib_liability" name="lib_liability" type="text" value="{{ $isEdit ? $carrier_data->lib_liability : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Notes</label>
                                                <textarea Placeholder="Notes" class="form-control" cols="20" id="lib_notes" name="lib_notes" rows="4">{{ $isEdit ? $carrier_data->lib_notes : '' }}</textarea>
                                             </div>
                                          </div>
                                          <h4 class="el_form_headding bg-light">Auto Insurance Company</h4>
                                          <div class="form-check-inline form-check mt-2">
                                             <div class="form-group mb-3">
                                                <label class="form-check-label">
                                                   <input class="form-check-input" type="checkbox" name="ins_com_same_lib" value="Yes" {{ ($isEdit && $carrier_data->ins_com_same_lib == 'Yes') ? 'checked' : '' }} />
                                                   Is Same As Liability
                                                </label>
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Company</label>
                                                <input Placeholder="Auto Insurance Company" class="form-control" id="ins_company" name="ins_company" type="text" value="{{ $isEdit ? $carrier_data->ins_company : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Policy # </label>
                                                <input Placeholder="Policy #" class="form-control" id="ins_policy_no" name="ins_policy_no" type="text" value="{{ $isEdit ? $carrier_data->ins_policy_no : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Expiry Date</label>
                                                <input Placeholder="mm/dd/yyyy" class="form-control datepicker" id="ins_exp_date" name="ins_exp_date" type="date" value="{{ $isEdit ? $carrier_data->ins_exp_date : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Telephone</label>
                                                <input Placeholder="xxx-xxx-xxxx" class="form-control telephone" id="ins_telephone" name="ins_telephone" type="text" value="{{ $isEdit ? $carrier_data->ins_telephone : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Extn.</label>
                                                <input Placeholder="xxxxx" class="form-control" id="ins_extn" name="ins_extn" type="text" value="{{ $isEdit ? $carrier_data->ins_extn : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Contact </label>
                                                <input Placeholder="Contact" class="form-control" id="ins_contact" name="ins_contact" type="text" value="{{ $isEdit ? $carrier_data->ins_contact : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Liability</label>
                                                <input Placeholder="Liability" class="form-control" id="ins_liability" name="ins_liability" type="text" value="{{ $isEdit ? $carrier_data->ins_liability : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Notes</label>
                                                <textarea Maxlength="200" Placeholder="Notes" class="form-control" cols="20" id="ins_notes" name="ins_notes" rows="4">{{ $isEdit ? $carrier_data->ins_notes : '' }}</textarea>
                                             </div>
                                          </div>

                                          <h4 class="el_form_headding bg-light">Cargo Company</h4>
                                          <div class="form-check-inline form-check mt-2">
                                             <div class="form-group mb-3">
                                                <label class="form-check-label">
                                                   <input class="form-check-input" id="cargo_com_same_lib" name="cargo_com_same_lib" type="checkbox" value="Yes" {{ ($isEdit && $carrier_data->cargo_com_same_lib == 'Yes') ? 'checked' : '' }} />
                                                   Is Same As Liability
                                                </label>
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Company</label>
                                                <input Maxlength="200" Placeholder="Cargo company" class="form-control" id="cargo_ompany" name="cargo_ompany" type="text" value="{{ $isEdit ? $carrier_data->cargo_ompany : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Policy # </label>
                                                <input Placeholder="Policy #" class="form-control" id="cargo_policy_no" name="cargo_policy_no" type="text" value="{{ $isEdit ? $carrier_data->cargo_policy_no : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Expiry Date</label>
                                                <input Maxlength="50" Placeholder="mm/dd/yyyy" class="form-control datepicker" id="cargo_exp_date" name="cargo_exp_date" type="date" value="{{ $isEdit ? $carrier_data->cargo_exp_date : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">TelePhone</label>
                                                <input Placeholder="xxx-xxx-xxxx" class="form-control telephone" id="cargo_telephone" name="cargo_telephone" type="text" value="{{ $isEdit ? $carrier_data->cargo_telephone : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Extn.</label>
                                                <input Maxlength="8" Placeholder="xxxxx" class="form-control" id="cargo_extn" name="cargo_extn" type="text" value="{{ $isEdit ? $carrier_data->cargo_extn : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Cargo Ins ($) </label>
                                                <input Maxlength="50" Placeholder="0.00" class="form-control" id="cargo_liability" name="cargo_liability" type="text" value="{{ $isEdit ? $carrier_data->cargo_liability : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Contacts</label>
                                                <input Maxlength="200" Placeholder="Notes" class="form-control" id="cargo_contact" name="cargo_contact" type="text" value="{{ $isEdit ? $carrier_data->cargo_contact : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Notes</label>
                                                <textarea Maxlength="200" Placeholder="Notes" class="form-control" cols="20" id="cargo_notes" name="cargo_notes" rows="4">{{ $isEdit ? $carrier_data->cargo_notes : '' }}</textarea>
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">WSIB #</label>
                                                <input Maxlength="100" Placeholder="WSIB #" class="form-control" id="wsib" name="wsib" type="text" value="{{ $isEdit ? $carrier_data->wsib : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">FMCSA Insurance Company</label>
                                                <input Placeholder="FMCSA Insurance Company" class="form-control required" id="fmcsa_ins_com" name="fmcsa_ins_com" type="text" value="{{ $isEdit ? $carrier_data->fmcsa_ins_com : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Policy # </label>
                                                <input Placeholder="Policy #" class="form-control required" id="wsib_policy_no" name="wsib_policy_no" type="text" value="{{ $isEdit ? $carrier_data->wsib_policy_no : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Expiry Date</label>
                                                <input Placeholder="mm/dd/yyyy" class="form-control datepicker required" id="wsib_exp_date" name="wsib_exp_date" type="date" value="{{ $isEdit ? $carrier_data->wsib_exp_date : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Type</label>
                                                <input Maxlength="100" Placeholder="Type" class="form-control required" id="wsib_type" name="wsib_type" type="text" value="{{ $isEdit ? $carrier_data->wsib_type : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Coverage ($)</label>
                                                <input Placeholder="0.00" class="form-control required" id="wsib_coverage" name="wsib_coverage" type="text" value="{{ $isEdit ? $carrier_data->wsib_coverage : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Telephone </label>
                                                <input Placeholder="xxx-xxx-xxxx" class="form-control telephone required" id="wsib_telephone" name="wsib_telephone" type="text" value="{{ $isEdit ? $carrier_data->wsib_telephone : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">A.M. Best Rating</label>
                                                <input Placeholder="A.M. Best Rating" class="form-control required" id="best_rating" name="best_rating" type="text" value="0" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="form_bbtns text-end">
                                          <button type="button" class="btn btn-primary text-white commonBtn rounded px-3 nextBtn">Next</button>
                                       </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab03" role="tabpanel">
                                       <div class="row">
                                          <div class="col-md-4">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Primary Name</label>
                                                <input Maxlength="100" Placeholder="Primary Name" class="form-control required" id="primary_name" name="primary_name" type="text" value="{{ $isEdit ? $carrier_data->primary_name : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-4">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Primary Telephone </label>
                                                <input Placeholder="xxx-xxx-xxxx" class="form-control telephone required" id="primary_telephone" name="primary_telephone" type="text" value="{{ $isEdit ? $carrier_data->primary_telephone : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-4">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Primary Email</label>
                                                <input Placeholder="test@test.com" class="form-control required" id="primary_email" name="primary_email" type="text" value="{{ $isEdit ? $carrier_data->primary_email : '' }}" />
                                             </div>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-md-4">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Secondary Name</label>
                                                <input Placeholder="Secondary Name" class="form-control " id="sec_name" name="sec_name" type="text" value="{{ $isEdit ? $carrier_data->sec_name : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-4">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Secondary Telephone </label>
                                                <input Placeholder="xxx-xxx-xxxx" class="form-control telephone" id="sec_telephone" name="sec_telephone" type="text" value="{{ $isEdit ? $carrier_data->sec_telephone : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-4">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Secondary Email</label>
                                                <input Placeholder="test@test.com" class="form-control" id="sec_email" name="sec_email" type="text" value="{{ $isEdit ? $carrier_data->sec_email : '' }}" />
                                             </div>
                                          </div>
                                       </div>
                                       <div class="form_bbtns text-end">
                                          <button type="button" class="btn btn-primary text-white commonBtn rounded px-3 nextBtn">Next</button>
                                       </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab04" role="tabpanel">
                                       <div class="row">
                                          <div class="col-md-4">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Size of Fleet</label>
                                                <input Placeholder="" class="form-control" id="size_of_fleet" name="size_of_fleet" rows="10" type="text" value="0" readonly />
                                             </div>
                                          </div>
                                          <div class="col-md-4">
                                             <div class="form-group mb-3">
                                             </div>
                                          </div>
                                          <div class="col-md-4">
                                             <div class="form-group mb-3">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="el_tablescroll">
                                          <table class="el_qttable table table-bordered" id="tbEquipmenttype">
                                             <thead>
                                                <tr>
                                                   <th align="center" width="50">Yes</th>
                                                   <th width="100">Quantity</th>
                                                   <th>EquipmentType</th>
                                                </tr>
                                             </thead>
                                             <tbody>

                                                @foreach ($CarrierFleetType as $CarrierFleetTypes)
                                                @php
                                                $fleetDetail = $CarrierFleetDetails->firstWhere('equipment_name', $CarrierFleetTypes->fleet_name);
                                                $isChecked = $fleetDetail && $fleetDetail->is_checked === 'Yes';
                                                $quantity = $fleetDetail ? $fleetDetail->quantity : 0;
                                                @endphp
                                                <tr>
                                                   <td align="center">
                                                      <label class="form-check-label form-check-inline form-check">
                                                         <input class="form-check-input" name="is_checked[]" type="checkbox" value="Yes" {{ $isChecked ? 'checked' : '' }} />
                                                      </label>
                                                   </td>
                                                   <td>
                                                      <input class="form-control qty" maxlength="2" name="quantity[]" type="number" value="{{ $quantity }}" />
                                                      <input class="form-control " name="equipment_name[]" type="hidden" value="{{ $CarrierFleetTypes->fleet_name}}" />
                                                   </td>
                                                   <td>{{ $CarrierFleetTypes->fleet_name}}</td>
                                                </tr>

                                                @endforeach

                                             </tbody>
                                          </table>
                                       </div>
                                       <div class="form_bbtns text-end">
                                          <button type="button" class="btn btn-primary text-white commonBtn rounded px-3 nextBtn">Next</button>
                                       </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab05" role="tabpanel">
                                       <div class="row">
                                          <div class="col-md-12">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Notes</label>
                                                <textarea Maxlength="4000" Placeholder="" class="form-control textareaNotes2 required" cols="20" id="main_notes" name="main_notes" rows="10" >{{ $isEdit ? $carrier_data->main_notes : '' }}</textarea>
                                                <span class="field-validation-valid" data-valmsg-for="Notes" data-valmsg-replace="true"></span>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="form_bbtns text-end">
                                          <input type="hidden" name="carrier_id" value="{{ $isEdit ? $carrier_data->id : '' }}">
                                          <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
                                          @if (!empty($carrier_data->id))
                                          <button id="btnSubmit" type="submit" class="btn btn-success commonBtn">Update</button>
                                          @else
                                          <button id="btnSubmit" type="submit" class="btn btn-success commonBtn">Submit</button>
                                          @endif

                                          <a class="btn btn-primary  text-white commonBtn rounded submit px-3" href="{{ route('external_carrier')}}" style="">Cancel</a>
                                       </div>
                                    </div>

                                 </div>

                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- end row -->
</div>
<!-- End Container Fluid -->
@include('footer')

<script>
   document.addEventListener('DOMContentLoaded', function() {

      const insCheckbox = document.querySelector('input[name="ins_com_same_lib"]');
      insCheckbox.addEventListener('change', function() {
         if (this.checked) {
            document.getElementById('ins_company').value = document.getElementById('lib_company').value;
            document.getElementById('ins_policy_no').value = document.getElementById('lib_policy_no').value;
            document.getElementById('ins_exp_date').value = document.getElementById('lib_exp_date').value;
            document.getElementById('ins_telephone').value = document.getElementById('lib_telephone').value;
            document.getElementById('ins_extn').value = document.getElementById('lib_extn').value;
            document.getElementById('ins_contact').value = document.getElementById('lib_contact').value;
            document.getElementById('ins_liability').value = document.getElementById('lib_liability').value;
            document.getElementById('ins_notes').value = document.getElementById('lib_notes').value;

            ['ins_company', 'ins_policy_no', 'ins_exp_date', 'ins_telephone', 'ins_extn', 'ins_contact', 'ins_liability', 'ins_notes'].forEach(id => {
               document.getElementById(id).disabled = true;
            });
         } else {
            ['ins_company', 'ins_policy_no', 'ins_exp_date', 'ins_telephone', 'ins_extn', 'ins_contact', 'ins_liability', 'ins_notes'].forEach(id => {
               document.getElementById(id).disabled = false;
            });
         }
      });

      const cargoCheckbox = document.getElementById('cargo_com_same_lib');
      cargoCheckbox.addEventListener('change', function() {
         if (this.checked) {
            document.getElementById('cargo_ompany').value = document.getElementById('lib_company').value;
            document.getElementById('cargo_policy_no').value = document.getElementById('lib_policy_no').value;
            document.getElementById('cargo_exp_date').value = document.getElementById('lib_exp_date').value;
            document.getElementById('cargo_telephone').value = document.getElementById('lib_telephone').value;
            document.getElementById('cargo_extn').value = document.getElementById('lib_extn').value;
            document.getElementById('cargo_contact').value = document.getElementById('lib_contact').value;
            document.getElementById('cargo_liability').value = document.getElementById('lib_liability').value;
            document.getElementById('cargo_notes').value = document.getElementById('lib_notes').value;

            ['cargo_ompany', 'cargo_policy_no', 'cargo_exp_date', 'cargo_telephone', 'cargo_extn', 'cargo_contact', 'cargo_liability', 'cargo_notes'].forEach(id => {
               document.getElementById(id).disabled = true;
            });
         } else {
            ['cargo_ompany', 'cargo_policy_no', 'cargo_exp_date', 'cargo_telephone', 'cargo_extn', 'cargo_contact', 'cargo_liability', 'cargo_notes'].forEach(id => {
               document.getElementById(id).disabled = false;
            });
         }
      });

   });
</script>
<script>
   document.addEventListener('DOMContentLoaded', function() {

      function copyFields(sourceIds, targetIds) {
         sourceIds.forEach((id, index) => {
            document.getElementById(targetIds[index]).value = document.getElementById(id).value;
         });
      }

      const liabilityFields = ['lib_company', 'lib_policy_no', 'lib_exp_date', 'lib_telephone', 'lib_extn', 'lib_contact', 'lib_liability', 'lib_notes'];
      const autoFields = ['ins_company', 'ins_policy_no', 'ins_exp_date', 'ins_telephone', 'ins_extn', 'ins_contact', 'ins_liability', 'ins_notes'];
      const cargoFields = ['cargo_ompany', 'cargo_policy_no', 'cargo_exp_date', 'cargo_telephone', 'cargo_extn', 'cargo_contact', 'cargo_liability', 'cargo_notes'];

      const insCheckbox = document.querySelector('input[name="ins_com_same_lib"]');
      insCheckbox.addEventListener('change', function() {
         if (this.checked) {
            copyFields(liabilityFields, autoFields);
            autoFields.forEach(id => document.getElementById(id).disabled = true);
         } else {
            autoFields.forEach(id => document.getElementById(id).disabled = false);
         }
      });

      const cargoCheckbox = document.getElementById('cargo_com_same_lib');
      cargoCheckbox.addEventListener('change', function() {
         if (this.checked) {
            copyFields(liabilityFields, cargoFields);
            cargoFields.forEach(id => document.getElementById(id).disabled = true);
         } else {
            cargoFields.forEach(id => document.getElementById(id).disabled = false);
         }
      });

      liabilityFields.forEach((id, index) => {
         document.getElementById(id).addEventListener('input', function() {
            if (insCheckbox.checked) {
               document.getElementById(autoFields[index]).value = this.value;
            }
            if (cargoCheckbox.checked) {
               document.getElementById(cargoFields[index]).value = this.value;
            }
         });
      });

   });
</script>

<script>
   $(document).ready(function() {
      var $countryDropdown = $('#strCountryID');
      var $stateDropdown = $('#strStateID');
      var selectedState = "{{ $isEdit ? $carrier_data->state : '' }}";

      function loadStates(countryId, selectedState = '') {
         $stateDropdown.html('<option value="">Please Select</option>');
         if (!countryId) return;

         $.ajax({
            url: "{{ route('states.get') }}",
            type: 'GET',
            data: {
               country_id: countryId
            },
            dataType: 'json',
            success: function(response) {
               if (response.length > 0) {
                  $.each(response, function(index, state) {
                     var option = $('<option>', {
                        value: state.id,
                        text: state.name
                     });
                     if (state.id == selectedState) {
                        option.prop('selected', true);
                     }
                     $stateDropdown.append(option);
                  });
               } else {
                  $stateDropdown.append('<option value="">No states found</option>');
               }
            },
            error: function() {
               alert('Error loading states.');
            }
         });
      }

      $countryDropdown.on('change', function() {
         loadStates($(this).val());
      });

      var initialCountry = $countryDropdown.val();
      if (initialCountry) {
         loadStates(initialCountry, selectedState);
      }
   });
</script>

<script>
   function updateTotalQuantity() {
      let total = 0;
      $('.qty').each(function() {
         let val = parseInt($(this).val()) || 0;
         total += val;
      });
      $('#size_of_fleet').val(total);
   }

   $(document).ready(function() {
      updateTotalQuantity();
   });

   $(document).on('input', '.qty', function() {
      updateTotalQuantity();
   });
</script>


<script>
   $(document).ready(function() {
      $('.nextBtn').on('click', function() {
         var currentTab = $(this).closest('.tab-pane');
         var valid = true;

         currentTab.find('.required').each(function() {
            if (!$(this).val()) {
               $(this).addClass('is-invalid');
               valid = false;
            } else {
               $(this).removeClass('is-invalid');
            }
         });

         if (valid) {
            var nextTab = currentTab.next('.tab-pane');
            var nextTabId = nextTab.attr('id');
            $('a[href="#' + nextTabId + '"]').tab('show');
         }
      });
      $('#CareerForm input, #CareerForm select').on('input change', function() {
         checkAllFields();
      });

      function checkAllFields() {
         var allFilled = true;
         $('#CareerForm .required').each(function() {
            if (!$(this).val()) {
               allFilled = false;
            }
         });

         // if (allFilled) {
         //    $('.nextBtn').hide();
         //    if ($('.submitBtn').length === 0) {
         //       $('.tab-pane').each(function() {
         //          if (!$(this).find('button[type="submit"]').length) {
         //             $(this).append('<div class="form_bbtns text-end"> <button type="submit" class="btn btn-primary text-white commonBtn rounded px-3">Save</button> </div>');
         //          }
         //       });
         //    }
         // }
      }
   });
</script>

<script>
$(document).ready(function() {

    $('a[data-bs-toggle="tab"]').on('show.bs.tab', function(e) {
        var targetTab = $(this).attr('href'); 
        var currentTabId = $('.tab-pane.active').attr('id'); 

        var currentIndex = parseInt(currentTabId.replace('tab', ''), 10);
        var targetIndex = parseInt(targetTab.replace('#tab', ''), 10);


        if (targetIndex > currentIndex) {
            var allFilled = true;

    
            $('#' + currentTabId + ' .required').each(function() {
                if (!$(this).val().trim()) {
                    allFilled = false;
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            if (!allFilled) {
                e.preventDefault(); 
                alert('Please fill all required fields before proceeding.');
                $('#' + currentTabId + ' .required.is-invalid:first').focus();
            }
        }
       
    });

});
</script>

<style>
   .is-invalid {
      border-color: red !important;
   }
</style>