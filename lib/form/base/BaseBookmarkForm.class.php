<?php

/**
 * Bookmark form base class.
 *
 * @method Bookmark getObject() Returns the current form's model object
 *
 * @package    bookmarks
 * @subpackage form
 * @author     Melvil
 */
abstract class BaseBookmarkForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'user_id'                => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'title'                  => new sfWidgetFormInputText(),
      'info'                   => new sfWidgetFormTextarea(),
      'url'                    => new sfWidgetFormInputText(),
      'rating'                 => new sfWidgetFormInputText(),
      'vote_good'              => new sfWidgetFormInputText(),
      'vote_bad'               => new sfWidgetFormInputText(),
      'created_at'             => new sfWidgetFormDateTime(),
      'updated_at'             => new sfWidgetFormDateTime(),
      'bookmark_category_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Category')),
      'vote_list'              => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'sfGuardUser')),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'user_id'                => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id', 'required' => false)),
      'title'                  => new sfValidatorString(array('max_length' => 255)),
      'info'                   => new sfValidatorString(array('required' => false)),
      'url'                    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'rating'                 => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'vote_good'              => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'vote_bad'               => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at'             => new sfValidatorDateTime(array('required' => false)),
      'updated_at'             => new sfValidatorDateTime(array('required' => false)),
      'bookmark_category_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Category', 'required' => false)),
      'vote_list'              => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'sfGuardUser', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('bookmark[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Bookmark';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['bookmark_category_list']))
    {
      $values = array();
      foreach ($this->object->getBookmarkCategorys() as $obj)
      {
        $values[] = $obj->getCategoryId();
      }

      $this->setDefault('bookmark_category_list', $values);
    }

    if (isset($this->widgetSchema['vote_list']))
    {
      $values = array();
      foreach ($this->object->getVotes() as $obj)
      {
        $values[] = $obj->getUserId();
      }

      $this->setDefault('vote_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveBookmarkCategoryList($con);
    $this->saveVoteList($con);
  }

  public function saveBookmarkCategoryList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['bookmark_category_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(BookmarkCategoryPeer::BOOKMARK_ID, $this->object->getPrimaryKey());
    BookmarkCategoryPeer::doDelete($c, $con);

    $values = $this->getValue('bookmark_category_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new BookmarkCategory();
        $obj->setBookmarkId($this->object->getPrimaryKey());
        $obj->setCategoryId($value);
        $obj->save();
      }
    }
  }

  public function saveVoteList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['vote_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(VotePeer::BOOKMARK_ID, $this->object->getPrimaryKey());
    VotePeer::doDelete($c, $con);

    $values = $this->getValue('vote_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new Vote();
        $obj->setBookmarkId($this->object->getPrimaryKey());
        $obj->setUserId($value);
        $obj->save();
      }
    }
  }

}
