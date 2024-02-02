@extends('layouts.web')

@push('styles')

@endpush

@section('content')
    <div class="container">
        @include('includes.navbar_top')

        <form method="POST" id="resetPasswordForm" action="">
            @csrf
            <div class="forgotpassword-container relative">

                <div id="loadingResetPassword" class="loading-spinner">
                    <span class="spinner"></span>
                </div>

                <div class="forgotpassword">
                    <h4>REDEFINIR SENHA</h4>
                    @csrf
                    <div style="text-align: left;margin-top: 30px">
                        <div class="form-group mb-3">
                            <label for="password">Nova Senha</label>
                            <input placeholder="Digite uma nova senha" type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password_confirmation">Confirme a Nova Senha</label>
                            <input placeholder="Confirme sua nova senha" type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>
                    </div>
                    <button type="submit" class="ui-button s-conic2 text-center w-full">
                        SALVAR
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('resetPasswordForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const loadingElement = document.getElementById('loadingResetPassword');
            loadingElement.style.display = 'block';

            const password = document.getElementById('password').value;
            const password_confirmation = document.getElementById('password_confirmation').value;

            fetch('{{ url('/reset-password') }}/{{ $token }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ password: password, password_confirmation: password_confirmation  })
            })
            .then(response => response.json())
            .then(data => {

                iziToast.show({
                    title: 'Sucesso',
                    message: data.message,
                    theme: 'dark',
                    icon: 'fa-regular fa-circle-exclamation',
                    iconColor: '#ffffff',
                    backgroundColor: '#23ab0e',
                    position: 'topRight'
                });

                document.getElementById('password').value = '';
                document.getElementById('password_confirmation').value = '';

                setTimeout(function() {
                    window.location.replace('{{ url('/') }}');
                }, 1000);

                loadingElement.style.display = 'none';
            })
            .catch(error => {
                console.error('Erro:', error);
                loadingElement.style.display = 'none';
            });
        });
    </script>
@endpush
