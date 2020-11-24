@extends('errors::minimal')

@section('title', __('Maaf, Halaman Tidak Di Temukan!'))
@section('code', '404')
@section('message', __('Maaf, Halaman Tidak Di Temukan!'))
@section('message')
<img src="{{ asset('assets') }}/errors/images/error_404.png" width="500" alt="">
