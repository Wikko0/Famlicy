<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content',
        'type',
        'location',
        'image_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public static function createPost(array $data)
    {

        $from = $data['from'] ?? auth()->id();
        $location = $data['location'] ?? null;
        $filePath = null;


        $post = self::create([
            'user_id' => $from,
            'content' => $data['content'],
            'type' => $data['type'],
            'location' => $location,
            'from' => $from,
        ]);


        if (isset($data['file']) && $data['file'] instanceof \Illuminate\Http\UploadedFile) {
            $file = $data['file'];
            $extension = $file->getClientOriginalExtension();
            $mimeType = $file->getMimeType();

            $filePath = "/images/posts/post-{$post->id}.{$extension}";


            $file->storeAs('images/posts', "post-{$post->id}.{$extension}", 'public_uploads');


            if (str_starts_with($mimeType, 'image')) {
                $image = Image::make(public_path($filePath));
                $image->save();
            }


            $post->update(['image_path' => $filePath]);
        }

        return $post;
    }
}
