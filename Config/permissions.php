<?php

return [
    'employee.employees' => [
        'index' => 'employee::employees.list resource',
        'create' => 'employee::employees.create resource',
        'edit' => 'employee::employees.edit resource',
        'destroy' => 'employee::employees.destroy resource',
    ],
    'employee.categories' => [
        'index' => 'employee::categories.list resource',
        'create' => 'employee::categories.create resource',
        'edit' => 'employee::categories.edit resource',
        'destroy' => 'employee::categories.destroy resource',
    ],
// append


];
