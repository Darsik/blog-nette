<?php

namespace App\Presenters;

use Nette,
    App\Model\UserRegister,
    App\Model\UserAuthentificate,
    App\Forms\RegisterFormFactory;

class RegisterPresenter extends BasePresenter {

    /** @var RegisterFormFactory @inject */
    public $factory;

    /** @var UserAuthentificate @inject */
    public $auth;

    /** @var UserRegister @inject */
    public $register;

    public function actionRegister()
    {
        $this->createComponentRegisterForm();
    }
    protected function createComponentRegisterForm()
    {
        $this->getUser()->setAuthenticator($this->auth);
        $form = $this->factory->createComponentRegister();
        $form->onSuccess[] = function ($form) {
            $values = $form->getValues();
            if($this->register->isUserFree($values['username']))
            {
                $this->register->add($values['username'], $values['password'], $values['email']);
                $this->getUser()->login($values['username'], $values['password']);
                $this->getUser()->setExpiration('30 minutes', TRUE);
                $this->redirect('Homepage:');
            }
            else $form->addError('Uživatelské jméno už je zabrané, zvolte jiné');
        };
        return $form;
    }
}