$(document).ready(function() {
    // Load header content into the top part
    $("#toppart").load("header.html");

    // Function to open a popup
    window.openPopup = function(id) {
        var popup = $("#popup" + id);
        popup.addClass("open-popup");
    };

    // Function to close a popup
    window.closePopup = function(id) {
        var popup = $("#popup" + id);
        popup.removeClass("open-popup");
    };

    // Function to open the order form
    window.openOrderForm = function(itemId, itemName) {
        $("#order-item-id").val(itemId);
        $("#order-form").show();
    };
});
