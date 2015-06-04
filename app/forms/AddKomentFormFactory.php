<?php

namespace App\Forms;

use Nette,
    Nette\Application\UI\Form;


class AddKomentFormFactory extends Nette\Object
{
    /**
     * @return Form
     */
    public function createComponentAddKoment()
    {
        $form = new Form;
        $form->addTextArea('text', 'Text:')
            ->setRequired('Prosím, zadejte komentář.');

        $form->addSubmit('send', 'Odeslat');

        return $form;
    }
}