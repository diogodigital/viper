@extends('layouts.web')

@section('title', $game->game_name . ' - Cassino Online | Jogos de Slot e Apostas em Futebol')

@section('seo')
    <link rel="canonical" href="{{ url()->current() }}" />
    <meta name="description" content="{{ $game->game_name }}">
    <meta name="keywords" content="Apostas esportivas, Apostas em futebol, Prognósticos de futebol, Dicas de apostas, Odds de futebol, Melhores sites de apostas, Liga de futebol, Campeonato de futebol, Apostas ao vivo, Futebol online, Apostas em tempo real, Estratégias de apostas, Apostas esportivas online, Bônus de apostas, Sites de apostas confiáveis, Guia de apostas esportivas, Melhores apostas do dia, Mercados de apostas, Futebol internacional, Aposta acumulada">

    <meta property="og:locale" content="pt_BR" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $game->game_name }}" />
    <meta property="og:description" content="Bem-vindo à {{ config('setting')['software_name'] }} - o melhor cassino online com uma ampla seleção de jogos de slot, apostas em jogos de futebol e uma experiência de aposta fácil e divertida. Jogue Fortune Tiger, Fortune OX e muito mais!" />
    <meta property="og:url" content="{{ url()->current() }}" />

    <meta property="og:site_name" content="{{ $game->game_name . ' - Cassino Online | Jogos de Slot e Apostas em Futebol' }}" />
    <meta property="og:image" content="{{ asset('/storage/' . $game->banner) }}" />
    <meta property="og:image:secure_url" content="{{ asset('/storage/' . $game->banner) }}" />
    <meta property="og:image:width" content="1024" />
    <meta property="og:image:height" content="571" />

    <meta name="twitter:title" content="{{ $game->game_name }}">
    <meta name="twitter:description" content="{{ $game->game_name }}">
    <meta name="twitter:image" content="{{ asset('/storage/' . $game->banner) }}"> <!-- Substitua pelo link da imagem que deseja exibir -->
    <meta name="twitter:url" content="{{ url('/') }}"> <!-- Substitua pelo link da sua página -->
@endsection

@push('styles')

@endpush

@section('content')
    <div class="playgame">
        <div class="playgame-body">
            <iframe src="{{ $gameUrl }}" class="game-full"></iframe>
        </div>
        <div class="action-buttons" style="position: absolute;top: 10px;left: 10px;">
            <a href="{{ url('/') }}" class="w-button btn-small">
                <i class="fa-regular fa-arrow-left mr-3"></i> Fechar
            </a>
        </div>
    </div>

    @include('includes.deposit')
@endsection

@push('scripts')
    <script>

    </script>
@endpush
