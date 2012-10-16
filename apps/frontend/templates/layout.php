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

<?php $is_auth = $sf_user->isAuthenticated(); ?>

  <header class="container">
    <div class="navbar">
      <div class="navbar-inner">

        <a class="brand" href="<?php echo url_for('@homepage') ?>"><?php echo __('Bookmarks') ?></a>

        <ul class="nav">
          <li><?php echo link_to(__('All'), 'bookmarks/index') ?></li>
          <li><?php echo link_to(__('Rating'), 'bookmarks/rating') ?></li>
          <?php if ($is_auth): ?>
            <li><?php echo link_to(__('My bookmarks'), 'bookmarks/my') ?></li>
          <?php endif; ?>
        </ul>

        <ul class="nav pull-right">
          <?php if ($is_auth): ?>
            <li class="brand"><?php echo $sf_user->getUsername() ?></li>
            <li><?php echo link_to(__('Logout'), '@sf_guard_signout') ?></li>
          <?php else: ?>
            <li><?php echo link_to(__('Login'), '@sf_guard_signin') ?></li>
            <li><?php echo link_to(__('Registration'), 'registration/index') ?></li>
          <?php endif; ?>
        </ul>

      </div>
    </div>
  </header>

  <div class="container">
    <div class="row">

       <div class="span9">

        <?php if ($sf_user->hasFlash('notice')): ?>
          <div class="flash_notice"><?php echo $sf_user->getFlash('notice') ?></div>
        <?php endif; ?>
 
        <?php if ($sf_user->hasFlash('error')): ?>
          <div class="flash_error"><?php echo $sf_user->getFlash('error') ?></div>
        <?php endif; ?>

        <?php echo $sf_content ?>

      </div>

      <div class="span3">
        <div class="well sidebar-nav">

          <h3>Right region</h3>

          <?php if ($is_auth): ?>
            <ul class="nav nav-list">
              <li><?php echo link_to(__('New bookmark'), 'bookmarks/new') ?></li>
            </ul>
          <?php endif; ?>

          <?php include_component('categories', 'categories') ?>

        </div>
      </div>

    </div>
  </div>

  <footer class="container">
    <br /><br />
    <p>&copy; Symfony test work 2012</p>
  </footer>

</body>
</html>