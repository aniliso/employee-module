<?php

namespace Modules\Employee\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Sidebar\AbstractAdminSidebar;

class RegisterEmployeeSidebar extends AbstractAdminSidebar
{
    /**
     * @param Menu $menu
     *
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('employee::employees.title.employees'), function (Item $item) {
                $item->icon('fa fa-users');
                $item->weight(10);
                $item->authorize(
                    $this->auth->hasAccess('employee.employees.index')
                );
                $item->item(trans('employee::employees.title.employees'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.employee.employee.create');
                    $item->route('admin.employee.employee.index');
                    $item->authorize(
                        $this->auth->hasAccess('employee.employees.index')
                    );
                });
                $item->item(trans('employee::categories.title.categories'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.employee.category.create');
                    $item->route('admin.employee.category.index');
                    $item->authorize(
                        $this->auth->hasAccess('employee.categories.index')
                    );
                });
            });
        });

        return $menu;
    }
}
