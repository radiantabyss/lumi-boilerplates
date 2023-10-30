export default [
    {
        middleware: ['SetUser', 'NotLogged'],
        routes: [
            // auth routes -----------------------------------------------------------------------------------
            { path: '/login', action: 'Auth.User.LoginAction' },
            { path: '/register', action: 'Auth.User.RegisterAction' },
            { path: '/forgot-password', action: 'Auth.User.ForgotPasswordAction' },
            { path: '/reset-password', action: 'Auth.User.ResetPasswordAction' },
        ]
    },
    {
        middleware: ['SetUser', 'Logged'],
        routes: [
            { path: '/', action: 'Common.IndexAction' },
            { path: '/logout', action: 'Auth.User.LogoutAction' },

            { path: '/crud', action: 'Crud.ListAction' },
            { path: '/crud/new/{id?}', action: 'Crud.NewAction' },
            { path: '/crud/edit/{id}', action: 'Crud.EditAction' },
        ]
    },
];
