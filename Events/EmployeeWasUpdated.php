<?php namespace Modules\Employee\Events;

use Modules\Employee\Entities\Employee;
use Modules\Media\Contracts\StoringMedia;

class EmployeeWasUpdated implements StoringMedia
{
    /**
     * @var array
     */
    private $data;
    /**
     * @var Employee
     */
    private $employee;

    /**
     * EmployeeWasUpdated constructor.
     * @param Employee $employee
     * @param array $data
     */
    public function __construct(Employee $employee, array $data)
    {
        $this->data = $data;
        $this->employee = $employee;
    }

    /**
     * Return the entity
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEntity()
    {
        return $this->employee;
    }

    /**
     * Return the ALL data sent
     * @return array
     */
    public function getSubmissionData()
    {
        return $this->data;
    }
}
