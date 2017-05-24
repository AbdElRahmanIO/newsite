
    <div id="wrapper">

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                      Players
                      <a class="btn btn-primary pull-right open-popup" data-toggle="modal" data-modal-target="#addcat" data-target="<?php echo url('/admin/categories/add') ?>">Add New Player</a>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Edit ( <?php echo $category->name; ?> ) Player
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                          <form class="form-modal form" action="<?php echo url('admin/categories/save/' . $category->id); ?>" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-xs-12">
                                  <?php if ($errors) {?>
                                    <div class="col-xs-12 alert alert-danger"><?php echo implode('<br>', $errors) ?></div>
                                  <?php } ?>
                                </div>
                                  <div class="col-lg-6">
                                    <input type="text" id="cat-name" name="catname" value="<?php echo $category->name; ?>" class="col-lg-6 form-control" placeholder="categorie Name">
                                    
                                  </div>
                                  <div class="col-lg-6">
                                    <select class="form-control" id="status" name="status">
                                      <option value="enabled">Enabled</option>
                                      <option value="disabled" <?php echo $category->status == 'disabled' ? 'selected' : false; ?>>Disabled</option>
                                    </select>
                                  </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                              <button class="btn btn-primary">Save changes</button>
                            </div>
                          </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
