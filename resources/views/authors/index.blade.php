@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex bd-highlight mb-4">
            <div class="p-2 w-100 bd-highlight">
                <h2>Authors</h2>
            </div>
            <div class="p-2 flex-shrink-0 bd-highlight">
                <button  id="btn-add">
                    Add Author
                </button>
            </div>
        </div>
        <div>
            <table style="width: 100%" class="table" id="bookTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Surname</th>
                    <th>Name</th>
                    <th>Middle_name</th>
                    <th>Actions</th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="author-list">
                @foreach ($authors as $data)
                    <tr id="author{{ $data->id }}">
                        <td>{{$data->id}}</td>
                        <td>{{$data->surname}}</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->middle_name?: ''}}</td>
                        <td>
                            <button class="open-update-modal" id="btn-update" value="{{ $data->id }}">
                                Edit
                            </button>
                        </td>
                        <td>
                            <button class="deleteAuthor" id="btn-delete" value="{{ $data->id }}">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @include('modals.authors.create')
            @include('modals.authors.update')
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/pages/author.js') }}" defer></script>
@endpush
