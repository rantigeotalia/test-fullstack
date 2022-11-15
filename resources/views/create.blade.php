<div class="modal-header">
    <h5 class="modal-title">Tambah Data</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">×</span>
    </button>
</div>
<form action="javascript:formSubmit('modal_input')" id="modal_input" 
    url="{{ route('customer.create') }}"
    method="post">
<div class="modal-body">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>NAMA</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="NAMA" required>
            </div>
            <div class="form-group">
                <label>EMAIL</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="EMAIL" required>
            </div>
            <div class="form-group">
                <label>No Telpon</label>
                <input type="text" class="form-control"  name="no_telp" id="no_telp" laceholder="NO TELPON">
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" onclick="formSubmit('modal_input')" class="btn btn-primary"><i id="msg_modal_input"></i>  Save changes</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
</form>