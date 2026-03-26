@extends('layouts.app')

@section('content')
<h2>My Subjects</h2>
<div class="subjects-grid">
    @foreach($subjects as $subject)
    <div style="background: white; padding: 20px; margin: 10px 0; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
        <h4>{{ $subject['code'] }} - {{ $subject['name'] }}</h4>
        <p><strong>Units:</strong> {{ $subject['units'] }} | <strong>Schedule:</strong> {{ $subject['schedule'] }}</p>
    </div>
    @endforeach
</div>
@endsection