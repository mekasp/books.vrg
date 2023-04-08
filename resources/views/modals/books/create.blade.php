<div class="modal fade" id="createModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="createModalLabel">Create Book</h4>
            </div>
            <div class="modal-body">
                <form id="createForm" name="createForm" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                               placeholder="Enter title" value="">
                        <input style="background-color: indianred; display: none" id="titleCreateError" type="text" class="form-control" value="" disabled>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea type="text" class="form-control" id="description" name="description"
                                  placeholder="Enter Description" value=""></textarea>
                        <input style="background-color: indianred; display: none" id="descriptionCreateError" type="text" class="form-control" value="" disabled>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="image" name="image"
                               placeholder="Load image" value="">
                        <input style="background-color: indianred; display: none" id="imageCreateError" type="text" class="form-control" value="" disabled>
                    </div>
                    <div>
                        <label for="author">Author</label>
                        <select class="form-select form-select-sm" name="author" id="author" multiple>
                            @foreach($authors as $author)
                                <option value="{{ $author['id'] }}">{{ $author['surname'] . ' ' . $author['name'] }}</option>
                            @endforeach
                        </select>
                        <input style="background-color: indianred; display: none" id="authorCreateError" type="text" class="form-control" value="" disabled>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-saveCreate" value="add">Save changes
                </button>
            </div>
        </div>
    </div>
</div>
