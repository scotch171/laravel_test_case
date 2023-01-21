@php
    use App\Models\Article;

    /**
     * @var Article $article
     * @var string $json
     */
@endphp

@extends('layouts.main')

@section('title')
    {{$article->header }}
@endsection

@section('content')
    <article-page
        :id="{{ $article->id }}"
        :json="{{ $json }}"
    ></article-page>
@endsection
