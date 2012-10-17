<?php
	$url_params = $sf_data->getRaw('url_params');
	unset($url_params['search'], $url_params['page']);
?>

<br />
<form action="<?php echo url_for($url_params) ?>" method="get">
  <input type="text" name="search" value="<?php echo $sf_params->get('search') ?>" id="search_keywords" />
  <input type="submit" value="<?php echo __('search') ?>" />
  <div class="help"><?php echo __('Enter some keywords (title, info, url)') ?></div>
</form>
<br />
