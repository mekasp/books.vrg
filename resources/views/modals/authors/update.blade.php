<div class="modal fade" id="updateModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="createModalLabel">Update Author</h4>
            </div>
            <div class="modal-body">
                <form id="updateForm" name="updateForm" class="form-horizontal">
                    <div class="form-group">
                        <label>Surname</label>
                        <input type="text" class="form-control" id="surnameUpdate" name="surnameUpdate"
                               placeholder="Enter Surname" value="" required>
                        <input style="background-color: indianred; display: none" id="surnameUpdateError" type="text" class="form-control" value="" disabled>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" id="nameUpdate" name="nameUpdate"
                               placeholder="Enter Name" value="" required>
                        <input style="background-color: indianred; display: none" id="nameUpdateError" type="text" class="form-control" value="" disabled>
                    </div>
                    <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" class="form-control" id="middleNameUpdate" name="middleNameUpdate"
                               placeholder="Enter Middle Name" value="" >
                        <input style="background-color: indianred; display: none" id="middleNameUpdateError" type="text" class="form-control" value="" disabled>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-saveUpdate" value="add">
                    Save changes
                </button>
                <input type="hidden" id="author_id" name="author_id" value="0">
            </div>
        </div>
    </div>
</div>
