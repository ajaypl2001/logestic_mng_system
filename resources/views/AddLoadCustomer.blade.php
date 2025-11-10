@include('header');

<div class="page-content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-xl-12">
            <div class="card">
               <div class="card-header">
                  @if (!empty($Customer->id))
                  <h4 class="card-title d-flex align-items-center gap-1" id="hidden_column"> Update Load Customer </h4>
                  @else
                  <h4 class="card-title d-flex align-items-center gap-1" id="hidden_column"> Add Load Customer </h4>
                  @endif

               </div>
               @php
               $isEdit = isset($Customer);
               @endphp
               <div class="card-body">
                  <div class="row">
                     <div class="col-lg-12">

                        <form action="{{ $isEdit ? route('update_customer', $Customer->id) : route('AddLoadCustomer_query') }}" id="CustomerForm" method="post">
                           @csrf
                           <div class="row">
                              <div class="col-md-12">
                                 <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                       <a class="nav-item nav-link active" id="tab01-tab" data-bs-toggle="tab" href="#tab01" role="tab">Customer</a>
                                       <a class="nav-item nav-link" id="tab02-tab" data-bs-toggle="tab" href="#tab02" role="tab">Advanced</a>
                                       <a class="nav-item nav-link" id="tab04-tab" data-bs-toggle="tab" href="#tab04" role="tab">Quote Settings</a>
                                    </div>
                                 </nav>
                                 <div class="tab-content carrier_tabs pt-4" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="tab01" role="tabpanel">
                                       <div class="row">
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Customer Name</label><span style="color:red;">*</span>
                                                <input Placeholder="Customer Name" class="form-control required" id="customer_name" name="customer_name" type="text" value="{{ $isEdit ? $Customer->customer_name : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="row">
                                                <div class="col-md-4 el_small_fld">
                                                   <div class="form-group mb-3">
                                                      <label class="control-label mb-1">M.C. #/F.F. #</label>
                                                      <select class="form-control shadow-none col-12 required" id="mc_ff" name="mc_ff">
                                                         <option value="">Choose Option</option>
                                                         <option value="MC" {{ ($isEdit && $Customer->mc_ff == 'MC') ? 'selected' : '' }}>MC</option>
                                                         <option value="FF" {{ ($isEdit && $Customer->mc_ff == 'FF') ? 'selected' : '' }}>FF</option>
                                                      </select>
                                                   </div>
                                                </div>
                                                <div class="col-md-8">
                                                   <div class="form-group mb-3">
                                                      <label class="control-label mb-1 hidden_label">hidden label</label>
                                                      <input Placeholder="M.C. #/F.F. #" class="form-control" id="mc_ff_hidden" name="mc_ff_hidden" type="text" value="{{ $isEdit ? $Customer->mc_ff_hidden : '' }}" />
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Customer Id</label>
                                                <input Placeholder="Customer Id" class="form-control" id="customer_id" name="customer_id" type="text" value="{{ $isEdit ? $Customer->customer_id : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Address</label><span style="color:red;">*</span>
                                                <input Placeholder="Address" class="form-control required" id="address" name="address" type="text" value="{{ $isEdit ? $Customer->address : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Address Line 2</label>
                                                <input Placeholder="Address Line 2" class="form-control" id="address_line2" name="address_line2" type="text" value="{{ $isEdit ? $Customer->address_line2 : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Address Line 3</label>
                                                <input Placeholder="Address Line 3" class="form-control" id="address_line3" name="address_line3" type="text" value="{{ $isEdit ? $Customer->address_line3 : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Country</label><span style="color:red;">*</span>
                                                <select class="form-control shadow-none col-12 required" data-val="true" data-val-required="Country is required" id="strCountryID" name="country">
                                                   <option value="">Please Select</option>

                                                   @foreach($countries as $country)
                                                   <option value="{{ $country->countries_iso_code }}"
                                                      {{ $isEdit && $Customer->country == $country->countries_iso_code ? 'selected' : '' }}>
                                                      {{ $country->countries_name }}
                                                   </option>
                                                   @endforeach

                                                </select>
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">State</label><span style="color:red;">*</span>
                                                <select class="form-control shadow-none col-12 required" id="strStateID" name="state">
                                                   <option value="">Please Select</option>
                                                </select>
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">City</label><span style="color:red;">*</span>
                                                <input Placeholder="City" class="form-control required" id="city" name="city" type="text" value="{{ $isEdit ? $Customer->city : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Zip</label><span style="color:red;">*</span>
                                                <input Placeholder="Zip" class="form-control required" id="zip_code" name="zip_code" type="text" value="{{ $isEdit ? $Customer->zip_code : '' }}" />
                                             </div>
                                          </div>
                                          <div class="form-check-inline form-check mt-2">
                                             <div class="form-group mb-3">
                                                <label class="form-check-label">
                                                   <input class="form-check-input" id="ISBillingAddSameAsMailing" name="ISBillingAddSameAsMailing" type="checkbox" value="Yes" {{ ($isEdit && $Customer->ISBillingAddSameAsMailing == 'Yes') ? 'checked' : '' }} />Same As Physical Address </label>
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Billing Address</label><span style="color:red;">*</span>
                                                <input Placeholder="Billing Address" class="form-control required" id="bill_address" name="bill_address" type="text" value="{{ $isEdit ? $Customer->bill_address : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Billing Address Line 2</label>
                                                <input Placeholder="Billing Address Line 2" class="form-control " id="bill_address_line2" name="bill_address_line2" type="text" value="{{ $isEdit ? $Customer->bill_address_line2 : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Address Line 3</label>
                                                <input Placeholder="Address Line 3" class="form-control" id="bill_address_line3" name="bill_address_line3" type="text" value="{{ $isEdit ? $Customer->bill_address_line3 : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Billing Country</label><span style="color:red;">*</span>
                                                <select class="form-control shadow-none col-12 required" id="strBillingCountryID" name="bill_country">
                                                   <option value="">Please Select</option>
                                                   @foreach($countries as $country)
                                                   <option value="{{ $country->countries_iso_code }}"
                                                      {{ $isEdit && $Customer->bill_country == $country->countries_iso_code ? 'selected' : '' }}>
                                                      {{ $country->countries_name }}
                                                   </option>
                                                   @endforeach
                                                </select>
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Billing State</label><span style="color:red;">*</span>
                                                <select class="form-control shadow-none col-12 required" id="strBillingStateID" name="bill_state">
                                                   <option value="">Please Select</option>
                                                </select>
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Billing City</label><span style="color:red;">*</span>
                                                <input Placeholder="Billing City" class="form-control required" id="bill_city" name="bill_city" type="text" value="{{ $isEdit ? $Customer->bill_city : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Billing Zip</label><span style="color:red;">*</span>
                                                <input Placeholder="Billing Zip" class="form-control required" id="bill_zip_code" name="bill_zip_code" type="text" value="{{ $isEdit ? $Customer->bill_zip_code : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Primary Contact</label><span style="color:red;">*</span>
                                                <input Placeholder="Primary Contact" class="form-control required" id="primary_contact" name="primary_contact" type="text" value="{{ $isEdit ? $Customer->primary_contact : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Telephone</label><span style="color:red;">*</span>
                                                <input Placeholder="XXX-XXX-XXXX" class="form-control telephone required" id="telephone" name="telephone" type="text" value="{{ $isEdit ? $Customer->telephone : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Extn.</label>
                                                <input Placeholder="XXXXX" class="form-control" id="extn" name="extn" type="text" value="{{ $isEdit ? $Customer->extn : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Email</label><span style="color:red;">*</span>
                                                <input Placeholder="test@test.com" class="form-control required" id="email" name="email" type="email" value="{{ $isEdit ? $Customer->email : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Toll Free</label>
                                                <input Placeholder="XXX-XXX-XXXX" class="form-control telephone" id="toll_free" name="toll_free" type="text" value="{{ $isEdit ? $Customer->toll_free : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Fax</label>
                                                <input Placeholder="XXX-XXX-XXXX" class="form-control telephone" id="fax" name="fax" type="text" value="{{ $isEdit ? $Customer->fax : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Secondary Contact</label>
                                                <input Placeholder="Secondary Contact" class="form-control" id="secondary_contact" name="secondary_contact" type="text" value="{{ $isEdit ? $Customer->secondary_contact : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Secondary Email</label>
                                                <input Placeholder="Secondary Email" class="form-control" id="secondary_email" name="secondary_email" type="email" value="{{ $isEdit ? $Customer->secondary_email : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Billing Email</label>
                                                <input Placeholder="test@test.com" class="form-control" id="bill_mail" name="bill_mail" type="email" value="{{ $isEdit ? $Customer->bill_mail : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Telephone</label><span style="color:red;">*</span>
                                                <input Placeholder="XXX-XXX-XXXX" class="form-control telephone" id="secondary_telephone" name="secondary_telephone" type="text" value="{{ $isEdit ? $Customer->secondary_telephone : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Extn.</label>
                                                <input Placeholder="XXXXX" class="form-control" id="secondary_extn" name="secondary_extn" type="text" value="{{ $isEdit ? $Customer->secondary_extn : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Status</label><span style="color:red;">*</span>
                                                <select class="form-control shadow-none col-12 required" id="acc_sts" name="acc_sts" width="100px">
                                                   <option value="2" {{ $isEdit && $Customer->acc_sts == 2 ? 'selected' : '' }}>Inactive</option>
                                                   <option value="1" {{ $isEdit && $Customer->acc_sts == 1 ? 'selected' : '' }}>Active</option>
                                                </select>
                                             </div>
                                          </div>
                                          <div class="col-md-3" style="display:none;">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">URS #</label>
                                                <input Placeholder="URS #" class="form-control" id="urs" name="urs" type="text" value="{{ $isEdit ? $Customer->urs : '' }}" />
                                             </div>
                                          </div>
                                          <br>
                                          <div class="col-md-3">
                                             <label class="control-label mb-1 el_min100">BlackListed</label>
                                             <div class="form-check-inline form-check">
                                                <label class="form-check-label">
                                                   <input class="form-check-input" id="black_listed" name="black_listed" vlaue="Yes" type="checkbox" {{ ($isEdit && $Customer->black_listed == 'Yes') ? 'checked' : '' }} />Customer is blacklisted
                                                </label>
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1 el_min100">Corporation</label>
                                                <div class="form-check-inline form-check">
                                                   <label class="form-check-label">
                                                      <input class="form-check-input" id="is_broker" name="is_broker" vlaue="Yes" type="checkbox" {{ ($isEdit && $Customer->is_broker == 'Yes') ? 'checked' : '' }} />This is Broker
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
                                       <div class="row">
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Currency Setting</label>
                                                <select class="form-control shadow-none col-12" id="curr_setting" name="curr_setting">
                                                   <option value="">Please Select</option>
                                                   <option value="1" {{ $isEdit && $Customer->curr_setting == 1 ? 'selected' : '' }}>American Dollars</option>
                                                   <option value="2" {{ $isEdit && $Customer->curr_setting == 2 ? 'selected' : '' }}>Canadian Dollar</option>
                                                   <option value="3" {{ $isEdit && $Customer->curr_setting == 3 ? 'selected' : '' }}>Euros</option>
                                                </select>
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Payment Terms </label><span style="color:red;">*</span>
                                                <select class="form-control shadow-none col-12 required" id="payment_terms" name="payment_terms">
                                                   <option value="">Please Select</option>
                                                   <option value="1" {{ $isEdit && $Customer->payment_terms == 1 ? 'selected' : '' }}>.5/10 Net 30</option>
                                                   <option value="2" {{ $isEdit && $Customer->payment_terms == 2 ? 'selected' : '' }}>1.5/2 Net 30</option>
                                                   <option value="3" {{ $isEdit && $Customer->payment_terms == 3 ? 'selected' : '' }}>1.5/15 Net 30</option>
                                                   <option value="4" {{ $isEdit && $Customer->payment_terms == 4 ? 'selected' : '' }}>1/7 Net 15</option>
                                                   <option value="5" {{ $isEdit && $Customer->payment_terms == 5 ? 'selected' : '' }}>1/10 Net 30</option>
                                                   <option value="6" {{ $isEdit && $Customer->payment_terms == 6 ? 'selected' : '' }}>1/14 Net 30</option>
                                                   <option value="7" {{ $isEdit && $Customer->payment_terms == 7 ? 'selected' : '' }}>2/7 Net 30</option>
                                                   <option value="8" {{ $isEdit && $Customer->payment_terms == 8 ? 'selected' : '' }}>2/10 Net 30</option>
                                                   <option value="9" {{ $isEdit && $Customer->payment_terms == 9 ? 'selected' : '' }}>2/15 Net 30</option>
                                                   <option value="10" {{ $isEdit && $Customer->payment_terms == 10 ? 'selected' : '' }}>3.5/7 Net 30</option>
                                                   <option value="11" {{ $isEdit && $Customer->payment_terms == 11 ? 'selected' : '' }}>3/7 Net 30</option>
                                                   <option value="12" {{ $isEdit && $Customer->payment_terms == 12 ? 'selected' : '' }}>3/10 Net 30</option>
                                                   <option value="13" {{ $isEdit && $Customer->payment_terms == 13 ? 'selected' : '' }}>4/7 Net 30</option>
                                                   <option value="14" {{ $isEdit && $Customer->payment_terms == 14 ? 'selected' : '' }}>5/1 Net 30</option>
                                                   <option value="15" {{ $isEdit && $Customer->payment_terms == 15 ? 'selected' : '' }}>5/10 Net 30</option>
                                                   <option value="16" {{ $isEdit && $Customer->payment_terms == 16 ? 'selected' : '' }}>5/28 Net 30</option>
                                                   <option value="17" {{ $isEdit && $Customer->payment_terms == 17 ? 'selected' : '' }}>ACH</option>
                                                   <option value="18" {{ $isEdit && $Customer->payment_terms == 18 ? 'selected' : '' }}>ACH 14 Days</option>
                                                   <option value="19" {{ $isEdit && $Customer->payment_terms == 19 ? 'selected' : '' }}>ACH 30 Days</option>
                                                   <option value="20" {{ $isEdit && $Customer->payment_terms == 20 ? 'selected' : '' }}>COD (Cash or Check on Delivery)</option>
                                                   <option value="21" {{ $isEdit && $Customer->payment_terms == 21 ? 'selected' : '' }}>COP (Cash or Check on Pick-up)</option>
                                                   <option value="22" {{ $isEdit && $Customer->payment_terms == 22 ? 'selected' : '' }}>Consignment</option>
                                                   <option value="23" {{ $isEdit && $Customer->payment_terms == 23 ? 'selected' : '' }}>Credit Card</option>
                                                   <option value="24" {{ $isEdit && $Customer->payment_terms == 24 ? 'selected' : '' }}>Due on Receipt</option>
                                                   <option value="25" {{ $isEdit && $Customer->payment_terms == 25 ? 'selected' : '' }}>Net1</option>
                                                   <option value="26" {{ $isEdit && $Customer->payment_terms == 26 ? 'selected' : '' }}>Net 2</option>
                                                   <option value="27" {{ $isEdit && $Customer->payment_terms == 27 ? 'selected' : '' }}>Net 3</option>
                                                   <option value="28" {{ $isEdit && $Customer->payment_terms == 28 ? 'selected' : '' }}>Net 4</option>
                                                   <option value="29" {{ $isEdit && $Customer->payment_terms == 29 ? 'selected' : '' }}>Net 5</option>
                                                   <option value="30" {{ $isEdit && $Customer->payment_terms == 30 ? 'selected' : '' }}>Net 6</option>
                                                   <option value="31" {{ $isEdit && $Customer->payment_terms == 31 ? 'selected' : '' }}>Net 7</option>
                                                   <option value="32" {{ $isEdit && $Customer->payment_terms == 32 ? 'selected' : '' }}>Net 8</option>
                                                   <option value="33" {{ $isEdit && $Customer->payment_terms == 33 ? 'selected' : '' }}>Net 9</option>
                                                   <option value="34" {{ $isEdit && $Customer->payment_terms == 34 ? 'selected' : '' }}>Net 10</option>
                                                   <option value="35" {{ $isEdit && $Customer->payment_terms == 35 ? 'selected' : '' }}>Net 11</option>
                                                   <option value="36" {{ $isEdit && $Customer->payment_terms == 36 ? 'selected' : '' }}>Net 12</option>
                                                   <option value="37" {{ $isEdit && $Customer->payment_terms == 37 ? 'selected' : '' }}>Net 13</option>
                                                   <option value="38" {{ $isEdit && $Customer->payment_terms == 38 ? 'selected' : '' }}>Net 14</option>
                                                   <option value="39" {{ $isEdit && $Customer->payment_terms == 39 ? 'selected' : '' }}>Net 15</option>
                                                   <option value="40" {{ $isEdit && $Customer->payment_terms == 40 ? 'selected' : '' }}>Net 16</option>
                                                   <option value="41" {{ $isEdit && $Customer->payment_terms == 41 ? 'selected' : '' }}>Net 17</option>
                                                   <option value="42" {{ $isEdit && $Customer->payment_terms == 42 ? 'selected' : '' }}>Net 18</option>
                                                   <option value="43" {{ $isEdit && $Customer->payment_terms == 43 ? 'selected' : '' }}>Net 19</option>
                                                   <option value="44" {{ $isEdit && $Customer->payment_terms == 44 ? 'selected' : '' }}>Net 20</option>
                                                   <option value="45" {{ $isEdit && $Customer->payment_terms == 45 ? 'selected' : '' }}>Net 21</option>
                                                   <option value="46" {{ $isEdit && $Customer->payment_terms == 46 ? 'selected' : '' }}>Net 22</option>
                                                   <option value="47" {{ $isEdit && $Customer->payment_terms == 47 ? 'selected' : '' }}>Net 23</option>
                                                   <option value="48" {{ $isEdit && $Customer->payment_terms == 48 ? 'selected' : '' }}>Net 24</option>
                                                   <option value="49" {{ $isEdit && $Customer->payment_terms == 49 ? 'selected' : '' }}>Net 25</option>
                                                   <option value="50" {{ $isEdit && $Customer->payment_terms == 50 ? 'selected' : '' }}>Net 26</option>
                                                   <option value="51" {{ $isEdit && $Customer->payment_terms == 51 ? 'selected' : '' }}>Net 27</option>
                                                   <option value="52" {{ $isEdit && $Customer->payment_terms == 52 ? 'selected' : '' }}>Net 28</option>
                                                   <option value="53" {{ $isEdit && $Customer->payment_terms == 53 ? 'selected' : '' }}>Net 29</option>
                                                   <option value="54" {{ $isEdit && $Customer->payment_terms == 54 ? 'selected' : '' }}>Net 30</option>
                                                   <option value="55" {{ $isEdit && $Customer->payment_terms == 55 ? 'selected' : '' }}>Net 30 (From Ship Date)</option>
                                                   <option value="56" {{ $isEdit && $Customer->payment_terms == 56 ? 'selected' : '' }}>Net 35</option>
                                                   <option value="57" {{ $isEdit && $Customer->payment_terms == 57 ? 'selected' : '' }}>Net 37</option>
                                                   <option value="58" {{ $isEdit && $Customer->payment_terms == 58 ? 'selected' : '' }}>Net 45</option>
                                                   <option value="59" {{ $isEdit && $Customer->payment_terms == 59 ? 'selected' : '' }}>Net 60</option>
                                                   <option value="60" {{ $isEdit && $Customer->payment_terms == 60 ? 'selected' : '' }}>Net 80</option>
                                                   <option value="61" {{ $isEdit && $Customer->payment_terms == 61 ? 'selected' : '' }}>Net 90</option>
                                                   <option value="62" {{ $isEdit && $Customer->payment_terms == 62 ? 'selected' : '' }}>Prepaid</option>
                                                   <option value="63" {{ $isEdit && $Customer->payment_terms == 63 ? 'selected' : '' }}>Quick Pay .5% 1 Day</option>
                                                   <option value="64" {{ $isEdit && $Customer->payment_terms == 64 ? 'selected' : '' }}>Quick Pay 1% 10 Days</option>
                                                   <option value="65" {{ $isEdit && $Customer->payment_terms == 65 ? 'selected' : '' }}>Quick Pay 1% 14 Days</option>
                                                   <option value="66" {{ $isEdit && $Customer->payment_terms == 66 ? 'selected' : '' }}>Quick Pay 1% 15 Days</option>
                                                   <option value="67" {{ $isEdit && $Customer->payment_terms == 67 ? 'selected' : '' }}>Quick Pay 1.5 % 2 Days</option>
                                                   <option value="68" {{ $isEdit && $Customer->payment_terms == 68 ? 'selected' : '' }}>Quick Pay 1.5 % 3 Days</option>
                                                   <option value="69" {{ $isEdit && $Customer->payment_terms == 69 ? 'selected' : '' }}>Quick Pay 1.5% 7 Days</option>

                                                </select>
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Credit Limits</label><span style="color:red;">*</span>
                                                <input Placeholder="" class="form-control required" id="credit_limit" name="credit_limit" type="text" value="{{ $isEdit ? $Customer->credit_limit : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Sales Rep.</label>
                                                <select class="form-control shadow-none col-12" id="sales_rep" name="sales_rep">
                                                   <option value="">Please Select</option>
                                                   <option value="Anu M" {{ $isEdit && $Customer->sales_rep == 'Anu M' ? 'selected' : '' }}>Anu M</option>
                                                </select>
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Factoring Company</label>
                                                <select class="form-control shadow-none col-12" id="factoring_company" name="factoring_company">
                                                   <option value="">Please Select</option>
                                                   <option value="No Factoring" {{ $isEdit && $Customer->factoring_company == 'No Factoring' ? 'selected' : '' }}>No Factoring</option>
                                                </select>
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Federal ID</label>
                                                <input Placeholder="Federal ID" class="form-control" id="federal_id" name="federal_id" type="text" value="{{ $isEdit ? $Customer->federal_id : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Worker Comp # </label>
                                                <input Placeholder="Worker Comp #" class="form-control" id="workers_comp" name="workers_comp" type="text" value="{{ $isEdit ? $Customer->workers_comp : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Website URL</label>
                                                <input Maxlength="150" Placeholder="www.abc.com" class="form-control" id="website_url" name="website_url" type="text" value="{{ $isEdit ? $Customer->website_url : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1 el_min100">Number on Invoice</label>
                                                <div class="form-check-inline form-check">
                                                   <label class="form-check-label">
                                                      <input class="form-check-input" data-val="true" id="show_tel_tax" name="show_tel_tax" value="Yes" type="checkbox" {{ ($isEdit && $Customer->show_tel_tax == 'Yes') ? 'checked' : '' }} /> Show tel. and Fax numbers on invoice
                                                   </label>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1 el_min100">Duplicate</label>
                                                <div class="form-check-inline form-check">
                                                   <label class="form-check-label">
                                                      <input class="form-check-input" id="as_shipper" name="as_shipper" value="Yes" type="checkbox" {{ ($isEdit && $Customer->as_shipper == 'Yes') ? 'checked' : '' }} />Add As Shipper
                                                   </label>
                                                   <label class="form-check-label" style="padding-left:20px;">
                                                      <input class="form-check-input" id="as_consignee" value="Yes" name="as_consignee" type="checkbox" {{ ($isEdit && $Customer->as_consignee == 'Yes') ? 'checked' : '' }} />Add As Consignee
                                                   </label>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-9">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Internal Notes</label>
                                                <textarea Placeholder="Internal Notes" class="form-control el_textarea100" cols="20" id="internal_notes" name="internal_notes" rows="2">{{ $isEdit ? $Customer->internal_notes : '' }}</textarea>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="form_bbtns text-end">
                                          <button type="button" class="btn btn-primary text-white commonBtn rounded px-3 nextBtn">Next</button>
                                       </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab04" role="tabpanel">
                                       <div class="row">
                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1 el_min100">Show Miles On quote</label>
                                                <div class="form-check-inline form-check">
                                                   <label class="form-check-label">
                                                      <input class="form-check-input" id="show_miles_quote" name="show_miles_quote" type="checkbox" value="Yes" {{ ($isEdit && $Customer->show_miles_quote == 'Yes') ? 'checked' : '' }} />
                                                   </label>
                                                </div>
                                             </div>
                                             <br>
                                          </div>

                                          <div class="col-md-3">
                                             <div class="form-group mb-3">
                                                <label class="control-label mb-1">Rate Type</label>
                                                <input Placeholder="Rate Type" class="form-control" id="rate_type" name="rate_type" type="text" value="{{ $isEdit ? $Customer->rate_type : '' }}" />
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="row">
                                                <div class="col-md-4 el_small_fld">
                                                   <div class="form-group mb-3">
                                                      <label class="control-label mb-1">FSC Type</label>
                                                      <select class="form-control shadow-none col-12" id="fsc_type" name="fsc_type">
                                                         <option value="$" {{ $isEdit && $Customer->fsc_type == '$' ? 'selected' : '' }}>$</option>
                                                         <option value="%" {{ $isEdit && $Customer->fsc_type == '%' ? 'selected' : '' }}>%</option>
                                                      </select>
                                                   </div>
                                                </div>
                                                <div class="col-md-8">
                                                   <div class="form-group mb-3">
                                                      <label class="control-label mb-1">FSC Rate</label>
                                                      <input Placeholder="FSC Rate" class="form-control" id="fsc_rate" name="fsc_rate" type="text" value="{{ $isEdit ? $Customer->fsc_rate : '' }}" />
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="form_bbtns text-end">
                                          <input type="hidden" name="customer_id" value="{{ $isEdit ? $Customer->id : '' }}">
                                          <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
                                          @if (!empty($Customer->id))
                                          <button type="submit" class="btn btn-primary text-white commonBtn rounded px-3">Update</button>
                                          @else
                                          <button type="submit" class="btn btn-primary text-white commonBtn rounded px-3">Save</button>
                                          @endif
                                       </div>
                                    </div>

                                 </div>


                                 <!-- <div class="form_bbtns text-end">
                                    <a class="btn btn-primary  text-white commonBtn rounded submit px-3" href="index.php" style="">Cancel</a>
                                 </div> -->
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
</div>
@include('footer')
<script>
   var $countryDropdown = $('#strCountryID');
   var $stateDropdown = $('#strStateID');
   var selectedState = "{{ $isEdit ? $Customer->state : '' }}";

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



   var $countrybillDropdown = $('#strBillingCountryID');
   var $statebillDropdown = $('#strBillingStateID');
   var selectbilledState = "{{ $isEdit ? $Customer->bill_state : '' }}";

   function loadbilStates(countrybillId, selectbilledState = '') {
      $statebillDropdown.html('<option value="">Please Select</option>');
      if (!countrybillId) return;

      $.ajax({
         url: "{{ route('states.get') }}",
         type: 'GET',
         data: {
            bill_country_id: countrybillId
         },
         dataType: 'json',
         success: function(response) {
            if (response.length > 0) {
               $.each(response, function(index, state) {
                  var option = $('<option>', {
                     value: state.id,
                     text: state.name
                  });
                  if (state.id == selectbilledState) {
                     option.prop('selected', true);
                  }
                  $statebillDropdown.append(option);
               });
            } else {
               $statebillDropdown.append('<option value="">No states found</option>');
            }
         },
         error: function() {
            alert('Error loading states.');
         }
      });
   }

   $countrybillDropdown.on('change', function() {
      loadbilStates($(this).val());
   });

   var initialbillCountry = $countrybillDropdown.val();
   if (initialbillCountry) {
      loadbilStates(initialbillCountry, selectbilledState);
   }
</script>
<script>
   document.getElementById('ISBillingAddSameAsMailing').addEventListener('change', function() {
      var address = document.getElementById('address').value;
      var address_line2 = document.getElementById('address_line2').value;
      var address_line3 = document.getElementById('address_line3').value;
      var strCountryID = document.getElementById('strCountryID').value;
      var strStateID = document.getElementById('strStateID').value;
      var city = document.getElementById('city').value;
      var zip_code = document.getElementById('zip_code').value;

      var bill_addressField = document.getElementById('bill_address');
      var bill_address_line2Field = document.getElementById('bill_address_line2');
      var bill_address_line3Field = document.getElementById('bill_address_line3');
      var strBillingCountryIDField = document.getElementById('strBillingCountryID');
      var strBillingStateIDField = document.getElementById('strBillingStateID');
      var bill_cityField = document.getElementById('bill_city');
      var bill_zip_codeField = document.getElementById('bill_zip_code');

      if (this.checked) {
         bill_addressField.value = address;
         bill_address_line2Field.value = address_line2;
         bill_address_line3Field.value = address_line3;
         strBillingCountryIDField.value = strCountryID;

         var selectedStateDropdown = document.getElementById('strStateID');
         var selectedStateID = selectedStateDropdown.value;
         var selectedStateName = selectedStateDropdown.options[selectedStateDropdown.selectedIndex]?.text || '';

         var billingStateDropdown = document.getElementById('strBillingStateID');
         var optionExists = false;

         for (var i = 0; i < billingStateDropdown.options.length; i++) {
            if (billingStateDropdown.options[i].value === selectedStateID) {
               billingStateDropdown.selectedIndex = i;
               optionExists = true;
               break;
            }
         }

         if (!optionExists && selectedStateID !== '') {
            var newOption = document.createElement("option");
            newOption.value = selectedStateID;
            newOption.text = selectedStateName;
            billingStateDropdown.appendChild(newOption);
            billingStateDropdown.selectedIndex = billingStateDropdown.options.length - 1;
         }

         strBillingStateIDField.value = selectedStateID;

         bill_cityField.value = city;
         bill_zip_codeField.value = zip_code;

         bill_addressField.disabled = true;
         bill_address_line2Field.disabled = true;
         bill_address_line3Field.disabled = true;
         strBillingCountryIDField.disabled = true;
         strBillingStateIDField.disabled = true;
         bill_cityField.disabled = true;
         bill_zip_codeField.disabled = true;

      } else {
         // Enable fields
         bill_addressField.disabled = false;
         bill_address_line2Field.disabled = false;
         bill_address_line3Field.disabled = false;
         strBillingCountryIDField.disabled = false;
         strBillingStateIDField.disabled = false;
         bill_cityField.disabled = false;
         bill_zip_codeField.disabled = false;
      }
   });


   document.getElementById('address').addEventListener('input', function() {
      if (document.getElementById('ISBillingAddSameAsMailing').checked) {
         document.getElementById('bill_address').value = this.value;
      }
   });
   document.getElementById('address_line2').addEventListener('input', function() {
      if (document.getElementById('ISBillingAddSameAsMailing').checked) {
         document.getElementById('bill_address_line2').value = this.value;
      }
   });
   document.getElementById('address_line3').addEventListener('input', function() {
      if (document.getElementById('ISBillingAddSameAsMailing').checked) {
         document.getElementById('bill_address_line3').value = this.value;
      }
   });
   document.getElementById('strCountryID').addEventListener('input', function() {
      if (document.getElementById('ISBillingAddSameAsMailing').checked) {
         document.getElementById('strBillingCountryID').value = this.value;
      }
   });


   document.getElementById('strStateID').addEventListener('change', function() {
      if (document.getElementById('ISBillingAddSameAsMailing').checked) {
         var selectedStateID = this.value;
         var selectedStateName = this.options[this.selectedIndex].text;

         document.getElementById('strBillingStateID').value = selectedStateID;

         var billingStateDropdown = document.getElementById('strBillingStateID');

         var optionExists = false;
         for (var i = 0; i < billingStateDropdown.options.length; i++) {
            if (billingStateDropdown.options[i].value == selectedStateID) {
               billingStateDropdown.selectedIndex = i;
               optionExists = true;
               break;
            }
         }

         if (!optionExists) {
            var newOption = document.createElement("option");
            newOption.value = selectedStateID;
            newOption.text = selectedStateName;
            billingStateDropdown.appendChild(newOption);
            billingStateDropdown.selectedIndex = billingStateDropdown.options.length - 1;
         }
      }
   });


   document.getElementById('city').addEventListener('input', function() {
      if (document.getElementById('ISBillingAddSameAsMailing').checked) {
         document.getElementById('bill_city').value = this.value;
      }
   });

   document.getElementById('zip_code').addEventListener('input', function() {
      if (document.getElementById('ISBillingAddSameAsMailing').checked) {
         document.getElementById('bill_zip_code').value = this.value;
      }
   });
</script>
<script>
$(document).ready(function() {

    function validateEmail(email) {
        var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    function validateCurrentTab(tab) {
        var valid = true;

        tab.find('.required').each(function() {
            if (!$(this).val().trim()) {
                $(this).addClass('is-invalid');
                valid = false;
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        tab.find('input[type="email"]').each(function() {
            var email = $(this).val().trim();
            if (email !== '' && !validateEmail(email)) {
                if (!$(this).next('.error-msg').length) {
                    $(this).after('<span class="error-msg" style="color:red;">Please enter a valid email.</span>');
                }
                valid = false;
            } else {
                $(this).next('.error-msg').remove();
            }
        });

        return valid;
    }

    $('.nextBtn').on('click', function() {
        var currentTab = $(this).closest('.tab-pane');

        if (validateCurrentTab(currentTab)) {
            var nextTab = currentTab.next('.tab-pane');
            if (nextTab.length) {
                var nextTabId = nextTab.attr('id');
                $('a[href="#' + nextTabId + '"]').tab('show');
            }
        } else {
            alert('Please fill all required filed before proceeding.');
        }
    });

    $('a[data-bs-toggle="tab"]').on('show.bs.tab', function(e) {
        var currentTab = $('.tab-pane.active');

        var targetTab = $(this).attr('href');
        var currentIndex = parseInt(currentTab.attr('id').replace('tab', ''), 10);
        var targetIndex = parseInt(targetTab.replace('#tab', ''), 10);

        if (targetIndex > currentIndex) {
            if (!validateCurrentTab(currentTab)) {
                e.preventDefault();
                alert('Please fill all required filed before proceeding.');
                currentTab.find('.required.is-invalid:first, input[type="email"].is-invalid:first').focus();
            }
        }
    });

    $('#secondary_email, #bill_mail').on('blur', function() {
        var tab = $(this).closest('.tab-pane');
        validateCurrentTab(tab);
    });

});
</script>


<style>
   .is-invalid {
      border-color: red !important;
   }
</style>