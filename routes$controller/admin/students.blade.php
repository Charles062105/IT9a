<!DOCTYPE html>
<html>
<head>
    <title>Admin Students</title>
    <style>body{font-family:system-ui;padding:2rem;max-width:1100px;margin:auto;background:#f8f9fa;}</style>
</head>
<body>
    <div style="background:linear-gradient(135deg,#ff6b6b,#ee5a24);color:white;padding:2rem;border-radius:12px;margin-bottom:2rem;text-align:center;">
        <h1>Admin - Students Management</h1>
        <a href="{{ route('students.index') }}" style="background:white;color:#ff6b6b;padding:0.75rem 1.5rem;text-decoration:none;border-radius:6px;font-weight:500;">Public View</a>
        <a href="{{ route('admin.students.create') }}" style="background:white;color:#ff6b6b;padding:0.75rem 1.5rem;text-decoration:none;border-radius:6px;font-weight:500;margin-left:1rem;">➕ Add Student</a>
    </div>

    @if(session('success'))
        <div style="background:#d4edda;color:#155724;padding:1rem;border-radius:8px;border-left:4px solid #28a745;margin-bottom:2rem;">
            {{ session('success') }}
        </div>
    @endif

    <div style="background:white;border-radius:12px;overflow:hidden;box-shadow:0 10px 30px rgba(0,0,0,0.1);">
        <table style="width:100%;border-collapse:collapse;">
            <tr style="background:#343a40;color:white;">
                <th style="padding:1rem;font-weight:600;">ID</th>
                <th style="padding:1rem;font-weight:600;">Name</th>
                <th style="padding:1rem;font-weight:600;">Course</th>
                <th style="padding:1rem;font-weight:600;">Actions</th>
            </tr>
            @forelse($students as $student)
                <tr style="border-bottom:1px solid #eee;">
                    <td style="padding:1rem;"><strong>#{{ $student['id'] }}</strong></td>
                    <td style="padding:1rem;">{{ $student['name'] }}</td>
                    <td style="padding:1rem;">{{ $student['course'] }}</td>
                    <td style="padding:1rem;">
                        {{-- DELETE FORM - Method Spoofing --}}
                        <form method="POST" action="{{ route('admin.students.destroy', $student['id']) }}" style="display:inline;" 
                              onsubmit="return confirm('Delete {{ $student['name'] }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:#dc3545;color:white;border:none;padding:0.5rem 1rem;border-radius:4px;cursor:pointer;font-size:14px;">🗑️ Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="padding:3rem;text-align:center;color:#666;">No students. <a href="{{ route('admin.students.create') }}">Create one</a></td>
                </tr>
            @endforelse
        </table>
    </div>
</body>
</html>