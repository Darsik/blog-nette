<?php

namespace App\Model;

use Nette;
use Nette\Database\Context;

/**
 * Description of PostsRepository
 *
 * @author Daniel
 */
class PostsRepository {
    
    /** @var Context */
    private $db;
    
    const TABLE = 'post';


    public function __construct(Context $db) {
        $this->db = $db;
    }
    
    public function getPosts() {
        $query = $this->db->table(self::TABLE)->select('*');
        return $query->fetchAll();
    }

    public function getPost($id)
    {
        $query = $this->db->table(self::TABLE)->select('*')->where('id', $id);
        return $query->fetch();
    }
}
