@extends('layouts.web')

@push('styles')

@endpush

@section('content')
    <div class="container-fluid">
        @include('includes.navbar_top')
        @include('includes.navbar_left')

        <div class="page__content">
            @if(auth()->user()->affiliate_revenue_share == 0 && auth()->user()->affiliate_cpa == 0)
                <section class="affiliate-block">
                    <div class="affiliate-block-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <img src="{{ asset('/assets/images/business_afiliado.png') }}" alt="" class="img-fluid">
                            </div>
                            <div class="col-lg-8">
                                <div class="affiliate-info my-3">
                                    <h1>SAIBA MAIS SOBRE NOSSO <span>PROGRAMA DE AFILIADOS</span></h1>
                                    <p>
                                        Trabalhe conosco como afiliado e obtenha lucros significativos por meio de suas indicações.
                                        Oferecemos condições especiais exclusivas para nossos afiliados.
                                    </p>
                                    <form action="{{ route('panel.affiliates.join') }}" method="post">
                                        @csrf
                                        <div class="input-group mb-3 mt-3">
                                            <input type="text" name="email" class="form-control" placeholder="Digite seu email" aria-label="Seu e-mail" aria-describedby="affiliate-mail">
                                            <button type="submit" class="input-group-text" id="affiliate-mail"><span class="mx-2">Enviar agora</span> <i class="fa-solid fa-envelope"></i></button>
                                        </div>
                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="affiliate-faq">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Como funciona o sistema de referência?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>
                                        Quando você compartilha seu link de referência com qualquer um de seus amigos, familiares ou anuncia o link e um jogador se inscreve em nosso site,
                                        esse jogador se torna sua referência e ganhará comissões e recompensas extras jogando na <strong>{{ config('setting')['software_name'] }}</strong>.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Quanto posso ganhar com a minha indicação?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Na <strong>{{ config('setting')['software_name'] }}</strong>, você pode ganhar uma porcentagem através de indicações, obtendo lucros tanto com as transações da casa quanto com as pessoas que você recomendar.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Posso ver os dados do meu referido?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Sim, {{ config('setting')['software_name'] }} acredita em total transparência e oferece todos os dados para os usuários como nome de usuário, aposta que fizeram, comissões que você obteve,
                                    quando se registraram, qual link foi usado. Tudo em seu <a href="/painel/affiliates" style="color: #3BC117">Painel de afiliados</a>.
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @else
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <h2 class=" mb-0">SISTEMA DE AFILIADOS</h2>
                                <p class="mb-0">Indique um amigo e ganhe até {{auth()->user()->affiliate_revenue_share}}% de Revenue Share.</p>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="mt-2">
                                    <div class="input-group mb-3">
                                        <input type="text" id="urlInput" class="form-control" placeholder="" aria-label="" aria-describedby="basic-copy" value="{{ url('/?action=register&affiliate='.$token) }}">
                                        <span class="input-group-text" id="basic-copy">
                                            <a href="#" class="text-green action-copy" onclick="copyToClipboard()">
                                                <i class="fa-regular fa-copy" style="margin-right: 10px;"></i> <span class="ml-2">COPIAR</span>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <div class="card card-primary">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6" style="align-self: center;text-align-last: center;">
                                                <button data-izimodal-open="#affiliate-withdrawal" data-izimodal-zindex="20000" data-izimodal-preventclose="" class="btn-primary-theme btn-block w-full text-white">
                                                    Resgatar
                                                </button>
                                            </div>
                                            <div class="col-lg-6 text-right">
                                                <h1 class="text-money">{{ \Helper::amountFormatDecimal(auth()->user()->wallet->refer_rewards) }}</h1>
                                                <p>GANHOS DISPONÍVEIS</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card card-secundary">
                                    <div class="card-body">
                                        <h1 class="text-money">{{ auth()->user()->affiliate_revenue_share }}%</h1>
                                        <p>REVENUE SHARE</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card card-secundary">
                                    <div class="card-body">
                                        <h1 class="text-money">{{ \Helper::amountFormatDecimal(auth()->user()->affiliate_cpa) }}</h1>
                                        <p>POR CPA</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="wallet-transactions mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">HISTÓRICO DE INDICADOS</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Data</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($indications))
                                        @foreach($indications as $indication)
                                            <tr>
                                                <th scope="row">{{ $indication->name }}</th>
                                                <td>{{ $indication->dateHumanReadable }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="flex items-center justify-center text-center py-4" colspan="5">
                                                <h4 class=" mb-0">NENHUMA INFORMAÇÃO A EXIBIR</h4>
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>

                            @if($indications->hasPages())
                                <div class="mt-5">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="" style="padding: 0 20px;">
                                                {{ $indications->links() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>


                <div class="wallet-transactions mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">HISTÓRICO CPA</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover mb-0">
                                    <thead class="table-dark">
                                    <tr>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Comissão Paga</th>
                                        <th scope="col">Fez Deposito?</th>
                                        <th scope="col">Data</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($histories))
                                        @foreach($histories->where('commission_type', 'cpa') as $history)
                                            <tr>
                                                <th scope="row">{{ $history->user->name }}</th>
                                                <td>{{ \Helper::amountFormatDecimal($history->commission_paid) }}</td>
                                                <td>
                                                    <span class="badge bg-primary">{{ $history->status }}</span>
                                                </td>
                                                <td>{{ $history->dateHumanReadable }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="flex items-center justify-center text-center py-4" colspan="5">
                                                <h4 class=" mb-0">NENHUMA INFORMAÇÃO A EXIBIR</h4>
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>

                            @if($histories->hasPages())
                                <div class="mt-5">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="" style="padding: 0 20px;">
                                                {{ $histories->links() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="wallet-transactions mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">HISTÓRICO REVSHARE</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover mb-0">
                                    <thead class="table-dark">
                                    <tr>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Comissão Paga</th>
                                        <th scope="col">Tipo</th>
                                        <th scope="col">Valor em Perdas</th>
                                        <th scope="col">Total de Perdas</th>
                                        <th scope="col">Fez Deposito?</th>
                                        <th scope="col">Data</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($histories))
                                            @foreach($histories->where('commission_type', 'revshare') as $history)
                                                <tr>
                                                    <th scope="row">{{ $history->user->name }}</th>
                                                    <td>{{ \Helper::amountFormatDecimal($history->commission_paid) }}</td>
                                                    <td>{{ $history->commission_type }}</td>
                                                    <td>{{ $history->losses }}</td>
                                                    <td>{{ \Helper::amountFormatDecimal($history->losses_amount) }}</td>
                                                    <td>
                                                        <span class="badge bg-primary">{{ $history->status }}</span>
                                                    </td>
                                                    <td>{{ $history->dateHumanReadable }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="flex items-center justify-center text-center py-4" colspan="5">
                                                    <h4 class=" mb-0">NENHUMA INFORMAÇÃO A EXIBIR</h4>
                                                </td>
                                            </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>

                            @if($histories->hasPages())
                                <div class="mt-5">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="" style="padding: 0 20px;">
                                                {{ $histories->links() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            @endif
        </div>

        <div id="affiliate-withdrawal" class="iziModal" data-izimodal-loop="">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div id="loadingAffiliateWithdrawal" class="loading-spinner">
                        <span class="spinner"></span>
                    </div>

                    <div class="affiliate-withdrawal-container">
                        <div class="affiliate-withdrawal-body">
                            <p>Ao confirmar, você estará autorizando a transferência da sua comissão para a sua carteira, possibilitando o saque dos seus ganhos. Deseja proceder com essa ação?</p>
                        </div>

                        <button class="btn-primary-theme btn-block w-full request-affiliate-withdrawal">
                            SOLICITAR
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $("#affiliate-withdrawal").iziModal({
            title: 'Saque',
            subtitle: 'Vamos sacar nossa comissão',
            icon:'fa-solid fa-money-bill-transfer',
            headerColor: '#1A1C1F',
            theme: 'dark',  // light
            background:  '#202327',
            width: 700,
            closeOnEscape: false,
            overlayClose: false,
            onFullscreen: function(){},
            onResize: function(){},
            onOpening: function(){

            },
            onOpened: function(){
            },
            onClosing: function(){},
            onClosed: function(){

            },
            afterRender: function(){}
        });

        /**
         * Copy to Clipboard
         */
        function copyToClipboard() {
            const input = document.getElementById('urlInput');
            input.select();
            document.execCommand('copy');

            iziToast.show({
                title: 'Sucesso',
                message: 'URL copiada para a área de transferência.',
                theme: 'dark',
                icon: 'fa-solid fa-check',
                iconColor: '#ffffff',
                backgroundColor: '#23ab0e',
                position: 'topRight',
                onClosing: function () {},
                onClosed: function () {

                }
            });
        }

        /**
         * Request Affiliate Withdrawak
         */
        $(document).on('click', '.request-affiliate-withdrawal', function(event) {
            event.preventDefault();

            const loadingElement = document.getElementById('loadingAffiliateWithdrawal');
            loadingElement.style.display = 'block';

            const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;

            fetch('{{ url('painel/affiliates/withdrawal') }}', {
                    method: 'post',
                    body: JSON.stringify({}),
                    headers: {
                        'Content-Type': 'application/json',
                        "X-CSRF-Token": csrfToken
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if(data.status) {

                        iziToast.show({
                            title: 'Sucesso',
                            message: 'A conversão foi concluída com êxito.',
                            theme: 'dark',
                            icon: 'fa-solid fa-check',
                            iconColor: '#ffffff',
                            backgroundColor: '#23ab0e',
                            position: 'topRight',
                            timeout: 1500,
                            onClosing: function () {},
                            onClosed: function () {
                                $("#affiliate-withdrawal").iziModal('close');
                                setTimeout(function() {
                                    window.location.replace('{{ url('/painel/wallet/withdrawals') }}');
                                }, 1000);
                            }
                        });

                        loadingElement.style.display = 'none';
                    }else{
                        if(data.error != undefined) {
                            iziToast.show({
                                title: 'Atenção',
                                message: data.error,
                                theme: 'dark',
                                icon: 'fa-regular fa-circle-exclamation',
                                iconColor: '#ffffff',
                                backgroundColor: '#b51408',
                                position: 'topRight'
                            });
                        }else{
                            Object.entries(data).forEach(([key, value]) => {
                                iziToast.show({
                                    title: 'Atenção',
                                    message: value[0],
                                    theme: 'dark',
                                    icon: 'fa-regular fa-circle-exclamation',
                                    iconColor: '#ffffff',
                                    backgroundColor: '#b51408',
                                    position: 'topRight'
                                });
                            });
                        }

                    }

                    loadingElement.style.display = 'none';
                })
                .catch(error => {
                    loadingElement.style.display = 'none';
                })
                .finally(() => {

                });
        });
    </script>
@endpush
