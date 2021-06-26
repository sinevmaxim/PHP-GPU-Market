const cartAddHandler = (id) => {
    $(document).ready(
        $.ajax({
            type: "POST",
            url: "../cart_handler.php",
            data: {
                "id": id
            },
            success: (response) => {
                $(".cart-nav-item").html("Cart " + response)
            }
        }))
}