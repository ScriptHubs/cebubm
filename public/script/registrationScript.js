$(document).ready(function () {

  


    // #region loader
    setTimeout(function () {
        $("#loader").addClass("clear");
        setTimeout(function () {
            $("#loader").addClass("hide");
        }, 600); // 1
    }, 3000);
    // #endregion

    $("#paymentWindowOpen").click(function () {
        const selectedValue = $('[id^="ticket_"]');
        selectedValue.each(function () {
            const isChecked = $(this).prop("checked");
            if (isChecked) {
                console.log(`Element ${this.value} is checked.`);
                openWindow(this.value);
            }
        });
    });
});


function openWindow(URL) {
    let popupWindow; // Variable to store the reference to the opened popup window

    var windowUrl = URL;

    
    const windowFeatures = "width=700,height=700,resizable,scrollbars=yes";

    // Open the popup window and store its reference
    popupWindow = window.open(windowUrl, "_blank", windowFeatures);

    const checkPopupInterval = setInterval(function () {
        if (popupWindow && popupWindow.closed) {
            // The popup window is closed, perform your action here
     $("#back_btn").addClass("hidden");
     $("#final-window").addClass("hidden");
     $("#thank-you-panel").removeClass("hidden");

     
        }
    }, 2300); // Check every 1 second (adjust the interval as needed)
}


