<?php
  use_helper('Text');

  $current_url_params = $sf_request->getParameterHolder()->getAll();
?>

<?php slot('h1_title', __('Bookmarks List')) ?>

<?php include_partial('search_filter', array('url_params' => $current_url_params)) ?>

<table class="table table-striped">
  <thead>
    <tr>
      <th><?php echo __('Id') ?></th>
      <th><?php echo __('Title') ?></th>
      <th><?php echo __('Info') ?></th>
      <th><?php echo __('Url') ?></th>
      <th><?php echo __('Rating') ?></th>
      <th><?php echo __('Voting') ?></th>
      <th><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($Bookmarks as $Bookmark): ?>
    <tr class="jsVote">
      <td><?php echo $Bookmark->getId() ?></td>
      <td><?php echo $Bookmark->getTitle() ?></td>
      <td><?php echo $Bookmark->getInfo() ?></td>
      <td><?php echo auto_link_text($Bookmark->getUrl()) ?></td>
      <td><span class="jsRating" title="Всего <?php echo $Bookmark->getVoteAll() ?>: ↑<?php echo $Bookmark->getVoteGood() ?> и ↓<?php echo $Bookmark->getVoteBad() ?>">
        <?php echo $Bookmark->getRating() ?>
      </span></td>
      <td>
        <?php $vote = isset($Votes[$Bookmark->getId()]) ? $Votes[$Bookmark->getId()] : null; ?>
        <?php if ($currentUserId && $vote === null && $Bookmark->getUserId() !== $currentUserId): ?>
          <span><?php echo link_to('<i class="icon-thumbs-up"></i>', 'bookmarks/vote?id=' . $Bookmark->getId() . '&vote=1', array('title' => __('Good'), 'class' => 'jsGood')) ?></span>
          <span><?php echo link_to('<i class="icon-thumbs-down"></i>', 'bookmarks/vote?id=' . $Bookmark->getId() . '&vote=0', array('title' => __('Bad'), 'class' => 'jsBad')) ?></span>
        <?php else: ?>
          <span><i class="icon-thumbs-up icon-white"></i></span>
          <span><i class="icon-thumbs-down icon-white"></i></span>
        <?php endif; ?>
      </td>
      <td>
        <?php if ($Bookmark->getUserId() === $currentUserId): ?>
          <span><?php echo link_to('<i class="icon-edit"></i>', 'bookmarks/edit?id=' . $Bookmark->getId(), array('title' => __('Edit'), 'class' => 'btn btn-small')) ?></span>
          <span><?php echo link_to('<i class="icon-remove"></i>', 'bookmarks/delete?id=' . $Bookmark->getId(), array('title' => __('Delete'), 'class' => 'btn btn-small', 'method' => 'delete', 'confirm' => __('Are you sure?'))) ?></span>
        <?php else: ?>
          <span class="btn btn-small"><i class="icon-edit icon-white"></i></span>
          <span class="btn btn-small"><i class="icon-remove icon-white"></i></span>
        <?php endif; ?>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php include_partial('global/pager', array('url_params' => $current_url_params, 'pager' => $pager)) ?>
