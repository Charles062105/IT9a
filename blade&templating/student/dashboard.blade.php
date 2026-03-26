@extends('layouts.app')

@section('content')
<div class="student-info">
    <h2>Welcome, {{ strtoupper($name) }}!</h2>
    <p><strong>Course:</strong> {{ $course }}</p>
    <p><strong>Student ID:</strong> {{ $studentId }}</p>
    <p><strong>Status:</strong> 
        @if($isActive)
            <span style="color: #27ae60;">✅ Active Student</span>
        @else
            <span style="color: #e74c3c;">❌ Inactive</span>
        @endif
    </p>
</div>

<div class="subjects">
    <h3> Your Subjects ({{ count($subjects) }} total)</h3>
    
    @if($isEnrolled)
        @foreach($subjects as $subject)
            <div class="subject">
                <strong>{{ $loop->iteration }}.</strong> 
                {{ strtolower($subject['name']) }}
                @if(isset($subject['grade']))
                    <span style="float: right; color: {{ $subject['grade'] >= 75 ? '#27ae60' : '#e74c3c' }};">
                        Grade: {{ $subject['grade'] }}
                    </span>
                @endif
            </div>
        @endforeach
    @else
        <div class="alert alert-danger">
            You are not enrolled in any subjects.
        </div>
    @endif
</div>
@endsection