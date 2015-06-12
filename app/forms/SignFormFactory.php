<?php

namespace App\Forms;

use Nette,
	Nette\Application\UI\Form,
	Nette\Security\User,
    App\Model\UserAuthentificate;


class SignFormFactory extends Nette\Object
{
    /** @var UserAuthentificate @inject */
	public $user;


	public function __construct(UserAuthentificate $user)
	{
		$this->user = $user;
	}


	/**
	 * @return Form
	 */
	public function createComponentLogin()
	{
		$form = new Form;
		$form->addText('username', 'Jméno:')
			->setRequired('Prosím, zadejte vaše uživatelské jméno.');

		$form->addPassword('password', 'Heslo:')
			->setRequired('Prosím, zadejte vaše uživatelské heslo.');

		$form->addSubmit('send', 'Přihlásit');

		$form->onSuccess[] = array($this, 'formSucceeded');
		return $form;
	}


	public function formSucceeded($form, $values)
	{
		try {
			$this->user->authenticate(array($values->username, $values->password));
		} catch (Nette\Security\AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}

}
