const incrementElements = document.getElementsByClassName("input-number-increment");
const decrementElements = document.getElementsByClassName("input-number-decrement");

const appendEventListener = (array, value) => {
    for (var i = 0; i < array.length; i++) {
        array[i].addEventListener('click', (e) => {
            $(document).ready(
                $.ajax({
                    type: "POST",
                    url: "../item_quantity_handler.php",
                    data: {
                        "id": e.target.id,
                        "value": value
                    },
                    dataType: "json",
                    success: (response) => {
                        $(`.input-number-class-${e.target.id}`).val(response.response)
                        let totalPrice = parseInt($(`.cart-item-price-${e.target.id}`).html().slice(0, -1)) * response.response
                        $(".total-price").html(
                            parseInt($(".total-price").html().slice(0, -1)) -
                            parseInt($(`.total-price-class-${e.target.id}`).html().replace(0, -1))
                        )

                        $(".total-price").html(parseInt($(".total-price").html()) + totalPrice + "$")

                        $(`.total-price-class-${e.target.id}`).html(totalPrice + "$")
                    }
                }))
        });
    }
}

appendEventListener(incrementElements, "+")
appendEventListener(decrementElements, "-")