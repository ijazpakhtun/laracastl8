@props(['name'])


<x-form.field>
    <x-form.label name="{{$name}}" />

    <textarea name="{{$name}}"
              id="{{$name}}"
              placeholder="{{$name}}"
               value="{{old('$name')}}" 
                class="w-full border border-gray-200 p-2 rounded"
                 required
                 
                 >
                 
                 {{$slot ?? old($name)}}
                
                </textarea>

    <x-form.error name="{{$name}}" />
</x-form.field>