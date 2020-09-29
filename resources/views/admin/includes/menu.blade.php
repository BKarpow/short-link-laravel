<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">Admin Panel</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/admin/') }}">Головна <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">На сайт</a>
            </li>

            <li class="nav-item">
                <a href="{{route('configs')}}" title="Налаштування" class="nav-link">
                    <i class="fas fa-cogs"></i>
                </a>
                <!-- /.nav-link -->
            </li>
            <!-- /.nav-item -->

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCat" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Категорії
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownCat">
                    <a class="dropdown-item" href="{{ route('list-all-category') }}">Всі</a>
                    <a class="dropdown-item" href="{{ route('create-category') }}">Створити нову</a>

                    <div class="dropdown-divider"></div>
{{--                    <a class="dropdown-item" href="#">Доступ до API</a>--}}
                </div>
            </li>


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPost" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Статті
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownPost">
                    <a class="dropdown-item" href="{{ route('create-post') }}">Створити статтю</a>
                    <a class="dropdown-item" href="{{ route('list-all-post') }}">Всі статті</a>

                    <div class="dropdown-divider"></div>
                    {{--                    <a class="dropdown-item" href="#">Доступ до API</a>--}}
                </div>
            </li>


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMedia" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Медіа
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMedia">
                    <a class="dropdown-item" href="{{ route('media-add') }}">Додати</a>

                    <div class="dropdown-divider"></div>

                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle"
                   href="#" id="navbarDropdownTags"
                   role="button"
                   data-toggle="dropdown"
                   aria-haspopup="true"
                   aria-expanded="false">
                    Мітки
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownTags">
                    <a class="dropdown-item" href="{{ route('tags.all') }}">Всі мітки</a>

                    <div class="dropdown-divider"></div>

                </div>
            </li>


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Токени API
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('create-token') }}">Створити новий</a>
                    <a class="dropdown-item" href="{{ route('show-tokens') }}">Мої токени</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Сторінки
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('create-page') }}">Створити нову</a>
                    <a class="dropdown-item" href="{{ route('list-all-page') }}">Всі сторінки</a>
                </div>
            </li>

        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>
