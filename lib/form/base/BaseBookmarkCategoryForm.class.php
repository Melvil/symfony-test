<?php

/**
 * BookmarkCategory form base class.
 *
 * @method BookmarkCategory getObject() Returns the current form's model object
 *
 * @package    bookmarks
 * @subpackage form
 * @author     Melvil
 */
abstract class BaseBookmarkCategoryForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'bookmark_id' => new sfWidgetFormInputHidden(),
      'category_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'bookmark_id' => new sfValidatorPropelChoice(array('model' => 'Bookmark', 'column' => 'id', 'required' => false)),
      'category_id' => new sfValidatorPropelChoice(array('model' => 'Category', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('bookmark_category[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BookmarkCategory';
  }


}
