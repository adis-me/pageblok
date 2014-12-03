@extends("pageblok::templates.base")

@section('content')
{{ Form::open(array('route' => 'app.admin.pages.delete', 'method' => 'post', 'class' => 'pageblok-list-form', 'onkeypress' => 'return event.keyCode != 13;')) }}

<div class="ts-menu-bar border-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-primary" href="{{ route('app.admin.pages.create') }}">{{ trans('pageblok::pages.add.page') }}</a>
                <button class="btn btn-danger extra-actions" style="display: none;" type="submit">{{ trans('pageblok::pages.delete') }}</button>
            </div>
        </div>
    </div>
</div>

<div class="container padded-top">
    <div class="row">
        <div class="col-md-12">
            @if ( count($pages) )
                <table class="table table-striped table-hover table-condensed pageblok-item-list">
                    <tr>
                        <th></th>
                        <th>{{ trans('pageblok::pages.title') }}</th>
                        <th>{{ trans('pageblok::pages.description') }}</th>
                        <th>{{ trans('pageblok::pages.url') }}</th>
                        <th class="status-column">{{ trans('pageblok::pages.status') }}</th>
                    </tr>
                @foreach ( $pages as $page )
                    <tr>
                        <td>
                            {{ Form::checkbox('id[]', $page->id); }}
                        </td>
                        <td>{{ link_to_route('app.admin.pages.edit', $page->title, array('pageid' => $page->id)); }}</td>
                        <td>{{ link_to_route('app.admin.pages.edit', $page->description, array('pageid' => $page->id)); }}</td>
                        <td>
                            <a target="_blank" href="/{{ $page->pb_name }}">/{{ $page->pb_name }}</a>
                        </td>
                        <td>
                            @if ($page->published)
                            <span class="label label-success">{{ trans('pageblok::pages.published') }}</span>
                            @else
                            <span class="label label-warning">{{ trans('pageblok::pages.draft') }}</span>
                            @endif

                        </td>
                    </tr>
                @endforeach
                </table>
            @else
                <p class="alert alert-info">{{ trans('pageblok::pages.you.have.no.pages') }} <a href="{{ route('app.admin.pages.create') }}" class="btn btn-primary">{{ trans('pageblok::pages.add.page') }}</a></p>
            @endif
        </div>
    </div>
</div>
{{ Form::close() }}
@stop