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
                <a class="text-black font-bold logo"><img class="inline-block mr-2 logoKiwi" src="/imatges/logo.svg" width="40" height="40" alt="logo kiwi">SAPA<span class="text-green3">DIET</span></a>
            </div>
            <div class="flex sm:hidden">
                <button id="navbarBtn">
                    <img class="toggle block" src="https://img.icons8.com/material-outlined/24/000000/menu--v1.png" width="30" height="30">
                    <img class="toggle hidden" src="https://img.icons8.com/ios/50/000000/delete-sign--v1.png" width="20" height="20">
                </button>
            </div>
            <div class="links toggle hidden sm:flex items-center w-full sm:w-auto text-center sm:text-right text-bold mt-5 sm:mt-0 sm:ml-10">
                <a href="#" class="link">Inici</a>
                <a href="#" class="link mt-3">Login</a>
                <a href="#" class="registre mt-3">Registra't</a>
            </div>
        </nav>
       </main>
       <div>
            {{ $slot }}
       </div>
       <footer class="footer absolute inset-x-0 bottom-0 pb-5 overflow-hidden text-center">
            <div class="flex flex-wrap ">
                <div class="w-full overflow-hidden sm:w-1/3 order-2 sm:order-1">
                    <h1 class="mb-2 underline font-bold text-2xl pt-3">Tecnologies</h1>
                    <div class="text-center">
                        <a href="https://laravel.com/" class="logosTecno"><img src="/imatges/laravel.png" alt="Logo de Laravel" height="40" width="40"></a>
                        <a href="https://tailwindcss.com/" class="logosTecno"><img src="/imatges/tailwind.png" alt="Logo de TailwindCSS" height="40" width="40"></a>
                        <a href="https://www.javascript.com/"class="logosTecno"><img src="/imatges/javascript.png" alt="Logo de Javascript" height="40" width="40"></a>
                    </div>
                </div>

                <div class=" w-full overflow-hidden sm:w-1/3 order-1 sm:order-2">
                    <div class="mt-5">
                        <a class="text-black font-bold logo text-2xl">SAPA<span class="text-green3 text-2xl">DIET</span><img class="inline-block ml-2 logoKiwi" src="/imatges/logo.svg" alt="logo kiwi" width="50" height="50"></a>
                    </div>
                    <div class="mt-2">
                        <p>La web per a gestionar la teva dieta.</p>
                        <p class="mt-3">Ara més fàcil que mai!</p>
                    </div>
                </div>

                <div class="w-full overflow-hidden sm:w-1/3 order-3 pt-3">
                    <h1 class=" mb-2 underline font-bold text-2xl">Mapa Web</h1>
                    <p class="mt-2"><a href="#" class="link2"> Inici </a></p>
                    <p class="mt-2"><a href="#" class="link2"> Login </a></p>
                    <p class="mt-2"><a href="#" class="link2"> Registra't </a></p>
                </div>
            </div>
            <div class="flex place-content-center text-center w-full overflow-hidden">
                <div class="copyright w-full" style="width: 50vw">
                    <p class="text-gray-500 text-sm">Il·lustracions per Freepik Storyset & Flaticon</p>
                </div>
            </div>

       </footer>

       <script src="https://code.iconify.design/1/1.0.6/iconify.min.js"></script>
       <script src="{{ asset('js/app.js')}}"></script>
    </body>
</html>
