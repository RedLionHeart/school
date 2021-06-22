<?php

namespace App\Services;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class MainService
{

    /**
     * @param string $title
     * @param string $table
     * @return string
     */
    public function makeSlug(string $title, string $table): string
    {
        $slug = Str::limit(Str::slug($title), 190);

        if (DB::table($table)->where('slug', $slug)->exists()) {
            if (empty(DB::table($table)->find(DB::table($table)->max('id'))))
                $last_id = 0;
            else
                $last_id = DB::table($table)->find(DB::table($table)->max('id'))->id;
            $last_id++;
            $slug = $slug . '-' . $last_id;
        }

        return $slug;
    }


    /**
     * @param string $slug
     * @param $model
     * @return mixed
     */
    public function getModelFromSlug(string $slug, $model)
    {
        $result = $model::where('slug', $slug)->first();
        if(empty($result)) return abort(404);
        return $result;
    }

    public function saveImage($image, string $folder, string $filename = null): string
    {

        if (empty($filename)){
            $filename = Str::random(32) . '.' . $image->getClientOriginalExtension();
        }
        $path = storage_path('app/public/' . $folder . '/' . $filename);

        Image::make($image)->save($path);
        return basename($filename);
    }
}
