import app from 'flarum/admin/app';

app.initializers.add('piwind-username-request', () => {
  app.extensionData
    .for('piwind-username-request')
    .registerPermission(
      {
        icon: 'fas fa-user-edit',
        label: app.translator.trans('piwind-username-request.admin.permissions.moderate_requests'),
        permission: 'user.viewUsernameRequests',
      },
      'moderate'
    )
    .registerPermission(
      {
        icon: 'fas fa-user-edit',
        label: app.translator.trans('piwind-username-request.admin.permissions.request_username'),
        permission: 'user.requestUsername',
      },
      'start'
    )
    .registerPermission(
      {
        icon: 'fas fa-user-edit',
        label: app.translator.trans('piwind-username-request.admin.permissions.request_nickname'),
        permission: 'user.requestNickname',
      },
      'start'
    )
    .registerSetting(function () {
      return [
        <p><strong>If nickname changes are open to all users:</strong></p>,
        <ul>
          <li>In the <code>flarum/nicknames</code> extension, set the <strong>&quot;Edit Own Nickname&quot;</strong> permission to <strong>&quot;Members&quot;</strong>.</li>
          <li>In this extension, set the <strong>&quot;Request nickname change&quot;</strong> permission to <strong>&quot;Admin&quot;</strong> only.</li>
        </ul>,
        <p><strong>If nickname changes require approval:</strong></p>,
        <ul>
          <li>In the <code>flarum/nicknames</code> extension, set the <strong>&quot;Edit Own Nickname&quot;</strong> permission to <strong>&quot;Admin&quot;</strong> only.</li>
          <li>In this plugin, set the <strong>&quot;Request nickname change&quot;</strong> permission to <strong>&quot;Members&quot;</strong>.</li>
        </ul>,
        <p>With these permission settings, the user settings page will display only <strong>one</strong> nickname change button (instead of two duplicate buttons) for all non-admin accounts.</p>,
        <p>如果更改昵称是开放的，则插件 <code>flarum/nicknames</code> 中的 <strong>&quot;更改个人昵称&quot;</strong> 的权限设置为 <strong>&quot;注册用户&quot;</strong>，本插件的 <strong>&quot;申请更改昵称&quot;</strong> 的权限设置为 <strong>&quot;管理&quot;</strong>。</p>,
        <p>如果更改昵称需要申请并审核通过，则插件 <code>flarum/nicknames</code> 中的 <strong>&quot;更改个人昵称&quot;</strong> 的权限设置为 <strong>&quot;管理&quot;</strong>，本插件的 <strong>&quot;申请更改昵称&quot;</strong> 的权限设置为 <strong>&quot;注册用户&quot;</strong>。</p>,
        <p>基于以上权限设置，能确保除了管理员之外的所有账户，用户设置页都是只显示一个更改昵称的按钮，而不是两个重复的按钮。</p>
      ];
    });
});
