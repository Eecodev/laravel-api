@extends('layouts.app')
@section('content')
    <section class="container">
        <h1>Project List</h1>
        <div class="text-end">
            <a href="{{route('admin.projects.create')}}" class="btn btn-success">Create new project</a>
        </div>
        @if(session()->has('message'))
            <div class="alert alert-success mb-3 mt-3">
                {{session()->get('message')}}
            </div>
        @endif

            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Url</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <td><a href="{{route('admin.projects.show', $project->slug)}}" title="View Project">{{$project->title}}</a></td>
                            <td>{{Str::limit($project->description, 100)}}</td>
                            <td><a href="{{route('admin.projects.show', $project->slug)}}">{{$project->url}}</a></td>
                            <td><a class="link-secondary" href="{{route('admin.projects.edit', $project->slug)}}" title="Edit Project"><i class="fa-solid fa-pen"></i></a></td>

                            <td>
                                <form action="{{route('admin.projects.destroy', $project->slug)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn btn btn-danger ms-3" data-item-title="{{$project->title}}"><i class="fa-solid fa-trash-can"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$projects->links('vendor.pagination.bootstrap-5')}}
    </section>
@endsection
