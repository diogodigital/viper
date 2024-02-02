@extends('layouts.web')

@push('styles')

@endpush

@section('content')
    <div class="container">
        @include('includes.navbar_top')


        <form id="resetPasswordForm" action="">
            @csrf
            <div class="forgotpassword-container relative">

                <div id="loadingResetPassword" class="loading-spinner">
                    <span class="spinner"></span>
                </div>

                <div class="forgotpassword">
                    <h4>REDEFINIR SENHA</h4>
                    <div class="form-group mb-3 mt-5">
                        <input id="email" name="email" type="email" class="form-control" placeholder="Digite seu email" required>
                    </div>
                    <button type="submit" class="ui-button s-conic2 text-center w-full">
                        REDEFINIR
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

            const email = document.getElementById('email').value;

            fetch('{{ url('/send-reset-link') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ email: email })
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

                document.getElementById('email').value = '';
                loadingElement.style.display = 'none';

                setTimeout(function() {
                    window.location.replace('{{ url('/') }}');
                }, 1000);
            })
            .catch(error => {
                console.error('Erro:', error);
                loadingElement.style.display = 'none';
            });
        });
    </script>
@endpush
