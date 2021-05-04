function slide_func() {
    let slideshow = document.querySelector(".slideshow");
    let slideshow_slides = document.querySelector(".slideshow_slides");
    let images = document.querySelectorAll(".slideshow_slides a img")
    let slides = document.querySelectorAll(".slideshow_slides a");
    let prev = document.querySelector(".prev");
    let next = document.querySelector(".next");
    let slideCount = slides.length;
    let currentIndex = 0;
    let timer;
    let reverse = false;

    for (let i = 0; i < slideCount; i++) {
        slides[i].style.left = (i * 40) + "%";
        slideshow_slides.addEventListener("mouseenter", function () {
            images[i].style.borderRadius = "50px";
        });
        slideshow_slides.addEventListener("mouseleave", function () {
            images[i].style.borderRadius = "400px";
        });
        slides[i].addEventListener("click", function () {
           document.getElementById("img")
        });
    }

    function gotoSlide(index) {
        currentIndex = index;
        slideshow_slides.style.left = -(currentIndex * 40) + "%";
        slideshow_slides.classList.add("animated");
        if (index === 0) {
            prev.style.display = "none";
        } else if (index === slideCount - 1) {
            next.style.display = "none";
        } else {
            prev.style.display = "block";
            next.style.display = "block";
        }
    }

    gotoSlide(0);

    prev.addEventListener("click", function (e) {
        e.preventDefault();
        let index = currentIndex;
        index === 0 ? index = slideCount - 1 : index--;
        gotoSlide(index);
    });

    next.addEventListener("click", function (e) {
        e.preventDefault();
        let index = currentIndex;
        index === slideCount - 1 ? index = 0 : index++;
        gotoSlide(index);
    });

    function startAuto() {
        timer = setInterval(function () {
            let index;
            if (reverse) {
                index = (currentIndex - 1) % slideCount;
            } else {
                index = (currentIndex + 1) % slideCount;
            }
            if (index === slideCount - 1) {
                reverse = true;
                index = slideCount - 1;
            } else if (index === 0) {
                reverse = false;
            }
            gotoSlide(index);
        }, 2000);
    }

    startAuto();

    slideshow.addEventListener("mouseenter", function () {
        clearInterval(timer);
    });

    slideshow.addEventListener("mouseleave", function () {
        startAuto();
    });

}