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


/* -------------------------------------------------------
					Counter
---------------------------------------------------------*/
const counters = document.querySelectorAll('.value');
const speed = 3000;

// Function to animate counters
counters.forEach(counter => {
    const value = +counter.getAttribute('akhi');
    const increment = value / speed;

    const animate = () => {
        const data = +counter.innerText;

        if (data < value) {
            counter.innerText = Math.ceil(data + increment);
            setTimeout(animate, 30); // Increase timeout for slower updates
        } else {
            counter.innerText = value;
        }
    }

    animate();
});


/* -------------------------------------------------------
						Aos js
---------------------------------------------------------*/
document.addEventListener('DOMContentLoaded', function() {
	AOS.init({
		duration: 1200, 
		easing: 'ease-in-out', 
		once: true, 
		offset: 100
	});
});


/* -------------------------------------------------------
					Menu items display js
---------------------------------------------------------*/
document.addEventListener('DOMContentLoaded', function () {
    const menuItems = document.querySelectorAll('.menu-navbar-item');
    const contents = document.querySelectorAll('.menu-content');

    menuItems.forEach(item => {
        item.addEventListener('click', function () {
            const targetId = this.id.replace('menu-', '') + '-content';

            // Remove active class from all menu items
            menuItems.forEach(item => item.classList.remove('active'));

            // Add active class to the clicked menu item
            this.classList.add('active');

            // Show the targeted content and hide others
            contents.forEach(content => {
                if (content.id === targetId) {
                    content.style.display = 'block';
                } else {
                    content.style.display = 'none';
                }
            });
        });
    });
});


/* -------------------------------------------------------
set the active class on the menu item when on menu.php
---------------------------------------------------------*/
document.addEventListener('DOMContentLoaded', function() {
	if (window.location.pathname.endsWith('menu.php')) {
		document.getElementById('menu-starter').classList.add('active');
	}
});
