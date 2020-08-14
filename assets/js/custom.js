$(document).ready(function () {
  $("main#spapp > section").height($(document).height() - 60);

  var app = $.spapp({ pageNotFound: "error_404" }); // initialize

  // define routes
  app.route({
    view: "home",
    load: "home.html",
  });

  app.route({
    view: "menu",
    load: "menu.html",
  });

  app.route({
    view: "cart",
    load: "cart.html",
  });

  app.route({
    view: "customer",
    load: "customer.html",
  });

  app.route({
    view: "employee",
    load: "employee.html",
  });

  app.route({
    view: "admin",
    load: "admin.html",
  });

  app.route({
    view: "employees",
    load: "employees.html",
  });

  app.route({
    view: "login",
    load: "login.html",
  });

  app.route({
    view: "orders",
    load: "orders.html",
  });

  app.route({
    view: "statistics",
    load: "statistics.html",
  });

  app.route({
    view: "history",
    load: "history.html",
  });

  app.route({
    view: "editmenu",
    load: "editmenu.html",
  });

  app.route({
    view: "admin",
    load: "admin.html",
  });

  app.route({
    view: "status",
    load: "status.html",
  });

  app.route({
    view: "profile",
    load: "profile.html",
  });

  app.route({
    view: "logout",
    load: "logout.html",
  });

  // run app
  app.run();
});
