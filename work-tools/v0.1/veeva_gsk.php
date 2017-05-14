<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Veeva_Gsk || Creation Tool [4] InterMark || AbdElRahmanAhmad.com</title>

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap-rtl.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">

    <link href="assets/css/style.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <div class="container">
      <div class="row">

        <div class="col-xs-12">
          <div class="panel panel-danger">
            <div class="panel-heading"><h3 class="panel-title">Veeva GSK Creation</h3></div>
            <div class="panel-body">
              <form action="process_veeva_gsk.php" method="post">
                <div class="row">

                  <div class="form-group col-sm-6">
                    <label for="presname">اسم البرزنتيشن</label>
                    <input type="text" class="form-control" id="presname" Name="presname" placeholder="اسم البرزنتيشن" required>
                  </div>

                  <div class="form-group col-sm-6">
                    <label for="pkcountry">دولة المنتج</label>
                    <input type="text" class="form-control" id="pkcountry" Name="pkcountry" placeholder="دولة المنتج" required>
                  </div>

                  <div class="form-group col-sm-6">
                    <label for="prodname">اسم المنتج</label>
                    <input type="text" class="form-control" id="prodname" Name="prodname" placeholder="اسم المنتج" required>
                  </div>

                  <div class="form-group col-sm-6">
                    <label for="pkyear">سنة اصدار البرزنتيشن</label>
                    <input type="text" class="form-control" id="pkyear" Name="pkyear" placeholder="سنة اصدار البرزنتيشن" value="2017" required>
                  </div>

                  <div class="form-group col-sm-6">
                    <label for="pkcountryv">رقم الاصدار (الخاص بالدولة)</label>
                    <input type="text" class="form-control" id="pkcountryv" Name="pkcountryv" placeholder="رقم الاصدار (الخاص بالدولة)" required>
                  </div>

                  <div class="form-group col-sm-6">
                    <label for="pkv">رقم اصدار البرزنتيشن</label>
                    <input type="text" class="form-control" id="pkv" Name="pkv" placeholder="رقم اصدار البرزنتيشن" required>
                  </div>

                  <div class="form-group col-sm-12">
                    <label for="inputimages">مسار الخلفيات (Backgrounds)</label>
                    <input type="text" class="form-control" id="inputimages" Name="inputimages" placeholder="" value="inputs/bg/" required>
                  </div>

                  <div class="form-group col-sm-12">
                    <label for="inputimagesthumbs">مسار الصمب (thumbs)</label>
                    <input type="text" class="form-control" id="inputimagesthumbs" Name="inputimagesthumbs" placeholder="" value="inputs/thumbs/">
                  </div>

                  <div class="form-group col-xs-12">
                    <button type="submit" class="btn btn-default">إنشاء</button>
                  </div>
              </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- <form action="process.php" method="post">
      presentation name: <input type="text" name="presname" required><br>
      product country: <input type="text" name="pkcountry" required><br>
      product name: <input type="text" name="prodname" required><br>
      product year: <input type="text" name="pkyear" required><br>
      product country Version: <input type="text" name="pkcountryv" required><br>
      product Version: <input type="text" name="pkv" required><br>
      Background Path: <input type="text" name="inputimages" required><br>
      <input type="submit">
    </form> -->



    <!-- <div class="form-group">
    <label for="exampleInputFile">File input</label>
    <input type="file" id="exampleInputFile">
    <p class="help-block">Example block-level help text here.</p>
    </div> -->
    <!-- <div class="checkbox">
    <label>
    <input type="checkbox"> Check me out
    </label>
    </div> -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="assets/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>
