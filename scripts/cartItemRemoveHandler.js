const array = document.getElementsByClassName("cart-remove-btn");

for (var i = 0; i < array.length; i++) {
    array[i].addEventListener('click', (e) => {
        $(document).ready(
            $.ajax({
                type: "POST",
                url: "../cart_item_remove.php",
                data: {
                    "id": parseInt(e.target.id.replace("cart-remove-", "").replace("-item", ""))
                },
                success: () => {
                    alert(`Item removed, refresh page to see changes`)
                }
            }))
    });
}