$(document).ready(function () {});

    $('.delete-button').click(function() {
        if (confirm('Are you sure you want to delete this event?')) {
            $('#delete-form').submit();
        }
    });

    $('#search_event').on('blur', function() {
        // Your code when the input loses focus
        console.log("Input has lost focus!");
    });

    // edit_event_poster_update
    function clearUpdatePoster(){
        $('#edit_event_poster_update').val(null);

    }

function addTicketRow() {
    const lastRowId = $("#ticket-table tr:last").attr("id"); // tr_ticket_1
    var id_array = explode("_", lastRowId);
    var str_id = id_array[id_array.length - 1];
    var id = parseInt(str_id);

    $("#ticket-table").append(
        `
        <tr id="tr_ticket_${id}">
        <td colspan="5"> <input wire:model="tickets.${id}" type="text" id="event_name_${id}" class="form-control" /> </td>
        <td colspan="5"> <input wire:model="payment_links.${id}" type="text" id="payment_links_${id}" class="form-control" /> </td>
        <td colspan="1"> <button class="btn" onClick="deleteTicketRow(${id});"><i class="fa fa-trash"></i></button> </td>
        </tr>
        
        `
    );
}

function deleteTicketRow(ticket_row_id) {
    const ticket_table_rows = $('[id^="tr_ticket_"]');

    if (ticket_table_rows.length >= 2) {
        $(`#tr_ticket_${ticket_row_id}`).remove();
    }
}

function explode(separator, string) {
    return string.split(separator);
}


function openModal() {

    setTimeout(function() {
        var modal = $('#viewEvent');
        modal.modal('show');
    }, 500); // Adjust the delay time as needed
    
    
}

function openModalGuest() {

    setTimeout(function() {
        var modal = $('#viewGuestDetails');
        modal.modal('show');
    }, 500); // Adjust the delay time as needed
    
    
}


