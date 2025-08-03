<div class="modal fade" id="approvedTransfer" tabindex="-1" role="dialog" aria-labelledby="approvedTransfer" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="trApprovedTransferForm" name="trApprovedTransferForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" id="tr_id" name="tr_id" value="">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Approved Equipment Transfer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tr_description">Comments <span style="color: #FF0000">*</span></label>
                        <textarea class="form-control" rows="4" id="tr_description" name="tr_description" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Accept</button>
                </div>
            </div>
        </form>
    </div>
</div>
