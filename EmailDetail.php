<?php

include 'components/css_files.php';
include 'connect.php';

$MsgNo = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$Subject     = $_POST['Subject'];
	$SenderName  = $_POST['SenderName'];
	$SenderEmail     = $_POST['SenderEmail'];
	$MsgNo       = $_POST['MsgNo'];
	$MsgDate     = $_POST['MsgDate'];
	$MsgDetailDate     = $_POST['MsgDetailDate'];
	$attachmentsStatus     = $_POST['attachmentsStatus'];
}
$MsgNo = 275;
$body = imap_fetchbody($connect, $MsgNo, 1);
$structure = imap_fetchstructure($connect, $MsgNo);

function findUrlsInMessage($message) {
    // Regular expression to match URLs
    $urlPattern = '/\bhttps?:\/\/[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|\/))/i';

    // Use preg_match_all to find all URLs in the message
    preg_match_all($urlPattern, $message, $matches);

    // Return the list of URLs found, if any
    return $matches[0];
}

// Assume $plainTextMessage contains the plain text message body fetched from the email

$urls = findUrlsInMessage($body);

// Check if any URLs were found and print them
if (!empty($urls)) {
    echo "URLs found in the message:\n";
} else {
    echo "No URLs found in the message.";
}
exit();
// $message = imap_fetchbody($connect, $MsgNo, 1);

// Function to find the part number of the text/plain message
function findPlainTextPart($structure) {
    if (isset($structure->parts) && count($structure->parts) > 0) {
        // Loop through each part of the message
        foreach ($structure->parts as $index => $subStructure) {
            if ($subStructure->type == 0 && strtolower($subStructure->subtype) == 'plain') {
                // Return the part number if it's text/plain
                return $index + 1;
            }
        }
    } else {
        // If the message has no parts, check if it's text/plain
        if ($structure->type == 0 && strtolower($structure->subtype) == 'plain') {
            return 1;
        }
    }

    return null; // Return null if no text/plain part is found
}

// Get the part number for the plain text message
$plainTextPartNumber = findPlainTextPart($structure);

// Fetch and display the plain text message, if it exists
if ($plainTextPartNumber !== null) {
    $plainTextMessage = imap_fetchbody($connect, $MsgNo, $plainTextPartNumber);
    // echo $plainTextMessage;
} else {
    echo "Plain text message not found.";
}

// $structure = imap_fetchstructure($connect, 250);
// echo '<br>';
// echo "this is MsgNo = ".$MsgNo;
// echo '<pre>';
// echo '<br>';
// print_r($body);
// echo '<pre>';
// exit();
?>

<div class="container-fluid w-100">
  <div class="mail-box">
    <aside class="sm-side">
      <?php
      include 'components/side_menu.php';
      ?>
    </aside>
    <aside class="lg-side">
      <div class="inbox-head">
        <h3>Inbox</h3>
        <form action="#" class="pull-right position">
          <div class="input-append">
            <input type="text" class="sr-input" placeholder="Search Mail">
            <button class="btn sr-btn" type="button">
              <i class="fa fa-search"></i>
            </button>
          </div>
        </form>
      </div>
      <div class="inbox-body">
        <?php include 'components/menu_bar.php'; ?>
        
        <div id="EmailDetailCard">
        	<div class="card">
			  <div class="card-header d-flex justify-content-between">
			  	<div class="d-block text-start">
				    <h4><?php echo $SenderName; ?></h4>
				    <h5 class="text-secondary"><?php echo $SenderEmail; ?></h5>
			    </div>
			  	<div class="d-block text-end">
				    <h5 class="text-secondary"><?php echo $MsgDetailDate; ?></h5>
			  	</div>
			  </div>
			  <div class="card-body">
			    <!-- <h5 class="card-title">Special title treatment</h5> -->
			    <p class="card-text">
			    	<?php echo $plainTextMessage; ?>
			    </p>
			    <a href="#" data-bs-toggle="modal" data-bs-target="#ReplyModal" title="Compose" class="btn btn-info">Reply</a>
				  <!-- Modal -->
				  <div class="modal fade mx-auto justify-content-center" id="ReplyModal" tabindex="-1" aria-labelledby="ReplyModalLabel" aria-hidden="true">
				    <div class="modal-dialog modal-lg">
				      <div class="modal-content">
				        <div class="modal-header">
				          <h5 class="modal-title" id="ReplyModalLabel">Compose</h5>
				          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				        </div>
				        <div class="modal-body">
				          <form role="form" class="form-horizontal">
				            <div class="mb-3 row">
				              <label class="col-sm-2 col-form-label">To</label>
				              <div class="col-sm-10">
				                <input value="<?php $SenderName; ?>" type="text" class="form-control" id="inputEmail1" placeholder="<?php echo $SenderName; ?>" readonly>
				              </div>
				            </div>
				            <div class="mb-3 row">
				              <label class="col-sm-2 col-form-label">Cc / Bcc</label>
				              <div class="col-sm-10">
				                <input value="<?php $SenderName; ?>" type="text" class="form-control" id="cc" placeholder="<?php echo $SenderName; ?>">
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
				                <label class="btn btn-success">
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
			</div>
        </div>

      </div>
    </aside>
  </div>
</div>

<?php
include 'components/js_files.php';
?>
