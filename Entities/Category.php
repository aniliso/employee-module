<?php

namespace Modules\Employee\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\Employee\Presenters\CategoryPresenter;

class Category extends Model
{
    use Translatable, PresentableTrait;

    protected $table = 'employee__categories';
    public $translatedAttributes = ['name','slug','meta_title','meta_description'];
    protected $fillable = ['name','slug','meta_title','meta_description','ordering'];

    protected $presenter = CategoryPresenter::class;

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function getUrlAttribute()
    {
        return route('employee.category', ['slug'=>$this->slug]);
    }
}
