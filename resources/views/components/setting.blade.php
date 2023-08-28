@props(['categories', 'heading'])

 <section class="py-8 max-w-4xl mx-auto">
   <h1 class="text-lg font-bold mb-8 pb-2 border-b ">
                 {{$heading}}
                
            </h1>

    <div class="flex">


    <aside class="w-48">

        <h4 class="font-semibold mb-4">Links</h4>
         
        <ul>
                <li>
                         <a href="{{route('post.createcreatepost')}}" class="{{route('post.createcreatepost') ? 'text-blue-500' : ''}}">New Post</a>
                       
                </li>
        </ul>
    </aside> 

     <main class=" mx-auto mt-6 lg:mt-20 space-y-6">
        
              <x-panel class=" mx-auto ">   
               
               {{$slot}}
        </x-panel>
 
        </main>
    </div>
    </section>
      
  