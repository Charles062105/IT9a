@extends('layouts.app')

@section('content')
<h2>Account Settings</h2>
<div class="settings-form">
    <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 10px 0;">
        <p><strong>Theme:</strong> {{ ucfirst($theme) }}</p>
        <p><strong>Notifications:</strong> {{ $notifications ? '✅ Enabled' : '❌ Disabled' }}</p>
        <p><strong>Language:</strong> {{ $language }}</p>
    </div>
    <button style="background: #3498db; color: white; padding: 12px 24px; border: none; border-radius: 5px; cursor: pointer;">💾 Save Changes</button>
</div>
@endsection