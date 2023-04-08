<div class="modal fade" id="updateModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="updateModalLabel">Edit Book</h4>
            </div>
            <div class="modal-body">
                <form id="updateForm" name="updateForm" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" id="titleUpdate" name="title"
                               placeholder="Enter title" value="">
                        <input style="background-color: indianred; display: none" id="titleUpdateError" type="text" class="form-control" value="" disabled>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea type="text" class="form-control" id="descriptionUpdate" name="description"
                                  placeholder="Enter Description" value=""></textarea>
                        <input style="background-color: indianred; display: none" id="descriptionUpdateError" type="text" class="form-control" value="" disabled>

                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="imageUpdate" name="image"
                               placeholder="Load image" value="">
                        <input style="background-color: indianred; display: none" id="imageUpdateError" type="text" class="form-control" value="" disabled>
                    </div>
                    <div>
                        <label for="author">Author</label>
                        <select class="form-select form-select-sm" name="authorUpdate" id="authorUpdate" multiple>
                            @foreach($authors as $author)
                                <option class="option_{{ $author['id'] }}" value="{{ $author['id'] }}">{{ $author['surname'] . ' ' . $author['name'] }}</option>
                            @endforeach
                        </select>
                        <input style="background-color: indianred; display: none" id="authorUpdateError" type="text" class="form-control" value="" disabled>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-saveUpdate" value="add">Save changes
                </button>
                <input type="hidden" id="book_id" name="book_id" value="0">
            </div>
        </div>
    </div>
</div>
