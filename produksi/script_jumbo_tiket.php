<?php require_once("../include/config.php"); ?>
<?php require_once("../include/session.php"); ?>
<?php require_once("../include/function.php"); ?>
<?php  
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

    $act = $_REQUEST['act'];
    switch($act){
        case 'show_table': show_table(); break;
     //   case 'add_data': add_data(); break;
        case 'save': save(); break;
        case 'delete_data': delete_data(); break;
      //  case 'edit_data': add_data(); break;
        case 'edit': edit(); break;
      //  case 'add_order': add_order(); break;
		case 'approve_data': approve_data(); break;
		case 'save_order':  save_order(); break;
		case 'delete_order': delete_order(); break;
		case 'save_group':  save_group(); break;
		case 'un_approve_data': un_approve_data(); break;
		//case 'form_add_group_mesin' : form_add_group_mesin(); break;
		case 'save_group_mesin' : save_group_mesin(); break;
		case 'form_add_order' : form_add_order(); break;
		case 'save_jumbo' : save_jumbo(); break;
		case 'cetak_label_kecil' :  cetak_label_kecil(); break;
		case 'delete_detail': delete_detail(); break;
        case 'approve_detail': approve_detail(); break;
 		case 'save_quality_alert': save_quality_alert(); break;
		case 'form_add_received': form_add_received(); break;
		case 'save_received': save_received(); break;
		case 'ubah_cs': ubah_cs(); break;

    }
function ubah_cs()
{
	$pilihan = $_REQUEST['par'];
	$arr = explode("|", $pilihan);
	$id_tr_jumbo_tiket = trim($arr[0]);
	$nilai = trim($arr[1]);

if ($nilai == "null") {die();}
			//$id_detail = trim($arr[3]);
	$sql = "UPDATE tr_jumbo_tiket SET no_cs = '$nilai' WHERE id_tr_jumbo_tiket = '$id_tr_jumbo_tiket' ";
	$query = mysql_query($sql) or die('ERROR ' .$pilihan .' : '.$sql); 
	$jumlah =  mysql_affected_rows();
	if ($jumlah > 0) {$status = 'sukses';}

	$sql = "UPDATE m_seasoning_rack SET cs = '$nilai' WHERE id_tr_jumbo_tiket = '$id_tr_jumbo_tiket' ";
	$query = mysql_query($sql) or die('ERROR ' .$pilihan .' : '.$sql); 
	
	echo $status;

//echo 'xx - '.$par;
//echo "<input name='text_it' type='text'  class='textbox_angka' id='text_it' maxlength='40' value = '".$panjang[$k]."' onkeypress='return isNumber(event)' />";
}
function save_received()
{
		$pilihan = $_REQUEST['pilihan'];
		
		$arr = explode("|", $pilihan);
		$offset = trim($arr[0]);
		$id_tr_jumbo_order = trim($arr[1]);
		//$id_detail = trim($arr[3]);
//die('xx'.$pilihan);
		$usernya = $_SESSION['userid'];
		//$id_tr_jumbo_order = $_POST['id_tr_jumbo_order'];		
		//$id_tr_jumbo_tiket = $_POST['id_tr_jumbo_tiket'];
		$periode = $_POST['periode'];
		$txt_keterangan = trim($_POST['txt_keterangan']);
		
//		echo  'xx'.$id_tr_jumbo_order . ' zz '. $txt_keterangan;
		
		$sql = "UPDATE tr_jumbo_order 
		       SET  userid_received = '$usernya',
			        keterangan_received = '$txt_keterangan ',
			        date_received = now() 
				WHERE id_tr_jumbo_order = '$id_tr_jumbo_order'";
//		echo $sql ;		
		$query = mysql_query($sql) or die('ERROR ' .$pilihan .' : '.$sql); 
		echo 'sukses';	
}

function save_quality_alert()
{
$pilihan = $_REQUEST['pilihan'];
//echo 'xx'.$pilihan ;
		$arr = explode("|", $pilihan);
		//$pilihan = trim($arr[2]);
		$id_tr_quality_alert = trim($arr[3]);
		$usernya = $_SESSION['userid'];
		$corrective = $_POST['txt_corrective'];

		$sql = "UPDATE tr_quality_alert
		SET  corrective = '$corrective', 
			 userid_corrective = '$usernya',
			 date_corrective  = now()
		WHERE id_tr_quality_alert = '$id_tr_quality_alert' ";
//echo $sql;
$query = mysql_query($sql) or die('ERROR ' .$pilihan .' : '.$sql); 
echo 'sukses';
}
function delete_detail()
{
$pilihan = $_REQUEST['pilihan'];
//echo 'xx'.$pilihan ;
		$arr = explode("|", $pilihan);
		//$pilihan = trim($arr[2]);
		$id_detail = trim($arr[2]);

$sql = " DELETE FROM tr_winding WHERE id_tr_jumbo_tiket = '$id_detail'  ";
//echo $sql_exe ;
$qry = mysql_query($sql) or die('ERROR ' .$pilihan .' : '.$sql); 


$sql_exe = " DELETE FROM tr_jumbo_tiket WHERE id_tr_jumbo_tiket = '$id_detail'  ";
//echo $sql_exe ;
$query = mysql_query($sql_exe) or die('ERROR ' .$pilihan .' : '.$sql_exe); 
echo 'sukses';
}

function cetak_label_kecil()
{
//die('vvxxx'.$copies);
require_once("../print_barcode/label_kecil_jumbo.php");
$txt_lemparan = $_REQUEST['id'];
$copies = $_REQUEST['copies'];
$usernya = $_SESSION['userid'];


//echo 'vvv'.$txt_lemparan;

$jum = substr_count($txt_lemparan,",");
//echo '<br>'. $jum ;
// proses_cetak_label_kecil($txt_lemparan);


$arr = explode(",",$txt_lemparan);

for($i=0;$i<$jum;$i++)
	{

	$id = $arr[$i];
if( isset( $copies ) ) {
      // The Copies Variable exists
        for( $j=0 ; $j<$copies ; $j++ ) {
          	// Run X times - Once for each Copy
			//echo $j . ' - '. $arr[$i] .'<br>';
           proses_cetak_label_kecil($arr[$i]);
        }
    } else {
      // The Copies Variable does not exist - Assume 1 Copy
       proses_cetak_label_kecil($arr[$i]);
    }
	
	
	} 

}
function approve_detail ()
{
/*$pilihan = $_REQUEST['pilihan'];
$arr = explode("|", $pilihan);
$pilihan = trim($arr[2]);
*/
$list_antrian_app = $_POST['list_antrian_app'];
//echo 'xx = '.$list_antrian_app;


$jum = substr_count($list_antrian_app,",");

$arr = explode(",",$list_antrian_app);

for($i=0;$i<$jum;$i++)
	{
		approve_data($arr[$i]);
	}
	//echo 'sukses';
}

function save_jumbo()
{
$pilihan = $_REQUEST['pilihan'];
//echo 'pilihan = ' .$pilihan;
 //if(isset($_REQUEST['offset']))    $offset = $_REQUEST['offset']; else $offset = 0;

		
		$arr = explode("|", $pilihan);
		$pilihan = trim($arr[2]);
		//$id_detail = trim($arr[3]);
//die('xx'.$pilihan);
		$usernya = $_SESSION['userid'];
		$id_tr_jumbo_order = $_POST['id_tr_jumbo_order'];		
		$id_tr_jumbo_tiket = $_POST['id_tr_jumbo_tiket'];
		$periode = $_POST['periode'];

		//$id_m_line = $_POST['cbo_m_line'];	//jika line boleh ubah
		$id_m_line = $_POST['id_m_line_jumbo'];	 //line ikut ppcd

		$id_m_shift = $_POST['cbo_shift'];
		$id_m_group_shift = $_POST['cbo_m_group_shift'];
		
		$batch_no = trim($_POST['text_batch_no']);
		$text_tanggal_awal = $_POST['text_tanggal_awal'];
		$hour_from = $_POST['hour_from'];
		$minute_from = $_POST['minute_from'];

		$no_jumbo = trim($_POST['text_no_jumbo']);
		$no_cs = trim($_POST['text_cs']);

		$text_tanggal_akhir = $_POST['text_tanggal_akhir'];
		$hour_to = $_POST['hour_to'];
		$minute_to = $_POST['minute_to'];


		$hour_from = str_pad($_POST['hour_from'], 2, "0", STR_PAD_LEFT);
		$minute_from = str_pad($_POST['minute_from'], 2, "0", STR_PAD_LEFT);

		$waktu_awal = $text_tanggal_awal ." ".$hour_from.":".$minute_from;
		
		$hour_to = str_pad($_POST['hour_to'], 2, "0", STR_PAD_LEFT);
		$minute_to = str_pad($_POST['minute_to'], 2, "0", STR_PAD_LEFT);

		$waktu_akhir = $text_tanggal_akhir ." ".$hour_to.":".$minute_to;

		$berat_net = trim($_POST['text_berat_net']);

		$width = trim($_POST['text_width']);		
		$length = trim($_POST['text_length']);
		$id_m_spindle = trim($_POST['cbo_spindle']);
		$speed = trim($_POST['text_speed']);

		$it = trim($_POST['text_it']);		
		$taper_t = trim($_POST['text_taper_t']);
		$ip = trim($_POST['text_ip']);
		$taper_p = trim($_POST['text_taper_p']);
		$jumbo_density = trim($_POST['text_jumbo_density']);
		$berat_net = trim($_POST['text_berat_net']);
		$keterangan = trim($_POST['txt_keterangan']);
		$type_bahan = trim($_POST['type_bahan']);
		$lotno = trim($_POST['lotno']);
		$text_waste = trim($_POST['text_waste']);
	
  		$text_waste_mdo = trim($_POST['text_waste2']);
   		$text_waste_tdo = trim($_POST['text_waste3']);
		
		
//echo 'jum_winding = ' .$jum_winding;


//die('xxx'. $minute_from);
if ($pilihan == '1')
		
 		{
$sql_ = "
SELECT max(a.no_jumbo_tiket) from tr_jumbo_tiket a
INNER JOIN tr_jumbo_order b ON a.id_tr_jumbo_order = b.id_tr_jumbo_order
WHERE b.periode = '$periode' ";
$result_ = mysql_query($sql_);
			while ($row_ = mysql_fetch_array($result_, MYSQL_NUM)) 
			{
    			$no_max = intval($row_[0]) + 1;
			}

$sql_exe = "INSERT INTO tr_jumbo_tiket 
(id_tr_jumbo_order,id_m_shift,id_m_group_shift,id_m_line,no_jumbo_tiket,
waktu_awal,waktu_akhir,no_jumbo,batch_no,no_cs,
lebar,panjang,berat_net,id_m_spindle,speed,type_bahan,lotno,waste,
it,taper_t,ip,taper_p,jumbo_density,keterangan,userid_created,date_created,waste_mdo, waste_tdo) VALUES 
('$id_tr_jumbo_order','$id_m_shift','$id_m_group_shift','$id_m_line','$no_max',
'$waktu_awal','$waktu_akhir','$no_jumbo','$batch_no','$no_cs',
'$width','$length','$berat_net','$id_m_spindle','$speed','$type_bahan','$lotno','$text_waste',
'$it','$taper_t','$ip','$taper_p','$jumbo_density','$keterangan','$usernya',now(), '$text_waste_mdo','$text_waste_tdo') 
	";
		}
else
		
 		{
$sql_exe =" UPDATE tr_jumbo_tiket SET 
			id_m_shift = '$id_m_shift' ,
			id_m_group_shift = '$id_m_group_shift' ,
			id_m_line = '$id_m_line',
			waktu_awal = '$waktu_awal' ,
			waktu_akhir = '$waktu_akhir' ,
			no_jumbo = '$no_jumbo' ,
			batch_no = '$batch_no' ,
			no_cs = '$no_cs' ,
			it = '$it' ,
			taper_t = '$taper_t' ,
			ip = '$ip' ,
			taper_p = '$taper_p' ,
			jumbo_density = '$jumbo_density' ,
			lebar = '$width' ,
			panjang = '$length' ,
			berat_net = '$berat_net' ,
			id_m_spindle = '$id_m_spindle' ,
			speed = '$speed' ,
			keterangan = '$keterangan' ,
			userid_modified = '$usernya' ,
			type_bahan = '$type_bahan' ,
			lotno = '$lotno' ,
			waste = '$text_waste',
			waste_mdo = '$text_waste_mdo', 
			waste_tdo = '$text_waste_tdo', 
			date_modified = now()
			WHERE id_tr_jumbo_tiket = '$id_tr_jumbo_tiket'
	";
		}
//echo $sql_exe;
//die($sql_exe);
	$query = mysql_query($sql_exe) or die('ERROR ' .$pilihan .' : '.$sql_exe); 
	if ($pilihan == '1')
	{
		$sql_1 = "SELECT LAST_INSERT_ID()";
    		$result = mysql_query($sql_1);
			while ($row = mysql_fetch_array($result, MYSQL_NUM)) 
			{
    			$last_id = $row[0];
				$id_tr_jumbo_tiket = $last_id ;
     		}
	}//echo 'xxxxx';
//CONCAT(type_bahan,LPAD(lebar,4,'0'),LPAD(panjang,5,'0'))
$lebar = str_pad($width,4,'0',STR_PAD_LEFT);
$panjang = str_pad($length,5,'0',STR_PAD_LEFT);
$matcode = $type_bahan.$lebar.$panjang;
$data = $batch_no;
create_barcode($id_tr_jumbo_tiket,$data);
$sql_del = "DELETE FROM tr_winding WHERE id_tr_jumbo_tiket = '$id_tr_jumbo_tiket'";
$query = mysql_query($sql_del) or die('ERROR DELETE : '.$sql_del);

$sql_del = "DELETE FROM tr_winding_detail WHERE id_tr_jumbo_tiket = '$id_tr_jumbo_tiket'";
$query = mysql_query($sql_del) or die('ERROR DELETE : '.$sql_del);

$no = ($_POST['no']);
$jum_winding = sizeof($no);


if ($jum_winding > 0)
	{
		$text_no_panjang = $_POST['text_no_panjang'];
		$no = ($_POST['no']);
		$id_DP_L_ = ($_POST['id_DP_L_']);
		$id_DP_ML_ = ($_POST['id_DP_ML_']);
		$id_DP_M_ = ($_POST['id_DP_M_']);
		$id_DP_MR_ = ($_POST['id_DP_MR_']);
		$id_DP_R_ = ($_POST['id_DP_R_']);

		for($i=0;$i<($jum_winding);$i++) 
			{

			if ($text_no_panjang[$i] != '' )
					{
					$no_panjang[$i] = strtoupper($text_no_panjang[$i]);
					$no[$i] = strtoupper($no[$i]);
					$id_DP_L_[$i] = strtoupper($id_DP_L_[$i]);
					$id_DP_ML_[$i] = strtoupper($id_DP_ML_[$i]);
					$id_DP_M_[$i] = $id_DP_M_[$i];
					$id_DP_MR_[$i] = strtoupper($id_DP_MR_[$i]);
					$id_DP_R_[$i] = strtoupper($id_DP_R_[$i]);


		$sql_x = "INSERT INTO tr_winding 
		(id_tr_jumbo_tiket,no_panjang,no_slitting,DP_L,DP_ML,DP_M,DP_MR,DP_R) 
		VALUES ($id_tr_jumbo_tiket,'$no_panjang[$i]','$no[$i]','$id_DP_L_[$i]','$id_DP_ML_[$i]','$id_DP_M_[$i]','$id_DP_MR_[$i]','$id_DP_R_[$i]')";
							//	$a =  $a .'<br>'. $sql_x ;
						$query_data = mysql_query($sql_x) or die('ERROR insert data: '.$sql_x);



		$sql = "SELECT LAST_INSERT_ID()";
					$result = mysql_query($sql);
					while ($row = mysql_fetch_array($result, MYSQL_NUM)) 
					{
						$last_id = $row[0];
					}

				$j= $i + 1;
				$posisi = 'L';
				$jum_x = 0;
				$sql_x ='';
				$buah = $_POST["id_DP_L_".$j];
/*echo 'xxxx'.$j.'<pre>';
print_r($_POST["id_DP_L_".$j]);
echo '</pre>';
*/				$jum_x = sizeof($buah);
//die	('last_id ='.$last_id. ' '. $jum_x);			
//if ($jum_x > 0)
				{
					for($x=0;$x<count($buah);$x++)
					{ 
				//	echo "ke =". $i . " buah $x: ".$buah[$x]."<br>";
					$sql_x = "INSERT INTO tr_winding_detail (id_tr_winding,id_tr_jumbo_tiket,posisi,baris_ke,id_m_defect) VALUES ('$last_id','$id_tr_jumbo_tiket','$posisi','$j','$buah[$x]')";
					$query_data = mysql_query($sql_x) or die('ERROR insert data: '.$sql_x);
					} 
				}			
			
				$posisi = 'ML';
				$jum_x = 0;
				$sql_x ='';
				$buah = $_POST["id_DP_ML_".$j];
				$jum_x = sizeof($buah);
				if ($jum_x > 0)				{
					for($x=0;$x<count($buah);$x++)
					{ 
				//	echo "ke =". $i . " buah $x: ".$buah[$x]."<br>";
					$sql_x = "INSERT INTO tr_winding_detail (id_tr_winding,id_tr_jumbo_tiket,posisi,baris_ke,
 							id_m_defect) VALUES ('$last_id','$id_tr_jumbo_tiket','$posisi','$j','$buah[$x]')";
					$query_data = mysql_query($sql_x) or die('ERROR insert data: '.$sql_x);
					} 
				}	

				$posisi = 'M';
				$jum_x = 0;
				$sql_x ='';
				$buah = $_POST["id_DP_M_".$j];
				$jum_x = sizeof($buah);
				if ($jum_x > 0)	
				{
					for($x=0;$x<count($buah);$x++)
					{ 
				//	echo "ke =". $i . " buah $x: ".$buah[$x]."<br>";
					$sql_x = "INSERT INTO tr_winding_detail (id_tr_winding,id_tr_jumbo_tiket,posisi,baris_ke,
 							id_m_defect) VALUES ('$last_id','$id_tr_jumbo_tiket','$posisi','$j','$buah[$x]')";
					$query_data = mysql_query($sql_x) or die('ERROR insert data: '.$sql_x);
					} 
				}			

				$posisi = 'MR';
				$jum_x = 0;
				$sql_x ='';
				$buah = $_POST["id_DP_MR_".$j];
				$jum_x = sizeof($buah);
				if ($jum_x > 0)
				//if ($count($buah) > 0)
				{
					for($x=0;$x<count($buah);$x++)
					{ 
				//	echo "ke =". $i . " buah $x: ".$buah[$x]."<br>";
					$sql_x = "INSERT INTO tr_winding_detail (id_tr_winding,id_tr_jumbo_tiket,posisi,baris_ke,
 							id_m_defect) VALUES ('$last_id','$id_tr_jumbo_tiket','$posisi','$j','$buah[$x]')";
					$query_data = mysql_query($sql_x) or die('ERROR insert data: '.$sql_x);
					} 
				}			
			
				$posisi = 'R';
				$jum_x = 0;
				$sql_x ='';
				$buah = $_POST["id_DP_R_".$j];
				//if ($count($buah) > 0)
				$jum_x = sizeof($buah);
				if ($jum_x > 0)
				{
					for($x=0;$x<count($buah);$x++)
					{ 
				//	echo "ke =". $i . " buah $x: ".$buah[$x]."<br>";
					$sql_x = "INSERT INTO tr_winding_detail (id_tr_winding,id_tr_jumbo_tiket,posisi,baris_ke,
 							id_m_defect) VALUES ('$last_id','$id_tr_jumbo_tiket','$posisi','$j','$buah[$x]')";
					$query_data = mysql_query($sql_x) or die('ERROR insert data: '.$sql_x);
					} 
				}			
		

		}
			
	}
}
		echo 'sukses';

}

function form_add_received()
{
	$lemparan = $_REQUEST['lemparan'];
//	echo("lemparan =  ".$lemparan); 
	$arr_isi = explode("|", $lemparan);
	$offset = trim($arr_isi[0]);
	$id_tr_jumbo_order = trim($arr_isi[1]);
	$id_tr_jumbo_tiket =intval( trim($arr_isi[2]));
	$txt_menuid = $_REQUEST['txt_menuid'];

 $akses = get_akses($_SESSION['userid'],$txt_menuid); 
	$sql = "SELECT a.*, b.order_no_jumbo, c.nama_line_jumbo FROM tr_jumbo_order a
	LEFT OUTER JOIN tr_jumbo_order_no_order b ON a.id_tr_jumbo_order = b.id_tr_jumbo_order
	LEFT OUTER JOIN m_line_jumbo c on a.id_m_line = c.id_m_line_jumbo 
	WHERE a.id_tr_jumbo_order = '$id_tr_jumbo_order' ";
	//echo $sql;
	
	$qry = mysql_query($sql) or die('ERROR select : '.$sql_order);
       
        while($row = mysql_fetch_array($qry))
		{
			$id_tr_jumbo_tiket = $row['id_tr_jumbo_tiket'];
         //	$id_tr_jumbo_order = $row['id_tr_jumbo_order'];
			$order_no_jumbo = $row['order_no_jumbo'];
			$lotno = $row['lotno'];
			$type_bahan = $row['type_bahan'];
			$nama_line_jumbo = $row['nama_line_jumbo'];
		}
	
	?>
    <form name="form_add_received"  id="form_add_received" class="" >
            
           <table width="500" border="0" align="center">
           <tr>
              <td colspan="3" align="center"><h2>RECEIVED JUMBO ORDER</h2></td>
             </tr>
           <tr>
             <td colspan="3" align="center">&nbsp;</td>
           </tr>
            <tr>
              <td align="left">Line No </td>
              <td align="left"><strong>:</strong></td>
              <td align="left"><strong><?php echo $nama_line_jumbo ;?></strong></td>
            </tr>
            <tr>
              <td width="20%">Order No </td>
              <td width="3%"><strong>: </strong></td>
              <td width="78%"><strong><?php echo $order_no_jumbo ?></strong></td>
             </tr>
            <tr>
              <td width="20%">Lot / Type</td>
              <td><strong>:</strong></td>
              <td><strong>
                <?= tampilan_lot_no($id_tr_jumbo_order) ."/ " . $type_bahan?>
              </strong></td>
             </tr>
            <tr>
              <td width="20%">&nbsp;</td>
              <td colspan="2">&nbsp;</td>
             </tr>
            <tr>
              <td width="20%" valign="top">Note</td>
              <td valign="top"><strong>:</strong></td>
              <td><textarea name="txt_keterangan" rows="3" class="textarea_4" id="txt_keterangan"><?php echo $keterangan ?></textarea></td>
             </tr>
            <tr>
              <td valign="top">&nbsp;</td>
              <td valign="top">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3" align="center" valign="top"><input type="button" name="button_save5" id="button_save5" class="button" value="SAVE" onclick="save_received_conf(<?="'".$lemparan.'|1'."'"?>)" /></td>
             </tr>
            <tr>
              <td valign="top">&nbsp;</td>
              <td valign="top">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
           
           </table>
</form>
           
    
    <?php
	
}

function form_add_order()
{

$lemparan = $_REQUEST['lemparan'];
//echo("lemparan =  ".$lemparan);
	$arr_isi = explode("|", $lemparan);
	$offset = trim($arr_isi[0]);
	$id_tr_jumbo_order = trim($arr_isi[1]);
	$id_tr_jumbo_tiket =intval( trim($arr_isi[2]));
$txt_menuid = $_REQUEST['txt_menuid'];

 $akses = get_akses($_SESSION['userid'],$txt_menuid); 
//echo 'xx' . $akses .' '. $txt_menuid ;

/*if ($id_tr_jumbo_tiket == '')
{
$id_tr_jumbo_tiket = 0;
}*/
?>
<script type="text/javascript">
    $("#text_tanggal_awal").datepicker({dateFormat: 'yy-mm-dd'});
 	$("#text_tanggal_akhir").datepicker({dateFormat: 'yy-mm-dd'});
 show_winding(<?php echo "'".$id_tr_jumbo_tiket."'" ?>);

        </script>
<?php


?>

<?php

if ($id_tr_jumbo_order != '')
{$where = " WHERE a.id_tr_jumbo_order = '$id_tr_jumbo_order' ";
}
if ($id_tr_jumbo_tiket != '')
{
$a2 = " a2.* , ";
$where .= " AND a2.id_tr_jumbo_tiket = '$id_tr_jumbo_tiket' ";
$left_outer = " LEFT OUTER JOIN tr_jumbo_tiket a2 ON a.id_tr_jumbo_order = a2.id_tr_jumbo_order 
				LEFT JOIN m_spindle c ON c.id_m_spindle = a2.id_m_spindle ";
}

	$sql_shift = 
			  "
			  SELECT a.id_m_shift as val,a.nama_shift as display 
			  FROM m_shift a WHERE status ='t'
					  ";

$sql_line = "SELECT id_m_line_jumbo as val, nama_line_jumbo as display FROM m_line_jumbo";

$sql_m_group_shift = 
          "
          SELECT a.id_m_group_shift as val,a.nama_group_shift as display 
          FROM m_group_shift a WHERE status ='t'
                  ";

$sql_group_mesin = "SELECT a.id_m_line, a.nama_line,b.nama_group_line, 
					a.id_m_line as val,CONCAT(b.nama_group_line,' - ',a.nama_line) as display FROM m_line a 
					LEFT JOIN m_group_line b on a.id_m_group_line = b.id_m_group_line 
					WHERE a.status = 't'
					ORDER BY a.id_m_group_line,a.nama_line ,b.nama_group_line  "; 
//$qry_group_mesin = mysql_query($sql_group_mesin) or die('ERROR select : '.$sql_group_mesin);
 

$sql_order = "	SELECT a1.order_no_jumbo, a.id_m_line, b.id_m_line_jumbo,b.nama_line_jumbo, a.id_tr_jumbo_order , 
$a2 a.type_bahan,  a.lotno as lotno, a.periode, a.fg_1, a.fg_2, a.kelipatan
FROM tr_jumbo_order a 
LEFT OUTER JOIN tr_jumbo_order_no_order a1 ON a.id_tr_jumbo_order = a1.id_tr_jumbo_order
$left_outer
LEFT OUTER JOIN m_line_jumbo b on a.id_m_line = b.id_m_line_jumbo 
$where ";
//echo 'xxx  '. $sql_order;
$qry_order = mysql_query($sql_order) or die('ERROR select : '.$sql_order);
       
        while($row = mysql_fetch_array($qry_order))
		{
			$id_tr_jumbo_tiket = $row['id_tr_jumbo_tiket'];
         //	$id_tr_jumbo_order = $row['id_tr_jumbo_order'];
			$order_no_jumbo = $row['order_no_jumbo'];
			$lotno = $row['lotno'];
			$periode = $row['periode'];

			$id_m_line_jumbo = $row['id_m_line_jumbo'];
			$id_m_line = $row['id_m_line'];
			$id_m_shift = $row['id_m_shift'];
			$type_bahan = $row['type_bahan'];
			$id_m_group_shift = $row['id_m_group_shift'];
			$id_m_spindle = $row['id_m_spindle'];
			
			$nama_line_jumbo = $row['nama_line_jumbo'];
			$nama_line = $row['nama_line'];
			$batch_no = trim($row['batch_no']);
			$no_cs = $row['no_cs'];
			$no_jumbo = $row['no_jumbo'];
			$tanggal_awal  = substr($row['waktu_awal'],0,10);
			$jam_awal  = substr($row['waktu_awal'],11,2);
			$menit_awal = substr($row['waktu_awal'],14,2);
	
			$tanggal_akhir  = substr($row['waktu_akhir'],0,10);
			$jam_akhir  = substr($row['waktu_akhir'],11,2);
			$menit_akhir = substr($row['waktu_akhir'],14,2);

			$it = $row['it'];
			$taper_t = $row['taper_t'];
			$ip = $row['ip'];
			$taper_p = $row['taper_p'];
			$jumbo_density = $row['jumbo_density'];
			$lebar = $row['lebar'];
			$panjang = $row['panjang'];
			$berat_net = $row['berat_net'];
			$spindle = $row['spindle'];
			$speed = $row['speed'];
			$keterangan = $row['keterangan'];
			$waste = $row['waste'];
			$userid_created = $row['userid_created'];
			$date_created = $row['date_created'];
			$userid_modified = $row['userid_modified'];
			$userid_approved = $row['userid_approved'];
			$status = $row['status'];
			$fg_1 = intval($row['fg_1']);
			$fg_2 = intval($row['fg_2']);
			$kelipatan = $row['kelipatan'];
			$waste_mdo = $row['waste_mdo'];
			$waste_tdo = $row['waste_tdo'];
			
	
			if ($fg_1 > 0 )
			{ 
				$tampil_kelipatan = $fg_1 . ' + ' . $fg_2;
				if ($kelipatan != '')
					{
						$tampil_kelipatan = $tampil_kelipatan;  
					} 
			}
			else
			{
				$tampil_kelipatan = $kelipatan;
			}


			$nama = pilih_satu($userid_created,$userid_modified);
//$lemparan = $offset.'|'.$id_tr_jumbo_order.'|'.'|'.$id_tr_jumbo_tiket; 
			if ( $id_tr_jumbo_tiket == '')
			{ $action = 'add' ;
			//$tanggal_awal =  date("Y-m-d");
			$tanggal_akhir =  date("Y-m-d");
			$jam_akhir  = date("H");
			$menit_akhir = date("i");
			}
			else
			{ 
			$action = 'edit' ;
			//$tanggal_awal =  date("Y-m-d");
			}
			//$lemparan = $offet.'x'.$id_tr_jumbo_order;
		}
?>
<form name="form_add_order"  id="form_add_order" class="" >
            
           <table width="95%" border="0" align="center">
 
<input type="hidden" name="periode" id="periode" value="<?= $periode ?>" />
<input type="hidden" name="id_tr_jumbo_order" id="id_tr_jumbo_order" value="<?= $id_tr_jumbo_order ?>" />
<input type="hidden" name="id_m_line_jumbo" id="id_m_line_jumbo" value="<?= $id_m_line_jumbo ?>" />
<input type="hidden" name="id_tr_jumbo_tiket" id="id_tr_jumbo_tiket" value="<?= $id_tr_jumbo_tiket ?>" />
<input type="hidden" name="type_bahan" id="type_bahan" value="<?= $type_bahan ?>" />
<input type="hidden" name="lotno" id="lotno" value="<?= $lotno ?>" />
 			<tr>
              <td colspan="3" align="center"><h2>JUMBO TICKET BOPP</h2></td>
             </tr>
            <tr>
              <td colspan="3" align="center"> <strong> <?php echo 'Line : '. $nama_line_jumbo ;?> </strong></td>
            </tr>
            <tr>
              <td width="10%">Order No </td>
              <td width="56%"><strong>: <?php echo $order_no_jumbo ?></strong></td>
              <td width="34%" align="left">&nbsp;</td>
            </tr>
            <tr>
              <td>Lot / Type</td>
              <td colspan="2"><strong>:
                <?= tampilan_lot_no($id_tr_jumbo_order) ."/ " . $type_bahan?>
              </strong></td>
            </tr>
          </table></td>
        </tr><div id="div_detail">
<table width="100%" align="center" class="">
  <tr>
    <td colspan="2"><table width="100%">
      <tr>
        <td width="2%"></td>
        <td width="2%"></td>
        <td></td>
        <td width="2%"></td>
        <td colspan="3"></td>
        <td colspan="3"></td>
      </tr>
      <tr>
        <td align="right">
        <td align="right">        
        <td align="right">        
        <td align="right">        
        <td align="right">        
        <td align="right">        
        <td align="right">        
        <td align="left" bgcolor="#CCFF99"><strong>No JB Tiket </strong>
        <td colspan="2" align="center" bgcolor="#CCFF99"><strong>
        <?= tampilan_no_jumbo_tiket( $id_tr_jumbo_tiket)?>
        </strong>
        <tr>
        <td colspan="2">&nbsp;</td>
        <td width="15%"><span class="warning">Shift / Group*)</span></td>
        <td align="center">:</td>
        <td width="30%"><?php makecomboonchange($sql_shift,"cbo_shift","cbo_shift","",$id_m_shift,"- Pilih -","",""); ?>
          <span class="warning"> &nbsp;&nbsp;</span>
          <?php makecomboonchange($sql_m_group_shift,"cbo_m_group_shift","cbo_m_group_shift","",$id_m_group_shift,"- Pilih -","",""); ?></td>
        <td width="9%"><span class="warning">No Jumbo*)</span></td>
        <td width="18%">:&nbsp;&nbsp;
          <input name="text_no_jumbo" type="text" onchange="display_batch_no()"  class="textbox_batch_no" id="text_no_jumbo" maxlength="3" value = "<?php echo trim($no_jumbo)?> " onkeypress="return isNumber(event)"  /></td>
        <td width="12%">Widht actual</td>
        <td width="16%">:&nbsp;&nbsp; <input name="text_width" type="text"  class="textbox_angka" id="text_width" maxlength="40" value = "<?php echo $lebar?> " onkeypress="return isNumber(event)" /></td>
        <td width="2%">mm</td>
        </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td width="15%"><span class="warning">Start time *)</span></td>
        <td align="center">:</td>
        <td width="30%"><input name="text_tanggal_awal" onchange="display_batch_no()" onclick="display_batch_no()" onfocusout="display_batch_no()" value="<?php echo $tanggal_awal ?>" type="text" class="textbox_2" id="text_tanggal_awal" maxlength="40" />
          <select name="hour_from" class="combobox" onchange="display_batch_no()" >
            <?php for ($i = 0; $i <= 23; $i++) { ?>
            <option value="<?= $i ?>"<?php if ($i == $jam_awal) { echo(" selected=\"selected\""); } ?>>
              <?= str_pad($i, 2, "0", STR_PAD_LEFT) ?>
              </option>
            <?php } ?>
          </select>
:
<select name="minute_from" class="combobox">
  <?php for ($i = 0; $i <= 59; $i++) { ?>
  <option value="<?= $i ?>"<?php if ($i == $menit_awal) { echo(" selected=\"selected\""); } ?>>
  <?= str_pad($i, 2, "0", STR_PAD_LEFT) ?>
  </option>
  <?php } ?>
</select></td>
        <td width="9%">CS</td>
        <td width="18%">:&nbsp;&nbsp;
          <input name="text_cs" type="text"  class="textbox_batch_no" id="text_cs" maxlength="3" value = "<?php echo $no_cs?> " onkeypress="return isNumber(event)" /></td>
        <td width="12%">Length&nbsp;&nbsp;</td>
        <td width="16%">:&nbsp;&nbsp; <input name="text_length" type="text"  class="textbox_angka" id="text_length" maxlength="40" value = "<?php echo $panjang?> " onkeypress="return isNumber(event)" /></td>
        <td width="2%">mm</td>
      </tr>
      <tr>
		
        <td colspan="2">&nbsp;</td>
        <td width="15%" class="">End time</td>
        <td align="center">:</td>
        <td><input name="text_tanggal_akhir" value="<?= $tanggal_akhir ?>" type="text" class="textbox_2" id="text_tanggal_akhir" maxlength="40" />
          <select name="hour_to" class="combobox" id="hour_to">
            <?php for ($i = 0; $i <= 23; $i++) { ?>
            <option value="<?= $i ?>"<?php if ($i == $jam_akhir) { echo(" selected=\"selected\""); } ?>>
              <?= str_pad($i, 2, "0", STR_PAD_LEFT) ?>
              </option>
            <?php } ?>
          </select>
:
<select name="minute_to" class="combobox" id="minute_to">
  <?php for ($i = 0; $i <= 59; $i++) { ?>
  <option value="<?= $i ?>"<?php if ($i == $menit_akhir) { echo(" selected=\"selected\""); } ?>>
  <?= str_pad($i, 2, "0", STR_PAD_LEFT) ?>
  </option>
  <?php } ?>
</select></td>
        <td>Weight Net</td>
        <td width="18%">:&nbsp;&nbsp;
          <input name="text_berat_net" type="text"  class="textbox_angka" id="text_berat_net" maxlength="40" value = "<?php echo $berat_net ?> "  onkeyup="checkDec(this)" onkeypress="checkDec(this)" />
          Kg</td>
        <td width="12%">Spindle</td>
        <td colspan="2">: &nbsp;
          <?php $sql_spin = "SELECT id_m_spindle as val, nama_spindle as display FROM m_spindle WHERE status ='t' ORDER BY nama_spindle"; ?>    
<?php makecomboonchange($sql_spin,"cbo_spindle","cbo_spindle","",$id_m_spindle,"- Pilih -","",""); ?>
</td>
        </tr>
      <tr>
        <td colspan="2" rowspan="2"></td>
        <td width="15%" rowspan="2" align="left" class=""><span class="">Batch No</span></td>
        <td height="-2" align="center"></td>
        <td height="" rowspan="2"><div id="div_awal">
        <?php if ($action == 'edit' )
		{ ?>
        <input  disabled="disabled" name="text_batch_no_" type="text"  class="textbox_2" id="text_batch_no_" maxlength="7" value = "<?php echo $batch_no?>"/> 
        <input type="hidden" name="text_batch_no" id="text_batch_no" value="<?= $batch_no ?>" />
        </div>
        <div id="div_batch_no"></div>
        <?php } else {?>
        <input  disabled="disabled" name="text_batch_no_" type="text"  class="textbox_2" id="text_batch_no_" maxlength="7" value = "<?php echo $batch_no?>"/> </div><div id="div_batch_no"></div>
        
        <?php } ?>
        </td>
        <td height="" rowspan="2">&nbsp;</td>
        <td width="18%" height="" rowspan="2">&nbsp;</td>
        <td width="12%" height="" rowspan="2">Speed</td>
        <td width="16%" height="" rowspan="2">:&nbsp;&nbsp; <input name="text_speed" type="text"  class="textbox_angka" id="text_speed" maxlength="40" value = "<?php echo $speed?> " onkeypress="return isNumber(event)" /></td>
        <td width="2%" height="" rowspan="2">mpm
          <label for="select"></label></td>

        </tr>
      <tr>
        <td height="14" align="center">:</td>
        </tr>
      <tr>
        <td height="140" colspan="10" align="center"><table width="100%">
          <tr>
            <td colspan="5"><hr /></td>
            </tr>
          <tr>
            <td>IT :
              <input name="text_it" type="text"  class="textbox_angka" id="text_it" maxlength="40" value = "<?php echo $it?> " onkeypress="return isNumber(event)" /></td>
            <td>Taper T:
              <input name="text_taper_t" type="text"  class="textbox_angka" id="text_taper_t" maxlength="40" value = "<?php echo $taper_t?> " onkeypress="return isNumber_dan_minus(event)" /></td>
            <td>IP :
              <input name="text_ip" type="text"  class="textbox_angka" id="text_ip" maxlength="40" value = "<?php echo $ip?> " onkeypress="return isNumber(event)" /></td>
            <td>Taper P:
              <input name="text_taper_p" type="text"  class="textbox_angka" id="text_taper_p" maxlength="40" value = "<?php echo $taper_p?> " onkeypress="return isNumber_dan_minus(event)" /></td>
            <td>Jumbo Density :
              <input name="text_jumbo_density" type="text"  class="textbox_angka" id="text_jumbo_density" maxlength="40" value = "<?php echo $jumbo_density?> "  onkeyup="checkDec(this)" onkeypress="checkDec(this)" /></td>
              
          </tr>
          </table>
          <table width="100%" align="center" class="">
          <tr>
            <td colspan="2">Note :</td>
            <td colspan="3" align="left">&nbsp;</td>
            <td width="40%" colspan="2" align="right">&nbsp;</td>
            </tr>
          <tr>
            <td rowspan="3"><textarea name="txt_keterangan" rows="3" class="textarea_3" id="txt_keterangan"><?php echo $keterangan ?></textarea></td>
            <td rowspan="3" align="center"><strong>WASTE </strong></td>
            <td width="6%">DIE</td>
            <td width="2%">:</td>
            <td width="17%"><input name="text_waste" type="text"  class="textbox_angka" id="text_waste" maxlength="40" value = "<?php echo $waste ?> "  onkeyup="checkDec(this)" onkeypress="checkDec(this)" /> 
              Kg</td>
            <td colspan="2" rowspan="3" align="center"><span class="Normal"><h2>F/G KELIPATAN : <?php echo $tampil_kelipatan ?> </h2></td>
          </tr>
          <tr>
            <td>MDO</td>
            <td>:</td>
            <td><input name="text_waste2" type="text"  class="textbox_angka" id="text_waste2" maxlength="40" value = "<?php echo $waste_mdo ?> "  onkeyup="checkDec(this)" onkeypress="checkDec(this)" /> 
              Kg</td>
          </tr>
          <tr>
            <td>TDO</td>
            <td>:</td>
            <td><input name="text_waste3" type="text"  class="textbox_angka" id="text_waste3" maxlength="40" value = "<?php echo $waste_tdo ?> "  onkeyup="checkDec(this)" onkeypress="checkDec(this)" /> 
              Kg</td>
          </tr>
          </table>
<div id="div_show_winding"></div>

</td>
      </tr>
      <tr>

		<td colspan="10" align="center">
<?php $lemparan_group_mesin = $offset.'|'.$id_tr_jumbo_order; 

if ($status != 't')
{ ?>        
<?php //echo 'xx'.$lemparan; 
    if ($action == 'add' and $status_order == '' )
                    { //echo 'xx'.$lemparan;
                ?>
    <input type="button" name="button_save" id="button_save" class="button" value="SAVE" onclick="save_jumbo_conf(<?="'".$lemparan.'|1'."'"?>)" />
<input type="button" name="button_save4" id="button_save4" class="button" value="CLOSE" onclick="show_blth_log(<?="'".$lemparan_group_mesin."'"?>)" />
          
        <?php } 
                 if ($action == 'edit' and $status_order == '') 
                    {

//echo 'xxx'.$lemparan_group_mesin;                   
                    ?>
<input type="button" name="button_save2" id="button_save2" class="button" value="UPDATE" onclick="save_jumbo_conf(<?="'".$lemparan.'|2'."'"?>)" />
<input type="button" name="button_save4" id="button_save4" class="button" value="CANCEL" onclick="add_order(<?="'".$lemparan_group_mesin."'"?>)" />
        
        <?php } ?>

<?php } ?>

			
</td>
      </tr>
      <tr>
        <td colspan="10" align="left"></td>
      </tr>
      <tr>
        <td colspan="10" align="center"></td>
      </tr>
      </table>
</td>
  </tr>
  </table>
</div>

 <table width="95%" border="0" align="center">
<tr class="" >
                <td width="1%">&nbsp;</td>
                <td width="1%" align="center">&nbsp;</td>
      <td width="6%" align="center">&nbsp;</td>
      <td width="3%" align="center">&nbsp;</td>
      <td width="3%" align="center">&nbsp;</td>
      <td width="4%" align="center">&nbsp;</td>
      <td width="4%" align="center">&nbsp;</td>
              <td width="5%" align="center">&nbsp;</td>
              <td width="5%" align="center">&nbsp;</td>
              <td width="5%" align="center"><label for="copies">copies</label>
                <select name="copies" id="copies" class="combobox">
                  <option value="1">0</option>
                  <option value="2" selected="selected">1</option>
                </select>
              <a onclick="print_kecil_conf(<?=$id_tr_jumbo_tiket?>)"><img src="../images/print_merah.png" width="20" height="20" border="0" alt="besar" title="Cetak Label"/></a></td>
              <td width="1%" align="center">&nbsp;</td>
                <td width="2%" align="right"><a onclick="tidak_muncul_form_add()"><img src="../images/arrow_2.jpg" alt="Add" width="25" height="25" border="0" title="Hide" /></a><a onclick="muncul_form_add()"> <img src="../images/arrow_1.jpg" alt="Add" width="25" height="25" border="0" title="Show" /></a></td>
    </tr>
</table>
  <table width="95%" border="0" align="center">
 	
<tr class="table_header" >
      <td width="1%" rowspan="3">No</td>
      <td width="3%" rowspan="3">No JB Tiket</td>
      <td width="1%" rowspan="3" align="center">Line</td>
      <td width="5%" rowspan="3" align="center">Time</td>
      <td width="3%" rowspan="3" align="center">Shift<br />
      BatchNo</td>
      <td width="3%" rowspan="3" align="center">No JB<br />CS</td>
      <td width="3%" rowspan="3" align="center">Width<br />Length<br />Turunan</td>
      <td width="2%" rowspan="3" align="center">Spindle<br />Speed</td>
      <td width="3%" rowspan="3" align="center">IT<br />Taper T</td>
      <td width="3%" rowspan="3" align="center">IP<br />Taper P</td>
<td width="2%" rowspan="3" align="center">Weight Net<br />
                Jumbo Dens.</td>
<td width="2%" align="center">Waste DIE</td>
      <td width="3%" rowspan="3" align="center">∑SLT</td>
      <td width="2%" rowspan="3" align="center">Note</td>
      <td colspan="3" rowspan="2" align="center">QC</td>
      <td width="1%" rowspan="3" align="center">PRINT                <input type="checkbox" id="check_all" name="check_all" onclick="checklist_all(this)" />
      <input type="hidden" id="list_antrian" name="list_antrian" value ="<?php echo $list_antrian ?>" /></td>
      <td width="3%" rowspan="3" align="center">ACT</td>
<td width="3%" rowspan="3" align="center">APP <br />
                  <input type="checkbox" id="check_all_app" name="check_all_app" onclick="checklist_all_app(this)" />
                <input type="hidden" id="list_antrian_app" name="list_antrian_app" value ="<?php echo $list_antrian_app ?>" /></td>
              
    </tr>
<tr class="table_header" >
  <td align="center">MDO</td>
</tr>
<tr class="table_header" >
  <td width="2%" align="center">TDO</td>
  <td align="center">Alert</td>
  <td width="1%" align="center">Result</td>
  <td width="1%" align="center">Insp.</td>
</tr>

<?php $i= 0;
          $sql = 
          "
          SELECT a1.order_no_jumbo, b.id_m_line_jumbo, b.nama_line_jumbo, a.id_tr_jumbo_order , 
a2.*, a.type_bahan, a2.id_tr_jumbo_tiket,e.nama_spindle,a.kelipatan,
waktu_awal, waktu_akhir, batch_no, no_cs,  a.lotno as lotno, c.nama_group_shift, d.nama_shift, a2.date_approved,
(SELECT COUNT(*) FROM tr_winding WHERE id_tr_jumbo_tiket = a2.id_tr_jumbo_tiket) as jumlah_slitting,
qa.description as qa_description, qa.corrective as qa_corrective,
qa.userid_created as qa_userid_created, qa.userid_modified as qa_userid_modified,
qa.date_created as qa_date_created, qa.date_modified as qa_date_modified , qa.id_tr_quality_alert, 
qa.userid_corrective as  qa_userid_corrective, qa.date_corrective as qa_date_corrective,
px.id_tr_jumbo_tiket_qc, px.hasil_qc, px.note_qc,pi.id_tr_jumbo_inspection, a.fg_1
FROM tr_jumbo_tiket a2 
LEFT OUTER JOIN tr_jumbo_order a ON a.id_tr_jumbo_order = a2.id_tr_jumbo_order
LEFT OUTER JOIN tr_jumbo_order_no_order a1 ON a.id_tr_jumbo_order = a1.id_tr_jumbo_order
LEFT OUTER JOIN m_line_jumbo b on a2.id_m_line = b.id_m_line_jumbo 
LEFT OUTER JOIN m_group_shift c ON a2.id_m_group_shift = c.id_m_group_shift
LEFT OUTER JOIN m_shift d ON a2.id_m_shift = d.id_m_shift
LEFT OUTER JOIN tr_quality_alert as qa ON a2.id_tr_jumbo_tiket = qa.id_tr_jumbo_tiket
LEFT JOIN m_spindle e ON e.id_m_spindle = a2.id_m_spindle
LEFT JOIN
(SELECT id_tr_jumbo_tiket_qc, hasil_qc, note_qc, id_tr_jumbo_tiket FROM tr_jumbo_tiket_qc) as px ON px.id_tr_jumbo_tiket = a2.id_tr_jumbo_tiket
LEFT JOIN
(SELECT id_tr_jumbo_inspection,id_tr_jumbo_tiket FROM tr_jumbo_inspection) as pi ON pi.id_tr_jumbo_tiket = a2.id_tr_jumbo_tiket

WHERE a.id_tr_jumbo_order = '$id_tr_jumbo_order'
ORDER BY a2.id_tr_jumbo_tiket ASC
          ";
          
          $qry_show = mysql_query($sql) or die('ERROR select kegiatan: '.$sql);
        //echo $sql;
        $jumlah_data = mysql_num_rows($qry_show);
        if ($jumlah_data == 0)
        { echo " No data";}
        
        //echo $sql_show;
        while($row = mysql_fetch_array($qry_show)){
			$c++;
            $i++;
			$id_tr_jumbo_order = $row['id_tr_jumbo_order'];
            $id_tr_jumbo_tiket = $row['id_tr_jumbo_tiket'];
			$id_tr_quality_alert = $row['id_tr_quality_alert'];
			$id_tr_jumbo_inspection = $row['id_tr_jumbo_inspection'];
			
			$no_jumbo_tiket = $row['no_jumbo_tiket'];
            $waktu_awal = $row['waktu_awal'];
            $waktu_akhir = $row['waktu_akhir'];
         
			$order_no_jumbo = $row['order_no_jumbo'];
			$lotno = $row['lotno'];
			$id_m_line_jumbo = $row['id_m_line_jumbo'];
			$id_m_shift = $row['id_m_shift'];
			$type_bahan = $row['type_bahan'];
			$id_m_group_shift = $row['id_m_group_shift'];
			$nama_shift = $row['nama_shift'];
			$jumlah_slitting = $row['jumlah_slitting'];
 
			$nama_line_jumbo = $row['nama_line_jumbo'];
			$nama_group_shift = $row['nama_group_shift'];
			$batch_no = trim($row['batch_no']);
			$no_cs = $row['no_cs'];
			$no_jumbo = $row['no_jumbo'];
			$tanggal_awal  = substr($row['waktu_awal'],0,10);
			$jam_awal  = substr($row['waktu_awal'],11,2);
			$menit_awal = substr($row['waktu_awal'],14,2);
		//	$turunan = intval($panjang / $fg_1);
			$kelipatan = $row['kelipatan'];
			//$turunan = intval($kelipatan);
			if ($akses == '11' or $akses == '111')
			{
			$link_CS ='<a onclick=" ubah_CS('."'". $offset ."|".$id_tr_jumbo_tiket."|".$id_tr_jumbo_order."'". ')">'.($no_cs).'</a>';
			}
			else
			{
			$link_CS = $no_cs;
			}
			$panjang = $row['panjang'];
			$fg_1 = intval($row['fg_1']);
			$fg_2 = intval($row['fg_2']);
			$kelipatan = $row['kelipatan'];
	
			if ($fg_1 > 0 )
			{ 
				$turunan = $panjang/$fg_1;  
			}
			else
			{
				if ( intval($kelipatan) > 0)
					{
						$turunan = intval($panjang)/intval($kelipatan); 
						//$turunan = $panjang . ' / '. $kelipatan;
					} 
				
			}
			$turunan = floor($turunan);
			$total_turunan = $total_turunan + $turunan;
			
			$tanggal_akhir  = substr($row['waktu_akhir'],0,10);
			$jam_akhir  = substr($row['waktu_akhir'],11,2);
			$menit_akhir = substr($row['waktu_akhir'],14,2);

			$it = $row['it'];
			$taper_t = $row['taper_t'];
			$ip = $row['ip'];
			$taper_p = $row['taper_p'];
			$jumbo_density = $row['jumbo_density'];
			$lebar = $row['lebar'];
			
			$berat_net = $row['berat_net'];
			$spindle = $row['nama_spindle'];
			$speed = $row['speed'];
			$keterangan = $row['keterangan'];
			$userid_created = $row['userid_created'];
			$date_created = $row['date_created'];
			$userid_modified = $row['userid_modified'];
			$userid_approved = $row['userid_approved'];
			$date_approved = $row['date_approved'];

			$qa_description = $row['qa_description'];
			$qa_corrective = $row['qa_corrective'];

			$qa_userid_corrective = $row['qa_userid_corrective'];
			$qa_date_corrective = $row['qa_date_corrective'];
			$user_corrective = pilih_satu_nama($qa_userid_corrective,"");
			$tgl_corrective = pilih_satu_tgl($qa_date_corrective,"");

			$qa_userid_created = $row['qa_userid_created'];
			$qa_date_created = $row['qa_date_created'];
			$qa_userid_modified = $row['qa_userid_modified'];
			$qa_date_modified = $row['qa_date_modified'];
			$waste = $row['waste'];
			$waste_mdo = $row['waste_mdo'];
			$waste_tdo = $row['waste_tdo'];
			
			$user_qa = pilih_satu_nama($qa_userid_created,$qa_userid_modified);
			$tgl_qa = pilih_satu_tgl($qa_date_created,$qa_date_modified);

			$id_tr_jumbo_tiket_qc = $row['id_tr_jumbo_tiket_qc'];
			$hasil_qc = $row['hasil_qc'];

if ($hasil_qc == 'p'){$hasil_qc = 'P';} 
elseif ($hasil_qc == 'c'){$hasil_qc = 'PWC';}
elseif ($hasil_qc == 'r'){$hasil_qc = 'RC';}  
else {$hasil_qc = ' - ';}
			$note_qc = $row['note_qc'];

$lemparan_detil_quality_alert = intval($offset).'|'.$id_tr_jumbo_order.'|'.$id_tr_jumbo_tiket.'|'.intval($id_tr_quality_alert);

$date_approved = convDate( substr($date_approved,0,10),'-','1') . ' '. substr($date_approved,11,5) ;
$tampil_user = pilih_satu($userid_created,$userid_modified);
			$status = $row['status'];
$lemparan_detil = $offset.'|'.$id_tr_jumbo_order.'|'.$id_tr_jumbo_tiket;
            if($i%2==0){
                $cls = 'table_row_odd';
            }else{
                $cls = 'table_row_even';
            }
            
            ?>
            <tr class="<?=$cls?>">
              <td width="1%" align="center"><?=$i?></td>
              <td width="3%" align="center"><a  target="_blank" href="../template/index_form_jumbo_tiket.php?id=<?php echo $id_tr_jumbo_tiket?>">
                <?= tampilan_no_jumbo_tiket($id_tr_jumbo_tiket)?>
              </a></td>
              <td width="1%" align="center"><?=$nama_line_jumbo?></td>
              <td  width="5%" align="center"> <?=convDate( substr($waktu_awal,0,10),'-','1').' '.substr($waktu_awal,11,5) ?><br />
            <?=convDate(substr($waktu_akhir,0,10),'-','1').' '.substr($waktu_akhir,11,5)?></td>
              <td width="3%" align="center">&nbsp;<?=$nama_shift. '-'.$nama_group_shift.'<br>'. $batch_no?></td>
                <td width="3%" align="center">&nbsp;<?php echo $no_jumbo .'<br>'.$link_CS?>
<div id="div_cs_<?= $id_tr_jumbo_tiket ?>"></div>


</td>
                <td width="3%" align="right"><?= number_format($lebar) .'<br>'. number_format($panjang) .'<br>'. $turunan?></td>
              <td width="2%" align="center"><?= $spindle.'<br>'. $speed ?></td>
                <td width="3%" align="center"><?=$it.'<br>'.$taper_t ?></td>
              <td width="3%" align="center"><?=$ip.'<br>'.$taper_p ?></td>
                <td width="2%" align="right"><?=number_format($berat_net).'&nbsp;<br>'.number_format($jumbo_density,2) ?>&nbsp;</td>
                <td width="2%" align="right"><?=number_format($waste,2).'<br>'.number_format($waste_mdo,2).'<br>'.number_format($waste_tdo,2)?></td>
                <td width="3%" align="right"><?=$jumlah_slitting?>&nbsp;</td>
              <td width="2%" align="left"><?= $keterangan ?></td>
              <td width="1%" align="center"> <?php if ($id_tr_quality_alert > 0 )
			  {  $tampilan_alert = tampilan_no_quality_alert($id_tr_quality_alert);
				if ($qa_corrective != "")
				{
					
//echo  $tampilan_alert;
?>
<a title="<?php echo $tgl_qa. ', '. $user_qa . ' : '.$qa_description . '1&#13'.'&nbsp;'. $tgl_corrective.', '. $user_corrective. ' : '. $qa_corrective ?>" onClick="add_alert(<?= "'".$lemparan_detil_quality_alert."'"?>)"><?php echo $tampilan_alert ?></a>
	<?php			}
				else
				{ ?>
<a onClick="add_alert(<?= "'".$lemparan_detil_quality_alert."'"?>)"><img src="../images/icons/alert_m.png" width="18" height="18" alt="Input Alert" border="0" title="<?php echo $tgl_qa. ', '. $user_qa . ' : '.$qa_description ?>" /><?php echo $tampilan_alert ?></a>
					
				<?php }	
                ?>
                
                <?php }?> 
</td>

 <td width="1%" align="center"><strong><?php echo $hasil_qc ?> </strong> <br /> 
<a title="<?= ($note_qc)?>"  target="_blank" href="../template/index_form_jumbo_tiket.php?id=<?php echo $id_tr_jumbo_tiket?>">
                <?= potong_data($note_qc,12). ' ...'?>
        </a>
 </td>
 <td width="1%" align="center">
<a  target="_blank" href="../template/index_form_inspection.php?id=<?php echo $id_tr_jumbo_inspection?>">
                <?= tampilan_no_jumbo_inspection($id_tr_jumbo_inspection)?>
              </a></td>
              <td width="1%" align="center"><input type="checkbox" id="cek_<?=$c?>" name="cek_[]" value="<?=$id_tr_jumbo_tiket?>" onclick="choose_me(<?=$c?>,<?=$id_tr_jumbo_tiket?>);" 

<?php if (trim($row['id_tr_pk']) != '') 
		{ echo 'checked="checked"'; 

 		if (($row['jumlah_order']) > '0') 
			{ echo 'disabled="disabled"'; 
		}
			
		}
else 
{  
echo '';}

 ?> 

/></td>
              <td width="3%" align ="center" with="2%">

                <a onClick="add_order(<?= "'".$lemparan_detil."'"?>)"><img src="../images/icons/edit_data.png" border="0" /></a>
                    <?php if ( $status != 't')
                    { ?>
           <a onClick="delete_detail_conf(<?= "'".$lemparan_detil."'"?>)"><img src="../images/icons/del_data.png" border="0" /></a>
                    <?php } ?>
<?php echo $tampil_user ?>
             </td>
              <td width="3%" align ="center" with="2%">

<input type="checkbox" id="cek_app_<?=$c?>" name="cek_app_[]" value="<?=$id_tr_jumbo_tiket?>" onclick="choose_me_app(<?=$c?>,<?=$id_tr_jumbo_tiket?>);" 

<?php echo $id_tr_jumbo_tiket; 
if (trim($row['status']) == 't') 
		{ echo 'checked="checked"';
          echo 'disabled="disabled"'; 
 		
		}
else 
{  
echo '';}

 ?> 

/> <?php if ($status == 't') {echo  '<br> '.nama_user($userid_approved) .'<br> '. $date_approved;} ?></td>
        <?php    }
        ?>
  </table>
 <table width="95%" border="0" align="center" >
<tr class="" >
                <td width="4%">&nbsp;</td>
                <td width="6%" align="center">&nbsp;</td>
      <td width="4%" align="center">&nbsp;</td>
      <td width="8%" align="center">&nbsp;</td>
      <td width="17%" align="center"><h3>∑Turunan : &nbsp;&nbsp;<?php echo $total_turunan ?></h3></td>
      <td width="7%" align="left">&nbsp;</td>
      <td width="1%" align="center">&nbsp;</td>
      <td width="0%" align="center">&nbsp;</td>
      <td width="6%" align="center">&nbsp;</td>
              <td width="7%" align="center">&nbsp;</td>
              <td width="6%" align="center">&nbsp;</td>
              <td width="5%" align="center">&nbsp;</td>
              <td width="4%" align="center">&nbsp;</td>
              <td width="5%" align="center">&nbsp;</td>
      <td width="4%" align="center">&nbsp;</td>
                <td width="6%" align="right">

</td>
                <td width="10%" align="right"><?php if ($akses == '11')
{ ?>
<input type="button" name="button_save3" id="button_save3" class="button" value="APPROVE" onclick="approve_conf(<?="'".$lemparan.'|3'."'"?>)" />
<?php } ?></td>
              
    </tr>
</table>

</form>
 <?php }
function create_barcode($id_tr_jumbo_tiket,$data)
{
// die($id_tr_jumbo_tiket);
require_once('../print_barcode/phpcode128/code128.class.php');
$folder = '../temp_barcode/';
//$data = $matcode.'_'.$batch_no;
$barcode = new phpCode128($data, 200, 'c:\windows\fonts\verdana.ttf', 18);
$barcode->setBorderWidth(0);
$barcode->setPixelWidth(3);
$barcode->setBorderSpacing(0);
$barcode->setEanStyle(false);
$barcode->setShowText(true);
$barcode->saveBarcode($folder.$id_tr_jumbo_tiket.'.png');

}

function list_br($data)
	{
	if (intval($data) > 0)
		{
		$tampil = '<br>'. number_format($data);
		}
	return($tampil);	
	} 

function save_group_mesin()
	{
		
		$usernya = $_SESSION['userid'];
		$id_tr_jumbo_order = $_POST['id_tr_jumbo_order'];		
		$id_m_line = $_POST['cbo_group_mesin'];
//die('xxx'. $cbo_group_mesin);
		
 		{
		$sql_exe = "UPDATE tr_jumbo_order
					SET  id_m_line = '$id_m_line', 
						 userid_modified = '$usernya',
						 date_modified  = now()
					WHERE id_tr_jumbo_order = '$id_tr_jumbo_order' ";
		}
//echo $sql_exe;
//die();
	$query = mysql_query($sql_exe) or die('ERROR ' .$pilihan .' : '.$sql_exe); 
		echo 'sukses';

	}	

function delete_order()
{
		$id_tr_pk = $_POST['id_tr_pk'];
		$list_order = $_POST['list_order'];
		$list_order = "(". substr($list_order,0,-1) .")";
		$temp_order = 'temp_order_'.$id_tr_pk;
		
$sql_x = "DELETE FROM tr_order  WHERE id_tr_order in ( SELECT id_tr_order FROM  $temp_order WHERE id_temp_order in  $list_order AND id_tr_order is not null)";
		//	echo $sql_x;
//die($sql_x);
	$query_data = mysql_query($sql_x) or die('ERROR delete data: '.$sql_x); 
echo('sukses');
		
}
 function save_order()
    {

		$id_tr_pk = $_POST['id_tr_pk'];
		$temp_order = 'temp_order_'.$_SESSION['userid'];
$temp_order = 'temp_order_'.$id_tr_pk;

		$usernya = $_SESSION['userid'];

		$catatan_order = htmlspecialchars($_POST['txt_catatan_order']);
		$catatan_packing = htmlspecialchars($_POST['txt_catatan_packing']);
	
		$station = $_POST['station'];
		$lebar = $_POST['lebar'];
		$jumlah = $_POST['jumlah'];
		$panjang = $_POST['panjang'];
		$cbo_packing = $_POST['cbo_packing'];
		$cbo_lot = $_POST['cbo_lot'];
		$cbo_customer_1 = $_POST['cbo_customer_1'];
		$cbo_customer_2 = $_POST['cbo_customer_2'];
		$cbo_lot_detail = $_POST['cbo_lot_detail'];
$id_temp_order = $_POST['id_temp_order'];
	
	$arr_isi = explode("xxx", $cbo_lot);
	$id_tr_bahan = trim($arr_isi[0]);

$sql_trpk = "UPDATE tr_pk 
			 SET catatan_order = '$catatan_order',
				catatan_packing = '$catatan_packing',
 				userid_modified = '".$_SESSION['userid']."',
                date_modified = now()
             WHERE id_tr_pk = '$id_tr_pk' ";
   
$query_update = mysql_query($sql_trpk) or die('ERROR UPDATE tr_pk: '.$sql_trpk); 

//echo $sql_trpk;

if 	( $id_tr_bahan == 'all')
{ 
$where_ = " WHERE 1 = 1 ";
//$sql_del = " DELETE FROM tr_order WHERE  id_tr_bahan in (SELECT id_tr_bahan FROM $temp_order WHERE id_tr_bahan= '$id_tr_bahan' ";
$where_utk_order = " WHERE id_tr_bahan in (SELECT distinct id_tr_bahan FROM $temp_order  )  "; 
$where_utk_order = " WHERE id_tr_bahan in (SELECT id_tr_bahan FROM tr_bahan WHERE id_tr_pk = '$id_tr_pk'  )  "; 
}

else
{
 $where_ = " WHERE id_tr_bahan = '$id_tr_bahan' ";
 //$sql_del = " DELETE FROM tr_order WHERE  id_tr_bahan = '$id_tr_bahan' ";
$where_utk_order = $where_;
}
add_order_create_temp($id_tr_pk);

for($i = 0; $i < count($id_temp_order); $i++)
{
		if (trim($station[$i]) == ''){$station[$i] = 'null';}
		if (trim($lebar[$i]) == ''){$lebar[$i] = 'null';}
		if (trim($panjang[$i]) == ''){$panjang[$i] = 'null';}
		if (trim($jumlah[$i]) == ''){$jumlah[$i] = 'null';}
		if (trim($cbo_lot_detail[$i]) == ''){$cbo_lot_detail[$i] = 'null';}

  $sql = " UPDATE $temp_order 
		   SET 
		   id_tr_bahan =  $cbo_lot_detail[$i],		   
		   station =  $station[$i],
		   lebar =  $lebar[$i],
		   jumlah =  $jumlah[$i],
		   panjang =  $panjang[$i],
		   id_m_packing_detail = $cbo_packing[$i],
		   id_m_customer_detail = $cbo_customer_1[$i],
		   id_m_customer_detail2 = $cbo_customer_2[$i]
		   $where_  AND 
		   id_temp_order = '$id_temp_order[$i]' ";

//die();
	$query_inst_data = mysql_query($sql) or die('ERROR update : '.$sql);
 
}

/*$sql_del = " DELETE FROM $temp_order $where_utk_order AND station is null ";
$query_del = mysql_query($sql_del) or die('ERROR delete temp : '.$sql_del);
*/
$sql_del = " DELETE FROM tr_order $where_utk_order ";
$query_del = mysql_query($sql_del) or die('ERROR delete tr_order  : '.$sql_del);

$sql_insert = " 
	INSERT INTO 
   tr_order (id_tr_bahan,station,lebar,panjang,jumlah,id_m_packing_detail,id_m_customer_detail,id_m_customer_detail2, userid_modified,date_modified) 
	SELECT id_tr_bahan,station,lebar,panjang,jumlah,id_m_packing_detail,id_m_customer_detail,id_m_customer_detail2,'$usernya',now()
	FROM $temp_order
	$where_utk_order  AND station is not null ORDER BY id_temp_order
";
//echo $sql_insert;
$query_insert = mysql_query($sql_insert) or die('ERROR update : '.$sql_insert);

$sql1 = " DROP TABLE IF EXISTS $temp_order ";
$qry_1 = mysql_query($sql1) or die('ERROR DROP : '.$sql1);

echo 'sukses';
}

    function view_sub()
    {
        $id_tr_pk = $_REQUEST['id_tr_pk'];
        $action = 'add';
        $judul = "ADD";
        $id_m_sub_kegiatan = $_REQUEST['id_m_sub_kegiatan'];
        if ($id_m_sub_kegiatan !='')
        {
            $judul = "EDIT";
            $action = 'edit';
            $sql_edit = 
          "
          SELECT a.* 
          FROM m_sub_kegiatan a
          WHERE id_m_sub_kegiatan = '$id_m_sub_kegiatan'
          ";
          
        $qry_edit = mysql_query($sql_edit) or die('ERROR select kegiatan: '.$sql_edit);
        
        $jumlah_data = mysql_num_rows($qry_edit);
        if ($jumlah_data == 0)
        { echo " No data";}
        
        //echo $sql_show;
        while($row_edit = mysql_fetch_array($qry_edit))
            {
                $id_tr_pk = $row_edit['id_tr_pk'];
                $id_m_sub_kegiatan = $row_edit['id_m_sub_kegiatan'];
                $nama_sub_kegiatan = $row_edit['nama_sub_kegiatan'];
                $status = $row_edit['status'];
            }
              
          
          
        }
        
        ?>
<form name="form_view_sub" id="form_view_sub" >
        
        
        
        
       
 
</form>
<?php    }
    
    function show_table()
    {
        
        ?>
  <table width="100%" cellpadding="0" cellspacing="0" border="1" >
            
            <tr class="table_header">
                <td width="2%" rowspan="2">No</td>
              <td width="5%" rowspan="2" align="center">Date<br/></td>
              <td width="3%" rowspan="2" align="center">Line</td>
              <td width="3%" rowspan="2" align="center">Lot</td>
              <td width="5%" rowspan="2" align="center">Order No</td>
      <td width="4%" rowspan="2" align="center">Type</td>
      <td width="4%" rowspan="2" align="center">∑Roll</td>
      <td width="4%" rowspan="2" align="center">∑Weight <br /> (Kg)</td>
    <td colspan="4" align="center">BOPP RESULT</td>
    <td colspan="4" align="center">QC RESULT</td>
    <td width="6%" rowspan="2" align="center">Received</td>
              <td width="3%" rowspan="2">ACT</td>
              
            </tr>
            <tr class="table_header">
              <td width="4%" align="center">∑Ticket</td>
              <td width="4%" align="center">∑Weight<br />(Kg)</td>
              <td width="4%" align="center">∑App</td>
              <td width="8%" align="center">Start<br />
End</td>
              <td width="3%" align="center">Alert</td>
              <td width="4%" align="center">∑P</td>
              <td width="4%" align="center">∑PWC</td>
              <td width="3%" align="center">∑RC</td>
            </tr>
<?php
        
        if(isset($_REQUEST['offset']))    $offset = $_REQUEST['offset']; else $offset = 0;
        
            $txt_sembunyi = $_REQUEST['txt_sembunyi'];
            $periode = $_REQUEST['periode'];
			$id_m_line = $_REQUEST['id_m_line'];
			$txt_menuid = $_REQUEST['txt_menuid'];
			$status_app = $_REQUEST['status'];

			//echo 'ggg'.$txt_menuid;
			$usernya = $_SESSION['userid'];
		//	$sql_akses = "SELECT akses FROM usermenu1 WHERE userid = '$usernya' and menuid = '$txt_menuid'";
//echo $sql_akses;
 $akses = get_akses($_SESSION['userid'],$txt_menuid);
//echo 'akses ' .$akses;
            if ($txt_sembunyi != '')
            {
                //die($txt_sembunyi);
                $txt_sembunyi = explode("|", $txt_sembunyi);
            }
         
             
           
            $where = " WHERE periode = '$periode' ";
            
            if ($input_search != '')
            {}
            
        
        if ($id_m_line <> '' AND $id_m_line <> '0')
        {
            $where  = $where . " AND b.id_m_line_jumbo = '$id_m_line' ";
        }
 		if ($status_app =='1' )
        {
            $where  = $where . " AND a.status is not null  ";
        }      
		if ($status_app =='2' )
        {
            $where  = $where . " AND a.status is null ";
        }
        $i = 0;
        $limit =20;
          
        
$sql_show = "SELECT a.* ,jumlah , berat_net, app, b.nama_line_jumbo,waktu_awal,waktu_akhir, jml_tr_winding,
total_alert, jml_alert_blm, jml_alert_sdh, pqc.ps,pqc.pc,pqc.rc
FROM tr_jumbo_order a 
LEFT JOIN m_line_jumbo b on a.id_m_line = b.id_m_line_jumbo
LEFT JOIN 
	(SELECT id_tr_jumbo_order, COUNT(*) as jumlah, SUM(berat_net) as berat_net, COUNT(status) as app ,
	MIN(waktu_awal) as  waktu_awal, MAX(waktu_akhir) as  waktu_akhir
 	FROM tr_jumbo_tiket
 	GROUP BY id_tr_jumbo_order) as px on  px.id_tr_jumbo_order = a.id_tr_jumbo_order
LEFT JOIN 
	(SELECT b.id_tr_jumbo_order, COUNT(distinct a.id_tr_jumbo_tiket) as jml_tr_winding 
	 FROM tr_winding a
	 LEFT JOIN tr_jumbo_tiket b ON a.id_tr_jumbo_tiket = b.id_tr_jumbo_tiket
	 GROUP BY  id_tr_jumbo_order) as pz ON pz.id_tr_jumbo_order = a.id_tr_jumbo_order 
LEFT JOIN 
	(  
	 SELECT ax3.id_tr_jumbo_order, count(*) as total_alert,
			SUM(CASE WHEN userid_corrective is null THEN 1 ELSE 0 END) as jml_alert_blm,
			SUM(CASE WHEN (userid_corrective) is not null THEN 1 ELSE 0 END) as jml_alert_sdh
			FROM tr_quality_alert ax1
			INNER JOIN tr_jumbo_tiket ax2 ON ax1.id_tr_jumbo_tiket = ax2.id_tr_jumbo_tiket
			INNER JOIN tr_jumbo_order ax3 ON ax2.id_tr_jumbo_order = ax3.id_tr_jumbo_order
			GROUP BY ax3.id_tr_jumbo_order
	)	 as pax ON pax.id_tr_jumbo_order = a.id_tr_jumbo_order 
LEFT JOIN 
	(
	SELECT a.id_tr_jumbo_order,
	SUM(CASE WHEN hasil_qc = 'p'  THEN 1 ELSE 0 END) AS ps,
	SUM(CASE WHEN hasil_qc = 'c'  THEN 1 ELSE 0 END) AS pc,
	SUM(CASE WHEN hasil_qc = 'r'  THEN 1 ELSE 0 END) AS rc
	FROM tr_jumbo_tiket a 
	LEFT JOIN tr_jumbo_tiket_qc b ON a.id_tr_jumbo_tiket = b.id_tr_jumbo_tiket
	WHERE a.status = 't'
	GROUP BY a.id_tr_jumbo_order
	) as pqc ON pqc.id_tr_jumbo_order = a.id_tr_jumbo_order   	 
$where  ORDER BY a.id_tr_jumbo_order DESC";
        $sql_data = $sql_show." LIMIT $limit OFFSET $offset";
        
       // echo $sql_data;
        //echo $where;
        $qry_data = mysql_query($sql_data) or die('ERROR select : '.$sql_data);
        $qry_show = mysql_query($sql_show) or die('ERROR select : '.$sql_show);
        
        $jumlah_data = mysql_num_rows($qry_show);
        if ($jumlah_data == 0)
        { echo " No data";}
        
        //echo $sql_show;

        while($row_sel=mysql_fetch_array($qry_data)){
            $i++;

			$id_tr_jumbo_order = $row_sel['id_tr_jumbo_order'];
			$tanggal = $row_sel['tanggal'];
			$lotno = $row_sel['lotno'];
			$lotno = $row_sel['lotno'];
			$nama_line_jumbo = $row_sel['nama_line_jumbo'];
			$jumlah = $row_sel['jumlah'];
			$type_bahan = $row_sel['type_bahan'];
			$berat = number_format($row_sel['berat'],0);
			$berat_net = number_format($row_sel['berat_net'],0);
			$jml_tr_winding = $row_sel['jml_tr_winding'];
			$app = $row_sel['app'];
			$status_order = $row_sel['status'];
			$jumlah1 =  intval($row_sel['jumlah1']);
			$jumlah2 = intval($row_sel['jumlah2']);
			$jumlah3 = intval($row_sel['jumlah3']);
			$total =  $jumlah1+ $jumlah2 + $jumlah3;
			$waktu_awal = $row_sel['waktu_awal'];
			$waktu_awal = convDate( substr($waktu_awal,0,10),'-','1') . ' '.  substr($waktu_awal,11,5) ;
			$waktu_akhir = $row_sel['waktu_akhir'];
			$waktu_akhir = convDate( substr($waktu_akhir,0,10),'-','1') . ' '.  substr($waktu_akhir,11,5) ;
			$ps = $row_sel['ps'];
			$pc = $row_sel['pc'];
			$rc = $row_sel['rc'];
			
			$total_alert = intval($row_sel['total_alert']);
			$jml_alert_blm = intval($row_sel['jml_alert_blm']);
			$jml_alert_sdh = intval($row_sel['jml_alert_sdh']);
			
			$userid_created = $row_sel['userid_created'];
			$date_created = $row_sel['date_created'];
			$date_approved = $row_sel['date_approved'];
			$date_approved = convDate( substr($date_approved,0,10),'-','1') . ' '. substr($date_approved,11,5) ;
			$userid_approved = $row_sel['userid_approved'];

			$userid_modified = $row_sel['userid_modified'];
			$date_modified = $row_sel['date_modified'];

			$userid_received = $row_sel['userid_received'];
			$date_received = $row_sel['date_received'];
			$keterangan_received = trim($row_sel['keterangan_received']);
			//$keterangan_received = potong_data($keterangan_received,12);
			//if ($keterangan_received != ''){$keterangan_received = '<br>'. $keterangan_received;}
			$date_received = convDate( substr($date_received,0,10),'-','1') . ' '. substr($date_received,11,5) ;

			$status = $row_sel['status'];
			$nama_group_line = trim($row_sel['nama_group_line']);
			if ($nama_line_jumbo == '' and $id_tr_jumbo_tiket != '' )
							{$tampil_group_line = '-'; }
			elseif ($id_tr_jumbo_tiket == '')
						{$tampil_group_line = $nama_line_jumbo;}
			else{$tampil_group_line = $nama_line_jumbo;}
			
			$tampil_user = pilih_satu($userid_created,$userid_modified);
			$tampil_user_received = pilih_satu($userid_received,'');

			$lemparan_group_mesin = "'".$offset.'|'.$id_tr_jumbo_order."'";
			$date_created = convDate( substr($date_created,0,10),'-','1') . ' '. substr($date_created,11,5) ;
			if ($akses == '11' and  $status !='t' and $status_order !='' )
			{
			$link_group_mesin = '<a onclick=" add_group_mesin('.$lemparan_group_mesin.')">'.($tampil_group_line).'&nbsp</a>';
			}
			else
			{
			$link_group_mesin = $tampil_group_line;
			}

$tampil_alert = "";
			if ($total_alert > 0)
			{
				if ( $total_alert > $jml_alert_sdh)
					{
$tampil_alert = '<a onClick="add_order('.$lemparan_group_mesin.')"><img src="../images/icons/alert_m.png" border="0" width="18" height="18" /></a> <br>';
					}
				$tampil_alert .= "(".$jml_alert_sdh."/".$total_alert.")";
			}
//echo 'xzzx'. $akses;
$list_order_no="";
  		$sql_order_no = "SELECT order_no_jumbo FROM tr_jumbo_order_no_order 
					     WHERE id_tr_jumbo_order = '$id_tr_jumbo_order'   ORDER BY id_tr_jumbo_order_no_order ";
       // echo $sql_order_no;
        $qry_order_no = mysql_query($sql_order_no) or die('ERROR select : '.$sql_order_no);
  		while($row_order_no =mysql_fetch_array($qry_order_no))
		{
		  $order_no = $row_order_no['order_no_jumbo'];
		  $list_order_no = $list_order_no. $order_no  .'<br>'; 
		}
//echo 'lemparan_group_mesin = '. $list_order_no;
if ($status_order != '')
{//
$view_detail = '<a onclick=" add_order('.$lemparan_group_mesin.')">'.($list_order_no).'</a>';
$view_detail2 = '<a onclick=" add_order('.$lemparan_group_mesin.')">'.'<img src="../images/icons/edit_data.png" border="0" title="Edit" />'.'</a>';

$view_received = '<a onclick=" add_received('.$lemparan_group_mesin.')">'.'<img src="../images/icons/tick.png" border="0" title="Receive" />'.'</a>';
 }
else
{
$view_detail = $list_order_no;
}
           if($i%2==0){
                $cls = 'table_row_odd';
            }else{
                $cls = 'table_row_even';
            }
            if ($offset != 0)
            {
                $no = ($offset + $i);
            }
            else
            {
                //$no =  $i;
                $no = ($offset + $i);
            }
            ?>
            <tr class="<?=$cls?>">
                
                <td width="2%" align="center"><?=$no?> </td>
              <td width="5%" align="center"><?=convDate($tanggal,'-','1')?><br><a  target="_blank" href="../template/index_form_create_order.php?id=<?php echo $id_tr_jumbo_order?>">
                
              </a> 

<?php 
//$tampil_group_line = ;
 $link_catatan_produksi = '';
    if ($catatan_produksi != ''  )
	{
	$link_catatan_produksi ='<a title= " '.$date_produksi . ', '. $userid_produksi. ' : '.$catatan_produksi .'" >'.substr($catatan_produksi,0,10) .' ...' .'</a>';
	echo '<br>'.$link_catatan_produksi;
	} 

?>
 </td>
              <td width="3%" align="center"><?= $nama_line_jumbo ?></td>
              <td width="3%" align="center"><a  target="_blank" href="../template/index_form_create_order.php?id=<?php echo $id_tr_jumbo_order?>">
                <?= tampilan_lot_no($id_tr_jumbo_order)?>
              </a></td>
              <td width="5%" align="center"><?= $view_detail ?></td>
              <td width="4%" align="center"><?= $type_bahan ?></td>
              <td width="4%" align="right"><?= $total ?>&nbsp </td>
              <td width="4%" align="right"><?= $berat ?>&nbsp </td>
			  <td width="4%" align="right"><?= $jumlah ?>&nbsp </td>
			  <td width="4%" align="right"><?= $berat_net ?>&nbsp </td>
			  <td width="4%" align="right"><?= $app ?>&nbsp </td>

			<td width="8%" align="center"><?php echo $waktu_awal.'</br>'.$waktu_akhir ?></td>
           	<td width="3%" align="center"><?php echo $tampil_alert ?></td>
           	<td width="4%" align="center"><?= $ps ?></td>
           	<td width="4%" align="center"><?= $pc ?></td>
           	<td width="3%" align="center"><?= $rc ?></td>
 <td width="6%" align="center">
             <?php
              if ( $akses == "11"  )
				{ if ($userid_received == '' ) {echo $view_received; }
				  if ($userid_received != '' ) {}
			   } 
			echo  $tampil_user_received .'<br>'. $date_received ;
//echo $id_tr_jumbo_order; 
?>
             <a title="<?= ($keterangan_received)?>"  target="_blank" href="../template/index_form_create_order.php?id=<?php echo $id_tr_jumbo_order?>">
                <?= potong_data($keterangan_received,12)?>
              </a>
             </td>
			<td width="3%" align="center">
			<?php  
			if (($status_order != '' and $userid_received != '' ) or ($jumlah > 0 )) { echo $view_detail2; 
			if ($jumlah > 0  and $akses == "11" and $app !=  $jumlah ){ } 
			if ($status != 't' and $akses == "11" ){} ?>
                    <?php } 
					if ( $status == 't' )
					{ 
				//	echo 'APPROVED' .'<br>';
				//	echo nama_user($userid_approved) .'<br>'. $date_approved ; 
					if ($akses == '111') {?>
					<a onClick="un_approve_conf(<?="'".$id_tr_jumbo_tiket.'|'.$offset."'"?>)"><img src="../images/icons/un_lock.jpg" width="32" height="32" border="0" title="UN Approve" /></a>
					<?php }
					}
					if ( $status == 'f' )
					{ 
					echo "<img src='../images/icons/del_data.png' border='0' title=' $alasan_cancel' /></a>";
					echo 'CANCEL' .'<br>';
					echo nama_user($userid_modified) .'<br>'. $date_modified ;
					}
if ( $status == '' ){ echo $tampil_user;}
					?>
                    
              </td>
            </tr>
            <?php
        }
        
        
        ?>
         <tr>
                    <td align="center" colspan="20">
                        <?php
            
          /*  $periode = $_REQUEST['periode'];
                 
            $txt_sembunyi = $_REQUEST['txt_sembunyi'];
			$txt_menuid = $_REQUEST['txt_menuid'];
			$status_app = $_REQUEST['status'];*/

 			$txt_sembunyi = $_REQUEST['txt_sembunyi'];
            $periode = $_REQUEST['periode'];
			$id_m_line = $_REQUEST['id_m_line'];
			$txt_menuid = $_REQUEST['txt_menuid'];
			$status_app = $_REQUEST['status'];
             
            if ($txt_sembunyi != '')
            {
                //die($txt_sembunyi);
                $txt_sembunyi = explode("|", $txt_sembunyi);
                $periode = $_REQUEST['periode'];
				$txt_menuid = $_REQUEST['txt_menuid'];
              
            }
                        
                            echo '<br>';
                            
  echo paging($offset,$jumlah_data,$limit,'div_data','script_jumbo_tiket.php','act=show_table&txt_sembunyi='.$txt_sembunyi.'&periode='.$periode.'&input_search='.$input_search.'&id_m_line='.$id_m_line.'&status='.$status_app.'&txt_menuid='.$txt_menuid);                            

                        ?>
                    </td>
    </tr>
</table>
<?php
    
    }

	function cek_bisa_approve($jumlah_order,$jumlah_packing,$jumlah_customer)
	{
		$jumlah_order = intval($jumlah_order);
		$jumlah_packing = intval($jumlah_packing);
		$jumlah_customer = intval($jumlah_customer);

		if ($jumlah_order > 0 and $jumlah_packing == $jumlah_order and  $jumlah_customer == $jumlah_order )
			{
				$hasil = '1';
			} 
			else
			{ 
				$hasil = '0';
			}
		return($hasil);
	}
    function ubah_kata($data)
    {
        if ($data == '0')
        { 
        $data = 'ALL';
        }
        return $data;
    }
    
  
function add_order_create_temp($id_tr_pk)
{
$temp_order = 'temp_order_'.$_SESSION['userid'];
$temp_order = 'temp_order_'.$id_tr_pk;
$sql1 = " DROP TABLE IF EXISTS $temp_order ";
$qry_1 = mysql_query($sql1) or die('ERROR : '.$sql1);
//echo $id_tr_pk .'<br>';
$sql_create = 
	"
	 CREATE TABLE $temp_order (
	`id_temp_order` INT(2) UNSIGNED NOT NULL AUTO_INCREMENT,
	`id_tr_order` INT(2),
	`id_tr_bahan` INT(2) NULL DEFAULT NULL,
	`lebar_bahan` INT(2) NULL DEFAULT NULL,
    `lot` INT(2) NULL DEFAULT NULL,
	`order_no` INT(2) NULL DEFAULT NULL,
	`station` INT(2) NULL DEFAULT NULL,
	`lebar` INT(2) NULL DEFAULT NULL,
	`panjang` INT(2) NULL DEFAULT NULL,
	`berat` DECIMAL(10,2) NULL DEFAULT NULL,
	`jumlah` INT(2) NULL DEFAULT NULL,
	id_m_packing_detail INT(2) NULL DEFAULT NULL,
	id_m_customer_detail INT(2) NULL DEFAULT NULL,
	id_m_customer_detail2 INT(2) NULL DEFAULT NULL,
	id_temp INT(2) NULL DEFAULT NULL,
	 PRIMARY KEY (id_temp_order)
	 ) 
	";
$qry_1 = mysql_query($sql_create) or die('ERROR : '.$sql_create);


$sql_in = "INSERT INTO $temp_order 
(id_tr_order,id_tr_bahan,lebar_bahan,lot,order_no,station,lebar,panjang,berat,jumlah,id_m_packing_detail,id_m_customer_detail,id_m_customer_detail2,id_temp)
 SELECT id_tr_order,a.id_tr_bahan,d.lebar as  lebar_bahan,d.lot,order_no,station,a.lebar,a.panjang,a.berat,jumlah,id_m_packing_detail,id_m_customer_detail,id_m_customer_detail2,null
	FROM tr_order a
	LEFT JOIN tr_bahan b ON a.id_tr_bahan = b.id_tr_bahan
	INNER JOIN m_schedule_detail d on b.id_m_schedule_detail = d.id_m_schedule_detail 
	WHERE b.id_tr_pk  = '$id_tr_pk' 
	ORDER BY d.lot ,d.lebar,id_tr_order ";

//die($sql_in);
$qry_in = mysql_query($sql_in) or die('ERROR INSERT : '.$sql_in);

$jumlah =  mysql_affected_rows();
$limit = 10- $jumlah;
$sql_in_2 = "
INSERT INTO $temp_order (id_tr_order,id_tr_bahan,lebar_bahan,lot,order_no,station,lebar,panjang,berat,jumlah,id_m_packing_detail,id_m_customer_detail,id_m_customer_detail2,id_temp)	
 SELECT NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,id_m_schedule_detail 
	FROM m_schedule_detail b limit $limit ";
 		$qry_in_2 = mysql_query($sql_in_2) or die('ERROR INSERT : '.$sql_in_2);

}
 

   
    function save()
    {}
    
       function edit(){}
    
   
    function delete_data()
    {
        $id_tr_pk = $_REQUEST['id_tr_pk'];
		$arr_isi = explode("|", $id_tr_pk);
		$id_tr_pk = trim($arr_isi[0]);

		$alasan_cancel = $_REQUEST['alasan_cancel'];
		$alasan_cancel = str_replace('8764346466435364647768799667654537543756',' ',$alasan_cancel);
        $sql_cancel = 
			" UPDATE tr_pk 
			  SET status = 'f',
			  userid_modified = '".$_SESSION['userid']."',
			  alasan_cancel = '$alasan_cancel',
              date_modified = now()
			  WHERE id_tr_pk = $id_tr_pk";
 		$qry_cancel = mysql_query($sql_cancel) or die('ERROR cancel tr_pk: '.$sql_cancel);
		//die($sql_cancel);
		echo 'sukses';
    }
     

function un_approve_data()
{
  	$id_tr_pk = $_REQUEST['id_tr_pk'];
	//die($id_tr_pk);
	$usernya = $_SESSION['userid'];
	$sql_no = "
			SELECT count(*) as quota,
			SUM(CASE WHEN a.status ='t' THEN 1 ELSE 0 END) as jml_app,
			SUM(CASE WHEN a.status ='f' THEN 1 ELSE 0 END) as jml_cancel,
			SUM(CASE WHEN a.status is null THEN 1 ELSE 0 END) as jml_no_status,
			SUM(CASE WHEN e.id_tr_order is not null THEN 1 ELSE 0 END) as jml_terpakai
			FROM tr_order a LEFT JOIN tr_bahan b ON a.id_tr_bahan = b.id_tr_bahan 
			INNER JOIN m_schedule_detail d on b.id_m_schedule_detail = d.id_m_schedule_detail
			LEFT JOIN tr_produksi_detail e on a.id_tr_order = e.id_tr_order 
			WHERE b.id_tr_pk = '$id_tr_pk' 
			GROUP BY b.id_tr_pk
			ORDER BY d.lot ,d.lebar, a.id_tr_order " ;

	$qry_no = mysql_query($sql_no) or die('ERROR select : '.$sql_no);
			while ($row_no = mysql_fetch_array($qry_no)) 
			{
    			$quota = $row_no['quota'];
				$jml_app = $row_no['jml_app'];
				$jml_cancel = $row_no['jml_cancel'];
				$jml_no_status = $row_no['jml_no_status'];
				$jml_terpakai = $row_no['jml_terpakai'];
			}
		if ($jml_terpakai == '0' or ( $quota == $jml_cancel)  )
			{
		$sql_ins = "INSERT INTO m_order_no_detail 
					(order_no,keterangan,id_tr_order,userid_modified,date_modified) 
				SELECT order_no,'Un Approve',a.id_tr_order,'$usernya',now()
			  FROM tr_order a LEFT JOIN tr_bahan b ON a.id_tr_bahan = b.id_tr_bahan 
			  INNER JOIN m_schedule_detail d on b.id_m_schedule_detail = d.id_m_schedule_detail 
			  WHERE b.id_tr_pk = '$id_tr_pk' 
			  ORDER BY d.lot ,d.lebar, a.id_tr_order
";
$qry_ins = mysql_query($sql_ins) or die('ERROR INSERT INTO m_order_no_detail : '.$sql_ins);

			  $sql_upd = " UPDATE tr_order SET order_no = NULL 
			  WHERE id_tr_order in 
			  (SELECT id_tr_order
			  FROM tr_order a LEFT JOIN tr_bahan b ON a.id_tr_bahan = b.id_tr_bahan 
			  INNER JOIN m_schedule_detail d on b.id_m_schedule_detail = d.id_m_schedule_detail 
			  WHERE b.id_tr_pk = '$id_tr_pk' 
			  ORDER BY d.lot ,d.lebar, id_tr_order) ";
			//$qry_upd = mysql_query($sql_upd) or die('ERROR update tr_no : '.$sql_upd);

			  $sql_ = 
						" UPDATE tr_pk 
						  SET status = null,
						  userid_approved = '".$_SESSION['userid']."',
						  date_approved = null
						  WHERE id_tr_pk = $id_tr_pk";
					$qry_ = mysql_query($sql_) or die('ERROR cancel tr_pk: '.$sql_s);
	
					//die($sql_);

		$temp_order = 'temp_order_'.$id_tr_pk;
		$sql1 = " DROP TABLE IF EXISTS $temp_order ";
		$qry_1 = mysql_query($sql1) or die('ERROR : '.$sql1);


					echo 'sukses';
	  }
	elseif ($jml_app > 0)
		{
			echo('Ada ' .$jml_app . ' ORDER sudah di Approve Produksi !, Un-Approve GAGAL');
		}
elseif ($jml_terpakai > 0)
		{
			echo('Ada ' .$jml_terpakai . ' transaksi sudah di Pakai di Produksi, DELETE dulu data produksinya !, Un-Approve GAGAL');
		}
	else
		{
	echo('Proses masih berjalan,  Un-Approve GAGAL');
		}
} 

function approve_data($id)
{
  	$id_tr_jumbo_tiket = trim($id);
   	$usernya = $_SESSION['userid'];
	$periode = date("mY");
	
//die('xx'. $peroide);
/*$sql_inst = 
	"
	INSERT INTO m_seasoning_rack (id_tr_jumbo_tiket,periode,line,lot,matcode,type,mikron, 
	lebar, panjang, rolls,berat,berat_order, 
	tgl_awal,jb,cs,batch_no, time_,rack, userid_created,date_created)
	
	SELECT id_tr_jumbo_tiket,'$periode',id_m_line,lotno,CONCAT(type_bahan,LPAD(lebar,4,'0'),LPAD(panjang,5,'0')) as matcode,type_bahan,substring(type_bahan,5,2) as mikron, 
	 lebar, panjang, NULL as rolls, NULL as berat, berat_net as berat_order,
	waktu_awal,no_jumbo,no_cs,batch_no, substring(waktu_awal,12,5) as time_ ,NULL as rack ,'$usernya',now()
	FROM tr_jumbo_tiket 
	 WHERE id_tr_jumbo_tiket = $id_tr_jumbo_tiket
	";*/
//echo $sql_inst .'<br>';
//die();
//	$qry = mysql_query($sql_inst) or die('ERROR : '.$sql_inst);
/*if ($qry > 0)
	{*/
	
	$sql = 
		" UPDATE tr_jumbo_tiket 
		  SET status = 't',
		  userid_approved = '".$_SESSION['userid']."',
		  date_approved = now()
		  WHERE id_tr_jumbo_tiket = $id_tr_jumbo_tiket";
	$qry = mysql_query($sql) or die('ERROR : '.$sql);
echo('sukses');
	/*}*/
	
//die($sql_inst);
	/*else
		{
	echo('GAGAL');
		}*/
}    
   
        
    mysql_close();
?>
