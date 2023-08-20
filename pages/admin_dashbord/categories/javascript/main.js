(function ($) {
  // USE STRICT
  "use strict";

  try {
    //bar chart
    var ctx = document.getElementById("barChart");
    if (ctx) {
      ctx.height = 200;
      var myChart = new Chart(ctx, {
        type: "bar",
        defaultFontFamily: "Poppins",
        data: {
          labels: [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
          ],
          datasets: [
            {
              label: "My First dataset",
              data: [65, 59, 80, 81, 56, 55, 40],
              borderColor: "rgba(0, 123, 255, 0.9)",
              borderWidth: "0",
              backgroundColor: "rgba(0, 123, 255, 0.5)",
              fontFamily: "Poppins",
            },
            {
              label: "My Second dataset",
              data: [28, 48, 40, 19, 86, 27, 90],
              borderColor: "rgba(0,0,0,0.09)",
              borderWidth: "0",
              backgroundColor: "rgba(0,0,0,0.07)",
              fontFamily: "Poppins",
            },
          ],
        },
        options: {
          legend: {
            position: "top",
            labels: {
              fontFamily: "Poppins",
            },
          },
          scales: {
            xAxes: [
              {
                ticks: {
                  fontFamily: "Poppins",
                },
              },
            ],
            yAxes: [
              {
                ticks: {
                  beginAtZero: true,
                  fontFamily: "Poppins",
                },
              },
            ],
          },
        },
      });
    }
  } catch (error) {
    console.log(error);
  }
})(jQuery);

(function ($) {
  // USE STRICT
  "use strict";

  // Scroll Bar
  try {
    var jscr1 = $(".js-scrollbar1");
    if (jscr1[0]) {
      const ps1 = new PerfectScrollbar(".js-scrollbar1");
    }

    var jscr2 = $(".js-scrollbar2");
    if (jscr2[0]) {
      const ps2 = new PerfectScrollbar(".js-scrollbar2");
    }
  } catch (error) {
    console.log(error);
  }
})(jQuery);

(function ($) {
  // USE STRICT
  "use strict";

  // Select 2
  try {
    $(".js-select2").each(function () {
      $(this).select2({
        minimumResultsForSearch: 20,
        dropdownParent: $(this).next(".dropDownSelect2"),
      });
    });
  } catch (error) {
    console.log(error);
  }
})(jQuery);

(function ($) {
  // USE STRICT
  "use strict";

  // Dropdown
  try {
    var menu = $(".js-item-menu");
    var sub_menu_is_showed = -1;

    for (var i = 0; i < menu.length; i++) {
      $(menu[i]).on("click", function (e) {
        e.preventDefault();
        $(".js-right-sidebar").removeClass("show-sidebar");
        if (jQuery.inArray(this, menu) == sub_menu_is_showed) {
          $(this).toggleClass("show-dropdown");
          sub_menu_is_showed = -1;
        } else {
          for (var i = 0; i < menu.length; i++) {
            $(menu[i]).removeClass("show-dropdown");
          }
          $(this).toggleClass("show-dropdown");
          sub_menu_is_showed = jQuery.inArray(this, menu);
        }
      });
    }
    $(".js-item-menu, .js-dropdown").click(function (event) {
      event.stopPropagation();
    });

    $("body,html").on("click", function () {
      for (var i = 0; i < menu.length; i++) {
        menu[i].classList.remove("show-dropdown");
      }
      sub_menu_is_showed = -1;
    });
  } catch (error) {
    console.log(error);
  }

  var wW = $(window).width();
  // Right Sidebar
  var right_sidebar = $(".js-right-sidebar");
  var sidebar_btn = $(".js-sidebar-btn");

  sidebar_btn.on("click", function (e) {
    e.preventDefault();
    for (var i = 0; i < menu.length; i++) {
      menu[i].classList.remove("show-dropdown");
    }
    sub_menu_is_showed = -1;
    right_sidebar.toggleClass("show-sidebar");
  });

  $(".js-right-sidebar, .js-sidebar-btn").click(function (event) {
    event.stopPropagation();
  });

  $("body,html").on("click", function () {
    right_sidebar.removeClass("show-sidebar");
  });

  // Sublist Sidebar
  try {
    var arrow = $(".js-arrow");
    arrow.each(function () {
      var that = $(this);
      that.on("click", function (e) {
        e.preventDefault();
        that.find(".arrow").toggleClass("up");
        that.toggleClass("open");
        that.parent().find(".js-sub-list").slideToggle("250");
      });
    });
  } catch (error) {
    console.log(error);
  }

  try {
    // Hamburger Menu
    $(".hamburger").on("click", function () {
      $(this).toggleClass("is-active");
      $(".navbar-mobile").slideToggle("500");
    });
    $(".navbar-mobile__list li.has-dropdown > a").on("click", function () {
      var dropdown = $(this).siblings("ul.navbar-mobile__dropdown");
      $(this).toggleClass("active");
      $(dropdown).slideToggle("500");
      return false;
    });
  } catch (error) {
    console.log(error);
  }
})(jQuery);

(function ($) {
  // USE STRICT
  "use strict";

  // Load more
  try {
    var list_load = $(".js-list-load");
    if (list_load[0]) {
      list_load.each(function () {
        var that = $(this);
        that.find(".js-load-item").hide();
        var load_btn = that.find(".js-load-btn");
        load_btn.on("click", function (e) {
          $(this)
            .text("Loading...")
            .delay(1500)
            .queue(function (next) {
              $(this).hide();
              that.find(".js-load-item").fadeToggle("slow", "swing");
            });
          e.preventDefault();
        });
      });
    }
  } catch (error) {
    console.log(error);
  }
})(jQuery);

