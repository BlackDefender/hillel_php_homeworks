if(document.getElementById('page-products')){
    (() => {
        Array.prototype.forEach.call(document.querySelectorAll('.remove-product-form'), (item) => {
            item.addEventListener('submit', (e) => {
                if(!confirm('Are you sure want to delete product?')){
                    e.preventDefault();
                }
            });
        });
    })();
}