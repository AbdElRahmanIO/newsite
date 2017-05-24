<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <form class="" action="<?php echo url('/admin/submit'); ?>">
      <input type="text" name="email" value="" placeholder="email">
      <br>
      <input type="password" name="password" value="" placeholder="password">
      <br>
      <input type="password" name="confirmPassword" value="" placeholder="confirm Password">
      <br>
      <input type="text" name="fullName" value="" placeholder="full Name">
      <br>
      <input type="file" name="image" value="">
      <br>
      <button type="submit" name="button">Send</button>
    </form>

    <script src="<?php echo assets('admin/vendor/datatables/js/jquery.dataTables.min.js') ?>"></script>
        <script src="<?php echo assets('admin/vendor/jquery/jquery.min.js') ?>"></script>
        <script type="text/javascript">
          $('form').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var sendData = new FormData(form[0]);
            $.ajax({
              url: form.attr('action'),
              type: 'POST',
              data: sendData,
              dataType: 'json',
              success: function(r) {
                $('body').append(r.name);
              },
              cache: false,
              processData: false,
              contentType: false,
            });
          });
        </script>
  </body>
</html>
