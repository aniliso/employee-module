<?php namespace Modules\Employee\Presenters;

use Modules\Core\Presenters\BasePresenter;

class EmployeePresenter extends BasePresenter
{
    protected $zone     = 'employeeImage';
    protected $slug     = 'slug';
    protected $transKey = 'employee::routes.employee.view';
    protected $routeKey = 'employee.view';
}
