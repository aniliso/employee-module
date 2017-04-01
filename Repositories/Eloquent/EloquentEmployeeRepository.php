<?php

namespace Modules\Employee\Repositories\Eloquent;

use Modules\Employee\Events\EmployeeWasCreated;
use Modules\Employee\Events\EmployeeWasDeleted;
use Modules\Employee\Events\EmployeeWasUpdated;
use Modules\Employee\Repositories\EmployeeRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentEmployeeRepository extends EloquentBaseRepository implements EmployeeRepository
{
    public function all()
    {
        return $this->model->orderBy('ordering', 'ASC')->with('translations')->get();
    }

    public function create($data)
    {
        $model = $this->model->create($data);
        event(new EmployeeWasCreated($model, $data));
        return $model;
    }

    public function update($model, $data)
    {
        $model->update($data);
        event(new EmployeeWasUpdated($model, $data));
        return $model;
    }

    public function destroy($model)
    {
        event(new EmployeeWasDeleted($model->id, get_class($model)));
        return parent::destroy($model);
    }
}
