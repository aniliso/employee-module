<?php namespace Modules\Employee\Events;

use Modules\Media\Contracts\DeletingMedia;

class EmployeeWasDeleted implements DeletingMedia
{
    private $employeeId;
    private $employeeClass;

    /**
     * EmployeeWasDeleted constructor.
     * @param $employeeId
     * @param $employeeClass
     */
    public function __construct($employeeId, $employeeClass)
    {

        $this->employeeId = $employeeId;
        $this->employeeClass = $employeeClass;
    }

    /**
     * Get the entity ID
     * @return int
     */
    public function getEntityId()
    {
        return $this->employeeId;
    }

    /**
     * Get the class name the imageables
     * @return string
     */
    public function getClassName()
    {
        return $this->employeeClass;
    }
}
