<?php

namespace App\Adapter;


use App\Models\User;
use App\Services\AuthLoggerInterface;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Contracts\Providers\Auth;

class JwtAuthAdapter implements Auth
{
    /**
     * User group id's which have access to this App
     *
     * @var int[]
     */
    protected $authGroups;

    /** @var User */
    protected $user;

    /** @var AuthLoggerInterface */
    protected $logger;

    /** @var Request */
    protected $request;

    /**
     * JwtAuthAdapter constructor.
     *
     * @param Repository $repository
     * @param AuthLoggerInterface $logger
     * @param Request $request
     */
    public function __construct(Repository $repository, AuthLoggerInterface $logger, Request $request)
    {
        $this->authGroups = $repository->get('auth.authorizedGroups', []);
        $this->request = $request;
        $this->logger = $logger;
    }

    public function byCredentials(array $credentials = [])
    {
        // Not supported
        return false;
    }

    /**
     * User is identified by groups it belongs to
     *
     * @param int[] $id array of usergroup id's user belongs to
     * @return bool
     */
    public function byId($id)
    {
        if (! is_array($id)) {
            $this->logFailedAuthRequest($id);

            return false;
        }

        foreach ($id as $userGroup) {
            if (in_array($userGroup, $this->authGroups)) {
                $this->user = (new User())->setUserGroups($id);

                return true;
            }
        }

        $this->logFailedAuthRequest($id);

        return false;
    }

    public function user()
    {
        return $this->user;
    }

    protected function logFailedAuthRequest($userId)
    {
        $this->logger->warning(
            sprintf(
                'Unauthorized connection attempt :: %s :: Request -> %s :: With user %s',
                $this->request->getClientIp(),
                $this->request->getRequestUri(),
                print_r($userId, 1)
            )
        );
    }
}