<?php
use RA\Core\Route;

//no auth
Route::group(['middleware' => ['RA\Auth\NotLogged']], function() {
    Route::post('/auth/user/register', 'User\RegisterAction');
    Route::post('/auth/user/forgot-password', 'User\ForgotPasswordAction');
    Route::post('/auth/user/reset-password', 'User\ResetPasswordAction');
    Route::post('/auth/user/confirm', 'User\ConfirmAction');
    Route::post('/auth/user/login', 'User\LoginAction');

    Route::post('/auth/user/accept-invite', 'User\AcceptInviteAction');
});

//with auth
Route::group(['middleware' => ['RA\Auth\Logged']], function() {
    Route::get('/auth/user/get', 'User\GetAction');
    Route::post('/auth/user/patch', 'User\PatchAction');
    Route::post('/auth/user/upload-profile-image', 'User\UploadProfileImageAction');
    Route::options('/auth/user/upload-profile-image', 'User\UploadProfileImageAction');

    Route::get('/auth/team', 'Team\ListAction');
    Route::post('/auth/team/create', 'Team\CreateAction');
    Route::post('/auth/team/single/{id}', 'Team\SingleAction');
    Route::post('/auth/team/switch/{id}', 'Team\SwitchAction');
    Route::get('/auth/team/edit/{id}', 'Team\EditAction');
    Route::post('/auth/team/update/{id}', 'Team\UpdateAction');
    Route::get('/auth/team/leave/{id}', 'Team\LeaveAction');
    Route::post('/auth/team/upload-image', 'Team\UploadImageAction');
    Route::options('/auth/team/upload-image', 'Team\UploadImageAction');

    Route::get('/auth/team/can-manage/{id}', 'Team\CanManageAction');
    Route::post('/auth/team/change-role', 'Team\ChangeRoleAction');
    Route::get('/auth/team/list-members/{team_id}', 'Team\ListMembersAction');
    Route::get('/auth/team/delete-member/{id}', 'Team\DeleteMemberAction');
    Route::post('/auth/team/invite/{id}', 'Team\InviteAction');
    Route::post('/auth/team/resend-invite/{invite_id}', 'Team\ResendInviteAction');
    Route::get('/auth/team/delete-invite/{id}', 'Team\DeleteInviteAction');
});
