/**
 * Main JavaScript file for Shoura WordPress theme
 */

document.addEventListener('DOMContentLoaded', function() {
    'use strict';

    // Mobile menu functionality
    const mobileMenuBtn = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuBtn && mobileMenu) {
        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!mobileMenuBtn.contains(e.target) && !mobileMenu.contains(e.target)) {
                mobileMenu.classList.add('hidden');
            }
        });

        // Handle smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').slice(1);
                const target = document.getElementById(targetId);
                
                if (target) {
                    const offset = document.querySelector('.nav-fixed').offsetHeight;
                    const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - offset;
                    
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });

                    // Close mobile menu after clicking
                    mobileMenu.classList.add('hidden');
                }
            });
        });
    }

    // Smooth scrolling for anchor links
    function initSmoothScroll() {
        $('a[href^="#"]').on('click', function(e) {
            const target = $(this.hash);
            if (target.length) {
                e.preventDefault();
                const headerHeight = $('.nav-fixed').outerHeight() || 80;
                const targetOffset = target.offset().top - headerHeight;

                $('html, body').animate({
                    scrollTop: targetOffset
                }, 800);

                // Close mobile menu if open
                $('#mobile-menu').addClass('hidden');
            }
        });
    }

    // Initialize AOS
    function initAOS() {
        try {
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 1000,
                    once: true,
                    offset: 100,
                    disable: 'mobile' // Disable on mobile devices
                });
            } else {
                console.warn('AOS is not loaded');
            }
        } catch (error) {
            console.error('Error initializing AOS:', error);
        }
    }

    // Handle errors globally
    window.onerror = function(msg, url, lineNo, columnNo, error) {
        console.error('Error: ' + msg + '\nURL: ' + url + '\nLine: ' + lineNo);
        return false;
    };

})(jQuery);