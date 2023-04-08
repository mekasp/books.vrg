<div class="modal fade" id="createModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="createModalLabel">Create Author</h4>
            </div>
            <div class="modal-body">
                <form id="createForm" name="createForm" class="form-horizontal">
                    <div class="form-group">
                        <label>Surname</label>
                        <input type="text" class="form-control" id="surname" name="surname"
                               placeholder="Enter Surname" value="">
                        <input style="background-color: indianred; display: none" id="surnameCreateError" type="text" class="form-control" value="" disabled>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                               placeholder="Enter Name" value="">
                        <input style="background-color: indianred; display: none" id="nameCreateError" type="text" class="form-control" value="" disabled>
                    </div>
                    <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" class="form-control" id="middleName" name="middleName"
                               placeholder="Enter Middle Name" value="" >
                        <input style="background-color: indianred; display: none" id="middleNameCreateError" type="text" class="form-control" value="" disabled>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-saveCreate" value="add">
                    Save changes
                </button>
            </div>
        </div>
    </div>
</div>
