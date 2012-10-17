<?php

/**
 * Bookmark form.
 *
 * @package    bookmarks
 * @subpackage form
 * @author     Melvil
 */
class BookmarkForm extends BaseBookmarkForm
{
	public function configure()
	{
		$this->useFields(array('id', 'title', 'info', 'url', 'bookmark_category_list'));

		$this->validatorSchema['url'] = new sfValidatorAnd(array($this->validatorSchema['url'], new sfValidatorUrl()));

		$this->widgetSchema->setLabel('bookmark_category_list', 'Categories');
	}
}
