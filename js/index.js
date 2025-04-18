
function submitForm(Subject, SenderName, SenderEmail, MsgNo, MsgDate, MsgDetailDate, attachmentsStatus)
{
// Get the hidden form and input fields
const form = document.getElementById('DataForm');
document.getElementById('Subject').value = Subject;
document.getElementById('SenderName').value = SenderName;
document.getElementById('SenderEmail').value = SenderEmail;
document.getElementById('MsgNo').value = MsgNo;
document.getElementById('MsgDate').value = MsgDate;
document.getElementById('MsgDetailDate').value = MsgDetailDate;
document.getElementById('attachmentsStatus').value = attachmentsStatus;

// Submit the form
form.submit();
}


// ------ Bootstrao Tooltips -----//
document.addEventListener('DOMContentLoaded', function () {
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });
});




(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();
    
})(jQuery);
