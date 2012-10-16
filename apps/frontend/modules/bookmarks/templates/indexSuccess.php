<?php
  use_helper('Text');

  $current_url_params = array(
    'module' => $sf_params->get('module'),
    'action' => $sf_params->get('action'),
    'category' => $sf_params->get('category')
  );
  if (!$current_url_params['category']) unset($current_url_params['category']);
?>

<h1><?php echo __('Bookmarks List') ?></h1>

<br />
<form action="<?php echo url_for($current_url_params) ?>" method="get">
  <input type="text" name="search" value="<?php echo $sf_params->get('search') ?>" id="search_keywords" />
  <input type="submit" value="<?php echo __('search') ?>" />
  <div class="help"><?php echo __('Enter some keywords (title, info, url)') ?></div>
</form>
<br />

<table>
  <thead>
    <tr>
      <th><?php echo __('Id') ?></th>
      <th><?php echo __('Title') ?></th>
      <th><?php echo __('Info') ?></th>
      <th><?php echo __('Url') ?></th>
      <th><?php echo __('Rating') ?></th>
      <th><?php echo __('Created at') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($Bookmarks as $Bookmark): ?>
    <tr>
      <td><a href="<?php echo url_for('bookmarks/show?id='.$Bookmark->getId()) ?>"><?php echo $Bookmark->getId() ?></a></td>
      <td><?php echo $Bookmark->getTitle() ?></td>
      <td><?php echo $Bookmark->getInfo() ?></td>
      <td><?php echo auto_link_text($Bookmark->getUrl()) ?></td>
      <td><?php echo $Bookmark->getRating() ?></td>
      <td><?php echo $Bookmark->getCreatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php echo link_to(__('New bookmark'), 'bookmarks/new') ?>

<?php include_partial('global/pager', array('url_params' => $current_url_params, 'pager' => $pager)) ?>
