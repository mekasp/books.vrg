@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex bd-highlight mb-4">
            <div class="p-2 w-100 bd-highlight">
                <h2>Books</h2>
            </div>
            <div class="p-2 flex-shrink-0 bd-highlight">
                <button  id="btn-add">
                    Add Book
                </button>
            </div>
        </div>
        <div>
            <table style="width: 100%" class="table" id="bookTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Authors</th>
                    <th>Published At</th>
                    <th>Actions</th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="books-list">
                @foreach ($books as $data)
                    <tr id="book{{ $data->id }}">
                        <td>{{$data->id}}</td>
                        @if(isset($data->image) && $data->image != null)
                            <td><img style="height: 100px; width: 100px;" src="storage/books/{{ $data->image }}"></td>
                        @else
                            <td><img style="height: 100px; width: 100px;" src="storage/default/No-Image-Placeholder.svg.png"></td>
                        @endif
                        <td>{{$data->title}}</td>
                        <td>{{$data->description?: ''}}</td>
                        <td>{{$data->authors->pluck('surname')->join(', ')}}</td>
                        <td>{{$data->created_at}}</td>
                        <td>
                            <button class="open-update-modal" id="btn-update" value="{{ $data->id }}">
                                Edit
                            </button>
                        </td>
                        <td>
                            <button class="deleteBook" id="btn-delete" value="{{ $data->id }}">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @include('modals.books.create')
            @include('modals.books.update')
{{--            <div class="modal fade" id="createModal" aria-hidden="true">--}}
{{--                <div class="modal-dialog">--}}
{{--                    <div class="modal-content">--}}
{{--                        <div class="modal-header">--}}
{{--                            <h4 class="modal-title" id="createModalLabel">Create Book</h4>--}}
{{--                        </div>--}}
{{--                        <div class="modal-body">--}}
{{--                            <form id="createForm" name="createForm" class="form-horizontal" enctype="multipart/form-data">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>Title</label>--}}
{{--                                    <input type="text" class="form-control" id="title" name="title"--}}
{{--                                           placeholder="Enter title" value="">--}}
{{--                                    <input style="background-color: indianred; display: none" id="titleCreateError" type="text" class="form-control" value="" disabled>--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="description">Description</label>--}}
{{--                                    <textarea type="text" class="form-control" id="description" name="description"--}}
{{--                                              placeholder="Enter Description" value=""></textarea>--}}
{{--                                    <input style="background-color: indianred; display: none" id="descriptionCreateError" type="text" class="form-control" value="" disabled>--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="image">Image</label>--}}
{{--                                    <input type="file" class="form-control" id="image" name="image"--}}
{{--                                           placeholder="Load image" value="">--}}
{{--                                    <input style="background-color: indianred; display: none" id="imageCreateError" type="text" class="form-control" value="" disabled>--}}
{{--                                </div>--}}
{{--                                <div>--}}
{{--                                    <label for="author">Author</label>--}}
{{--                                    <select class="form-select form-select-sm" name="author" id="author" multiple>--}}
{{--                                        @foreach($authors as $author)--}}
{{--                                            <option value="{{ $author['id'] }}">{{ $author['surname'] . ' ' . $author['name'] }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                    <input style="background-color: indianred; display: none" id="authorCreateError" type="text" class="form-control" value="" disabled>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                        <div class="modal-footer">--}}
{{--                            <button type="button" class="btn btn-primary" id="btn-saveCreate" value="add">Save changes--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="modal fade" id="updateModal" aria-hidden="true">--}}
{{--                <div class="modal-dialog">--}}
{{--                    <div class="modal-content">--}}
{{--                        <div class="modal-header">--}}
{{--                            <h4 class="modal-title" id="updateModalLabel">Edit Book</h4>--}}
{{--                        </div>--}}
{{--                        <div class="modal-body">--}}
{{--                            <form id="updateForm" name="updateForm" class="form-horizontal" enctype="multipart/form-data">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>Title</label>--}}
{{--                                    <input type="text" class="form-control" id="titleUpdate" name="title"--}}
{{--                                           placeholder="Enter title" value="">--}}
{{--                                    <input style="background-color: indianred; display: none" id="titleUpdateError" type="text" class="form-control" value="" disabled>--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>Description</label>--}}
{{--                                    <textarea type="text" class="form-control" id="descriptionUpdate" name="description"--}}
{{--                                              placeholder="Enter Description" value=""></textarea>--}}
{{--                                    <input style="background-color: indianred; display: none" id="descriptionUpdateError" type="text" class="form-control" value="" disabled>--}}

{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="image">Image</label>--}}
{{--                                    <input type="file" class="form-control" id="imageUpdate" name="image"--}}
{{--                                           placeholder="Load image" value="">--}}
{{--                                    <input style="background-color: indianred; display: none" id="imageUpdateError" type="text" class="form-control" value="" disabled>--}}
{{--                                </div>--}}
{{--                                <div>--}}
{{--                                    <label for="author">Author</label>--}}
{{--                                    <select class="form-select form-select-sm" name="authorUpdate" id="authorUpdate" multiple>--}}
{{--                                        @foreach($authors as $author)--}}
{{--                                            <option class="option_{{ $author['id'] }}" value="{{ $author['id'] }}">{{ $author['surname'] . ' ' . $author['name'] }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                    <input style="background-color: indianred; display: none" id="authorUpdateError" type="text" class="form-control" value="" disabled>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                        <div class="modal-footer">--}}
{{--                            <button type="button" class="btn btn-primary" id="btn-saveUpdate" value="add">Save changes--}}
{{--                            </button>--}}
{{--                            <input type="hidden" id="book_id" name="book_id" value="0">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/pages/book.js') }}" defer></script>
@endpush
