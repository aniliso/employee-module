<?php namespace Modules\Employee\Presenters;

use Modules\Core\Presenters\BasePresenter;

class CategoryPresenter extends BasePresenter
{
    protected $zone     = 'categoryImage';
    protected $slug     = 'slug';
    protected $transKey = 'employee::routes.employee.category';
    protected $routeKey = 'employee.category';
}