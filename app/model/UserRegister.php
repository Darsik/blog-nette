<?php

namespace App\Model;

use Nette,
    Nette\Database\Context,
    Nette\Security\Passwords;

class UserRegister extends Nette\Object
{

    const
        TABLE_NAME = 'user',
        COLUMN_ID = 'id',
        COLUMN_LOGIN = 'username',
        COLUMN_NAME = 'username',
        COLUMN_PASSWORD_HASH = 'password',
        COLUMN_ROLE = 'role',
        COLUMN_EMAIL = 'email';


    /** @var Context */
    private $database;


    public function __construct(Context $database)
    {
        $this->database = $database;
    }

    /**
     * Adds new user.
     * @param  string
     * @param  string
     * @return void
     */
    public function add($username, $password, $email)
    {
        $this->database->table(self::TABLE_NAME)->insert(array(
            self::COLUMN_NAME => $username,
            self::COLUMN_PASSWORD_HASH => Passwords::hash($password),
            self::COLUMN_ROLE => '1',
            self::COLUMN_EMAIL => $email
        ));
    }
    public function isUserFree($username)
    {
        $userIsFree = $this->database->table(self::TABLE_NAME)->select('username')->where('username', $username)->fetch();
        if (!$userIsFree) {
            return true;
        }
        else return false;
    }
}