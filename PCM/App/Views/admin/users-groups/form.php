

  <!-- Add New User Group -->
  <div class="modal fade" id="<?php echo $target; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><?php echo $heading; ?></h4>
        </div>
        <form class="form-modal form" action="<?php echo $action; ?>" method="post">
          <div class="modal-body">
            <div class="row">
              <div class="col-xs-12">
                <div class="col-xs-12" id="form-results"></div>
              </div>
            </div><!-- row -->
            <div class="row">
              <div class="col-lg-12">
                <input type="text" id="cat-name" name="groupname" class="form-control" placeholder="Group Name" value="<?php echo $name; ?>">
              </div>
            </div><!-- row -->
            <div class="row">
              <div class="col-xs-12">
                <select class="form-control" name="pages[]" id="pages" multiple="multiple">
                  <?php
                  foreach ($pages as $page) { ?>
                    <option value="<?php echo $page; ?>" <?php echo in_array($page, $users_group_pages) ? 'selected' : false; ?>><?php echo $page; ?></option>
                  <?php }
                  ?>
                </select>
              </div>
            </div><!-- row -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button class="btn btn-primary" id="submit-btn">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
