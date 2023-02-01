<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Create New Permission</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      
     

      <form name="permission_form" id="permission_form" method="post" enctype="multipart/form-data" action="permission/store">
              {{ csrf_field() }}
      <button type="submit" class="btn btn-primary d-none" style="float:left;" id="submit">Submit</button>
      <input type="hidden"  name="errorOnSubmit" id="errorOnSubmit"  value="">
      <div class="modal-body">
      <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Permission Name*</label>
                    <input type="text" class="form-control required_field unique_entry" name="name" id="name" data-table="permission" value="" placeholder="Enter Permission Title" required="">
                  </div>
                </div>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" style="float:right;" id="submit-btn">Submit</button>
      </div>
        <!-- <div class="modal-footer justify-content-between"></div> -->
        </form>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


