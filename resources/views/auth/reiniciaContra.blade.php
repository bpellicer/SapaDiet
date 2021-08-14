@include('partials.headcontent')
<x-layout.navGuest/>

@if (session()->has('error'))
    <x-alerta nom="error2" missatge="{{ session('error') }}"/>
@endif

<div class="container mx-auto my-auto">
    <div class="flex justify-center px-2 sm:px-5 md:px-10 my-12">
        <div class="w-96 bg-green4 rounded-3xl border-2 border-black p-2 text-center">
            <h3 class="pt-4 text-lg sm:text-2xl text-center font-bold">Reinicia la contrasenya</h3>
            <x-form method="post" action="{{ route('reset.password.post') }}" class="mt-8">
                <input type="hidden" name="token" value="{{$token}}"/>

                <label for="email" class="font-bold">Email</label>
                <div class="flex justify-center mb-4 mt-2">
                    <input type="email" class="px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow block w-64" id="email" name="email" placeholder="Email" value="{{old("email")}}">
                </div>

                @error('email')
                    <p class="text-xs text-red-500 mb-2">{{ucfirst($message)}}</p>
                @enderror

                <label for="contrasenya" class="font-bold">Contrasenya</label>
                <div class="flex justify-center mb-4 mt-2">
                    <input type="password" class="px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow block w-64 contrasenya" id="contrasenya" name="contrasenya" placeholder="Contrasenya">
                </div>

                @error('contrasenya')
                    <p class="text-xs text-red-500 mb-2">{{ucfirst($message)}}</p>
                @enderror

                <label for="password_confirmation" class="font-bold">Repeteix contrasenya</label>
                <div class="flex justify-center mb-4 mt-2">
                    <input type="password" class="px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow block w-64 contrasenya" name="password_confirmation" id="contra2" placeholder="Repeteix Contrasenya">
                </div>

                @error('password_confirmation')
                    <p class="text-xs text-red-500 mb-2">{{ucfirst($message)}}</p>
                @enderror

                <input id="btnPass" type="checkbox" name="checkbox" class="mr-1 mb-4"><label for="checkbox" id="labelPass">Mostra contrasenya</label>
                <input type="submit" value="Reinicia Contrasenya" class="botoEstandar cursor-pointer mb-4"/>
            </x-form>
        </div>
    </div>
</div>
<x-layout.footerGuest/>
