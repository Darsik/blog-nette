<?php

namespace App\Model;

use Nette,
    Nette\Database\Context;

class DeletePost {

    /** @var Context */
    private $db;

    const
        TABLE = 'post',
        COLUMN_ID = 'id';

    public function __construct(Context $db) {
        $this->db = $db;
    }

    public function deletePost($id)
    {
        $this->db->table(self::TABLE)->where(self::COLUMN_ID, $id)->delete();
    }
}