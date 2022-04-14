@extends('layouts.app')

@section('title')
    {{$lang->Blog}}
@endsection

@section('body_class') site-wrapper blog-listing blog-listing-grid @endsection
@section('header_class') main-header header-sticky header-sticky-smart header-style-01 header-float text-uppercase @endsection

@section('content')

    @includeIf("layouts.breadcrumb")

    <div id="wrapper-content" class="wrapper-content">
        <div class="container">
            <div class="row">
                @includeIf("data.blog")
            </div>
        </div>
    </div>

@endsection
