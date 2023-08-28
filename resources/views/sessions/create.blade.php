@extends('layout.layout')

@section('content')
   

    <section class="px-6 py-8">
     
        <main class="max-w-lg mx-auto mt-10  p-6   rounded-xl">
               <x-panel>

            <h1 class="text-center font-bold text-xl">Log In!</h1>


            <form action="/login" method="POST" class="mt-4 ">

                @csrf
             
                <x-form.input name="email" autocomplete="username" /> 
                <x-form.input name="password" type="password" autocomplete="new-password"  /> 
               

                
                <x-form.button >Log In</x-form.button>
        





                </form>

                </x-panel>
        

        </main>
    </section>

@endsection    