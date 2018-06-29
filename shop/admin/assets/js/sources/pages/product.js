if(document.getElementById('page-product')){
    (() => {
        // добавление фотки по клику
        const illustrationInput = document.getElementById('main-illustration-input'),
              illustrationElement = document.getElementById('main-illustration');
        illustrationElement.addEventListener('click', () => {
            illustrationInput.click();
        });
        illustrationInput.addEventListener('change', function () {
            let reader = new FileReader();
            reader.onload = (e) => {
                illustrationElement.style.backgroundImage = `url(${e.target.result})`;
            };
            reader.readAsDataURL(this.files[0]);
        });

        // tinyMCE
        const tinymceScript = document.createElement('script');
        tinymceScript.src = 'https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.7.13/tinymce.min.js';
        tinymceScript.addEventListener('load', () => {
            tinymce.init({
                selector: 'textarea',
                branding: false,
                height: '250'
            });
        });
        document.body.appendChild(tinymceScript);

        // добавление вариантов товара
        const variantsList = document.getElementById('product-variants-list');
        const variantTemplate = document.getElementById('product-variant-template').textContent;
        const parser = document.createElement('div');
        parser.innerHTML = variantTemplate;
        const variantElem = parser.children[0];
        document.getElementById('add-variant-btn').addEventListener('click', () => {
            variantsList.appendChild(variantElem.cloneNode(true));
        });

        // remove variant button
        variantsList.addEventListener('click', (e) => {
            if(e.target.classList.contains('remove-variant')){
                variantsList.removeChild(e.target.closest('.row'));
            }
        });

        document.getElementById('product-form').addEventListener('submit', function (e) {

            if(document.getElementById('product-title').value === ''){
                e.preventDefault();
                alert('Product should have title.');
            }

            const variantsInputs = this.querySelectorAll('input[name^="variants"]');
            if(variantsInputs.length === 0){
                e.preventDefault();
                alert('Product should have minimum 1 variant.');
                return;
            }
            const variantsInputsFiltered = Array.prototype.filter.call(variantsInputs, (input) => {
                return input.type !== 'hidden';
            });

            const isVariantsFilled = variantsInputsFiltered.every((input) => {
                return input.value !== '';
            });
            if(!isVariantsFilled){
                e.preventDefault();
                alert('All variants fields must be filled.');
            }

        });


    })();
}