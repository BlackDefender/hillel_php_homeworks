document.addEventListener('DOMContentLoaded', () => {
    if(document.getElementById('page-add-post')){
        const tinymceScript = document.createElement('script');
        tinymceScript.src = 'https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.7.13/tinymce.min.js';
        tinymceScript.addEventListener('load', () => {
            tinymce.init({
                selector: 'textarea'
            });
        });
        document.body.appendChild(tinymceScript);
    }
});