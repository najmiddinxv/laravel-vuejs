<?php

namespace App\Observers;

use App\Models\Content\Post;
use Illuminate\Support\Facades\Cache;
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
        Cache::forget('banners');

        // $user = $post->created_by;
        // $user->notify(new NewPostNotification($post));
    }

    public function updating(Post $post): void
    {
        if(auth()->user()?->user_type == 1){
            $post->created_by = auth()->user()->id;

            $titleTranslations = $post->getTranslations('title');
            $slugs = [];

            foreach ($titleTranslations as $titleLocale => $title) {
                $slugs[$titleLocale] = Str::slug($title);
            }

            $post->slug = $slugs;
        }
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        if(auth()->user()?->user_type == 1){
            Cache::forget('banners');
        }
    }


    /**
     * Handle the Post "deleting" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function deleting(Post $post)
    {
        // Perform actions before deleting a post
    }


    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        //
    }


    /**
     * Handle the Post "restoring" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function restoring(Post $post)
    {
        // Perform actions before restoring a soft-deleted post
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
