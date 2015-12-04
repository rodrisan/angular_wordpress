<!DOCTYPE html>
<html ng-app="app">
<head>
  <base href="/jsonapi">
  <meta charset="UTF-8">
  <title>AngularJS + Wordpress</title>
  <?php wp_head(); ?>
</head>
<body>
  <header>
    <h1>
      <a href="<?php echo site_url(); ?>">AngularJS + Wordpress</a>
    </h1>
  </header>

  <div ng-view></div>

  <footer>
    &copy; <?php echo date ( 'Y' ); ?>
  </footer>
</body>
</html>
