<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel Welcome</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        /* General Body Styles */
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
            margin: 0;
            padding: 0;
        }

        /* Page Container */
        .page-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Header styles */
        .header {
            text-align: center;
            padding: 30px 20px;
        }

        .header h1, .header p {
            overflow: hidden; /* Ensures the text is hidden initially */
            white-space: nowrap;
            border-right: 2px solid #343a40;
        }

        /* Typing animation for h1 */
        @keyframes typing-h1 {
            from {
                width: 0;
                visibility: hidden;
            }
            to {
                width: 100%;
                visibility: visible;
            }
        }

        /* Typing animation for p */
        @keyframes typing-p {
            from {
                width: 0;
                visibility: hidden;
            }
            to {
                width: 100%;
                visibility: visible;
            }
        }

        .header h1 {
            font-size: 2.5rem;
            color: #EF3B2D;
            margin-bottom: 10px;
            width: 0; /* Initially hidden */
            visibility: hidden; /* Initially hidden */
            animation: typing-h1 3s steps(30) 1s forwards, blink 0.75s step-end infinite;
        }

        .header p {
            font-size: 1.25rem;
            color: #6c757d;
            width: 0; /* Initially hidden */
            visibility: hidden; /* Initially hidden */
            animation: typing-p 3s steps(30) 4s forwards, blink 0.75s step-end infinite; /* Start after h1 */
        }

        /* Cursor blinking animation */
        @keyframes blink {
            50% {
                border-color: transparent;
            }
        }

        .footer {
            position: fixed;
            bottom: 10px;
            width: 100%;
            text-align: center;
            font-size: 0.875rem;
            color: #6c757d;
        }

        /* Auth Links Styles */
        .auth-links {
            position: fixed;
            top: 0;
            right: 0;
            padding: 10px 20px;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .auth-links a {
            text-decoration: none;
            color: red;
            font-weight: 600;
        }

        .auth-links a:hover {
            text-decoration: underline;
        }

        /* Button Styling */
        .btn {
            padding: 10px 20px;
            font-size: 1rem;
            color: #fff;
            background-color: #6c757d;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body class="antialiased">

    <div class="page-container">
        <div class="header">
            <h1>Welcome to Task Manager</h1>
            <p>Keep your record of tasks here</p>
        </div>
    </div>

    <!-- Authentication Links -->
    @if (Route::has('login'))
    <div class="auth-links">
        @auth
            <a href="{{ url('/home') }}" class="btn">Home</a>
        @else
            <a href="{{ route('login') }}" class="btn">Log in</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn">Register</a>
            @endif
        @endauth
    </div>
    @endif

    <div class="footer">
        <p>&copy; {{ date('Y') }} Task Manager. All rights reserved.</p>
    </div>

</body>
</html>
