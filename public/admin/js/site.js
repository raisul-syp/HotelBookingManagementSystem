window.addEventListener('close-modal', event => {
    $('#deleteModal').modal('hide');
});


$(document).ready(function() {
    $('.js-basic-single').select2();


    feather.replace();

    $('[data-toggle="tooltip"]').tooltip();
});


