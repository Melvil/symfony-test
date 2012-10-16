<?php

/**
 * Bookmark form.
 *
 * @package    bookmarks
 * @subpackage form
 * @author     Melvil
 */
class BookmarkUserForm extends BaseBookmarkForm
{
	public function configure()
	{
		$this->useFields(array('id', 'title', 'info', 'url', 'bookmark_category_list'));

		$this->validatorSchema['url'] = new sfValidatorAnd(array($this->validatorSchema['url'], new sfValidatorUrl()));

		$this->widgetSchema->setLabels(array('bookmark_category_list' => 'Categories'));
/*
		$this->widgetSchema->setLabels(array(
			'title' => 'Заголовок',
			'info' => 'Информация',
			'url' => 'URL',
			'bookmark_category_list' => 'Категории',
		));
*/
	}
}
