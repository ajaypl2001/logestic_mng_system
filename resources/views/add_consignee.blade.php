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
                     @if (!empty($Consignees->id))
                        <h4 class="card-title d-flex align-items-center gap-1" id="hidden_column"> Update Consignee </h4>
                     @else
                        <h4 class="card-title d-flex align-items-center gap-1" id="hidden_column"> Add Consignee </h4>
                     @endif
                     
                     <a href="{{ route('consignee-list')}}" class="btn btn-primary btn-sm"><i class="bx bx-arrow-back me-1"></i>Back </a>
                  </div>
               </div>
                @php
                  $isEdit = isset($Consignees);
               @endphp
               <div class="card-body">
                  <div class="row">
                     <div class="col-lg-12">
                        
                        <form action="{{ $isEdit ? route('update_consignee', $Consignees->id) : route('add_consignee_query') }}" id="ConsigneeForm" method="post">
                           @csrf
                           <div class="row">
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Name</label><span style="color:red">*</span>
                                    <input Placeholder="Name" class="form-control required" id="ConsignName" name="ConsignName" type="text" value="{{ $isEdit ? $Consignees->name : '' }}" />
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Address</label>
                                    <input Placeholder="Address" class="form-control required" id="AddressL1" name="AddressL1" type="text" value="{{ $isEdit ? $Consignees->addressl_1 : '' }}" />
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Address Line 2</label>
                                    <input Placeholder="Address Line 2" class="form-control" id="AddressL2" name="AddressL2" type="text" value="{{ $isEdit ? $Consignees->addressl_2 : '' }}" />
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Address Line 3</label>
                                    <input Placeholder="Address Line 3" class="form-control" id="AddressL3" name="AddressL3" type="text" value="{{ $isEdit ? $Consignees->addressl_3 : '' }}" />
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Country</label><span style="color:red">*</span>
                                    <select class="form-control shadow-none col-12 required" data-val="true" data-val-required="Country is required" id="strCountryID" name="country" >
                                       <option value="">Please Select</option>

                                       @foreach($countries as $country)
                                       <option value="{{ $country->countries_iso_code }}" 
                                             {{ $isEdit && $Consignees->country_name == $country->countries_iso_code ? 'selected' : '' }}>
                                             {{ $country->countries_name }}
                                       </option>
                                       @endforeach
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">State</label><span style="color:red">*</span>
                                    <select class="form-control shadow-none col-12 required" id="strStateID" name="state" >
                                       <option value="">Please Select</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">City</label><span style="color:red">*</span>
                                    <input Placeholder="City" class="form-control " id="City" name="City" type="text" value="{{ $isEdit ? $Consignees->city : '' }}"  />
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Zip</label><span style="color:red">*</span>
                                    <input Placeholder="Zip" class="form-control " id="ZipCode" name="ZipCode" type="text" value="{{ $isEdit ? $Consignees->zip_code : '' }}" />
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Contact Name</label>
                                    <input Placeholder="Contact Name" class="form-control " id="ContactName" name="ContactName" type="text" value="{{ $isEdit ? $Consignees->contact_name : '' }}" />
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Contact Email</label>
                                    <input Placeholder="Contact Email" class="form-control" id="ContactEmail" name="ContactEmail" type="text" value="{{ $isEdit ? $Consignees->contact_email : '' }}" />
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Telephone</label><span style="color:red">*</span>
                                    <input Placeholder="XXX-XXX-XXXX" class="form-control phone telephone required" id="Telephone" name="Telephone" type="text" value="{{ $isEdit ? $Consignees->tele_phone : '' }}" />
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Ext</label>
                                    <input Placeholder="Ext." class="form-control" id="TelephoneExt" name="TelephoneExt" type="number" value="{{ $isEdit ? $Consignees->telephone_ext : '' }}" />
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Toll Free</label>
                                    <input Placeholder="XXX-XXX-XXXX" class="form-control telephone" id="TollFree" name="TollFree" type="text" value="{{ $isEdit ? $Consignees->toll_free : '' }}" />
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Fax</label>
                                    <input Placeholder="XXX-XXX-XXXX" class="form-control telephone" id="Fax" name="Fax" type="text" value="{{ $isEdit ? $Consignees->fax : '' }}" />
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Shipping Hours</label>
                                    <input Placeholder="Shipping Hours" class="form-control " id="strShippingHours" name="strShippingHours" type="text" value="{{ $isEdit ? $Consignees->consignee_hours : '' }}" />
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Appointments</label>
                                    <select class="form-control shadow-none col-12 " id="strAppointments" name="strAppointments">
                                       <option value="">Please Select</option>
                                       <option value="No" {{ ($isEdit && $Consignees->appointments == 'No') ? 'selected' : '' }}>No</option>
                                       <option value="Yes" {{ ($isEdit && $Consignees->appointments == 'Yes') ? 'selected' : '' }}>Yes</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Major Intersections/Directions</label>
                                    <input Placeholder="Major Intersections/Directions" class="form-control" id="MajorInspectionDirections" name="MajorInspectionDirections" type="text" value="{{ $isEdit ? $Consignees->major_inspection_Dir : '' }}" />
                                 </div>
                              </div>
                              <!-- <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Add As Shipper</label>
                                    <input Placeholder="Appointments" class="form-control" id="DuplicateInfo" name="DuplicateInfo" type="checkbox" value="true" />
                                    <input name="DuplicateInfo" type="hidden" value="false" />
                                 </div>
                              </div> -->

                              <div class="col-md-4">
                                 <div class="form-group text-center mb-3">
                                    <label class="form-label d-block mb-2 text-start">Add As Shipper</label>
                                    <input class="form-check-input " id="as_shipper" name="as_shipper"  type="checkbox" value="Yes" {{ ($isEdit && $Consignees->as_shipper == 'Yes') ? 'checked' : '' }} >
                                 </div>
                              </div>


                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Status</label><span style="color:red">*</span>
                                    <select class="form-control shadow-none col-12 required" id="strStatusInd" name="strStatusInd" width="100px">
                                       <option value="">Please Select</option>
                                     <option value="2" {{ ($isEdit && $Consignees->acc_sts == 2) ? 'selected' : '' }}>Inactive</option>
                                    <option value="1" {{ ($isEdit && $Consignees->acc_sts == 1) ? 'selected' : '' }}>Active</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Shipping Note</label>
                                    <textarea class="form-control shadow-none col-12 " cols="20" id="Notes" name="Notes" rows="5" >{{ $isEdit ? $Consignees->notes : '' }}</textarea>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Internal Note</label>
                                    <textarea class="form-control shadow-none col-12" cols="20" id="InternalNotes" name="InternalNotes" rows="5">{{ $isEdit ? $Consignees->internal_notes : '' }}</textarea>
                                 </div>
                              </div>
                              <div class="col-md-12 text-end">
                                 <input type="hidden" name="consignee_id" value="{{ $isEdit ? $Consignees->id : '' }}">
                                 <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
                                 @if (!empty($Consignees->id))
                                    <button type="submit" class="btn btn-success commonBtn"> Update </button>
                                 @else
                                    <button type="submit" class="btn btn-success commonBtn"> Submit </button>
                                 @endif
                                 
                                 <a class="btn btn-primary  text-white commonBtn rounded submit px-3" href="{{ route('consignee-list')}}">Cancel</a>
                              </div>
                           </div>
                        </form>
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
$(document).ready(function() {
    var $countryDropdown = $('#strCountryID');
    var $stateDropdown = $('#strStateID');
    var selectedState = "{{ $isEdit ? $Consignees->state_name : '' }}"; 

    function loadStates(countryId, selectedState = '') {
        $stateDropdown.html('<option value="">Please Select</option>');
        if (!countryId) return;

        $.ajax({
            url: "{{ route('states.get') }}",
            type: 'GET',
            data: { country_id: countryId },
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
$(document).ready(function() {
    $('#ConsigneeForm').on('submit', function(e) {
        let valid = true;
        $('.required').removeClass('is-invalid');

        $(this).find('.required').each(function() {
            if ($(this).val().trim() === '') {
                $(this).addClass('is-invalid');
                valid = false;
            }
        });

        if (!valid) {
            e.preventDefault(); 
            alert('Please fill all fields.');
            $('.is-invalid:first').focus();
        }
    });

    $('.required').on('input', function() {
        if ($(this).val().trim() !== '') {
            $(this).removeClass('is-invalid');
        }
    });
});
</script>

<style>
   .is-invalid {
      border-color: red !important;
   }
</style>