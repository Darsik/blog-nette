<?php

namespace App\Presenters;

use Nette,
    App\Forms\AddPostFormFactory,
    App\Model\UpdatePost,
    App\Model\PostsRepository;

class UpdatePostPresenter extends BasePresenter {

    /** @var AddPostFormFactory @inject */
    public $factory;

    /** @var UpdatePost @inject */
    public $update;

    /** @var PostsRepository @inject */
    public $postsRepo;

    public $id;

    public function actionUpdatePost($id)
    {
        $this->id = $id;
        $this->createComponentUpdatePostForm();
    }
    protected function createComponentUpdatePostForm()
    {

        $post = $this->postsRepo->getPost($this->id);
        $form = $this->factory->createComponentAddPost();
        $form->setDefaults(array(
            'title' => $post->title,
            'perex' => $post->perex,
            'text' => $post->text
        ));
        $form->onSuccess[] = function ($form) {
            $values = $form->getValues();
            $this->update->updatePost($values['title'], $values['text'], $values['perex'], $this->id);
            $this->redirect('Homepage:');
        };
        return $form;
    }
}