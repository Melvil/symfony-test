<?php

/**
 * Category form.
 *
 * @package    bookmarks
 * @subpackage form
 * @author     Melvil
 */
class CategoryForm extends BaseCategoryForm
{
	public function configure()
	{
		unset($this['created_at'], $this['updated_at'], $this['bookmark_category_list']);

		$this->embedI18n(array('en', 'ru'));

		$this->widgetSchema->setLabel('en', 'English');
		$this->widgetSchema->setLabel('ru', 'Russia');
	}
}
