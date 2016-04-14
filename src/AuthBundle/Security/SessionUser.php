<?php

namespace AuthBundle\Security;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Store user in session
 */
class SessionUser implements UserInterface
{
    const ROLE_ADMIN = 'ROLE_ADMIN';

    /**
     * @var int
     */
    protected $userId;
    protected $userName;
    protected $userInfo;

    private $roles = array('ROLE_USER', 'ROLE_OAUTH_USER');

    /**
     * @param $userId
     * @param $userName
     * @param array $userInfo
     */
    public function __construct($userId, $userName, array $userInfo)
    {
        $this->userId = $userId;
        $this->userName = $userName;
        $this->userInfo = $userInfo;
    }

    /**
     * {@inheritDoc}
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * {@inheritDoc}
     */
    public function getPassword()
    {
        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        return $this->userId;
    }

    /**
     * {@inheritDoc}
     */
    public function eraseCredentials()
    {
        return true;
    }

    public function getUsername()
    {
        return $this->userName;
    }

    public function setIsAdmin()
    {
        if(in_array(self::ROLE_ADMIN, $this->roles)) {
            return;
        }
        $this->roles[] = self::ROLE_ADMIN;
    }

    public function isAdmin()
    {
        return in_array(self::ROLE_ADMIN, $this->roles);
    }
}
