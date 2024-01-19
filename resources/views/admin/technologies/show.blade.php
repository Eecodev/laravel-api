@extends('layouts.app')
@section('content')
    <section class="container">
        <h1>{{$technology->name}}</h1>
        <h3>Project List</h3>
        <ul class="list-group list-group-flush">
            @forelse ($technology->projects as $project)
                <li class="list-group-item">
                    <a href="{{route('admin.projects.show', $project->slug)}}" class="link-underline link-underline-opacity-0">{{$project->title}}</a>
                </li>
            @empty
                <li>No projects</li>
            @endforelse
        </ul>
    </section>
@endsection

