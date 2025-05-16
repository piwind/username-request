{!! $translator->trans('piwind-username-request.email_for_nickname.body.rejected', [
    '{recipient_display_name}' => $user->display_name,
    '{actor_display_name}' => $blueprint->actor->display_name,
    '{old_nickname}' => $user->display_name,
    '{requested_nickname}' => $blueprint->getRequestedUsername(),
    '{reason}' => $blueprint->usernameRequest->reason ?: $translator->trans('piwind-username-request.email_for_nickname.body.noReasonProvided'),
]) !!}
