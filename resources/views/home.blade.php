@extends('layouts.app')

@section('title', \App\Models\Setting::getValue('site_name', 'Prof. Sadiq Laboratory'))

@section('content')
    @include('components.banner')
    @include('components.boxes')
    @include('components.about')
    @include('components.services')
    @include('components.team')
    @include('components.blog')
    @include('components.cta')
@endsection
