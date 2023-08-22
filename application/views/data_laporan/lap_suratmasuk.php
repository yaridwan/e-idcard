<?php
$tahun = trim(@$_GET['tahun']);
$sdata = $this->db->query("SELECT a.*, b.`nm_jenissurat` FROM suratmasuk a LEFT JOIN jenissurat b ON a.`id_jenissurat` = b.`id_jenissurat` WHERE LEFT(a.tanggal, 4) = '".$tahun."' ORDER BY a.nosmasuk DESC");
        $judulnya = "LAPORAN SURAT MASUK TAHUN ".$tahun;
?>



<link href="<?php echo base_url();?>assets/css/mpdf-bootstrap.css" rel="stylesheet" type="text/css">

<img src="<?= identitas("logopdf") ?>" style="width:100px;margin-top:-30px;height:70px;">
<div style="border-bottom:4px solid #244c6b;"></div>

<u><h5><b style="text-transform:uppercase;"><?= $judulnya ?></b></h5></u>

<table class="table table-hover table-stripted tabel_ganteng" style="font-size:11px;">
	<thead>
          <tr>
              <th class='text-center'>#</th>
              <th>No. Faktur</th>
              <th>Tanggal</th>
              <th>Dari</th>
              <th>Hal</th>
              <th>Jensi Surat</th>
          </tr>
	</thead>
		<tbody>
          <?php
			$nodata = 1;
            
			foreach($sdata->result_array() as $ddata){
				echo"
					<tr>
						<td class='text-center'>".$nodata.".</td>
						<td>".$ddata['nosmasuk']."</td>
						<td>".tgl_indo($ddata['tanggal'],"a")."</td>
						<td>".$ddata['dari']."</td>
						<td>".$ddata['hal']."</td>
						<td>".$ddata['nm_jenissurat']."</td>
					</tr>
				";
				$nodata++;
			}
		?>
	</tbody>
  </table>