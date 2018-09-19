<?php

namespace App\Jobs;

use App\Models\Image as ImageModel;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Intervention\Image\ImageManagerStatic as Image;

class ResizeImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $destinationPath;

    private $filename;

    private $width;

    private $height;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($destinationPath, $filename, $width = 200, $height = 200)
    {
        $this->destinationPath = $destinationPath;
        $this->filename = $filename;
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // access the model in the queue for processing
        try {
            //thu muc chua file can resize
            $destinationPath = $this->destinationPath;
            //thu muc chua file da duoc resize
            $thumbnailPath = $this->destinationPath . "/thumb/{$this->width}x{$this->height}";

            //path(duong dan va ten) file resize
            $resizeFilePath = "$thumbnailPath/{$this->filename}";

            //neu chua ton tai thu muc chua file da duoc resize thi tao thu muc moi
            if (!file_exists($thumbnailPath)) {
                mkdir($thumbnailPath, 0777, true);
            }
     
            // create image thumbs from the original image
            $img = \Image::make("$destinationPath/{$this->filename}")->resize($this->width, $this->height);
            $img->save($resizeFilePath);

            if (file_exists($resizeFilePath)) {
                \Log::info('Resized successfully!');
            } else {
                \Log::error('Failed to resize image!');
            }
        } catch(\Exception $e) {
            \Log::error('Failed to resize image: ' . $e->getMessage());
        }
    }
}
