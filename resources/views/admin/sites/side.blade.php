<div class="col-3">
    <div class="list-group">
        <a class="list-group-item list-group-item-action @if(Route::currentRouteName() == 'site_view') active @endif"
           href="{{route('site_view', ['id' => $siteInfo->id])}}">
            Overview
        </a>
        <a class="list-group-item list-group-item-action @if(Route::currentRouteName() == 'site_view') active @endif"
           href="{{route('site_calendar', ['id' => $siteInfo->id])}}">
            Edit
        </a>
        <a class="list-group-item list-group-item-action @if(Route::currentRouteName() == 'site_projects') active @endif"
           href="{{route('site_projects', ['id' => $siteInfo->id])}}">
            Projects
        </a>
        <a class="list-group-item list-group-item-action @if(Route::currentRouteName() == 'site_calendar') active @endif"
           href="{{route('site_calendar', ['id' => $siteInfo->id])}}">
            Calendar
        </a>
        <a class="list-group-item list-group-item-action @if(Route::currentRouteName() == 'site_view') active @endif"
           href="{{route('site_calendar', ['id' => $siteInfo->id])}}">
            Notes
        </a>
    </div>
</div>