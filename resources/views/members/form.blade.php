@if ($errors->any())
    <div class="alert alert-danger">
        <strong>⚠️ Validation Errors:</strong>
        <ul style="margin: 0.5rem 0 0 1.5rem;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ isset($member) ? route('members.update', $member) : route('members.store') }}" method="POST">
    @csrf
    @if (isset($member))
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="name">Full Name</label>
        <input 
            type="text" 
            id="name" 
            name="name" 
            placeholder="Enter member's full name"
            value="{{ old('name', $member->name ?? '') }}"
            required
        >
        @error('name')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="email">Email Address</label>
        <input 
            type="email" 
            id="email" 
            name="email" 
            placeholder="Enter email address"
            value="{{ old('email', $member->email ?? '') }}"
            required
        >
        @error('email')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="phone">Phone Number</label>
        <input 
            type="text" 
            id="phone" 
            name="phone" 
            placeholder="Enter phone number"
            value="{{ old('phone', $member->phone ?? '') }}"
            required
        >
        @error('phone')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="membership_type">Membership Type</label>
        <select id="membership_type" name="membership_type" required>
            <option value="">-- Select Membership Type --</option>
            <option value="basic" {{ old('membership_type', $member->membership_type ?? '') === 'basic' ? 'selected' : '' }}>
                Basic
            </option>
            <option value="premium" {{ old('membership_type', $member->membership_type ?? '') === 'premium' ? 'selected' : '' }}>
                Premium
            </option>
            <option value="vip" {{ old('membership_type', $member->membership_type ?? '') === 'vip' ? 'selected' : '' }}>
                VIP
            </option>
        </select>
        @error('membership_type')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="status">Status</label>
        <select id="status" name="status" required>
            <option value="">-- Select Status --</option>
            <option value="active" {{ old('status', $member->status ?? '') === 'active' ? 'selected' : '' }}>
                Active
            </option>
            <option value="inactive" {{ old('status', $member->status ?? '') === 'inactive' ? 'selected' : '' }}>
                Inactive
            </option>
        </select>
        @error('status')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="notes">Notes (Optional)</label>
        <textarea 
            id="notes" 
            name="notes" 
            placeholder="Add any additional notes about the member..."
        >{{ old('notes', $member->notes ?? '') }}</textarea>
        @error('notes')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-success">
            {{ isset($member) ? '✏️ Update Member' : '✅ Add Member' }}
        </button>
        <a href="{{ route('members.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
