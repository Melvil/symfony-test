<?php

/**
 * Registration form.
 *
 * @package    bookmarks
 * @subpackage form
 * @author     Melvil
 */
class RegistrationForm extends sfGuardUserForm
{
	public function configure()
	{
		parent::configure();

		unset($this['vote_list']);

		$this->validatorSchema['password']->setOption('required', true);
	}
}
