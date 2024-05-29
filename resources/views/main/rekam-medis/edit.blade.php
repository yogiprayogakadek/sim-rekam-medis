<div class="col-sm-12">
    <div class="panel panel-default card-view">
        <div class="panel-heading">
            <div class="pull-right">
                <button class="btn btn-primary btn-rounded btn-lable-wrap left-label btn-data"> <span class="btn-label"><i
                            class="fa fa-arrow-left white-icon"></i> </span><span class="btn-text">List
                        Data</span></button>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-wrapper collapse in">
            <div class="panel-body">
                <div class="form-wrap">
                    <form id="formUpdate">
                        <input type="text" name="id" class="form-control hidden" value="{{ $rekamMedis->id }}">
                        <div class="form-group mb-0 mb-15 with-validation kode" id="kode-group">
                            <label class="control-label mb-10 " for="kode">Kode</label>
                            <input type="text" id="kode" name="kode" class="form-control"
                                placeholder="kode rekam-medis" value="{{ $rekamMedis->kode }}">
                            <div class="help-block with-errors error-message">
                                <ul class="list-unstyled">
                                    <li class="error-kode"></li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group mb-15 with-validation dokumen">
                            <label class="control-label mb-10 text-left">File upload</label> <small>(biarkan
                                kosong jika tidak ingin mengganti dokumen)</small>
                            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                <div class="form-control" data-trigger="fileinput"> <i
                                        class="glyphicon glyphicon-file fileinput-exists"></i> <span
                                        class="fileinput-filename"></span></div>
                                <span class="input-group-addon fileupload btn btn-info btn-anim btn-file"><i
                                        class="fa fa-upload"></i> <span class="fileinput-new btn-text">Select
                                        file</span> <span class="fileinput-exists btn-text">Change</span>
                                    <input type="file" name="dokumen">
                                </span> <a href="#"
                                    class="input-group-addon btn btn-danger btn-anim fileinput-exists"
                                    data-dismiss="fileinput"><i class="fa fa-trash"></i><span class="btn-text">
                                        Hapus</span></a>
                            </div>
                            <div class="help-block with-errors error-message">
                                <ul class="list-unstyled">
                                    <li class="error-dokumen"></li>
                                </ul>
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <button class="btn btn-success btn-anim btn-update" type="button"><i
                                    class="icon-rocket"></i><span class="btn-text">Simpan</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
