$(document).ready(function () {});

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

