<?php

namespace App\Forms;

use Nette,
    Nette\Application\UI\Form;


class RegisterFormFactory extends Nette\Object
{
    /**
     * @return Form
     */
    public function createComponentRegister()
    {
        $form = new Form;
        $form->addText('username', 'Jméno:')
            ->setRequired('Prosím, zadejte vaše uživatelské jméno.');

        $form->addPassword('password', 'Heslo:')
            ->setRequired('Prosím, zadejte vaše uživatelské heslo.');

        $form->addText('email', 'Email:')
            ->setRequired('Prosím, zadejte váš email')
            ->setType('email');

        $form->addSubmit('send', 'Přihlásit');

        return $form;
    }
}
