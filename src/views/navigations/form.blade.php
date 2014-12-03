@extends("pageblok::templates.base")

@section('content')
{{ Form::open(array('route' => array($formRoute, $navigation->id), 'method' => 'post', 'class' => 'editor-form')) }}
<div class="border-bottom">
    <div class="container form-group">
        {{ HTML::linkRoute('app.admin.navigations',  trans("pageblok::app.cancel"), null, array('class' => 'btn btn-default')) }}
        {{ Form::submit(trans("pageblok::app.save"), array('class' => 'btn btn-success')) }}
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12 padded-top">
            <div class="form-group">
                {{ Form::label('name', trans("pageblok::app.system.name")); }}
                {{ Form::text('name', $navigation->name, array('class' => 'form-control', 'autofocus' => 'autofocus', 'placeholder' => "Link naam")); }}
            </div>
            <div class="form-group">
                {{ Form::label('description', trans("pageblok::app.description")); }}
                {{ Form::text('description', $navigation->description, array('class' => 'form-control', 'placeholder' => 'Navigatie rechtsboven')); }}
            </div>
            <div class="form-group">
                {{ Form::label('href', trans("pageblok::app.link")); }}
                {{ Form::text('href', $navigation->href, array('class' => 'form-control', 'placeholder' => 'Link')); }}
            </div>
            <div class="form-group">
                {{ Form::label('route_name', trans("pageblok::app.route_name")); }}
                {{ Form::text('route_name', $navigation->route_name, array('class' => 'form-control', 'placeholder' => 'Route name')); }}
            </div>
            <div class="form-group">
                {{ Form::label('title', trans("pageblok::app.title")); }}
                {{ Form::text('title', $navigation->title, array('class' => 'form-control', 'placeholder' => 'Titel')); }}
            </div>
            <div class="form-group">
                {{ Form::label('css_classes', trans("pageblok::app.stylesheet")); }}
                {{ Form::text('css_classes', $navigation->css_classes, array('class' => 'form-control', 'placeholder' => '.rond .groot')); }}
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}
@stop