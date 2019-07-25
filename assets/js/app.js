var $ = jQuery;

$('#housing-modal').on('show.bs.modal', function (event) {
    console.log(event);
    var button = $(event.relatedTarget);
    var reference = button.data('title');

        // On change le value du input de la modal
        // avec le data-title du bouton cliqué
    $('#reference').val(reference);
    $('.modal-title').text(reference);
    $('#housing_id').val(button.data('id'));


   
    

  });