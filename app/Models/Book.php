<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Book extends Model
{
    use HasFactory;

    public function author(){
        return $this->belongsTo(Author::class);
    }

    public function publisher(){
        return $this->belongsTo(Publisher::class);
    }

    public function translator(){
        return $this->belongsTo(Translator::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }





    public function relatedBooks()
    {
        return Book::inRandomOrder()->limit(10)->get();
    }





    public function scopeSort($query, ?string $sort)
    {
        if ($sort == 'latest') {
            return $query->latest();
        }

        if ($sort == 'best_seller') {
            return $query
            ->select('books.id', 'books.title', 'books.slug', 'books.price', 'books.image', 'books.created_at', DB::raw('SUM(most_sold.quantity) as total_sales'))
            ->rightJoin('order_items as most_sold', 'books.id', '=', 'most_sold.book_id')
            ->groupBy('books.id', 'books.title', 'books.slug', 'books.price', 'books.image', 'books.created_at')
            ->orderBy('total_sales', 'DESC');
        }

        if ($sort == 'cheapest') {
            return $query
            ->orderBy('price', 'ASC');
        }

        if ($sort == 'most_expensive') {
            return $query
            ->orderBy('price', 'DESC');
        }

        return $query;
    }

    public function scopeFilterIn($query, ?array $filters = [])
    {
        if (isset($filters['author_id'])) {
            $query->where('author_id', $filters['author_id']);
        }

        if (isset($filters['publisher_id'])) {
            $query->where('publisher_id', $filters['publisher_id']);
        }

        return $query;
    }

    

}
