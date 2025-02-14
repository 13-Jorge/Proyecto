document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');

    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(contactForm);
        fetch('../login/enviarMensaje.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert('Mensaje enviado correctamente');
            contactForm.reset();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al enviar el mensaje');
        });
    });
});
