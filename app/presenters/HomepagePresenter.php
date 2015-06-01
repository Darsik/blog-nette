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
	/** @var Nette\Database\Context @inject */
	public $database;

    /** @var Model\PostsRepository @inject */
    public $postsRepo;

    /** @var Nette\Security\User @inject */
	public $user;


	public function renderDefault()
	{
        dump($this->user->getIdentity());
        //$this->user->add('root2','root');
        //$us = $this->user->authenticate(array('root', 'root'));
        //asdfasdfs
	    //$password = 'root' . 't&#ssdf54gh';
	    //dump($us);
           // dump($this->postsRepo->getPosts());
		$this->template->posts = $this->postsRepo->getPosts();
	}
}
