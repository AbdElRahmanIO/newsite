

<!-- jQuery -->
<script src="<?php echo assets('admin/vendor/jquery/jquery.min.js') ?>"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo assets('admin/vendor/bootstrap/js/bootstrap.min.js') ?>"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo assets('admin/vendor/metisMenu/metisMenu.min.js') ?>"></script>

<!-- DataTables JavaScript -->
<script src="<?php echo assets('admin/vendor/datatables/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo assets('admin/vendor/datatables-plugins/dataTables.bootstrap.min.js') ?>"></script>
<script src="<?php echo assets('admin/vendor/datatables-responsive/dataTables.responsive.js') ?>"></script>

<!-- Morris Charts JavaScript -->
<script src="<?php echo assets('admin/vendor/raphael/raphael.min.js') ?>"></script>
<script src="<?php echo assets('admin/vendor/morrisjs/morris.min.js') ?>"></script>
<script src="<?php echo assets('admin/data/morris-data.js') ?>"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo assets('admin/js/sb-admin-2.js') ?>"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
$(document).ready(function() {

    $('#dataTables-example').DataTable({
        responsive: true
    });

    $('.open-popup').on('click', function() {
      btn = $(this);
      url = btn.data('target');
      modelTarget = btn.data('modal-target');
      $.ajax({
        url: url,
        type: 'POST',
        success: function(html) {
          $('body').append(html);
          $(modelTarget).modal('show');
        },
      });
      // if ($(modelTarget).length > 0) {
      //   $(modelTarget).modal('show');
      // }else {
      //   $.ajax({
      //     url: url,
      //     type: 'POST',
      //     success: function(html) {
      //       $('body').append(html);
      //       $(modelTarget).modal('show');
      //     },
      //   });
      // }
      return false;
      //alert(modelTarget);
    });

    $(document).on('click', '#submit-btn', function(e) {
      e.preventDefault();
      btn = $(this);
      form = btn.parents('.form');
      url = form.attr('action');
      data = new FormData(form[0]);
      formResults = form.find('#form-results');
      $.ajax({
        url: url,
        data: data,
        type: 'POST',
        dataType: 'json',
        beforeSend: function() {
          formResults.removeClass().addClass('alert alert-info').html('Please wait ...')
        },
        success: function(results) {
          if (results.errors) {
            formResults.removeClass().addClass('alert alert-danger').html(results.errors);
          }else if (results.success) {
            formResults.removeClass().addClass('alert alert-success').html(results.success);
          }
          if (results.redirectTo) {
            window.location.href = results.redirectTo;
          }
        },
        cache: false,
        processData: false,
        contentType: false,
      });
    });

});
</script>

</body>

</html>
