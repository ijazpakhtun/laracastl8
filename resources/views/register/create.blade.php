@extends('layout.layout')

@section('content')
   

    <section class="px-6 py-8">

        <main class="max-w-lg mx-auto mt-10    rounded-xl">
            <x-panel>
            <h1 class="text-center font-bold text-xl">Register!</h1>

            <form action="/register" method="POST" class="mt-4 ">

                @csrf
                <x-form.input name="name" autocomplete="name" /> 
            

                
                <x-form.input name="username" autocomplete="username" /> 
            



                
                <x-form.input name="email" autocomplete="email" /> 
            


                
                <x-form.input name="password" autocomplete="new-password" /> 
            


                <x-form.button >Register</x-form.button>


                

                
            </form>

            </x-panel>
        </main>


    </section>


@endsection