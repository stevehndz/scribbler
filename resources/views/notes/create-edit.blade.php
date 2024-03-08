@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Note') }}</div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $e)
                                    {{ $e }}
                                @endforeach
                            </div>
                        @endif

                        <form action="{{ $isEdit ? route('notes.update', $note->id) : route('notes.store') }}" method="POST">
                            @csrf
                            @if ($isEdit)
                                @method('PUT')
                            @endif
                            <div class="row mb-3">
                                <label for="title"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="title"
                                        value="{{ $isEdit ? $note->title : old('title') }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="title"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <textarea id="description" type="text" class="form-control" name="description" required>{{ $isEdit ? $note->description : old('description') }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="share"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Share with others') }}</label>

                                <div class="col-md-6">
                                    <select class="form-select" name="share[]" id="share" multiple aria-label="multiple select example">
                                        @foreach (App\Models\User::all()->except(Auth::id()) as $user)
                                            <option value="{{ $user->id }}" {{ $isEdit ? ($note->shared->contains($user) ? 'selected' : '') : '' }}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row d-flex align-items-center justify-content-center">
                                <div class="col-3">
                                    <button class="btn btn-primary w-100" type="submit">{{ $isEdit ? 'Update' : 'Create' }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
