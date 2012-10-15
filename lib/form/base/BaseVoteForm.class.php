<?php

/**
 * Vote form base class.
 *
 * @method Vote getObject() Returns the current form's model object
 *
 * @package    bookmarks
 * @subpackage form
 * @author     Melvil
 */
abstract class BaseVoteForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'     => new sfWidgetFormInputHidden(),
      'bookmark_id' => new sfWidgetFormInputHidden(),
      'vote'        => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'user_id'     => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id', 'required' => false)),
      'bookmark_id' => new sfValidatorPropelChoice(array('model' => 'Bookmark', 'column' => 'id', 'required' => false)),
      'vote'        => new sfValidatorBoolean(),
    ));

    $this->widgetSchema->setNameFormat('vote[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Vote';
  }


}
