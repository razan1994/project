<?php

namespace App\View\Components\Frontend\Blogs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BlogsSection extends Component
{
    /**
     * Create a new component instance.
     */
    public $blogs;
    public function __construct($blogs)
    {
        $this->blogs = $blogs;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.blogs.blogs-section');
    }
}
