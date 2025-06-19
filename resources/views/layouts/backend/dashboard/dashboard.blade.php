@extends('layouts.backend.layouts.app')
@section('content')
    @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6)
        @include('layouts.backend.dashboard.admin')
    @endif
    @if (auth()->user()->role_id == 3 || auth()->user()->role_id == 4)
        @include('layouts.backend.dashboard.merchant')
    @endif
    @if (auth()->user()->role_id == 2)
        @include('layouts.backend.dashboard.agent')
    @endif
@endsection
