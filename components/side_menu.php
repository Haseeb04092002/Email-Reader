<div class="user-head">
  <div class="user-name">
    <h5>
      <a href="#" class="text-decoration-none fw-bold fs-5 text-light"> <?= $email_address; ?> </a>
    </h5>
  </div>
</div>
<div class="inbox-body">
  <a href="#" data-bs-toggle="modal" data-bs-target="#myModal" title="Compose" class="btn btn-compose">Compose</a>
  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myModalLabel">Compose</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form role="form" class="form-horizontal">
            <div class="mb-3 row">
              <label class="col-sm-2 col-form-label">To</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputEmail1" placeholder="">
              </div>
            </div>
            <div class="mb-3 row">
              <label class="col-sm-2 col-form-label">Cc / Bcc</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="cc" placeholder="">
              </div>
            </div>
            <div class="mb-3 row">
              <label class="col-sm-2 col-form-label">Subject</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputPassword1" placeholder="">
              </div>
            </div>
            <div class="mb-3 row">
              <label class="col-sm-2 col-form-label">Message</label>
              <div class="col-sm-10">
                <textarea class="form-control" rows="10" cols="30"></textarea>
              </div>
            </div>
            <div class="mb-3 row">
              <div class="col-sm-10 offset-sm-2">
                <label class="btn btn-success fileinput-button">
                  <i class="fa fa-plus"></i>
                  <span>Attachment</span>
                  <input type="file" name="files[]" multiple hidden>
                </label>
                <button type="submit" class="btn btn-primary">Send</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<ul class="inbox-nav inbox-divider">
  <li class="active">
    <a href="#">
      <i class="fa fa-inbox"></i> Inbox
    </a>
  </li>
  <li>
    <a href="#">
      <i class="fa fa-envelope-o"></i> Sent Mail </a>
  </li>
  <li>
    <a href="#">
      <i class="fa fa-bookmark-o"></i> Important </a>
  </li>
  <li>
    <a href="#">
      <i class=" fa fa-external-link"></i> Drafts
    </a>
  </li>
  <li>
    <a href="#">
      <i class=" fa fa-trash-o"></i> Trash </a>
  </li>
</ul>
<div>
  <p class="p-4 text-dark text-start" style="text-align: justify;">
    <span class="fw-bold text-dark text-decoration-underline">NOTE: </span>
    This Email Reading System securely fetches emails from your Gmail account (as provided at the start). Additional features — such as downloading attachments or replying to specific emails — can be integrated upon request. For your satisfaction and peace of mind, feel free to cross-check the fetched emails with those in your actual Gmail inbox. Thank you!
  </p>
</div>