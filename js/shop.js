
/***
 * Set cookie when add to cart
 * @params value: JSON - include id of product and quantity
 */
function setCookie(value) {
    cookies = document.cookie.split(";");
    exist = false; // check shop_cart isCreated?
    status = false; // add to cookie success or fail
    cookies.forEach(cookie => {
        key = cookie.split("=")[0].trim();
        if(key == "shop_cart") {
            exist = true;
            val = cookie.split("=")[1];
            products = JSON.parse(val);

            // check if product already in cookie
            checkInCart = products.filter(item =>{
                return item.id == value.id
            }).length > 0 ? true : false 

            if(!checkInCart) {
                products.push(value);               
                document.cookie = "shop_cart" + "=" + JSON.stringify(products);
                status = true;
            }
        }
    });
    if(exist) {
        return status;
    }
    else {
        product = [value];
        document.cookie = "shop_cart" + "=" + JSON.stringify(product);
        return true;
    }
    
}

/***
 * ALert info after set cookie
 * @params status: status after set cookie  
 */
function alertSetCookie(status) {
    content = status == "true" ? "Thêm sản phẩm vào giỏ hàng thành công" : "Sản phẩm đã có trong giỏ hàng. Vui lòng đến trang giỏ hàng để tăng số lượng sản phẩm";
    $.confirm({
        icon: 'fas fa-exclamation-triangle fa-sm text-shop',
        title: 'Thông báo',
        theme: "supervan",
        content: content,
        buttons: {
            confirm: {
                text: 'Đến trang giỏ hàng',
                btnClass: 'btn-shop',
                action: function () {
                    window.location.pathname = "php-learning/cart"
                }
            },
            cancel: {
                text: 'Tiếp tục mua hàng',
                action: function () {
                //close
                }
            }
        }
    });
}

/***
 * Format currency from integer
 * @params value: NUMBER
 */
function currency_format(value) {
    return value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
}

$(document).ready(function(){


    /* Star: tootip bootstrap */
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    })
    /* End: tootip bootstrap */

    /* Star: Add to cart in index page */
    $(".product-item").on("click", ".btn-add-to-cart", function() {
        product_id = $(this).parents(".product-item").data("id");
        addSuccess = setCookie({
            id: product_id,
            quantity: 1
        });
        alertSetCookie(addSuccess);
    })
    /* End: Add to cart in index page */


    /* Star: Add to cart in show page */
    $(".product-main").on("click", ".btn-add-to-cart", function() {
        product_id = $(this).parents(".product-main").data("id");
        quantity = parseInt($("#current-quantity").text());
        addSuccess = setCookie({
            id: product_id,
            quantity: quantity
        });
        alertSetCookie(addSuccess);
    })
    /* End: Add to cart in index page */


    /* Star: Change quantity in show page */
    $(".product-main").on("click", ".btn-down, .btn-up", function() {
        quantity = parseInt($("#current-quantity").text());
        if($(this).hasClass("btn-down")){
            $("#current-quantity").text(quantity == 1 ? 1 : quantity - 1);
        }
        else {
            $("#current-quantity").text(quantity + 1);
        }  
    })
    /* End: Change uquantity in show page */


    /* Star: Change quantity in cart page */
    $(".cart-list").on("click", ".btn-down, .btn-up", function() {
        quantity = parseInt($(this).parents(".cart-item").find(".current-quantity").text());
        price = parseInt($(this).parents(".cart-item").find(".price").text().split(",").join(""));
        if($(this).hasClass("btn-down")){
            if(quantity > 1) {
                /* save to cookie */

                /* update in view */
                price -= price/quantity;
                quantity -= 1;
                $(this).parents(".cart-item").find(".current-quantity").text(quantity);
                $(this).parents(".cart-item").find(".price").text(currency_format(price));
                totalMoney = parseInt($("#total_money").text().split(",").join(""));
                $("#total_money").text(currency_format(totalMoney - price/quantity));
                if(totalMoney - price/quantity < 150000) {
                    $("#transport_fee").text("15,000");
                    $("#need_pay").text(currency_format(totalMoney - price/quantity + 15000));
                }
                else {
                    $("#need_pay").text(currency_format(totalMoney - price/quantity));
                }
            }
        }
        else {
            price += price/quantity;
            quantity += 1;
            $(this).parents(".cart-item").find(".current-quantity").text(quantity);
            $(this).parents(".cart-item").find(".price").text(currency_format(price));
            totalMoney = parseInt($("#total_money").text().split(",").join(""));
            $("#total_money").text(currency_format(totalMoney + price/quantity));
            if(totalMoney + price/quantity >= 150000) {
                $("#transport_fee").text("0");
                $("#need_pay").text(currency_format(totalMoney + price/quantity));
            }
            else {
                $("#need_pay").text(currency_format(totalMoney + price/quantity + 15000));
            }
        }
        
    })
    /* End: Change uquantity in cart page */
})