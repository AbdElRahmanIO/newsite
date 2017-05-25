
    <div id="wrapper">

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                      Users Groups
                      <a class="btn btn-primary pull-right open-popup" data-toggle="modal" data-modal-target="#addUsersGroup" data-target="<?php echo url('/admin/users-groups/add') ?>">Add New Player</a>
                    </h1>
                    <div class="col-xs-12" id="results"></div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            All Users Groups
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Group Name</th>
                                        <!-- <th>Status</th> -->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    foreach ($users_groups as $users_group) { ?>
                                      <tr class="odd gradeX">
                                          <td><?php echo $users_group->id; ?></td>
                                          <td><?php echo $users_group->name; ?></td>
                                          <!-- <td><?php #echo ucfirst($users_group->status); ?></td> -->
                                          <td class="text-center">
                                            <!-- <a href="<?php #echo url('admin/users-group/edit/' . $users_group->id) ?>" class="btn btn-primary open-popup">
                                              Edit
                                              <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a> -->
                                            <button type="button" data-target="<?php echo url('admin/users-groups/edit/' . $users_group->id) ?>" data-modal-target="#editUsersGroup-<?php echo $users_group->id; ?>" class="btn btn-primary open-popup">
                                              Edit
                                              <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </button>
                                            <?php if($users_group->id != 1){ ?>
                                              <button type="button" data-target="<?php echo url('admin/users-groups/delete/' . $users_group->id) ?>" class="btn btn-danger delete">
                                                Delete
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                              </button>
                                            <?php } ?>
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
