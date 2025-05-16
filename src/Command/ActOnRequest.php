<?php

/*
 * This file is part of username-request.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Piwind\UserRequest\Command;

use Flarum\User\User;

class ActOnRequest
{
    /**
     * The ID of the request.
     *
     * @var int
     */
    public $requestId;

    /**
     * The user performing the action.
     *
     * @var User
     */
    public $actor;

    /**
     * The attributes of the new flag.
     *
     * @var array
     */
    public $data;

    /**
     * ActOnRequest constructor.
     *
     * @param       $requestId
     * @param User  $actor
     * @param array $data
     */
    public function __construct($requestId, User $actor, array $data)
    {
        $this->requestId = $requestId;
        $this->actor = $actor;
        $this->data = $data;
    }
}
