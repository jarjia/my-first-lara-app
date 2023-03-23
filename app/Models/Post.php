<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

class Post {

    public static function all() {
        $files = File::files(resource_path('posts/'));

        return array_map(fn($file) => $file->getContents(), $files);
    }
    public static function find($slug) {
        if (! file_exists($path = resource_path("/posts/{$slug}.html"))) {
            // dd('file does not exist');
            // ddd('file does not exist');
            // abort(404);
            // return redirect('/');
            throw new ModelNotFoundException();
        }

        return cache()->remember("posts.{$slug}", now()->addSeconds(5), fn() => file_get_contents($path));
    }
}

?>