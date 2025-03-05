import './bootstrap';

document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', function () {
        let listItem = this.closest('li');
        listItem.querySelector('.participant-view').classList.add('hidden');
        listItem.querySelector('.edit-form').classList.remove('hidden');
    });
});

document.querySelectorAll('.cancel-edit').forEach(button => {
    button.addEventListener('click', function () {
        let listItem = this.closest('li');
        listItem.querySelector('.edit-form').classList.add('hidden');
        listItem.querySelector('.participant-view').classList.remove('hidden');
    });
});

document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', function (e) {
        if (!confirm("Êtes-vous sûr de vouloir supprimer ce participant ?")) {
            e.preventDefault();
        }
    });
});
