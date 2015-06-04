<?php

namespace App\Presenters;

use Nette,
    App\Model\DeletePost;

class DeletePresenter extends BasePresenter {

    /** @var DeletePost @inject */
    public $delete;

    public function actionDelete($id)
    {
        $this->delete->deletePost($id);
        $this->redirect('Homepage:');
    }
}