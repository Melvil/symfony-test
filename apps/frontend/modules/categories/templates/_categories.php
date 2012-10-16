<?php
  $current_category = $sf_request->getParameter('category');

  $form_action = array(
    'module' => 'bookmarks',
    'action' => $sf_request->getParameter('action'),
    'category' => null
  );
  if (!$form_action['action']) $form_action['action'] = 'index';
?>

<h4><?php echo __('Categories') ?></h4>

<ul class="nav nav-list">
  <?php foreach ($Categories as $Category): ?>
    <li<?php if ($Category->getId() == $current_category) echo ' class="active"'; ?>>
      <?php
        $form_action['category'] = $Category->getId();
        echo link_to($Category->getTitle(), $form_action);
      ?>
    </li>
  <?php endforeach; ?>
</ul>
