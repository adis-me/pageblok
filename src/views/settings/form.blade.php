@extends("pageblok::templates.base")

@section('content')
{{ Form::open(array('route' => array($formRoute, $setting->id), 'method' => 'post', 'class' => 'editor-form create-page', 'files' => true )) }}
<div class="border-bottom">
    <div class="container form-group">
        {{ HTML::linkRoute('app.admin.settings',  trans('pageblok::app.cancel'), null, array('class' => 'btn btn-default')) }}
        {{ Form::submit(trans('pageblok::app.save'), array('class' => 'btn btn-success')) }}
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12 padded-top">
            <div class="form-group">
                {{ Form::label('key', trans('pageblok::app.key')); }}
                {{ Form::text('key', $setting->key, array('class' => 'form-control', 'placeholder' => trans('pageblok::app.key'))); }}
            </div>
            <div class="form-group">
                {{ Form::label('value', trans('pageblok::app.value')); }}
                {{ Form::text('value', $setting->value, array('class' => 'form-control', 'placeholder' => trans('pageblok::app.value'))); }}
            </div>
            <div class="form-group">
                {{ Form::label('environment', trans('pageblok::app.environment')); }}
                {{ Form::select('environment', $environments, $setting->environment, array('class' => 'form-control')); }}
            </div>
            <div class="form-group">
                {{ Form::label('description', trans('pageblok::app.description')); }}
                {{ Form::text('description', $setting->description, array('class' => 'form-control', 'placeholder' => trans('pageblok::app.description'))); }}
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>
@stop