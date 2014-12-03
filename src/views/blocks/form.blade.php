@extends("pageblok::templates.base")

@section('content')
{{ Form::open(array('route' => array($formRoute, $block->id), 'method' => 'post', 'class' => 'editor-form create-page', 'files' => true )) }}
<div class="border-bottom">
    <div class="container form-group">
        {{ HTML::linkRoute('app.admin.blocks',  trans('pageblok::blocks.cancel'), null, array('class' => 'btn btn-default')) }}
        {{ Form::submit(trans('pageblok::blocks.save'), array('class' => 'btn btn-success')) }}
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-9 padded-top border-right">
            <div class="form-group">
                {{ Form::label('pb_name', trans('pageblok::blocks.system.name')); }}
                {{ Form::text('pb_name', $block->pb_name, array('class' => 'form-control', 'id' => 'title', 'autofocus' => 'autofocus', 'placeholder' => 'Block name')); }}
            </div>
            <div class="form-group">
                {{ Form::label('title', trans('pageblok::blocks.title')); }}
                {{ Form::text('title', $block->title, array('class' => 'form-control', 'placeholder' => trans('pageblok::blocks.title'))); }}
            </div>
            <div class="form-group">
                {{ Form::label('subtitle', trans('pageblok::blocks.subtitle')); }}
                {{ Form::text('subtitle', $block->subtitle, array('class' => 'form-control', 'placeholder' => trans('pageblok::blocks.subtitle'))); }}
            </div>
            <div class="form-group">
                {{ Form::label('description', trans('pageblok::blocks.description')); }}
                {{ Form::textarea('description', $block->description, array('class' => 'form-control', 'placeholder' => trans('pageblok::blocks.description'), 'rows' => 3)); }}
            </div>
            <div class="form-group">
                <textarea class="form-control input-block-level content-editor" name="content" rows="18">{{ $block->content }}</textarea>
            </div>

        </div>
        <div class="col-md-3 padded-top">
            <div class="form-group">
                {{ Form::label('template', trans('pageblok::blocks.template')); }}
                {{ Form::select('template', $templates, $block->template, array('class' => 'form-control')); }}
            </div>
            <div class="form-group">
                {{ Form::label('content_type', trans('pageblok::blocks.content.type')); }}
                {{ Form::select('content_type', $contentTypes, 'html' , array('class' => 'form-control')); }}
            </div>
            <div class="form-group">
                {{ Form::label('publish', trans('pageblok::blocks.publish')); }}
                {{ Form::select('published', array('1' => trans('pageblok::blocks.yes'), '0' => trans('pageblok::blocks.no')), $block->published , array('class' => 'form-control')); }}
            </div>
            <div class="form-group">
                {{ Form::label('group', trans('pageblok::blocks.group')); }}
                {{ Form::text('group', $block->group, array('class' => 'form-control', 'placeholder' => trans('pageblok::blocks.group'))); }}
            </div>
            <div class="form-group">
                {{ Form::label('hyperlink', trans('pageblok::blocks.hyperlink')); }}
                {{ Form::text('hyperlink', $block->hyperlink, array('class' => 'form-control', 'placeholder' => "/" . trans('pageblok::blocks.hyperlink'))); }}
            </div>
            <div class="form-group">
                {{ Form::label('css_classes', trans('pageblok::blocks.stylesheet')); }}
                {{ Form::text('css_classes', $block->css_classes, array('class' => 'form-control', 'placeholder' => trans('pageblok::blocks.stylesheet'))); }}
            </div>
            <div class="form-group">
                {{ Form::label('image_ref', trans('pageblok::blocks.image')); }}
                <div class="image-preview">
                    @if($block->image_ref)
                        <img class="img-thumbnail center" src="{{ $block->image_ref }}" />
                    @endif
                </div>
                @if($block->image_ref)
                    <input type="hidden" name="remove_image" id="remove_image" value="0" />
                @endif
                <a href="javascript:void(0);" @if(!$block->image_ref) style="display: none;" @endif class="btn btn-danger btn-block img-remove" title="{{ trans("pageblok::pageblok.file.remove") }}">{{ trans("pageblok::pageblok.file.remove") }}</a>
                <span class="btn btn-default btn-block btn-file">
                    {{ trans('pageblok::blocks.file.upload') }}<input type="file" id="image_ref" name="image_ref" />
                </span>

            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>
@stop