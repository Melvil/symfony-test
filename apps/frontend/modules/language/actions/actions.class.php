<?php

/**
 * language actions.
 *
 * @package    bookmarks
 * @subpackage language
 * @author     Melvil
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class languageActions extends sfActions
{
	public function executeChangeLanguage(sfWebRequest $request)
	{
		$user = $this->getUser();

		$form = new sfFormLanguage($user, array('languages' => array('en', 'ru')));

		$form->process($request);

		return $this->redirect($user->getReferer('@homepage'));
	}
}
