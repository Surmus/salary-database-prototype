<?php

namespace App\Models;


use Tymon\JWTAuth\Contracts\JWTSubject;

class User implements JWTSubject
{
    /**
     * Usergroup id's user has access to
     *
     * @var int[]
     */
    protected $userGroups;

    /**
     * @return \int[]
     */
    public function getUserGroups(): array
    {
        return $this->userGroups;
    }

    /**
     * @param \int[] $userGroups
     * @return User
     */
    public function setUserGroups(array $userGroups): User
    {
        $this->userGroups = $userGroups;
        return $this;
    }

    public function getJWTIdentifier()
    {
        return $this->getUserGroups();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    function __get($name)
    {
        if ($name == 'id') {
            return $this->userGroups;
        }

        return null;
    }

    function __set($name, $value)
    {
        if ($name == 'id') {
            $this->userGroups = $value;
        }
    }
}