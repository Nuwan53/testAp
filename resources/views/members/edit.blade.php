@extends('layouts.app')

@section('title', 'Edit Member - Alpha Fitness Gym')

@section('content')
    <div class="header-row">
        <h2 class="section-title">✏️ Edit Member</h2>
    </div>

    <div style="background: white; padding: 2rem; border-radius: 8px;">
        <p style="margin-bottom: 1.5rem; color: #6c757d;">
            Editing: <strong>{{ $member->name }}</strong>
        </p>
        @include('members.form', ['member' => $member])
    </div>
@endsection
