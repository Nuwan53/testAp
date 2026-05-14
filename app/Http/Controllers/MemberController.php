<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of members with search and filter.
     */
    public function index(Request $request)
    {
        $query = Member::query();

        // Search by name or email
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by membership type
        if ($request->filled('membership_type')) {
            $query->byType($request->membership_type);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Order by latest created first
        $members = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('members.index', [
            'members' => $members,
            'search' => $request->search,
            'membership_type' => $request->membership_type,
            'status' => $request->status,
        ]);
    }

    /**
     * Show the form for creating a new member.
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Store a newly created member in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:members,email',
            'phone' => 'required|string|max:20',
            'membership_type' => 'required|in:basic,premium,vip',
            'status' => 'required|in:active,inactive',
            'notes' => 'nullable|string|max:500',
        ]);

        Member::create($validated);

        return redirect()->route('members.index')
                        ->with('success', 'Member added successfully!');
    }

    /**
     * Display the specified member.
     */
    public function show(Member $member)
    {
        return view('members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified member.
     */
    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    /**
     * Update the specified member in storage.
     */
    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:members,email,' . $member->id,
            'phone' => 'required|string|max:20',
            'membership_type' => 'required|in:basic,premium,vip',
            'status' => 'required|in:active,inactive',
            'notes' => 'nullable|string|max:500',
        ]);

        $member->update($validated);

        return redirect()->route('members.index')
                        ->with('success', 'Member updated successfully!');
    }

    /**
     * Remove the specified member from storage.
     */
    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route('members.index')
                        ->with('success', 'Member deleted successfully!');
    }
}
