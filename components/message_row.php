<tr class="">
  <td colspan="1" class="inbox-small-cells">
    <input type="checkbox" class="mail-checkbox">
  </td>
  <td colspan="1" class="inbox-small-cells">
    <i class="fa fa-star inbox-started"></i>
  </td>
  <td colspan="4" class="view-message dont-show">
    <div class="d-block">
      <p class="my-0 text-dark fw-bold"> <?= $SenderName; ?> </p>
      <p class="my-0 text-secondary"> <?= $SenderEmail; ?> </p>
    </div>
  </td>
  <td colspan="7" class="view-message"> <?= $Subject; ?> </td>
  <td colspan="1" class="view-message inbox-small-cells">
    <button data-bs-toggle="tooltip" data-bs-placement="bottom" title="Attachment" class="btn-sm btn btn-warning 
        <?= $AttachmentBtn; ?>">
      <i class="fa fa-file-text-o"></i>
    </button>
  </td>
  <td colspan="1" class="inbox-small-cells">
    <button data-bs-toggle="tooltip" data-bs-placement="bottom" title="Save" class="btn-sm btn btn-info">
      <i class="fa fa-floppy-o"></i>
    </button>
  </td>
  <td colspan="1" class="inbox-small-cells">
    <button data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete" class="btn-sm btn btn-danger">
      <i class="fa fa-trash-o"></i>
    </button>
  </td>
  <td colspan="4" class="view-message text-right"> <?= $MsgDate; ?> </td>
</tr>