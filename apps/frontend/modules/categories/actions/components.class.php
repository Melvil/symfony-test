<?php

/**
 * categories components.
 *
 * @package    bookmarks
 * @subpackage categories
 * @author     Melvil
 */
class categoriesComponents extends sfComponents
{
	public function executeCategories(sfWebRequest $request)
	{
		 $this->Categories = CategoryPeer::doSelectWithI18n(new Criteria());
	}
}
