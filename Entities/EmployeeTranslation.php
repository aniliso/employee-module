<?php

namespace Modules\Employee\Entities;

use Illuminate\Database\Eloquent\Model;

class EmployeeTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['description','biography','skills','position','meta_title','meta_description'];
    protected $table = 'employee__employee_translations';

    protected function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function getUrlAttribute()
    {
        return localize_trans_url($this->locale, 'employee::routes.employee.view', ['slug' => $this->employee->slug]);
    }
}
