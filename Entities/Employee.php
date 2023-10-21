<?php

namespace Modules\Employee\Entities;

use Carbon\Carbon;
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
    protected $fillable = ['first_name','last_name','slug','email','phone','address','mobile','fax','address','facebook','twitter','google','linkedin','instagram','website','ordering','description','biography','skills','position','meta_title','meta_description', 'settings'];

    protected $casts = [
      'settings' => 'object'
    ];

    protected $appends = ['license_date'];

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
        return localize_url(locale(), route('employee.view', $this->slug));
    }

    public function setSettingsAttribute($value)
    {
      return $this->attributes['settings'] = json_encode($value);
    }

    public function getSettingsAttribute()
    {
      $settings = json_decode($this->attributes['settings']);
      return $settings;
    }

    public function getLicenseDateAttribute()
    {
      $settings = $this->getSettingsAttribute();
      return isset($settings->license_date) ? Carbon::parse($settings->license_date) : Carbon::now();
    }

    public function getLicenseYearAttribute()
    {
      $settings = $this->getSettingsAttribute();
      $licenseDate = $this->getLicenseDateAttribute();
      $licenseYear = isset($settings->license_year) ? $settings->license_year : null;
      return $licenseYear ?? $licenseDate->diffInYears(Carbon::now());
    }

    protected static function boot()
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
