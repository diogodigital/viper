@extends('layouts.web')

@push('styles')

@endpush

@section('content')
    <div class="container-fluid">
        @include('includes.navbar_top')
        @include('includes.navbar_left')

        <div class="page__content">

            <br>

            @include('includes.wallet_card')

            <div class="wallet-transactions mt-5">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">HISTÓRICO DE DEPOSITOS</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0">
                                <thead class="table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Valor</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Data</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($deposits))
                                    @foreach($deposits as $deposit)
                                        <tr>
                                            <th scope="row">{{ $deposit->id }}</th>
                                            <td>{{ $deposit->type }}</td>
                                            <td>{{ \Helper::amountFormatDecimal($deposit->amount) }}</td>
                                            <td>
                                                @if($deposit->status == 0)
                                                    <span class="badge bg-warning text-dark">Pendente</span>
                                                @else
                                                    <span class="badge bg-success">Confirmado</span>
                                                @endif
                                            </td>
                                            <td>{{ $deposit->dateHumanReadable }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="flex items-center justify-center text-center py-4" colspan="5">
                                            <h4 class=" mb-0">NENHUMA INFORMAÇÃO A EXIBIR</h4>
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-5">
                            <div class="row">
                                <div class="col-lg-6"></div>
                                <div class="col-lg-6">
                                    {{ $deposits->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')

@endpush
