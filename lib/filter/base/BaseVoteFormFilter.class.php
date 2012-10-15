<?php

/**
 * Vote filter form base class.
 *
 * @package    bookmarks
 * @subpackage filter
 * @author     Melvil
 */
abstract class BaseVoteFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'vote'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'vote'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('vote_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Vote';
  }

  public function getFields()
  {
    return array(
      'user_id'     => 'ForeignKey',
      'bookmark_id' => 'ForeignKey',
      'vote'        => 'Boolean',
    );
  }
}
