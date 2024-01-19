@extends('layouts.app')
@section('content')
    <section class="container">
        <h1>Technology List</h1>
        <div class="text-end">
            <a href="{{route('admin.technologies.create')}}" class="btn btn-success">Create new technology</a>
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
                    {{-- @if (Auth::id() == 1)
                    @endif --}}

                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>

                  </tr>
                </thead>
                <tbody>
                    @foreach ($technologies as $technology)
                        <tr>
                            <td><a href="{{route('admin.technologies.show', $technology->slug)}}" title="View Technology">{{$technology->name}}</a></td>

                            <td><a class="link-secondary" href="{{route('admin.technologies.edit', $technology->slug)}}" title="Edit Technology"><i class="fa-solid fa-pen"></i></a></td>
                            <td>
                                <form action="{{route('admin.technologies.destroy', $technology->slug)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn btn btn-danger ms-3" data-item-title="{{$technology->name}}"><i class="fa-solid fa-trash-can"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </section>
    @include('partials.modal_delete')
@endsection
