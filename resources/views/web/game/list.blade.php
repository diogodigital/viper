@extends('layouts.web')

@push('styles')

@endpush

@section('content')
    <div class="container-fluid">
        @include('includes.navbar_top')
        @include('includes.navbar_left')

        <div class="page__content">

            <div class="row">
                <div class="col-lg-6">
                    <h2>Todos os jogos</h2>
                </div>
                <div class="col-lg-6">

                    <form action="{{ route('web.game.list') }}" class="w-full" method="GET">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </span>
                            <input type="text" name="searchTerm" class="form-control" placeholder="Digite o nome do jogo" value="{{ $search }}">

                            <span class="input-group-text" style="padding-right: 5px;">
                                <button type="submit" class="px-4">
                                    Buscar
                                </button>
                            </span>
                        </div>
                        @foreach(request()->except(['searchTerm', 'page']) as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                    </form>

                </div>
            </div>

            <div class="row">
                @if($tab == 'fivers')
                    <div class="d-steam-cards js-steamCards">
                        @foreach($games as $game)
                            <a href="{{ route('web.fivers.show', ['code' => $game->game_code]) }}" class="d-steam-card-wrapper">
                                <div class="d-steam-card js-steamCard" style="background-image: url('storage/{{ $game->banner }}')"></div>
                            </a>
                        @endforeach
                    </div>
                @endif

                @if($tab == 'exclusives')
                    <div class="d-steam-cards js-steamCards">
                        @foreach($games as $gamee)
                            <a href="{{ route('web.vgames.show', ['game' => $gamee->uuid]) }}" class="d-steam-card-wrapper">
                                <div class="d-steam-card js-steamCard" style="background-image: url('storage/{{ $gamee->cover }}')"></div>
                            </a>
                        @endforeach
                    </div>
                @endif

                @if($tab == 'slotegrator')
                    @foreach($games as $game)
                        <div class="col-xl-2 col-lg-2 col-md-3 col-6 caixa-loop-elementos">
                            <a href="{{ route('web.game.index', ['slug' => $game->slug]) }}" class="inner-loop-elementos">
                                <img src="{{ asset('storage/'.$game->image) }}" alt="{{ $game->name }}" class="img-fluid rounded-3">
                            </a>
                        </div>
                    @endforeach
                @endif

                @if($tab == 'vibra')
                    @foreach($games as $vibra)
                        <div class="col-xl-2 col-lg-2 col-md-3 col-6 caixa-loop-elementos">
                            <a href="{{ route('web.vibragames.show', ['id' => $vibra->game_id]) }}" class="inner-loop-elementos">
                                <img src="{{ asset('storage/'.$vibra->game_cover) }}" alt="{{ $vibra->name }}" class="img-fluid rounded-3">
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>

            <br><br>
            <div class="mt-6">
                <div class="col-lg-6"></div>
                <div class="col-lg-6">
                    {{ $games->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
