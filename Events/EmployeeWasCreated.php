<?php namespace Modules\Employee\Events;

use Modules\Media\Contracts\StoringMedia;

class EmployeeWasCreated implements StoringMedia
{
    /**
     * @var array
     */
    private $data;
    /**
     * @var
     */
    private $employee;

    /**
     * EmployeeWasCreated constructor.
     * @param $employee
     * @param array $data
     */
    public function __construct($employee, array $data)
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
