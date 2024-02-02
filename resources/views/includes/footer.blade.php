<div class="footer">
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <div class="footer-info">
                <div>
                    <img src="{{ asset('storage/'.config('setting')['software_logo_white']) }}" alt="" class="footer-logo" width="">
                    <img src="{{ asset('/assets/images/+18.png') }}" alt="" width="38">
                </div>
                <p class="{{ url('/sobre-nos') }}">
                    <strong>{{ config('setting')['software_name'] }}</strong> é uma comunidade dedicada a oferecer a melhor experiência aos jogadores.
                    Estamos confiantes de que a {{ config('setting')['software_name'] }} revolucionará a indústria de cassinos online.
                    Experimente! Divirta-se jogando e conquiste vitórias!
                </p>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12">

            <div class="footer-right">

                <div class="footer-social">
                    <div class="row">
                        @if(!empty(config('setting')['instagram']))
                            <div class="col">
                                <a href="{{ config('setting')['instagram'] }}" target="_blank">
                                    <img src="{{ asset('/assets/images/social/instagram.png') }}" alt="">
                                </a>
                            </div>
                        @endif

                        @if(!empty(config('setting')['discord']))
                            <div class="col">
                                <a href="{{ config('setting')['discord'] }}">
                                    <img src="{{ asset('/assets/images/social/discord.png') }}" target="_blank" alt="">
                                </a>
                            </div>
                        @endif

                        @if(!empty(config('setting')['telegram']))
                            <div class="col">
                                <a href="{{ config('setting')['telegram'] }}">
                                    <img src="{{ asset('/assets/images/social/telegram.png') }}" target="_blank" alt="">
                                </a>
                            </div>
                        @endif

                        @if(!empty(config('setting')['twitter']))
                            <div class="col">
                                <a href="{{ config('setting')['twitter'] }}">
                                    <img src="{{ asset('/assets/images/social/twitter.png') }}" target="_blank" alt="">
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <div>
                    <p class="mb-0">©{{ date('Y') }} {{ env('APP_NAME') }} TODOS OS DIREITOS RESERVADOS</p>
                    <p><small>Desenvolvido &#9829; por: <a href="https://www.instagram.com/victormsalatiel" class="text-success">Victormsalatiel</a></small></p>
                </div>

            </div>
        </div>
    </div>

</div>
