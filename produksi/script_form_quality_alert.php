<?php require_once("../include/config.php"); ?>
<?php require_once("../include/session.php"); ?>
<?php require_once("../include/function.php"); ?>
<?php 
    $pr = trim($_GET["pr"]);
    $arr_pr = explode("|", $pr);
    $menu_id = (int)trim($arr_pr[1]);
    $id_tr_jumbo_tiket = trim($_GET["id"]);

		$lemparan = $_REQUEST['lemparan'];		
		//echo 'lemparan = ' . $lemparan;	
		$arr = explode("|", $lemparan);
		$offset = trim($arr[0]);
		$id_tr_jumbo_order = trim($arr[1]);
		$id_tr_jumbo_tiket = trim($arr[2]);
		$id_tr_quality_alert = trim($arr[3]);

$sql = "SELECT a.*, a.date_created as a_date_created, a.date_modified as a_date_modified,
a.userid_created as a_userid_created, a.userid_modified as a_userid_modified,
b.id_tr_jumbo_order, c.nama_shift, d.nama_group_shift, e.nama_line_jumbo ,
qa.userid_created as qc_userid_created, qa.userid_modified as qc_userid_modified, qa.description,
qa.date_created as qc_date_created, qa.date_modified as qc_date_modified, qa.corrective, qa.note, qa.no_qa, 
qa.remark, qa.kd_direction,qa.kd_position, qa.distance, qa.id_tr_quality_alert, qa.id_tr_quality_alert, disposition_1,disposition_2,disposition_3,
qa.userid_corrective as qc_userid_corrective,qa.date_corrective as qc_date_corrective
FROM tr_jumbo_tiket a
INNER JOIN tr_jumbo_order b ON a.id_tr_jumbo_order = b.id_tr_jumbo_order
INNER JOIN m_shift c ON a.id_m_shift = c.id_m_shift
INNER JOIN m_group_shift d ON a.id_m_group_shift = d.id_m_group_shift
INNER JOIN m_line_jumbo e ON a.id_m_line = e.id_m_line_jumbo
LEFT OUTER JOIN tr_quality_alert as qa ON a.id_tr_jumbo_tiket = qa.id_tr_jumbo_tiket
WHERE a.id_tr_jumbo_tiket  = '$id_tr_jumbo_tiket' ";

$qry_x = mysql_query($sql) or die('ERROR select : '.$sql);
//echo  $sql;
$list='';
				 
			$list_table = ' <table width="100%" border="0"> ';
			while($row =mysql_fetch_array($qry_x))
			{
			$i++;
 			$id_tr_jumbo_order = $row['id_tr_jumbo_order'];
            $id_tr_jumbo_tiket = $row['id_tr_jumbo_tiket'];

			$no_jumbo_tiket = $row['no_jumbo_tiket'];
            $waktu_awal = $row['waktu_awal'];
            $waktu_akhir = $row['waktu_akhir'];
         	$id_tr_jumbo_order = $row['id_tr_jumbo_order'];
			$order_no_jumbo = $row['order_no_jumbo'];
			$lotno = $row['lotno'];
			$id_m_line_jumbo = $row['id_m_line_jumbo'];
			$id_m_shift = $row['id_m_shift'];
			$type_bahan = $row['type_bahan'];
			$id_m_group_shift = $row['id_m_group_shift'];
			$nama_shift = $row['nama_shift'];
			$nama_line_jumbo = $row['nama_line_jumbo'];
			$nama_group_shift = $row['nama_group_shift'];

			$id_tr_quality_alert = intval(trim($row['id_tr_quality_alert']));
			$no_qa = trim($row['no_qa']);
			$description = $row['description'];
			$corrective = $row['corrective'];
			$note = trim($row['note']);
			$remark = $row['remark'];
			$kd_direction = $row['kd_direction'];
			$kd_position = $row['kd_position'];
			$distance = $row['distance'];

			if ($kd_direction == 't')
			{$pil_direct_t = 'ada';}
			if ($kd_direction == 'd')
			{$pil_direct_d = 'ada';}
			
			if ($kd_position == 'i')
			{$pil_position_i = 'ada';}
			if ($kd_direction == 'o')
			{$pil_position_o = 'ada';}

			$tanggal_awal  = substr($row['waktu_awal'],0,10);
			$jam_awal  = substr($row['waktu_awal'],11,2);
			$menit_awal = substr($row['waktu_awal'],14,2);
	
			$tanggal_akhir  = substr($row['waktu_akhir'],0,10);
			$jam_akhir  = substr($row['waktu_akhir'],11,2);
			$menit_akhir = substr($row['waktu_akhir'],14,2);

			
			$disposition_1 = $row['disposition_1'];
			$disposition_2 = $row['disposition_2'];
			$disposition_3 = $row['disposition_3'];
$checked1='';
$checked2='';
$checked3='';
if ($disposition_1 == 'on') { $checked1 = ' checked="checked" ';}
if ($disposition_2 == 'on') { $checked2 = ' checked="checked" ';}
if ($disposition_3 == 'on') { $checked3 = ' checked="checked" ';}
			/*$jumbo_density = $row['jumbo_density'];
			$lebar = $row['lebar'];
			$panjang = $row['panjang'];
			$berat_net = $row['berat_net'];
			$spindle = $row['spindle'];
			$speed = $row['speed'];
			$keterangan = $row['keterangan'];*/
			$a_userid_created = $row['a_userid_created'];
			$a_date_created = $row['a_date_created'];
			$a_date_modified = $row['a_date_modified'];
			$a_userid_modified = $row['a_userid_modified'];
			$userid_approved = $row['userid_approved'];
			$date_approved = $row['date_approved'];
			
 			$hasil_qc = trim($row['hasil_qc']);
			$note_qc = trim($row['note_qc']);
			$qc_userid_created = $row['qc_userid_created'];
			$qc_userid_modified = $row['qc_userid_modified'];
			$qc_date_created = $row['qc_date_created'];
			$qc_date_modified = $row['qc_date_modified'];

			$qc_userid_corrective = $row['qc_userid_corrective'];
			$qc_date_corrective = $row['qc_date_corrective'];
			$user_corrective = pilih_satu_nama($qc_userid_corrective,"");
			$tgl_corrective = pilih_satu_tgl($qc_date_corrective,"");

			$user_qc = pilih_satu_nama($qc_userid_created,$qc_userid_modified);
			$tgl_qc = pilih_satu_tgl($qc_date_created,$qc_date_modified);

$date_approved = convDate( substr($date_approved,0,10),'-','1') . ' '. substr($date_approved,11,5) ;
//$date_created = convDate( substr($date_created,0,10),'-','1') . ' '. substr($date_created,11,5) ;
$tampil_user = pilih_satu($userid_created,$userid_modified);
$tampil_user_prd_app = pilih_satu_nama($userid_approved,"");
$tampil_waktu_input = pilih_satu_tgl($a_date_created,$a_date_modified);
			$status = $row['status'];
$list_order_no="";
  		$sql_order_no = "SELECT order_no_jumbo FROM tr_jumbo_order_no_order 
					     WHERE id_tr_jumbo_order = '$id_tr_jumbo_order'   ORDER BY id_tr_jumbo_order_no_order ";
        
        $qry_order_no = mysql_query($sql_order_no) or die('ERROR select : '.$sql_order_no);
  		while($row_order_no =mysql_fetch_array($qry_order_no))
		{
		  $order_no = $row_order_no['order_no_jumbo'];
		  $list_order_no = $list_order_no. $order_no  .'<br>'; 
		}
					$app = 'Approved Oleh';
					if ($alasan_cancel != '')
					{ 
						$app = 'Di Cancel Oleh';
						$alasan_cancel ='Alasan Pembatalan : '. $alasan_cancel .'<br>';
					}
					

					
					}
				
echo '<br>';

?>

<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Quality alert : <?= tampilan_no_quality_alert($id_tr_quality_alert) ?> </title>
<style type='text/css'>
.Lotte {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 22px;
	font-weight: bold;
}
.normal_bold {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 16px;
	font-weight: bold;
}
.normal {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	
}
.textarea_4 {
	background-color: #CCFFCC;
	border: #666666 1px solid;
	color: #0000CC;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	height: 100px;
	width: 420px;
}
.textarea_4b {
 pointer-events: none;
	background-color: #EBEBEB;
	border: #666666 1px solid;
	color: #0000CC;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	height: 100px;
	width: 420px;
}
.textarea_2 {
	background-color: #CCFFCC;
	border: #666666 1px solid;
	color: #0000CC;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	height:45px;
	width: 320px;
}
.textarea_2b {
pointer-events: none;
	background-color: #EBEBEB;
	border: #666666 1px solid;
	color: #0000CC;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	height:45px;
	width: 320px;
}
.kecil {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	
}
.subtitle {
font-family:"Courier New", Courier, monospace;
	font-size: 15px;
	font-weight: normal;
}

.textbox_resume {
	pointer-events: none;
	background-color: #EBEBEB;
	border: #666666 1px solid;
	color: #0000CC;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	text-align:left;
	border-radius: 5px;
	width: 125px;
}
</style></head>

<body>
<form name="form_quality_alert"  id="form_quality_alert" class="" >
<table width='800' border='0' cellpadding='0' cellspacing='0' >

  <tr>
    <th width='15%' height="65" rowspan='4' style='border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; ' scope='row'><img src='../images/logo.jpg' width='' height='60' /></th>
    <td style='border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000'rowspan='4' align='center'><h1 class='Lotte'> QUALITY ALERT</h1></td>
    <td width='13%' align='left' bgcolor="#CCCCCC" class='normal_bold' style='border-top: 1px solid #000000; border-right: 1px solid #000000;  ' >&nbsp;Form No:</td>
  </tr>
  <tr>
    <td style=' border-right: 1px solid #000000;  'width='13%' align='left' class='normal' >&nbsp;F-QCD-8.7-02</td>
  </tr>
  <tr>
    <td width='13%' height='9' align='left' bgcolor="#CCCCCC" style='border-top: 1px solid #000000; border-right: 1px solid #000000; '><span class='normal_bold'>&nbsp;Rev. No:</span></td>
  </tr>
  <tr>
    <td width='13%' height='10' align='left' bgcolor="#CCCCCC" style=' border-bottom: 1px solid #000000; border-right: 1px solid #000000'><span class='normal'>&nbsp;1</span></td>
  </tr>
  <tr>
    <th valign="middle" style=' border-left: 1px solid #000000; ' scope='row'><label for='slitter'></label></th>
    <td align='center' valign="middle" class="normal"></td>
    <td colspan='2' valign="middle"  style=' border-right: 1px solid #000000; '>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='4' align='center' valign="top" style='border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;' scope='row'>
     <table width='100%' border='0' cellpadding='0' cellspacing='0' >
        <tr class="Normal">
          <td width="1%" align="left" valign="top" style="border-top: 1px solid #000000;border-left: 1px solid #000000;border-bottom: 1px solid #000000"></td>
          <td colspan="2" align="left" valign="top" style="border-top: 1px solid #000000;border-bottom: 1px solid #000000">JB Ticket</td>
          <td width="1%" align="left" valign="top" style="border-top: 1px solid #000000;border-bottom: 1px solid #000000">:</td>
          <td width="13%" align="left" valign="top" style="border-top: 1px solid #000000;border-bottom: 1px solid #000000"><span class="subtitle"><strong><?php echo tampilan_no_jumbo_tiket($id_tr_jumbo_tiket)?></strong></span></td>
          <td colspan="2" align="left" valign="top" class="normal"style="border-top: 1px solid #000000;border-bottom: 1px solid #000000">&nbsp;</td>
          <td width="1%" align="left" valign="top"  style="border-top: 1px solid #000000;border-bottom: 1px solid #000000">&nbsp;</td>
          <td width="16%" align="left" valign="top" style="border-top: 1px solid #000000;border-bottom: 1px solid #000000">&nbsp;</td>
          <td colspan="5" align="left" valign="top" class="normal" style="border-top: 1px solid #000000;border-bottom: 1px solid #000000">No Quality Alert: <span class="subtitle"><strong><?php echo tampilan_no_quality_alert($id_tr_quality_alert) ?></span></td>
        </tr>
        <tr class="normal">
          <td width="1%" height="18" align="left" valign="top" style="border-left: 1px solid #000000;"></td>
          <td colspan="2" align="left" valign="top" >To Dept</td>
          <td width="1%" align="left" valign="top">:</td>
          <td width="13%" align="left" valign="top"><?php echo "BOPP ".($nama_line_jumbo) ?></td>
          <td colspan="4" align="center" valign="top" class="normal">Received date : <?php echo $tampil_waktu_input?></td>
          <td colspan="5" align="left" valign="top" class="normal">Shift / Group : <?php echo $nama_shift . ' '. $nama_group_shift?></td>
        </tr>
        <tr>
          <td width="1%" align="left" valign="top"style="border-top: 1px solid #000000;">&nbsp;</td>
          <td colspan="4" align="left" valign="top" class="normal" style="border-top: 1px solid #000000;"><u>DESCRIPTION :</u></td>
          <td colspan="9" align="left" valign="top" class="normal" style="border-top: 1px solid #000000;"></td>
        </tr>
        <tr>
          <td width="1%" align="left" valign="top">&nbsp;</td>
          <td colspan="12" rowspan="2" align="left" valign="bottom" class="Normal"><span style="border-bottom: 1px solid #000000;">
            <textarea name="txt_alert" rows="" class="textarea_2b" id="txt_alert"><?php echo $description ?></textarea>
          </span></td>
          <td width="13%" align="left" valign="top" >&nbsp;</td>
        </tr>
        <tr>
          <td width="1%" height="44" align="left" valign="top">&nbsp;</td>
          <td width="13%" align="left" valign="top" >&nbsp;</td>
        </tr>
        <tr class="normal">
          <td width="1%" rowspan="2" align="left" valign="top"style="border-bottom: 1px solid #000000;"></td>
          <td colspan="2" align="left" valign="top" >Direction </td>
          <td width="1%" align="left" valign="top" >:</td>
          <td width="13%" align="left" valign="top" >&nbsp;</td>
          <td colspan="2" align="left" valign="top" >Position</td>
          <td width="1%" align="left" valign="top"  >:</td>
          <td width="16%" align="left" valign="top" >&nbsp;</td>
          <td colspan="2" align="left" valign="top" >Distance</td>
          <td width="1%" align="left" valign="top" >:</td>
          <td colspan="2" align="left" valign="top" >&nbsp;</td>
        </tr>
        <tr class="normal">
          <td width="2%" align="left" valign="top" style="border-bottom: 1px solid #000000">&nbsp;</td>
          <td colspan="2" align="left" valign="top" style="border-bottom: 1px solid #000000"><input type="radio" disabled="disabled" name="radio1" value="t" id="radio1"  <?php echo isset($pil_direct_t) ? 'checked="checked"' : ''; ?> />
<label for="id1">TD 
  &nbsp;&nbsp;</label></td>
          <td width="13%" align="left" valign="top" style="border-bottom: 1px solid #000000"><input type="radio" disabled="disabled"  name="radio1" value="d" id="radio2"  <?php echo isset($pil_direct_d) ? 'checked="checked"' : ''; ?> />
MD</td>
          <td width="1%" align="left" valign="top" style="border-bottom: 1px solid #000000">&nbsp;</td>
          <td colspan="3" align="left" valign="top" style="border-bottom: 1px solid #000000"><input type="radio" disabled="disabled"  name="radio2" value="i" id="radio3"  <?php echo isset($pil_position_i) ? 'checked="checked"' : ''; ?> />
            <label for="id3">Inside 
&nbsp;&nbsp;&nbsp;
<input type="radio" name="radio2" value="o" id="radio4"  <?php echo isset($pil_position_o) ? 'checked="checked"' : ''; ?> />
Outside</label></td>
          <td width="2%" align="left" valign="top" style="border-bottom: 1px solid #000000">&nbsp;</td>
          <td colspan="4" align="left" valign="top" style="border-bottom: 1px solid #000000;"  ><input name='txt_distance' type='text'  class='textbox_resume' id='txt_distance' maxlength='' value = '<?php echo $distance?> '  /></td>
        </tr>
      </table>
     <table width="100%"  cellspacing="0" cellpadding="0">
        <tr class="normal">
          <td width="2%" height="27">&nbsp;</td>
          <td width="28%">Issued by : <?php echo $user_qc?></td>
          <td width="28%">Date : <?php echo $tgl_qc ?></td>
          <td width="36%">Line Owner / Shift Spv : <?php echo $tampil_user ." / ". $tampil_user_prd_app ?></td>
          <td width="6%">&nbsp;</td>
        </tr>
      </table>
      <table width='100%' border='0' cellpadding='0' cellspacing='0'>
        <tr class ="normal">
         <td width="1%" rowspan="8" align="left" valign="top" style="border-top: 1px solid #000000;border-bottom: 1px solid #000000;"></td>
         <td colspan="2" align="left" valign="top" style="border-top: 1px solid #000000;border-right: 1px solid #000000;"><u>CORRECTIVE ACTION :</u></td>
         <td colspan="2" align="left" valign="top" style="border-top: 1px solid #000000;"></td>
         <td width="41%" colspan="2" align="left" valign="top" style="border-top: 1px solid #000000;"><u>DISPOSITION :</u></td>
        </tr>
        <tr>
          <td colspan="2" rowspan="7" align="left" valign="middle"  style="border-right: 1px solid #000000;border-bottom: 1px solid #000000;"><span style="border-bottom: 1px solid #000000;">
            <textarea name="txt_corrective" rows=""  class="textarea_4" id="txt_corrective"><?php echo $corrective ?></textarea>
          </span></td>
          <td height="4" colspan="2" align="left" valign="top"  ></td>
          <td colspan="2" align="left" valign="top"   ></td>
        </tr>
        <tr class ="normal">
          <td colspan="2" align="left" valign="top"  class="normal" >&nbsp;</td>
          <td colspan="2" align="left" valign="top" >
            <input name="id4" type="checkbox" disabled="disabled"  id="id4"  <?php echo isset($disposition_1) ? 'checked="checked"' : ''; ?> />
            <label for="id5">Trouble Shoot At Max 2 Hrs</label></td>
        </tr>
        <tr class ="normal">
          <td colspan="2" align="left" valign="top"  class="normal" >&nbsp;</td>
          <td colspan="2" align="left" valign="top"  ><input type="checkbox" disabled="disabled"  name="id5" id="id5" <?php echo $checked2?> />
          <label for="id6">Change Program</label></td>
        </tr>
        <tr class ="normal">
          <td colspan="2" align="left" valign="top"  class="normal" >&nbsp;</td>
          <td colspan="2" align="left" valign="top"  ><input type="checkbox" disabled="disabled"  name="id6" id="id6" <?php echo $checked3 ?> />
          <label for="id7">Stop he Process</label></td>
        </tr>
        <tr class ="normal">
          <td height="27" colspan="2" rowspan="3" align="left" valign="top" style="border-bottom: 1px solid #000000;" ></td>
          <td height="21" colspan="2" align="left" valign="bottom"  >REMARK</td>
        </tr>
        <tr class ="normal">
          <td height="27" align="left" valign="middle" > <textarea name="txt_remark" rows="" class="textarea_2b" id="txt_remark"><?php echo $remark ?></textarea></td>
          <td align="left" valign="middle">&nbsp;</td>
        </tr>
        <tr class ="normal">
          <td height="27" colspan="2" align="left" valign="middle" style="border-bottom: 1px solid #000000;" ></td>
        </tr>
        <tr class ="normal">
          <td height="7" align="left" valign="top"></td>
          <td width="32%" height="7" align="left" valign="top">Action by : <?php echo $user_corrective ?></td>
          <td width="24%" align="left" valign="top">Date : <?php echo $tgl_corrective ?></td>
          <td width="1%" height="7" align="left" valign="top">&nbsp;</td>
          <td width="1%" height="7" align="left" valign="top">&nbsp;</td>
          <td height="7" colspan="2" align="left" valign="top">Reviewed by : </td>
        </tr>
	</table>
  
</td>
  </tr>
</table>
  
  <table width='800' border='0'  cellpadding='0' cellspacing='0'>
  <tr>
    <th width="1%"></th>
    </tr>
  <tr>
    <th width="99%" colspan='8' align="center" style='border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000' scope='row'>


<table width="98%" border="0"  cellpadding='0' cellspacing='0'>
  <tr class="Normal">
    <td align="left" valign="top" ></td>
    <td width="1%" align="left" valign="top" ></td>
    <td colspan="4" align="left" valign="top" ></td>
    </tr>
  <tr  class="Normal">
    <td align="left" valign="top">NOTE :</td>
    <td width="1%" align="left" valign="top" ></td>
    <td colspan="4" align="left" valign="top"  ></td>
  </tr>
  <tr class="Normal" >
    <td align="left" valign="top"></td>
    <td width="1%" align="left" valign="top" ></td>
    <td colspan="4" align="center" valign="top" ></td>
  </tr>
  <tr>
    <td rowspan="4" align="left" valign="top" ><span style="border-bottom: 1px solid #000000;">
      <textarea name="txt_note" rows="" class="textarea_4b" id="txt_note"><?php echo $note ?></textarea>
    </span></td>
    <td width="1%" align="left" valign="top" >&nbsp;</td>
    <td colspan="4" rowspan="4" align="center" valign="top" ></td>
    </tr>
  <tr>
    <td width="1%" align="left" valign="top">&nbsp;</td>
    </tr>
  <tr>
    <td width="1%" align="left" valign="top">&nbsp;</td>
    </tr>
  <tr>
    <td width="1%" height="78" align="left" valign="top" >&nbsp;</td>
    </tr>
  <tr>
    <td align="center" valign="top"  class ="normal"></td>
    <td width="1%" rowspan="3" align="left" valign="top" >&nbsp;</td>
    <td colspan="4" rowspan="3" align="left" valign="top" class ="normal"  >&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="top"  class ="normal"><?php $lemparan_group_mesin = $offset.'|'.$id_tr_jumbo_order; 

//if ($status != 't')
{ ?>
      <?php //echo 'xx'.$lemparan; 
   
                 if ($hasil_qc == '') 
                    {    
//echo("lemparan =  ".$lemparan) .'<br>';    
//echo $lemparan;         
                    ?>
      <input type="button" name="button_save2" id="button_save2" class="button" value="SAVE" onclick="save_quality_alert_conf(<?="'".$lemparan."'"?>)" />
      <?php } ?>
      <input type="button" name="button_save4" id="button_save4" class="button" value="CLOSE" onclick="tutup(<?="'".$lemparan."'"?>)" />
      <?php } ?></td>
  </tr>
  <tr>
    <td align="center" valign="top"  class ="normal">&nbsp;</td>
  </tr>
</table>
</th>
    </tr>
  <tr>

    <th></th>
    </tr>
  <tr>
    
<td height="2"></th>
    </tr>
</table>
</form>

</body>
</html>
<?php 
    mysql_close();
?>