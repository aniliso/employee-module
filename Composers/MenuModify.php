<?php namespace Modules\Employee\Composers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Modules\Employee\Repositories\EmployeeRepository;
use Modules\Menu\Entities\Menuitem;

class MenuModify
{
    /**
     * @var EmployeeRepository
     */
    private $employee;

    public function __construct(EmployeeRepository $employee)
    {
        $this->employee = $employee;
    }

    public function compose(View $view)
    {
        $menuItem = Menuitem::whereHas('translations', function(Builder $q) {
            $q->where('title', 'Kliniğimiz');
        })->first();

        if($menuItem) {
            \Menu::modify('header', function ($menu) use ($menuItem) {
                $menu->whereTitle($menuItem->title, function ($sub) {
                   if(count($sub->childs)>0) {
                       foreach ($sub->childs as $child) {
                           $menuItem = Menuitem::whereHas('translations', function(Builder $q) {
                               $q->where('title', 'Ekibimiz');
                           })->with('translations')->first();
                           if($child->title == $menuItem->title) {
                               foreach ($this->employee->all() as $employee) {
                                   $child->url($employee->url, $employee->fullname);
                               }
                           }
                       }
                   }
                });
            });
        }
    }
}