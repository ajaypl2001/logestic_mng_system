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
                                    <h4 class="card-title d-flex align-items-center gap-1" id="hidden_column">Consignee Listing</h4>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('export_consignee')}}" class="btn btn-success btn-sm d-flex align-items-center gap-1">
                                            <iconify-icon icon="vscode-icons:file-type-excel" class="fs-5"></iconify-icon>
                                            <span>Excel</span>
                                            <iconify-icon icon="solar:download-linear" class="fs-5"></iconify-icon>
                                        </a>
                                        <a href="{{ route('add_consignee')}}" class="btn btn-primary"><i class="bx bx-plus me-1"></i>Add Consignee</a>
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
                                                                <th>Contact</th>
                                                                <th>Status</th>
                                                                <th>Date Added</th>
                                                                <th>Added By User</th>
                                                                <th>Team Lead</th>
                                                                <th>Team Manager</th>
                                                                <th>Actions</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       @foreach ($Consignees as $Consignee)
                                                   
                                                                <tr>
                                                                 <td>{{$Consignee->name}}</td>
                                                                 <td>{{$Consignee->addressl_1}}</td>
                                                                 <td>{{$Consignee->tele_phone}}</td>
                                                                 <td>
                                                                      @if($Consignee->acc_sts == 1)
                                                                      <span class="badge bg-success">Active</span>
                                                                      @else
                                                                      <span class="badge bg-danger">Deactive</span>
                                                                      @endif
                                                                 </td>
                                                                 <td>{{ $Consignee->created_at->format('Y-m-d') }}</td>
                                                                 <td>{{ $Consignee->user ? $Consignee->user->name : 'N/A' }}</td>
                                                                 <td>{{ $Consignee->user && $Consignee->user->teamLead ? $Consignee->user->teamLead->name : 'N/A' }}</td>
                                                                 <td>{{ $Consignee->user && $Consignee->user->teamManager ? $Consignee->user->teamManager->name : 'N/A' }}</td>
                                                                 <td>
                                                                      <div class="d-flex gap-2">
                                                                      <a href="{{ route('edit_consign', ['id'=>base64_encode($Consignee->id)]) }}" class="btn btn-soft-primary btn-sm">
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
                        
                </div> <!-- end row -->

            </div>
            <!-- End Container Fluid -->


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