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

    public $id;

    /**
     * @param $id
     */
    public function renderPost($id)
    {
        $this->template->post = $this->postsRepo->getPost($id);
        $this->template->coments = $this->postsRepo->getComments($id);
    }


    public function actionPost($id)
    {
        $this->id = $id;
        $this->createComponentAddKomentForm();
    }

    public function createComponentAddKomentForm()
    {
        $form = $this->factory->createComponentAddKoment();
        $form->onSuccess[] = function ($form) {
            $values = $form->getValues();
            $this->addKom->addKoment($values['text'], $this->getUser()->getIdentity()->username, $this->id);
            $this->redirect('Posts:post',$this->id);
        };
        return $form;
    }
}