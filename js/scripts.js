/**
 * iwasaki Theme Main Scripts
 * 
 * Handles core UI interactions including:
 * - Web font loading
 * - Mobile navigation toggle
 * - Smooth scrolling and breadcrumb anchoring
 * - Page-specific animations and interactive elements
 */

let $ = jQuery.noConflict();

/**
 * Web Font Loader configuration
 * Loads Google Fonts asynchronously to prevent render-blocking.
 */
window.WebFontConfig = {
  google: { families: ['Noto+Sans+JP:300,400,500,700', 'Noto+Serif+JP'] },
  active: function () {
    // Store font loading status in session storage
    sessionStorage.fonts = true;
  }
};
(function () {
  let wf = document.createElement('script');
  wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
  wf.type = 'text/javascript';
  wf.async = 'true';
  let s = document.getElementsByTagName('script')[0];
  s.parentNode.insertBefore(wf, s);
})();

/**
 * Body 'loaded' class
 * Adds a class to the body after a short delay to trigger entry animations.
 */
$(window).on('load', function () {
  $("body").delay(500).queue(function () {
    $(this).addClass('loaded').dequeue();
  })
});

/**
 * Object Fit Images Polyfill
 * Ensures object-fit: cover/contain works in older browsers.
 */
if (typeof objectFitImages === 'function') {
  objectFitImages('img.object_fit');
}

/**
 * Mobile Header Menu Toggle
 * Handles the hamburger menu interaction for screens <= 1024px.
 */
$(function () {
  let common_header = $(".common-header");
  let header_toggle = $(".common-header__toggle");
  let header_nav = $(".common-header__menu");

  function checkMediaQuery() {
    header_toggle.off('click'); // Reset event listeners
    if (window.matchMedia('(max-width: 1024px)').matches) {
      header_toggle.on("click", function () {
        $(this).add(common_header).toggleClass("is-open");
        header_nav.toggleClass("is-open");
      });
    } else {
      // Reset styles for desktop view
      header_nav.show().removeClass("is-open");
      common_header.removeClass("is-open");
      header_toggle.removeClass("is-open");
    }
  }

  checkMediaQuery();

  // Update logic on resize (debounced checks are generally better, but this matches existing pattern)
  let lastInnerWidth = window.innerWidth;
  window.addEventListener("resize", function () {
    if (lastInnerWidth !== window.innerWidth) {
      lastInnerWidth = window.innerWidth;
      checkMediaQuery();
    }
  });
});

/**
 * Scroll to Top Button
 * Shows/hides the button based on scroll position and stops it at the footer.
 */
$(function () {
  let page_top = $(".common-footer__pageTop");
  let window_height = $(window).height();

  $(window).on("scroll", function () {
    let scroll_top = $(window).scrollTop();
    let scroll_bottom = scroll_top + $(window).height();
    let $footer = $("footer");

    // Show/hide based on height
    if (scroll_top > window_height) {
      page_top.fadeIn();
    } else {
      page_top.fadeOut();
    }

    // Stop button absolute if it hits the footer
    if ($footer.length) {
      let footer_top = $footer.offset().top;
      if (scroll_bottom >= footer_top) {
        page_top.css({ "position": "absolute" }).addClass("is-stop");
      } else {
        page_top.css({ "position": "fixed" }).removeClass("is-stop");
      }
    }
  });

  page_top.click(function () {
    $('body, html').animate({ scrollTop: 0 }, 500);
    return false;
  });
});

/**
 * Smooth Scroll for internal links
 * Calculates header height and scrolls smoothly to the target element.
 */
$(function () {
  let header_height = $(".common-header").height();
  $(window).on("scroll", function () {
    header_height = $(".common-header").height();
  })

  $('a[href^="#"]').click(function () {
    var href = $(this).attr("href");
    var target = $(href == "#" || href == "" ? "body" : href);
    if (target.length) {
      var position = target.offset().top;
      $("html, body").animate({ scrollTop: position - header_height - 50 }, 700, "swing");
    }
    return false;
  });

  /**
   * Sticky Breadcrumbs
   * Fixes breadcrumbs to the top of the viewport when scrolling past them.
   */
  if (window.location.pathname !== "/") {
    var $breadcrumbs = $('.mod-breadcrumbs');
    if ($breadcrumbs.length) {
      var headerHeight = $('.common-header').outerHeight();
      var offset = $breadcrumbs.offset().top - headerHeight;

      const updateBreadcrumbs = () => {
        if ($(window).scrollTop() > offset) {
          $breadcrumbs.addClass('fixed');
        } else {
          $breadcrumbs.removeClass('fixed');
        }
      };

      updateBreadcrumbs();
      $(window).on('scroll', updateBreadcrumbs);
      $(window).on('resize', function () {
        offset = $breadcrumbs.offset().top;
      });
    }
  }
});

/**
 * History Page Interactions
 * Triggers entrance animations for history items when they enter the viewport.
 */
$(function () {
  $(document).ready(function () {
    $('.page-history__fv').addClass('active');
  });

  $(window).on('scroll', function () {
    $('.page-history__item').each(function () {
      var elemPosition = $(this).offset().top,
        windowHeight = $(window).height(),
        scroll = $(window).scrollTop();

      // Trigger when item is halfway through the window
      if (scroll > elemPosition - windowHeight + windowHeight / 2) {
        $(this).addClass('extend');
      }
    });
  });
});

/**
 * Career/Qualification Page: FAQ Toggle
 * Handles the accordion interaction for Q&A sections.
 */
$(function () {
  $('.page-career__achievement-question').click(function () {
    $(this).parent('.page-career__achievement-item').toggleClass('selected');
    $(this).next('.page-career__achievement-answer').slideToggle();
  });
});

/**
 * Student Support: Dormitory Image Gallery
 * Switches the main image when a thumbnail is clicked.
 */
$(document).ready(function () {
  $('.page-support__dormitoryGuideLeftSubItem').on('click', function () {
    $('.page-support__dormitoryGuideLeftSubItem').removeClass('current');
    $(this).addClass('current');

    const newSrc = $(this).find('img').attr('data-src');
    const newSrcset = $(this).find('img').attr('data-srcset');
    const $mainImage = $('.page-support__dormitoryGuideLeftMain img');

    $mainImage.fadeOut(200, function () {
      $mainImage.attr('src', newSrc);
      $mainImage.attr('srcset', newSrcset);
      $mainImage.fadeIn(300);
    });
  });
});

/**
 * Recruiters Page: FAQ Toggle
 */
$(function () {
  $('.page-recruiters__post-question').click(function () {
    $(this).parent('.page-recruiters__post-item').toggleClass('selected');
    $(this).next('.page-recruiters__post-answer').slideToggle();
  });
});