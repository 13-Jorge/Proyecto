$(document).ready(function() {
    // Cargar estado inicial de favoritos
    cargarFavoritos();
    
    // Manejar el toggle de favoritos
    $('.favorite-checkbox').on('change', function() {
        const propiedadId = $(this).data('propiedad-id');
        const isFavorite = $(this).is(':checked');
        const checkbox = $(this);
        
        // Enviar la petición AJAX
        $.ajax({
            url: 'propiedades.php',
            type: 'POST',
            data: {
                propiedad_id: propiedadId,
                is_favorite: isFavorite.toString()
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Cambiar el estado visual del corazón
                    if (isFavorite) {
                        checkbox.closest('.btn-favorite').addClass('active');
                    } else {
                        checkbox.closest('.btn-favorite').removeClass('active');
                    }
                } else {
                    // Si falla, revertir el checkbox
                    checkbox.prop('checked', !isFavorite);
                    alert('Error al actualizar favorito');
                }
            },
            error: function() {
                // Si hay error, revertir el checkbox
                checkbox.prop('checked', !isFavorite);
                alert('Error de conexión');
            }
        });
    });
    
    // Función para cargar el estado inicial de favoritos
    function cargarFavoritos() {
        $.ajax({
            url: 'obtener_favoritos.php',
            type: 'GET',
            dataType: 'json',
            success: function(favoritos) {
                favoritos.forEach(function(favoritoId) {
                    const checkbox = $(`.favorite-checkbox[data-propiedad-id="${favoritoId}"]`);
                    checkbox.prop('checked', true);
                    checkbox.closest('.btn-favorite').addClass('active');
                });
            },
            error: function() {
                console.log('Error al cargar favoritos');
            }
        });
    }
    
    // Manejar el toggle de detalles
    $('.btn-toggle').on('click', function() {
        const icon = $(this).find('i');
        const isExpanded = $(this).attr('aria-expanded') === 'true';
        
        // Cambiar el icono después de un pequeño delay para que coincida con la animación
        setTimeout(() => {
            if (isExpanded) {
                $(this).find('.fa-chevron-up').hide();
                $(this).find('.fa-chevron-down').show();
            } else {
                $(this).find('.fa-chevron-down').hide();
                $(this).find('.fa-chevron-up').show();
            }
        }, 150);
    });
});