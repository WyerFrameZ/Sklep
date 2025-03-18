document.addEventListener("DOMContentLoaded", function () {
    let images = ["img/drzewa3.jpg", "img/drzewa2.jpg"];
    let index = 0;

    setInterval(() => {
        index = (index + 1) % images.length;
        document.body.style.backgroundImage = `url('${images[index]}')`;
    }, 5000); // Zmiana co 5 sekund
});