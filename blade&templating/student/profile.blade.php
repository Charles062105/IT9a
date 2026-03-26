@extends('layouts.app')

@section('content')
<div class="profile-card">
    <h2>Student Profile</h2>
    <div style="background: #f8f9fa; padding: 20px; border-radius: 8px;">
        <p><strong>Name:</strong> {{ strtoupper($name) }}</p>
        <p><strong>Email:</strong> {{ $email }}</p>
        <p><strong>Phone:</strong> {{ $phone }}</p>
        <p><strong>Address:</strong> {{ $address }}</p>
        <p><strong>Enrolled:</strong> {{ $enrollmentDate }}</p>
    </div>
</div>
@endsection