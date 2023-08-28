@extends('layout.layout')

@section('content')

       
        <x-setting :heading="'Edit Post : '.$post->title "  :categories='$categories' >
                
                
                @if($errors->has('slug'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold">Error!</strong>
                               
                                        <span class="block sm:inline">{{$errors->first('slug') }} Change title to unique title</span>
                                
                                
                                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                        
                                </span>
                        </div>
                @endif
           
               
                  <form action="/admin/posts/{{$post->slug}}" class="py-2" method="post" enctype="multipart/form-data">
                        @csrf

                        @method('PATCH')
 
                       
                        <x-form.input name="title" :value="old('title', $post->title)" />
                        
                        <x-form.textarea name="excerpt"  > {{old('excerpt', $post->excerpt)}}</x-form.textarea>
                        <x-form.textarea name="body"  > {{ old('body', $post->body)}}  </x-form.textarea>
                       
                        <div class="flex mt-6 ">
                                <div class="flex-1">
                                        <x-form.input name="thumbnail" type="file" :value="old('thumbnail', $post->thumbnail)" />
                        
                                </div>
                                
                                 <img src="{{asset('storage/'.$post->thumbnail)}}" alt="" class="rounded-xl ml-6" width="100">

                        </div>
                       
                     

                   
                        <x-form.field>

                                <x-form.label name="category" />

                               

                                <select name="category_id" id="category_id"  class="w-full border border-gray-400 p-2" required>

                                         <option value="" disabled {{old('category_id') ? '' : 'selected'}} >Selecct Category</option>

                                        @foreach ($categories as $category)

                                               <option value="{{$category->id}}" {{old('category_id', $post->category_id) ===$category->id ? 'selected' : ''}} >{{ucwords($category->name)}}</option>
                                       @endforeach
                                </select>

                               
                        </x-form.field>

                        <x-form.field>
                                 <x-form.button   >Update</x-form.button>

                        </x-form.field>
                        

                       


                </form>
      

                 
        </x-setting>

    

@endsection