<!DOCTYPE html>
<html lang="en">
<head>
  <?php include_http_metas() ?>
  <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_metas() ?>
  <?php include_title() ?>
  <?php include_stylesheets() ?>
  <?php include_javascripts() ?>
  <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
  <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js" type="text/javascript"></script>
  <![endif]-->
</head>
<body>

  <header class="container">
    <div class="navbar">
      <div class="navbar-inner">

        <a class="brand" href="<?php echo url_for('@homepage') ?>"><?php echo __('Administration') ?></a>

        <ul class="nav">
          <li><?php echo link_to(__('Bookmarks'), 'bookmark/index') ?></li>
          <li><?php echo link_to(__('Categories'), 'category/index') ?></li>
          <li><?php // echo link_to(__('Users'), 'user/inedx') ?></li>
        </ul>

        <ul class="nav pull-right">
          <li><a href="/"><?php echo __('Go to frontend') ?></a></li>
          <?php if ($sf_user->isAuthenticated()): ?>
            <li class="brand"><?php echo $sf_user->getUsername() ?></li>
            <li><?php echo link_to(__('Logout'), '@sf_guard_signout') ?></li>
          <?php else: ?>
            <li><?php echo link_to(__('Login'), '@sf_guard_signin') ?></li>
          <?php endif; ?>
        </ul>

      </div>
    </div>
  </header>

  <div class="container">
    <div class="row">
        <?php echo $sf_content ?>
    </div>
  </div>

  <footer class="container">
    <br /><br />
    <?php // include_component('language', 'language') ?>
    <p>&copy; Symfony test work 2012</p>
  </footer>

</body>
</html>