@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Note') }}</div>

                    <div class="card-body">
                        <div class="row mb-3 flex align-items-center justify-content-center">
                            <label for="title" class="col-auto alert alert-info">{{ 'Created by: ' .$note->user->name }}</label>
                        </div>
                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title"
                                    value="{{ $note->title }}" required readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="title"
                                class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control" name="description" required readonly>{{ $note->description }}
                                </textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="shared"
                                class="col-md-4 col-form-label text-md-end">{{ __('Shared with') }}</label>
                                <ul class="p-2 gap-4 d-inline-flex align-items-center justify-content-center">
                                @foreach ($note->shared as $u)
                                    <li>{{ $u->name }}</li>
                                @endforeach
                                </ul>
                        </div>
                        <div class="row d-flex align-items-center justify-content-center">
                            <div class="col-3">
                                <a class="btn btn-secondary w-100" href="{{ route('notes.edit', $note->id) }}">Edit</a>
                            </div>
                            <div class="col-3">
                                <form class="d-flex align-items-center justify-content-center" method="POST"
                                    action="{{ route('notes.destroy', $note->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger w-100" type="submit">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
