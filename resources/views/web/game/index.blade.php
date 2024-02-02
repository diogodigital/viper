@extends('layouts.web')

@push('styles')

@endpush

@section('content')
   <div class="playgame">
       <div class="playgame-body">
           <iframe src="{{ $gameUrl }}" class="game-full"></iframe>
       </div>
   </div>

   @include('includes.deposit')
@endsection

@push('styles')

@endpush
