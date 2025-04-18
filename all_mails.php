<?php
include 'components/css_files.php';

// zdke kbrx fizu snom // ==== APP PASSWORD HASEEB ==== //

ini_set('display_errors', 1);
error_reporting(E_ALL);

include('class.imap.php');

ini_set('max_execution_time', 600);

$email_num = '';
if ($_SERVER["REQUEST_METHOD"] == "POST")
{

  $email_address = $_POST['email'];
  $app_password = $_POST['AapPassword'];
  $email_num = (int)$_POST['email_num'];
}

// echo 'email = '.$email;
// echo 'app_password = '.$app_password;
// echo 'email_num = '.$email_num;
// die();

if ($email_num == 0 || $email_num == null)
{
  $email_num = 1;
}

// $email_num = 5;

$email = new Imap();
$connect = $email->connect(
  '{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX',
  $email_address,
  $app_password
);

$IsAttachment = $email->checkAttachmentsStatus($email_num);
$LimitedMails = $email->LimitedMails($email_num, $IsAttachment);
// echo '<br>';
// echo '<pre>';
// print_r($LimitedMails);
// die();
$DownloadAttachment = $email->DownloadAttachment($email_num);



// $email->disconnect();


?>

<!-- Spinner Start -->
<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner"></div>
</div>
<!-- Spinner End -->

<div class="container-fluid w-100">
  <div class="mail-box">
    <aside class="sm-side">
      <?php
      include 'components/side_menu.php';
      ?>
    </aside>
    <aside class="lg-side">
      <div class="inbox-head">
        <h3>Inbox (Your Latest <?= $email_num; ?> Gmails)</h3>
      </div>
      <div class="inbox-body">
        <?php include 'components/menu_bar.php'; ?>
        <form id="DataForm" action="EmailDetail.php" method="POST">
          <table class="table table-inbox table-hover text-start align-items-center w-100">
            <tbody>
              <tr>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
              </tr>

              <?php
              $SenderEmail = '';
              foreach ($LimitedMails as $email)
              {
                $Subject = $email['subject'];
                $SenderName = $email['from'];
                if (preg_match('/<(.+?)>/', $SenderName, $matches)) 
                {
                  $SenderEmail = ($matches[1]); // Sender email address
                } 
                else 
                {
                  $SenderEmail = 'Unknown mail';
                }

                $MsgNo = $email['MsgNo'];
                
                $dateString = $email['date'];
                $timestamp = strtotime($dateString);
                $MsgDate = date('d M Y', $timestamp);
                $MsgDetailDate = date("l jS \of F Y h:i:s A", $timestamp);

                $attachmentsStatus = $email['attachmentsStatus'];

                // $AttachmentBtn = '';
                $AttachmentBtn = 'd-none';
                // echo $attachmentsStatus;
                if ($attachmentsStatus)
                {
                  $AttachmentBtn = 'd-block';
                }
                else
                {
                  $AttachmentBtn = 'd-none';
                }

                include 'components/message_row.php';

              }

              ?>

            </tbody>
          </table>

          <input type="hidden" name="Subject" id="Subject">
          <input type="hidden" name="SenderName" id="SenderName">
          <input type="hidden" name="SenderEmail" id="SenderEmail">
          <input type="hidden" name="MsgNo" id="MsgNo">
          <input type="hidden" name="MsgDate" id="MsgDate">
          <input type="hidden" name="MsgDetailDate" id="MsgDetailDate">
          <!-- <input type="hidden" name="MsgBody" id="MsgBody"> -->
          <input type="hidden" name="attachmentsStatus" id="attachmentsStatus">

        </form>

      </div>
    </aside>
  </div>
</div>

<?php
include 'components/js_files.php';
?>