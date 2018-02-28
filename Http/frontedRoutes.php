<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix'=>''], function (Router $router) {
    $router->get(LaravelLocalization::transRoute('employee::routes.employee.index'), [
        'uses' => 'PublicController@index',
        'as'   => 'employee.index'
    ]);
    $router->get(LaravelLocalization::transRoute('employee::routes.employee.view'), [
        'uses' => 'PublicController@view',
        'as'   => 'employee.view'
    ]);
    $router->get(LaravelLocalization::transRoute('employee::routes.employee.category'), [
        'uses' => 'PublicController@category',
        'as'   => 'employee.category'
    ]);
});