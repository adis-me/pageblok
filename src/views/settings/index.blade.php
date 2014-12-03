@extends("pageblok::templates.base")

@section('content')
{{ Form::open(array('route' => 'app.admin.settings.delete', 'method' => 'post', 'class' => 'pageblok-list-form', 'onkeypress' => 'return event.keyCode != 13;')) }}
<div class="ts-menu-bar border-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-primary" href="{{ route('app.admin.settings.create') }}">{{ trans('pageblok::app.add.setting') }}</a>
                <button class="btn btn-danger extra-actions" style="display: none;" type="submit">{{ trans('pageblok::app.delete') }}</button>
            </div>
        </div>
    </div>
</div>

<div class="container padded-top">
    <div class="row">
        <div class="col-md-12">
            @if ( $settings && count($settings) )
            <table class="table table-striped table-hover table-condensed pageblok-item-list">
                <tr>
                    <th></th>
                    <th>{{ trans('pageblok::app.key') }}</th>
                    <th>{{ trans('pageblok::app.value') }}</th>
                    <th>{{ trans('pageblok::app.description') }}</th>
                    <th class="status-column">{{ trans('pageblok::app.environment') }}</th>
                </tr>
                @foreach ( $settings as $setting )
                <tr>
                    <td>
                        {{ Form::checkbox('id[]', $setting->id); }}
                    </td>
                    <td>{{ link_to_route('app.admin.settings.edit', $setting->key, array('settingid' => $setting->id)); }}</td>
                    <td>{{ link_to_route('app.admin.settings.edit', $setting->value, array('settingid' => $setting->id)); }}</td>
                    <td>{{ link_to_route('app.admin.settings.edit', $setting->description, array('settingid' => $setting->id)); }}</td>
                    <td>{{ link_to_route('app.admin.settings.edit', $setting->environment, array('settingid' => $setting->id)); }}</td>
                </tr>
                @endforeach
            </table>
            @else
            <p class="alert alert-info">{{ trans('pageblok::app.you.have.no.settings') }} <a href="{{ route('app.admin.settings.create') }}" class="btn btn-primary">{{ trans('pageblok::app.add.setting') }}</a></p>
            @endif
        </div>
    </div>
    <div class="row">
            <div class="col-md-12">
                <div class="pull-right">
                    {{ $settings->links() }}
                </div>
            </div>
        </div>
</div>
{{ Form::close() }}
@stop