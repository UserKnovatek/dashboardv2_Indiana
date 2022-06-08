   
      

     <!-- Footer Code Start  -->
      <script src="<?php bloginfo('template_directory'); ?>/dashboardv2/plugins/jquery/jquery.min.js"></script>
      <!-- jQuery UI 1.11.4 -->
      <script src="<?php bloginfo('template_directory'); ?>/dashboardv2/plugins/jquery-ui/jquery-ui.min.js"></script>
      <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
      <script>
         $.widget.bridge('uibutton', $.ui.button)
      </script>
      <!-- Bootstrap 4 -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
      <!-- <script src="<?php bloginfo('template_directory'); ?>/dashboardv2/plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
      <!-- ChartJS -->
      <script src="<?php bloginfo('template_directory'); ?>/dashboardv2/plugins/chart.js/Chart.min.js"></script>
      <!-- Sparkline -->
      <script src="<?php bloginfo('template_directory'); ?>/dashboardv2/plugins/sparklines/sparkline.js"></script>
      <!-- JQVMap -->
      <script src="<?php bloginfo('template_directory'); ?>/dashboardv2/plugins/jqvmap/jquery.vmap.min.js"></script>
      <script src="<?php bloginfo('template_directory'); ?>/dashboardv2/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
      <!-- jQuery Knob Chart -->
      <script src="<?php bloginfo('template_directory'); ?>/dashboardv2/plugins/jquery-knob/jquery.knob.min.js"></script>
      <!-- daterangepicker -->
      <script src="<?php bloginfo('template_directory'); ?>/dashboardv2/plugins/moment/moment.min.js"></script>
      <script src="<?php bloginfo('template_directory'); ?>/dashboardv2/plugins/daterangepicker/daterangepicker.js"></script>
      <!-- Tempusdominus Bootstrap 4 -->
      <script src="<?php bloginfo('template_directory'); ?>/dashboardv2/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
      <!-- Summernote -->
      <script src="<?php bloginfo('template_directory'); ?>/dashboardv2/plugins/summernote/summernote-bs4.min.js"></script>
      <!-- overlayScrollbars -->
      <script src="<?php bloginfo('template_directory'); ?>/dashboardv2/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
      <!-- AdminLTE App -->
      <script src="<?php bloginfo('template_directory'); ?>/dashboardv2/dist/js/adminlte.js"></script>
      <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
      <!-- AdminLTE for demo purposes -->
      <script src="<?php bloginfo('template_directory'); ?>/dashboardv2/dist/js/demo.js"></script>
      <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
      <script src="<?php bloginfo('template_directory'); ?>/dashboardv2/dist/js/pages/dashboard.js"></script>
      <script>
    jQuery(document).ready(function($) {
      // $.fn.dataTable.moment( 'DD-MM-YYYY' );
      $.fn.dataTable.moment( 'YYYY-DD-MM' );
      $('#tlegislation-table').DataTable({ 
        "pageLength": 50,
       "order": [[ 2, "asc" ]] 
      });

      $('.knova-follow').click(function(){
        console.log('fa-heart-o');
        jQuery.ajax({
             type : "post",
            //  dataType : 'JSON',
             url : "https://dev.indianacitizen.org/wp-admin/admin-ajax.php",
             data : {
                action: "knova_follow", 
                content_type : $(this).data('content-type'),
                content_id : $(this).data('content-id'),
                user_id : $(this).data('user-id'),
               },
             success: function(response) {
                  console.log(response);
             }
      });
        if($(this).hasClass( "fa-heart-o" )){
          $(this).removeClass('fa-heart-o');
          $(this).addClass("fa-heart");
        }else{
          $(this).removeClass('fa-heart');
          $(this).addClass("fa-heart-o");
        }
      });

    } );
  </script>
      <?php wp_footer();?>
   </body>
</html>