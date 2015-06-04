<?php

namespace App\Presenters;

use App\Model,
    App\Model\AddKoment,
    App\Forms\AddKomentFormFactory;

/**
 * Post presenter.
 */
class PostsPresenter extends BasePresenter
{

    /** @var AddKomentFormFactory @inject */
    public $factory;

    /** @var AddKoment @inject */
    public $addKom;

    /** @var Model\PostsRepository @inject */
    public $postsRepo;

    public function renderPost($id)
    {
        $this->template->post = $this->postsRepo->getPost($id);
        $this->template->komentForm = $this->createComponentAddKomentForm();
    }


    public function actionAddKoment()
    {
        $this->createComponentAddKomentForm();
    }

    public function createComponentAddKomentForm()
    {
        $form = $this->factory->createComponentAddKoment();
        $form->onSuccess[] = function ($form) {
            $values = $form->getValues();
            $this->addKom->addKoment($values['text'], $this->getUser()->getIdentity()->username, $this->getParam('id'));
            $form->getPresenter()->redirect('Posts:post');
        };
        return $form;
    }
}