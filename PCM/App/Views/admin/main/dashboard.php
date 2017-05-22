<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <form class="" action="<?php echo url('/admin/submit'); ?>" method="post">
      <input type="text" name="email" value="" placeholder="email">
      <br>
      <input type="password" name="password" value="" placeholder="password">
      <br>
      <input type="password" name="confirmPassword" value="" placeholder="confirm Password">
      <br>
      <input type="text" name="fullName" value="" placeholder="full Name">
      <br>
      <button type="submit" name="button">Send</button>
    </form>

  </body>
</html>
