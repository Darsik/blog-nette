<?php

namespace App\Forms;

use Nette,
    Nette\Application\UI\Form;


class FilterFormFactory extends Nette\Object
{
    /**
     * @return Form
     */
    public function createComponentFilter()
    {
        $form = new Form;
        $form->addText('filter', 'Jméno autora:')
            ->setRequired('Prosím, zadejte jméno autora, kterého hledáte.');

        $form->addSubmit('send', 'Vyhledat');

        return $form;
    }
}
