@extends('layouts.web')

@section('title', 'Como funciona? - Cassino Online | Jogos de Slot e Apostas em Futebol')

@section('seo')
    <link rel="canonical" href="{{ url()->current() }}" />
    <meta name="description" content="Bem-vindo à {{ config('setting')['software_name'] }} - o melhor cassino online com uma ampla seleção de jogos de slot, apostas em jogos de futebol e uma experiência de aposta fácil e divertida. Jogue Fortune Tiger, Fortune OX e muito mais!">
    <meta name="keywords" content="Apostas esportivas, Apostas em futebol, Prognósticos de futebol, Dicas de apostas, Odds de futebol, Melhores sites de apostas, Liga de futebol, Campeonato de futebol, Apostas ao vivo, Futebol online, Apostas em tempo real, Estratégias de apostas, Apostas esportivas online, Bônus de apostas, Sites de apostas confiáveis, Guia de apostas esportivas, Melhores apostas do dia, Mercados de apostas, Futebol internacional, Aposta acumulada">

    <meta property="og:locale" content="pt_BR" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Como funciona? - Apostas Online | Jogos de Slot e Apostas em Futebol" />
    <meta property="og:description" content="Bem-vindo à {{ config('setting')['software_name'] }} - o melhor cassino online com uma ampla seleção de jogos de slot, apostas em jogos de futebol e uma experiência de aposta fácil e divertida. Jogue Fortune Tiger, Fortune OX e muito mais!" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="Como funciona? - Apostas Online | Jogos de Slot e Apostas em Futebol" />
    <meta property="og:image" content="{{ asset('/assets/images/banner-1.png') }}" />
    <meta property="og:image:secure_url" content="{{ asset('/assets/images/banner-1.png') }}" />
    <meta property="og:image:width" content="1024" />
    <meta property="og:image:height" content="571" />

    <meta name="twitter:title" content="Como funciona? - Apostas Online | Jogos de Slot e Apostas em Futebol">
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

            <div class="how-works">
                <h2 class="mt-5">Perguntas frequentes - {{ config('setting')['software_name'] }}</h2>

                <div class="mt-4">
                    <h4>Check-in</h4>
                    <p><strong>Como posso me cadastrar neste site?</strong></p>
                    <p>Para se registrar em nosso site, acesse a seção "Cadastro" no canto superior direito. Siga atentamente os requisitos de registro apresentados para evitar complicações futuras. Recomendamos que você se familiarize com nossas regras com antecedência.</p>

                    <!-- ... outras perguntas e respostas ... -->

                    <h4>Apostas e Resolução</h4>
                    <p><strong>Como faço uma aposta?</strong></p>
                    <p>Primeiro, faça login com seu nome de usuário e senha. Escolha uma ou mais apostas de nosso Livro de Apostas e selecione um dos resultados previstos. Sua aposta aparecerá no boletim de apostas à direita. Em seguida, indique o valor que deseja apostar e o tipo de aposta preferido (simples, múltipla ou sistema). Na última etapa, confirme a aposta ou cancele-a. Observe que nossos Termos e Condições Gerais não permitem o cancelamento de apostas após a confirmação.</p>

                    <!-- ... outras perguntas e respostas ... -->

                    <h4>Apostas</h4>
                    <p><strong>Como faço para criar uma conta no site?</strong></p>
                    <p>Jogar nos cassinos oferecidos pelo <strong>{{ config('setting')['software_name'] }}</strong> requer uma conta no site. Se você ainda não tem uma, basta clicar no botão "Inscrever-se" na página de Apostas e seguir o processo de registro.</p>

                    <!-- ... outras perguntas e respostas ... -->
                </div>
            </div>

        </div>
    </div>
@endsection

@push('styles')

@endpush
