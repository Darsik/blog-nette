<?php

namespace App\Forms;

use Nette,
    Nette\Application\UI\Form;


class AddPostFormFactory extends Nette\Object
{
    /**
     * @return Form
     */
    public function createComponentAddPost()
    {
        $form = new Form;
        $form->addText('title', 'Titulek:')
            ->setRequired('Prosím, zadejte titulek.');

        $form->addTextArea('perex', 'Perex:')
            ->setRequired('Prosím, zadejte perex.');

        $form->addTextArea('text', 'Text:')
            ->setRequired('Prosím, zadejte text');

        $form->addSubmit('send', 'Odeslat');

        return $form;
    }
}