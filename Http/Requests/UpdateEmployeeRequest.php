<?php

namespace Modules\Employee\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateEmployeeRequest extends BaseFormRequest
{
    protected $translationsAttributesKey = 'employee::employees.form';

    public function translationRules()
    {
        return [
            'position'   => 'required'
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
            'category_id' => 'required',
            'first_name' => 'required',
            'last_name'  => 'required'
        ];
    }

    /**
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     */
    public function attributes()
    {
        return trans('employee::employees.form');
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
