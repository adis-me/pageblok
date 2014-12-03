@extends("pageblok::templates.base")

@section('content')
{{ Form::open(array('route' => array($formRoute, $page->id), 'method' => 'post', 'class' => 'editor-form create-page', 'files' => true)) }}
<div class="border-bottom">
    <div class="container form-group">
        {{ HTML::linkRoute('app.admin.pages',  trans('pageblok::pages.cancel'), null, array('class' => 'btn btn-default')) }}
        {{ Form::submit(trans('pageblok::pages.save'), array('class' => 'btn btn-success')) }}
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-9 padded-top border-right">
            <div class="form-group">
                {{ Form::label('slug', trans('pageblok::pages.slug')); }}
                {{ Form::text('pb_name', $page->pb_name, array('class' => 'form-control', 'autofocus' => 'autofocus', 'placeholder' => trans('pageblok::pages.title'))); }}
            </div>
            <div class="form-group">
                {{ Form::label('title', trans('pageblok::pages.title')); }}
                {{ Form::text('title', $page->title, array('class' => 'form-control', 'placeholder' => trans('pageblok::pages.title'))); }}
            </div>
            <div class="form-group">
                {{ Form::label('subtitle', trans('pageblok::pages.subtitle')); }}
                {{ Form::text('subtitle', $page->subtitle, array('class' => 'form-control', 'placeholder' => trans('pageblok::pages.subtitle'))); }}
            </div>
            <div class="form-group">
                {{ Form::label('description', trans('pageblok::pages.description')); }}
                {{ Form::textarea('description', $page->description, array('class' => 'form-control', 'placeholder' => trans('pageblok::pages.description'), 'rows' => 3)); }}
            </div>
            <div class="form-group">
                <textarea class="form-control input-block-level content-editor" name="content" rows="18">{{ $page->content }}</textarea>
            </div>

        </div>
        <div class="col-md-3 padded-top">
            <div class="form-group">
                {{ Form::label('template', trans('pageblok::pages.template')); }}
                {{ Form::select('template', $templates, $page->template, array('class' => 'form-control')); }}
            </div>
            <div class="form-group">
                {{ Form::label('content_type', trans('pageblok::pages.content.type')); }}
                {{ Form::select('content_type', $contentTypes, $page->content_type , array('class' => 'form-control')); }}
            </div>
            <div class="form-group">
                {{ Form::label('publish', trans('pageblok::pages.publish')); }}
                {{ Form::select('published', array('1' => trans('pageblok::pages.yes'), '0' => trans('pageblok::pages.no')), $page->published , array('class' => 'form-control')); }}
            </div>

            <div class="form-group">
                {{ Form::label('css_classes', trans('pageblok::pages.stylesheet')); }}
                {{ Form::text('css_classes', $page->css_classes, array('class' => 'form-control', 'placeholder' => trans('pageblok::pages.stylesheet'))); }}
            </div>
            <div class="form-group">
                {{ Form::label('image_ref', trans('pageblok::pages.image')); }}
                <div class="image-preview">
                    @if($page->image_ref)
                        <img class="img-thumbnail center" src="{{ $page->image_ref }}" />
                    @endif
                </div>
                @if($page->image_ref)
                    <input type="hidden" name="remove_image" id="remove_image" value="0" />
                @endif
                <a href="javascript:void(0);" @if(!$page->image_ref) style="display: none;" @endif class="btn btn-danger btn-block img-remove" title="{{ trans("pageblok::pages.file.remove") }}">{{ trans("pageblok::pages.file.remove") }}</a>
                <span class="btn btn-default btn-block btn-file">
                    {{ trans('pageblok::pages.file.upload') }}<input type="file" id="image_ref" name="image_ref" />
                </span>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}
@stop
