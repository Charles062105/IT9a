<!DOCTYPE html>
<html>
<head>
    <title>Create Student</title>
    <style>body{font-family:system-ui;padding:2rem;max-width:600px;margin:auto;}</style>
</head>
<body>
    <div style="background:white;padding:2rem;border-radius:12px;box-shadow:0 10px 30px rgba(0,0,0,0.1);">
        <h1> Create New Student</h1>
        
        <form method="POST" action="{{ route('admin.students.store') }}">
            @csrf
            
            <div style="margin-bottom:1.5rem;">
                <label style="display:block;margin-bottom:0.5rem;font-weight:600;">Name:</label>
                <input type="text" name="name" required style="width:100%;padding:0.75rem;border:1px solid #ddd;border-radius:6px;font-size:16px;">
            </div>
            
            <div style="margin-bottom:2rem;">
                <label style="display:block;margin-bottom:0.5rem;font-weight:600;">Course:</label>
                <input type="text" name="course" required style="width:100%;padding:0.75rem;border:1px solid #ddd;border-radius:6px;font-size:16px;">
            </div>
            
            <button type="submit" style="background:#28a745;color:white;border:none;padding:0.75rem 2rem;border-radius:6px;cursor:pointer;font-size:16px;font-weight:500;">Create Student</button>
            <a href="{{ route('admin.students.index') }}" style="background:#6c757d;color:white;padding:0.75rem 2rem;border-radius:6px;text-decoration:none;font-weight:500;">← Back</a>
        </form>
    </div>
</body>
</html>