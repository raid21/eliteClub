AOS.init();

var swiper = new Swiper('.swiper-container', {
    effect: 'coverflow',
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: 'auto',
    loop: true,
    coverflowEffect: {
        rotate: 0,
        stretch: 0,
        depth: 500,
        modifier: 1,
        slideShadows: true,
    },
    autoplay: {
        delay: 1000,
        disableOnInteraction: false,
    },
    pagination: {
        el: '.swiper-pagination',
    },
});