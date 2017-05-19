<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title></title>

    <!-- Bootstrap -->
    <link href="<?php echo assets('admin/css/bootstrap/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo assets('admin/css/bootstrap/bootstrap-rtl.min.css') ?>" rel="text/html">

    <!-- Needed -->
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
    <link href="<?php echo assets('admin/css/font-awesome.min.css') ?>" rel="stylesheet">
    <link href="<?php echo assets('admin/css/style.css') ?>" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <div class="wrapper">
      <form class="form-signin" action="<?php echo url('/admin/login/submit') ?>" method="post" id="loginForm">
        <?php if ($errors) {
          // echo '<div class="alert alert-danger">';
          // echo implode('<br>', $errors);
          // echo '</div>';
        } ?>
        <h2 class="form-signin-heading">Please login</h2>
        <input type="email" class="form-control" name="email" placeholder="Email Address" required autofocus="" />
        <input type="password" class="form-control" name="password" placeholder="Password" required/>
        <label class="checkbox">
          <input type="checkbox" id="rememberMe" name="rememberMe"> Remember me
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
      </form>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo assets('admin/js/jquery-3.2.1.min.js') ?>"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo assets('admin/js/bootstrap/bootstrap.min.js') ?>"></script>
    <script type="text/javascript">
      $(function() {
        var flag = false;
        $('#loginForm').on('submit', function(e) {
          e.preventDefault();
          if (flag === true) {
            return false;
          }
          form = $(this);
          requestUrl = form.attr('action');
          requestMethod = form.attr('method');
          requestData = form.serialize();
          $.ajax({
            url: requestUrl,
            type: requestMethod,
            data: requestData,
            dtatType: 'json',
            beforeSend: function() {
              flag = true;
              $('button').attr('disabled', true);
            },
            success: function(result) {

            },

          });
        });
      })
    </script>
  </body>
</html>
