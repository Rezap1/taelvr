/**
 * FT UNSUR — Frontend JavaScript
 *
 * Bootstrap 5, AOS, SweetAlert2, Swiper, GLightbox, CountUp, LazySizes
 */

import './bootstrap';

// Bootstrap JS
import * as bootstrap from 'bootstrap';

// AOS Animation
import AOS from 'aos';

// SweetAlert2
import Swal from 'sweetalert2';

// Swiper
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay, EffectFade } from 'swiper/modules';

// GLightbox
import GLightbox from 'glightbox';

// CountUp
import { CountUp } from 'countup.js';

// LazySizes
import 'lazysizes';

// Make libraries available globally
window.bootstrap = bootstrap;
window.Swal = Swal;
window.Swiper = Swiper;
window.SwiperModules = { Navigation, Pagination, Autoplay, EffectFade };
window.GLightbox = GLightbox;
window.CountUp = CountUp;

// =========================================================================
// DOM Ready
// =========================================================================
document.addEventListener('DOMContentLoaded', () => {
    initAOS();
    initNavbarScroll();
    initBackToTop();
    initPreloader();
    initGLightbox();
});

// =========================================================================
// AOS Animation
// =========================================================================
function initAOS() {
    AOS.init({
        duration: 800,
        easing: 'ease-out-cubic',
        once: true,
        offset: 80,
        delay: 0,
    });
}

// =========================================================================
// Navbar Scroll Effect
// =========================================================================
function initNavbarScroll() {
    const navbar = document.querySelector('.navbar-main');
    if (!navbar) return;

    const handleScroll = () => {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    };

    window.addEventListener('scroll', handleScroll, { passive: true });
    handleScroll(); // Check initial state
}

// =========================================================================
// Back to Top Button
// =========================================================================
function initBackToTop() {
    const btn = document.querySelector('.btn-back-to-top');
    if (!btn) return;

    window.addEventListener('scroll', () => {
        if (window.scrollY > 400) {
            btn.classList.add('show');
        } else {
            btn.classList.remove('show');
        }
    }, { passive: true });

    btn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
}

// =========================================================================
// Preloader
// =========================================================================
function initPreloader() {
    const preloader = document.querySelector('.preloader');
    if (!preloader) return;

    window.addEventListener('load', () => {
        setTimeout(() => {
            preloader.classList.add('loaded');
        }, 300);
    });
}

// =========================================================================
// GLightbox (Gallery)
// =========================================================================
function initGLightbox() {
    const lightboxElements = document.querySelectorAll('.glightbox');
    if (lightboxElements.length > 0) {
        GLightbox({
            touchNavigation: true,
            loop: true,
            autoplayVideos: true,
        });
    }
}
