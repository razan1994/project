<section class="section section-soft">
    <div class="container">
        <div class="section-heading reveal visible"><span class="eyebrow">FROM THE JOURNAL</span>
            <h2 data-i18n="blog_title">Ideas for a better digital world.</h2>
            <p data-i18n="blog_desc">Practical insights, useful guides and fresh perspectives from our team.</p>
        </div>
        <div class="row g-4">
            @forelse ($blogs as $blog)
                <x-frontend.blogs.blog-card :blog="$blog" />
            @empty
                <div class="col-12">
                    <p class="p-3 rounded bg-warning text-danger">No blogs available at the moment.</p>
                </div>
            @endforelse
        </div>
        <div class="text-center mt-5"><a class="btn btn-outline-armada" href="{{ route('blogs') }}">View
                all</a></div>
    </div>
</section>
