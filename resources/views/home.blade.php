
@extends('layouts.event')

@section('content')

@livewire('dashboard-panels', ['selectedComponent' => 'viewEvents', 'guestListed' => 'render']) 
                      
@endsection
