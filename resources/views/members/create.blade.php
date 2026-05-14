@extends('layouts.app')

@section('title', 'Add New Member - Alpha Fitness Gym')

@section('content')
    <div class="header-row">
        <h2 class="section-title">➕ Add New Member</h2>
    </div>

    <div style="background: white; padding: 2rem; border-radius: 8px;">
        @include('members.form')
    </div>
@endsection
