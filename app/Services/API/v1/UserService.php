<?php

namespace App\Services\API\v1;

use App\Repositories\API\v1\UserRepository;
use App\Services\Service;

class UserService extends Service
{
    public function __construct(UserRepository $userRepository)
    {
        parent::__construct($userRepository);
    }
}
