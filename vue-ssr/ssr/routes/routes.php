<?php
use Lumi\Core\Route;
use Lumi\Core\RouteCrud;

Route::get('{any?}', 'Index\IndexAction')->where('any', '.*');
