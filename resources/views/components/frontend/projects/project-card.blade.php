<div class="col-md-6 col-lg-4 reveal">
    <article class="project-card">
        <div class="project-art"><i class="bi bi-window-stack"></i></div><span class="tag">WEB
            EXPERIENCE</span>
        <h3 class="fw-bold mt-3">{{$project->title}}</h3>
        <p class="text-secondary">{{$project->description}}</p><a class="text-link"
            href="{{route('projects.details', $project->slug)}}" data-i18n="learn_more">Learn more</a>
    </article>
</div>
