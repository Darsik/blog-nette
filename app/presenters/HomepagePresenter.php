<?php

namespace App\Presenters;

use Nette,
	App\Model,
    App\Presenters;


/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{

    /** @var Model\PostsRepository @inject */
    public $postsRepo;


	public function renderDefault()
	{
        //$this->getUser()->logout();
		$this->template->posts = $this->postsRepo->getPosts();
	}
}
