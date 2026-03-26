<!DOCTYPE html>
<html>
<head>
    <title>Students</title>
    <style>body{font-family:system-ui;padding:2rem;max-width:900px;margin:auto;}</style>
</head>
<body>
    <div style="background:linear-gradient(135deg,#667eea,#764ba2);color:white;padding:2rem;border-radius:12px;margin-bottom:2rem;text-align:center;">
        <h1>Students Directory</h1>
        <a href="{{ route('admin.students.index') }}" style="background:white;color:#667eea;padding:0.75rem 1.5rem;text-decoration:none;border-radius:6px;font-weight:500;">Admin Panel</a>
    </div>

    <table style="width:100%;border-collapse:collapse;background:white;border-radius:12px;overflow:hidden;box-shadow:0 10px 30px rgba(0,0,0,0.1);">
        <tr style="background:#f8f9fa;">
            <th style="padding:1rem;font-weight:600;">ID</th>
            <th style="padding:1rem;font-weight:600;">Name</th>
            <th style="padding:1rem;font-weight:600;">Course</th>
        </tr>
        @forelse($students as $student)
            <tr style="border-bottom:1px solid #eee;">
                <td style="padding:1rem;"><strong>#{{ $student['id'] }}</strong></td>
                <td style="padding:1rem;">{{ $student['name'] }}</td>
                <td style="padding:1rem;">{{ $student['course'] }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3" style="padding:2rem;text-align:center;color:#666;">No students found</td>
            </tr>
        @endforelse
    </table>
</body>
</html>