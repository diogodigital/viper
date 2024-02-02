<div class="wallet">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="mb-0"><strong>CARTEIRA</strong></h5>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('panel.wallet.hidebalance') }}" class=" float-end">
                                <i class="fa-regular fa-eye"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="balance">
                        <p class="mb-0">SALDO</p>
                        <h1 class="show_balance">
                            @if(auth()->user()->wallet->hide_balance == 1)
                                ****
                            @else
                                <strong class="text-money">{{ \Helper::amountFormatDecimal(auth()->user()->wallet->balance) }}</strong>
                            @endif
                        </h1>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-6">
                            <small>Bônus</small>
                            <h5>
                                @if(auth()->user()->wallet->hide_balance == 1)
                                    ****
                                @else
                                    <strong class="text-money">{{ \Helper::amountFormatDecimal(auth()->user()->wallet->balance_bonus) }}</strong>
                                @endif
                            </h5>
                        </div>
                        <div class="col-lg-6">
                            <small>Prêmios</small>
                            <h5>
                                @if(auth()->user()->wallet->hide_balance == 1)
                                    ****
                                @else
                                    <strong class="text-money">{{ \Helper::amountFormatDecimal(auth()->user()->wallet->refer_rewards) }}</strong>
                                @endif
                            </h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="d-grid mt-4">
                                <button data-izimodal-open="#deposit-modal" data-izimodal-zindex="20000" data-izimodal-preventclose="" class="btn btn-outline-success" type="button">DEPOSITAR</button>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-grid mt-4">
                                <button @if(!(auth()->user()->wallet->balance > 0)) disabled="disabled" @endif data-izimodal-open="#withdrawal-modal" data-izimodal-zindex="20000" data-izimodal-preventclose="" class="btn btn-success" type="button">SACAR</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <img src="{{ asset('assets/images/pix.png') }}" alt="" class="img-fluid">
        </div>
    </div>
</div>

@include('includes.deposit')

<div id="withdrawal-modal" class="iziModal" data-izimodal-loop="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="loadingWithdrawal" class="loading-spinner">
                <span class="spinner"></span>
            </div>

            <form id="withdrawalForm" method="post" action="" class="form-login">
                @csrf
                <h5 class="font-bold">VALOR DISPONÍVEL</h5>
                <h1 class="mb-3 ">{{ \Helper::amountFormatDecimal(auth()->user()->wallet->balance) }}</h1>

                <h5 class="mb-3 mt-5 font-bold">DIGITE O VALOR PARA SACAR</h5>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="email">
                        <p class="mb-0">R$</p>
                    </span>
                    <input type="number" name="amount" required min="{{ config('setting')->min_withdrawal }}" max="{{ config('setting')->max_withdrawal }}" class="form-control" placeholder="0,00">
                </div>
                <div class="row">
                    <div class="col-lg-8 col-sm-12 mb-3">
                        <input type="text" name="chave_pix" class="form-control" required placeholder="DIGITE SUA CHAVE PIX">
                    </div>
                    <div class="col-lg-4 col-sm-12 mb-3">
                        <select name="tipo_chave" class="form-select " required aria-label="Tipo de chave">
                            <option selected>Tipo de Chave</option>
                            <option value="document">CPF/CNPJ</option>
                            <option value="email">E-mail</option>
                            <option value="phoneNumber">Telefone</option>
                            <option value="randomKey">Chave Aleatória</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <input type="text" name="document" class="form-control cpf" required placeholder="DIGITE SEU CPF">
                    </div>
                </div>
                <div class="alert alert-warning">
                    <p class="mb-0">Certifique-se de selecionar o tipo correto de chave Pix para garantir um saque sem problemas.</p>
                </div>
                <div class="form-check">
                    <input name="accept_terms" required class="form-check-input" type="checkbox" value="1" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        ACEITO OS TERMOS DE TRANSFERÊNCIA
                    </label>
                </div>
                <div class="d-grid mt-3">
                    <button type="submit" class="btn-primary-theme btn-block w-full mb-3">
                        SACAR
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('/assets/js/jquery.mask.min.js') }}"></script>
    <script>

        $("#withdrawal-modal").iziModal({
            title: 'Saque',
            subtitle: 'Selecione abaixo o valor que deseja sacar',
            icon:'fa-solid fa-money-from-bracket',
            headerColor: '#1A1C1F',
            theme: 'dark',  // light
            background:  '#202327',
            width: 700,
            closeOnEscape: false,
            overlayClose: false,
            onFullscreen: function(){},
            onResize: function(){},
            onOpening: function(){
                $('.money2').mask('000.000.000.000.000,00', {reverse: true});
                $('.cpf').mask('000.000.000-00', {reverse: true});
            },
            onOpened: function(){
            },
            onClosing: function(){},
            onClosed: function(){},
            afterRender: function(){}
        });

        /// Withdrawal Form
        document.getElementById('withdrawalForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Evita o comportamento padrão de envio do formulário

            // Exibe o loading
            const loadingElement = document.getElementById('loadingWithdrawal');
            loadingElement.style.display = 'block';

            const formData = new FormData(this);

            fetch('{{ route('panel.wallet.withdrawal') }}', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if(data.status) {
                        iziToast.show({
                            title: 'Sucesso',
                            message: 'Saque solicitado com sucesso',
                            theme: 'dark',
                            icon: 'fa-solid fa-check',
                            iconColor: '#ffffff',
                            backgroundColor: '#23ab0e',
                            position: 'topRight',
                            timeout: 1500,
                            onClosing: function () {},
                            onClosed: function () {
                                $("#withdrawal-modal").iziModal('close');
                                setTimeout(function() {
                                    window.location.replace('{{ route('panel.wallet.withdrawals') }}');
                                }, 1000);
                            }
                        });
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

    <script>

    </script>
@endpush
