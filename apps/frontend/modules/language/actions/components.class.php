<?php

/**
 * language components.
 *
 * @package    bookmarks
 * @subpackage language
 * @author     Melvil
 */
class languageComponents extends sfComponents
{
	public function executeLanguage(sfWebRequest $request)
	{
		$this->form = new sfFormLanguage($this->getUser(), array('languages' => array('en', 'ru')));
	}
}
