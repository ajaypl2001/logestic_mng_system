@include('header')
        <!-- ==================================================== -->
        <!-- Start right Content here -->
        <!-- ==================================================== -->

        <div class="page-content">

            <!-- Start Container Fluid -->
            <div class="container-fluid">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-3" id="flash-message">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show mt-3" id="flash-message">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                <div class="row">

                    <div class="col-xl-12">

                          <div class="card">
                                <div class="card-header">  
                                  <div class="d-flex flex-wrap justify-content-between gap-3">     
                                    <h4 class="card-title d-flex align-items-center gap-1" id="hidden_column">Users Listing</h4>
                                     <div class="d-flex gap-2">
                                            <a href="{{ route('export_users')}}" class="btn btn-success btn-sm d-flex align-items-center gap-1">
                                                <iconify-icon icon="vscode-icons:file-type-excel" class="fs-5"></iconify-icon>
                                                <span>Excel</span>
                                                <iconify-icon icon="solar:download-linear" class="fs-5"></iconify-icon>
                                            </a>
                                            <a href="{{ route('add_user') }}" class="btn btn-primary btn-sm d-flex align-items-center gap-1">
                                                <i class="bx bx-plus fs-5"></i>
                                                <span>Add User</span>
                                            </a>
                                        </div>
                                  </div>
                                </div>
                            <div class="card-body">
                         
                                           <div class="table-responsive">
                                            
                                             <table id="customerTable" class="table table-hover table-centered align-middle mb-0">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>Site</th>
                                                        <th>Employee Type</th>
                                                        <th>User Group</th>
                                                        <th>Employee Code</th>
                                                        <th>Alias</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Phone</th>
                                                        <th>Status</th>
                                                        <th>Date Added</th>
                                                        <th>Team Lead</th>
                                                        <th>Team Manager</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                         
                                                <tbody>
                                                    @foreach ($users as $index=>$user)
                                                        <tr>
                                                        <td>{{ $user->usersite}}</td>
                                                        <td>{{ $user->employeetype}}</td>
                                                        <td>{{ $user->usergroup}}</td>
                                                        <td>{{ $user->employee_code }}</td>
                                                        <td>{{ $user->alias }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->phone }}</td>
                                                        <td>{{ $user->status }}</td>
                                                        <td>{{ $user->created_at->format('d-M-Y') }}</td>
                                                          <td>
                                                            @php
                                                                $lead = $team_lead->firstWhere('id', $user->lead_id ?? null);
                                                            @endphp
                                                            {{ $lead->name ?? '—' }}
                                                        </td>

                                                        <td>
                                                            @php
                                                                $manager = $team_mang->firstWhere('id', $user->mang_id ?? null);
                                                            @endphp
                                                            {{ $manager->name ?? '—' }}
                                                        </td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                               <a href="{{ route('edit_user', base64_encode($user->id)) }}" class="btn btn-soft-primary btn-sm">
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
    setTimeout(() => {
        let alertBox = document.getElementById('flash-message');
        if (alertBox) {
            alertBox.classList.remove('show');
            alertBox.classList.add('fade');
        }
    }, 1000); 
</script>