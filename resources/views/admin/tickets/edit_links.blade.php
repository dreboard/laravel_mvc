
<ul class="nav nav-pills">
    <li class="nav-item">
        <a class="nav-link  @if(Route::currentRouteName() == 'ticket_view') active @endif" href="{{ route('ticket_view', ['id' => $ticket->id]) }}">View</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Route::currentRouteName() == 'ticket_edit') active @endif" href="{{ route('ticket_edit', ['id' => $ticket->id]) }}">Edit</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Route::currentRouteName() == 'ticket_files') active @endif" href="{{ route('ticket_view', ['id' => $ticket->id]) }}">Files</a>
    </li>
</ul>