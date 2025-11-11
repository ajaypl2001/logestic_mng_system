@include('header')
<!-- ==================================================== -->
<!-- Start right Content here -->
<!-- ==================================================== -->
<div class="page-content">
<!-- Start Container Fluid -->
<div class="container-fluid">
   @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" id="flash-message">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" id="flash-message">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
   <div class="row">
      <div class="col-xl-12">
         <div class="card">
            <div class="card-header">
               <div class="d-flex flex-wrap justify-content-between gap-3">
                  <h4 class="card-title d-flex align-items-center gap-1" id="hidden_column"> Load Creation </h4>
                  <a href="{{ route('add-load-creation')}}" class="btn btn-primary"><i class="bx bx-plus me-1"></i>Add Pending Load</a>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table  id="customerTable" class="table align-middle mb-0 table-hover table-centered">
                     <thead class="table-dark">
                        <tr>
                           <th>Load #</th>
                           <th>Payment Type</th>
                           <th>W/O #</th>
                           <th>Driver/Carrier</th>
                           <th>Ship Date</th>
                           <th>Load Creation Date</th>
                           <th>Del Date</th>
                           <th>Customer</th>
                           <th>Origin</th>
                           <th>Destination</th>
                           <th>Shipper Rate</th>
                           <th>Career fee</th>
                           <th>Load Status</th>
                           <th>AR</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($loads as $load)
                           <tr>
                           <td>{{$load->id}}</td>
                           <td>{{$load->payment_type}}</td>
                           <td>{{$load->wo}}</td>
                           <td>N/A</td>
                           <td>{{$load->created_at}}</td>
                           <td>{{$load->created_at}}</td>
                           <td>N/A</td>
                           <td>{{ $load->customer->customer_name ?? '' }}</td>
                           <td>N/A</td>
                           <td>N/A</td>
                           <td>{{$load->shipper_rate}}</td>
                           <td>{{$load->carrier_fee}}</td>
                           <td>
                              <select class="form-select load-status" id="load_status" data-id="{{ $load->id }}" name="status" required style="width: 150px !important;">
                                 <option value="">Select Status</option>
                                 <option value="Open" {{ $load->load_status == 'Open' ? 'selected' : '' }}>Open</option>
                                 <option value="Covered" {{ $load->load_status == 'Covered' ? 'selected' : '' }}>Covered</option>
                                 <option value="Dispatched" {{ $load->load_status == 'Dispatched' ? 'selected' : '' }}>Dispatched</option>
                                 <option value="Loading" {{ $load->load_status == 'Loading' ? 'selected' : '' }}>Loading</option>
                                 <option value="On Route" {{ $load->load_status == 'On Route' ? 'selected' : '' }}>On Route</option>
                                 <option value="Unloading" {{ $load->load_status == 'Unloading' ? 'selected' : '' }}>Unloading</option>
                                 <option value="In Yard" {{ $load->load_status == 'In Yard' ? 'selected' : '' }}>In Yard</option>
                                 <option value="Delivered" {{ $load->load_status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                 <option value="Completed" {{ $load->load_status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                 <option value="Pending Claims" {{ $load->load_status == 'Pending Claims' ? 'selected' : '' }}>Pending Claims</option>
                                 <option value="Claim Closed" {{ $load->load_status == 'Claim Closed' ? 'selected' : '' }}>Claim Closed</option>
                                 <option value="To be recovered" {{ $load->load_status == 'To be recovered' ? 'selected' : '' }}>To be recovered</option>
                              </select>
                           </td>
                           <td>N/A</td>
                           <td>
                              <div class="d-flex gap-2">
                                 <a href="{{ route('edit_load_creation', ['id' => base64_encode($load->id)])}}" class="btn btn-soft-primary btn-sm">
                                    <iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon>
                                 </a>
                                 <a href="{{ route('generatePdf')}}" class="btn btn-soft-danger btn-sm" title="View PDF">
                                   <i class="fa-solid fa-file-pdf fs-18"></i>
                                 </a>
                              </div>
                           </td>
                        </tr>
                        @endforeach
                        
                     </tbody>
                  </table>
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
    $('.load-status').change(function() {
        var loadId = $(this).data('id');
        var status = $(this).val();

        $.ajax({
            url: '{{ route('load_updateStatus') }}', 
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: loadId,
                status: status
            },
            success: function(response) {
                alert('Load status updated successfully!');
            },
            error: function(xhr) {
                alert('Error updating status!');
                console.log(xhr.responseText);
            }
        });
    });
});
</script>

<script>

    setTimeout(function() {
        var flashMessage = document.getElementById('flash-message');
        if(flashMessage){

            var alert = new bootstrap.Alert(flashMessage);
            alert.close();
        }
    }, 10000);
</script>