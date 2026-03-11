@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'Edit Contact Us',
        'links' => [
            [
                'name' => 'Dashboard',
                'url' => route('dashboard'),
            ],
            [
                'name' => 'Contact Us',
                'url' => route('dashboard.contactUs.index'),
            ],
            [
                'name' => 'Edit Contact Us',
                'url' => route('dashboard.contactUs.edit'),
            ],
        ],
    ])
@endsection

@section('content')
    <form action="{{ route('dashboard.contactUs.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            {{-- E-mail --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">E-mail
                                        <span class="text-danger">
                                            *
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <input type="email" class="form-control" id="email" name="email" required
                                        value="{{ old('email', $contact->email) }}">
                                </div>
                            </div>

                            {{-- Phone --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone
                                        <span class="text-danger">
                                            *
                                            @error('phone')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <input type="tel" class="form-control" id="phone" name="phone" required
                                        value="{{ old('phone', $contact->phone) }}">
                                </div>
                            </div>

                            {{-- Address AR --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address_ar">Address Ar
                                        <span class="text-danger">
                                            *
                                            @error('address_ar')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <input type="text" class="form-control" id="address_ar" name="address_ar" required
                                        value="{{ old('address_ar', $contact->address_ar) }}">
                                </div>
                            </div>

                            {{-- Address En --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address_en">Address En
                                        <span class="text-danger">
                                            *
                                            @error('address_en')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <input type="address_en" class="form-control" id="address_en" name="address_en" required
                                        value="{{ old('address_en', $contact->address_en) }}">
                                </div>
                            </div>

                            {{-- Facebook --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="facebook">Facebook
                                        <span class="text-danger">
                                            @error('facebook')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <input type="facebook" class="form-control" id="facebook" name="facebook"
                                        value="{{ old('facebook', $contact->facebook) }}">
                                </div>
                            </div>

                            {{-- Twitter --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="twitter">Twitter
                                        <span class="text-danger">
                                            @error('twitter')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <input type="twitter" class="form-control" id="twitter" name="twitter"
                                        value="{{ old('twitter', $contact->twitter) }}">
                                </div>
                            </div>

                            {{-- Youtube --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="youtube">Youtube
                                        <span class="text-danger">
                                            @error('youtube')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <input type="youtube" class="form-control" id="youtube" name="youtube"
                                        value="{{ old('youtube', $contact->youtube) }}">
                                </div>
                            </div>

                            {{-- Instagram --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="instagram">Instagram
                                        <span class="text-danger">
                                            @error('instagram')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <input type="instagram" class="form-control" id="instagram" name="instagram"
                                        value="{{ old('instagram', $contact->instagram) }}">
                                </div>
                            </div>

                            {{-- Linkedin --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="linkedin">Linkedin
                                        <span class="text-danger">
                                            @error('linkedin')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <input type="linkedin" class="form-control" id="linkedin" name="linkedin"
                                        value="{{ old('linkedin', $contact->linkedin) }}">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
