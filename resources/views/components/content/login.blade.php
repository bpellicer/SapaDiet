<div class="contenidor">
    <div class="flex justify-center px-2 sm:px-5 md:px-10 my-12">
        <div class="contenidor-login">
            <div class="imatge-login" style="background-image: url(/imatges/login.jpg)"></div>
            <div class="subcontenidor-login">
                <h3 class="pt-4 text-2xl text-center font-bold">Inicia la sessió</h3>
                <x-form method="post" action="/login" class=" md:px-8 pt-6 pb-8" id="loginForm">
                    <x-input tipus="email" classe="inputClassic" id="email" nom="email" placeholder="Email"/>

                    @error('email')
                        <p class="missatgeError">{{ucfirst($message)}}</p>
                     @enderror

                    <x-input tipus="password" classe="inputClassic contrasenya" nom="contrasenya" id="contra1" placeholder="Contrasenya"/>

                    @error('contrasenya')
                        <p class="missatgeError">{{ucfirst($message)}}</p>
                    @enderror

                    <input id="btnPass" type="checkbox" name="checkbox" class="mr-1 mb-4"><label for="checkbox" id="labelPass">Mostra contrasenya</label>
                    <div class="flex justify-center">
                        <x-boto tipus="submit" classe="botoEstandar cursor-pointer w-100" text="Entra"/>
                    </div>
                </x-form>
                <div class=" mt-2 md:ml-8">
                    <a href="recuperacio" class="text-sm hover:text-green1">Has oblidat la contrasenya?</a>
                </div>
                <div class=" mt-4 md:ml-8">
                    <a href="registre" class="text-sm hover:text-green1">No tens cap compte? Registra't</a>
                </div>
            </div>
        </div>
    </div>
</div>
