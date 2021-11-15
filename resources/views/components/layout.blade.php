<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="App.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script defer src="https://unpkg.com/alpinejs@3.4.2/dist/cdn.min.js"></script>
    <title>Recycle Reminder</title>
</head>

<body>
    <section class="main-section">
        <nav class="navbar">
            <div class="title-div">
                @auth
                    <a href="/list" class="title">
                        <img src="/images/title-icon.svg" alt="Recycle Icon">
                        Recycle Reminder
                    </a>
                @else
                    <a href="/" class="title">
                        <img src="/images/title-icon.svg" alt="Recycle Icon">
                        Recycle Reminder</a>
                @endauth
            </div>
            @auth
                <div class="greeting">
                    <h3>Welcome Back, {{ auth()->user()->name }}</h3>
                </div>
            @endauth
            <div class="user-links-div">
                @auth
                    <form action="/logout" method="POST" class="logout-form">
                        @csrf
                        <button class="user-links" type="submit">Logout</button>
                        <img src="/images/user.svg" alt="User Image">
                    </form>
                @else
                    <a href="/register" class="user-links">Register</a>
                    <a href="/login" class="user-links">Login</a>
                @endauth
            </div>
        </nav>

        {{ $slot }}

        <footer class="footer">
            <img src="/images/footer-icon.svg" alt="Footer Icon">
            <h5>Thanks for choosing us.</h5>
            <p>Copyright &copy; 2021 Francesco Parra</p>
        </footer>
    </section>
    <x-success />
</body>

</html>
