<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'published_at' => 'datetime',
    ];



    public function scopePublished($query)
    {
        $query->where('published_at', "<=", Carbon::now());
        // $query->where('published_at', '<=', Carbon::now()->toDateTimeString());
    }

    public function scopeFeatured($query)
    {
        $query->where('featured', true);
    }


    public function getExcerpt()
    {
        return Str::limit(strip_tags($this->body), 150);
    }


    public function getReadingTime()
    {
        $mins =  round(str_word_count($this->body) / 100);

        return ($mins < 1) ? 1 : $mins;
    }

    /**
     * Get the author that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
