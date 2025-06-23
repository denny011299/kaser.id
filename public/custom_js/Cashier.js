const swiper = new Swiper(".mySwiper", {
    slidesPerView: 7,
    spaceBetween: 20,
    freemode:true,
    breakpoints: {
      320: {
        slidesPerView: 2,
      },
      576: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 4,
      },
      992: {
        slidesPerView: 7,
      }
    }
  });

