<?php

/**
 * bookmarks actions.
 *
 * @package    bookmarks
 * @subpackage bookmarks
 * @author     Melvil
 */
class bookmarksActions extends sfActions
{
	public function executeIndex(sfWebRequest $request)
	{
		$criteria = new Criteria();
		$criteria->addAscendingOrderByColumn(BookmarkPeer::TITLE);

		$this->Bookmarks = BookmarkPeer::doSelect($criteria);
	}

	public function executeRating(sfWebRequest $request)
	{
		$criteria = new Criteria();
		$criteria->
			addDescendingOrderByColumn(BookmarkPeer::RATING)->
			addAscendingOrderByColumn(BookmarkPeer::ID);

		$this->Bookmarks = BookmarkPeer::doSelect($criteria);
		$this->setTemplate('index');
	}

	public function executeMy(sfWebRequest $request)
	{
		$user = $this->getUser();

		if (!$user->isAuthenticated()) $this->forward404();

		$criteria = new Criteria();
		$criteria->
			add(BookmarkPeer::USER_ID, $user->getGuardUser()->getId(), Criteria::EQUAL)->
			addAscendingOrderByColumn(BookmarkPeer::TITLE);

		$this->Bookmarks = BookmarkPeer::doSelect($criteria);
		$this->setTemplate('index');
	}

	public function executeShow(sfWebRequest $request)
	{
		$this->Bookmark = $this->getBookmarkById($request, false);
	}

	public function executeNew(sfWebRequest $request)
	{
		$this->form = new BookmarkForm();
	}

	public function executeCreate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST));

		$this->form = new BookmarkForm();

		$this->processForm($request, $this->form);

		$this->setTemplate('new');
	}

	public function executeEdit(sfWebRequest $request)
	{
		$this->form = new BookmarkForm($this->getBookmarkById($request));
	}

	public function executeUpdate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));

		$this->form = new BookmarkForm($this->getBookmarkById($request));

		$this->processForm($request, $this->form);

		$this->setTemplate('edit');
	}

	public function executeDelete(sfWebRequest $request)
	{
		$request->checkCSRFProtection();

		$this->getBookmarkById($request)->delete();

		$this->redirect('bookmarks/index');
	}


	protected function processForm(sfWebRequest $request, sfForm $form)
	{
		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		if ($form->isValid())
		{
			$Bookmark = $form->save();

			$this->redirect('bookmarks/edit?id='.$Bookmark->getId());
		}
	}

	protected function getBookmarkById($request, $is_msg = true)
	{
		$Bookmark = BookmarkPeer::retrieveByPk($request->getParameter('id'));

		$this->forward404Unless($Bookmark, $is_msg ? sprintf('Object Bookmark does not exist (%s).', $request->getParameter('id')) : null);

		return $Bookmark;
	}
}
