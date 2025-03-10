$(document).ready(function() {
    // Controla el cambio de texto e iconos en el botón de toggle
    $('.btn-toggle').on('click', function() {
        $(this).toggleClass('collapsed');
        
        // Cambia el texto del botón según estado
        if ($(this).hasClass('collapsed')) {
            $(this).find('span').text('Ver Detalles');
        } else {
            $(this).find('span').text('Ocultar Detalles');
        }
    });
    
    // Añade la clase show para la animación de expansión/contracción
    $('.collapse').on('show.bs.collapse', function () {
        $(this).find('.property-details').addClass('show');
    }).on('hide.bs.collapse', function () {
        $(this).find('.property-details').removeClass('show');
    });
});