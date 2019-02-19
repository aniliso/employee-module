<?php

namespace Modules\Employee\Entities;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name','slug','meta_title','meta_description'];
    protected $table = 'employee__category_translations';

    protected $appends = ['url'];

    public function getUrlAttribute()
    {
        return localize_trans_url($this->locale, 'employee::routes.employee.category', ['slug'=>$this->slug]);
    }
}
