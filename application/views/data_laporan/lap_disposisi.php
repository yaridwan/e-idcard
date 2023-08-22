<?php

    $tahun = trim(@$_GET['tahun']);

    $sdata = $this->db->query("SELECT a.*, b.`nm_sifat`, LEFT(a.addedon, 10) AS tanggalnya, c.nm_pegawai AS nm_sumber, d.nm_pegawai AS nm_tujuan FROM disposisi a LEFT JOIN sifat b ON a.`id_sifat` = b.`id_sifat` LEFT JOIN pegawai c ON a.sumber = c.no_pegawai LEFT JOIN pegawai d ON a.tujuan = d.no_pegawai WHERE LEFT(a.addedon, 4) = '".$tahun."' ORDER BY a.id_disposisi DESC");
        $judulnya = "LAPORAN DISPOSISI SURAT TAHUN ".$tahun;
?>

<link href="<?php echo base_url();?>assets/css/mpdf-bootstrap.css" rel="stylesheet" type="text/css">

<img src="<?= identitas("logopdf") ?>" style="width:100px;margin-top:-30px;height:70px;">
<div style="border-bottom:4px solid #244c6b;"></div>

<u><h5><b style="text-transform:uppercase;"><?= $judulnya ?></b></h5></u>

<table class="table table-hover table-stripted tabel_ganteng" style="font-size:11px;">
	<thead>
        <tr>
            <th class='text-center'>#</th>
            <th>Faktur</th>
            <th>Tanggal</th>
            <th>Sumber</th>
            <th>Tujuan</th>
            <th>Jenis</th>
            <th>Sifat</th>
        </tr>
	</thead>
	<tbody>
        <?php
			$nodata = 1;
			foreach($sdata->result_array() as $ddata){
                if($ddata['jenis'] == "smasuk"){
                    $jeniso = "Surat Masuk";
                    $faktur = $ddata['nosmasuk'];
                }else{
                    $faktur = $ddata['noskeluar'];
                    $jeniso = "Surat Keluar";
                }
				echo"
					<tr>
						<td class='text-center'>".$nodata.".</td>
                        <td>".$faktur."</td>
                        <td>".tgl_indo($ddata['tanggalnya'],"a")."</td>
                        <td>".$ddata['nm_sumber']."</td>
                        <td>".$ddata['nm_tujuan']."</td>
                        <td>".$jeniso."</td>
                        <td>".$ddata['nm_sifat']."</td>
					</tr>
				";
				$nodata++;
			}
		?>
	</tbody>
  </table>