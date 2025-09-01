@extends('layouts.admin')

@section('title', 'View Publication')

@section('content')
<div class="container-fluid mt-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.publications.index') }}">Publications</a></li>
            <li class="breadcrumb-item active" aria-current="page">View Publication</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Publication Details</h4>
                    <div>
                        <a href="{{ route('dashboard.publications.edit', $publication) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('dashboard.publications.index') }}" class="btn btn-secondary">
                            <i class="fas
