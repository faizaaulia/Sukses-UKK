<div class="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Dashboard Pegawai</h1>
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
                    <span>Data Disposisi Surat</span>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NO.SURAT</th>
                                    <th>UNIT PENGIRIM</th>
                                    <th>PENGIRIM</th>
                                    <th>TGL.DISPOSISI</th>
                                    <th>CATATAN</th>
                                    <th>KETERANGAN</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 0;
                                    foreach ($data_disposisi as $masuk) {
                                        echo '
                                            <tr>
                                                <td>'.++$no.'</td>
                                                <td>'.$masuk->nomor_surat.'</td>
                                                <td>'.$masuk->nama_jabatan.'</td>
                                                <td>'.$masuk->nama.'</td>
                                                <td>'.$masuk->tgl_disposisi.'</td>
                                                <td>'.$masuk->keterangan.'</td>
                                                ';
                                                if ($masuk->id_pegawai_penerima == $this->session->userdata('id_pegawai')) {
                                                	echo '<td><label class="label label-info">Disposisi Masuk</label></td>';
                                                }
                                                echo '
                                                <td>
                                                    <a href="'.base_url('uploads/'.$masuk->file_surat).'" class="btn btn-sm btn-info btn-block" target="_blank">Lihat</a>
                                                    <a href="'.base_url().'index.php/surat/disposisi_keluar/'.$masuk->id_surat.'" class="btn btn-sm btn-primary btn-block">Disposisi</a>
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