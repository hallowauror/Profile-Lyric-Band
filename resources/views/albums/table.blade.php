@extends('layouts.backend', ['title' => $title])
@section('content')
<div class="card">
    <div class="card-header">{{ $title }}</div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Band</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($albums as $key => $album)
                    <tr>
                        <td>{{ $albums->firstItem() + $key }}</td>
                        <td>{{ $album->name }}</td>
                        <td>{{ $album->band->name }}</td>
                        <td>
                            <a href="{{ route('albums.edit', $album)}}" class="btn btn-primary btn-sm">Edit</a>
                            <div endpoint="{{ route('albums.delete', $album)}}" class="delete d-inline"></div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
    {{ $albums->links() }}
@endsection
