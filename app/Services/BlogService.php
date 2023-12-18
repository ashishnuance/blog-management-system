<?php 

namespace App\Services;
use App\Models\Blog;
use App\Models\BlogMedia;

class BlogService {

    /**
     * Create blog
	 * @param $request
	 *
	 * @return mixed
	 */
	public function createBlog($request) {

        $requestData = $request->all();
		return Blog::create($request->all());
	}

    /**
     * Upload blog media files
	 * @param $request
	 *
	 * @return mixed
	 */
	public function uploadMediaFile($blogId,$request) {
        $mediaFiles = [];
        $imageType = ['jpg','jpeg','gif','png','webp','svg'];
        $videoType = ['mp4','webm'];
        foreach($request->file('image_video_file') as $media_key => $images){

            $newName = time();
            $ext = $images->getClientOriginalExtension();
            $name = $newName . '.' . $ext;
            $images->move(storage_path() . '/app', $name);
            $path = storage_path() . '/app/' . $name;
            $mediaFiles[$media_key]['blog_id'] = $blogId;
            $mediaFiles[$media_key]['media_filename'] = $name;
            if(in_array($ext,$imageType)){
                $mediaFiles[$media_key]['media_filetype'] = 'image';
            }elseif(in_array($ext,$imageType)){
                $mediaFiles[$media_key]['media_filetype'] = 'video';
            }
        }
        return BlogMedia::insert($mediaFiles);

    }

}