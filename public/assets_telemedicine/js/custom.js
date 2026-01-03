/*
Theme Name: Karona - Health & Medical Multipurpose Template
Author: Codezion Softwares
Author URL: https://themeforest.net/user/codezionsoftwares
Version: 1.0.0
*/
(function ($) {
  "use strict";
  // custom-select
  $(document).ready(function () {
    $(".custom-select").niceSelect();
    $("td:empty").addClass("no-bg");
  });
  // Navigation fix
  $(window).scroll(function () {
    var sticky = $(".header .navigation-wrapper"),
      scroll = $(window).scrollTop();
    if (scroll >= 100) sticky.addClass("sticky");
    else sticky.removeClass("sticky");
  });
  $(document).ready(function () {
    $(".hamburger-menu").click(function () {
      $(".menu-btn").toggleClass("active");
      $(".main-menu").toggleClass("active");
      $("body").toggleClass("menu-open");
      $("html").toggleClass("overflow");
    });
  });

  //Pricing Page Toggle Button Script Start
  document.addEventListener("DOMContentLoaded", function () {
    const toggleSwitch = document.getElementById("toggleSwitch");
    const prices = document.querySelectorAll(".price");
    const monthlyText = document.getElementById("monthlyText");
    const yearlyText = document.getElementById("yearlyText");

    const monthlyPrices = ["$4.50", "$9.50", "$14.50"];
    const yearlyPrices = ["$9.00", "$20.00", "$44.00"];

    toggleSwitch.addEventListener("change", function () {
      // Change prices dynamically
      prices.forEach((price, index) => {
        price.textContent = toggleSwitch.checked
          ? yearlyPrices[index]
          : monthlyPrices[index];
      });

      // Change text color dynamically
      if (toggleSwitch.checked) {
        yearlyText.classList.add("text-[#FF8B5C]");
        yearlyText.classList.remove("text-gray-400");
        monthlyText.classList.add("text-gray-400");
        monthlyText.classList.remove("text-[#FF8B5C]");
      } else {
        monthlyText.classList.add("text-[#FF8B5C]");
        monthlyText.classList.remove("text-gray-400");
        yearlyText.classList.add("text-gray-400");
        yearlyText.classList.remove("text-[#FF8B5C]");
      }
    });
  });
  //Pricing Page Toggle Button Script End

  //Schedule Appointment
  document.addEventListener("DOMContentLoaded", function () {
    const calendarMonth = document.getElementById("calendar-month");
    const calendarGrid = document.getElementById("calendar-grid");
    const prevMonthBtn = document.getElementById("prev-month");
    const nextMonthBtn = document.getElementById("next-month");

    let currentDate = new Date();

    function renderCalendar() {
      calendarGrid.innerHTML = "";
      let year = currentDate.getFullYear();
      let month = currentDate.getMonth();
      let firstDay = new Date(year, month, 1).getDay();
      let lastDate = new Date(year, month + 1, 0).getDate();

      calendarMonth.textContent = currentDate.toLocaleString("default", {
        month: "long",
        year: "numeric",
      });

      // Filling empty days from the previous month
      for (let i = 0; i < firstDay; i++) {
        let emptyDay = document.createElement("div");
        emptyDay.classList.add("text-gray-400");
        calendarGrid.appendChild(emptyDay);
      }

      // Filling current month days
      for (let i = 1; i <= lastDate; i++) {
        let day = document.createElement("div");
        day.textContent = i;
        day.classList.add(
          "cursor-pointer",
          "p-2",
          "text-center",
          "rounded-full"
        );

        if (
          i === new Date().getDate() &&
          month === new Date().getMonth() &&
          year === new Date().getFullYear()
        ) {
          day.classList.add("bg-[#FF8B5C]", "text-white");
        } else {
          day.classList.add("hover:bg-gray-200");
        }

        calendarGrid.appendChild(day);
      }
    }

    function changeMonth(direction) {
      currentDate.setMonth(currentDate.getMonth() + direction);
      renderCalendar();
    }

    prevMonthBtn.addEventListener("click", function () {
      changeMonth(-1);
    });

    nextMonthBtn.addEventListener("click", function () {
      changeMonth(1);
    });

    renderCalendar();
  });
  //Schedule Appointment script End

  $(document).ready(function () {
    // Initialize Slick Slider
    $(".post-slider").slick({
      dots: false, // Enable dots
      arrows: true, // Enable arrows
      infinite: true, // Loop through slides infinitely
      speed: 500, // Transition speed
      slidesToShow: 1, // Show one slide at a time
      slidesToScroll: 1, // Scroll one slide at a time
      autoplay: true, // Enable autoplay
      autoplaySpeed: 3000, // Time between slides
      prevArrow:
        '<button type="button" class="slick-prev absolute rounded-full w-10 h-10 m-2 z-10 flex items-center justify-center 2xl:top-[330px] 2xl:left-[10px] xl:left-[10px] lg:left-[10px] xl:top-[310px] lg:top-[260px] md:top-[280px] md:left-[10px]"></i></button>',
      nextArrow:
        '<button type="button" class="slick-next absolute rounded-full w-10 h-10 m-2 flex items-center justify-center 2xl:top-[330px] 2xl:right-[10px] xl:right-[10px] lg:right-[10px] xl:top-[310px] lg:top-[260px] md:top-[280px] md:right-[10px]"></i></button>',
      responsive: [
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            dots: true, // Ensure dots are enabled for smaller screens
            arrows: false, // Hide arrows on smaller screens
          },
        },
      ],
    });
  });

  //Service Slider Script Start
  $(document).ready(function () {
    $(".service-slider").slick({
      slidesToShow: 5, // Shows 4 items in a row for large screens
      slidesToScroll: 1, // Moves 1 item at a time
      autoplay: true, // Enables auto-slide
      autoplaySpeed: 2000, // Sets auto-slide speed (2 seconds)
      arrows: false, // Hides navigation arrows
      dots: true, // Shows navigation dots
      responsive: [
        {
          breakpoint: 1280, // Tablets
          settings: {
            slidesToShow: 4,
          },
        },
        {
          breakpoint: 1024, // Tablets
          settings: {
            slidesToShow: 3,
          },
        },
        {
          breakpoint: 768, // Mobile devices
          settings: {
            slidesToShow: 2,
          },
        },
        {
          breakpoint: 480, // Small screens
          settings: {
            slidesToShow: 1,
          },
        },
      ],
    });
  });
  //Service Slider Script End

  //Testimonial Sider Script Start
  $(document).ready(function () {
    $(".testimonial-slider").slick({
      slidesToShow: 2, // Shows 2 testimonials in a row for large screens
      slidesToScroll: 1, // Moves 1 at a time
      autoplay: true, // Auto-slide enabled
      autoplaySpeed: 3000, // 3 seconds per slide
      arrows: false, // Show left/right arrows
      dots: true, // Show navigation dots
      responsive: [
        {
          breakpoint: 1024, // Tablets
          settings: {
            slidesToShow: 1,
          },
        },
        {
          breakpoint: 768, // Mobile
          settings: {
            slidesToShow: 1,
          },
        },
        {
          breakpoint: 480, // Small screens
          settings: {
            slidesToShow: 1,
          },
        },
      ],
    });
  });
  //Testimonial Sider Script End

  // Home Page Team Member Script Start
  const doctors = [
    {
      id: 1,
      name: "Dr. Ethan Brown",
      specialty: "Orthopedic Surgeon",
      role: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean nulla nisi, mattis sed tortor eu, condimentum tincidunt orci. Donec sit amet rhoncus lorem, ut volutpat nisi.",
      image: "https://placehold.co/96x96",
    },
    {
      id: 2,
      name: "Dr. Olivia Martinez",
      specialty: "Dermatologist",
      role: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean nulla nisi, mattis sed tortor eu, condimentum tincidunt orci. Donec sit amet rhoncus lorem, ut volutpat nisi.",
      image: "https://placehold.co/96x96",
    },
    {
      id: 3,
      name: "Dr. John Smith",
      specialty: "Founder & CEO",
      role: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean nulla nisi, mattis sed tortor eu, condimentum tincidunt orci. Donec sit amet rhoncus lorem, ut volutpat nisi.",
      image: "https://placehold.co/96x96",
    },
    {
      id: 4,
      name: "Dr. Sophia Johnson",
      specialty: "Endocrinologist",
      role: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean nulla nisi, mattis sed tortor eu, condimentum tincidunt orci. Donec sit amet rhoncus lorem, ut volutpat nisi.",
      image: "https://placehold.co/96x96",
    },
    {
      id: 5,
      name: "Dr. Daniel Carter",
      specialty: "Oncologist",
      role: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean nulla nisi, mattis sed tortor eu, condimentum tincidunt orci. Donec sit amet rhoncus lorem, ut volutpat nisi.",
      image: "https://placehold.co/96x96",
    },
  ];

  let activeIndex = 2;
  const doctorCardsContainer = document.getElementById("doctor-cards");
  const prevButton = document.getElementById("prev-button");
  const nextButton = document.getElementById("next-button");

  /**
   * Determines the number of visible cards based on the device type.
   *
   * @returns {number} The number of visible cards based on screen category.
   */
  function getVisibleCount() {
    const screenWidth = window.innerWidth;

    if (screenWidth >= 1280) {
      return 5; // PC (≥ 1280px)
    } else if (screenWidth >= 1024) {
      return 3; // Laptop (≥ 1024px)
    } else {
      return 1; // Mobile (< 1024px)
    }
  }
  // Function to create a doctor card
  function createDoctorCard(doctor, position, visibleCount) {
    const card = document.createElement("div");
    const isActive = position === 0;
    const isVisible = Math.abs(position) < visibleCount / 2;

    card.className = `transition-transform duration-700 ease-in-out transform ${
      isVisible ? "block" : "hidden"
    } ${
      isActive
        ? "w-64 h-[400px] bg-[#25CED1] rounded-lg shadow-lg z-30 scale-110"
        : "w-60 h-96 opacity-60 scale-90"
    }`;

    card.innerHTML = `
    <div class="w-full h-full p-4 rounded-lg ${
      isActive ? "bg-[#25CED1]" : "bg-[#FF8B5C]"
    } transition-colors duration-500">
      <div class="w-24 h-24 mx-auto mb-4 overflow-hidden rounded-full">
        <img src="${doctor.image}" alt="${
      doctor.name
    }" class="w-full h-full object-cover">
      </div>
      <div class="text-center">
        <h3 class="font-bold text-black text-xl">${doctor.name}</h3>
        <p class="text-white font-bold mb-4">${doctor.specialty}</p>
        ${
          doctor.role
            ? `<p class="text-white font-medium">${doctor.role}</p>`
            : ""
        }
      </div>
    </div>
  `;
    return card;
  }

  // Function to update displayed doctor cards
  function updateDoctorCards() {
    doctorCardsContainer.innerHTML = "";
    const visibleCount = getVisibleCount();

    doctors.forEach((doctor, index) => {
      const position = index - activeIndex;
      const card = createDoctorCard(doctor, position, visibleCount);
      doctorCardsContainer.appendChild(card);
    });
  }

  // Event listeners for navigation
  nextButton.addEventListener("click", () => {
    activeIndex = activeIndex === doctors.length - 1 ? 0 : activeIndex + 1;
    updateDoctorCards();
    doctorCardsContainer.scrollIntoView({
      behavior: "smooth",
      block: "nearest",
    });
  });

  prevButton.addEventListener("click", () => {
    activeIndex = activeIndex === 0 ? doctors.length - 1 : activeIndex - 1;
    updateDoctorCards();
    doctorCardsContainer.scrollIntoView({
      behavior: "smooth",
      block: "nearest",
    });
  });

  // Update the cards initially and on window resize
  updateDoctorCards();
  window.addEventListener("resize", updateDoctorCards);
  // Home Page Team Member Script End

  //Home Page Calendar Script Start
  document.addEventListener("DOMContentLoaded", function () {
    const calendarMonth = document.getElementById("cal-month");
    const calendarGrid = document.getElementById("cal-grid");
    const prevMonthBtn = document.getElementById("pre-month");
    const nextMonthBtn = document.getElementById("nex-month");

    let currentDate = new Date();

    function renderCalendar() {
      calendarGrid.innerHTML = "";
      let year = currentDate.getFullYear();
      let month = currentDate.getMonth();
      let firstDay = new Date(year, month, 1).getDay();
      let lastDate = new Date(year, month + 1, 0).getDate();

      calendarMonth.textContent = currentDate.toLocaleString("default", {
        month: "long",
        year: "numeric",
      });

      // Filling empty days from the previous month
      for (let i = 0; i < firstDay; i++) {
        let emptyDay = document.createElement("div");
        emptyDay.classList.add("text-white");
        calendarGrid.appendChild(emptyDay);
      }

      // Filling current month days
      for (let i = 1; i <= lastDate; i++) {
        let day = document.createElement("div");
        day.textContent = i;
        day.classList.add(
          "cursor-pointer",
          "p-2",
          "text-center",
          "rounded-full"
        );

        if (
          i === new Date().getDate() &&
          month === new Date().getMonth() &&
          year === new Date().getFullYear()
        ) {
          day.classList.add("bg-[#FF8B5C]", "text-white");
        } else {
          day.classList.add("bg-[#25CED1]", "text-white");
        }

        calendarGrid.appendChild(day);
      }
    }

    function changeMonth(direction) {
      currentDate.setMonth(currentDate.getMonth() + direction);
      renderCalendar();
    }

    prevMonthBtn.addEventListener("click", function () {
      changeMonth(-1);
    });

    nextMonthBtn.addEventListener("click", function () {
      changeMonth(1);
    });

    renderCalendar();
  });
  //Home Page Calendar Script End

  // Navigation
  $(document).ready(function () {
    $(
      ".main-menu li.menu-item-has-children>a, .main-menu li.menu-item-has-megamenu>a"
    ).on("click", function () {
      $(this).removeAttr("href");
      var element = $(this).parent("li");
      if (element.hasClass("open")) {
        element.removeClass("open");
        element.find("li").removeClass("open");
        element.find("ul.submenu, .megamenu").slideUp();
      } else {
        element.addClass("open");
        element.children("ul.submenu, .megamenu").slideDown();
        element.siblings("li").children("ul.submenu, .megamenu").slideUp();
        element.siblings("li").removeClass("open");
        element.siblings("li").find("li").removeClass("open");
        element.siblings("li").find("ul.submenu, .megamenu").slideUp();
      }
    });
    // $('.menu-item-has-children>a').append('<span class="arrow"></span>');
    // $('.menu-item-has-megamenu>a').append('<span class="arrow"></span>');
  });
  // counter
  $(".count").each(function () {
    $(this)
      .prop("Counter", 0)
      .animate(
        {
          Counter: $(this).text(),
        },
        {
          duration: 4000,
          easing: "swing",
          step: function (now) {
            $(this).text(Math.ceil(now));
          },
        }
      );
  });
  // Datepicker
  $(document).ready(function () {
    $(".datepickr").datepicker({
      timepicker: false,
      minDate: new Date(),
    });
    $(".dob").datepicker({
      timepicker: false,
    });
    $(".timepickr").datepicker({
      timepicker: true,
      onlyTimepicker: true,
      range: true,
    });
  });
  // Button style
  $(".btn_text_effect .button_title").each(function () {
    $(this).html(
      $(this)
        .text()
        .replace(/([^\x00-\x80]|\w)/g, "<span class='btn_letters'>$&</span>")
    );
  });
  var btnHover = document.querySelectorAll(".btn_text_effect");
  btnHover.forEach(function (btnHover) {
    btnHover.addEventListener("mouseenter", function () {
      var letter = btnHover.querySelectorAll(".btn_letters");
      anime.timeline({}).add({
        targets: letter,
        translateY: ["1.1em", 0],
        translateZ: 0,
        duration: 750,
        delay: (el, i) => 50 * i,
      });
    });
  });

  // smooth scroll
  $.fn.smoothScroll = function (setting) {
    var _default = {
        duration: 1000,
        easing: "swing",
        offset: 0,
        top: "100px",
      },
      _setting = $.extend(_default, setting),
      _handler = function () {
        var dest = 0,
          target = this.hash,
          $target = $(target);
        $(this).on("click", function (e) {
          e.preventDefault();
          if (
            $target.offset().top >
            $(document).height() - $(window).height()
          ) {
            dest = $(document).height() - $(window).height();
          } else {
            dest = $target.offset().top - _setting.offset;
          }
          $("html, body").animate(
            {
              scrollTop: dest,
            },
            _setting.duration,
            _setting.easing
          );
        });
      };
    return this.each(_handler);
  };
  $(".scrollbtn").smoothScroll({
    duration: 1000, // animation speed
    easing: "swing", // find more easing options on http://api.jqueryui.com/easings/
    offset: 0, // custom offset
  });
  // back to top
  var offset = 220;
  var duration = 500;
  $(window).on("scroll", function () {
    if ($(this).scrollTop() > offset) {
      $(".back-top").fadeIn(duration);
    } else {
      $(".back-top").fadeOut(duration);
    }
  });
  $(".back-top").on("click", function (event) {
    event.preventDefault();
    $("html, body").animate({ scrollTop: 0 }, "slow");
    return false;
  });
  if ($(window).scrollTop() > offset) {
    $(".back-top").fadeOut(0);
  }
  $('a[href="#"]').click(function (e) {
    e.preventDefault ? e.preventDefault() : (e.returnValue = false);
  });
})(jQuery);

// FAQ Script Start
function toggleAccordion(event, contentId) {
  const allCards = document.querySelectorAll("#accordion .card-header");
  const allIcons = document.querySelectorAll("[data-icon]");
  const currentCard = event.currentTarget;
  const currentContent = document.getElementById(contentId);
  const currentIcon = currentCard.querySelector("[data-icon]");

  // Reset all headers and icons
  allCards.forEach((card) => {
    card.classList.remove("text-black");
    card.classList.add("bg-[#F4F4F4]", "text-gray-900");
  });

  allIcons.forEach((icon) => {
    icon.textContent = "+";
    icon.classList.remove("text-[#2cb7df]");
    icon.classList.add("text-black");
  });

  // Toggle the current header
  if (currentContent.classList.contains("hidden")) {
    currentCard.classList.remove("bg-[#F4F4F4]", "text-gray-900");
    currentCard.classList.add("text-black");
    currentIcon.textContent = "-";
    currentIcon.classList.remove("text-black");
    currentIcon.classList.add("text-black");

    // Show content
    document.querySelectorAll(".card-body").forEach((body) => {
      body.classList.add("hidden");
    });
    currentContent.classList.remove("hidden");
  } else {
    currentCard.classList.remove("text-black");
    currentCard.classList.add("bg-[#F4F4F4]", "text-gray-900");
    currentContent.classList.add("hidden");
    currentIcon.textContent = "+";
    currentIcon.classList.remove("text-[#2cb7df]");
    currentIcon.classList.add("text-black");
  }
}

// Set default open card 1
document.addEventListener("DOMContentLoaded", () => {
  const defaultCard = document.querySelector("#contentOne");
  const defaultHeader = defaultCard.previousElementSibling;
  const defaultIcon = defaultHeader.querySelector("[data-icon]");

  defaultCard.classList.remove("hidden");
  defaultHeader.classList.add("text-black");
  defaultIcon.textContent = "-";
  defaultIcon.classList.remove("text-black");
  defaultIcon.classList.add("text-black");
});
// FAQ Script Ends
