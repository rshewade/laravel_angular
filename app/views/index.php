<!doctype html>
<html lang="en" ng-app="app">
<head>
  <meta charset="UTF-8">
  <title>An Introduction to Angular.JS</title>
  <!-- <link rel="stylesheet" href="packages/components/foundation/css/foundation.min.css"> -->
  <!-- <script type="text/javascript" src="packages/bower/headjs/dist/1.0.0/head.min.js" data-headjs-load="js/boot.js"></script> -->
  

  <link rel="stylesheet" type="text/css" href="packages/bower/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="packages/bower/fontawesome/css/font-awesome.min.css">
  <!-- <link rel="stylesheet" href="packages/bower/normalize.css/normalize.css"> -->
  
  <script type="text/javascript" src="packages/bower/jquery/dist/jquery.min.js"></script>
  <script type="text/javascript" src="packages/bower/bootstrap/dist/js/bootstrap.js"></script>
  <script type="text/javascript" src="packages/bower/angularjs/angular.min.js"></script>
  <script type="text/javascript" src="packages/bower/angular-bootstrap/ui-bootstrap.js"></script>
  <script type="text/javascript" src="packages/bower/angular-sanitize/angular-sanitize.min.js"></script>
  <!-- <script type="text/javascript" src="packages/bower/angular-route/angular-route.js"></script> -->
  <script type="text/javascript" src="packages/bower/angular-ui-router/release/angular-ui-router.min.js"></script>
  <script type="text/javascript" src="packages/bower/underscore/underscore-min.js"></script>
  <script type="text/javascript" src="packages/bower/angular-smart-table/dist/smart-table.min.js"></script>

  <link rel="stylesheet" type="text/css" href="css/app.css">
  <script type="text/javascript" src="js/app.js"></script>
  <script type="text/javascript" src="js/appConfig.js"></script>
  <script type="text/javascript" src="js/controllers/BooksController.js"></script>
  <script type="text/javascript" src="js/controllers/HomeController.js"></script>
  <script type="text/javascript" src="js/controllers/LoginController.js"></script>
  <script type="text/javascript" src="js/controllers/baseController.js"></script>
  <script type="text/javascript" src="js/controllers/UsersController.js"></script>
  <script type="text/javascript" src="js/directives/showsMessageWhenHovered.js"></script>
  <script type="text/javascript" src="js/services/AuthenticationService.js"></script>
  <script type="text/javascript" src="js/services/BookService.js"></script>
  <script type="text/javascript" src="js/services/FlashService.js"></script>
  <script type="text/javascript" src="js/services/SessionService.js"></script>
  <script>
  angular.module("app").constant("CSRF_TOKEN", '<?php echo csrf_token(); ?>');
  </script>
</head>
<body ng-controller="baseController">
<nav class="navbar navbar-default" role="navigation" style="background-color:white; border:none;" ng-cloak>
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <div class="navbar-brand" href="#">
        Your Portal
      </div>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"  >
      <ul class="nav navbar-nav navbar-right" >
        <li><a class="" href="#"> Home</a></li>
        <li><a class="" href="#/contact"> Contact</a></li>
        <li><a class="" href="#/about"> About</a></li>
        <li class="dropdown">
          <a class="" data-toggle="dropdown" ng-show = "user.name.length>0"> Dynamic Menu <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li ng-repeat="menu in user.routes">
                <a href="#{{ menu.eroute }}">{{ menu.name }}</a>
            </li>
          </ul>
        </li>
        <li><a class="" href="#/login" ng-hide = "user.name.length>0"> Log In</a></li>
        <li class="dropdown" ng-show = "user.name.length>0">
          <a class="" data-toggle="dropdown"> {{ user.name }}<small>({{user.role}})</small> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#/cngpass">Change Password</a></li>
            <li><a href="#" ng-click="logout()">Log Out</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->

  </div><!-- /.container-fluid -->
</nav>
<div class="container">
  <div class="row" !ng-cloak ng-hide="true">
  <br><br>
  <div class="alert alert-danger">
  <center><strong>
  Something went wrong, if you are seeing this frequently please contact system administrator</strong></center></div></div>  
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
          <div id="flash" class="alert alert-danger" ng-show="flash" role="alert" ng-cloak>
            {{ flash }}
          </div>
     </div>
     <div id="view" ng-view ng-cloak> </div>
     <div ui-view ng-cloak></div>  
  </div>
 </div> 

</body>
</html>