


@include('header')
<div class="page-content">

   <!-- Start Container Fluid -->
   <div class="container-fluid">

      <div class="row">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-header">
                  <div class="d-flex flex-wrap justify-content-between gap-3">
                     @if (!empty($shipper->id))
                        <h4 class="card-title d-flex align-items-center gap-1">Update Shipper</h4>
                     @else
                        <h4 class="card-title d-flex align-items-center gap-1">Add Shipper</h4>
                     @endif
                     
                     <a href="{{ route('shipper-list')}}" class="btn btn-primary btn-sm"><i class="bx bx-arrow-back me-1"></i>Back </a>
                  </div>
               </div>
               @php
                  $isEdit = isset($shipper);
               @endphp
                              <div class="card-body">
                  <div class="row">
                     <div class="col-lg-12">
                        <form action="{{ $isEdit ? route('update_shipper', $shipper->id) : route('add_shipper_query') }}" id="ShipperForm" method="POST">
                           @csrf
                           <div class="row">

                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Name</label><span style="color:red;">*</span>
                                    <input Placeholder="Shipper Name" class="form-control required" id="shipper_name" name="shipper_name" type="text" value="{{ $isEdit ? $shipper->name : '' }}" />   
                                 </div>
                              </div>

                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Address</label><span style="color:red;">*</span>
                                    <input Placeholder="Address" class="form-control required" id="address" name="address" type="text" value="{{ $isEdit ? $shipper->addressl_1 : '' }}" />
                                 </div>
                              </div>

                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Address Line 2</label>
                                    <input Placeholder="Address Line 2" class="form-control" id="address_line2" name="address_line2" type="text" value="{{ $isEdit ? $shipper->addressl_2 : '' }}" />
                                 </div>
                              </div>

                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Address Line 3</label>
                                    <input Placeholder="Address Line 3" class="form-control" id="address_line3" name="address_line3" type="text" value="{{ $isEdit ? $shipper->addressl_3 : '' }}" />
                                 </div>
                              </div>

                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Country</label><span style="color:red;">*</span>
                                    <select class="form-control shadow-none col-12 required" data-val="true" data-val-required="Country is required" id="strCountryID" name="country" >
                                       <option value="">Please Select</option>

                                       @foreach($countries as $country)
                                       <option value="{{ $country->countries_iso_code }}" {{ $isEdit && $shipper->country_name == $country->countries_iso_code ? 'selected' : '' }}>
                                             {{ $country->countries_name }}
                                       </option>
                                       @endforeach
                                    </select>
                                 </div>
                              </div>

                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">State</label><span style="color:red;">*</span>
                                    <select class="form-control shadow-none col-12 required" id="strStateID" name="state" >
                                       <option value="">Please Select</option>
                                    </select>
                                 </div>
                              </div>

                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">City</label><span style="color:red;">*</span>
                                    <input Placeholder="City" class="form-control " id="city" name="city" type="text" value="{{ $isEdit ? $shipper->city : '' }}" />
                                 </div>
                              </div>

                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Zip</label><span style="color:red;">*</span>
                                    <input Placeholder="Zip" class="form-control " id="zip_code" name="zip_code" type="text" value="{{ $isEdit ? $shipper->zip_code : '' }}" />
                                 </div>
                              </div>

                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Contact Name</label>
                                    <input Placeholder="Contact Name" class="form-control " id="contact_name" name="contact_name" type="text" value="{{ $isEdit ? $shipper->contact_name : '' }}" />
                                 </div>
                              </div>

                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1"> Contact Email</label>
                                    <input Placeholder="test@test.com" class="form-control " id="email" name="email" type="email" value="{{ $isEdit ? $shipper->contact_email : '' }}" />
                                 </div>
                              </div>


                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Telephone</label><span style="color:red;">*</span>
                                    <input Placeholder="XXX-XXX-XXXX" class="form-control telephone required" id="telephone" name="telephone" type="text" value="{{ $isEdit ? $shipper->tele_phone : '' }}" />
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Ext.</label>
                                    <input Placeholder="XXXXX" class="form-control " id="extn" name="extn" type="text" value="{{ $isEdit ? $shipper->telephone_ext : '' }}" />
                                 </div>
                              </div>

                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Toll Free</label>
                                    <input Placeholder="XXX-XXX-XXXX" class="form-control telephone" id="toll_free" name="toll_free" type="text" value="{{ $isEdit ? $shipper->toll_free : '' }}" />
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Fax</label>
                                    <input Placeholder="XXX-XXX-XXXX" class="form-control telephone" id="fax" name="fax" type="text" value="{{ $isEdit ? $shipper->fax : '' }}" />
                                 </div>
                              </div>

                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Shipping Hours</label>
                                    <input Placeholder="Shipping Hours" class="form-control" id="shipping_hours" name="shipping_hours" type="text" value="{{ $isEdit ? $shipper->shipping_hours : '' }}" />
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Appointments</label>
                                    <select class="form-control shadow-none col-12" id="appointments" name="appointments" >
                                       <option value="">Please Select</option>
                                           <option value="No" {{ ($isEdit && $shipper->appointments == 'No') ? 'selected' : '' }}>No</option>
                                           <option value="Yes" {{ ($isEdit && $shipper->appointments == 'Yes') ? 'selected' : '' }}>Yes</option>
                                    </select>
                                 </div>
                              </div>


                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Major Intersections/Directions</label>
                                    <input Placeholder="Major Intersections/Directions" class="form-control" id="MajorInspectionDirections" name="MajorInspectionDirections" type="text" value="{{ $isEdit ? $shipper->major_inspection_Dir : '' }}" />
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group text-center mb-3">
                                    <label class="form-label d-block mb-2 text-start">Add As Consignee</label>
                                    <input class="form-check-input" id="as_consignee" name="as_consignee" type="checkbox" value="Yes"
                                       {{ ($isEdit && $shipper->as_consignee == 'Yes') ? 'checked' : '' }}>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Status</label><span style="color:red">*</span>
                                    <select class="form-control shadow-none col-12 required" id="acc_sts" name="acc_sts" width="100px">
                                       <option value="">Please Select</option>
                                       <option value="2" {{ ($isEdit && $shipper->acc_sts == 2) ? 'selected' : '' }}>Inactive</option>
                                       <option value="1" {{ ($isEdit && $shipper->acc_sts == 1) ? 'selected' : '' }}>Active</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Shipping Note</label>
                                    <textarea class="form-control shadow-none col-12" cols="20" id="shipping_notes" name="shipping_notes" rows="5">{{ $isEdit ? $shipper->notes : '' }}</textarea>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Internal Note</label>
                                    <textarea class="form-control shadow-none col-12" cols="20" id="internal_notes" name="internal_notes" rows="5">{{ $isEdit ? $shipper->internal_notes : '' }}</textarea>
                                 </div>
                              </div>
                           </div>

                           <div class="col-md-12 text-end">
                              <input type="hidden" name="shipper_id" value="{{ $isEdit ? $shipper->id : '' }}">
                              <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
                               @if (!empty($shipper->id))
                                    <button type="submit" class="btn btn-success  commonBtn"> Update </button>
                                 @else
                                    <button type="submit" class="btn btn-success  commonBtn"> Submit </button>
                                 @endif
                              
                              <a class="btn btn-primary  text-white commonBtn rounded submit px-3" href="{{ route('shipper-list')}}">Cancel</a>
                           </div>
                        </form>

                     </div>

                  </div>
               </div>
            </div>

         </div>
      </div>

   </div>

   <!-- End Container Fluid -->
   @include('footer')

<script>
$(document).ready(function() {
    var $countryDropdown = $('#strCountryID');
    var $stateDropdown = $('#strStateID');
    var selectedState = "{{ $isEdit ? $shipper->state_name : '' }}"; 

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
    $('#ShipperForm').on('submit', function(e) {
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