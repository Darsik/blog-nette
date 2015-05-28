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
}
