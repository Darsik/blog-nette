<?php

namespace App\Model;

use Nette,
    Nette\Database\Context;

class DeleteComment {

    /** @var Context */
    private $db;

    const
        TABLE = 'comment',
        COLUMN_ID = 'id';

    public function __construct(Context $db) {
        $this->db = $db;
    }

    public function deleteComment($id)
    {
        $this->db->table(self::TABLE)->where(self::COLUMN_ID, $id)->delete();
    }
}