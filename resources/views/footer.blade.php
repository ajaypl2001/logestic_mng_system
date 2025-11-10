
            <!-- ========== Footer Start ========== -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 text-center">
                            <script>document.write(new Date().getFullYear())</script>  
                          <a href="" class="fw-bold footer-text" target="_blank">Opulence Digitech</a> - All Rights Reserve  
                        </div>
                    </div>
                </div>
            </footer>
            <!-- ========== Footer End ========== -->

        </div>
        <!-- ==================================================== -->
        <!-- End Page Content -->
        <!-- ==================================================== -->

    </div>
    <!-- END Wrapper -->

    <!-- Vendor Javascript (Require in all Page) -->
    <script src="{{ asset('js/vendor.js')}}"></script>

     <!-- App Javascript (Require in all Page) -->
     <script src="{{ asset('js/app.js')}}"></script>

          <!-- Dashboard Js -->
     <script src="{{ asset('js/pages/dashboard.js')}}"></script>

         <!-- jQuery -->
    <script src="{{ asset('js/jquery-3.7.1.min.js')}}"></script>


        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- DataTables JS -->
    <script src="{{ asset('js/jquery.dataTables.min.js')}}"></script>

    <!-- jQuery (optional, but if used, load first) -->

<!-- Bootstrap Bundle (includes Popper.js) -->




<script>
  // Initialize Datepicker
  flatpickr("#flatpickr", {
    dateFormat: "Y-m-d",   // Format: 2025-09-19
    minDate: "today"       // Aaj se pehle date disable ho jayegi
  });
</script>


<script>
$(document).ready(function () {
    $('#customerTable').DataTable({
        "pageLength": 5,          // default rows per page
        "lengthMenu": [5, 10, 25, 50, 100], // options
        "order": [[ 0, "asc" ]],  // default sorting (Customer Name)
        "columnDefs": [
            { "orderable": false, "targets": -1 } // disable sorting on 'Actions'
        ]
    });
});
</script>




<!-- <div style="margin:50px;">
  <label for="flatpickr">Select Date:</label>
  <input type="text" id="flatpickr" class="form-control" placeholder="Pick a date">
</div> -->

</body>

</html>