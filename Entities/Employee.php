<?php

namespace Modules\Employee\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\Employee\Presenters\EmployeePresenter;
use Modules\Media\Support\Traits\MediaRelation;
use Modules\User\Entities\Sentinel\User;

class Employee extends Model
{
    use Translatable, MediaRelation, PresentableTrait;

    protected $table = 'employee__employees';
    public $translatedAttributes = ['description','biography','skills','position','meta_title','meta_description'];
    protected $fillable = ['first_name','last_name','slug','email','phone','address','mobile','fax','address','facebook','twitter','google','linkedin','instagram','website','ordering','description','biography','skills','position','meta_title','meta_description'];

    protected $presenter = EmployeePresenter::class;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getUrlAttribute()
    {
        return localize_trans_url(locale(), 'employee::routes.employee.view', ['slug'=>$this->slug]);
    }

    public static function boot()
    {
        parent::boot();

        static::updating(function(Employee $employee) {
            $slug = str_slug(\Patchwork\Utf8::toAscii($employee->first_name.' '.$employee->last_name), '-');
            $counter = $employee->where('slug', '=', $slug)->count();
            if($counter>0) {
                $slug .= '-'.$counter;
            }
            $employee->slug = $slug;
        });
    }
}
