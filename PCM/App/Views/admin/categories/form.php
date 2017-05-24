

  <!-- Add New categorie -->
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
                <div class="col-lg-6">
                  <input type="text" id="cat-name" name="catname" class="col-lg-6 form-control" placeholder="categorie Name" value="<?php echo $name; ?>">
                </div>
                <div class="col-lg-6">
                  <select class="form-control" id="status" name="status">
                    <option value="enabled">Enabled</option>
                    <option value="disabled" <?php echo $status == 'disabled' ? 'selected' : false; ?>>Disabled</option>
                  </select>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button class="btn btn-primary" id="submit-btn">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
