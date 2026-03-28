@extends('frontend.layout.app')

@section('page_title', __('frontend.faqs_title'))
@section('meta_title', __('frontend.faqs_title'))
@section('meta_desc', __('frontend.faqs_meta_desc'))
@section('meta_keywords', __('frontend.faqs_meta_keywords'))

@section('content')
    <livewire:frontend.faqs-page-section />
@endsection
