var toggleMenu = function () {
  var obj = $(".wrap");
  var menu = $(".menu");

  if (obj.hasClass("showMenu")) {
    obj.removeClass("showMenu");
    menu.removeClass("showMenu");

    obj.unbind("touchstart");
  } else {
    obj.addClass("showMenu");
    menu.addClass("showMenu");

    obj.bind("touchstart", function() {
        toggleMenu();
    });
  }
}

$("#h_nav").click(function(e) {
  toggleMenu();
  e.preventDefault();
});

