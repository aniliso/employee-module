<?php namespace Modules\Employee\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Employee\Events\EmployeeWasCreated;
use Modules\Employee\Events\EmployeeWasDeleted;
use Modules\Employee\Events\EmployeeWasUpdated;
use Modules\Media\Events\Handlers\HandleMediaStorage;
use Modules\Media\Events\Handlers\RemovePolymorphicLink;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
      EmployeeWasCreated::class => [
          HandleMediaStorage::class
      ],
      EmployeeWasUpdated::class => [
          HandleMediaStorage::class
      ],
      EmployeeWasDeleted::class => [
          RemovePolymorphicLink::class
      ]
    ];
}