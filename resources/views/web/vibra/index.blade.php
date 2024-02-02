@extends('layouts.web')

@section('title', 'Vibra - Cassino Online | Jogos de Slot e Apostas em Futebol')

@section('seo')

@endsection

@push('styles')

@endpush

@section('content')
    <div class="playgame">
        <div class="playgame-body">
            <iframe src="{{ $gameURL }}" class="game-full"></iframe>
        </div>
        <div class="action-buttons" style="position: absolute;top: 10px;left: 10px;">
            <a href="{{ url('/') }}" class="w-button btn-small">
                <i class="fa-regular fa-arrow-left mr-3"></i> Fechar
            </a>
        </div>
    </div>
@endsection

@push('scripts')
    <script>

    </script>
@endpush
