<?php

namespace App\Presenters;

use Nette,
    App\Model\AddPost,
    App\Forms\AddPostFormFactory;

class AddPostPresenter extends BasePresenter {

    /** @var AddPostFormFactory @inject */
    public $factory;

    /** @var AddPost @inject */
    public $add;

    public function actionAddPost()
    {
        $this->createComponentAddPostForm();
    }
    protected function createComponentAddPostForm()
    {
        $form = $this->factory->createComponentAddPost();
        $form->onSuccess[] = function ($form) {
            $values = $form->getValues();
            $this->add->addPost($values['title'], $values['text'], $values['perex'], $this->getUser()->getIdentity()->username);
            $form->getPresenter()->redirect('Homepage:');
        };
        return $form;
    }
}