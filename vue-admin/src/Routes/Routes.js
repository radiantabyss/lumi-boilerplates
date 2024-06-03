export default [
    {
        middleware: ['SetUser', 'Logged'],
        routes: [
            { path: '/', action: 'Common.IndexAction' },

            { path: '/crud', action: 'Crud.ListAction' },
            { path: '/crud/new/{id?}', action: 'Crud.NewAction' },
            { path: '/crud/edit/{id}', action: 'Crud.EditAction' },
        ]
    },
];
