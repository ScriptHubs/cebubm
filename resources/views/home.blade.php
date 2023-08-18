
@extends('layouts.app')

@section('content')

@livewire('dashboard-panels', ['selectedComponent' => 'viewEvents', 'guestListed' => 'render']) 
                      
@endsection
