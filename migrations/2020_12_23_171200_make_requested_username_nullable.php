<?php

/*
 * This file is part of username-request.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        $schema->table('username_requests', function (Blueprint $table) {
            $table->string('requested_username')->nullable()->change();
        });
    },
    'down' => function (Builder $schema) {
        $schema->table('username_requests', function (Blueprint $table) {
            $table->string('requested_username')->nullable(false)->change();
        });
    },
];
