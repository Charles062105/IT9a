<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $school ?? 'Student Portal' }} - Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background: #f4f4f4; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        nav { background: #2c3e50; padding: 15px; margin-bottom: 20px; border-radius: 5px; }
        nav a { color: white; text-decoration: none; margin-right: 20px; padding: 8px 12px; border-radius: 3px; }
        nav a:hover { background: #34495e; }
        .student-info { background: #3498db; color: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
        .subjects { background: #ecf0f1; padding: 20px; border-radius: 8px; }
        .subject { background: white; margin: 10px 0; padding: 15px; border-radius: 5px; border-left: 4px solid #3498db; }
        .alert { padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <div class="container">
        @include('partials.navbar')
        
        <h1>{{ $school }} - Student Portal</h1>
        <p class="school-info">Welcome to your personalized dashboard!</p>
        
        @yield('content')
    </div>
</body>
</html>