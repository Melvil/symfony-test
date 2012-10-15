<?php

/**
 * Bookmark filter form base class.
 *
 * @package    bookmarks
 * @subpackage filter
 * @author     Melvil
 */
abstract class BaseBookmarkFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'                => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'title'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'info'                   => new sfWidgetFormFilterInput(),
      'url'                    => new sfWidgetFormFilterInput(),
      'rating'                 => new sfWidgetFormFilterInput(),
      'vote_good'              => new sfWidgetFormFilterInput(),
      'vote_bad'               => new sfWidgetFormFilterInput(),
      'created_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'bookmark_category_list' => new sfWidgetFormPropelChoice(array('model' => 'Category', 'add_empty' => true)),
      'vote_list'              => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'user_id'                => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'title'                  => new sfValidatorPass(array('required' => false)),
      'info'                   => new sfValidatorPass(array('required' => false)),
      'url'                    => new sfValidatorPass(array('required' => false)),
      'rating'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'vote_good'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'vote_bad'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'bookmark_category_list' => new sfValidatorPropelChoice(array('model' => 'Category', 'required' => false)),
      'vote_list'              => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('bookmark_filters[%s]');

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

    $criteria->addJoin(BookmarkCategoryPeer::BOOKMARK_ID, BookmarkPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(BookmarkCategoryPeer::CATEGORY_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(BookmarkCategoryPeer::CATEGORY_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function addVoteListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(VotePeer::BOOKMARK_ID, BookmarkPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(VotePeer::USER_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(VotePeer::USER_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Bookmark';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'user_id'                => 'ForeignKey',
      'title'                  => 'Text',
      'info'                   => 'Text',
      'url'                    => 'Text',
      'rating'                 => 'Number',
      'vote_good'              => 'Number',
      'vote_bad'               => 'Number',
      'created_at'             => 'Date',
      'updated_at'             => 'Date',
      'bookmark_category_list' => 'ManyKey',
      'vote_list'              => 'ManyKey',
    );
  }
}
