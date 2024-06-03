export default [
    {
        middleware: ['SetUser', 'NotLogged'],
        routes: [
            { path: '/login', action: 'Auth.User.LoginAction' },
            { path: '/register', action: 'Auth.User.RegisterAction' },
            { path: '/forgot-password', action: 'Auth.User.ForgotPasswordAction' },
            { path: '/reset-password', action: 'Auth.User.ResetPasswordAction' },
        ]
    },
    {
        middleware: ['SetUser', 'Logged'],
        routes: [
            { path: '/logout', action: 'Auth.User.LogoutAction' },
            { path: '/auth/user/account', action: 'Auth.User.AccountAction' },
            { path: '/auth/team/new', action: 'Auth.Team.NewAction' },
            { path: '/auth/team/edit/{id}', action: 'Auth.Team.EditAction' },
        ]
    },
];
