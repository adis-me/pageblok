@extends("pageblok::templates.base")

@section('content')
{{ Form::open(array('route' => 'app.admin.navigations.delete', 'method' => 'post', 'class' => 'pageblok-list-form', 'onkeypress' => 'return event.keyCode != 13;')) }}
<div class="ts-menu-bar border-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <a class="btn btn-primary" href="{{ route('app.admin.navigations.create') }}">{{ trans('pageblok::app.add.navigation') }}</a>
                <button class="btn btn-danger extra-actions" style="display: none;" type="submit">{{ trans('pageblok::app.delete') }}</button>
            </div>
            <div class="col-md-4">
            </div>
        </div>
    </div>
</div>

<div class="container padded-top">
    <div class="row">
        <div class="col-md-12">
            @if ( $navigations && count($navigations) )
            <table class="table table-striped table-hover table-condensed pageblok-item-list">
                <tr>
                    <th></th>
                    <th>{{ trans('pageblok::app.name') }}</th>
                    <th>{{ trans('pageblok::app.title') }}</th>
                    <th>{{ trans('pageblok::app.description') }}</th>
                    <th>{{ trans('pageblok::app.url') }}</th>
                </tr>
                @foreach ( $navigations as $backendmenu )
                <tr>
                    <td>
                        {{ Form::checkbox('id[]', $backendmenu->id); }}
                    </td>
                    <td>{{ link_to_route('app.admin.navigations.edit', $backendmenu->name, array('backendmenuid' => $backendmenu->id)); }}</td>
                    <td>{{ link_to_route('app.admin.navigations.edit', $backendmenu->title, array('backendmenuid' => $backendmenu->id)); }}</td>
                    <td>{{ link_to_route('app.admin.navigations.edit', $backendmenu->description, array('backendmenuid' => $backendmenu->id)); }}</td>
                    <td>{{ link_to_route('app.admin.navigations.edit', $backendmenu->href, array('backendmenuid' => $backendmenu->id)); }}</td>
                </tr>
                @endforeach
            </table>
            @else
            <p class="alert alert-info">{{ trans('pageblok::app.you.have.no.navigations') }} <a href="{{ route('app.admin.navigations.create') }}" class="btn btn-primary">{{ trans('pageblok::app.add.backendmenu') }}</a></p>
            @endif
        </div>
    </div>
    <div class="row">
            <div class="col-md-12">
                <div class="pull-right">
                    {{ $navigations->links() }}
                </div>
            </div>
        </div>
</div>
{{ Form::close() }}
@stop