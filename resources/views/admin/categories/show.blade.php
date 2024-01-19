@extends('layouts.app')
@section('content')
    <section class="container">
        <h1>{{$category->name}}</h1>
        <ul>
            @forelse ($category->projects as $project)
                
                    <li>{{$project->title}}</li>
            @empty
                <li>No projects</li>
            @endforelse
        </ul>
    </section>
@endsection

