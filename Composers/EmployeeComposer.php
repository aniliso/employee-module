<?php namespace Modules\Employee\Composers;

use Illuminate\View\View;
use Modules\Employee\Repositories\CategoryRepository;
use Modules\User\Repositories\UserRepository;

class EmployeeComposer
{
    /**
     * @var CategoryRepository
     */
    private $category;
    /**
     * @var UserRepository
     */
    private $user;

    public function __construct(CategoryRepository $category, UserRepository $user)
    {
        $this->category = $category;
        $this->user = $user;
    }

    public function compose(View $view)
    {
        $view->with('categoriesList', $this->category->all()->pluck('name', 'id')->toArray());
        $view->with('usersList', [''=>trans('employee::employees.title.select user')]+$this->user->all()->pluck('fullname', 'id')->toArray());
    }
}