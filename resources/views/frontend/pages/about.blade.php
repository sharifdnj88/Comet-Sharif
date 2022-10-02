@extends('frontend.layouts.app')

@section('frontend-main')
@include('frontend.layouts.header')
@include('frontend.sections.about.header')
@include('frontend.sections.about.skill')
@include('frontend.sections.about.item')
@include('frontend.sections.about.team')
@include('frontend.sections.about.testimonial')
@include('frontend.sections.about.client')
@include('frontend.layouts.footer')
@endsection