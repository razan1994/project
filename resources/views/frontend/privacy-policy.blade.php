@extends('frontend.layout.app')

@section('page_title', __('frontend.privacy_title'))
@section('meta_title', __('frontend.privacy_title'))
@section('meta_desc', __('frontend.privacy_meta_desc'))
@section('meta_keywords', __('frontend.privacy_meta_keywords'))

@section('content')
    <livewire:frontend.privacy-policy-page-section />
@endsection
