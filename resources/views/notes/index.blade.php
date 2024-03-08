@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row mb-4 d-flex align-items-center justify-content-center">
                    <div class="col-4">
                        <a class="btn btn-lg btn-success w-100" href="{{ route('notes.create') }}">Create note</a>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Created By</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notes as $item)
                                <tr>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ App\Models\User::find($item->user_id)->name }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td class="row gap-0 d-flex align-items-center justify-content-center">
                                        <div class="col-auto">
                                            <a class="btn btn-sm btn-primary w-100" href="{{ route('notes.show', $item->id) }}">Show</a>
                                        </div>
                                        <div class="col-auto">
                                            <a class="btn btn-sm btn-secondary w-100"
                                            href="{{ route('notes.edit', $item->id) }}">Edit</a>
                                        </div>
                                        
                                        <form class="col-auto" action="{{ route('notes.destroy', $item->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-sm btn-danger w-100" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
