@extends('layout.layout')

@section('content')

       
        <x-setting heading="Publish New Post" :categories='$categories' >
                
      
           
               
                  <form action="/admin/posts/create" class="py-2" method="post" enctype="multipart/form-data">
                        @csrf
 
                       
                        <x-form.input name="title" />
                        
                        <x-form.textarea name="excerpt" />
                        <x-form.textarea name="body" />

                        <x-form.input name="thumbnail" type="file" />
                       
                     

                   
                        <x-form.field>

                                <x-form.label name="category" />

                               

                                <select name="category_id" id="category_id"  class="w-full border border-gray-400 p-2" required>

                                         <option value="" disabled {{old('category_id') ? '' : 'selected'}} >Selecct Category</option>

                                        @foreach ($categories as $category)

                                               <option value="{{$category->id}}" {{old('category_id') ===$category->id ? 'selected' : ''}} >{{ucwords($category->name)}}</option>
                                       @endforeach
                                </select>

                               
                        </x-form.field>

                        <x-form.field>
                                 <x-form.button   >Create</x-form.button>

                        </x-form.field>
                        

                       


                </form>
      

                 
        </x-setting>

    

@endsection