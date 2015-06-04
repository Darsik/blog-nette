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

    protected $id;

    public function actionUpdatePost()
    {
        $this->createComponentUpdatePostForm();
    }
    protected function createComponentUpdatePostForm()
    {
        $this->id = $this->getParam('id');
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
            $form->getPresenter()->redirect('Homepage:');
        };
        return $form;
    }
}