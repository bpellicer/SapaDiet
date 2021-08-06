<div class="container mx-auto my-auto">
    <div class="flex justify-center px-2 sm:px-5 md:px-10 my-12">
        <div class="w-full lg:w-9/12 xl:w-9/12 bg-green4 rounded-3xl border-2 border-black p-5 text-center">
            <h1>Calendari: {{$actual}}</h1>
            <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-7 text-center">
                @for ($i = 1; $i<= $dies; $i++)
                    <div class="bg-white w-full border-2 border-black">
                        <h1>{{$i}}</h1>
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div>
