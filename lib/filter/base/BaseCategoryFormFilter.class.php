<?php

/**
 * Category filter form base class.
 *
 * @package    bookmarks
 * @subpackage filter
 * @author     Melvil
 */
abstract class BaseCategoryFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'created_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'bookmark_category_list' => new sfWidgetFormPropelChoice(array('model' => 'Bookmark', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'created_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'bookmark_category_list' => new sfValidatorPropelChoice(array('model' => 'Bookmark', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('category_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addBookmarkCategoryListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(BookmarkCategoryPeer::CATEGORY_ID, CategoryPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(BookmarkCategoryPeer::BOOKMARK_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(BookmarkCategoryPeer::BOOKMARK_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Category';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'created_at'             => 'Date',
      'updated_at'             => 'Date',
      'bookmark_category_list' => 'ManyKey',
    );
  }
}
