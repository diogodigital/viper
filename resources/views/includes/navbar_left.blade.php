<nav id="navbarContent" class="page__navbar">
    <div class="navbar_menu_list">
        <ul id="nav_accordion" class="navbar_list sidebar nav flex-column">
            <li class="navbar_list_links mb-3">
                <a href="" class="btn btn-success text-white font-bold btn-gains">
                    Ganhe R$ 50 grátis
                    <i class="fa-light fa-rocket-launch "></i>
                </a>
            </li>

            <li class="navbar_list_links">
                <a href="{{ url('/') }}" title="Visão Geral" class="{{ Request::is('/') ? 'active-sidebar' : '' }}">
                    <img src="{{ asset('/assets/images/svg/home2.svg') }}" alt="" width="24">
                    Visão geral
                </a>
            </li>

            <li class="navbar_list_links">
                <a href="{{ url('painel/affiliates') }}" title="Menu de Afiliado" class="{{ request()->routeIs('panel.affiliates.index') ? 'active-sidebar' : '' }}">
                    <img src="{{ asset('/assets/images/svg/affiliate.svg') }}" alt="" width="24">
                    Menu de Afiliado
                </a>
            </li>

            <li class="navbar_list_links">
                <a href="{{ url('/como-funciona') }}" title="Como funciona?" class="{{ Request::is('/como-funciona') ? 'active-sidebar' : '' }}">
                    <img src="{{ asset('assets/images/svg/about.svg') }}" alt="" width="24">
                    Como funciona?
                </a>
            </li>
            <li class="navbar_list_links">
                <a href="{{ url('/suporte') }}" title="Suporte" class="{{ Request::is('/suporte') ? 'active-sidebar' : '' }}">
                    <img src="{{ asset('assets/images/svg/suporte.svg') }}" alt="" width="24">
                    Suporte
                </a>
            </li>
            <li class="navbar_list_links">
                <a href="{{ url('/sobre-nos') }}" title="Sobre Nós" class="{{ Request::is('/sobre-nos') ? 'active-sidebar' : '' }}">
                    <img src="{{ asset('assets/images/svg/sobre.svg') }}" alt="" width="24">
                    Sobre Nós
                </a>
            </li>

            @if(\App\Models\GameExclusive::count() > 0)
                <li class="nav-item has-submenu">
                    <a class="nav-link nav-menu" href="#">
                        CASSINO
                        <i class="fas fa-chevron-up nav-link-menu-icon"></i>
                    </a>
                    <ul class="submenu collapse show">
                        @foreach(\App\Models\GameExclusive::limit(5)->orderBy('views', 'desc')->where('active', 1)->get() as $gameExclusive)
                            <li><a class="nav-link" href="{{ route('web.vgames.show', ['game' => $gameExclusive->uuid]) }}">  <img src="{{ asset('storage/'.$gameExclusive->icon) }}" alt="" width="24" class="mr-2"> {{ $gameExclusive->name }} </a></li>
                        @endforeach
                    </ul>
                </li>
            @endif

            @if(\App\Models\Category::count() > 0)
                <li class="nav-item has-submenu">
                    <a class="nav-link nav-menu" href="#">
                        CATEGORIAS
                        <i class="fas fa-chevron-up nav-link-menu-icon"></i>
                    </a>
                    <ul class="submenu collapse show">
                        @foreach(\App\Models\Category::all() as $category)
                            <li>
                                <a class="nav-link" href="{{ route('web.category.index', ['slug' => $category->slug]) }}">
                                    <img src="{{ asset('storage/'.$category->image) }}" alt="{{ $category->name }}" width="24" class="mr-2">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</nav>
