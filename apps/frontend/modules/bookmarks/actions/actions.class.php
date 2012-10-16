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

		$this->bookmarksSelect($request, $criteria);
	}

	public function executeRating(sfWebRequest $request)
	{
		$criteria = new Criteria();
		$criteria->
			addDescendingOrderByColumn(BookmarkPeer::RATING)->
			addAscendingOrderByColumn(BookmarkPeer::ID);

		$this->bookmarksSelect($request, $criteria);
	}

	public function executeMy(sfWebRequest $request)
	{
		$user = $this->getUser();

		if (!$user->isAuthenticated()) $this->forward404();

		$criteria = new Criteria();
		$criteria->
			add(BookmarkPeer::USER_ID, $user->getGuardUser()->getId(), Criteria::EQUAL)->
			addAscendingOrderByColumn(BookmarkPeer::TITLE);

		$this->bookmarksSelect($request, $criteria);
	}

	public function executeShow(sfWebRequest $request)
	{
		$this->Bookmark = $this->getBookmarkById($request, false);
	}

	public function executeNew(sfWebRequest $request)
	{
		if (!$this->getUser()->isAuthenticated()) $this->forward404();

		$this->form = new BookmarkUserForm();
	}

	public function executeCreate(sfWebRequest $request)
	{
		if (!$this->getUser()->isAuthenticated()) $this->forward404();

		$this->forward404Unless($request->isMethod(sfRequest::POST));

		$this->form = new BookmarkUserForm();

		$this->processForm($request, $this->form);

		$this->setTemplate('new');
	}

	public function executeEdit(sfWebRequest $request)
	{
		$this->form = new BookmarkUserForm($this->getBookmarkByIdMy($request));
	}

	public function executeUpdate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));

		$this->form = new BookmarkUserForm($this->getBookmarkByIdMy($request));

		$this->processForm($request, $this->form);

		$this->setTemplate('edit');
	}

	public function executeDelete(sfWebRequest $request)
	{
		$request->checkCSRFProtection();

		$this->getBookmarkByIdMy($request)->delete();

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

	protected function getBookmarkByIdMy($request)
	{
		if ($this->getUser()->isAuthenticated())
		{
			$Bookmark = BookmarkPeer::retrieveByPk($request->getParameter('id'));

			$this->forward404Unless($Bookmark, sprintf('Object Bookmark does not exist (%s).', $request->getParameter('id')));

			if ($Bookmark->getUserId() !== $this->getUser()->getGuardUser()->getId())
				$this->forward404('Access denied');
		}
		else
			$this->forward404('Access denied');

		return $Bookmark;
	}

	protected function bookmarksSelect($request, $criteria)
	{
		$this->Category = CategoryPeer::retrieveByPk($request->getParameter('category'));

		if ($this->Category)
			$criteria->
				addJoin(BookmarkPeer::ID, BookmarkCategoryPeer::BOOKMARK_ID, Criteria::INNER_JOIN)->
				add(BookmarkCategoryPeer::CATEGORY_ID, $this->Category->getId(), Criteria::EQUAL);

		$this->Bookmarks = BookmarkPeer::doSelectWithSearch($request->getParameter('search'), $criteria);

		$this->setTemplate('index');
	}
}
