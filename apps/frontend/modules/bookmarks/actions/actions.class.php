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
    $this->Bookmarks = BookmarkPeer::doSelect(new Criteria());
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->Bookmark = BookmarkPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->Bookmark);
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
    $this->forward404Unless($Bookmark = BookmarkPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Bookmark does not exist (%s).', $request->getParameter('id')));
    $this->form = new BookmarkForm($Bookmark);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($Bookmark = BookmarkPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Bookmark does not exist (%s).', $request->getParameter('id')));
    $this->form = new BookmarkForm($Bookmark);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($Bookmark = BookmarkPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Bookmark does not exist (%s).', $request->getParameter('id')));
    $Bookmark->delete();

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
}
