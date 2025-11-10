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
                     @if (!empty($Mc_data->id))
                        <h4 class="card-title d-flex align-items-center gap-1" id="hidden_column"> Update MC Check</h4>
                     @else
                        <h4 class="card-title d-flex align-items-center gap-1" id="hidden_column"> Add MC Check</h4>
                     @endif
                     
                     <a href="{{ route('mc-check-list')}}" class="btn btn-primary btn-sm"><i class="bx bx-arrow-back me-1"></i>Back </a>
                  </div>
               </div>
               @php
               $isEdit = isset($Mc_data);
               @endphp
               <div class="card-body">
                  <div class="row">
                     <div class="col-lg-12">

                        <form action="{{ $isEdit ? route('update_mc', $Mc_data->id) : route('add_mc_query') }}" id="MCCheckForm" method="post" enctype="multipart/form-data">
                           @csrf
                           <div class="row">
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">MC Number</label><span style="color:red">*</span>
                                    <input Placeholder="MC Number" class="form-control required" id="mc_no" name="mc_no" type="text" value="{{ $isEdit ? $Mc_data->mc_no : '' }}"  />
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Carrier Name</label>
                                    <input Maxlength="200" Placeholder="Carrier Name" class="form-control required" id="carrier_name" name="carrier_name" type="text" value="{{ $isEdit ? $Mc_data->carrier_name : '' }}"  />
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Commodity Type</label>
                                    <input Maxlength="200" Placeholder="Commodity Type" class="form-control required" id="commodity_type" name="commodity_type" type="text" value="{{ $isEdit ? $Mc_data->commodity_type : '' }}" />
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Commodity Value</label>
                                    <input Maxlength="100" Placeholder="Commodity Value" class="form-control required" id="commodity_value" name="commodity_value" type="text" value="{{ $isEdit ? $Mc_data->commodity_value : '' }}" />
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mb-3">
                                    <label class="control-label mb-1">Equipment Type</label>
                                    <select class="form-control shadow-none col-12 required" id="equ_type" name="equ_type" width="100px" >
                                       <option value="">Please Select</option>
                                       <option value="Air Freight" {{ $isEdit && $Mc_data->equ_type == 'Air Freight' ? 'selected' : '' }}>Air Freight</option>
                                       <option value="Anhydros Ammonia" {{ $isEdit && $Mc_data->equ_type == 'Anhydros Ammonia' ? 'selected' : '' }}>Anhydros Ammonia</option>
                                       <option value="Animal Carrier" {{ $isEdit && $Mc_data->equ_type == 'Animal Carrier' ? 'selected' : '' }}>Animal Carrier</option>
                                       <option value="Beam" {{ $isEdit && $Mc_data->equ_type == 'Beam' ? 'selected' : '' }}>Beam</option>
                                       <option value="Belly Dump" {{ $isEdit && $Mc_data->equ_type == 'Belly Dump' ? 'selected' : '' }}>Belly Dump</option>

                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="mb-3">
                                    <label for="files" class="form-label">Commodity Value Proof</label>
                                    <input class="form-control" type="file" id="files" name="com_value_prf" value="">
                                    @if($isEdit && $Mc_data->com_value_prf)
                                    <a href="{{ asset('images/'.$Mc_data->com_value_prf) }}" target="_blank">View Current File</a>
                                    @endif
                                 </div>
                              </div>
                              <div class="col-md-12 text-end">
                                 <input type="hidden" name="mc_id" value="{{ $isEdit ? $Mc_data->id : '' }}">
                                 <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
                                 @if (!empty($Mc_data->id))
                                    <button type="submit" class="btn btn-success commonBtn">Update</button>
                                 @else
                                    <button type="submit" class="btn btn-success commonBtn">Submit</button>
                                 @endif
                                 
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
$(document).ready(function() {
    $('#MCCheckForm').on('submit', function(e) {
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