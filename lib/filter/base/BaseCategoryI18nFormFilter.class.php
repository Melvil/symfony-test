<?php

/**
 * CategoryI18n filter form base class.
 *
 * @package    bookmarks
 * @subpackage filter
 * @author     Melvil
 */
abstract class BaseCategoryI18nFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'title'   => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('category_i18n_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CategoryI18n';
  }

  public function getFields()
  {
    return array(
      'id'      => 'ForeignKey',
      'culture' => 'Text',
      'title'   => 'Text',
    );
  }
}
