<?php

namespace App\Presenters;

use Nette,
	App\Forms\SignFormFactory,
    App\Model\UserAuthentificate;


/**
 * Sign in/out presenters.
 */
class SignPresenter extends BasePresenter
{
	/** @var SignFormFactory @inject */
	public $factory;

    /** @var UserAuthentificate @inject */
    public $auth;



    public function actionIn()
    {
        $this->createComponentSignInForm();
    }
    /**
     * Sign-in form factory.
     * @return Nette\Application\UI\Form
     */
	protected function createComponentSignInForm()
	{
        $this->getUser()->setAuthenticator($this->auth);
		$form = $this->factory->createComponentLogin();
		$form->onSuccess[] = function ($form) {
            $values = $form->getValues();
            $this->getUser()->login($values['username'], $values['password']);
            $this->getUser()->setExpiration('30 minutes', TRUE);
			$form->getPresenter()->redirect('Homepage:');
		};
		return $form;
	}

	public function actionOut()
	{
		$this->getUser()->logout();
		$this->redirect('Homepage:');
	}
}
