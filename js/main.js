(function ($) {
    "use strict";
    
    // Dropdown on mouse hover
    $(document).ready(function () {
        function toggleNavbarMethod() {
            if ($(window).width() > 992) {
                $('.navbar .dropdown').on('mouseover', function () {
                    $('.dropdown-toggle', this).trigger('click');
                }).on('mouseout', function () {
                    $('.dropdown-toggle', this).trigger('click').blur();
                });
            } else {
                $('.navbar .dropdown').off('mouseover').off('mouseout');
            }
        }
        toggleNavbarMethod();
        $(window).resize(toggleNavbarMethod);
    });
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Vendor carousel
    $('.vendor-carousel').owlCarousel({
        loop: true,
        margin: 29,
        nav: false,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
            0:{
                items:2
            },
            576:{
                items:3
            },
            768:{
                items:4
            },
            992:{
                items:5
            },
            1200:{
                items:6
            }
        }
    });


    // Related carousel
    $('.related-carousel').owlCarousel({
        loop: true,
        margin: 29,
        nav: false,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
            0:{
                items:1
            },
            576:{
                items:2
            },
            768:{
                items:3
            },
            992:{
                items:4
            }
        }
    });


    // Product Quantity
    $('.quantity button').on('click', function () {
        var button = $(this);
        var oldValue = button.parent().parent().find('input').val();
        if (button.hasClass('btn-plus')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        button.parent().parent().find('input').val(newVal);
    });
    
})(jQuery);

function toggleCheckbox(qp_sort) {
    // add cat queries for url
    var urlQuery = "";
    var shopCatObjs = document.getElementsByClassName("shop-cat-checkbox");
    for(i = 0; i < shopCatObjs.length; i++) {
        if(shopCatObjs[i].checked && urlQuery == "") {
            urlQuery += "cat[]=" + shopCatObjs[i].dataset.category;
        }
        else if(shopCatObjs[i].checked) {
            urlQuery += "&cat[]=" + shopCatObjs[i].dataset.category;
        }
    }

    // add sort query for url
    if(qp_sort != "") {
        if(urlQuery == "") {
            urlQuery += "sort=" + qp_sort;
        } else {
            urlQuery += "&sort=" + qp_sort;
        }
    }

    // update link with query
    window.location.assign("/shop?" + urlQuery);
}

function makeRequest(url) {
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", url, false );
    xmlHttp.send( null );
}

function addToCart(productId) {
    // ensure productId is passed, otherwise don't do anything
    if(typeof productId == 'undefined') {
        return;
    }

    // get cart quantity
    var addToCartQuantity = document.getElementById("add-to-cart-quantity").value;

    // make request to add to cart
    makeRequest(window.location.origin + window.location.pathname + "?add-to-cart=" + productId + "&quantity=" + addToCartQuantity);

    // refresh page
    location.reload();
}

function updateCartItemQuantity(cartItemKey, cartItemQuantity) {
    // ensure cartItemKey and cartItemQuantity is passed, otherwise don't do anything
    if(typeof cartItemKey == 'undefined' || typeof cartItemQuantity == 'undefined') {
        return;
    }

    // make request to update cart item
    makeRequest(window.location.origin + window.location.pathname + "?update-cart-item=" + cartItemKey + "&update-quantity=" + cartItemQuantity);

    // refresh page
    location.reload();
}

function updateCartItemQuantityInput(cartItemKey) {
    // get cartItemQuantity
    var cartItemQuantity = document.getElementById("cart-item-quantity-" + cartItemKey).value;

    // update cart item quantity
    updateCartItemQuantity(cartItemKey, cartItemQuantity);
}

function decCartItem(cartItemKey, cartItemQuantity) {
    // ensure cartItemKey and cartItemQuantity is passed, otherwise don't do anything
    if(typeof cartItemKey == 'undefined' || typeof cartItemQuantity == 'undefined') {
        return;
    }

    // check if productQuantity is positive integer
    if(!(cartItemQuantity >= 0)) {
        return;
    }

    // dec cartItemQuantity
    cartItemQuantity--;

    // update cart item quantity
    updateCartItemQuantity(cartItemKey, cartItemQuantity);
}

function incCartItem(productId) {
    // ensure productId is passed, otherwise don't do anything
    if(typeof productId == 'undefined') {
        return;
    }

    // make request to inc cart item
    makeRequest(window.location.pathname + "?add-to-cart=" + productId);

    // refresh page
    location.reload();
}

function removeFromCart(removeUrl) {
    // make request to remove item from cart
    makeRequest(removeUrl);

    // refresh page
    location.reload();
}

$(".cart-item-quantity").on('keyup', function (e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
        updateCartItemQuantity(this.dataset.cartItemKey, this.value);
    }
});

$("#search-btn").click(function() {
    $('form#search-form').submit();
});
