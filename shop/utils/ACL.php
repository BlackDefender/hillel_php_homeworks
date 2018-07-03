<?php

class ACL
{
    private $route;
    private $pattern = '/^\/admin/';

    public function __construct($route)
    {
        $this->route = $route;
    }

    public function check()
    {
        $user = UsersRepo::getCurrentUser();

        if ($this->isPublic()) {
            return;
        }

        if (empty($user)) {
            FlashMessages::addMessage('To access to admin pannel you should be logged in.', FlashMessages::MESSAGE_TYPE_ERROR);
            BaseController::setHttpStatus(401);
            BaseController::redirect('user/login');
        }

        if ($user->isAdmin()) {
            return;
        }

        FlashMessages::addMessage('You do not have permission to access to admin panel.', FlashMessages::MESSAGE_TYPE_ERROR);
        BaseController::setHttpStatus(401);
        BaseController::redirect('/');
    }

    private function isPublic()
    {
        return !preg_match($this->pattern, $this->route);
    }
}