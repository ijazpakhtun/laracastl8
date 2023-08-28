@props(['name'])


<x-form.field>

<x-form.label name="{{$name}}" />

<input 
        
         name="{{$name}}"
          id="{{$name}}"
           placeholder="{{$name}}"
            
             class="w-full border border-gray-400 p-2 rounded"
              
              {{$attributes(['value' => old($name)])}}
              
              >

<x-form.error name="{{$name}}" />
</x-form.field>