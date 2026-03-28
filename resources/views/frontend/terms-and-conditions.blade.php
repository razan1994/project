@extends('frontend.layout.app')

@section('page_title', __('frontend.terms_title'))
@section('meta_title', __('frontend.terms_title'))
@section('meta_desc', __('frontend.terms_meta_desc'))
@section('meta_keywords', __('frontend.terms_meta_keywords'))

@section('content')
    <livewire:frontend.terms-and-conditions-page-section />
@endsection
