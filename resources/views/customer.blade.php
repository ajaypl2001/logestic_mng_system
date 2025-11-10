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
                  <h4 class="card-title d-flex align-items-center gap-1" id="hidden_column">Customer Listing</h4>
                  <div class="d-flex gap-2">
                     <a href="{{ route('export_customers')}}" class="btn btn-success btn-sm d-flex align-items-center gap-1">
                        <iconify-icon icon="vscode-icons:file-type-excel" class="fs-5"></iconify-icon>
                        <span>Excel</span>
                        <iconify-icon icon="solar:download-linear" class="fs-5"></iconify-icon>
                     </a>
                     <a href="{{ route('AddLoadCustomer')}}" class="btn btn-primary btn-sm">
                        <i class="bx bx-plus me-1"></i>Add Customer
                     </a>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table id="customerTable" class="table align-middle mb-0 table-hover table-centered">
                     <thead class="table-dark">
                        <tr>
                              <th>Customer Name</th>
                              <th>Address</th>
                              <th>City</th>
                              <th>State</th>
                              <th>Zip</th>
                              <th>Telephone</th>
                              <th>Status</th>
                              <th>Approved Status</th>
                              <th>Date Added</th>
                              <th>Added By</th>
                              <th>Team Lead</th>
                              <th>Team Manager</th>
                              <th>Total Credit Limit</th>
                              <th>Total Credit Limit Used</th>
                              <th>Remaining Credit Limit</th>
                              <th>Actions</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($Customers as $Customer)
                              <tr>
                                 <td>{{ $Customer->customer_name }}</td>
                                 <td>{{ $Customer->address }}</td>
                                 <td>{{ $Customer->city }}</td>
                                 <td>{{ $Customer->state }}</td>
                                 <td>{{ $Customer->zip_code }}</td>
                                 <td>{{ $Customer->telephone }}</td>
                                 <td>
                                    @if($Customer->acc_sts == 1)
                                          <span class="badge bg-success">Active</span>
                                    @else
                                          <span class="badge bg-danger">Deactive</span>
                                    @endif
                                 </td>
                                 <td>
                                    @if(Auth::user()->userrole == 'Admin' || Auth::user()->userrole == 'Operations')
                                       <div class="d-flex align-items-center gap-2">
                                             <span class="badge {{ $Customer->approve_sts == 'Approved' ? 'bg-success' : ($Customer->approve_sts == 'Not Approved' ? 'bg-danger' : 'bg-warning text-dark') }}">
                                                {{ $Customer->approve_sts ?? 'Pending' }}
                                             </span>
                                             <button type="button" class="btn btn-sm btn-primary"
                                                   data-bs-toggle="modal"
                                                   data-bs-target="#statusModal{{ $Customer->id }}"
                                                   title="Update Status">
                                                <i class="fas fa-edit"></i>
                                             </button>

                                       </div>
                                    @else
                                       <span class="badge {{ $Customer->approve_sts == 'Approved' ? 'bg-success' : ($Customer->approve_sts == 'Not Approved' ? 'bg-danger' : 'bg-warning text-dark') }}">
                                             {{ $Customer->approve_sts ?? 'Pending' }}
                                       </span>
                                    @endif
                                 </td>                          
                                 <td>{{ $Customer->created_at ? $Customer->created_at->format('Y-m-d') : 'N/A' }}</td>
                                 <td>{{ $Customer->user ? $Customer->user->name : 'N/A' }}</td>
                                 <td>{{ $Customer->user && $Customer->user->teamLead ? $Customer->user->teamLead->name : 'N/A' }}</td>
                                 <td>{{ $Customer->user && $Customer->user->teamManager ? $Customer->user->teamManager->name : 'N/A' }}</td>
                                 <td>{{ $Customer->credit_limit }}</td>
                                 <td>{{ 'N/A' }}</td>
                                 <td>{{ 'N/A' }}</td>
                                 <td>
                                    <div class="d-flex gap-2">
                                          <a href="{{ route('EditLoadCustomer', ['id'=>base64_encode($Customer->id)]) }}" class="btn btn-soft-primary btn-sm">
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
<!-- Modal -->
    <div class="modal fade" id="statusModal{{ $Customer->id }}" tabindex="-1" aria-labelledby="statusModalLabel{{ $Customer->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('customer_updateStatus', $Customer->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel{{ $Customer->id }}">Update Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="status" class="form-label">Select Status</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="Approved" {{ $Customer->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                            <option value="Not Approved" {{ $Customer->status == 'Not Approved' ? 'selected' : '' }}>Not Approved</option>
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