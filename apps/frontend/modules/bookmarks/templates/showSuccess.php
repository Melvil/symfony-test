<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $Bookmark->getId() ?></td>
    </tr>
    <tr>
      <th>User:</th>
      <td><?php echo $Bookmark->getUserId() ?></td>
    </tr>
    <tr>
      <th>Title:</th>
      <td><?php echo $Bookmark->getTitle() ?></td>
    </tr>
    <tr>
      <th>Info:</th>
      <td><?php echo $Bookmark->getInfo() ?></td>
    </tr>
    <tr>
      <th>Url:</th>
      <td><?php echo $Bookmark->getUrl() ?></td>
    </tr>
    <tr>
      <th>Rating:</th>
      <td><?php echo $Bookmark->getRating() ?></td>
    </tr>
    <tr>
      <th>Vote good:</th>
      <td><?php echo $Bookmark->getVoteGood() ?></td>
    </tr>
    <tr>
      <th>Vote bad:</th>
      <td><?php echo $Bookmark->getVoteBad() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $Bookmark->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $Bookmark->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('bookmarks/edit?id='.$Bookmark->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('bookmarks/index') ?>">List</a>
