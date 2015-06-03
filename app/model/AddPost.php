<?php

namespace App\Model;

use Nette,
    Nette\Database\Context;

class AddPost {

    /** @var Context */
    private $db;

    const
        TABLE = 'post',
        COLUMN_TEXT = 'text',
        CULUMN_TITLE = 'title',
        CULUMN_AUTHOR = 'author',
        COLUMN_PEREX = 'perex';



    public function __construct(Context $db) {
        $this->db = $db;
    }

    public function addPost($title, $text, $perex, $author)
    {
        $this->db->table(self::TABLE)->insert(array(
            self::COLUMN_TEXT => $text,
            self::COLUMN_PEREX => $perex,
            self::CULUMN_TITLE => $title,
            self::CULUMN_AUTHOR => $author
        ));
    }
}