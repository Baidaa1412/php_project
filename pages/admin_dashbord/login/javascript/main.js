(function ($) {
  // USE STRICT
  "use strict";

  try {
    //Team chart
    var ctx = document.getElementById("team-chart");
    if (ctx) {
      ctx.height = 150;
      var myChart = new Chart(ctx, {
        type: "line",
        data: {
          labels: ["2010", "2011", "2012", "2013", "2014", "2015", "2016"],
          type: "line",
          defaultFontFamily: "Poppins",
          datasets: [
            {
              data: [0, 7, 3, 5, 2, 10, 7],
              label: "Expense",
              backgroundColor: "rgba(0,103,255,.15)",
              borderColor: "rgba(0,103,255,0.5)",
              borderWidth: 3.5,
              pointStyle: "circle",
              pointRadius: 5,
              pointBorderColor: "transparent",
              pointBackgroundColor: "rgba(0,103,255,0.5)",
            },
          ],
        },
        options: {
          responsive: true,
          tooltips: {
            mode: "index",
            titleFontSize: 12,
            titleFontColor: "#000",
            bodyFontColor: "#000",
            backgroundColor: "#fff",
            titleFontFamily: "Poppins",
            bodyFontFamily: "Poppins",
            cornerRadius: 3,
            intersect: false,
          },
          legend: {
            display: false,
            position: "top",
            labels: {
              usePointStyle: true,
              fontFamily: "Poppins",
            },
          },
          scales: {
            xAxes: [
              {
                display: true,
                gridLines: {
                  display: false,
                  drawBorder: false,
                },
                scaleLabel: {
                  display: false,
                  labelString: "Month",
                },
                ticks: {
                  fontFamily: "Poppins",
                },
              },
            ],
            yAxes: [
              {
                display: true,
                gridLines: {
                  display: false,
                  drawBorder: false,
                },
                scaleLabel: {
                  display: true,
                  labelString: "Value",
                  fontFamily: "Poppins",
                },
                ticks: {
                  fontFamily: "Poppins",
                },
              },
            ],
          },
          title: {
            display: false,
          },
        },
      });
    }
  } catch (error) {
    console.log(error);
  }

  try {
    //pie chart
    var ctx = document.getElementById("pieChart");
    if (ctx) {
      ctx.height = 200;
      var myChart = new Chart(ctx, {
        type: "pie",
        data: {
          datasets: [
            {
              data: [45, 25, 20, 10],
              backgroundColor: [
                "rgba(0, 123, 255,0.9)",
                "rgba(0, 123, 255,0.7)",
                "rgba(0, 123, 255,0.5)",
                "rgba(0, 123, 255,0.4 )",
              ],
              hoverBackgroundColor: [
                "rgba(0, 123, 255,0.9)",
                "rgba(0, 123, 255,0.7)",
                "rgba(0, 123, 255,0.5)",
                "rgba(0, 123, 255,0.3)",
              ],
            },
          ],
          labels: ["Flowers", "Choclate", "Watches" , "Perfume"],
        },
        options: {
          legend: {
            position: "top",
            labels: {
              fontFamily: "Poppins",
            },
          },
          responsive: true,
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