@include('header')
<div class="page-content">
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
                    <h4 class="card-title d-flex align-items-center gap-1" id="hidden_column">Shipper Listing</h4>
                    <div class="d-flex gap-2">
                     <a href="{{ route('export_shipper')}}" class="btn btn-success btn-sm d-flex align-items-center gap-1">
                        <iconify-icon icon="vscode-icons:file-type-excel" class="fs-5"></iconify-icon>
                        <span>Excel</span>
                        <iconify-icon icon="solar:download-linear" class="fs-5"></iconify-icon>
                     </a>
                     <a href="{{ route('add_shipper')}}" class="btn btn-primary btn-sm"><i class="bx bx-plus me-1"></i>Add Shipper</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table  id="customerTable" class="table align-middle mb-0 table-hover table-centered">
                     <thead class="table-dark">
                        <tr>
                          <th>Name</th>
                          <th>Address</th>
                          <th>Contact No.</th>
                          <th>Status</th>
                          <th>Date Added</th>
                          <th>Added By User</th>
                          <th>Team Lead</th>
                          <th>Team Manager</th>
                          <th>Actions</th>
                        </tr>
                     </thead>
                     <tbody>
                             @foreach ($shipers as $shiper)
                        <tr>
                           <td>{{$shiper->name}}</td>
                           <td>{{$shiper->addressl_1}}</td>
                           <td>{{$shiper->tele_phone}}</td>
                           <td>
                              @if($shiper->acc_sts == 1)
                                 <span class="badge bg-success">Active</span>
                              @else
                                 <span class="badge bg-danger">Deactive</span>
                              @endif
                           </td>
                           <td>{{ $shiper->created_at->format('Y-m-d') }}</td>
                           <td>{{ $shiper->user ? $shiper->user->name : 'N/A' }}</td>
                           <td>{{ $shiper->user && $shiper->user->teamLead ? $shiper->user->teamLead->name : 'N/A' }}</td>
                           <td>{{ $shiper->user && $shiper->user->teamManager ? $shiper->user->teamManager->name : 'N/A' }}</td>
         
                           <td>
                              <div class="d-flex gap-2">
                                 <a href="{{ route('edit_shipper', ['id'=>base64_encode($shiper->id)]) }}" class="btn btn-soft-primary btn-sm">
                                    <iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon>
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
</div>

@include('footer')
<script>

    setTimeout(function() {
        var flashMessage = document.getElementById('flash-message');
        if(flashMessage){

            var alert = new bootstrap.Alert(flashMessage);
            alert.close();
        }
    }, 10000);
</script>