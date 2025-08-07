@extends('layouts.admin.empty')
@section('body')
    @include('includes.admin.header')

    @include('includes.admin.side')

        <main id="main" class="main">

            <x-admin.page-title :title="trim($__env->yieldContent('title'))" />


            @yield('content')


        </main><!-- End #main -->

    @include('includes.admin.footer')
@endsection