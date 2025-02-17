document.addEventListener('DOMContentLoaded', function() {
    const container = document.querySelector('.before-after-container');
    const beforeImage = container.querySelector('.before-image');
    const afterImage = container.querySelector('.after-image');
    const slider = container.querySelector('.before-after-slider');

    let isResizing = false;

    // Set initial state
    afterImage.style.clipPath = 'inset(0 0 0 50%)';
    slider.style.left = '50%';

    // Function to handle resize
    function resizeImages(x) {
        let containerWidth = container.offsetWidth;
        let percentage = (x / containerWidth) * 100;
        afterImage.style.clipPath = `inset(0 0 0 ${percentage}%)`;
        slider.style.left = `${percentage}%`;
    }

    // Mouse events
    slider.addEventListener('mousedown', () => {
        isResizing = true;
    });

    window.addEventListener('mouseup', () => {
        isResizing = false;
    });

    container.addEventListener('mousemove', (e) => {
        if (!isResizing) return;
        let x = e.clientX - container.getBoundingClientRect().left;
        resizeImages(x);
    });

    // Touch events
    slider.addEventListener('touchstart', () => {
        isResizing = true;
    });

    window.addEventListener('touchend', () => {
        isResizing = false;
    });

    container.addEventListener('touchmove', (e) => {
        if (!isResizing) return;
        let x = e.touches[0].clientX - container.getBoundingClientRect().left;
        resizeImages(x);
    });

    // Window resize event
    window.addEventListener('resize', () => {
        let currentPercentage = parseFloat(slider.style.left) || 50;
        resizeImages((currentPercentage / 100) * container.offsetWidth);
    });
});