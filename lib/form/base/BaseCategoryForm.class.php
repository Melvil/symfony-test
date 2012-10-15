<?php

/**
 * Category form base class.
 *
 * @method Category getObject() Returns the current form's model object
 *
 * @package    bookmarks
 * @subpackage form
 * @author     Melvil
 */
abstract class BaseCategoryForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'created_at'             => new sfWidgetFormDateTime(),
      'updated_at'             => new sfWidgetFormDateTime(),
      'bookmark_category_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Bookmark')),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'created_at'             => new sfValidatorDateTime(array('required' => false)),
      'updated_at'             => new sfValidatorDateTime(array('required' => false)),
      'bookmark_category_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Bookmark', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('category[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Category';
  }

  public function getI18nModelName()
  {
    return 'CategoryI18n';
  }

  public function getI18nFormClass()
  {
    return 'CategoryI18nForm';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['bookmark_category_list']))
    {
      $values = array();
      foreach ($this->object->getBookmarkCategorys() as $obj)
      {
        $values[] = $obj->getBookmarkId();
      }

      $this->setDefault('bookmark_category_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveBookmarkCategoryList($con);
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
    $c->add(BookmarkCategoryPeer::CATEGORY_ID, $this->object->getPrimaryKey());
    BookmarkCategoryPeer::doDelete($c, $con);

    $values = $this->getValue('bookmark_category_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new BookmarkCategory();
        $obj->setCategoryId($this->object->getPrimaryKey());
        $obj->setBookmarkId($value);
        $obj->save();
      }
    }
  }

}
