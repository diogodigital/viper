@extends('layouts.web')

@push('styles')

@endpush

@section('content')
    <div class="container-fluid">
        @include('includes.navbar_top')
        @include('includes.navbar_left')

        <div class="page__content">
            <br>

            <div class="container">
                <h1>Lista de Notificações</h1>

                <div class="mb-5">
                    @foreach($notifications as $notification)
                        <div class="notification" role="alert">
                            <div class="notification-icon">
                                <i class="fa-regular fa-bell bi flex-shrink-0 text-3xl" style="font-size: 2rem;margin-right: 10px !important;"></i>
                            </div>
                            <div class="notification-body">
                                {{ $notification->data['message'] }}
                            </div>
                            <div class="notification-time">
                                {{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans(); }}
                            </div>
                        </div>
                    @endforeach
                </div>

                {{ $notifications->links() }}
            </div>
        </div>
    </div>
@endsection

@push('styles')

@endpush
