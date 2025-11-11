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
                                   <h4 class="card-title d-flex align-items-center gap-1" id="hidden_column"> External Carrier </h4>
                                   <div class="d-flex gap-2">
                                        <a href="{{ route('export_carrier')}}" class="btn btn-success btn-sm d-flex align-items-center gap-1">
                                            <iconify-icon icon="vscode-icons:file-type-excel" class="fs-5"></iconify-icon>
                                            <span>Excel</span>
                                            <iconify-icon icon="solar:download-linear" class="fs-5"></iconify-icon>
                                            <a href="{{ route('add_carrier')}}" class="btn btn-primary"><i class="bx bx-plus me-1"></i>Add Carrier</a>
                                        </a>
                                   </div>
                               </div>
                            </div>
                            <div class="card-body">
                                           <div class="table-responsive">
                                             <table  id="customerTable" class="table align-middle mb-0 table-hover table-centered">
                                                  <thead class="table-dark">
                                                      <tr>
                                                          <th>Carrier Name</th>
                                                          <th>MC/FF No</th>
                                                          <th>Load Type</th>
                                                          <th>Address</th>
                                                          <th>City</th>
                                                          <th>State</th>
                                                          <th>Zip</th>
                                                          <th>Telephone</th>
                                                          <th>Status</th>
                                                          <th>Approval Status</th>
                                                          <th>Date Added</th>
                                                          <th>Added By User</th>
                                                          <th>Team Lead</th>
                                                          <th>Team Manager</th>
                                                          <th>Actions</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    @foreach ($carrier_data as $carrier_datas)
                                                        <tr>
                                                            <td>{{ $carrier_datas->carrier_name}}</td>
                                                            <td>{{ $carrier_datas->mc_ff_hidden}}</td>
                                                            <td>{{ $carrier_datas->load_type}}</td>
                                                            <td>{{ $carrier_datas->address}}</td>
                                                            <td>{{ $carrier_datas->city}}</td>
                                                            <td>{{ $carrier_datas->state}}</td>
                                                            <td>{{ $carrier_datas->zip_code}}</td>
                                                            <td>{{ $carrier_datas->telephone}}</td>
                                                                <td> 
                                                                      @if($carrier_datas->acc_sts == 1)
                                                                      <span class="badge bg-success">Active</span>
                                                                      @else
                                                                      <span class="badge bg-danger">Deactive</span>
                                                                      @endif
                                                                 </td>
                                                            <td>
                                                                @if(Auth::user()->userrole == 'Admin' || Auth::user()->userrole == 'Operations')
                                                                <div class="d-flex align-items-center gap-2">
                                                                        <span class="badge {{ $carrier_datas->approve_sts == 'Approved' ? 'bg-success' : ($carrier_datas->approve_sts == 'Not Approved' ? 'bg-danger' : 'bg-warning text-dark') }}">
                                                                            {{ $carrier_datas->approve_sts ?? 'Pending' }}
                                                                        </span>
                                                                        <button type="button" class="btn btn-sm btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#statusModal{{ $carrier_datas->id }}"
                                                                            title="Update Status">
                                                                            <i class="fas fa-edit"></i>
                                                                        </button>

                                                                </div>
                                                                @else
                                                                <span class="badge {{ $carrier_datas->approve_sts == 'Approved' ? 'bg-success' : ($carrier_datas->approve_sts == 'Not Approved' ? 'bg-danger' : 'bg-warning text-dark') }}">
                                                                        {{ $carrier_datas->approve_sts ?? 'Pending' }}
                                                                </span>
                                                                @endif
                                                            </td>  
                                                            
                                                                <div class="modal fade" id="statusModal{{ $carrier_datas->id ?? '' }}" tabindex="-1" aria-labelledby="statusModalLabel{{ $carrier_datas->id ?? '' }}" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <form action="{{ route('carrier_sts_query')}}" method="POST">
                                                                                @csrf
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="statusModalLabel{{ $carrier_datas->id ?? '' }}">Update Status</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <input type="hidden" name="carrier_update_id" value="{{ $carrier_datas->id ?? '' }}">
                                                                                <div class="modal-body">
                                                                                    <div class="mb-3">
                                                                                        <label for="status" class="form-label">Select Status</label>
                                                                                        <select name="approval_sts" id="status" class="form-select" required>
                                                                                            <option value="">Choose Status</option>
                                                                                            <option value="Approved" {{ $carrier_datas->approve_sts == 'Approved' ? 'selected' : '' }}>Approved</option>
                                                                                            <option value="Not Approved" {{ $carrier_datas->approve_sts == 'Not Approved' ? 'selected' : '' }}>Not Approved</option>
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
                                                            <td>{{ $carrier_datas->created_at}}</td>
                                                            <td>{{ $carrier_datas->user ? $carrier_datas->user->name : 'N/A' }}</td>
                                                            <td>{{ $carrier_datas->user && $carrier_datas->user->teamLead ? $carrier_datas->user->teamLead->name : 'N/A' }}</td>
                                                            <td>{{ $carrier_datas->user && $carrier_datas->user->teamManager ? $carrier_datas->user->teamManager->name : 'N/A' }}</td>
                                                            
                                                            <td>
                                                             <div class="d-flex gap-2">
                                                                <a href="{{ route('edit_carrier', ['id' => base64_encode($carrier_datas->id)]) }}" class="btn btn-soft-primary btn-sm"><iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon></a>
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