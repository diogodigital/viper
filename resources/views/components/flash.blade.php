<div>
    @if ($message = Session::get('message'))
        <script>
            $(function () {
                iziToast.success({
                    title: "{{ __('Success') }}",
                    message: "{{ $message }}",
                    position: 'topRight'
                });
            });
        </script>
    @endif

    @if ($message = Session::get('success'))
        <script>
            $(function () {
                iziToast.success({
                    title: "{{ __('Success') }}",
                    message: "{{ $message }}",
                    position: 'topRight'
                });
            });
        </script>
    @endif

    @if (session('status'))
        <script>
            $(function () {
                iziToast.success({
                    title: "{{ __('Success') }}",
                    message: "{{ session('status') }}",
                    position: 'topRight'
                });
            });
        </script>
    @endif

    @if ($message = Session::get('error'))
        @if(isset($message['error']))
            <script>
                $(function () {
                    iziToast.error({
                        title: "{{ __('Error') }}",
                        message: "{{ $message['error'] }}",
                        position: 'topRight'
                    });
                });
            </script>
        @else
            @if(is_array($message) && count($message) > 0)
                @foreach($message as $msg)
                    @if(is_array($msg))
                        @foreach($msg as $m)
                            <script>
                                $(function () {
                                    iziToast.error({
                                        title: "{{ __('Error') }}",
                                        message: "{{ $m }}",
                                        position: 'topRight'
                                    });
                                });
                            </script>
                        @endforeach
                    @else
                        @if(!empty($msg))
                            <script>
                                $(function () {
                                    iziToast.error({
                                        title: "{{ __('Error') }}",
                                        message: "{{ $msg }}",
                                        position: 'topRight'
                                    });
                                });
                            </script>
                        @endif
                    @endif
                @endforeach
            @else
                <script>
                    $(function () {
                        iziToast.error({
                            title: "{{ __('Error') }}",
                            message: "{{ $message }}",
                            position: 'topRight'
                        });
                    });
                </script>
            @endif
        @endif
    @endif


    @if ($message = Session::get('warning'))
        <script>
            $(function () {
                iziToast.warning({
                    title: "{{ __('Attention!') }}",
                    message: "{{ $message }}",
                    position: 'topRight'
                });
            });
        </script>
    @endif


    @if ($message = Session::get('info'))
        <script>
            $(function () {
                iziToast.info({
                    title: "{{ __('Information!') }}",
                    message: "{{ $message }}",
                    position: 'topRight'
                });
            });
        </script>
    @endif


    @if (isset($errors) && $errors->any())
        @foreach ($errors->all() as $error)
            <script>
                $(function () {
                    iziToast.error({
                        title: "{{ __('Error') }}",
                        message: "{{ $error }}",
                        position: 'topRight'
                    });
                });
            </script>
        @endforeach
    @endif

</div>
