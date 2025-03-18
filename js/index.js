document.addEventListener('DOMContentLoaded', function() {
    // Animación para las estadísticas
    const stats = document.querySelectorAll('.stat-number');
    let hasAnimated = false;
    
    // Función para verificar si el elemento está visible en la ventana
    function isInViewport(element) {
        const rect = element.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }
    
    // Función para animar el contador
    function animateStats() {
        if (hasAnimated) return;
        
        const statsSection = document.querySelector('.stats-section');
        if (!statsSection || !isInViewport(statsSection)) return;
        
        hasAnimated = true;
        
        stats.forEach(stat => {
            const target = parseInt(stat.getAttribute('data-count'), 10);
            let count = 0;
            const duration = 2000; // 2 segundos
            const interval = Math.floor(duration / target);
            
            const counter = setInterval(() => {
                count += 1;
                stat.textContent = count;
                
                if (count >= target) {
                    clearInterval(counter);
                }
            }, interval);
        });
    }
    
    // Ejecutar la animación al cargar si es visible
    animateStats();
    
    // Verificar al hacer scroll
    window.addEventListener('scroll', animateStats);

    // Mostrar la sección "Acerca de nosotros" por defecto en dispositivos grandes
    if (window.innerWidth >= 992) {
        const aboutSection = document.getElementById('aboutUsContent');
        if (aboutSection && aboutSection.classList.contains('collapse')) {
            aboutSection.classList.add('show');
        }
    }
});