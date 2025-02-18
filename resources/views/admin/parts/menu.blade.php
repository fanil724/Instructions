<ul class="navbar-nav me-auto">

    <li class="nav-item">
        <a class="nav-link @if (Route::is('home')) active @endif" href="{{ route('home') }}">Главная</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if (Route::is('admin.index')) active @endif" href="{{ route('admin.index') }}">Главная
            Админка</a>
    </li>

    <li class="nav-item">
        <a class="nav-link @if (Route::is('admin.users.index')) active @endif"
            href="{{ route('admin.users.index') }}">Пользователи</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if (Route::is('admin.instructions.index')) active @endif"
            href="{{ route('admin.instructions.index') }}">Проверка
            инструкции</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if (Route::is('admin.complaint.index')) active @endif"
            href="{{ route('admin.complaint.index') }}">Жалобы</a>
    </li>

</ul>