<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostService
{
    /**
     * Create a new post.
     */
    public function createPost(array $data)
    {
        return Post::create([
            'user_id' => Auth::id(),
            'content' => $data['content'],
            'type' => $data['type'] ?? 'status',
            'metadata' => $data['metadata'] ?? [],
        ]);
    }

    /**
     * Handle link scraping for job posts or links in content.
     */
    public function scrapeLinkMetadata(string $url)
    {
        try {
            $response = \Illuminate\Support\Facades\Http::timeout(5)->get($url);
            
            if (!$response->successful()) {
                return ['url' => $url];
            }

            $html = $response->body();
            $metadata = ['url' => $url];

            // Basic Regex for OG Tags
            if (preg_match('/<meta property="og:title" content="([^"]+)"/i', $html, $matches)) {
                $metadata['title'] = $matches[1];
            } elseif (preg_match('/<title>([^<]+)<\/title>/i', $html, $matches)) {
                $metadata['title'] = $matches[1];
            }

            if (preg_match('/<meta property="og:description" content="([^"]+)"/i', $html, $matches)) {
                $metadata['description'] = $matches[1];
            } elseif (preg_match('/<meta name="description" content="([^"]+)"/i', $html, $matches)) {
                $metadata['description'] = $matches[1];
            }

            if (preg_match('/<meta property="og:image" content="([^"]+)"/i', $html, $matches)) {
                $metadata['image'] = $matches[1];
            }

            return $metadata;
        } catch (\Exception $e) {
            return ['url' => $url, 'error' => $e->getMessage()];
        }
    }
}
