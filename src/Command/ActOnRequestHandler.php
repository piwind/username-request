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

use Flarum\Notification\NotificationSyncer;
use Flarum\User\Event\Renamed;
use Flarum\User\UserRepository;
use Flarum\User\UserValidator;
use Piwind\UserRequest\Notification\RequestApprovedBlueprint;
use Piwind\UserRequest\Notification\RequestRejectedBlueprint;
use Piwind\UserRequest\Notification\NicknameRequestApprovedBlueprint;
use Piwind\UserRequest\Notification\NicknameRequestRejectedBlueprint;
use Piwind\UserRequest\UsernameRequest;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Str;

class ActOnRequestHandler
{
    /**
     * @var UserValidator
     */
    protected $validator;

    /**
     * @var UserRepository
     */
    protected $users;

    /**
     * @var NotificationSyncer
     */
    protected $notificatons;

    /**
     * @var Dispatcher
     */
    protected $events;

    /**
     * CreateRequestHandler constructor.
     *
     * @param UserValidator $validator
     */
    public function __construct(UserValidator $validator, UserRepository $users, NotificationSyncer $notifications, Dispatcher $events)
    {
        $this->validator = $validator;
        $this->users = $users;
        $this->notificatons = $notifications;
        $this->events = $events;
    }

    /**
     * @param ActOnRequest $command
     *
     * @throws \Flarum\User\Exception\PermissionDeniedException
     * @throws \Illuminate\Validation\ValidationException
     *
     * @return mixed
     */
    public function handle(ActOnRequest $command)
    {
        $actor = $command->actor;
        $data = $command->data;

        $usernameRequest = UsernameRequest::findOrFail($command->requestId);
        $user = $this->users->findOrFail($usernameRequest->user_id);

        if (isset($data['attributes']['delete']) && $actor->id === $user->id) {
            return $usernameRequest->delete();
        }

        $actor->assertCan('user.viewUsernameRequests');

        $usernameRequest->status = $data['attributes']['action'];

        $oldUsername = null;

        if ($usernameRequest->status === 'Approved') {
            $attr = $usernameRequest->for_nickname ? 'nickname' : 'username';

            // Allow for simply changing the case of a username, ie `user1` to `User1`
            // The UserValidator will respond by saying `this username has already been taken`, so we bypass if the username is the same
            if (Str::lower($user->username) !== Str::lower($usernameRequest->requested_username)) {
                $this->validator->assertValid([$attr => $usernameRequest->requested_username]);
            }

            if ($attr === 'username') {
                $usernameHistory = json_decode($user->username_history, true);

                $usernameHistory === null ? $usernameHistory = [] : $usernameHistory;

                array_push($usernameHistory, [$user->username => time()]);
                $user->username_history = json_encode($usernameHistory);

                $oldUsername = $user->username;
            }

            /** @phpstan-ignore-next-line */
            $user->$attr = $usernameRequest->requested_username;
            $user->save();

            if ($oldUsername) {
                $this->events->dispatch(new Renamed($user, $oldUsername, $actor));
            }
        } else {
            $usernameRequest->reason = $data['attributes']['reason'];
        }

        $usernameRequest->save();

        if ($usernameRequest->status === 'Approved') {
            $this->notificatons->sync(
                $usernameRequest->for_nickname
                    ? new NicknameRequestApprovedBlueprint($usernameRequest, $actor)
                    : new RequestApprovedBlueprint($usernameRequest, $actor),
                [$user]
            );
        } else {
            $this->notificatons->sync(
                $usernameRequest->for_nickname
                    ? new NicknameRequestRejectedBlueprint($usernameRequest, $actor)
                    : new RequestRejectedBlueprint($usernameRequest, $actor),
                [$user]
            );
        }

        return $usernameRequest;
    }
}
