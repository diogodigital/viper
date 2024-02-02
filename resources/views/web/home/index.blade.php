@extends('layouts.web')

@section('title', config('setting')['software_name'].' - Cassino Online | Jogos de Slot e Apostas em Futebol')

@section('seo')
    <link rel="canonical" href="{{ url()->current() }}" />
    <meta name="description" content="Bem-vindo à {{ config('setting')['software_name'] }} - o melhor cassino online com uma ampla seleção de jogos de slot, apostas em jogos de futebol e uma experiência de aposta fácil e divertida. Jogue Fortune Tiger, Fortune OX e muito mais!">
    <meta name="keywords" content="{{ config('setting')['software_name'] }}, cassino online, jogos de slot, apostas em futebol, Fortune Tiger, Fortune OX">

    <meta property="og:locale" content="pt_BR" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ config('setting')['software_name'] }} - Apostas Online | Jogos de Slot e Apostas em Futebol" />
    <meta property="og:description" content="Bem-vindo à {{ config('setting')['software_name'] }} - o melhor cassino online com uma ampla seleção de jogos de slot, apostas em jogos de futebol e uma experiência de aposta fácil e divertida. Jogue Fortune Tiger, Fortune OX e muito mais!" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="{{ config('setting')['software_name'] }} - Apostas Online | Jogos de Slot e Apostas em Futebol" />
    <meta property="og:image" content="{{ asset('/assets/images/banner-1.png') }}" />
    <meta property="og:image:secure_url" content="{{ asset('/assets/images/banner-1.png') }}" />
    <meta property="og:image:width" content="1024" />
    <meta property="og:image:height" content="571" />

    <meta name="twitter:title" content="{{ config('setting')['software_name'] }} - Apostas Online | Jogos de Slot e Apostas em Futebol">
    <meta name="twitter:description" content="Bem-vindo à {{ config('setting')['software_name'] }} - o melhor cassino online com uma ampla seleção de jogos de slot, apostas em jogos de futebol e uma experiência de aposta fácil e divertida. Jogue Fortune Tiger, Fortune OX e muito mais!">
    <meta name="twitter:image" content="{{ asset('/assets/images/banner-1.png') }}"> <!-- Substitua pelo link da imagem que deseja exibir -->
    <meta name="twitter:url" content="{{ url('/') }}"> <!-- Substitua pelo link da sua página -->
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/splide-core.min.css') }}">
@endpush

@section('content')
    <div class="container-fluid">

        <div class="">
            @include('includes.navbar_top')
            @include('includes.navbar_left')

            <div class="page__content">
                <section id="image-carousel" class="splide" aria-label="">
                    <div class="splide__track">
                        <div class="splide-banner">
                            Ganhe 10 rodadas grátis <span style="margin-left: 10px"><i class="fa-solid fa-fire"></i></span>
                        </div>
                        <ul class="splide__list">
                            @foreach(\App\Models\Banner::where('type', 'carousel')->get() as $banner)
                                <li class="splide__slide">
                                    <a href="{{ $banner->link }}">
                                        <img src="{{ asset('storage/'.$banner->image) }}" alt="">
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </section>

                <!-- Search -->
                <form action="{{ url('/') }}" method="GET">
                    <div class="input-group input-search-group">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Digite o que você procura..." aria-label="Pesquisar" aria-describedby="basic-addon2">
                        <span class="input-group-text" id="basic-addon2"><i class="fa-duotone fa-magnifying-glass"></i> </span>
                    </div>
                </form>


                <!-- Jogos da plataforma -->
                @if(count($gamesExclusives) > 0)
                    <div class="mt-5">
                        @include('includes.title', ['link' => url('/games?tab=exclusives'), 'title' => 'Jogos da Casa', 'icon' => 'fa-regular fa-gamepad-modern'])
                    </div>

                    <div class="row row-cols-3 row-cols-md-6 mt-3">
                        @foreach(\App\Models\Banner::where('type', 'home')->get() as $banner)
                            <div class="col">
                                <a href="{{ $banner->link }}"><img src="{{ asset('storage/'.$banner->image) }}" alt="" class="img-fluid rounded-4 w-full"></a>
                            </div>
                        @endforeach
                    </div>

                    <div class="d-steam-cards js-steamCards">
                        @foreach($gamesExclusives as $gamee)
                            <a href="{{ route('web.vgames.show', ['game' => $gamee->uuid]) }}" class="d-steam-card-wrapper">
                                <div class="d-steam-card js-steamCard" style="background-image: url('storage/{{ $gamee->cover }}')"></div>
                            </a>
                        @endforeach
                    </div>
                @endif

                <br>
                <br>

                @if(count($providers) > 0)
                    @foreach($providers as $provider)
                        @include('includes.title', ['link' => url('/games?provider='.$provider->code.'&tab=fivers'), 'title' => $provider->name, 'icon' => 'fa-duotone fa-gamepad-modern'])

                        <div class="row row-cols-3 row-cols-md-6 mt-3">
                            @foreach($provider->games->where('status', 1) as $gameProvider)
                                <div class="col mb-3">
                                    <a href="{{ route('web.fivers.show', ['code' => $gameProvider->game_code]) }}" class="">
                                        <img src="{{ asset('storage/'.$gameProvider->banner) }}" alt="{{ $gameProvider->game_name }}" class="w-full rounded-3">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                @endif

                <!-- Slotegrator -->
                @if(count($games) > 0)
                    @include('includes.title', ['link' => url('/games?tab=all'), 'title' => 'Todos os Jogos', 'icon' => 'fa-duotone fa-gamepad-modern'])

                    <div class="row row-cols-3 row-cols-md-6 mt-3">
                        @foreach($games as $game)
                            <div class="col caixa-loop-elementos">
                                <a href="{{ route('web.game.index', ['slug' => $game->slug]) }}" class="inner-loop-elementos">
                                    <img src="{{ asset('storage/'.$game->image) }}" alt="{{ $game->name }}" class="img-fluid rounded-3">
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif

                <br>

                @if(count($gamesVibra) > 0)
                    @include('includes.title', ['link' => url('/games?tab=vibra'), 'title' => 'Jogos Vibra', 'icon' => 'fa-duotone fa-gamepad-modern'])

                    <div class="row row-cols-3 row-cols-md-6 mt-3">
                        @foreach($gamesVibra as $vibra)
                            <div class="col mb-3">
                                <a href="{{ route('web.vibragames.show', ['id' => $vibra->game_id]) }}" class="inner-loop-elementos">
                                    <img src="{{ asset('storage/'.$vibra->game_cover) }}" alt="{{ $vibra->name }}" class="img-fluid rounded-3">
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="mt-5">
                    @include('includes.title', ['link' => url('como-funciona'), 'title' => 'F.A.Q', 'icon' => 'fa-light fa-circle-info', 'labelLink' => 'Saiba mais'])
                </div>

                @include('web.home.sections.faq')

                @include('includes.footer')

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/splide.min.js') }}"></script>
    <script>
        document.addEventListener( 'DOMContentLoaded', function () {
            var elemento = document.getElementById('splide-soccer');

            if (elemento) {
                new Splide( '#splide-soccer', {
                    type   : 'loop',
                    drag   : 'free',
                    focus  : 'center',
                    autoplay: 'play',
                    perPage: 3,
                    arrows: false,
                    pagination: false,
                    breakpoints: {
                        640: {
                            perPage: 1,
                        },
                    },
                    autoScroll: {
                        speed: 1,
                    },
                }).mount();
            }

            new Splide( '#image-carousel', {
                arrows: false,
                pagination: false,
                type    : 'loop',
                autoplay: 'play',
            }).mount();
        } );
    </script>
@endpush
