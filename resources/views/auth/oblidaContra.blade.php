@include('partials.headcontent')
<x-layout.navGuest/>

@if (session()->has('missatge'))
    <x-alerta nom="success2" missatge="{{ session('missatge') }}"/>
@endif

<div class="contenidor">
    <div class="flex justify-center px-2 sm:px-5 md:px-10 my-12">
        <div class="w-100 bg-green4 rounded-3xl border-2 border-black p-2 text-center">
            <h3 class="pt-4 text-lg sm:text-2xl text-center font-bold">Reinicia la contrasenya</h3>
            <x-form method="post" action="{{ route('forget.password.post') }}" class="mt-8">
                <label for="email" class="font-bold">Email</label>
                <div class="flex justify-center mb-4 mt-2">
                    <input type="email" class="px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow block w-64" id="email" name="email" placeholder="Email">
                </div>
                @error('email')
                    <p class="text-xs text-red-500 mb-2 block">{{ucfirst($message)}}</p>
                @enderror
                <input type="submit" value="Envia" class="botoEstandar cursor-pointer">
            </x-form>
        </div>
    </div>
</div>
<x-layout.footerGuest/>
