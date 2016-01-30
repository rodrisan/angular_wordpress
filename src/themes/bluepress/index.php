<!DOCTYPE html>
<html>
<head>
  <base href="/jsonapi">
  <meta charset="UTF-8">
  <title>AngularJS + Wordpress</title>
  <?php wp_head(); ?>
</head>
<body>
  <div id="page" ng-app="app">
    <header>
      <h1>
        <a href="<?php echo site_url(); ?>">AngularJS + Wordpress</a>
      </h1>
    </header>

    <div ng-view></div>



    <footer>
      &copy; <?php echo date ( 'Y' ); ?>
    </footer>
    <?php wp_footer(); ?>
  </div>
</body>
</html>
