const tableSelect = document.getElementById("table-selection");

tableSelect.addEventListener("change", (e) => {
    $.ajax({
        type: "POST",
        url: "tables_update.php",
        data: {
            "value": e.target.value
        },
        success: (response) => {
            $(".database-tables").html(response)
        }
    })
})