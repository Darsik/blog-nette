<?php

namespace App\Model;

use Nette,
    Nette\Database\Context;

class DeletePost {

    /** @var Context */
    private $db;

    const
        TABLE = 'post',
        TABLE_COM = 'comment',
        COLUMN_ID = 'id',
        COLUMN_ID_POST = 'id_post';

    public function __construct(Context $db) {
        $this->db = $db;
    }

    public function deletePost($id)
    {
        $this->db->table(self::TABLE_COM)->where(self::COLUMN_ID_POST, $id)->delete();
        $this->db->table(self::TABLE)->where(self::COLUMN_ID, $id)->delete();
    }
}