@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card d-flex dashboard-body">
                    <div class="card-body p-1">

                        @livewire('dashboard', ['page' => 'view'])

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
