 <section class="section">
     <div class="container">
         <div class="section-heading reveal"><span class="eyebrow">SELECTED WORK</span>
             <h2 data-i18n="projects_title">Selected work, real-world impact.</h2>
             <p data-i18n="projects_desc">A selection of digital experiences and solutions made with purpose.</p>
         </div>
         <div class="row g-4">
             @forelse($projects as $project)
                 <x-frontend.projects.project-card :project="$project" />
             @empty
                 <div class="col-12">
                     <p class="p-3 rounded bg-warning text-danger">No projects available at the moment.</p>
                 </div>
             @endforelse
         </div>
         <div class="text-center mt-5"><a class="btn btn-outline-armada" href="projects.html" data-i18n="view_all">View
                 all</a></div>
     </div>
 </section>
