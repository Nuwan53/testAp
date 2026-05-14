@extends('layouts.app')

@section('title', $member->name . ' - Alpha Fitness Gym')

@section('content')
    <div class="header-row">
        <h2 class="section-title">👤 Member Details</h2>
        <div>
            <a href="{{ route('members.edit', $member) }}" class="btn btn-success">Edit</a>
            <a href="{{ route('members.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>

    <div class="card">
        <div class="card-title">{{ $member->name }}</div>

        <div class="card-field">
            <label>ID</label>
            <span>#{{ $member->id }}</span>
        </div>

        <div class="card-field">
            <label>Email</label>
            <span>
                <a href="mailto:{{ $member->email }}" style="color: #667eea;">{{ $member->email }}</a>
            </span>
        </div>

        <div class="card-field">
            <label>Phone</label>
            <span>
                <a href="tel:{{ $member->phone }}" style="color: #667eea;">{{ $member->phone }}</a>
            </span>
        </div>

        <div class="card-field">
            <label>Membership Type</label>
            <span>
                <span class="badge badge-info">{{ ucfirst($member->membership_type) }}</span>
            </span>
        </div>

        <div class="card-field">
            <label>Status</label>
            <span>
                @if ($member->status === 'active')
                    <span class="badge badge-success">✓ Active</span>
                @else
                    <span class="badge badge-danger">✕ Inactive</span>
                @endif
            </span>
        </div>

        <div class="card-field">
            <label>Notes</label>
            <span>
                @if ($member->notes)
                    {{ $member->notes }}
                @else
                    <em style="color: #6c757d;">No notes</em>
                @endif
            </span>
        </div>

        <div class="card-field">
            <label>Member Since</label>
            <span>{{ $member->created_at->format('M d, Y h:i A') }}</span>
        </div>

        <div class="card-field">
            <label>Last Updated</label>
            <span>{{ $member->updated_at->format('M d, Y h:i A') }}</span>
        </div>
    </div>

    <div style="margin-top: 2rem;">
        <form action="{{ route('members.destroy', $member) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button 
                type="submit" 
                class="btn btn-danger"
                onclick="return confirm('Are you sure you want to delete this member?');"
            >
                🗑️ Delete Member
            </button>
        </form>
        <a href="{{ route('members.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
@endsection
