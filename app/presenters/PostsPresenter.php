<?php

namespace App\Presenters;

use App\Model;

/**
 * Post presenter.
 */
class PostsPresenter extends BasePresenter
{

    /** @var Model\PostsRepository @inject */
    public $postsRepo;

    public function renderPost($id)
    {
        $this->template->post = $this->postsRepo->getPost($id);
    }
}