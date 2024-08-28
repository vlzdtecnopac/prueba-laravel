@extends('layouts.app')

@section('content')
    @livewire('statistic', ['labels' => $labels, 'data' => $data])
@endsection
