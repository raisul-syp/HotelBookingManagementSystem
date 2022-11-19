window.addEventListener('close-modal', event => {
    $('#deleteModal').modal('hide');
});

$(document).ready(function() {
    feather.replace();
    
    $('.js-basic-single').select2();

    $('[data-toggle="tooltip"]').tooltip();

    $('#long_description').summernote({
        height: 200,
        focus: true,
        placeholder: 'Add Long Description...',
    });

    $('#date_of_birth').datepicker({ 
        dateFormat: 'yyyy-mm-dd',
    });

    $('.dropify').dropify();
});


