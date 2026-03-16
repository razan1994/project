<div class="login-box">
    <div class="login-logo pr-2 rounded">
        <a href="{{ route('login') }}" class="pe-3">
            <img src="{{ asset('assets/images/logo.png') }}" alt=""
                style="max-width: 300px; objecvt-fit: contain; height: 150px;">
        </a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form wire:submit.prevent="login">
                <div class="mb-3 input-group">
                    <input type="email" wire:model='email' class="form-control" required name="email"
                        placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="mb-3 input-group">
                    <input type="password" wire:model='password' class="form-control" name="password" required
                        placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                {{-- Print $errors --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-block btn-primary">
                            Sign In
                        </button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
    </div>
</div>
