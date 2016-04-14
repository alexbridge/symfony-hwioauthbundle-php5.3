<?php
namespace AuthBundle\Security;

use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthAwareUserProviderInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Session user provider
 */
class SessionUserProvider implements UserProviderInterface, OAuthAwareUserProviderInterface
{
    private $eventDispatcher;

    function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * {@inheritDoc}
     */
    public function loadUserByUsername($username)
    {
        throw new UnsupportedUserException(sprintf('Unsupported method ["%s"]', $username));
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        $userName = $response->getNickname();
        if(empty($userName)) {
            $userName = $response->getFirstName() . ' ' . $response->getLastName();
        }
        $user = new SessionUser($response->getUsername(), $userName, $response->getResponse());
        $this->eventDispatcher->dispatch('auth.connect.response', new GenericEvent($user, array('response' => $response)));
        return $user;
    }

    /**
     * {@inheritDoc}
     */
    public function refreshUser(UserInterface $user)
    {
        if (!$this->supportsClass($user)) {
            throw new UnsupportedUserException(sprintf('Unsupported user class "%s"', get_class($user)));
        }

        return $user;
    }

    /**
     * {@inheritDoc}
     */
    public function supportsClass($class)
    {
        return $class instanceof SessionUser;
    }
}
