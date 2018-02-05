<div class="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Data Surat Masuk</h1>
		</div>
	</div>
    <?php 
        $notif = $this->session->flashdata('notif');
        if ($notif != NULL) {
            echo '
                <div class="alert alert-info">'.$notif.'</div>
            ';
        }
    ?>
	<div class="row">
		<div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_add"><span class="fa fa-plus"></span> Tambah Surat</a>
                </div>
                <!-- /.panel-heading -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
	</div>
</div>
<!--  MODAL tambah surat -->
    <div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="modal_addLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?php echo base_url(); ?>index.php/surat/tambah_surat_masuk" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal_addLabel">Tambah Surat Masuk</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nomor Surat</label>
                            <input type="text" name="no_surat" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Tgl.Kirim</label>
                            <input type="date" name="tgl_kirim" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Tgl.Terima</label>
                            <input type="date" name="tgl_terima" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Pengirim</label>
                            <input type="text" name="pengirim" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Penerima</label>
                            <input type="text" name="penerima" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Perihal</label>
                            <input type="text" name="perihal" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Unggah Surat (*.pdf)</label>
                            <input type="file" name="file_surat" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                        <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>