function myFunction(x) {
    if (x.matches) {
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 2,
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: {
                clickable: true,
            },
            keyboard: true,
        });
    } else {
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 5,
            spaceBetween: 30,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: {
                clickable: true,
            },
            keyboard: true,
        });
    }
}

var swiper = new Swiper(".mySwiper-hero", {
    spaceBetween: 0,
    centeredSlides: true,
    autoplay: {
        delay: 2500,
        disableOnInteraction: true,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
});

var x = window.matchMedia("(max-width: 750px)");
myFunction(x); // Call listener function at run time
x.addListener(myFunction); // Attach listener function on state changes

const btn = document.querySelector("#modal-btn");
btn.addEventListener("click", function () {
    Swal.fire({
        icon: "success",
        text: "Pesanan Berhasil Dimasukan",
        showConfirmButton: false,
        timer: 1500,
    });
});

var i = 0;
function buttonClick() {
    i++;
    document.getElementById("inc").value = i;
}
