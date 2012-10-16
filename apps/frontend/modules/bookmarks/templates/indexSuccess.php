<h1><?php echo __('Bookmarks List') ?></h1>

<br />
<form action="<?php echo url_for($sf_request->getParameter('module') . '/' . $sf_request->getParameter('action')) ?>" method="get">
  <input type="text" name="search" value="<?php echo $sf_request->getParameter('search') ?>" id="search_keywords" />
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
      <td><?php echo $Bookmark->getUrl() ?></td>
      <td><?php echo $Bookmark->getRating() ?></td>
      <td><?php echo $Bookmark->getCreatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('bookmarks/new') ?>"><?php echo __('New bookmark') ?></a>
