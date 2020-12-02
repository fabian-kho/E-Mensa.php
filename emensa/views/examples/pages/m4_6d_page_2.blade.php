@extends('examples.layout.m4_6d_layout')

@section('title')
    {{$title}}
@endsection

@section('header')
           Page 2
@endsection

@section('main')
    @forelse($data as $a)
        <li>{{$a['name']}}</li>
    @empty
        <li>Keine Daten vorhanden.</li>
    @endforelse
@endsection

@section('footer')
    Test Test Page 2
@endsection