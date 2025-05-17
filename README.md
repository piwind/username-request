# Username Request

![License](https://img.shields.io/badge/license-MIT-blue.svg) [![Latest Stable Version](https://img.shields.io/packagist/v/piwind/username-request.svg)](https://packagist.org/packages/piwind/username-request) [![Total Downloads](https://img.shields.io/packagist/dt/piwind/username-request.svg)](https://packagist.org/packages/piwind/username-request)

A [Flarum](http://flarum.org) extension. Allows users to request new usernames which can be approved by moderators or admins.

## About This Fork

This repository is a fork of [FriendsOfFlarum/username-request](https://github.com/FriendsOfFlarum/username-request), with bug fixes and text optimization.

## Installation & Updating

Install with composer:

```sh
composer require piwind/username-request:"*"
```

Updating:

```sh
composer update piwind/username-request
```

## Usage

**If nickname changes are open to all users:**

- In the `flarum/nicknames` extension, set the **"Edit Own Nickname"** permission to **"Members"**.
- In this extension, set the **"Request nickname change"** permission to **"Admin"** only.

**If nickname changes require approval:**

- In the `flarum/nicknames` extension, set the **"Edit Own Nickname"** permission to **"Admin"** only.
- In this plugin, set the **"Request nickname change"** permission to **"Members"**.

With these permission settings, the user settings page will display only **one** nickname change button (instead of two duplicate buttons) for all non-admin accounts.

如果更改昵称是开放的，则插件 `flarum/nicknames` 中的 **"更改个人昵称"** 的权限设置为 **"注册用户"**，本插件的 **"申请更改昵称"** 的权限设置为 **"管理"**。

如果更改昵称需要申请并审核通过，则插件 `flarum/nicknames` 中的 **"更改个人昵称"** 的权限设置为 **"管理"**，本插件的 **"申请更改昵称"** 的权限设置为 **"注册用户"**。

基于以上权限设置，能确保除了管理员之外的所有账户，用户设置页都是只显示一个更改昵称的按钮，而不是两个重复的按钮。

## TODO

- resources/views/emails/nicknameRequestRejected.blade.php 下的old_nickname用的是$user->display_name，这个是不一定的
- 申请更改用户名、申请更改昵称，点按钮后如果已经有提交的申请会弹出不同的窗口，但是刷新网页后无法看到申请的状态（是否已经提交申请请求）
- 限制n天内只能修改一次用户名/昵称

## Links

- [Packagist](https://packagist.org/packages/piwind/username-request)
- [GitHub](https://github.com/piwind/username-request)

