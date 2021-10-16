$("#mainNav").removeClass("navbar-scrolled");
var navbarCollapse = function() {
    var x = window.matchMedia("(max-width: 991px)");
    if ($("#mainNav").offset().top > 100) {
      $("#mainNav").addClass("navbar-scrolled");
      if (x.matches) {
        $("#mainNav .navbar-brand img").attr('src','assets/img/logo2.png');
      } else {
        $("#mainNav .navbar-brand img").attr('src','assets/img/logo2.png');
      }
    } else {
      $("#mainNav").removeClass("navbar-scrolled");
      if (x.matches) {
        $("#mainNav .navbar-brand img").attr('src','assets/img/logo2.png');
      } else {
        $("#mainNav .navbar-brand img").attr('src','assets/img/logo1.png');
      }
    }
};
navbarCollapse();
$(window).scroll(navbarCollapse);