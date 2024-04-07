<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'posts';

    protected $fillable = [
        "user_id",
        "title",
        "slug",
        "image",
        "body",
        "published_at",
        "featured",
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'published_at' => 'datetime',
        'categories' => 'array',
    ];


    /**
     * Get the author that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * The roles that belong to the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'categories_post');
    }



    public function scopePublished($query)
    {
        $query->where('published_at', "<=", Carbon::now());
        // $query->where('published_at', '<=', Carbon::now()->toDateTimeString());
    }

    public function scopeWithCategory($query, string $category)
    {
        $query->whereHas('categories', function ($query) use ($category) {
            $query->where('slug', $category);
        });
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

    public function getThubnailImage()
    {
        $isURL = str_contains($this->image, 'http');

        return ($isURL) ? $this->image : Storage::url($this->image);

        // BISA MENGGUNAKAN CODE DIBAWAH INI JADI SESUAI DENGAN DISKNYA 
        // TAPI JIKA MEMAKAI CODE DIBAWAH ->url akan error tapi bisa digunakan dengan baik 
        // Storage::disk('local')->url($this->image)
    }
}
