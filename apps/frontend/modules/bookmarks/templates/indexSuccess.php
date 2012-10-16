<h1>Bookmarks List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>User</th>
      <th>Title</th>
      <th>Info</th>
      <th>Url</th>
      <th>Rating</th>
      <th>Vote good</th>
      <th>Vote bad</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($Bookmarks as $Bookmark): ?>
    <tr>
      <td><a href="<?php echo url_for('bookmarks/show?id='.$Bookmark->getId()) ?>"><?php echo $Bookmark->getId() ?></a></td>
      <td><?php echo $Bookmark->getUserId() ?></td>
      <td><?php echo $Bookmark->getTitle() ?></td>
      <td><?php echo $Bookmark->getInfo() ?></td>
      <td><?php echo $Bookmark->getUrl() ?></td>
      <td><?php echo $Bookmark->getRating() ?></td>
      <td><?php echo $Bookmark->getVoteGood() ?></td>
      <td><?php echo $Bookmark->getVoteBad() ?></td>
      <td><?php echo $Bookmark->getCreatedAt() ?></td>
      <td><?php echo $Bookmark->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('bookmarks/new') ?>">New</a>
