<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Psr7;


class Media extends Model
{
    /**
     * Додає запис про новий файл
     * @param string $title
     * @param string $description
     * @param string $path
     * @param int $file_size_bytes
     * @return bool
     */
    public function addNewMedia(string $title,
                                string $description,
                                string $path,
                                int $file_size_bytes = 0):bool
    {
        $ext = [];
        preg_match('#\.([\w\d]+)$#si', $path, $ext);
        $mime = \GuzzleHttp\Psr7\mimetype_from_extension($ext[1]);
        $this->title = $title;
        $this->user_id = auth()->user()->id;
        $this->type_mime = $mime;
        $this->size_bytes = $file_size_bytes;
        $this->path = $path;
        $this->description = $description;
        return (bool) $this->save();

    }
}
