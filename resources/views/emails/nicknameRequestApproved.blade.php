{!! $translator->trans('fof-username-request.email_for_nickname.body.approved', [
    '{recipient_display_name}' => $user->display_name,
    '{actor_display_name}' => $blueprint->actor->display_name,
    '{new_nickname}' => $blueprint->getRequestedUsername(),
]) !!}
