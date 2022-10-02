@extends('frontend.layouts.app')

@section('frontend-main')
@include('frontend.layouts.header')
@include('frontend.sections.contact.contact_header')
@include('frontend.sections.contact.contact_address')
@include('frontend.sections.contact.contact_form')
@include('frontend.sections.contact.contact_counter')
@include('frontend.layouts.footer')
@endsection