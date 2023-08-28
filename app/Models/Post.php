<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable=['title','body','excerpt','category_id', 'slug', 'user_id', 'thumbnail'];


    protected $with=['category', 'author'];


    public function scopeFilter($query, array $filters){

        $query->when($filters['search'] ?? false, fn($query, $search)=> 

            $query->where(fn($query)=>
            $query->where('title', 'like', '%'.$search. '%')
                  ->orWhere('body', 'like', '%'.$search. '%')));


            $query->when($filters['category'] ?? false, fn($query, $category)=> 

                $query->whereHas('category', fn($query)=>
                    $query->where('slug', $category)
                )
            );



            $query->when($filters['author'] ?? false, fn($query, $author)=> 

                $query->whereHas('author', fn($query)=>
                    $query->where('username', $author)
                )
            );



            
            // $query
            //      ->whereEXists(fn($query, $category)=>

            //         $query->from('categories')
            //               ->whereColumn('categories.id', 'posts.category_id')
            //               ->where('categories.slug', $category) )) ;


            

       
    }



    
 

    public function category(){

        return $this->belongsTo(Category::class);
    } 
    
    public function comments(){

        return $this->hasMany(Comment::class);
    }

    public function author(){

        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
