@extends('examples.layout.m4_6d_layout')

@section('title')
    {{$title}}
@endsection

@section('header')
    Page 1

@endsection

@section('main')
    @forelse($data as $a)
        <li>
            {{$a['name']}}
            {{$a['preis_intern']}}
        </li>
    @empty
        <li>Es sind keine Gerichte vorhanden.</li>
    @endforelse
@endsection

@section('footer')
    Test Test Page 2
@endsection