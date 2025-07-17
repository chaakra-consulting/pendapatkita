
			<!-- Footer opened -->
			<div class="main-footer ht-40">
				<div class="container-fluid pd-t-0-f ht-100p">
					<span>Copyright &copy; <?=date("Y");?> <a href="<?=base_url();?>">PendapatKita</a>.  All rights reserved.</span>
				</div>
			</div>
			<!-- Footer closed -->

		</div>
		<!-- End Page -->

		<!-- Back-to-top -->
		<a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>


		<!-- JQuery min js -->
		<script src="<?=base_url('./../assets/theme/assets/plugins/jquery/jquery.min.js');?>"></script>

		<!--Internal  Datepicker js -->
		<script src="<?=base_url('./../assets/theme/assets/plugins/jquery-ui/ui/widgets/datepicker.js');?>"></script>

		<!-- Bootstrap Bundle js -->
		<script src="<?=base_url('./../assets/theme/assets/plugins/bootstrap/js/popper.min.js');?>"></script>
		<script src="<?=base_url('./../assets/theme/assets/plugins/bootstrap/js/bootstrap.bundle.min.js');?>"></script>

		<!-- Ionicons js -->
		<script src="<?=base_url('./../assets/theme/assets/plugins/ionicons/ionicons.js');?>"></script>

		<!-- Moment js -->
		<script src="<?=base_url('./../assets/theme/assets/plugins/moment/moment.js');?>"></script>

		<!--Internal  jquery.maskedinput js -->
		<script src="<?=base_url('./../assets/theme/assets/plugins/jquery.maskedinput/jquery.maskedinput.js');?>"></script>

		<!--Internal  spectrum-colorpicker js -->
		<script src="<?=base_url('./../assets/theme/assets/plugins/spectrum-colorpicker/spectrum.js');?>"></script>

		<!-- Internal Select2.min js -->
		<script src="<?=base_url('./../assets/theme/assets/plugins/select2/js/select2.min.js');?>"></script>

		<!--Internal Ion.rangeSlider.min js -->
		<script src="<?=base_url('./../assets/theme/assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js');?>"></script>

		<!--Internal  jquery-simple-datetimepicker js -->
		<script src="<?=base_url('./../assets/theme/assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js');?>"></script>

		<!-- Ionicons js -->
		<script src="<?=base_url('./../assets/theme/assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js');?>"></script>

		<!--Internal  pickerjs js -->
		<script src="<?=base_url('./../assets/theme/assets/plugins/pickerjs/picker.min.js');?>"></script>

		<!-- Rating js-->
		<script src="<?=base_url('./../assets/theme/assets/plugins/rating/jquery.rating-stars.js');?>"></script>
		<script src="<?=base_url('./../assets/theme/assets/plugins/rating/jquery.barrating.js');?>"></script>

		<!-- P-scroll js -->
		<script src="<?=base_url('./../assets/theme/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js');?>"></script>
		<script src="<?=base_url('./../assets/theme/assets/plugins/perfect-scrollbar/p-scroll.js');?>"></script>

		<!-- Custom Scroll bar Js-->
		<script src="<?=base_url('./../assets/theme/assets/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js');?>"></script>

		<!-- Horizontalmenu js-->
		<script src="<?=base_url('./../assets/theme/assets/plugins/horizontal-menu/horizontal-menu-2/horizontal-menu.js');?>"></script>

				<!-- Sticky js -->
		<script src="<?=base_url('./../assets/theme/assets/js/sticky.js');?>"></script>

		<!-- Right-sidebar js -->
		<script src="<?=base_url('./../assets/theme/assets/plugins/sidebar/sidebar.js');?>"></script>
		<script src="<?=base_url('./../assets/theme/assets/plugins/sidebar/sidebar-custom.js');?>"></script>

		<!-- eva-icons js -->
		<script src="<?=base_url('./../assets/theme/assets/js/eva-icons.min.js');?>"></script>

		
		<!-- Internal Data tables -->
		<script src="<?=base_url('./../assets/theme/assets/plugins/datatable/js/jquery.dataTables.min.js');?>"></script>
		<script src="<?=base_url('./../assets/theme/assets/plugins/datatable/datatables.min.js');?>"></script>
		<script src="<?=base_url('./../assets/theme/assets/plugins/datatable/js/dataTables.bootstrap5.js');?>"></script>
		<script src="<?=base_url('./../assets/theme/assets/plugins/datatable/js/dataTables.buttons.min.js');?>"></script>
		<script src="<?=base_url('./../assets/theme/assets/plugins/datatable/js/buttons.bootstrap5.min.js');?>"></script>
		<script src="<?=base_url('./../assets/theme/assets/plugins/datatable/js/jszip.min.js');?>"></script>
		<script src="<?=base_url('./../assets/theme/assets/plugins/datatable/js/buttons.html5.min.js');?>"></script>
		<script src="<?=base_url('./../assets/theme/assets/plugins/datatable/js/buttons.print.min.js');?>"></script>
		<script src="<?=base_url('./../assets/theme/assets/plugins/datatable/js/buttons.colVis.min.js');?>"></script>
		<script src="<?=base_url('./../assets/theme/assets/plugins/datatable/pdfmake/pdfmake.min.js');?>"></script>
		<script src="<?=base_url('./../assets/theme/assets/plugins/datatable/pdfmake/vfs_fonts.js');?>"></script>
		<script src="<?=base_url('./../assets/theme/assets/js/table-data.js');?>"></script>


		<!-- custom js -->
		<script src="<?=base_url('./../assets/theme/assets/js/custom.js');?>"></script> 
		<script src="<?=base_url('./../assets/theme/assets/js/form-elements.js');?>"></script> 
<script>
  $(document).ready(function(){
    setInterval(function() {
      var date = new Date();
      var h = date.getHours(), m = date.getMinutes(), s = date.getSeconds();
      h = ("0" + h).slice(-2);
      m = ("0" + m).slice(-2);
      s = ("0" + s).slice(-2);

      var time = h + ":" + m + ":" + s ;
      $('.live-clock').html(time);
    }, 1000); 
		//alert('oke');
	$('.fc-datepicker').datepicker({  
		format: 'yyyy-mm-dd',  
	});
  }) 

</script>
	</body>
</html>
<?php /*
<footer class="main-footer">
    <div class="pull-right hidden-xs">
      Page rendered in {elapsed_time} seconds - 
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; <?= date('Y');?>.</strong> All rights
    reserved.
  </footer>

</div>
<!-- ./wrapper -->


<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- <script>
  $.widget.bridge('uibutton', $.ui.button);
</script> -->
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url('./../assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
<!-- jQuery Knob Chart -->
<!-- <script src="<?= base_url('./../assets/adminlte/bower_components/jquery-knob/dist/jquery.knob.min.js');?>"></script> -->
<!-- daterangepicker -->
<!-- <script src="<?= base_url('./../assets/adminlte/bower_components/moment/min/moment.min.js');?>"></script>
<script src="<?= base_url('./../assets/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js');?>"></script> -->
<!-- datepicker -->
<script src="<?= base_url('./../assets/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');?>"></script>
<!-- Bootstrap WYSIHTML5 -->
<!-- <script src="<?= base_url('./../assets/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js');?>"></script> -->
<!-- Select2 -->
<!-- <script src="<?=base_url('./../assets/adminlte/bower_components/select2/dist/js/select2.full.min.js');?>"></script> -->
<!-- Slimscroll -->
<script src="<?= base_url('./../assets/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js');?>"></script>
<!-- FastClick -->
<script src="<?= base_url('./../assets/adminlte/bower_components/fastclick/lib/fastclick.js');?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('./../assets/adminlte/dist/js/adminlte.min.js');?>"></script>
</body>
</html>
*/ ?>