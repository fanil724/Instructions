<ul class="navbar-nav me-auto">
    <li class="nav-item">
        <a class="nav-link" href="{{route('instructions.index')}}">Инструкции</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('show')}}">О нас</a>
    </li>
    @guest

    @else
        @if (Auth::user()->is_admin)
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.index')}}">Админка</a>
            </li>
        @endif
    @endguest
</ul>