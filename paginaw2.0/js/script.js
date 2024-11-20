window.addEventListener('scroll', function() {
    const bannerImg = document.querySelector('#banner img');
    const scrollPosition = window.scrollY;
    
    // Movimiento de la imagen con parallax (ajusta el valor de velocidad)
    bannerImg.style.transform = `translateY(${scrollPosition * 0.5}px)`;
});

