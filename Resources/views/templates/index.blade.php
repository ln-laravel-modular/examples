@extends('templates::layouts.master')


@section('content')
  <ul>
    @foreach ($templates as $template)
      <li><a href="/templates/{{ basename($template) }}">{{ basename($template) }}</a></li>
    @endforeach
  </ul>
@endsection
