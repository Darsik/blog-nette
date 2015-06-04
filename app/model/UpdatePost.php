<?php

namespace App\Model;

use Nette,
    Nette\Database\Context;

class UpdatePost {

    /** @var Context */
    private $db;

    const
        TABLE = 'post',
        COLUMN_TEXT = 'text',
        CULUMN_TITLE = 'title',
        CULUMN_ID = 'id',
        COLUMN_PEREX = 'perex';


    public function __construct(Context $db) {
        $this->db = $db;
    }

    public function updatePost($title, $text, $perex, $id)
    {
        $this->db->table(self::TABLE)->where(self::CULUMN_ID, $id)
            ->update(array(
            self::COLUMN_TEXT => $text,
            self::COLUMN_PEREX => $perex,
            self::CULUMN_TITLE => $title,
        ));
    }
}