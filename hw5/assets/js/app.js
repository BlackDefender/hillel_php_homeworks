document.addEventListener("DOMContentLoaded", function () {

    var editUserForm = document.getElementById('editUserForm');
    function onChangeUserClick(){
        editUserForm.querySelector('input[name="index"]').value = this.dataset.index;
        editUserForm.querySelector('input[name="name"]').value = this.dataset.name;
        editUserForm.querySelector('input[name="email"]').value = this.dataset.email;
    }
    Array.prototype.forEach.call(document.querySelectorAll('.users-list .change-user'), function (item) {
        item.addEventListener('click', onChangeUserClick);
    });

});