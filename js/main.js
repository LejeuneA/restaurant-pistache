/* -------------------------------------------------------
				 Offcanvas menu
---------------------------------------------------------*/
function openNav() {
	document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
	document.getElementById("mySidenav").style.width = "0";
}


/* -------------------------------------------------------
				  Back to top button
---------------------------------------------------------*/
document.addEventListener("DOMContentLoaded", function () {
	const backToTopButton = document.getElementById("backToTop");

	// Function to smoothly scroll to the top of the page
	const scrollToTop = () => {
		const c = document.documentElement.scrollTop || document.body.scrollTop;
		if (c > 0) {
			window.requestAnimationFrame(scrollToTop);
			window.scrollTo(0, c - c / 30); // Adjust the speed by changing the value
		}
	};

	// Add click event listener to back-to-top button
	if (backToTopButton) {
		backToTopButton.addEventListener("click", function (e) {
			e.preventDefault();
			scrollToTop();
		});
	}

	// Show/hide back-to-top button based on scroll position
	window.addEventListener("scroll", function () {
		const backToTopButton = document.getElementById("backToTop");

		if (backToTopButton) {
			if (window.scrollY > 100) { // Adjust the scroll position threshold as needed
				backToTopButton.classList.add("active");
			} else {
				backToTopButton.classList.remove("active");
			}
		}
	});
});


/* -------------------------------------------------------
				  Initialize Swiper
---------------------------------------------------------*/

    var swiper = new Swiper(".mySwiper", {
      spaceBetween: 0,
      centeredSlides: true,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
	  loop: true,
	  effect: "fade",
    });