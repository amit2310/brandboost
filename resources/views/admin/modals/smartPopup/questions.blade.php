<div id="editSmartAnswer" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" class="form-horizontal" id="updateSmartAnswer" action="javascript:void();">
				@csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Update Answer</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-lg-3">Answer</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" rows="8"  placeholder="Leave Answer" name="txtAnswer" id="edit_smart_answer" required ></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="answerId" id="edit_smart_answer_id" value="">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                    <button type="submit" class="btn dark_btn"><i class="icon-check"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="editSmartNoteSection" class="modal fade" style="z-index:99999;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" class="form-horizontal" id="updateSmartNote" action="javascript:void();">
				@csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Update Note</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-lg-3">Note</label>
                        <div class="col-lg-9">
                            <textarea class="form-control"  placeholder="Note" name="edit_note_content" id="edit_smart_note_content" required ></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="edit_noteid" id="edit_smart_noteid" value="">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                    <button type="submit" class="btn dark_btn"><i class="icon-check"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

