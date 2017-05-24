
    <div id="wrapper">

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                      Players
                      <a class="btn btn-primary pull-right open-popup" data-toggle="modal" data-modal-target="#addcat" data-target="<?php echo url('/admin/categories/add') ?>">Add New Player</a>
                    </h1>
                    <?php if ($success) { ?>
                      <div class="col-xs-12 alert alert-success"><?php echo $success; ?></div>
                    <?php } ?>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            All Players
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Player Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    foreach ($categories as $category) { ?>
                                      <tr class="odd gradeX">
                                          <td><?php echo $category->id; ?></td>
                                          <td><?php echo $category->name; ?></td>
                                          <td><?php echo ucfirst($category->status); ?></td>
                                          <td class="text-center">
                                            <!-- <a href="<?php #echo url('admin/categories/edit/' . $category->id) ?>" class="btn btn-primary open-popup">
                                              Edit
                                              <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a> -->
                                            <button type="button" data-target="<?php echo url('admin/categories/edit/' . $category->id) ?>" data-modal-target="#editcat-<?php echo $category->id; ?>" class="btn btn-primary open-popup">
                                              Edit
                                              <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </button>
                                            <a href="<?php echo url('admin/categories/delete/' . $category->id) ?>" class="btn btn-danger">
                                              Delete
                                              <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
                                          </td>
                                      </tr>
                                    <?php }
                                  ?>
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
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
