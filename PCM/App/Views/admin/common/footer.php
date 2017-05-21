

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
      if ($(modelTarget).length > 0) {
        $(modelTarget).modal('show');
      }else {
        $.ajax({
          url: url,
          type: 'POST',
          success: function(html) {
            $('body').append(html);
            $(modelTarget).modal('show');
          }
        });
      }
      //alert(modelTarget);
    });

    $(document).on('click', '#submit-btn', function() {
      btn = $(this);
      form = btn.parents('.form-modal');
      url = form.attr('action');
      data = form.serialize();
      $.ajax({
        url: url,
        data: data,
        type: 'POST',
        dataType: 'json',
        beforeSend: function() {

        },
        success: function(results) {

        },
      });
    });

});
</script>

</body>

</html>
