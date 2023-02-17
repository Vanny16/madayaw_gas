<!-- jQuery -->
<script src="{{ asset('bootstrap/admin/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('bootstrap/admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<script src="{{ asset('bootstrap/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('bootstrap/admin/plugins/bootstrap/js/custom-js.js') }}"></script>
<script src="{{ asset('bootstrap/admin/plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('bootstrap/admin/plugins/sparklines/sparkline.js') }}"></script>
<script src="{{ asset('bootstrap/admin/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('bootstrap/admin/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<script src="{{ asset('bootstrap/admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<script src="{{ asset('bootstrap/admin/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('bootstrap/admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('bootstrap/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('bootstrap/admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('bootstrap/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('bootstrap/admin/dist/js/adminlte.js') }}"></script>
<script src="{{ asset('bootstrap/admin/dist/js/pages/dashboard.js') }}"></script>
<script src="{{ asset('bootstrap/admin/dist/js/demo.js') }}"></script>
<script src="{{ asset('bootstrap/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bootstrap/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('bootstrap/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('bootstrap/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('bootstrap/admin/plugins/select2/js/select2.full.min.js') }}"></script>

<script src="{{ asset('bootstrap/admin/plugins/sweetalert2/sweetalert2.all.js') }}"></script>

<!-- page script -->
<script>
    $(function () {
        $('#datatable').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"responsive": true,
        });
    });

	$(function () {
		//Initialize Select2 Elements
		$('.select2').select2()

		//Initialize Select2 Elements
		$('.select2bs4').select2({
			theme: 'bootstrap4'
		})
	});

	function isNumberKey(txt, evt) {
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode == 46) {
        //Check if the text already contains the . character
        if (txt.value.indexOf('.') === -1) {
          return true;
        } else {
          return false;
        }
      } else {
        if (charCode > 31 &&
          (charCode < 48 || charCode > 57))
          return false;
      }
      return true;
    }
</script>