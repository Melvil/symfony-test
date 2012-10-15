<?php

/**
 * BookmarkCategory filter form base class.
 *
 * @package    bookmarks
 * @subpackage filter
 * @author     Melvil
 */
abstract class BaseBookmarkCategoryFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
    ));

    $this->setValidators(array(
    ));

    $this->widgetSchema->setNameFormat('bookmark_category_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BookmarkCategory';
  }

  public function getFields()
  {
    return array(
      'bookmark_id' => 'ForeignKey',
      'category_id' => 'ForeignKey',
    );
  }
}
