@extends('layouts.app')

@section('title', 'Labto - Laboratory & Science Research')

@section('content')
    @include('components.banner')
    @include('components.boxes')
    @include('components.about')
    @include('components.services')
    @include('components.team')
    @include('components.blog')
    @include('components.cta')
@endsection
