<?php

namespace Modules\Employee\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateCategoryRequest extends BaseFormRequest
{
    protected $translationsAttributesKey = 'employee::categories.form';
    public function translationRules()
    {
        return [
            'name' => 'required',
            'slug' => 'required'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ordering' => 'required'
        ];
    }

    public function attributes()
    {
        return trans('employee::categories.form');
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
