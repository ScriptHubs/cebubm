$(document).ready(function () {
  $("#btnSideNav").click(function () {
    $(".sidebar").toggleClass("open");
  });
});

$(document).ready(function() {
  // Handle header checkbox click event
  $('#headerCheckbox').on('change', function() {
    const isChecked = $(this).prop('checked');
    $('.event-checkbox').prop('checked', isChecked);
  });

  // Handle individual checkbox click events
  $('.event-checkbox').on('change', function() {
    if ($('.event-checkbox:checked').length === $('.event-checkbox').length) {
      $('#headerCheckbox').prop('checked', true);
    } else {
      $('#headerCheckbox').prop('checked', false);
    }
  });
});
