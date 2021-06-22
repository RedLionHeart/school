<?php


namespace App\Http\Controllers;

use App\Models\PhotosAlbum;
use Illuminate\Support\Facades\Storage;

class PhotosAlbumController extends Controller
{
    public function destroy($photo_id){

        $photo = PhotosAlbum::find($photo_id);

        Storage::delete('/public/photos_albums/' . $photo->path);

        $photo->delete();

        return response()->json([

            'success' => 'Record deleted successfully!'

        ]);
    }
}
