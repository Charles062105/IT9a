@extends('layouts.app')

@section('content')
<div class="grades-header">
    <h2>Grades Report</h2>
    <p><strong>{{ strtoupper($name) }}</strong> - GPA: <span style="color: #27ae60; font-size: 1.5em;">{{ $gpa }}</span></p>
</div>

<div class="grades-table">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: #3498db; color: white;">
                <th style="padding: 12px;">Subject</th>
                <th style="padding: 12px;">Grade</th>
                <th style="padding: 12px;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($grades as $grade)
            <tr style="border-bottom: 1px solid #ddd;">
                <td style="padding: 12px;">{{ $grade['subject'] }}</td>
                <td style="padding: 12px; font-weight: bold;">{{ $grade['grade'] }}</td>
                <td style="padding: 12px;">
                    <span style="color: {{ $grade['grade'] >= 75 ? '#27ae60' : '#e74c3c' }};">
                        {{ $grade['status'] }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection