document.addEventListener("DOMContentLoaded", function () {
if (document.getElementById('page-cart')) {
    (() => {

        Array.prototype.forEach.call(document.querySelectorAll('.button-change-variant-amount'), (item) => {
            item.addEventListener('click', function () {
                const btn = this;
                const variantId = btn.dataset.variantId,
                      action = btn.dataset.action;

                const xhr = new XMLHttpRequest();
                xhr.open('post', `cart/${action}/`, true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.addEventListener('load', (e) => {
                    const response = JSON.parse(e.target.response);
                    btn.parentElement.querySelector('.product-amount').textContent = response.amount;
                    document.getElementById('cart-total-products').textContent = response.totalProducts;
                    document.getElementById(`variant-${variantId}-total-price`).textContent = response.variantTotalPrice;
                    document.getElementById('order-price').textContent = response.totalPrice;
                });
                xhr.send(
                    'variantId=' + variantId
                );

            });
        });

    })();
}
if (document.getElementById('page-main')) {
    (() => {

        Array.prototype.forEach.call(document.querySelectorAll('.button-add-to-cart'), (item) => {
            item.addEventListener('click', function () {
                const btn = this;
                const variantId = btn.dataset.variantId,
                      action = btn.dataset.action;

                const xhr = new XMLHttpRequest();
                xhr.open('post', `cart/${action}/`, true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.addEventListener('load', (e) => {
                    const response = JSON.parse(e.target.response);
                    document.getElementById('cart-total-products').textContent = response.totalProducts;
                });
                xhr.send(
                    'variantId=' + variantId
                );
            });
        });

    })();
}
});