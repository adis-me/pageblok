@extends("pageblok::templates.base")

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                    <h2><i class="fa fa-file"></i> {{ trans('pageblok::app.pages') }}</h2>
                    <p>{{ trans('pageblok::app.pagecount', array('number' => $pages->count())) }}</p>
                    <a class="btn btn-primary pull-right" href="{{ route('app.admin.pages.create') }}">{{ trans('pageblok::app.add.page') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                    <h2><i class="fa fa-cubes"></i> {{ trans('pageblok::app.blocks') }}</h2>
                    <p>{{ trans('pageblok::app.blockcount', array('number' => $blocks->count())) }}</p>
                    <a class="btn btn-primary pull-right" href="{{ route('app.admin.blocks.create') }}">{{ trans('pageblok::app.add.block') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop