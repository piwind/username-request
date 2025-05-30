<?php

/*
 * This file is part of username-request.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Piwind\UserRequest\Notification;

use Flarum\Notification\Blueprint\BlueprintInterface;
use Flarum\Notification\MailableInterface;

class RequestApprovedBlueprint extends BaseRequestActionedBlueprint implements BlueprintInterface, MailableInterface
{
    /**
     * Get the serialized type of this activity.
     *
     * @return string
     */
    public static function getType()
    {
        return 'usernameRequestApproved';
    }

    /**
     * Get the name of the view to construct a notification email with.
     *
     * @return array<string, string>
     */
    public function getEmailView()
    {
        return ['text' => 'piwind-username-request::emails.usernameRequestApproved'];
    }
}
