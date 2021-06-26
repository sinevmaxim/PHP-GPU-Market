const tableSelect = document.getElementById("table-selection");

tableSelect.addEventListener("change", (e) => {
    $.ajax({
        type: "POST",
        url: "tables_delete.php",
        data: {
            "value": e.target.value
        },
        success: (response) => {
            $(".database-tables").html(response)
        }
    })
})

