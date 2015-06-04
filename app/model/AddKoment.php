<?php

namespace App\Model;

use Nette,
    Nette\Database\Context;

class AddKoment {

    /** @var Context */
    private $db;

    const
        TABLE = 'comment',
        COLUMN_ID = 'id_post',
        COLUMN_TEXT = 'text',
        CULUMN_NAME = 'name';



    public function __construct(Context $db) {
        $this->db = $db;
    }

    public function addKoment($text, $name, $id)
    {
        $this->db->table(self::TABLE)->insert(array(
            self::COLUMN_TEXT => $text,
            self::CULUMN_NAME => $name,
            self::COLUMN_ID => $id
        ));
    }
}