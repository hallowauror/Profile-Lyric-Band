@extends('layouts.backend')
@section('content')
<div class="card">
    <div class="card-header">{{ $title }}</div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Genres</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bands as $key = $band)
                    <tr>
                        <td>{{ $bands->firstItem() + $key }}</td>
                        <td>{{ $band->name }}</td>
                        <td>{{ $band->genres()->get()->implode('name', ', ') }}</td>
                        <td>
                            <a href="{{ route('bands.edit', $band) }}" class="btn btn-primary btn-sm">Edit</a>
                            <div endpoint="{{ route('bands.delete', $band) }}" class="delete d-inline"></div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
    {{ $bands->links() }}
@endsection
