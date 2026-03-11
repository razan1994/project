<?php

namespace App\Livewire\Frontend;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class LatestNewsSection extends Component
{
    public function getBlogsProperty(): Collection
    {
        return Blog::query()
            ->where('status', 1)
            ->orderByDesc('id')
            ->limit(3)
            ->get();
    }

    public function render()
    {
        return view('livewire.frontend.latest-news-section', [
            'blogs' => $this->blogs,
        ]);
    }
}
