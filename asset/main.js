const modalWrapper = document.querySelector('.view');
const images = document.querySelectorAll('.image');
const modalImage = document.querySelector('.view-image');

images.forEach(function(image) {
    image.addEventListener('click', function() {
        modalWrapper.classList.add('show');
        modalImage.src = image.getAttribute('src');
    });
});

modalWrapper.addEventListener('click', function() {
    if (this.classList.contains('show')) {
        this.classList.remove('show');
        modalImage.src = "";
    }
});