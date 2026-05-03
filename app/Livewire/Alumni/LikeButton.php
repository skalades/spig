<?php

namespace App\Livewire\Alumni;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class LikeButton extends Component
{
    public Post $post;
    public $isLiked;
    public $likesCount;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->isLiked = $post->isLikedBy(Auth::user());
        $this->likesCount = $post->likes()->count();
    }

    public function getListeners()
    {
        return [
            "echo:posts,PostLiked" => 'handlePostLiked',
        ];
    }

    public function handlePostLiked($event)
    {
        if ($event['postId'] == $this->post->id) {
            $this->likesCount = $event['likesCount'];
        }
    }

    public function toggleLike()
    {
        if ($this->isLiked) {
            $this->post->likes()->where('user_id', Auth::id())->delete();
            $this->isLiked = false;
            $this->likesCount--;
        } else {
            $this->post->likes()->create([
                'user_id' => Auth::id()
            ]);
            
            // Notify owner
            if ($this->post->user_id !== Auth::id()) {
                $this->post->user->notify(new \App\Notifications\PostActivityNotification([
                    'message' => "<b>" . Auth::user()->name . "</b> menyukai postingan Anda.",
                    'icon' => 'ri-heart-fill',
                    'url' => route('alumni.feed'),
                    'type' => 'like'
                ]));
            }

            $this->isLiked = true;
            $this->likesCount++;
        }

        // Broadcast to others
        event(new \App\Events\PostLiked($this->post->id, $this->likesCount));
    }

    public function render()
    {
        return view('livewire.alumni.like-button');
    }
}
