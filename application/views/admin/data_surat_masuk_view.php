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
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NO.SURAT</th>
                                    <th>PENGIRIM</th>
                                    <th>TGL.KIRIM</th>
                                    <th>TGL.TERIMA</th>
                                    <th>PERIHAL</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 0;
                                    foreach ($surat_masuk as $masuk) {
                                        echo '
                                            <tr>
                                                <td>'.++$no.'</td>
                                                <td>'.$masuk->nomor_surat.'</td>
                                                <td>'.$masuk->pengirim.'</td>
                                                <td>'.$masuk->tgl_kirim.'</td>
                                                <td>'.$masuk->tgl_terima.'</td>
                                                <td>'.$masuk->perihal.'</td>
                                                <td>
                                                    <a href="'.base_url('uploads/'.$masuk->file_surat).'" class="btn btn-info btn-sm" target="_blank">Lihat</a>
                                                    <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_ubah" onclick="prepare_update_surat('.$masuk->id_surat.')">Ubah</a>
                                                    <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_ubah_surat" onclick="prepare_update_surat('.$masuk->id_surat.')">Ubah Surat</a>
                                                    <a href="'.base_url('surat/disposisi/'. $masuk->id_surat).'" class="btn btn-primary btn-sm">Disposisi</a>
                                                    <a href="'.base_url('surat/hapus_surat_masuk/'.$masuk->id_surat).'" class="btn btn-danger btn-sm">Hapus</a>
                                                </td>
                                            </tr>
                                        ';
                                    }
                                ?>
                            </tbody>
                        </table>
                </div>
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