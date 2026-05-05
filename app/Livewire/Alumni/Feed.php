<?php

namespace App\Livewire\Alumni;

use Livewire\Component;
use App\Models\Post;
use Livewire\Attributes\On;

class Feed extends Component
{
    public $perPage = 10;

    public $hasNewPosts = false;
    public $lastPostId;

    public function mount()
    {
        $this->lastPostId = Post::latest()->first()?->id;
    }

    public function getListeners()
    {
        return [
            'post-created' => 'refreshFeed',
            'echo:posts,PostCreated' => 'showNewPostsAlert',
        ];
    }

    public function showNewPostsAlert()
    {
        $this->hasNewPosts = true;
    }

    public function checkNewPosts()
    {
        $currentLatestId = Post::latest()->first()?->id;
        
        if ($currentLatestId && $currentLatestId !== $this->lastPostId) {
            $this->hasNewPosts = true;
        }
    }

    public function refreshFeed()
    {
        $this->hasNewPosts = false;
        $this->lastPostId = Post::latest()->first()?->id;
        $this->dispatch('$refresh');
    }

    public function loadMore()
    {
        $this->perPage += 10;
    }

    public function deletePost($postId)
    {
        $post = Post::findOrFail($postId);
        
        $this->authorize('delete', $post);

        $post->delete();

        $this->dispatch('notify', message: 'Postingan berhasil dihapus.', type: 'success');
        $this->dispatch('post-deleted');
    }

    public function render()
    {
        // Optimization: Use simplePaginate or cursorPaginate for better performance on large datasets
        $posts = Post::with(['user.alumniProfile', 'likes'])
            ->withCount(['comments', 'likes'])
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.alumni.feed', [
            'posts' => $posts
        ]);
    }
}
