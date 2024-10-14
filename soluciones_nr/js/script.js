const images = [
    '/paginaweb/soluciones_nr/images/fondo_1.png',
    '/paginaweb/soluciones_nr/images/fondo_2.jpeg',
    '/paginaweb/soluciones_nr/images/fondo_3.jpg'
];

let currentIndex = 0;
const preloadedImages = [];

function preloadImages() {
    for (let i = 0; i < images.length; i++) {
        const img = new Image();
        img.src = images[i];
        preloadedImages.push(img);
    }
}

function changeBackgroundImage() {
    const hero = document.querySelector('.hero');
    hero.style.backgroundImage = `linear-gradient(180deg, #0000008c 0%, #0000008c 100%), url('${images[currentIndex]}')`;
    hero.style.backgroundSize = '100vw 100vh'; // Ajusta el tamaño de la imagen para cubrir todo el contenedor
    hero.style.backgroundPosition = 'center'; // Centra la imagen en el contenedor

    currentIndex = (currentIndex + 1) % images.length;
}

preloadImages();
changeBackgroundImage(); // Cambia la imagen de fondo inicialmente
setInterval(changeBackgroundImage, 5000); // Cambia de imagen cada 5 segundos
