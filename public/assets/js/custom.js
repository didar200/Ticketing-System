/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 * 
 */

"use strict";

function ticketList(){
    let search = $('#search').val();
    let url = $('#search').data('url');

    $.ajax({
        url: url,
        type: "GET",
        data: {
            search: search,
        },
        dataType: "JSON",
        success: function(response){
            let list = JSON.parse(response.data);
            $("#tableData").html(list);
        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(textStatus, errorThrown);
        }
    });
}

function customerTicketList(){
    let customer_id = $('#searchCustomer').val();
    let url = $('#searchCustomer').data('url');

    $.ajax({
        url: url,
        type: "GET",
        data: {
            customer_id: customer_id,
        },
        dataType: "JSON",
        success: function(response){
            let list = JSON.parse(response.data);
            $("#tableData").html(list);
        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(textStatus, errorThrown);
        }
    });
}

function searchCustomerList()
{
    let search = $('#search').val();
    let url = $('#search').data('url');

    $.ajax({
        url: url,
        type: "GET",
        data: {
            search: search,
        },
        dataType: "JSON",
        success: function(response){
            let list = JSON.parse(response.data);
            $("#tableData").html(list);
        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(jqXHR, textStatus, errorThrown);
        }
    });
}

function detailCustomer(id)
{

    $.ajax({
        url: "customerDetailAjax?id="+id,
        type: "GET",
        dataType: "JSON",
        success: function(response){
            let list = JSON.parse(response.data);
            $("#detailCustomers").html(list);
        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(textStatus, errorThrown);
        }
    });
}


function searchCustomerListPop()
{
    let search = $('#search').val();
    let url = $('#search').data('url');

    $.ajax({
        url: url,
        type: "GET",
        data: {
            search: search,
        },
        dataType: "JSON",
        success: function(response){
            let list = JSON.parse(response.data);
            $("#tableData").html(list);
        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(jqXHR, textStatus, errorThrown);
        }
    });
}

function detailCustomerEmail(id)
{

    $.ajax({
        url: "detailCustomerEmail?id="+id,
        type: "GET",
        dataType: "JSON",
        success: function(response){
            let list = JSON.parse(response.data);
            $("#detailCustomerEmail").html(list);
        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(textStatus, errorThrown);
        }
    });
}



