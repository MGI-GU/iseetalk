<?php

namespace App\Observers;

use App\Models\Category;

class CategoryObserver
{
    /**
     * Handle the Category "created" event.
     *
     * @param  \App\Category  $category
     * @return void
     */
    public function created(Category $category)
    {
        $category->audit()->create([
            'model' => 'Category',
            'model_id' => $category->id
        ]);
    }

    /**
     * Handle the Category "updated" event.
     *
     * @param  \App\Category  $category
     * @return void
     */
    public function updated(Category $category)
    {
        //
    }

    /**
     * Handle the Category "deleted" event.
     *
     * @param  \App\Category  $category
     * @return void
     */
    public function deleted(Category $category)
    {
        //attachment_source
        if($category->attachment_source->count() > 0 ){
            $category->attachment_source->forceDelete();
        }
    }

    /**
     * Handle the Category "restored" event.
     *
     * @param  \App\Category  $category
     * @return void
     */
    public function restored(Category $category)
    {
        //attachment_source
        if($category->attachment_source->count() > 0 ){
            $category->attachment_source->forceDelete();
        }
    }

    /**
     * Handle the Category "force deleted" event.
     *
     * @param  \App\Category  $category
     * @return void
     */
    public function forceDeleted(Category $category)
    {
        //attachment_source
        if($category->attachment_source->count() > 0 ){
            $category->attachment_source->forceDelete();
        }
        //detach category id = 0
        //$category->audios->update()
    }
}
