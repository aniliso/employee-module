<?php

namespace Modules\Employee\Entities;

use Illuminate\Database\Eloquent\Model;

class EmployeeTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['description','biography','skills','position','meta_title','meta_description'];
    protected $table = 'employee__employee_translations';
}
