<?php

namespace Modules\Employee\Widgets;

use Modules\Employee\Repositories\CategoryRepository;
use Modules\Employee\Repositories\EmployeeRepository;

class EmployeeWidgets
{
  /**
   * @var EmployeeRepository
   */
  private $employee;
  /**
   * @var CategoryRepository
   */
  private $category;

  public function __construct(EmployeeRepository $employee, CategoryRepository $category)
  {
    $this->employee = $employee;
    $this->category = $category;
  }

  public function categories($limit=10, $view='categories')
  {
    $categories = $this->category->all()->sortBy('ordering')->take($limit);
    if($categories->count() > 0) {
      return view('employee::widgets.'.$view, compact('categories'));
    }
    return null;
  }
}