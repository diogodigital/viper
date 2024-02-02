@extends('layouts.web')

@push('styles')

@endpush

@section('content')
    <div class="container-fluid">
        @include('includes.navbar_top')
        @include('includes.navbar_left')

        <div class="page__content">
            <div class="maintenance-body">
                <img src="{{ asset('/assets/images/website-maintenance.png') }}" alt="" width="800" class="img-fluid">

                <h1>Estamos em manutenção</h1>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
