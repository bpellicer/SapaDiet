<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
       <main>
        <nav class="flex items-center justify-between flex-wrap bg-white p-3">
            <div class="flex sm:ml-10">
                <img src="/imatges/logo.svg" width="40" height="40" alt="logo kiwi">
                <p class="text-black font-bold mt-3 ml-2">SAPA<span class="text-green3">DIET</span></p>
            </div>
            <div class="flex sm:hidden">
                <button id="navbarBtn">
                    <img class="toggle block" src="https://img.icons8.com/fluent-systems-regular/2x/menu-squared-2.png" width="40" height="40">
                    <img class="toggle hidden" src="https://img.icons8.com/fluent-systems-regular/2x/close-window.png" width="40" height="40">
                </button>
            </div>
            <div class="toggle hidden sm:flex items-center w-full sm:w-auto text-right text-bold mt-5 sm:mt-0">
                <a href="#" class="block sm:inline-block text-black hover:text-green3 mr-4">Inici</a>
                <a href="#" class="block sm:inline-block text-black hover:text-green3 mr-4">Login</a>
                <a href="#" class="block sm:inline-block shadow mr-4 bg-green1 px-5 py-2 rounded-full border-black border-2 hover:bg-black">Registra't</a>
            </div>
        </nav>
       </main>
       <div>
            {{ $slot }}
       </div>
       <footer></footer>
       <script src="https://code.iconify.design/1/1.0.6/iconify.min.js"></script>
    </body>
</html>
