<?php

namespace App\Livewire\Alumni;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CreatePost extends Component
{
    use WithFileUploads;

    public $content;
    public $type = 'status';
    public $photo;
    public $metadata = [];

    protected $rules = [
        'content' => 'required|min:5|max:2000',
        'photo' => 'nullable|image|max:10240', // Allow up to 10MB since we compress before storing
    ];

    public function updatedContent($value)
    {
        // Simple regex to detect first URL
        if (preg_match('/https?:\/\/[^\s]+/', $value, $matches)) {
            $url = $matches[0];
            
            // Only scrape if it's a new URL
            if (!isset($this->metadata['url']) || $this->metadata['url'] !== $url) {
                $service = new \App\Services\PostService();
                $this->metadata = $service->scrapeLinkMetadata($url);
                
                if (isset($this->metadata['title'])) {
                    $this->type = 'job'; // Auto-categorize as job/link if metadata found
                }
            }
        } else {
            $this->metadata = [];
            if (!$this->photo) $this->type = 'status';
        }
    }

    /**
     * Server-side image compression safety net.
     * Resizes to max 1920px and compresses to JPEG quality 90.
     * This ensures no raw oversized images are stored on disk,
     * even if client-side compression is bypassed.
     */
    private function compressImage(): string
    {
        $manager = new ImageManager(new Driver());
        $image = $manager->read($this->photo->getRealPath());

        // Resize proportionally — only if exceeds 1920px in any dimension
        $image->scaleDown(width: 1920, height: 1920);

        // Save compressed JPEG to a temp file
        $compressedPath = tempnam(sys_get_temp_dir(), 'iaspig_') . '.jpg';
        $image->toJpeg(quality: 90)->save($compressedPath);

        return $compressedPath;
    }

    public function save()
    {
        $this->validate();

        if ($this->photo) {
            $this->type = 'photo';
        }

        $post = Post::create([
            'user_id' => Auth::id(),
            'content' => $this->content,
            'type' => $this->type,
            'metadata' => $this->metadata,
        ]);

        if ($this->photo) {
            // Compress before storing — replaces raw original with optimized version
            $compressedPath = $this->compressImage();
            $originalName = pathinfo($this->photo->getClientOriginalName(), PATHINFO_FILENAME) . '.jpg';

            $post->addMedia($compressedPath)
                ->usingFileName($originalName)
                ->toMediaCollection('posts');
        }

        $this->reset(['content', 'photo', 'type', 'metadata']);
        
        $this->dispatch('post-created');
        event(new \App\Events\PostCreated());
        session()->flash('message', 'Postingan berhasil dibagikan!');
    }

    public function render()
    {
        return view('livewire.alumni.create-post');
    }
}
