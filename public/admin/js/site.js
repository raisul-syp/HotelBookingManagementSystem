window.addEventListener('close-modal', event => {
    $('#deleteModal').modal('hide');
});

$(document).ready(function() {
    feather.replace();
    
    $('.js-basic-single').select2();

    $('[data-toggle="tooltip"]').tooltip();
});


