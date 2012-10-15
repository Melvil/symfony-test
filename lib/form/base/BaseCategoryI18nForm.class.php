<?php

/**
 * CategoryI18n form base class.
 *
 * @method CategoryI18n getObject() Returns the current form's model object
 *
 * @package    bookmarks
 * @subpackage form
 * @author     Melvil
 */
abstract class BaseCategoryI18nForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'      => new sfWidgetFormInputHidden(),
      'culture' => new sfWidgetFormInputHidden(),
      'title'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'      => new sfValidatorPropelChoice(array('model' => 'Category', 'column' => 'id', 'required' => false)),
      'culture' => new sfValidatorChoice(array('choices' => array($this->getObject()->getCulture()), 'empty_value' => $this->getObject()->getCulture(), 'required' => false)),
      'title'   => new sfValidatorString(array('max_length' => 255)),
    ));

    $this->widgetSchema->setNameFormat('category_i18n[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CategoryI18n';
  }


}
