<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Post;

class NewPostNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $post;
    public $postUrl;
    public $description;
    public $imageBase64;

    /**
     * Create a new message instance.
     */
    public function __construct(Post $post, $postUrl)
    {
        $this->post = $post;
        $this->postUrl = $postUrl;
        $this->description = $this->generateDescription($post->title);
        $this->imageBase64 = "https://img.freepik.com/free-photo/african-man-harvesting-vegetables_23-2151441263.jpg?t=st=1719926670~exp=1719930270~hmac=28ee4ce2c923a01c25355c4ed5011d180ba18000b1b16b79b3a989cb6a32cee8&w=996";
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Mol Agribussiness new Blog Post Published')
                    ->view('emails.newPostNotification')
                    ->with([
                        'post' => $this->post,
                        'postUrl' => $this->postUrl,
                        'description' => $this->description,
                        'imageBase64' => $this->imageBase64,
                    ]);
    }

    /**
     * Generate a description based on the title.
     */
    protected function generateDescription($title)
    {
        return "Check out our new blog post titled: $title";
    }

    /**
     * Get the base64 representation of the post image.
     */
    protected function getImageBase64($imagePath)
    {
        $image = file_get_contents(storage_path('app/public/' . $imagePath));
        return base64_encode($image);
    }
}
