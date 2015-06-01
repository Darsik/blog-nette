<?php

namespace App\Model;

use Nette,
    Nette\Security as NS,
    Nette\Database\Context,
    Nette\Utils\Strings,
	Nette\Security\Passwords;

/**
 * Description of UserAuthentificate
 *
 * @author Daniel
 */
class UserAuthentificate extends Nette\Object implements NS\IAuthenticator {

    const
        TABLE_NAME = 'user',
        COLUMN_ID = 'id',
        COLUMN_LOGIN = 'username',
        COLUMN_NAME = 'username',
        COLUMN_PASSWORD_HASH = 'password',
        COLUMN_ROLE = 'role';


    /** @var Context */
    private $database;


    public function __construct(Context $database)
    {
        $this->database = $database;
    }


    /**
     * Performs an authentication.
     * @return Nette\Security\Identity
     * @throws Nette\Security\AuthenticationException
     */
    public function authenticate(array $credentials)
    {
        list($username, $password) = $credentials;

        $row = $this->database->table(self::TABLE_NAME)->where(self::COLUMN_LOGIN, $username)->fetch();

        if (!$row) {
            throw new Nette\Security\AuthenticationException('Uživatel neexistuje. (napsali jste jej správně?)', self::IDENTITY_NOT_FOUND);

        } elseif (!Passwords::verify($password, $row[self::COLUMN_PASSWORD_HASH])) {
            throw new Nette\Security\AuthenticationException('Chybně zadané heslo.', self::INVALID_CREDENTIAL);

        } elseif (Passwords::needsRehash($row[self::COLUMN_PASSWORD_HASH])) {
            $row->update(array(
                self::COLUMN_PASSWORD_HASH => Passwords::hash($password),
            ));
        }

        $arr = $row->toArray();
        unset($arr[self::COLUMN_PASSWORD_HASH]);
        return new Nette\Security\Identity($row[self::COLUMN_ID], $row[self::COLUMN_ROLE], $arr);
    }


    /**
     * Adds new user.
     * @param  string
     * @param  string
     * @return void
     */
    public function add($username, $password)
    {
        $this->database->table(self::TABLE_NAME)->insert(array(
            self::COLUMN_NAME => $username,
            self::COLUMN_PASSWORD_HASH => Passwords::hash($password),
            self::COLUMN_ROLE => '1'
        ));
    }
}
