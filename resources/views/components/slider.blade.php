<div class="h-100 bg-overlay-dark-2"
    style="background-image:url('{{ !empty($slider->image) && file_exists($slider->image)
        ? asset($slider->image)
        : asset('assets/images/banner/05.jpg') }}'); background-position: center center; background-size: cover;">
    <div class="container h-100">
        <div class="row d-flex h-100">
            <div class="col-md-8 justify-content-center align-self-center align-items-start mx-auto">
                <div class="slider-content text-center ">
                    <h3
                        class="animate__animated animate__fadeInUp animate__delay-1s display-7 text-white alt-font fst-italic">
                        {{ $slider->description }}</h3>
                    <h2 class="animate__animated animate__fadeInUp animate__delay-2s display-3 fw-bold text-white">
                        {{ $slider->title }}</h2>
                    @if (isset($slider->link))
                        <div class="animate__animated animate__fadeInUp animate__delay-3s mt-3 dealy-1500">
                            <a href="{{ $slider->link }}" class="btn btn-grad">{{ $slider->button }}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
