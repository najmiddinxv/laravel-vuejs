<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostObserver
{
    public function creating(Post $post)
    {
        $post->created_by = auth()->user()->id;

        $titleTranslations = $post->getTranslations('title');
        $slugs = [];

        foreach ($titleTranslations as $titleLocale => $title) {
            $slugs[$titleLocale] = Str::slug($title);
        }

        $post->slug = $slugs;
    }

    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        // $user = $post->created_by;
        // $user->notify(new NewPostNotification($post));
    }

    public function updating(Post $post): void
    {
        $post->created_by = auth()->user()->id;
        
        $titleTranslations = $post->getTranslations('title');
        $slugs = [];

        foreach ($titleTranslations as $titleLocale => $title) {
            $slugs[$titleLocale] = Str::slug($title);
        }

        $post->slug = $slugs;
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        //
    }
}
