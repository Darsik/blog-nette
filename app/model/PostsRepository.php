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
    
    const TABLE = 'post',
            TABLE_COM = 'comment';


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

    public function getAuthorPosts($autor)
    {
        $query = $this->db->table(self::TABLE)->select('*')->where('author',$autor);
        return $query->fetchAll();
    }
    public function getComments($id)
    {
        $query = $this->db->table(self::TABLE_COM)->select('*')->where('id_post', $id);
        return $query->fetchAll();
    }
}
