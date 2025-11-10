@include('header')
<!-- ==================================================== -->
<!-- Start right Content here -->
<!-- ==================================================== -->
<div class="page-content">
   <!-- Start Container Fluid -->
   <div class="container-fluid">
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" id="flash-message-success">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mt-3" id="flash-message-error">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
      <div class="row">
         <div class="col-xl-12">
            <div class="card">
               <div class="card-header">
                  <div class="d-flex flex-wrap justify-content-between gap-3">
                     
                        <h4 class="card-title d-flex align-items-center gap-1" id="hidden_column">
                            {{ isset($user->id) ? 'Update User' : 'Add User' }}
                        </h4>
           
                     <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm"><i class="bx bx-arrow-back me-1"></i>Back </a>
                  </div>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-lg-12">
                        
                        <form action="{{ isset($user) ? route('update_user_query', $user->id) : route('add_user_query') }}" id="AdduserForm" method="post" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="control-label mb-1">Role <span class="text-danger">*</span></label>
                                        <select class="form-control" id="userrole" name="userrole" required>
                                            <option value="">Select Role</option>
                                            <option value="Team Lead" {{ isset($user) && $user->userrole == 'Team Lead' ? 'selected' : '' }}>Team Lead</option>
                                            <option value="Manager" {{ isset($user) && $user->userrole == 'Manager' ? 'selected' : '' }}>Manager</option>
                                            <option value="Sales Representative" {{ isset($user) && $user->userrole == 'Sales Representative' ? 'selected' : '' }}>Sales Representative</option>
                                            <option value="Opreations" {{ isset($user) && $user->userrole == 'Opreations' ? 'selected' : '' }}>Opreations</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="control-label mb-1">Site <span class="text-danger">*</span></label>
                                        <select class="form-control" id="usersite" name="usersite" required>
                                            <option value="">Select Site</option>
                                            <option value="Mohali" {{ isset($user) && $user->usersite == 'Mohali' ? 'selected' : '' }}>Mohali</option>
                                            <option value="Chandigarh" {{ isset($user) && $user->usersite == 'Chandigarh' ? 'selected' : '' }}>Chandigarh</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="control-label mb-1">Employee Type <span class="text-danger">*</span></label>
                                        <select class="form-control" id="employeetype" name="employeetype" required>
                                            <option value="">Select Employee Type</option>
                                            <option value="On Roll" {{ isset($user) && $user->employeetype == 'On Roll' ? 'selected' : '' }}>On Roll</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="control-label mb-1">Employee Code <span class="text-danger">*</span></label>
                                        <input placeholder="Enter Employee Code" class="form-control" id="employee_code" name="employee_code" type="text" value="{{ old('employee_code', $user->employee_code ?? '') }}" required />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="control-label mb-1">First Name <span class="text-danger">*</span></label>
                                        <input placeholder="Enter First Name" class="form-control" id="f_name" name="f_name" value="{{ old('f_name', $user->f_name ?? '') }}" type="text" required />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="control-label mb-1">Last Name <span class="text-danger">*</span></label>
                                        <input placeholder="Enter Last Name" class="form-control" id="l_name" name="l_name" value="{{ old('f_name', $user->l_name ?? '') }}" type="text" required />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="control-label mb-1">Alias <span class="text-danger">*</span></label>
                                        <input placeholder="Enter Alias" class="form-control" id="alias" name="alias" type="text" value="{{ old('f_name', $user->alias ?? '') }}" required />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="control-label mb-1">Phone <span class="text-danger">*</span></label>
                                        <input placeholder="XXX-XXX-XXXX" class="form-control" id="phone" name="phone" type="text" value="{{ old('f_name', $user->phone ?? '') }}" required />
                                        <small id="phone-error" class="text-danger"></small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="control-label mb-1">Fax</label>
                                        <input placeholder="Enter Fax Number" class="form-control" id="fax" name="fax" type="number" value="{{ old('f_name', $user->fax ?? '') }}"/>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="control-label mb-1">Email <span class="text-danger">*</span></label>
                                        <input placeholder="Enter Email Address" class="form-control" id="email" name="email" type="email" value="{{ old('email', $user->email ?? '') }}" required />
                                        <small id="email-error" class="text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="control-label mb-1">Password <span class="text-danger">*</span></label>

                                        @if(isset($user))
                                            <a href="#" class="btn btn-outline-primary btn-sm changePasswordBtn" data-user-id="{{ $user->id }}" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                                 Change Password
                                            </a>
                                        @else
                                            <input placeholder="Enter Password" class="form-control" id="password" name="password" type="password" required />
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="control-label mb-1">Status <span class="text-danger">*</span></label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="">Select Status</option>
                                            <option value="Active" {{ isset($user) && $user->status == 'Active' ? 'selected' : '' }}>Active</option>
                                            <option value="Deactive" {{ isset($user) && $user->status == 'Deactive' ? 'selected' : '' }}>Deactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="control-label mb-1">User Group <span class="text-danger">*</span></label>
                                        <select class="form-control" id="usergroup" name="usergroup" required>
                                            <option value="">Select User Group</option>
                                            <option value="Sales Representative" {{ isset($user) && $user->usergroup == 'Sales Representative' ? 'selected' : '' }}>Sales Representative</option>
                                            <option value="Opreations" {{ isset($user) && $user->usergroup == 'Opreations' ? 'selected' : '' }}>Opreations</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="control-label mb-1 d-block">Form Permission <span class="text-danger">*</span></label>
                                        <div class="row">
                                            @php
                                                $permissions = [
                                                    'Admin', 'Customer', 'Consignees', 'Pending Customer', 'User', 'Shipper',
                                                    'External Career', 'Pending Career', 'Load', 'Load Report', 'MC Check',
                                                    'Load List', 'Pending Load', 'Email Alert'
                                                ];

                                                $userPermissions = isset($user) && !empty($user->form_permission)
                                                    ? json_decode($user->form_permission, true)
                                                    : [];
                                            @endphp

                                            @if(!empty($permissions))
                                                @foreach($permissions as $perm)
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="form-check mb-2">
                                                            <input class="form-check-input"
                                                                type="checkbox"
                                                                name="form_permission[]"
                                                                value="{{ $perm }}"
                                                                id="perm_{{ Str::slug($perm, '_') }}"
                                                                {{ in_array($perm, $userPermissions ?? []) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="perm_{{ Str::slug($perm, '_') }}">{{ $perm }}</label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <p class="text-muted">No permissions available.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                

                                @if(isset($user))
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="control-label mb-1">Team Manager <span class="text-danger">*</span></label>
                                            <select class="form-control" id="team_manager" name="mang_id" required>
                                                <option value="">Select Team Manager</option>
                                                @foreach ($team_mang as $manager)
                                                    <option value="{{ $manager->id }}" 
                                                        {{ $user->mang_id == $manager->id ? 'selected' : '' }}>
                                                        {{ $manager->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                               

                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="control-label mb-1">Team Lead <span class="text-danger">*</span></label>
                                            <select class="form-control" id="team_lead" name="lead_id" required>
                                                <option value="">Select Team Lead</option>
                                                @foreach ($team_lead as $lead)
                                                    <option value="{{ $lead->id }}" 
                                                        {{ $user->lead_id == $lead->id ? 'selected' : '' }}>
                                                        {{ $lead->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-md-12 text-end">
                                    <input type="hidden" name="user_id" id="user_id" value="{{ $user->id ?? '' }}">
                                    
                                    <button type="submit" class="btn btn-success commonBtn">
                                        {{ isset($user->id) ? 'Update' : 'Save' }}
                                    </button>
                                    
                                    <a class="btn btn-primary text-white commonBtn px-3" href="{{ url()->previous() }}">
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('change_password') }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" id="modal_user_id">

            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                <div class="mb-3">
                    <label class="form-label">Old Password</label>
                    <input type="password" class="form-control" name="old_password" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">New Password</label>
                    <input type="password" class="form-control" name="new_password" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="confirm_password" required>
                </div>

                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Update Password</button>
                </div>
            </div>
            </form>
        </div>
    </div>

      <!-- end row -->
   </div>
   <!-- End Container Fluid -->
   @include('footer')
   <script>
        $(document).on('click', '.changePasswordBtn', function() {
            var userId = $(this).data('user-id');
            $('#modal_user_id').val(userId);
        });
   </script>
<script>
    setTimeout(() => {
        const successAlert = document.getElementById('flash-message-success');
        const errorAlert = document.getElementById('flash-message-error');

        [successAlert, errorAlert].forEach(alertBox => {
            if (alertBox) {
                alertBox.classList.remove('show');
                alertBox.classList.add('fade');
            }
        });
    }, 2000);
</script>
    <script>
    $(document).ready(function () {
        $("#phone").on("input blur", function () {
            validatePhone();
        });

        $("#AdduserForm").on("submit", function (e) {
            if (!validatePhone()) {
                e.preventDefault();
            }
        });

        function validatePhone() {
            let phone = $("#phone").val().trim();
            let errorField = $("#phone-error");
            let phoneRegex = /^[0-9]{10}$/;
            let isValid = true;

            errorField.text("");

            if (!/^\d*$/.test(phone)) {
                errorField.text("Only numbers are allowed.");
                isValid = false;
            } 
            else if (!phoneRegex.test(phone)) {
                errorField.text("Phone number must be exactly 10 digits.");
                isValid = false;
            }
            return isValid;
        }
    });
    </script>

    <script>
$(document).ready(function () {

    $("#email").on("blur", function () {
        validateEmail();
    });

    $("#AdduserForm").on("submit", function (e) {
        e.preventDefault(); // stop submission first

        validateEmail(function(isValid) {
            if (isValid) {
                // submit only if email is valid
                $("#AdduserForm")[0].submit();
            }
        });
    });

    function validateEmail(callback) {
        let email = $("#email").val().trim();
        let errorField = $("#email-error");
        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        errorField.text("");

        if (email === "") {
            errorField.text("Email is required.");
            if (callback) callback(false);
            return false;
        }

        if (!emailRegex.test(email)) {
            errorField.text("Enter a valid email address.");
            if (callback) callback(false);
            return false;
        }

        // AJAX check
        $.ajax({
            url: "{{ route('check_email_duplicate') }}",
            method: "POST",
            data: {
                email: email,
                _token: "{{ csrf_token() }}",
                user_id: "{{ $user->id ?? '' }}"
            },
            success: function (response) {
                if (response.exists) {
                    errorField.text("This email is already registered.");
                    if (callback) callback(false);
                } else {
                    errorField.text("");
                    if (callback) callback(true);
                }
            },
            error: function () {
                errorField.text("Error checking email. Try again.");
                if (callback) callback(false);
            }
        });
    }

});
</script>




  