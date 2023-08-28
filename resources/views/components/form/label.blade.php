@props(['name'])


<label for="{{$name}}" class="block w-full uppercase font-bold text-xs text-gray-700">
                {{ucwords($name)}}
      </label>