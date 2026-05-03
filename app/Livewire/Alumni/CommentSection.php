<?php

namespace App\Livewire\Alumni;

use Livewire\Component;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentSection extends Component
{
    public Post $post;
    public $body;
    public $showComments = false;
    public $replyingToId = null;

    protected $rules = [
        'body' => 'required|min:1|max:1000',
    ];

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function toggleComments()
    {
        $this->showComments = !$this->showComments;
    }

    public function setReply($commentId)
    {
        $this->replyingToId = $commentId;
        $user = Comment::find($commentId)->user->name;
        $this->body = "@{$user} ";
    }

    public function cancelReply()
    {
        $this->replyingToId = null;
        $this->body = '';
    }

    public function getListeners()
    {
        return [
            "echo:posts,CommentCreated" => 'handleCommentCreated',
        ];
    }

    public function handleCommentCreated($event)
    {
        if ($event['postId'] == $this->post->id) {
            $this->post->refresh();
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'user_id' => Auth::id(),
            'body' => $this->body,
            'post_id' => $this->post->id,
        ];

        if ($this->replyingToId) {
            $parent = Comment::find($this->replyingToId);
            $data['parent_id'] = $this->replyingToId;
            $data['depth'] = $parent->depth + 1;
        }

        $comment = Comment::create($data);

        // Notify owner of post
        if ($this->post->user_id !== Auth::id()) {
            $this->post->user->notify(new \App\Notifications\PostActivityNotification([
                'message' => "<b>" . Auth::user()->name . "</b> mengomentari postingan Anda.",
                'icon' => 'ri-chat-3-fill',
                'url' => route('alumni.feed'),
                'type' => 'comment'
            ]));
        }

        // Notify parent comment owner if it's a reply
        if ($this->replyingToId) {
            $parent = Comment::find($this->replyingToId);
            if ($parent->user_id !== Auth::id() && $parent->user_id !== $this->post->user_id) {
                $parent->user->notify(new \App\Notifications\PostActivityNotification([
                    'message' => "<b>" . Auth::user()->name . "</b> membalas komentar Anda.",
                    'icon' => 'ri-reply-fill',
                    'url' => route('alumni.feed'),
                    'type' => 'reply'
                ]));
            }
        }

        $this->reset(['body', 'replyingToId']);
        $this->post->refresh();

        // Broadcast to others
        event(new \App\Events\CommentCreated($this->post->id, $this->post->comments()->count()));
    }

    public function render()
    {
        // Get only top-level comments and use relationships for children
        $comments = $this->post->comments()
            ->whereNull('parent_id')
            ->with(['user.alumniProfile', 'replies.user.alumniProfile'])
            ->latest()
            ->get();

        return view('livewire.alumni.comment-section', [
            'comments' => $comments
        ]);
    }
}
