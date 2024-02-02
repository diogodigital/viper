<div id="deposit-modal" class="iziModal" data-izimodal-loop="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="loadingDeposit" class="loading-spinner">
                <span class="spinner"></span>
            </div>

            <div id="qrcode-container">
                <div id="qrcode" style="width:300px; height:300px; margin-top:15px;"></div>
                <input id="pixcopiaecola" type="text" class="form-control mt-3" value="">
                <div class="d-grid mt-2">
                    <button id="copyQrcodePix" class="btn btn-primary" type="button">COPIA CÓDIGO</button>
                </div>
                <div class="mt-3 text-center">
                    <p><i class="fa fa-spin fa-spinner mr-3"></i> Aguardando pagamento...</p>
                </div>
            </div>

            <form id="depositForm" method="post" action="" class="form-login">
                @csrf
                <h5 class="mb-3 font-bold">DEPOSITAR VIA PIX</h5>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="email" style="width: 50px;">
                        <p class="p-1 mb-0">R$</p>
                    </span>
                    <input type="number" name="amount" required min="{{ config('setting')->min_deposit }}" max="{{ config('setting')->max_deposit }}" class="form-control" placeholder="0,00">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"  style="width: 50px;" id="password"><i class="fa-light fa-address-card text-success-emphasis"></i></span>
                    <input type="text" name="cpf" class="form-control cpf" required placeholder="DIGITE SEU CPF">
                </div>
                <div class="row justify-between list-amount">
                    @php $amount = config('setting')->min_deposit @endphp
                    @for($i = 0; $i < 6; $i++)
                        <div class="col-4 col-lg-2">
                            <button type="button" class="select_amount">R$ {{ $amount }}</button>
                        </div>
                        @php $amount = $amount * 2 @endphp
                    @endfor
                </div>
                <div class="d-grid mt-3">
                    <button type="submit" class="btn-primary-theme btn-block w-full mb-3">
                        GERAR QRCODE
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


@push('scripts')
    <script src="{{ asset('/assets/js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('/assets/js/qrcode.min.js') }}"></script>
    <script>

        /// intervalo de consulta
        let intervalId;

        $("#deposit-modal").iziModal({
            title: 'Depósito',
            subtitle: 'Escolha ou insira o valor do depósito',
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
                $('.money').mask('000.000.000.000.000,00', {reverse: true});
                $('.cpf').mask('000.000.000-00', {reverse: true});
            },
            onOpened: function(){
            },
            onClosing: function(){},
            onClosed: function(){
                clearInterval(intervalId);
            },
            afterRender: function(){}
        });

        document.getElementById("copyQrcodePix").addEventListener("click", function() {
            // Seleciona o conteúdo do input
            var inputElement = document.getElementById("pixcopiaecola");
            inputElement.select();
            inputElement.setSelectionRange(0, 99999);  // Para dispositivos móveis

            // Copia o conteúdo para a área de transferência
            document.execCommand("copy");

            iziToast.show({
                title: 'Sucesso',
                message: 'Chave Pix Copiada com sucesso',
                theme: 'dark',
                icon: 'fa-solid fa-check',
                iconColor: '#ffffff',
                backgroundColor: '#23ab0e',
                position: 'topRight',
                timeout: 1500,
                onClosing: function () {},
                onClosed: function () {

                }
            });
        });

        /**
         * Consult Status Transaction
         * @param idTransaction
         */
        function consultStatusTransaction(idTransaction)
        {
            fetch('{{ url(\Helper::getGatewaySelected().'/consult-status-transaction') }}', {
                method: 'POST',
                body: JSON.stringify({
                    idTransaction: idTransaction
                }),
                headers: new Headers({
                    'Content-Type': 'application/json; charset=UTF-8'
                })
            })
                .then(response => response.json())
                .then(data => {
                    if(data.status === 'PAID') {
                        clearInterval(intervalId);

                        setTimeout(function() {
                            window.location.replace('{{ route('panel.wallet.deposits') }}');
                        }, 500);
                    }
                })
                .catch(error => {

                })
                .finally(() => {

                });
        }

        /// Deposit Form
        document.getElementById('depositForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Evita o comportamento padrão de envio do formulário

            // Exibe o loading
            const loadingElement = document.getElementById('loadingDeposit');
            loadingElement.style.display = 'block';

            const formData = new FormData(this);

            fetch('{{ url(\Helper::getGatewaySelected().'/qrcode-pix') }}', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if(data.status) {
                        var divQrcode = document.getElementById('qrcode-container');
                        divQrcode.style.display = 'block';

                        var qrcode = new QRCode( document.getElementById('qrcode'), {
                            width : 300,
                            height : 300
                        });

                        var inputElement = document.getElementById("pixcopiaecola");
                        inputElement.value = data.qrcode;

                        qrcode.makeCode(data.qrcode);

                        var div = document.getElementById('depositForm');
                        div.style.display = 'none';

                        intervalId = setInterval(function () {
                            consultStatusTransaction(data.idTransaction);
                        }, 5000);
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

        /// Handle Button
        function handleButtonClick(event) {
            const amountValue = event.target.textContent.replace('R$ ', '');  // Obtemos o valor sem o prefixo 'R$ '
            document.querySelector('input[name="amount"]').value = amountValue;  // Atualizamos o valor do input
        }

        const buttons = document.querySelectorAll('.select_amount');

        buttons.forEach(button => {
            button.addEventListener('click', handleButtonClick);
        });
    </script>

    <script>

    </script>
@endpush
