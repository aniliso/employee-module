<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/employee'], function (Router $router) {
    $router->bind('employee', function ($id) {
        return app('Modules\Employee\Repositories\EmployeeRepository')->find($id);
    });
    $router->get('employees', [
        'as' => 'admin.employee.employee.index',
        'uses' => 'EmployeeController@index',
        'middleware' => 'can:employee.employees.index'
    ]);
    $router->get('employees/create', [
        'as' => 'admin.employee.employee.create',
        'uses' => 'EmployeeController@create',
        'middleware' => 'can:employee.employees.create'
    ]);
    $router->post('employees', [
        'as' => 'admin.employee.employee.store',
        'uses' => 'EmployeeController@store',
        'middleware' => 'can:employee.employees.create'
    ]);
    $router->get('employees/{employee}/edit', [
        'as' => 'admin.employee.employee.edit',
        'uses' => 'EmployeeController@edit',
        'middleware' => 'can:employee.employees.edit'
    ]);
    $router->put('employees/{employee}', [
        'as' => 'admin.employee.employee.update',
        'uses' => 'EmployeeController@update',
        'middleware' => 'can:employee.employees.edit'
    ]);
    $router->delete('employees/{employee}', [
        'as' => 'admin.employee.employee.destroy',
        'uses' => 'EmployeeController@destroy',
        'middleware' => 'can:employee.employees.destroy'
    ]);
    $router->bind('employeeCategory', function ($id) {
        return app('Modules\Employee\Repositories\CategoryRepository')->find($id);
    });
    $router->get('categories', [
        'as' => 'admin.employee.category.index',
        'uses' => 'CategoryController@index',
        'middleware' => 'can:employee.categories.index'
    ]);
    $router->get('categories/create', [
        'as' => 'admin.employee.category.create',
        'uses' => 'CategoryController@create',
        'middleware' => 'can:employee.categories.create'
    ]);
    $router->post('categories', [
        'as' => 'admin.employee.category.store',
        'uses' => 'CategoryController@store',
        'middleware' => 'can:employee.categories.create'
    ]);
    $router->get('categories/{employeeCategory}/edit', [
        'as' => 'admin.employee.category.edit',
        'uses' => 'CategoryController@edit',
        'middleware' => 'can:employee.categories.edit'
    ]);
    $router->put('categories/{employeeCategory}', [
        'as' => 'admin.employee.category.update',
        'uses' => 'CategoryController@update',
        'middleware' => 'can:employee.categories.edit'
    ]);
    $router->delete('categories/{employeeCategory}', [
        'as' => 'admin.employee.category.destroy',
        'uses' => 'CategoryController@destroy',
        'middleware' => 'can:employee.categories.destroy'
    ]);
// append


});
