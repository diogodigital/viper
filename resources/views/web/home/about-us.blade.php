@extends('layouts.web')

@section('title', 'Sobre Nós - Cassino Online | Jogos de Slot e Apostas em Futebol')

@section('seo')
    <link rel="canonical" href="{{ url()->current() }}" />
    <meta name="description" content="Bem-vindo à {{ config('setting')['software_name'] }} - o melhor cassino online com uma ampla seleção de jogos de slot, apostas em jogos de futebol e uma experiência de aposta fácil e divertida. Jogue Fortune Tiger, Fortune OX e muito mais!">
    <meta name="keywords" content="{{ config('setting')['software_name'] }}, cassino online, jogos de slot, apostas em futebol, Fortune Tiger, Fortune OX">

    <meta property="og:locale" content="pt_BR" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Sobre Nós - Apostas Online | Jogos de Slot e Apostas em Futebol" />
    <meta property="og:description" content="Bem-vindo à {{ config('setting')['software_name'] }} - o melhor cassino online com uma ampla seleção de jogos de slot, apostas em jogos de futebol e uma experiência de aposta fácil e divertida. Jogue Fortune Tiger, Fortune OX e muito mais!" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="Sobre Nós - Apostas Online | Jogos de Slot e Apostas em Futebol" />
    <meta property="og:image" content="{{ asset('/assets/images/banner-1.png') }}" />
    <meta property="og:image:secure_url" content="{{ asset('/assets/images/banner-1.png') }}" />
    <meta property="og:image:width" content="1024" />
    <meta property="og:image:height" content="571" />

    <meta name="twitter:title" content="Sobre Nós - Apostas Online | Jogos de Slot e Apostas em Futebol">
    <meta name="twitter:description" content="Bem-vindo à {{ config('setting')['software_name'] }} - o melhor cassino online com uma ampla seleção de jogos de slot, apostas em jogos de futebol e uma experiência de aposta fácil e divertida. Jogue Fortune Tiger, Fortune OX e muito mais!">
    <meta name="twitter:image" content="{{ asset('/assets/images/banner-1.png') }}"> <!-- Substitua pelo link da imagem que deseja exibir -->
    <meta name="twitter:url" content="{{ url('/') }}"> <!-- Substitua pelo link da sua página -->
@endsection


@push('styles')

@endpush

@section('content')
    <div class="container-fluid">
        @include('includes.navbar_top')
        @include('includes.navbar_left')

        <div class="page__content">
            <br>

            <div class="about-us-description">
                <div class="about-us-img">
                    <img src="{{ asset('/assets/images/sobre-nos.png') }}" alt="" class="img-fluid">
                </div>
                <p>
                    Bem-vindo à <strong>{{ config('setting')['software_name'] }}</strong>: sua porta de entrada para um mundo emocionante de entretenimento e apostas online!
                    Somos uma renomada empresa de cassino online, oferecendo uma vasta gama de jogos divertidos,
                    desde caça-níqueis fascinantes até apostas eletrizantes em jogos de futebol. Nossa missão é proporcionar aos nossos jogadores
                    uma experiência de jogo imersiva, simples e repleta de oportunidades para grandes vitórias.
                </p>
                <p>
                    Nosso cassino online apresenta um ambiente virtual seguro e confiável, onde os jogadores podem se deliciar com uma variedade de jogos de slot temáticos, repletos de cores vibrantes
                    e gráficos de alta qualidade. Entre os títulos mais populares, destacam-se "Fortune Tiger" e "Fortune OX", que oferecem uma dose generosa de diversão
                    e chances de ganhar prêmios incríveis.
                </p>
                <p>
                    Além dos jogos de slot, na <strong>{{ config('setting')['software_name'] }}</strong>, os amantes do futebol encontram um espaço especial para suas apostas. Apostar em jogos de futebol nunca foi tão fácil e emocionante.
                    Nossa plataforma oferece uma interface intuitiva, permitindo que os usuários naveguem e realizem suas apostas de forma rápida e eficiente, tornando a experiência de
                    apostar em seus times favoritos uma verdadeira diversão.
                </p>
                <p>
                    O grande diferencial da <strong>{{ config('setting')['software_name'] }}</strong> é o nosso sistema de apostas, projetado para proporcionar uma experiência fácil e sem complicações. Valorizamos a simplicidade, sem sacrificar a
                    qualidade e a emoção que cada jogador merece. Nosso compromisso é garantir que todos os nossos usuários tenham acesso a jogos justos e transparentes,
                    promovendo um ambiente de jogo responsável.
                </p>

                <p>
                    Na <strong>{{ config('setting')['software_name'] }}</strong>, acreditamos que a diversão é a chave para uma experiência de cassino online memorável. Venha se juntar a nós e descubra o emocionante mundo dos jogos
                    de azar e apostas esportivas. Sua sorte está à espera em cada giro e em cada aposta - aproveite ao máximo a sua jornada conosco!
                </p>
            </div>
        </div>
    </div>
@endsection

@push('styles')

@endpush
