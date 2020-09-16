<!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url() ?>assets/js/sb-admin-2.min.js"></script>

  <!-- For Table -->
  <script src="<?php echo base_url() ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <!-- Page level custom scripts -->
  <script src="<?php echo base_url() ?>assets/js/demo/datatables-demo.js"></script>

  <!-- Datepicker -->
  <script src="<?php echo base_url() ?>assets/js/bootstrap-datepicker.min.js"></script>


  <!-- Addition -->
  <script src="<?php echo base_url() ?>assets/js/select2.min.js"></script>
  <!-- Page Script -->
  <script type="text/javascript">
    $(document).ready(function() {
        $("body").toggleClass("sidebar-toggled");
        $(".sidebar").toggleClass("toggled");
    });
  </script>
  <script>
    $(function (){
      //Initialize Select2 Elements
      $('.select2').select2()

      //Date picker
      $('#datepicker').datepicker({
      autoclose: true
      })
      
      $('#datepicker2').datepicker({
      autoclose: true
      })
    })
    
    $('#datepicker').datepicker({
       format: 'yyyy-mm-dd'
    });
    $('#datepicker2').datepicker({
       format: 'yyyy-mm-dd'
    });

    //Actve state 

  $(document).ready(function() {
    //You can name this function anything you like
    function activePage(){
      //When user lands on your website location.pathname is equal to "/" and in 
      //that case it will add "active" class to all links
      //Therefore we are going to remove first character "/" from the pathname
      var currentPage = location.pathname;
      var slicedCurrentPage = currentPage.slice(1);
      //This will add active class to link for current page
      $('.nav-link').removeClass('active');
      $('a[href*="' + location.pathname + '"]').closest('li').addClass('active');
      //This will add active class to link for index page when user lands on your website
      if (location.pathname == "/") {
          $('a[href*="index"]').closest('li').addClass('active');
      }
    }
    //Invoke function
    activePage();
  });
  </script>

</body>

</html>