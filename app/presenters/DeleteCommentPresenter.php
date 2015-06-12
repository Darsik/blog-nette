<?php

namespace App\Presenters;

use Nette,
    App\Model\DeleteComment;

class DeleteCommentPresenter extends BasePresenter {

    /** @var DeleteComment @inject */
    public $delete;

    /**
     * @param $id
     * @param $id_post
     */
    public function actionDeleteComment($id, $id_post)
    {
        $this->delete->deleteComment($id);
        $this->redirect('Posts:post', $id_post);
    }
}