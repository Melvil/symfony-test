<?php if (isset($pager, $url_params) && $pager->haveToPaginate()): ?>

  <?php
    $current_page = $pager->getPage();
    $url_params = $sf_data->getRaw('url_params');
  ?>

  <div class="pagination">
    <ul>
      <li>
        <?php if ($current_page > 1): ?>
          <?php echo link_to('«', $url_params + array('page' => $current_page - 1)) ?>
        <?php else: ?>
          <span>«</span>
        <?php endif; ?>
      </li>

      <?php foreach ($pager->getLinks() as $page): ?>
        <?php if ($page == $current_page): ?>
          <li class="active"><span><?php echo $page ?></span></li>
        <?php else: ?>
          <li><?php echo link_to($page, $url_params + array('page' => $page)) ?></li>
        <?php endif; ?>
      <?php endforeach; ?>

      <li>
        <?php if ($current_page < $pager->getLastPage()): ?>
          <?php echo link_to('»', $url_params + array('page' => $current_page + 1)) ?>
        <?php else: ?>
          <span>»</span>
        <?php endif; ?>
      </li>
    </ul>
  </div>

<?php endif; ?>