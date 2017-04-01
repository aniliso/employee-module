<div class="box-body">

    {!! Form::i18nInput('position', trans('employee::employees.form.position'), $errors, $lang, $employee) !!}

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#description_{{ $lang }}" data-toggle="tab">Açıklama</a></li>
            <li><a href="#biography_{{ $lang }}" data-toggle="tab">Biografi</a></li>
            <li><a href="#skills_{{ $lang }}" data-toggle="tab">Beceriler</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane active" id="description_{{ $lang }}">
            {!! Form::i18nTextarea("description", trans('employee::employees.form.description'), $errors, $lang, $employee) !!}
        </div>
        <div class="tab-pane" id="biography_{{ $lang }}">
            {!! Form::i18nTextarea("biography", trans('employee::employees.form.biography'), $errors, $lang, $employee) !!}
        </div>
        <div class="tab-pane" id="skills_{{ $lang }}">
            {!! Form::i18nTextarea("skills", trans('employee::employees.form.skills'), $errors, $lang, $employee) !!}
        </div>
    </div>
    <div class="box-group" id="accordion">
        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
        <div class="panel box box-primary">
            <div class="box-header">
                <h4 class="box-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo-{{$lang}}">
                        {{ trans('blog::post.form.meta_data') }}
                    </a>
                </h4>
            </div>
            <div style="height: 0px;" id="collapseTwo-{{$lang}}" class="panel-collapse collapse">
                <div class="box-body">
                    {!! Form::i18nInput("meta_title", trans('employee::employees.form.meta_title'), $errors, $lang, $employee) !!}

                    {!! Form::i18nTextarea("meta_description", trans('employee::employees.form.meta_description'), $errors, $lang, $employee, ['class'=>'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
