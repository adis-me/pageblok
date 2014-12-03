@extends("pageblok::templates.base")

@section('content')
{{ Form::open(array('route' => 'app.admin.blocks.delete', 'method' => 'post', 'class' => 'pageblok-list-form', 'onkeypress' => 'return event.keyCode != 13;')) }}
<div class="ts-menu-bar border-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <a class="btn btn-primary" href="{{ route('app.admin.blocks.create') }}">{{ trans('pageblok::pageblok.add.block') }}</a>
                <button class="btn btn-danger extra-actions" style="display: none;" type="submit">{{ trans('pageblok::pageblok.delete') }}</button>
            </div>
            <div class="col-md-4">
                @if($groups)
                <div class="dropdown pull-right">
                    <button class="btn btn-default dropdown-toggle" type="button" id="group-menu" data-toggle="dropdown">
                        {{ $selectedGroup }}
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="group-menu">
                    <li role="menuitem"><a role="menuitem" tabindex="-1" href="{{ route('app.admin.blocks') }}">{{ trans('pageblok::pageblok.blocks') }}</a></li>
                    <li role="menuitem" class="divider"></li>
                    @foreach($groups as $groupName)
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('app.admin.blocks', array('group' => $groupName)) }}">{{ $groupName }}</a></li>
                    @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="container padded-top">
    <div class="row">
        <div class="col-md-12">
            @if ( $blocks && count($blocks) )
            <table class="table table-striped table-hover table-condensed pageblok-item-list">
                <tr>
                    <th></th>
                    <th>{{ trans('pageblok::pageblok.title') }}</th>
                    <th>{{ trans('pageblok::pageblok.description') }}</th>
                    <th>{{ trans('pageblok::pageblok.group') }}</th>
                    <th class="status-column">{{ trans('pageblok::pageblok.status') }}</th>
                </tr>
                @foreach ( $blocks as $block )
                <tr>
                    <td>
                        {{ Form::checkbox('id[]', $block->id); }}
                    </td>
                    <td>{{ link_to_route('app.admin.blocks.edit', $block->title, array('blockid' => $block->id)); }}</td>
                    <td>{{ link_to_route('app.admin.blocks.edit', $block->description, array('blockid' => $block->id)); }}</td>
                    <td>{{ link_to_route('app.admin.blocks.edit', $block->group, array('blockid' => $block->id)); }}</td>
                    <td>
                        @if ($block->published)
                        <span class="label label-success">{{ trans('pageblok::pageblok.published') }}</span>
                        @else
                        <span class="label label-warning">{{ trans('pageblok::pageblok.draft') }}</span>
                        @endif

                    </td>
                </tr>
                @endforeach
            </table>
            @else
            <p class="alert alert-info">{{ trans('pageblok::pageblok.you.have.no.blocks') }} <a href="{{ route('app.admin.blocks.create') }}" class="btn btn-primary">{{ trans('pageblok::pageblok.add.block') }}</a></p>
            @endif
        </div>
    </div>
    <div class="row">
            <div class="col-md-12">
                <div class="pull-right">
                    {{ $blocks->links() }}
                </div>
            </div>
        </div>
</div>
{{ Form::close() }}
@stop