<?php
use RA\Core\Route;
use RA\Core\RouteCrud;

Route::get('/', 'Index\IndexAction');

//with auth
Route::group(['middleware' => ['RA\Auth\Logged']], function() {
    RouteCrud::run('Domain');
    RouteCrud::run('Keyword');
    RouteCrud::run('Offer');

    Route::get('/report/keywords-position/{date}', 'Report\KeywordsPositionAction');
    Route::get('/report/offers-position/{keyword}/{date}', 'Report\OffersPositionAction');
});
