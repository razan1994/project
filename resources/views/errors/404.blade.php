@extends('frontend.layout.app')

@section('content')
        <!-- Error -->
        <div class="error-area">
            <div class="container">
                <div class="error-item">
                    <h1>404</h1>
                    <span>The page you are looking for does not exist</span>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis quas repellendus beatae dolorem, similique nobis velit corrupti est perferendis odio totam fugiat, optio praesentium. Cum deleniti explicabo amet laudantium eius!</p>
                    <a class="cmn-btn" href="{{ route('home') }}">Go To Homepage</a>
                </div>
            </div>
        </div>
        <!-- End Error -->
@endsection
