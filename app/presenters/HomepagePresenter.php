<?php

namespace App\Presenters;

use Nette,
	App\Model,
    App\Presenters,
    App\Forms;


/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{
    /** @var Forms\FilterFormFactory @inject */
    public $factory;

    /** @var Model\PostsRepository @inject */
    public $postsRepo;

    public function actionDefault()
    {
        $this->createComponentFilterForm();
    }

    public function createComponentFilterForm()
    {
        $form = $this->factory->createComponentFilter();
        $form->onSuccess[] = function ($form) {
            $values = $form->getValues();
            $this->postsRepo->getAuthorPosts($values['name']);
            $this->redirect('Homepage:');
        };
        return $form;
    }

	public function renderDefault()
	{
        $this->template->pos = $this->postsRepo->getAuthorPosts('root');
		$this->template->posts = $this->postsRepo->getPosts();
	}
}
