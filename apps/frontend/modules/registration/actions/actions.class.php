<?php

/**
 * registration actions.
 *
 * @package    bookmarks
 * @subpackage registration
 * @author     Melvil
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class registrationActions extends sfActions
{
	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeIndex(sfWebRequest $request)
	{
		if ($this->getUser()->isAuthenticated()) return $this->redirect('@homepage');

		$this->form = new RegistrationForm();
	}

	public function executeCreate(sfWebRequest $request)
	{
		if ($this->getUser()->isAuthenticated()) return $this->forward404();

		$this->forward404Unless($request->isMethod(sfRequest::PUT));

		$this->form = new RegistrationForm();

		$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));

		if ($this->form->isValid())
		{
			$user = $this->getUser();

			$user->signin($this->form->save());

			$user->setFlash('notice', $this->getContext()->getI18n()->__('You have successfully registered'));

			return $this->redirect(sfConfig::get('app_sf_guard_plugin_success_signin_url', $user->getReferer('@homepage')));
		}

		$this->setTemplate('index');
	}
}
