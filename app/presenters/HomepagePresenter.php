<?php

namespace App\Presenters;

use Nette,
	App\Model;


/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{
	/** @var Nette\Database\Context @inject */
	public $database;

    /** @var Model\PostsRepository @inject */
    public $postsRepo;

	/** @var Model\UserAuthentificate @inject */
	public $user;

	public function renderDefault()
	{
        
        //asdfasdfs
	    //$password = 'root' . 't&#ssdf54gh';
	    //$us = $this->user->authenticate(array('root', sha1($password)));
	    //dump($us);
           // dump($this->postsRepo->getPosts());
		$this->template->posts = $this->postsRepo->getPosts();
	}
}
