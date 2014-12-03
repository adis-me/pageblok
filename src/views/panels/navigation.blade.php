<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('app.admin.dashboard') }}">{{ trans('pageblok::app.appname') }}</a>
        </div>
        @if (\Navigation::hasItems())
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
            @foreach(\Navigation::items() as $item)
                {{-- since we eager load children we just access the property children --}}
                @if ($item->children->isEmpty())
                <li class="@if (Route::currentRouteNamed($item->route_name)) active @endif">
                    <a href="{{ $item->href }}">
                        @if ($item->css_classes)
                            <i class="{{ $item->css_classes }}"></i>
                        @endif
                        {{ $item->name }}</a>
                </li>
                @else
                 <li class="dropdown @if (Route::currentRouteNamed($item->route_name)) active @endif">
                    <a href="{{ $item->href }}" class="dropdown-toggle" data-toggle="dropdown">{{ $item->name }} <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                    @foreach($item->children()->getResults() as $childItem)
                    <li class="@if (Route::currentRouteNamed($childItem->route_name)) active @endif">
                        <a href="{{ $childItem->href }}">
                            @if ($item->css_classes)
                                <i class="{{ $item->css_classes }}"></i>
                            @endif
                            {{ $childItem->name }}
                        </a>
                    </li>
                    @endforeach
                    </ul>
                 </li>
                @endif
            @endforeach
            </ul>

            @if (\Auth::check())
            <ul class="nav navbar-nav pull-right">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ \Auth::user()->getFullName() }} <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <!-- <li class="divider"></li> -->
                    <li>{{ link_to_route('app.session.logout', trans('pageblok::app.user.logout')) }}</li>
                  </ul>
                </li>
            </ul>
            @endif
        </div>
        <!--/.nav-collapse -->
        @endif
    </div>
</div>