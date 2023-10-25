<!DOCTYPE html>
<html lang="en" class="font-poppins" data-theme="light">
    <head>
        <title>{{ isset($title) ? 'Nevada - ' . $title : 'Nevada' }}</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:wght@400;500;600;700;800&family=Raleway:wght@400;600;700;800&family=Roboto+Mono&display=swap" rel="stylesheet">
        @vite('resources/css/app.css')
    </head>
    <body class="dark:bg-darkbgprimary dark:text-white min-h-screen hidden">

        {{ $slot }}

        <script>
            const toasts = [...document.getElementsByClassName('toast')];
            if (toasts.length > 0) {
                setTimeout(() => {
                    for (const toast of toasts) {
                        toast.classList.add('hidden');
                    }
                }, 5000)
            }

            const darkModeBtns = document.getElementsByClassName('dark-mode');
            const lightModeBtns = document.getElementsByClassName('light-mode');

            if (localStorage.getItem('theme') === 'dark') {
                toggleTheme();
                for (const darkModeBtn of darkModeBtns) {
                    darkModeBtn.classList.remove('swap-on');
                    darkModeBtn.classList.add('swap-off');
                }
                for (const lightModeBtn of lightModeBtns) {
                    lightModeBtn.classList.remove('swap-off');
                    lightModeBtn.classList.add('swap-on');
                }
            } else {
                document.body.classList.remove('hidden');
            }

            function toggleTheme() {
                if (document.documentElement.dataset.theme === 'dark') {
                    document.documentElement.dataset.theme = 'light';
                    document.documentElement.classList.remove('dark');
                    document.documentElement.classList.add('light');
                    localStorage.setItem('theme', 'light');
                } else {
                    document.documentElement.dataset.theme = 'dark';
                    document.documentElement.classList.remove('light');
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                }
                document.body.classList.remove('hidden');
            }
        </script>
    </body>
</html>
