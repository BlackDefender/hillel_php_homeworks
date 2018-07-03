<?php

class User
{
    const ROLE_CUSTOMER = 0;
    const ROLE_ADMIN = 1;

    const REGISTRATION_TYPE_MANUAL = 0;
    const REGISTRATION_TYPE_AUTO = 1;

    private $role;

    public function isAdmin()
    {
        return $this->role == self::ROLE_ADMIN;
    }
}