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
                  <h4 class="card-title d-flex align-items-center gap-1" id="hidden_column">MC Check</h4>
                  <div class="d-flex gap-2">
                    <a href="{{ route('export_mc_check')}}" class="btn btn-success btn-sm d-flex align-items-center gap-1">
                        <iconify-icon icon="vscode-icons:file-type-excel" class="fs-5"></iconify-icon>
                        <span>Excel</span>
                        <iconify-icon icon="solar:download-linear" class="fs-5"></iconify-icon>
                    </a>
                    <a href="{{ route('add-mc-check')}}" class="btn btn-primary"><i class="bx bx-plus me-1"></i>Add MC</a>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table  id="customerTable" class="table align-middle mb-0 table-hover table-centered">
                     <thead class="table-dark">
                        <tr>
                           <th>S.No.</th>
                           <th>Carrier Name</th>
                           <th>Commodity Value</th>
                           <th>Commodity Type</th>
                           <th>Equipment Type</th>
                           <th>Approval Status</th>
                           <th>Date Added</th>
                           <th>Added By User</th>
                           <th>Team Lead</th>
                           <th>Team Manager</th>
                           <th>Actions</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($mc_data as $index => $mc_dataa)
                        <tr>
                           <td>{{ $index + 1 }}</td>
                           <td>{{ $mc_dataa->carrier_name }}</td>
                           <td>{{ $mc_dataa->commodity_value }}</td>
                           <td>{{ $mc_dataa->commodity_type }}</td>
                           <td>{{ $mc_dataa->equ_type }}</td>
                           <td>
                              @if(Auth::user()->userrole == 'Admin' || Auth::user()->userrole == 'Operations')
                                 <div class="d-flex align-items-center gap-2">
                                    <span class="badge {{ $mc_dataa->approve_sts == 'Approved' ? 'bg-success' : ($mc_dataa->approve_sts == 'Not Approved' ? 'bg-danger' : 'bg-warning text-dark') }}">
                                       {{ $mc_dataa->approve_sts ?? 'Pending' }}
                                    </span>
                                    <button type="button" class="btn btn-sm btn-primary"
                                       data-bs-toggle="modal"
                                       data-bs-target="#statusModal{{ $mc_dataa->id }}"
                                       title="Update Status">
                                       <i class="fas fa-edit"></i>
                                    </button>
                                 </div>
                              @else
                                 <span class="badge {{ $mc_dataa->approve_sts == 'Approved' ? 'bg-success' : ($mc_dataa->approve_sts == 'Not Approved' ? 'bg-danger' : 'bg-warning text-dark') }}">
                                    {{ $mc_dataa->approve_sts ?? 'Pending' }}
                                 </span>
                              @endif
                           </td>
                           <div class="modal fade" id="statusModal{{ $mc_dataa->id ?? '' }}" tabindex="-1" aria-labelledby="statusModalLabel{{ $mc_dataa->id ?? '' }}" aria-hidden="true">
                              <div class="modal-dialog">
                                    <div class="modal-content">
                                       <form action="{{ route('mc_approve')}}" method="POST">
                                          @csrf
                                          <div class="modal-header">
                                             <h5 class="modal-title" id="statusModalLabel{{ $mc_dataa->id ?? '' }}">Update Status</h5>
                                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <input type="hidden" name="mc_id" value="{{ $mc_dataa->id ?? '' }}">
                                          <div class="modal-body">
                                             <div class="mb-3">
                                                <label for="status" class="form-label">Select Status</label>
                                                <select name="approval_sts" id="status" class="form-select" required>
                                                   <option value="">Choose Status</option>
                                                   <option value="Approved" {{ $mc_dataa->approve_sts == 'Approved' ? 'selected' : '' }}>Approved</option>
                                                   <option value="Not Approved" {{ $mc_dataa->approve_sts == 'Not Approved' ? 'selected' : '' }}>Not Approved</option>
                                                </select>
                                             </div>
                                          </div>
                                          <div class="modal-footer">
                                             <button type="submit" class="btn btn-success">Save</button>
                                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          </div>
                                       </form>
                                    </div>
                              </div>
                           </div>
                           <td>{{ $mc_dataa->created_datetime }}</td>
                           <td>{{ $mc_dataa->user ? $mc_dataa->user->name : 'N/A' }}</td>
                           <td>{{ $mc_dataa->user && $mc_dataa->user->teamLead ? $mc_dataa->user->teamLead->name : 'N/A' }}</td>
                           <td>{{ $mc_dataa->user && $mc_dataa->user->teamManager ? $mc_dataa->user->teamManager->name : 'N/A' }}</td>
                           <td>
                                 <div class="d-flex gap-2">
                                    <a href="{{ route('edit_mc', ['id' => base64_encode($mc_dataa->id)]) }}" class="btn btn-soft-primary btn-sm">
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
   <!-- end row -->
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