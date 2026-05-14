@extends('layouts.app')

@section('title', 'Members - Alpha Fitness Gym')

@section('content')
    <div class="header-row">
        <h2 class="section-title">📋 Gym Members</h2>
        <a href="{{ route('members.create') }}" class="btn btn-primary">+ Add New Member</a>
    </div>

    <!-- Filter and Search Section -->
    <form method="GET" action="{{ route('members.index') }}" class="filter-box">
        <div class="form-group">
            <label for="search">Search by Name or Email</label>
            <input 
                type="text" 
                id="search" 
                name="search" 
                placeholder="John Doe or john@example.com" 
                value="{{ $search }}"
            >
        </div>

        <div class="form-group">
            <label for="membership_type">Membership Type</label>
            <select id="membership_type" name="membership_type">
                <option value="">All Types</option>
                <option value="basic" {{ $membership_type === 'basic' ? 'selected' : '' }}>Basic</option>
                <option value="premium" {{ $membership_type === 'premium' ? 'selected' : '' }}>Premium</option>
                <option value="vip" {{ $membership_type === 'vip' ? 'selected' : '' }}>VIP</option>
            </select>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status">
                <option value="">All Status</option>
                <option value="active" {{ $status === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $status === 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">🔍 Filter</button>
        <a href="{{ route('members.index') }}" class="btn btn-secondary">Reset</a>
    </form>

    <!-- Members Table -->
    @if ($members->count() > 0)
        <div style="overflow-x: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Membership Type</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($members as $member)
                        <tr>
                            <td><strong>#{{ $member->id }}</strong></td>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->email }}</td>
                            <td>{{ $member->phone }}</td>
                            <td>
                                <span class="badge badge-info">
                                    {{ ucfirst($member->membership_type) }}
                                </span>
                            </td>
                            <td>
                                @if ($member->status === 'active')
                                    <span class="badge badge-success">✓ Active</span>
                                @else
                                    <span class="badge badge-danger">✕ Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('members.show', $member) }}" class="btn btn-sm btn-primary">View</a>
                                    <a href="{{ route('members.edit', $member) }}" class="btn btn-sm btn-success">Edit</a>
                                    <form action="{{ route('members.destroy', $member) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button 
                                            type="submit" 
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this member?');"
                                        >
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            {{ $members->appends(request()->query())->links() }}
        </div>
    @else
        <div class="empty-message">
            <p>👤 No members found</p>
            <a href="{{ route('members.create') }}" class="btn btn-primary">Add First Member</a>
        </div>
    @endif
@endsection
