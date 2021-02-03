<?php require_once("../include/config.php"); ?>
<?php require_once("../include/session.php"); ?>
<?php require_once("../include/function.php"); ?>
<?php
ini_set('memory_limit', -1);
$act = $_REQUEST['act'];
//die('xxx_act = '. $act);
switch ($act) {
    case 'form_input_baru_per_partai':
        form_input_baru_per_partai();
        break;
    case 'show_grade':
        show_grade();
        break;
    case 'change_grade_matcode':
        change_grade_matcode();
        break;
    case 'material_bahan':
        material_bahan();
        break;
    case 'save':
        save();
        break;
    case 'view_history':
        view_history();
        break;
    case 'update_station':
        update_station();
        break;
    case 'show_lebar_order':
        show_lebar_order();
        break;
    case 'save_tambah_turunan':
        save_tambah_turunan();
        break;
    case 'show_batch_no':
        show_batch_no();
        break;
    case 'approve_cw':
        approve_cw();
        break;
    case 'save_partai_new':
        save_partai_new();
        break;
    case 'un_approve_cw':
        un_approve_cw();
        break;

}
function un_approve_cw()
{

    $list_antrian_app = $_REQUEST['list_antrian_app'];
    //$lemparan_cw = "'".$id_tr_pk."z".$id_m_group."z".$id_m_shift."z".$id_m_group_shift."z".$waktu_awal."'";
    $arr = explode("z", $list_antrian_app);

    $usernya = $_SESSION['userid'];
    $periode = date("mY");

    $id_tr_pk = $arr[0];
    $id_m_group = $arr[1];
    $id_m_shift = $arr[2];
    $id_m_group_shift = $arr[3];
    $waktu_awal = $arr[4];
    $list_id_tr_produksi_detail = trim($arr[5]);
    $id_tr_cw = trim($arr[6]);

    /*	echo 'id_tr_pk ='. $id_tr_pk .'<br>';
        echo 'id_m_group ='. $id_m_group.'<br>';
        echo 'id_m_shift ='. $id_m_shift.'<br>';
        echo 'id_m_group_shift ='. $id_m_group_shift.'<br>';
        echo 'waktu_awal ='. $waktu_awal.'<br>';
        echo 'list_id_tr_produksi_detail ='.$list_id_tr_produksi_detail.'<br>';
        echo 'id_tr_cw ='.$id_tr_cw.'<br>';
        die();*/

    $list_id_tr_produksi_detail = str_replace('<br>', ',', $list_id_tr_produksi_detail);
    $list_id_tr_produksi_detail = substr($list_id_tr_produksi_detail, 1);
    //echo 'list_id_tr_produksi_detail ='. $list_id_tr_produksi_detail.'<br>';
    //die();
//<br>148835<br>148836<br>148841<br>148838<br>148839<br>148837<br>148840<br>


    /*$sql = "
                INSERT INTO m_wip
                    (id_tr_produksi_detail,id_tr_produksi_detail_batch_no,periode,id_m_grade,
                    line,lot,matcode,type,mikron,
                    lebar, panjang, rolls,berat,berat_order,
                    tgl_awal,jb,cs,batch_no, time_,rack, userid_created,date_created)

                    SELECT a.id_tr_produksi_detail,id_tr_produksi_detail_batch_no,'$periode',b.id_m_grade,
                    b.id_m_line, b.lot,
                    substring(b.matcode_hasil,1,16) as matcode,
                    substring(b.matcode_hasil,1,7) as type_bahan,
                    substring(b.matcode_hasil,6,2) as mikron,
                    substring(b.matcode_hasil,8,4) as lebar,
                    substring(b.matcode_hasil,12,5) as panjang,
                    NULL as rolls, NULL as berat, berat as berat_order,
                    waktu_awal, null as no_jumbo, null as no_cs,batch_no, substring(waktu_awal,12,5) as time_ ,NULL as rack ,'$usernya',now()
                    FROM tr_produksi_detail_batch_no a
                    INNER JOIN tr_produksi_detail b ON a.id_tr_produksi_detail = b.id_tr_produksi_detail
                    WHERE a.id_tr_produksi_detail in ($list_id_tr_produksi_detail) AND b.id_m_grade in  ('3','4','5')
                ";*/

    $sql =
        " 
				DELETE FROM m_wip a
				INNER JOIN tr_produksi_detail b ON a.id_tr_produksi_detail = b.id_tr_produksi_detail
				WHERE a.id_tr_produksi_detail in ($list_id_tr_produksi_detail) AND b.id_m_grade in  ('3','4','5')
				";
    //die($sql);
    $query = mysql_query($sql) or die('ERROR  : ' . $sql);


    /*$sql_del_wip = "
        DELETE m_wip, tr_produksi_detail_bahan
        FROM m_wip
        INNER JOIN tr_produksi_detail_bahan ON m_wip.batch_no = tr_produksi_detail_bahan.batch_no_tambahan
        WHERE tr_produksi_detail_bahan.id_tr_produksi_detail IN
            ( $list_id_tr_produksi_detail )
";
        //echo ($sql_del_wip). '<br>';
        $query = mysql_query($sql_del_wip) or die('ERROR DEL sql_del_wip: '.$sql_del_wip);

        $sql_del_m_seasoning_rack = " DELETE FROM m_seasoning_rack WHERE batch_no IN (SELECT DISTINCT batch_no_tambahan FROM tr_produksi_detail_bahan WHERE id_tr_produksi_detail in ($list_id_tr_produksi_detail) )";

        $sql_del_wip = "
        DELETE m_seasoning_rack, tr_produksi_detail_bahan
        FROM m_seasoning_rack
        INNER JOIN tr_produksi_detail_bahan ON m_seasoning_rack.batch_no = tr_produksi_detail_bahan.batch_no_tambahan
        WHERE tr_produksi_detail_bahan.id_tr_produksi_detail IN
            ( $list_id_tr_produksi_detail )
";
        //echo $sql_del_m_seasoning_rack ;
        //die();
        $query = mysql_query($sql_del_m_seasoning_rack) or die('ERROR DEL sql_del_m_seasoning_rack: '.$sql_del_m_seasoning_rack);*/


    //echo 'sukses';

    /*$sql_ins ="INSERT INTO tr_cw (id_tr_pk,id_m_group,id_m_shift, id_m_group_shift,tanggal,status, userid_created, date_created)
    VALUES ('$id_tr_pk','$id_m_group','$id_m_shift','$id_m_group_shift','$waktu_awal','t' ,'$usernya', now()) ";*/

    //die($sql_ins);
    $sql_ins = "DELETE FROM tr_cw WHERE id_tr_cw = '$id_tr_cw' ";
    $qry_lot = mysql_query($sql_ins) or die('ERROR INSERT $sql_ins : ' . $sql_ins);
    echo 'sukses';
}

function save_partai_new()
{
    $txt_lemparan = $_REQUEST['txt_lemparan'];
    $text_counter_awal = $_REQUEST['text_counter_awal'];
    $text_counter_akhir = $_REQUEST['text_counter_akhir'];
    $text_waste_edge = $_REQUEST['text_waste_edge'];
    $text_waste_reclaime = $_REQUEST['text_waste_reclaime'];
    $jumlah_order = substr_count($txt_lemparan, "<br>");
    //echo('txt_lemparan' . $txt_lemparan).'<br>';
    $arr1 = explode('zzz', $txt_lemparan);
    //$i = $arr1[0];
    $list_id_tr_produksi_detail = str_replace("<br>", ',', $arr1[1]);
    $list_id_tr_produksi_detail = substr($list_id_tr_produksi_detail, 1);


    //$counter_awal[$i] = str_replace(",","",$text_counter_awal[$i]);
    //echo 'i = ' .$i.'<br>';
    /*	echo 'list_id_tr_produksi_detail = ' .$list_id_tr_produksi_detail.'<br>';
        echo 'text_counter_awal = ' .$text_counter_awal.'<br>';
        echo 'text_counter_akhir = ' .$text_counter_akhir.'<br>';
        echo 'text_waste_edge = ' .$text_waste_edge.'<br>';
        echo 'text_waste_reclaime = ' .$text_waste_reclaime.'<br>';
        echo 'jumlah_order = ' .$jumlah.'<br>';
                die();	*/
    $usernya = $_SESSION['userid'];
    /*$periode = date("mY");

    $id_tr_pk = $_POST['id_tr_pk'];
    $id_m_group = $_POST['id_m_group'];	*/

    $counter_awal = str_replace(",", "", $text_counter_awal);
    $counter_akhir = str_replace(",", "", $text_counter_akhir);
    $waste_edge = str_replace(",", "", $text_waste_edge);
    $waste_reclaime = str_replace(",", "", $text_waste_reclaime);

    $waste_edge_total = $waste_edge;
    $waste_reclaime_total = $waste_reclaime;
    $waste_edge = $waste_edge / $jumlah_order;
    $waste_reclaime = $waste_reclaime / $jumlah_order;
    $machine_time = abs($counter_akhir - $counter_awal) / $jumlah_order;

    $sql_update = " 
					UPDATE tr_produksi_detail
					SET  counter_awal = '$counter_awal' ,
 						 counter_akhir = '$counter_akhir', 
						 waste_edge = '$waste_edge' ,
						 waste_reclaime = '$waste_reclaime',
						 waste_edge_total = '$waste_edge_total',
						 waste_reclaime_total = '$waste_reclaime_total',
 						 machine_time = '$machine_time' ,
						 userid_cw = '$usernya',
		 				 date_cw  = now() 
					WHERE id_tr_produksi_detail in ($list_id_tr_produksi_detail) ; ";

    if (trim($counter_awal) != '' and trim($counter_akhir) != '') {
        $query = mysql_query($sql_update) or die('ERROR UPDATE data: ' . $sql_update);
    }


    /*$sql_2 = "
    SELECT id_tr_produksi_detail,a.id_tr_order,counter_akhir,counter_awal,waste_edge,waste_reclaime,
    qty, total
    FROM tr_produksi_detail a
    LEFT JOIN (
        SELECT id_tr_order, count(*), sum(qty) as total FROM tr_produksi_detail a
        WHERE a.id_tr_produksi_detail in ($list_id_tr_produksi_detail)
        GROUP BY id_tr_order,id_tr_produksi_detail
    ) px on px.id_tr_order = a.id_tr_order
    WHERE id_tr_produksi_detail in ($list_id_tr_produksi_detail) ORDER BY id_tr_produksi_detail ";

        $qry_2 = mysql_query($sql_2) or die("Invalid !" . $sql_2);
        while ($row_2 = mysql_fetch_array($qry_2))
        {
            $id_tr_produksi_detail = $row_2['id_tr_produksi_detail'];
            $counter_akhir = $row_2['counter_akhir'];
            $counter_awal = $row_2['counter_awal'];
            $qty = $row_2['qty'];
            $total = $row_2['total'];
            $pembanding = $qty / $total;
            $machine_time = abs($counter_akhir - $counter_awal) * $pembanding;

            $sql_upd2 = "
             UPDATE tr_produksi_detail
            SET machine_time = '$machine_time' ,
            waste_reclaime =  waste_reclaime * $pembanding,
            waste_edge = waste_edge * $pembanding
            WHERE id_tr_produksi_detail = '$id_tr_produksi_detail' ";
            if (trim($counter_awal) != '' and trim($counter_akhir) != '')
                {
                $query = mysql_query($sql_upd2) or die('ERROR UPDATE data: '.$sql_upd2);
                }
        }*/


    /*	if ( $value_combo == '0')
        {
        $where_combo =  "";
        }
        else
        {
        $where_combo =  " AND DATE_FORMAT((a.waktu_awal), '%Y-%m-%d') = '$tgl'
                            AND a.id_m_shift = '$id_m_shift'
                            AND a.id_m_group_shift = '$id_m_group_shift' ";
        }		$cbo_prod_detil = $_POST['cbo_prod_detil'];


            $tgl = $_POST['tgl'];
            $id_m_shift = $_POST['id_m_shift'];
            $id_m_group_shift = $_POST['id_m_group_shift'];
            $text_counter_awal = $_POST['text_counter_awal'];
            $text_counter_akhir = $_POST['text_counter_akhir'];
            $text_waste_edge = $_POST['text_waste_edge'];
            $text_waste_reclaime = $_POST['text_waste_reclaime'];
            $list_id_tr_produksi_detail = $_POST['list_id_tr_produksi_detail'];
            $jumlah_order = $_POST['jumlah_order'];

    $z= count($tgl);*/

//echo 'ddd'.($txt_id_tr_order);
//echo 'z='.$z;
//die($berat_x[1]);


//for($i=0;$i<$z;$i++) 
    {/*
  			{
			$batch_no[$i] = $batch_no_1[$i].$nilai[$i];
			$counter_awal[$i] = str_replace(",","",$text_counter_awal[$i]);
			$counter_akhir[$i] = str_replace(",","",$text_counter_akhir[$i]);
			$waste_edge[$i] = str_replace(",","",$text_waste_edge[$i]);
			$waste_reclaime[$i] = str_replace(",","",$text_waste_reclaime[$i]);
			$list_id_tr_produksi_detail[$i] = substr(str_replace("<br>",",",$list_id_tr_produksi_detail[$i]),1);
			$waste_edge_total = $waste_edge[$i]; 
			$waste_reclaime_total = $waste_reclaime[$i]; 
			$waste_edge[$i] = $waste_edge[$i] / $jumlah_order[$i];
			$waste_reclaime[$i] = $waste_reclaime[$i] / $jumlah_order[$i];
			
			$sql_update = " 
					UPDATE tr_produksi_detail
					SET  counter_awal = '$counter_awal[$i]' ,
 						 counter_akhir = '$counter_akhir[$i]', 
						 waste_edge = '$waste_edge[$i]',
						 waste_reclaime = '$waste_reclaime[$i]',
						 waste_edge_total = '$waste_edge_total',
						 waste_reclaime_total = '$waste_reclaime_total',
						 userid_cw = '$usernya',
		 				 date_cw  = now() 
					WHERE id_tr_produksi_detail in ($list_id_tr_produksi_detail[$i]) ; ";

			//$a =$a. $sql_update  .'<br>';
			if (trim($counter_awal[$i]) != '' and trim($counter_akhir[$i]) != '')
				{
				//	echo 'ff'. $counter_awal[$i];
				$query = mysql_query($sql_update) or die('ERROR UPDATE data: '.$sql_update);
				}
		
			
			$sql_2 = "
			SELECT id_tr_produksi_detail,a.id_tr_order,counter_akhir,counter_awal,waste_edge,waste_reclaime,
			qty, total 
			FROM tr_produksi_detail a
			LEFT JOIN (
				SELECT id_tr_order, count(*), sum(qty) as total FROM tr_produksi_detail a 
				WHERE a.id_tr_produksi_detail in ($list_id_tr_produksi_detail[$i])
				GROUP BY id_tr_order
			) px on px.id_tr_order = a.id_tr_order
			WHERE id_tr_produksi_detail in ($list_id_tr_produksi_detail[$i]) ORDER BY id_tr_produksi_detail ";

				$qry_2 = mysql_query($sql_2) or die("Invalid !" . $sql_2);
				while ($row_2 = mysql_fetch_array($qry_2))
				{ 
					$id_tr_produksi_detail = $row_2['id_tr_produksi_detail'];
					$counter_akhir = $row_2['counter_akhir'];
					$counter_awal = $row_2['counter_awal'];
					$qty = $row_2['qty'];
					$total = $row_2['total'];
					$pembanding = $qty / $total;
					$machine_time = abs($counter_akhir - $counter_awal) * $pembanding;
					
					$sql_upd2 = "
				 	UPDATE tr_produksi_detail 
					SET machine_time = '$machine_time' ,
					waste_reclaime =  waste_reclaime * $pembanding,
					waste_edge = waste_edge * $pembanding
					WHERE id_tr_produksi_detail = '$id_tr_produksi_detail' ";
					if (trim($counter_awal[$i]) != '' and trim($counter_akhir[$i]) != '')
						{
						$query = mysql_query($sql_upd2) or die('ERROR UPDATE data: '.$sql_upd2);
						}
				}

		  	}	
	
		*/
    }
//die($a);
    echo('sukses');

}

function approve_cw()
{
    $list_antrian_app = $_REQUEST['list_antrian_app'];
    //$lemparan_cw = "'".$id_tr_pk."z".$id_m_group."z".$id_m_shift."z".$id_m_group_shift."z".$waktu_awal."'";
    $arr = explode("z", $list_antrian_app);

    $usernya = $_SESSION['userid'];
    $periode = date("mY");

    $id_tr_pk = $arr[0];
    $id_m_group = $arr[1];
    $id_m_shift = $arr[2];
    $id_m_group_shift = $arr[3];
    $waktu_awal = $arr[4];
    $list_id_tr_produksi_detail = trim($arr[5]);

    /*echo 'id_tr_pk ='. $id_tr_pk .'<br>';
    echo 'id_m_group ='. $id_m_group.'<br>';
    echo 'id_m_shift ='. $id_m_shift.'<br>';
    echo 'id_m_group_shift ='. $id_m_group_shift.'<br>';
    echo 'waktu_awal ='. $waktu_awal.'<br>';
    echo 'list_id_tr_produksi_detail ='.$list_id_tr_produksi_detail.'<br>';
    die();*/

    $list_id_tr_produksi_detail = str_replace('<br>', ',', $list_id_tr_produksi_detail);
    $list_id_tr_produksi_detail = substr($list_id_tr_produksi_detail, 1);
    //echo 'list_id_tr_produksi_detail ='. $list_id_tr_produksi_detail.'<br>';
    //die();
//<br>148835<br>148836<br>148841<br>148838<br>148839<br>148837<br>148840<br>


    $sql = "
				INSERT INTO m_wip
					(id_tr_produksi_detail,id_tr_produksi_detail_batch_no,periode,id_m_grade,
					line,lot,matcode,type,mikron, 
					lebar, panjang, rolls,berat,berat_order, 
					tgl_awal,jb,cs,batch_no, time_,rack, userid_created,date_created)
					
					SELECT a.id_tr_produksi_detail,id_tr_produksi_detail_batch_no,'$periode',b.id_m_grade, 
					b.id_m_line, b.lot,
					substring(b.matcode_hasil,1,16) as matcode, 
					substring(b.matcode_hasil,1,7) as type_bahan,
					substring(b.matcode_hasil,6,2) as mikron, 
					substring(b.matcode_hasil,8,4) as lebar, 
					substring(b.matcode_hasil,12,5) as panjang, 
					NULL as rolls, NULL as berat, berat as berat_order,
					waktu_awal, null as no_jumbo, null as no_cs,batch_no, substring(waktu_awal,12,5) as time_ ,NULL as rack ,'$usernya',now()
					FROM tr_produksi_detail_batch_no a 
					INNER JOIN tr_produksi_detail b ON a.id_tr_produksi_detail = b.id_tr_produksi_detail
					WHERE a.id_tr_produksi_detail in ($list_id_tr_produksi_detail) AND b.id_m_grade in  ('3','4','5')
				";
    //die($sql);
    $query = mysql_query($sql) or die('ERROR  : ' . $sql);

    $sql_ins = "INSERT INTO tr_cw (id_tr_pk,id_m_group,id_m_shift, id_m_group_shift,tanggal,status, userid_created, date_created)
	VALUES ('$id_tr_pk','$id_m_group','$id_m_shift','$id_m_group_shift','$waktu_awal','t' ,'$usernya', now()) ";
    $qry_lot = mysql_query($sql_ins) or die('ERROR INSERT $sql_ins : ' . $sql_ins);

    $sql_batch_no = "SELECT DISTINCT batch_no_tambahan FROM tr_produksi_detail_bahan WHERE id_tr_produksi_detail in ($list_id_tr_produksi_detail)";

    $qry_batch_no = mysql_query($sql_batch_no) or die('ERROR select : ' . $sql_batch_no);
    $jumlah_data = mysql_num_rows($qry_batch_no);
    $list_batch_no = '';
    if ($jumlah_data > 0) {

        while ($row = mysql_fetch_array($qry_batch_no)) {
            $batch_no_tambahan = trim($row['batch_no_tambahan']);
            $list_batch_no .= ",'" . $batch_no_tambahan . "'";
        }
        $list_batch_no = substr($list_batch_no, 1);
        //	die($list_batch_no);

        $sql_del_wip = " DELETE FROM m_wip WHERE batch_no IN ($list_batch_no)";
        //echo ($sql_del_wip). '<br>';
        $query = mysql_query($sql_del_wip) or die('ERROR DEL sql_del_wip: ' . $sql_del_wip);

        $sql_del_m_seasoning_rack = " DELETE FROM m_seasoning_rack WHERE batch_no IN ($list_batch_no)";
        //echo $sql_del_m_seasoning_rack ;
        //die();
        $query = mysql_query($sql_del_m_seasoning_rack) or die('ERROR DEL sql_del_m_seasoning_rack: ' . $sql_del_m_seasoning_rack);

    }

    echo 'sukses';
}

function show_batch_no()
{
    $nilai = $_REQUEST['paramater'];
    $c = $_REQUEST['baris_ke'];
    $kolom = $_REQUEST['kolom'];
    $type = $_REQUEST['tipe'];
    $cbo_db = $_REQUEST['cbo_db'];
    $jenis = $_REQUEST['jenis'];
    $sumber_data = $_REQUEST['sumber_data'];

//echo 'xx'.$jenis;
    if ($cbo_db == 'w') {
        $db = 'm_wip';
    }
//	if ( $cbo_db == 's') {$db = 'm_seasoning_rack';}

    if ($cbo_db == 's') {
        $db = 'm_seasoning_rack';
        $field_1 = ', id_tr_jumbo_tiket';
    }
    //echo 'xxx_'.$paramater;
    if ($jenis == '1') {
        $arr = explode('|', $sumber_data);
//echo $sumber_data ;
//$data_material = $lot."|".$jb."|".$cs."|".$tipe."|".$lebar."|".$panjang."|".$matcode."|".$berat;

        $nilai_lot = trim($arr['0']);
        $nilai_jb = trim($arr['1']);
        $nilai_cs = trim($arr['2']);

        $nilai_lebar = trim($arr['4']);
        $nilai_panjang = trim($arr['5']);
        $matcode = trim($arr['6']);
        $berat_order = intval($arr['7']);
//$nilai_lot =$matcode ;

    } elseif ($jenis == '0') {
        $sql = "SELECT lot,jb,cs,lebar,panjang,matcode, berat_order $field_1 FROM $db WHERE type = '$type' AND batch_no = '$nilai' ";
        //echo $sql;
        $qry = mysql_query($sql) or die('ERROR select : ' . $sql);
        $jumlah_data = mysql_num_rows($qry);

        if ($jumlah_data > 0) {
            //	$text_disabled = 'disabled = "disabled" ';

        }
        while ($row = mysql_fetch_array($qry)) {
            $nilai_jb = trim($row['jb']);
            $nilai_cs = trim($row['cs']);
            $nilai_lot = trim($row['lot']);
            $id_tr_jumbo_tiket = intval($row['id_tr_jumbo_tiket']);
            if ($id_tr_jumbo_tiket > 0) {
                $sql_cari_lot = "SELECT id_tr_jumbo_order FROM tr_jumbo_tiket WHERE id_tr_jumbo_tiket = '$id_tr_jumbo_tiket' ";
                $qry_lot = mysql_query($sql_cari_lot) or die('ERROR select : ' . $sql_cari_lot);
                while ($row_lot = mysql_fetch_array($qry_lot)) {
                    $nilai_lot = tampilan_lot_no($row_lot ['id_tr_jumbo_order']);

                }
            }
            $nilai_lebar = trim($row['lebar']);
            $nilai_panjang = trim($row['panjang']);
            $matcode = trim($row['matcode']);
            $berat_order = intval($row['berat_order']);
        }
    }
    if ($kolom == 'type') {
        ?>
        <input style="text-transform: uppercase" type="text"
               class="textbox_batch_no_lengkap" <?php echo isset($text_disabled) ? $text_disabled : '' ?> onkeyup=""
               onblur="display('tipe<?php echo $c ?>','lebar<?php echo $c ?>','panjang<?php echo $c ?>','mat<?php echo $c ?>','berat<?php echo $c ?>')"
               id="tipe<?php echo $c ?>" name="tipe[]" maxlength="7" value="<?php echo $type ?>"/>

    <?php }

    if ($kolom == 'jb') {
        ?>
        <input type="text" class="textbox_batch_no" <?php echo isset($text_disabled) ? $text_disabled : '' ?>
               onkeyup="checkDec(this)" id="jb<?php echo $c ?>" name="jb[]" maxlength="10"
               value="<?php echo $nilai_jb ?>"/>
    <?php } else if ($kolom == 'cs') {
        ?>
        <input type="text" class="textbox_batch_no" <?php echo isset($text_disabled) ? $text_disabled : '' ?>
               onkeyup="checkDec(this)" id="cs<?php echo $c ?>" name="cs[]" maxlength="10"
               value="<?php echo $nilai_cs ?>"/>
    <?php } else if ($kolom == 'lebar') {
        ?>
        <input type="text" class="textbox_angka_kecil" <?php echo isset($text_disabled) ? $text_disabled : '' ?>
               onkeyup="checkDec(this)"
               onblur="display('tipe<?php echo $c ?>','lebar<?php echo $c ?>','panjang<?php echo $c ?>','mat<?php echo $c ?>','berat<?php echo $c ?>')"
               id="lebar<?php echo $c ?>" name="lebar[]" maxlength="4" value="<?php echo $nilai_lebar ?>"/>
    <?php } else if ($kolom == 'lot_no') { ?>
        <input style="text-transform: uppercase" type="text"
               class="textbox_batch_no_lengkap" <?php echo isset($text_disabled) ? $text_disabled : '' ?>
               onblur="display_tipe('tipe<?php echo $c ?>','<?php echo $tipe_awal ?>','mat<?php echo $c ?>', <?php echo $c ?>,this.value, <?php echo $id_tr_produksi_detail_bahan ?>)"
               id="lot_no<?php echo $c ?>" name="lot_no[]" maxlength="10" value="<?php echo $nilai_lot ?>"/>
    <?php } else if ($kolom == 'lebar') { ?>
        <input type="text" class="textbox_angka_kecil" <?php echo isset($text_disabled) ? $text_disabled : '' ?>
               onkeyup="checkDec(this)"
               onblur="display('tipe<?php echo $c ?>','lebar<?php echo $c ?>','panjang<?php echo $c ?>','mat<?php echo $c ?>','berat<?php echo $c ?>')"
               id="lebar<?php echo $c ?>" name="lebar[]" maxlength="4" value="<?php echo $nilai_lebar ?>"/>
    <?php } else if ($kolom == 'panjang') { ?>
        <input type="text" class="textbox_angka_kecil" <?php echo isset($text_disabled) ? $text_disabled : '' ?>
               onkeyup="checkDec(this)"
               onblur="display('tipe<?php echo $c ?>','lebar<?php echo $c ?>','panjang<?php echo $c ?>','mat<?php echo $c ?>','berat<?php echo $c ?>')"
               id="panjang<?php echo $c ?>" name="panjang[]" maxlength="5" value="<?php echo $nilai_panjang ?>"/>
    <?php } else if ($kolom == 'mat') {
        $id_tr_produksi_detail_bahan = '0';
        ?>
        <!--<input style="text-transform: uppercase" type="text" <?php echo isset($text_disabled) ? $text_disabled : '' ?> name="mat[]" id="mat<?php echo $c ?>" size="15px" value="<?php echo $matcode ?>"     onclick ="show_berat_matcode(this.value, <?php echo $c ?>,'batch_no<?php echo $c ?>', <?php echo $id_tr_produksi_detail_bahan ?>)" onblur  ="show_berat_matcode(this.value, <?php echo $c ?>,'batch_no<?php echo $c ?>', <?php echo $id_tr_produksi_detail_bahan ?>)" onchange="show_berat_matcode(this.value, <?php echo $c ?>,'batch_no<?php echo $c ?>', <?php echo $id_tr_produksi_detail_bahan ?>)" onfocus ="show_berat_matcode(this.value, <?php echo $c ?>,'batch_no<?php echo $c ?>', <?php echo $id_tr_produksi_detail_bahan ?>)" />-->


        <input style="text-transform: uppercase"
               type="text" <?php echo isset($text_disabled_x) ? $text_disabled_x : '' ?> name="mat[]"
               id="mat<?php echo $c ?>" size="15px" value="<?php echo $matcode ?>"
               onblur="show_berat_matcode(this.value, <?php echo $c ?>,'batch_no<?php echo $c ?>', <?php echo $id_tr_produksi_detail_bahan ?>)"/>


    <?php } else if ($kolom == 'berat') { ?>
        <input type="text" class="textbox_angka" onkeyup="checkDec(this)" id="berat<?php echo $c ?>" name="berat[]"
               maxlength="25" value="<?php echo number_format($berat_order, 2) ?>"/>
    <?php } ?>


    <script>


        /*var div_material = <?php echo "'" . $var_mat . "'" ?>;
	Loaddiv('div_datax','inputan_baru.php','act=material_bahan&offset='+offset+'&div_material='+div_material);
		
	display_tipe('tipe<?php echo $c ?>','<?php echo $type ?>','mat<?php echo $c ?>', <?php echo $c ?>,<?php echo $nilai ?>, <?php echo $id_tr_produksi_detail_bahan ?>)
	*/</script>
    <?php
}

function save_tambah_turunan()
{


    $lemparan_partai = $_REQUEST['lemparan_partai'];
    $txt_jumlah_total_baris = $_REQUEST['txt_jumlah_total_baris'];
    $txt_tambah_turunan = $_REQUEST['txt_tambah_turunan'];


    $arr_isi = explode("|", $lemparan_partai);
    $offset = trim($arr_isi[0]);
    $id_tr_pk = trim($arr_isi[1]);
    $id_m_group = trim($arr_isi[2]);


    $sql_jumlah_turunan =
        " SELECT jumlah FROM tr_jumlah_turunan 
              WHERE id_tr_pk = '$id_tr_pk' AND id_m_group = '$id_m_group' ";

    $qry = mysql_query($sql_jumlah_turunan) or die('ERROR select : ' . $sql_jumlah_turunan);
    $jumlah_data = mysql_num_rows($qry);

    if ($jumlah_data == 0) {
        $sql = " INSERT INTO tr_jumlah_turunan (id_tr_pk,id_m_group,jumlah_tambahan) VALUES ('$id_tr_pk','$id_m_group','$txt_tambah_turunan')";

    } else if ($jumlah_data > 0) {
        $sql = "UPDATE tr_jumlah_turunan SET jumlah_tambahan = '$txt_tambah_turunan'
		WHERE  id_tr_pk = '$id_tr_pk' AND id_m_group = '$id_m_group'";
    }
//die('xx'.$sql);
    $qry = mysql_query($sql) or die('ERROR select : ' . $sql);


}

function show_lebar_order()
{
    $id_tr_order = $_REQUEST['id_tr_order'];
    $kolom_ke = $_REQUEST['kolom_ke'];
//echo 'id_tr_order'.$id_tr_order; 

    $sql = "SELECT lebar as val, lebar as display
		FROM tr_order tr 
		WHERE id_tr_order = '$id_tr_order'";
//	echo $sql;
    makecomboonchange($sql, "cbo_lebar_" . $kolom_ke, "cbo_lebar_" . $kolom_ke, "", $id_m_shift, "", "", "");

}

function update_station()
{

    $par = $_REQUEST['par'];
    $par = str_replace('undefined', '', $par);

    $arr = explode("^", $par);
    $id_tr_pk = $arr[0];
    $id_m_group = $arr[1];
    $last_station = trim($arr[2]);
    $last_id_order = trim($arr[3]);
    $last_width = trim($arr[4]);

    $sql = " UPDATE tr_jumlah_turunan SET last_station = '$last_station', last_id_tr_order ='$last_id_order',last_width = '$last_width'
				 WHERE id_tr_pk = '$id_tr_pk' AND id_m_group = '$id_m_group' ";
    $qry_ = mysql_query($sql) or die('ERROR select : ' . $sql);
//echo $sql;
//die('xxxx');

}

function view_history()
{


    $lemparan_partai = $_REQUEST['lemparan_partai'];
    $txt_tambah_turunan = intval(isset($_REQUEST['txt_tambah_turunan']) ? $_REQUEST['txt_tambah_turunan'] : '');

    //echo '<br>'.$lemparan_partai;


    $arr_isi = explode("|", $lemparan_partai);
    $offset = trim($arr_isi[0]);
    $id_tr_pk = trim($arr_isi[1]);
    $id_m_group = trim($arr_isi[2]);
    $status_show = trim(isset($arr_isi[3]) ? $arr_isi[3] : '');

    $var_mat = $id_tr_pk . "_" . $id_m_group;

    $sql_turunan = "SELECT * FROM tr_jumlah_turunan a
		WHERE a.id_tr_pk = '$id_tr_pk' and a.id_m_group = '$id_m_group'";
    $qry_turunan = mysql_query($sql_turunan) or die('ERROR select 2 : ' . $sql_turunan);

    $max_turunan = 0;
    $jumlah_turunan = 0;
    while ($row = mysql_fetch_assoc($qry_turunan)) {
        $jumlah_turunan = intval($row['jumlah']);
    }
    if ($status_show == 'all') {
        $judul = ' - ALL TRANSACTION';
    } else {
        $judul = ' - LAST TRANSACTION';

    }
    ?>
    <h2>HISTORY <?php echo $judul ?></h2>
    <?php

    /*echo 'xxx'.$jumlah_turunan. '<br>';
    echo 'xxx'.$status_show. '<br>';*/

    $sql_order = "SELECT id_tr_order , order_no, status as status_order
							FROM tr_order tr 
							INNER JOIN tr_bahan bh on tr.id_tr_bahan = bh.id_tr_bahan
							WHERE bh.id_tr_pk = '$id_tr_pk' and bh.id_m_group = '$id_m_group' 
					ORDER BY order_no";
    $qry_order = mysql_query($sql_order) or die('ERROR select : ' . $sql_order);
    $list_status_order = ''; $list_order = '';
    while ($row_order = mysql_fetch_array($qry_order)) {
        $flag_status_order = '';
        $order_no = trim($row_order['order_no']);
        $status_order = trim($row_order['status_order']);
        if ($status_order == 't') {
            $flag_status_order = '- App';
        }
        $list_status_order .= $flag_status_order;
        $list_order .= $order_no . ' ' . $flag_status_order . '<br>';

        $id_tr_order_x = trim($row_order['id_tr_order']);
    }


    $sql = "

SELECT 10000 as val, 'Grade A' as display UNION
SELECT 20000 as val, 'Grade B' as display UNION
SELECT id_m_reason as val, nama_reason as display
	FROM m_reason WHERE status ='t' ";
    $result = mysql_query($sql) or die(mysql_error());


    /*$sql_turunan = "SELECT * FROM tr_jumlah_turunan a
        WHERE a.id_tr_pk = '$id_tr_pk' and a.id_m_group = '$id_m_group'";
    $qry_turunan = mysql_query($sql_turunan) or die('ERROR select 2 : '.$sql_turunan);

    $max_turunan = 0;

    while($row = mysql_fetch_assoc($qry_turunan)){
        $jumlah_turunan = intval($row['jumlah']);
    }*/
    $baris_ke = $jumlah_turunan + 1;
    if ($list_status_order != '') {
        $list_status_order = 'ada';
    }
    /*$sql_z = "
    SELECT id_m_reason as val, nama_reason as display FROM m_reason ";*/
    $sql_prod_detil = "SELECT order_no, case when station = '0' then 1 else station end as station, panjang,lebar,id_tr_order, jumlah
							FROM tr_order tr 
							INNER JOIN tr_bahan bh on tr.id_tr_bahan = bh.id_tr_bahan
WHERE bh.id_tr_pk = '$id_tr_pk' and bh.id_m_group = '$id_m_group'  ORDER BY id_tr_order";
//echo $sql_prod_detil ;
    $qry_prod_detil = mysql_query($sql_prod_detil) or die('ERROR select 3 : ' . $sql_prod_detil);
    //die();
    $max_turunan = 0;

    while ($row = mysql_fetch_assoc($qry_prod_detil)) {
        $itemID[] = htmlentities($row['order_no']);
        $id_tr_order[] = htmlentities($row['id_tr_order']);
        $station[] = htmlentities($row['station']);
        $jumlah[] = htmlentities($row['jumlah']);

        $station_x = ($row['station']);
        $jumlah_x = htmlentities($row['jumlah']);
        $bagi = $jumlah_x / $station_x;
        $panjang[] = htmlentities($row['panjang']);
        $lebar[] = htmlentities($row['lebar']);

    }

    ?>


    <?php
    $tabel_order = '';
    $tabel_atas =
        "<table  width=100% border='' cellpadding='0' cellspacing='0'>
<tr><td>
</td></tr>
</table>
<table  width=100% border='' cellpadding='0' cellspacing='0'>
<tr class='table_header'><td colspan=4 width='2%'> </td>";

    echo "<table  width=100% border='' cellpadding='0' cellspacing='0'>";
    echo "<tr><td>";
    echo "<input name='list_antrian_input' type='hidden'  class='' disabled='disabled' id='list_antrian_input' maxlength='' />";
    echo "</td></tr>";
    echo "</table>";
    echo "<table  width=100% border='1' cellpadding='3' cellspacing='0'>";
    echo "<tr class='table_header'><td colspan=3 width='2%'>Order No</td>";
    $h = 0;
    for ($i = 0; $i < count($itemID); $i++) {
        for ($j = 0; $j < ($station[$i]); $j++) {
            $h++;
            if ($j == 0) {
//                echo "<td align='center' colspan=$station[$i]>&nbsp;" . $itemID___[$i] . "</td>";
                echo "<td align='center' colspan=$station[$i]>&nbsp;" . $itemID[$i] . "</td>";
            }

        }

    }
    echo "<td rowspan=3 width='6%'>Print<br>
	<select name='copies_inputan_baru' id='copies_inputan_baru' class='combobox'>
  <option value='1'>1</option>
  <option value='2'>2</option>
  <option value='3' selected='selected'>3</option>
</select>
	</td>";

    echo "</tr><tr><td colspan=3>Width</td>";

    for ($i = 0; $i < count($lebar); $i++) {

        for ($j = 0; $j < ($station[$i]); $j++) {
//            echo "<td width='' align='center'>&nbsp;" . $lebar___[$i] . "&nbsp;</td>";
            echo "<td width='' align='center'>&nbsp;" . $lebar[$i] . "&nbsp;</td>";

        }
    }
    echo "</tr><tr><td colspan=3>Station</td>";

    for ($j = 0; $j < ($h); $j++) {
        $vj = $j + 1;
        echo "<td align='center'> " . ($j + 1) . "</td>";
    }

    //echo "";
    echo "
		</tr><tr class ='table_header'><td align='center' width='2%'>
		<div id='div_klik_'>

</div>
<input type='checkbox' id='check_all_inp' name='check_all_inp' onclick='checklist_all_inp(this)' />No
<input name='text_jumlah_stasion' type='hidden'  class='' id='text_jumlah_stasion' maxlength='' value= '$h' />
</td><td align='center'>Turunan</td>
<td align='center' width ='5%'>List Material</td></tr>";

    $yy = count($station);
    $zz = $max_turunan;
    $zz = $baris_ke;
//$zz = 10;
    $sql = "SELECT jumlah,jumlah_tambahan FROM tr_jumlah_turunan WHERE id_tr_pk = '$id_tr_pk' and id_m_group = '$id_m_group'";
    $qry = mysql_query($sql) or die("Invalid !" . $sql);
    $jumlah_tambahan = 0;
    while ($row = mysql_fetch_array($qry)) {
        $jumlah_turunan = $row['jumlah'];
        $zz = $jumlah_turunan;
        $jumlah_tambahan = intval($row['jumlah_tambahan']);
    }

    $sql_bahan = "
  SELECT DISTINCT d.bahan_tambahan,d.bahan_tambahan, d.lot, d.batch_no_tambahan,d.cs, d.jb
  FROM tr_produksi_detail a1
  INNER JOIN tr_order b1 on a1.id_tr_order= b1.id_tr_order
  INNER JOIN tr_bahan c1 on b1.id_tr_bahan = c1.id_tr_bahan
  INNER JOIN tr_produksi_detail_bahan d on a1.id_tr_produksi_detail = d.id_tr_produksi_detail
  WHERE c1.id_tr_pk =  '$id_tr_pk' and c1.id_m_group = '$id_m_group'
";

    $sql_isi_data = " SELECT c1.id_tr_pk,c1.id_m_group, a1.id_tr_produksi_detail,a1.matcode_hasil,baris_ke, a1.id_m_grade ,a1.id_m_reason ,
  a1.waktu_awal, a1.waktu_akhir,a1.userid_created, a1.date_created, a1.keterangan_reject, b1.order_no
  , d1.batch_no, d1.berat ,d1.id_tr_produksi_detail_batch_no,
  e1.nama_grade, f1.nama_reason,
  g1.nama_shift, h1.nama_group_shift,a1.break_time, a1.keterangan
  FROM tr_produksi_detail a1
  INNER JOIN tr_produksi_detail_batch_no d1 on d1.id_tr_produksi_detail = a1.id_tr_produksi_detail
  INNER JOIN tr_order b1 on a1.id_tr_order= b1.id_tr_order
  INNER JOIN tr_bahan c1 on b1.id_tr_bahan = c1.id_tr_bahan
  LEFT  JOIN m_grade e1 on a1.id_m_grade = e1.id_m_grade
  LEFT  JOIN m_reason f1 on a1.id_m_reason = f1.id_m_reason
  LEFT JOIN m_shift g1 ON a1.id_m_shift = g1.id_m_shift
  LEFT JOIN m_group_shift h1 ON a1.id_m_group_shift = h1.id_m_group_shift
  WHERE c1.id_tr_pk =  '$id_tr_pk' and c1.id_m_group = '$id_m_group'  ";

    $batas_akhir = $baris_ke - 1 - $jumlah_tambahan - 1;
    if ($status_show == 'all') {
        $batas_akhir = 0;
    }
    /*echo 'zz = ' .$zz .'<br>';
    echo 'k = ' .$k.'<br>';
    echo 'baris_ke = ' .$baris_ke.'<br>';
    echo 'jumlah_tambahan = ' .$jumlah_tambahan.'<br>';
    echo 'batas_akhir = ' .$batas_akhir.'<br>';*/


    /*for ($k=$baris_ke-1; $k>$batas_akhir;$k--)
    {
    echo 'bbbbbak '. $k.'<br>';
    }*/

    for ($k = $baris_ke - 1; $k > $batas_akhir; $k--)
//for ($k=0; $k<$zz;$k++)
// for ($k=$zz; $k=0;$k--) 
//for ($k=$zz-1; $k<$zz;$k++) 
    {
        //$var_k = $k + 1;
        $var_k = $k;

        if ($k % 2 == 0) {
            $cls = 'table_row_odd';
        } else {
            $cls = 'table_row_even';
        }

        $par_cek_hide = "'" . $h . "_" . ($var_k) . "'";
        echo "<tr class='$cls'>";
        ?>
        <td width="2%" align="center">
            <div id="div_cek_inp_<?php echo $var_k ?>">
                <!--<input type="checkbox" id="cek_inp_<?= $var_k ?>" name="cek_inp_[]" value="<?= $var_k ?>" onclick="choose_me_inp(<?= $var_k ?>,<?= $var_k ?>);"/>--></div><?php echo $var_k; ?>
        </td>
        <?php
        //$kkk = $k -1;
        //$sql___ = $sql_isi_data . " AND a1.baris_ke = '$kkk' ";
        //echo $sql;
        //echo "<td>";
        /*$qry = mysql_query($sql) or die("Invalid !" . $sql___);
            while ($row = mysql_fetch_array($qry))
            {

            $batch_no = $row['batch_no'];
            $tur = substr($batch_no,5,2);

            }*/
        ?>

        <?php //echo"<td align='center'><div id='div_no_urut_".$var_k."'>".$tur.' - '. $var_k."</div></td>";

        echo "<td align='center' width='10%'><div id='div_no_urut_" . $var_k . "'>";
//echo $var_k;
        $tur = '';
        $sql___ = $sql_isi_data . " AND a1.baris_ke = '$var_k' LIMIT 1 ";
        $qry___ = mysql_query($sql___) or die("Invalid !" . $sql___);
        while ($row___ = mysql_fetch_array($qry___)) {
            $batch_no = $row___['batch_no'];
            $tur = substr($batch_no, 5, 2);
            echo $tur;
        }

        echo "</div></td>";

        $sql = $sql_bahan . " AND a1.baris_ke = '$var_k' ";
        //echo $sql;
        echo "<td>";
        $qry = mysql_query($sql) or die("Invalid !" . $sql);
        while ($row = mysql_fetch_array($qry)) {
            $bahan_tambahan = $row['bahan_tambahan'];
            $lot = $row['lot'];
            $batch_no_tambahan = $row['batch_no_tambahan'];
            $cs = $row['cs'];
            $jb = $row['jb'];
            echo 'LOT :&nbsp;' . $lot . '<br>Batch :&nbsp;' . $batch_no_tambahan . '<br>';
            echo 'JB :&nbsp;' . $jb . ' CS :&nbsp; ' . $cs . '<br>';
            echo $bahan_tambahan . '<br>';

        }
        echo "</td>";

        $m = 0;
        for ($i = 0; $i < count($lebar); $i++) {
            for ($j = 0; $j < ($station[$i]); $j++) {
                $m++;
                //	$k1= $k+1;
                $k1 = $k;
                $par = '"' . 'x_' . $itemID[$i] . '_' . $m . '_' . ($k1) . '"';

                $par2 = str_replace('x', 'z', $par);
                $div_isi = 'div_isi_' . $m . '_' . $k1;

                $cek_box = 'x_' . $itemID[$i] . '_' . $m . '_' . ($k);
                $sql = "";

                $sql = $sql_isi_data . "  and a1.baris_ke = '$k1' and a1.kolom_ke = '$m' ";
                echo "<td align='left' valign='top'><div id=$div_isi>"
                ?>
                <!--<td align='left' valign='top' >--> <?php

                $qry = mysql_query($sql) or die("Invalid !" . $sql);
                $var_print = '';
                while ($row = mysql_fetch_array($qry)) {
                    $id_tr_produksi_detail = $row['id_tr_produksi_detail'];
                    $id_tr_produksi_detail_batch_no = $row['id_tr_produksi_detail_batch_no'];
                    $var_print .= $id_tr_produksi_detail_batch_no . ",";
                    $matcode_hasil = $row['matcode_hasil'];
                    $batch_no = $row['batch_no'];
                    $turunan = substr($row['batch_no'], 5, 2);
                    $stat = substr($row['batch_no'], 7, 2);
                    $berat = $row['berat'];
                    $nama_grade = $row['nama_grade'];
                    $nama_reason = $row['nama_reason'];
                    $id_m_grade = $row['id_m_grade'];
                    $keterangan_reject = $row['keterangan_reject'];
                    $userid_created = pilih_satu_nama(($row['userid_created']), '');
                    $order_no = $row['order_no'];

                    $waktu_awal = $row['waktu_awal'];
                    $waktu_akhir = $row['waktu_akhir'];
                    $break_time = intval($row['break_time']);
                    $keterangan = $row['keterangan'];

                    $nama_shift = $row['nama_shift'];
                    $nama_group_shift = $row['nama_group_shift'];
                    $info = 'From :  ' . pilih_satu_tgl($row['waktu_awal'], '') . '  ' . pilih_satu_tgl($row['waktu_akhir'], '')
                        . '&#10;' . ' Shift : ' . $nama_shift . '&#10;'
                        . ' Group : ' . $nama_group_shift
                        . '&#10;' . ' Break : ' . $break_time . '&#10;'
                        . ' Note : ' . $keterangan;

                    $info = 'From :  ' . pilih_satu_tgl($row['waktu_awal'], '') . '  ' . pilih_satu_tgl($row['waktu_akhir'], '')
                        . '&#10;' . ' Shift : ' . $nama_shift . '&#10;'
                        . ' Group : ' . $nama_group_shift
                        . '&#10;' . ' Break : ' . $break_time
                        . '&#10;' . ' Note : ' . $keterangan
                        . '&#10;' . ' Turunan : ' . $turunan
                        . '&#10;' . ' Station : ' . $stat;
                    $date_created = pilih_satu_tgl($row['date_created'], '');
                    $lemparan = $id_tr_produksi_detail;
                    $link_edit = '<a title= " ' . $info . ' " onclick=" edit_turunan(' . $lemparan . ')"> ' . ($batch_no) . '</a>';

                    //echo $id_tr_produksi_detail .'<br>';
                    echo 'Order No :&nbsp;' . $order_no . "<br>";
                    //echo $sql  ."<br>";

                    echo $matcode_hasil . '<br>';
                    echo $link_edit . '<br>';
                    echo $berat . ' kg &nbsp;&nbsp;&nbsp;&nbsp;' . $nama_grade . '<br>';
                    echo 'Print : ';
                    ?>
                    <input type="checkbox" id="cek_cetak_<?= $m . '_' . $k1 ?>" name="cek_cetak_[]" checked="checked"
                           value="<?= $id_tr_produksi_detail_batch_no ?>"
                           onclick="choose_me_cetak(<?= $m ?>,<?= $k1 ?>,<?= $id_tr_produksi_detail_batch_no ?>);"/>
                    <br/>
                    <strong><font
                                color="#FF0000"><?php echo $nama_reason . '<br>' . $keterangan_reject; ?></font></strong>
                <?php } ?>
                </td>

                <?php


            }
        }
        $k1 = $k + 1;

//echo "<input name='button_save' type='button' class='' value='PRINT $k1' onclick='simpan_detail_baru_conf($par);' />";
        echo "<td align='center'>";
        if (trim($tur) <> '') {
            echo "<div id='div_save_" . $var_k . "'>
	<a onClick='print_kecil_inputan_baru_conf($k)'><img src='../images/print_merah.png' width='24' height='24' border='0' alt='besar' title='Label Kecil'/>&nbsp;</a>
	<a onClick='print_besar_inputan_baru_conf($k)'><img src='../images/print_kuning.png' width='24' height='24' border='0' alt='besar' title='Label BESAR'/></a>
	<a onClick='print_besar_iljin_conf_2($k)'><img src='../images/iljin.png' width='24' height='24' border='0' alt='iljin' title='Label iljin'/></a>
	".'<br>'  . $userid_created . '<br>' . $date_created;
            echo "<input name='list_cek_$k1' type='hidden'  class='textbox_angka' id='list_cek_$k1' maxlength='' />";
            echo "<input name='var_print_$k' type='hidden'  class='' id='var_print_$k' value ='$var_print' /></div>";
            $var_print = '';

            ?>

            <?php
            echo "</div>";
        }
        echo "</td>";
        echo "</tr>";
        ?>

        <script>
            var val = <?= $par; ?>;
            //tutup_div(val);
        </script>
        <?php
    }

    echo "</table>";
    if(!isset($k1)) $k1 = 0;
    echo "<input name='txt_jumlah_total_baris' type='hidden'  class='textbox_angka' id='txt_jumlah_total_baris' maxlength='' value='$k1' />";
    ?>


    </form>

    <?php


}


function save()
{
    $usernya = $_SESSION['userid'];
    $par = $_REQUEST['par'];
    //die('xxx'.$par);
    $cek_tam = $_POST['cek_tam'];
    $mat = $_POST['mat'];
    $jb = $_POST['jb'];
    $cs = $_POST['cs'];
    $qty = $_POST['qty'];
    $lebar = $_POST['lebar'];
    $panjang = $_POST['panjang'];
    $tipe = $_POST['tipe'];
    $berat = str_replace(',', '', $_POST['berat']);

    //die($mat .' '.$jb);
    //	echo 'xcvx,c'.$par;
    $arr = explode('^', $par);

    $text_tanggal_awal = $arr[0];
    $text_tanggal_akhir = $arr[1];
    $cbo_shift = $arr[2];
    $cbo_group_shift = $arr[3];
    $text_break = $arr[4];
    $txt_keterangan = $arr[5];
    $mat1 = $arr[6];
    $mat2 = $arr[7];
    $mat3 = $arr[8];
    $cbo_m_line = $arr[9];
    $cbo_grade = $arr[10];

    $text_id_grade = $arr[11];
    $batch_no = $arr[12];
    $text_material = $arr[13];
    $cbo_reason = $arr[14];
    $txt_keterangan_reject = $arr[15];
    if ($txt_keterangan_reject == 'undefined') {
        $txt_keterangan_reject = '';
    }
    if ($txt_keterangan == 'undefined') {
        $txt_keterangan = '';
    }
    if ($cbo_reason == 'undefined') {
        $cbo_reason = '0';
    }
    $text_turunan = $arr[16];
    $text_station = $arr[17];

    $id_tr_pk = $arr[18];
    $id_m_group = $arr[19];
    $id_tr_order = $arr[20];
    $kolom_ke = $arr[21];
    $baris_ke = $arr[22];
    $text_berat = $arr[23];
    $data_ke = $arr[24];


    //die('txt_keterangan : '. $txt_keterangan);
    $text_qty = '1';

    $sql = '';

    //
    $tgl = substr($text_tanggal_awal, 0, 10);


//echo $id_tr_pk."|". $id_m_group."|". $cbo_shift."|".$cbo_group_shift;
//die();

    $sql_detail = "		SELECT id_tr_produksi_detail ,nama_group_shift
					FROM tr_produksi_detail a 
					LEFT JOIN tr_order b on a.id_tr_order = b.id_tr_order
					LEFT JOIN tr_bahan c on b.id_tr_bahan = c.id_tr_bahan
					LEFT JOIN m_group_shift d on a.id_m_group_shift = d.id_m_group_shift	
					WHERE c.id_tr_pk  = '$id_tr_pk' and c.id_m_group = '$id_m_group' 
					and DATE_FORMAT((a.waktu_awal), '%Y-%m-%d') = '$tgl'
					AND  a.id_m_group_shift = '$cbo_group_shift' AND id_m_shift = '$cbo_shift' 
					AND a.machine_time is not null ";
    $qry_detail = mysql_query($sql_detail) or die("Invalid !" . $sql_detail);

    //die($sql_detail);

    while ($row_detail = mysql_fetch_array($qry_detail)) {
        $id_tr_produksi_detail = $row_detail['id_tr_produksi_detail'];
        $nama_group_shift = $row_detail['nama_group_shift'];

        if (trim($id_tr_produksi_detail) != '') {
            $list_id_tr_produksi_detail .= ',' . $id_tr_produksi_detail;
        }
    }
    if ($list_id_tr_produksi_detail != '') {
        $tgl_tampilan = convDate($tgl, '-', '1');
        echo 'Gagal, data Tgl : ' . $tgl_tampilan . ' dan Shift :' . $cbo_shift . $nama_group_shift . ' sudah di input CW nya. DELETE dulu CW tsb';
        die();
    }

    $list_id_tr_produksi_detail = substr($list_id_tr_produksi_detail, 1);

    $sql_cek =
        " SELECT id_tr_produksi FROM tr_produksi 
              WHERE id_tr_pk = '$id_tr_pk' ";

    $qry_ = mysql_query($sql_cek) or die('ERROR select : ' . $sql_cek);

    //echo $sql_cek;
    while ($row_ = mysql_fetch_array($qry_)) {
        $id_tr_produksi = $row_['id_tr_produksi'];
    }
    if ($id_tr_produksi < 1) {
        $sql = " INSERT INTO tr_produksi (id_tr_pk, keterangan, userid_received,date_received)
                    VALUES ('$id_tr_pk',NULL,'$usernya',now()) ";
        $query_inst_data = mysql_query($sql) or die('ERROR INSERT : ' . $sql);
        //die($sql);
        $sql_1 = "SELECT LAST_INSERT_ID()";
        $result = mysql_query($sql_1);
        while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
            $last_id = $row[0];
            $id_tr_produksi = $last_id;
        }
    }


    $sql_insert = " 
		INSERT INTO tr_produksi_detail 
		(id_tr_produksi,id_tr_order,id_m_shift,id_m_line,waktu_awal,waktu_akhir,
		 matcode_hasil,
		id_m_packing_detail,
		id_m_group_shift,id_m_grade, id_m_reason, qty,keterangan,
		 break_time, keterangan_reject, baris_ke,kolom_ke,
		userid_created,date_created )
		VALUES 
		('$id_tr_produksi','$id_tr_order','$cbo_shift','$cbo_m_line','$text_tanggal_awal','$text_tanggal_akhir',
		 '$text_material',
		 '$id_m_packing_detail',
		'$cbo_group_shift','$cbo_grade','$cbo_reason','$text_qty','$txt_keterangan',
		 '$text_break', '$txt_keterangan_reject', '$baris_ke','$kolom_ke',
		'$usernya',now()
		) ";
//echo $sql_insert . '<br>';
    $query_ins = mysql_query($sql_insert) or die('ERROR INSERT : ' . $sql_insert);
    $sql = "SELECT LAST_INSERT_ID()";
    $result = mysql_query($sql);
    while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
        $id_tr_produksi_detail = $row[0];
        //$berat_hasil = total_berat_per_tr_produksi_detail($last_id); //20161201 tambahan utk sisa
    }


//insert batch no


    $sql_exe = "INSERT INTO tr_produksi_detail_batch_no 
			( id_tr_order,id_tr_produksi_detail,id_m_paper_core,batch_no, berat, userid_created,date_created)
			VALUES 
			('$id_tr_order','$id_tr_produksi_detail','$id_m_paper_core','$batch_no','$text_berat', '$usernya',now())";
    //$a .= $sql_exe;
    $query = mysql_query($sql_exe) or die('ERROR ' . $pilihan . ' : ' . $sql_exe);
    //}

//echo '<br>'. $sql_exe;


    $sql_jumlah_turunan =
        " SELECT jumlah FROM tr_jumlah_turunan 
              WHERE id_tr_pk = '$id_tr_pk' AND id_m_group = '$id_m_group' ";

    $qry_ = mysql_query($sql_jumlah_turunan) or die('ERROR select : ' . $sql_jumlah_turunan);
    $jumlah_data = mysql_num_rows($qry_);

    if ($jumlah_data == 0) {
        $sql = " INSERT INTO tr_jumlah_turunan (id_tr_pk,id_m_group,jumlah) VALUES ('$id_tr_pk','$id_m_group','$baris_ke')";
        $qry_ = mysql_query($sql) or die('ERROR select : ' . $sql);
    } else if ($jumlah_data > 0) {
        $sql = " UPDATE tr_jumlah_turunan SET jumlah = '$baris_ke'
				 WHERE id_tr_pk = '$id_tr_pk' AND id_m_group = '$id_m_group' ";
        $qry_ = mysql_query($sql) or die('ERROR select : ' . $sql);

    }

//inseert material bahan

    $sql_del_x = "DELETE FROM tr_pk_m_group_matcode_bahan WHERE id_tr_pk = '$id_tr_pk' AND id_m_group = '$id_m_group' ";
    $query_del = mysql_query($sql_del_x) or die('ERROR DELETE : ' . $sql_del_x);

//if ($data_ke == '0')
    {
        $batch_no = ($_POST['batch_no']);
        $jum_tambahan = sizeof($batch_no);

        //die('xxzzz'.$jum_tambahan);

        if (intval($jum_tambahan) > 0) {
            $cek_tam = $_POST['cek_tam'];

            $lot_no = $_POST['lot_no'];
            $mat = $_POST['mat'];
            $jb = $_POST['jb'];
            $cs = $_POST['cs'];
            $qty = $_POST['qty'];
            $lebar = $_POST['lebar'];
            $panjang = $_POST['panjang'];
            $tipe = $_POST['tipe'];
            $berat = $_POST['berat'];

            $total_berat_bahan = 0; //20161201 tambahan utk sisa
            for ($i = 0; $i < ($jum_tambahan); $i++) {
                if ($batch_no[$i] != '') {
                    $berat[$i] = str_replace(',', '', ($berat[$i]));
                    $total_berat_bahan = $total_berat_bahan + $berat[$i];
                }
            }


            for ($i = 0; $i < ($jum_tambahan); $i++) {

                if (trim($batch_no[$i]) != '') {

                    $bahan_tambahan = strtoupper($bahan_tambahan[$i]);
                    $qty_tambahan = $qty[$i];
                    $qty[$i] = '1';
                    $lot_no[$i] = trim(strtoupper($lot_no[$i]));
                    $batch_no[$i] = trim(strtoupper($batch_no[$i]));
                    $mat[$i] = trim(strtoupper($mat[$i]));
                    $tipe[$i] = trim(strtoupper($tipe[$i]));
                    $berat[$i] = str_replace(',', '', trim($berat[$i]));

                    $sisa[$i] = $berat[$i] - ($berat[$i] / $total_berat_bahan * $berat_hasil);

                    $sql_x = "INSERT INTO tr_produksi_detail_bahan 	(id_tr_produksi_detail,id_tr_bahan,id_m_group,id_tr_order,bahan_tambahan,batch_no_tambahan,rolls_tambahan,lebar,panjang,jb,cs,tipe,berat,sisa,id_tr_pk,lot,userid_created,date_created)
		 VALUES ( $id_tr_produksi_detail , '0', $id_m_group, $id_tr_order,'$mat[$i]','$batch_no[$i]','$qty[$i]','$lebar[$i]','$panjang[$i]','$jb[$i]','$cs[$i]','$tipe[$i]','$berat[$i]','$sisa[$i]',$id_tr_pk, '$lot_no[$i]','$usernya',now())";
                    $a = $a . '<br>' . $sql_x;
                    //echo $sql_x;
                    $query_data = mysql_query($sql_x) or die('ERROR insert data: ' . $sql_x);

                    $sql_x2 = "INSERT INTO tr_pk_m_group_matcode_bahan 	(id_m_group,matcode,batch_no,qty,lebar,panjang,jb,cs,tipe,berat,id_tr_pk,lot,sisa)
		 VALUES ( $id_m_group,'$mat[$i]','$batch_no[$i]','$qty[$i]','$lebar[$i]','$panjang[$i]','$jb[$i]','$cs[$i]','$tipe[$i]','$berat[$i]',$id_tr_pk, '$lot_no[$i]','$sisa[$i]')";
                    $query_data = mysql_query($sql_x2) or die('ERROR insert data: ' . $sql_x2);


                }
            }
            //die($a);
        }
    }
    //


}


function material_bahan()
{

    ?>
    <script>
        $("#text_tanggal_awal").datepicker({dateFormat: 'yy-mm-dd'});
        $("#text_tanggal_akhir").datepicker({dateFormat: 'yy-mm-dd'});
    </script>
    <?php
    $div_material = $_REQUEST['div_material'];
//		echo $div_material;
    $arr = explode('_', $div_material);
    $id_tr_pk = $arr[0];
    $id_m_group = $arr[1];
    $txt_tambah_turunan = (isset($arr[2]) ? $arr[2] : '');

    $no_rps = tampilan_no_rps($id_tr_pk);

    $sql_z = "SELECT * FROM m_group WHERE id_m_group = '$id_m_group'";
    $qry_z = mysql_query($sql_z) or die('ERROR select : ' . $sql_z);
    while ($row_z = mysql_fetch_array($qry_z)) {
        $nama_group = trim($row_z['nama_group']);
    }


    $usernya = $_SESSION['userid'];
    $jumlah_kosong = 3;
//die($pr);

    $tanggal_awal = date("Y-m-d");
    $tanggal_akhir = date("Y-m-d");
    $jam_akhir = date("H");
    $menit_akhir = date("i");

    $sql_tipe = "SELECT matcode as tipe, id_sliter FROM tr_pk WHERE id_tr_pk = '$id_tr_pk' ";
    $qry_tipe = mysql_query($sql_tipe) or die("Invalid query sql_tipe!" . $sql_tipe);

    while ($row_tipe = mysql_fetch_array($qry_tipe)) {
        $tipe_tr_pk = $row_tipe['tipe'];
        $id_sliter = $row_tipe['id_sliter'];
    }
    $tipe_awal = $tipe_tr_pk;
    $sql_shift = "SELECT a.id_m_shift as val , nama_shift as display FROM m_shift a WHERE status ='t' ";
    $sql_group_shift = "SELECT a.id_m_group_shift as val , nama_group_shift as display FROM m_group_shift a WHERE status ='t'";

    $sql_line = "SELECT distinct tr.id_m_line  as val, CONCAT(c.nama_group_line,' - ',b.nama_line) as display
							FROM tr_order tr 
							INNER JOIN tr_bahan bh on tr.id_tr_bahan = bh.id_tr_bahan
							INNER JOIN m_line b ON tr.id_m_line = b.id_m_line
							INNER JOIN m_group_line c ON b.id_m_group_line = c.id_m_group_line
							WHERE bh.id_tr_pk = '$id_tr_pk' and bh.id_m_group = '$id_m_group' 
					ORDER BY tr.id_m_line";
    //echo $sql_line
    ?>
    <table width=100% border='0'>
        <tr class=''>
            <td width='9%'><strong>RPS</strong></td>
            <td width="29%"><strong><a target="_blank"
                                       href="../template/index_form_perintah_kerja.php?id_tr_pk=<?php echo $id_tr_pk ?>">
                        :&nbsp;<?= tampilan_no_rps($id_tr_pk) ?></a><?php echo ' ' . (isset($tampil_reslitter) ? $tampil_reslitter : '') ?>
                </strong></td>
            <td width='15%'><strong>Start Date <span class="warning">*)</span></strong></td>
            <td width="47%"><strong>:&nbsp;</strong><input name="text_tanggal_awal"
                                                           value="<?= isset($tanggal_awal_x) ? $tanggal_awal_x : '' ?>"
                                                           type="text" class="textbox_2" id="text_tanggal_awal"
                                                           maxlength="40"/>
                <select id="hour_from" name="hour_from" class="combobox">
                    <?php for ($i = 0; $i <= 23; $i++) {
                        $data = str_pad($i, 2, "0", STR_PAD_LEFT);
                        ?>

                        <option value="<?= $data ?>"<?php if ($data == (isset($jam_awal) ? $jam_awal : '00')) {
                            echo(" selected=\"selected\"");
                        } ?>>
                            <?= $data ?>
                        </option>
                    <?php } ?>
                </select> :
                <select id="minute_from" name="minute_from" class="combobox">
                    <?php for ($i = 0; $i <= 59; $i++) {
                        $data = str_pad($i, 2, "0", STR_PAD_LEFT);
                        ?>
                        <option value="<?= $data ?>"<?php if ($data == (isset($menit_awal) ? $menit_awal : '00')) {
                            echo(" selected=\"selected\"");
                        } ?>>
                            <?= $data ?>
                        </option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><strong>Partai</strong></td>
            <td><strong>: <?php echo isset($nama_group) ? $nama_group : '' ?></strong></td>
            <td width='15%'><strong>Finish Date</strong></td>
            <td><strong>:&nbsp;</strong><input name="text_tanggal_akhir" value="<?= $tanggal_akhir ?>" type="text"
                                               class="textbox_2" id="text_tanggal_akhir" maxlength="40"/>
                <select id="hour_to" name="hour_to" class="combobox">
                    <?php for ($i = 0; $i <= 23; $i++) {
                        $data = str_pad($i, 2, "0", STR_PAD_LEFT);
                        ?>
                        <option value="<?= $data ?>"<?php if ($data == $jam_akhir) {
                            echo(" selected=\"selected\"");
                        } ?>>
                            <?= $data ?>
                        </option>
                    <?php } ?>
                </select>
                :
                <select name="minute_to" id="minute_to" class="combobox">
                    <?php for ($i = 0; $i <= 59; $i++) {
                        $data = str_pad($i, 2, "0", STR_PAD_LEFT);
                        ?>
                        <option value="<?= $data ?>"<?php if ($data == $menit_akhir) {
                            echo(" selected=\"selected\"");
                        } ?>>
                            <?= $data ?>
                        </option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><strong>Type</strong></td>
            <td><strong>: <?php echo $tipe_tr_pk ?></strong></td>
            <td align="left" valign="middle"><strong>Break Time</strong> <br/></td>
            <td colspan="4" align="left" valign="middle"><strong>:&nbsp;</strong><input name="text_break" type="text"
                                                                                        class="textbox_angka"
                                                                                        id="text_break" maxlength="10"
                                                                                        value="<?php echo isset($break_time) ? $break_time : '0' ?>"
                                                                                        onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"/>
                Menit
            </td>

        </tr>
        <tr>
            <td><strong>Machine</strong></td>
            <td>
                <strong>: <?php makecomboonchange($sql_line, "cbo_m_line", "cbo_m_line", "", isset($id_m_shift) ? $id_m_shift : '', "", "", ""); ?></strong>
            </td>
            <td rowspan="2" align="left" valign="middle"><strong>Note</strong></td>
            <td rowspan="2" align="left" valign="middle"><textarea name="txt_keterangan" rows="3" class="textarea_3"
                                                                   id="txt_keterangan"><?php echo isset($keterangan) ? $keterangan : '' ?></textarea>
            </td>
        </tr>
        <tr>
            <td><span class="warning">Shift *)</span></td>
            <td>
                : <?php makecomboonchange($sql_shift, "cbo_shift", "cbo_shift", "", isset($id_m_shift) ? $id_m_shift : '', "- Pilih -", "", ""); ?>
                <span class="warning">&nbsp;Group *)&nbsp;</span>
                <?php makecomboonchange($sql_group_shift, "cbo_group_shift", "cbo_group_shift", "", isset($id_m_shift) ? $id_m_shift : '', "- Pilih -", "", ""); ?>
            </td>
        </tr>

    </table>
    <?php

    /*$temp_mat_tambahan = 'temp_mat_tambahan_'.$_SESSION['userid'];

    $sql1 = " DROP TABLE IF EXISTS $temp_mat_tambahan ";
    $qry_1 = mysql_query($sql1) or die('ERROR : '.$sql1);

    $sql1 = "
    CREATE TABLE $temp_mat_tambahan (
        `id_temp_mat_tambahan` INT(2) UNSIGNED NOT NULL AUTO_INCREMENT,
        `id_tr_pk` INT(2) NOT NULL,
        `id_m_group` INT(2) NOT NULL,
         id_tr_produksi_detail_bahan INT(2) NOT NULL,
        `id_tr_order` INT(2) NOT NULL,
        `id_tr_produksi_detail` INT(2) NOT NULL,
        `batch_no` VARCHAR(15) NULL DEFAULT NULL,
        `lot` VARCHAR(15) NULL DEFAULT NULL,
        `tipe` VARCHAR(10) NULL DEFAULT NULL,
        `jb` VARCHAR(10) NULL DEFAULT NULL,
        `cs` VARCHAR(10) NULL DEFAULT NULL,
        `lebar` INT(2) NULL DEFAULT NULL,
         panjang INT(2) NULL DEFAULT NULL,
        `qty` DECIMAL(12,2) NULL DEFAULT NULL,
        `matcode` VARCHAR(25) NULL DEFAULT NULL,
        `berat` DECIMAL(12,3) NULL DEFAULT NULL,
        `rack` VARCHAR(20) NULL DEFAULT NULL,
         PRIMARY KEY (`id_temp_mat_tambahan`)
    )
    ;
    ";
$qry_1 = mysql_query($sql1) or die('ERROR : '.$sql1);

//echo '|';

if ($id_tr_order =='undefined') //untuk yg dari depan
    {

    $sql_d2= " 	SELECT COUNT(*) as jumlah_ FROM tr_pk_m_group_matcode_bahan
                WHERE id_tr_pk = '$id_tr_pk' AND id_m_group = '$id_m_group' ";
    $qry_d2 = mysql_query($sql_d2) or die("Invalid sql_inst select!" . $sql_d2);
//echo($sql_d2);
        $row_d2 = mysql_fetch_assoc($qry_d2);
        $jumlah_ = intval($row_d2['jumlah_']);
        if ( $jumlah_ == '0')
        {
        $sql_d2 = "
        INSERT INTO  $temp_mat_tambahan
         (id_tr_pk,id_m_group,batch_no,matcode,tipe,lebar,panjang,jb,cs,qty,lot)
        SELECT '$id_tr_pk','$id_m_group',batch_no,
        CASE
        WHEN upper(rack) ='I' OR upper(rack) ='R'  THEN CONCAT(matcode,LPAD(lebar,4,'0'),LPAD(panjang,5,'0'), upper(rack))
        ELSE CONCAT(matcode,LPAD(lebar,4,'0'),LPAD(panjang,5,'0'))
         END  as matcode,
                    matcode,lebar, panjang,jb,cs,'0',lot
        FROM tr_bahan a
        INNER JOIN m_schedule_detail b on a.id_m_schedule_detail = b.id_m_schedule_detail
        WHERE a.id_tr_pk = '$id_tr_pk'  AND a.id_m_group = '$id_m_group'
        order by a.id_tr_bahan,a.id_m_schedule_detail, b.lot, b.lebar, b.panjang";
        //die($sql_d2);
        $qry_d2 = mysql_query($sql_d2) or die("Invalid sql_insert !" . $sql_d2);
        }

    $sql_d = " 	INSERT INTO  $temp_mat_tambahan
                     (id_tr_pk,id_m_group,batch_no,matcode,tipe,lebar,panjang,jb,cs,qty,berat)
                SELECT '$id_tr_pk','$id_m_group',batch_no,matcode,
                    tipe,lebar, panjang,jb,cs,qty,berat
                  FROM tr_pk_m_group_matcode_bahan
                WHERE id_tr_pk = '$id_tr_pk' AND id_m_group = '$id_m_group' ORDER BY id_tr_pk_m_group_matcode_bahan";
    echo($sql_d);

    $qry_d = mysql_query($sql_d) or die("Invalid sql_inst select!" . $sql_d);

    $jumlah_d = $jumlah_kosong - mysql_affected_rows();
    if ($jumlah_d < 0)
    {
        $jumlah_d  = mysql_affected_rows() + $jumlah_kosong;
    }

    for ($i = 1; $i <= $jumlah_d ; $i++)
        {
            $sql_inst = "INSERT INTO $temp_mat_tambahan (id_tr_pk,id_m_group) VALUES ($id_tr_pk,$id_m_group) ";
            $qry_x = mysql_query($sql_inst) or die("Invalid sql_inst select!" . $sql_inst);
        }

$tipe_awal = $tipe_tr_pk;

    }

else
{

//echo 'aa'. $id_tr_order;
    if ($id_tr_produksi_detail != '')
    {
    $where =  " WHERE id_tr_produksi_detail = '$id_tr_produksi_detail' ORDER BY id_tr_produksi_detail_bahan ";
$tipe_awal = $tipe_tr_pk;

    $sql = " INSERT INTO  $temp_mat_tambahan
                  (id_tr_order,id_tr_produksi_detail,id_tr_produksi_detail_bahan,batch_no,matcode,tipe,lebar,panjang,jb,cs,qty,berat)
            SELECT id_tr_order,id_tr_produksi_detail,id_tr_produksi_detail_bahan,batch_no_tambahan,bahan_tambahan,
                tipe,lebar, panjang,jb,cs,rolls_tambahan,berat
              FROM tr_produksi_detail_bahan ";

    $sql = $sql . $where;
//echo($sql);
    $qry_x = mysql_query($sql) or die("Invalid sql_inst select!" . $sql);
    $jumlah_isi = $jumlah_kosong - mysql_affected_rows();
    if ($jumlah_isi < 0)
    {
        $jumlah_isi  = mysql_affected_rows() + $jumlah_kosong;
    }

        for ($i = 1; $i <= $jumlah_isi ; $i++)
        {
            $sql_inst = "INSERT INTO $temp_mat_tambahan (id_tr_order) VALUES ('$id_tr_order') ";
            $qry_x = mysql_query($sql_inst) or die("Invalid sql_inst select!" . $sql_inst);
        }

    }
    else
    {


    $sql = " INSERT INTO  $temp_mat_tambahan (batch_no,matcode,tipe,lebar,panjang,jb,cs,qty,berat)
            SELECT batch_no,matcode,tipe,lebar,panjang,jb,cs,qty,berat
            FROM tr_pk_m_group_matcode_bahan WHERE id_tr_pk = '$id_tr_pk' and id_m_group = '$id_m_group'
            ORDER BY id_tr_pk_m_group_matcode_bahan";
//die($sql);
        $qry_x = mysql_query($sql) or die("Invalid sql_inst select!" . $sql);
        $jumlah_isi = $jumlah_kosong - mysql_affected_rows();
    if ($jumlah_isi < 0)
    {
        $jumlah_isi  = mysql_affected_rows() + $jumlah_kosong;
    }
        for ($i = 1; $i <= $jumlah_kosong ; $i++)
        {
            $sql_inst = "INSERT INTO $temp_mat_tambahan (id_tr_order) VALUES ('$id_tr_order') ";
            $qry_x = mysql_query($sql_inst) or die("Invalid sql_inst select!" . $sql_inst);
        }
        $tipe_awal = $tipe_tr_pk;

    }


}
//echo $pr;
    $sql2 = " SELECT * FROM $temp_mat_tambahan ORDER BY id_temp_mat_tambahan ";
    $qry2 = mysql_query($sql2) or die("Invalid query select!" . $sql2);
    $jumlah_data = mysql_num_rows($qry2);*/
//echo $sql2;

    $i = 0;

//$jumlah_paket =1;
//echo $sql2;
    /*echo $jumlah_kosong .'<br>';
    echo $id_tr_pk.'<br>';
    echo $id_m_group.'<br>';
    echo 'id_tr_order'.$id_tr_order.'<br>';
    echo $id_tr_produksi_detail.'<br>';*/

    $sql = "
	SELECT 'w' as val, 'WIP' as display UNION
	SELECT 's' as val, 'SEASONING RACK' as display ";

    if ($id_sliter == 's') {
        $id_default = 's';
    }
    if ($id_sliter == 'r') {
        $id_default = 'w';
    }

    echo 'List Material &nbsp;&nbsp;&nbsp;&nbsp;';
    makecomboonchange($sql, 'cbo_db', 'cbo_db', "", $id_default, "", "", "");

    $offset = '0';

    ?>
    <input name="txt_matcode" id="txt_matcode" type="hidden" value="<?php echo $matcode ?>"/>
    <table>
        <tr>
            <td>

                <table border="0" cellspacing="2" cellpadding="2" bgcolor="#FFFFFF" width="75%">
                    <tr class="table_header">
                        <td width="1%" height="30" align="center" valign="middle">No</td>
                        <td width="2%" align="center" valign="middle">Batch No *)</td>
                        <td width="8%" align="center" valign="middle">Lot No</td>
                        <td width="5%" align="center" valign="middle">JB *)</td>
                        <td width="5%" align="center" valign="middle">CS *)</td>
                        <td width="5%" align="center" valign="middle">Type</td>
                        <td width="5%" align="center" valign="middle">Width</td>
                        <td width="5%" align="center" valign="middle">Length</td>
                        <td width="3%" align="center" valign="middle">Material Code *)</td>
                        <td width="1%" align="center" valign="middle">Weight (Kg)</td>
                        <td width="1%" align="center" valign="middle">DEL</td>

                        <!--<td width="8%" align="center" valign="middle"><input type="checkbox" id="check_all" name="check_all" onClick="checklist_all(this)" /></td>-->
                    </tr>
                    <?php
                    $c = 0;
                    //$sql_d= " SELECT 1 UNION SELECT 2 UNION SELECT 3 ";
                    /*$sql_d= " SELECT DISTINCT bahan_tambahan, lot, batch_no_tambahan,cs, jb, berat,lebar,panjang
                              FROM tr_produksi_detail_bahan
                              WHERE id_tr_pk = '$id_tr_pk' AND id_m_group = '$id_m_group'";*/

                    /*$sql_d = " SELECT DISTINCT a.bahan_tambahan,a.lot, a.batch_no_tambahan, a.cs, a.jb, a.berat, a.lebar, a.panjang, b.jumlah
                    FROM tr_produksi_detail_bahan a
                    LEFT JOIN tr_jumlah_turunan b ON a.id_tr_pk = b.id_tr_pk AND a.id_m_group = b.id_m_group
                    WHERE a.id_tr_pk = '$id_tr_pk' and a.id_m_group = '$id_m_group'  AND id_tr_produksi_detail IN
                        (SELECT id_tr_produksi_detail FROM tr_produksi_detail a1
                         INNER JOIN tr_order a2 ON a1.id_tr_order = a2.id_tr_order
                         INNER JOIN tr_bahan a3 ON a2.id_tr_bahan = a3.id_tr_bahan
                          WHERE a3.id_tr_pk = a.id_tr_pk AND a3.id_m_group = a.id_m_group AND a1.baris_ke = b.jumlah) ";
                    */
                    $sql_d = " SELECT * FROM tr_pk_m_group_matcode_bahan 
WHERE id_tr_pk = '$id_tr_pk' AND id_m_group = '$id_m_group' ";
                    //echo $sql_d ;

                    $qry_d = mysql_query($sql_d) or die("Invalid sql_inst select tr_pk_m_group_matcode_bahan !" . $sql_d);

                    $jumlah_data_x = mysql_num_rows($qry_d);
                    //echo $jumlah_data_x;
                    if ($jumlah_data_x == 0) {
                        $sql_d = " SELECT 1 UNION SELECT 2 UNION SELECT 3 ";
                        $qry_d = mysql_query($sql_d) or die("Invalid sql_inst select UNION !" . $sql_d);
                    } elseif ($jumlah_data_x > 0) {
                        $sql_d .= " UNION 
					SELECT '1','','','','','','','','','','','','','' UNION
					SELECT '2','','','','','','','','','','','','',''  ";
                        //	echo $sql_d;
                        $sql_d = $sql_d . " ORDER BY id_tr_pk DESC, id_tr_pk_m_group_matcode_bahan ";
                        $qry_d = mysql_query($sql_d) or die("Invalid sql_inst select UNION!" . $sql_d);
                        //ORDER BY id_tr_pk_m_group_matcode_bahan
                    }
                    //echo $sql_d;
                    $no = 0;
                    $c = 0;
                    while ($row = mysql_fetch_array($qry_d)) {
                        $no++;
                        $c++;
                        $dari_data = '1';
                        //id_m_group,batch_no,tipe,jb,cs,lot,lebar,panjang,qty,berat,matcode,
                        $batch_no = (isset($row['batch_no']) ? $row['batch_no'] : '');
                        $matcode = (isset($row['matcode']) ? $row['matcode'] : '');
                        $tipe = (isset($row['tipe']) ? $row['tipe'] : '');
                        $lot = trim((isset($row['lot']) ? $row['lot'] : ''));
                        $jb = (isset($row['jb']) ? $row['jb'] : '');
                        $cs = (isset($row['cs']) ? $row['cs'] : '');
                        $berat = (isset($row['berat']) ? $row['berat'] : '');
                        $lebar = (isset($row['lebar']) ? $row['lebar'] : '');
                        $panjang = (isset($row['panjang']) ? $row['panjang'] : '');
                        $sisa = (isset($row['sisa']) ? $row['sisa'] : '');
                        if (intval($berat == 0)) {
                            $dari_data = '0';
                            $berat = hitung_berat($matcode);
                        }
                        $data_material = $lot . "|" . $jb . "|" . $cs . "|" . $tipe . "|" . $lebar . "|" . $panjang . "|" . $matcode . "|" . $berat . "|" . $sisa;
                        //	echo 'xx'.$data_material;

                        ?>
                        <tr class="<?php if ($i % 2 == 0) {
                            echo("table_row_even");
                        } else {
                            echo("table_row_odd");
                        } ?>">
                            <td width="1%" align="center" valign="top"><?php echo $no ?></td>
                            <td width="8%" align="center" valign="top"><input style="text-transform: uppercase"
                                                                              type="text"
                                                                              class="textbox_batch_no_lengkap" <?php echo isset($text_disabled) ? $text_disabled : '' ?>
                                                                              onkeypress="default_batch_no(<?php echo $c ?>,<?php echo "'" . $tipe_awal . "'" ?>,this.value,'')"
                                                                              id="batch_no<?php echo $c ?>"
                                                                              name="batch_no[]" maxlength="12"
                                                                              value="<?php echo $batch_no ?>"/></td>
                            <td width="8%" align="center" valign="top">
                                <?php echo "<div id='div_lot_no_" . $c . "'>";
                                echo "</div>" ?>

                                <!--<input  style="text-transform: uppercase" type="text" class="textbox_batch_no_lengkap" <?php echo $text_disabled ?> onblur="display_tipe('tipe<?php echo $c ?>','<?php echo $tipe_awal ?>','mat<?php echo $c ?>', <?php echo $c ?>,this.value, <?php echo $id_tr_produksi_detail_bahan ?>)" id="lot_no<?php echo $c ?>" name="lot_no[]" maxlength="10" value="<?php echo $lot_no ?>" />-->

                            </td>
                            <td width="5%" align="center" valign="top">
                                <?php echo "<div id='div_jb_" . $c . "'>";
                                echo "</div>" ?>
                                <!--<input type="text" class="textbox_batch_no" <?php echo $text_disabled ?> onkeyup="checkDec(this)" id="jb<?php echo $c ?>" name="jb[]" maxlength="10" value="<?php echo $jb ?>"/>-->
                            </td>
                            <td width="5%" align="center" valign="top">
                                <?php echo "<div id='div_cs_" . $c . "'>";
                                echo "</div>" ?>
                                <!--<input type="text" class="textbox_batch_no" <?php echo $text_disabled ?> onkeyup="checkDec(this)" id="cs<?php echo $c ?>" name="cs[]" maxlength="10" value="<?php echo $cs ?>"/>-->
                            </td>
                            <td width="5%" align="center" valign="top">
                                <?php echo "<div id='div_type_" . $c . "'>";
                                echo "</div>" ?>
                            </td>
                            <td width="5%" align="right" valign="top">
                                <?php echo "<div id='div_lebar_" . $c . "'>";
                                echo "</div>" ?>

                                <!--<input type="text" class="textbox_angka_kecil" <?php echo $text_disabled ?> onkeyup="checkDec(this)" onblur="display('tipe<?php echo $c ?>','lebar<?php echo $c ?>','panjang<?php echo $c ?>','mat<?php echo $c ?>','berat<?php echo $c ?>')" id="lebar<?php echo $c ?>" name="lebar[]" maxlength="4" value="<?php echo $row['lebar'] ?>"/>-->

                            </td>
                            <td width="5%" align="right" valign="top">
                                <?php echo "<div id='div_panjang_" . $c . "'>";
                                echo "</div>" ?>
                                <!--<input type="text" class="textbox_angka_kecil" <?php echo $text_disabled ?> onkeyup="checkDec(this)" id="panjang<?php echo $c ?>" name="panjang[]" maxlength="5" value="<?php echo $row['panjang'] ?>"  onblur="display('tipe<?php echo $c ?>','lebar<?php echo $c ?>','panjang<?php echo $c ?>','mat<?php echo $c ?>','berat<?php echo $c ?>')" />--></td>
                            <td width="3%" align="center" valign="top"><label for="mat"></label>
                                <?php echo "<div id='div_mat_" . $c . "'>";
                                echo "</div>" ?>


                                <!--<input style="text-transform: uppercase" type="text" name="mat[]" id="mat<?php echo $c ?>" size="15px" value="<?php echo $matcode ?>"     onclick ="show_berat_matcode(this.value, <?php echo $c ?>,'batch_no<?php echo $c ?>', <?php echo $id_tr_produksi_detail_bahan ?>)" onblur  ="show_berat_matcode(this.value, <?php echo $c ?>,'batch_no<?php echo $c ?>', <?php echo $id_tr_produksi_detail_bahan ?>)" onchange="show_berat_matcode(this.value, <?php echo $c ?>,'batch_no<?php echo $c ?>', <?php echo $id_tr_produksi_detail_bahan ?>)" onfocus ="show_berat_matcode(this.value, <?php echo $c ?>,'batch_no<?php echo $c ?>', <?php echo $id_tr_produksi_detail_bahan ?>)" />-->

                            </td>

                            <?php if ($dari_data == '1') {
                                ?>
                                <td width="1%" align="right" valign="top">
                                    <div id="div_berat_matcode<?php echo $c ?>">
                                        <!--<input type="text" class="textbox_angka" onkeyup="checkDec(this)" id="berat<?php echo $c ?>" name="berat[]" maxlength="25" value="<?php echo number_format($berat, 2) ?>" />--></div>
                                </td>

                            <?php } else { ?>
                                <td width="4%" align="right" valign="top">
                                    <div id="div_berat_matcode<?php echo $c ?>"></div>
                                </td>
                            <?php } ?>
                            <!--<?php echo $id_tr_pk ?>',<?php echo $id_m_group ?> ,'<?php echo $c ?>',-->
                            <td width="1%" align="center" valign="top"><a
                                        onClick="delete_bahan_awal('lot_no<?php echo $c ?>','batch_no<?php echo $c ?>','jb<?php echo $c ?>','cs<?php echo $c ?>','tipe<?php echo $c ?>','lebar<?php echo $c ?>','panjang<?php echo $c ?>','mat<?php echo $c ?>','berat<?php echo $c ?>')"><img
                                            src="../images/icons/del_data.png" border="0"/></a></td>


                            <script>
                                //alert(<?php echo $c ?>);
                                default_batch_no(<?php echo $c ?>,<?php echo "'" . $tipe_awal . "'" ?>,<?php echo "'" . $batch_no . "'" ?>,<?php echo "'" . $data_material . "'" ?>)
                            </script>

                        </tr>
                    <?php }
                    ?>
                    <input name="txt_jumlah_bahan" id="txt_jumlah_bahan" class="" type="hidden"
                           value="<?php echo $c ?>"/>
                </table>

            </td>
            <td>
                <input name="txt_tambah_turunan" id="txt_tambah_turunan" class="textbox_angka_kecil"
                       onkeyup="checkDec(this)" type="text" value="0"/>
                <?php
                $lemparan = "'" . $offset . "|" . $id_tr_pk . '|' . $id_m_group . "'";
                ?>
                <input type="button" name="button_save" id="button_save" class="button" value="+ Turunan"
                       onclick="tambah_turunan(<?= $lemparan ?>)"/>

                <!--<a onclick=" inputan_baru('."'". $offset ."|".$id_tr_pk.'|'. $id_m_group."'". ')">'.'<br>INPUT'.'&nbsp</a>-->
            </td>
        </tr>
    </table>

    <?php
    mysql_close();

}

function change_grade_matcode()
{
    $par_matcode = $_REQUEST['par_matcode'];
    $nilai_panjang = $_REQUEST['nilai_panjang'];
    $nilai_station = $_REQUEST['nilai_station'];
    $nilai_turunan = $_REQUEST['nilai_turunan'];
    $id_tr_order = $_REQUEST['cbo_order'];
    $cbo_lebar = $_REQUEST['cbo_lebar'];
    $txt_id_tr_pk = $_REQUEST['txt_id_tr_pk'];

    $text_tanggal_awal = $_REQUEST['text_tanggal_awal'];
    $id_m_line = $_REQUEST['id_m_line'];
    $txt_id_m_group = $_REQUEST['txt_id_m_group'];

    $arr = explode('|', $par_matcode);
    $id_grade = $arr[0];

    if ($id_grade == 0) {
        die();
    }
    $var = $arr[1];
    $arr2 = explode('_', $arr[1]);
    $order_no = $arr2[1];
    //$turunan = $arr2[3] + 1;
    $tahun = substr($text_tanggal_awal, 3, 1);
    $bulan = substr($text_tanggal_awal, 5, 2);
    $tanggal = substr($text_tanggal_awal, 8, 2);
    $bulan = convert_bulan_ke_huruf($bulan);

    $sql_x = "
		SELECT DISTINCT substring(a.batch_no,6,2) as turunan,substring(d.waktu_awal,1,10) 
		FROM tr_produksi_detail_batch_no a 
		INNER JOIN tr_order b ON a.id_tr_order = b.id_tr_order
		INNER JOIN tr_bahan c ON b.id_tr_bahan = c.id_tr_bahan
		INNER JOIN tr_produksi_detail d ON a.id_tr_produksi_detail = d.id_tr_produksi_detail 
		WHERE c.id_tr_pk = '$txt_id_tr_pk' AND c.id_m_group = '$txt_id_m_group' 
		AND substring(d.waktu_awal,1,10) = '$text_tanggal_awal'
		AND  substring(a.batch_no,6,2) = '$nilai_turunan'";

//die($sql_x);
    $qry_turunan = mysql_query($sql_x) or die('ERROR select : ' . $sql_x);
    $jumlah_turunan = mysql_num_rows($qry_turunan);
    if ($jumlah_turunan > 0) {
        $tgl_double = trim(pilih_satu_tgl($text_tanggal_awal, ''));
        ?>
        <script>
            var turunan = <?php echo $nilai_turunan ?>;
            var waktu_awal = <?php echo "'" . $tgl_double . ",'" ?>;

            alert('Turunan : ' + turunan + ' in Start Date : ' + waktu_awal + ' already Exist !!');
            //change_grade_matcode('<?php echo '"' . $par_matcode . '"' ?>)
        </script>
        <?php
        die('<br>Turunan : ' . $nilai_turunan . ' in Start Date : ' . $tgl_double . ', already Exist !!');
    }

    $nilai_panjang = roundTo($nilai_panjang, 100);
    /*echo 'par_matcode '.($par_matcode).'<br>';
    echo 'var '.($var).'<br>';
    echo 'nilai_panjang '.($nilai_panjang).'<br>';
    echo 'nilai_station '.($nilai_station).'<br>';
    echo 'nilai_turunan '.($nilai_turunan).'<br>';
    echo 'text_tanggal_awal '.($text_tanggal_awal).'<br>';
    echo 'id_m_line '.($id_m_line).'<br>';
    echo 'id_tr_order '.($id_tr_order).'<br>';
    echo 'cbo_lebar '.($cbo_lebar).'<br>';
    echo 'txt_id_m_group '.($txt_id_m_group).'<br>';
    echo 'sql_x '.($sql_x).'<br>';*/

    //die($par_matcode);


    $sql_line =
        " SELECT a.* 
            FROM m_line a WHERE id_m_line ='$id_m_line'
         ";
    $qry_line = mysql_query($sql_line) or die('ERROR select : ' . $sql_line);
    while ($row_line = mysql_fetch_assoc($qry_line)) {
        $nama_line = trim($row_line["nama_line"]);
    }


    $batch_no = $tahun . $bulan . $tanggal . $nama_line . str_pad($nilai_turunan, 2, '0', STR_PAD_LEFT) . str_pad($nilai_station, 2, '0', STR_PAD_LEFT);
    $sql_cek_batch_no = "SELECT a.batch_no, b.order_no 
				FROM tr_produksi_detail_batch_no a
				LEFT JOIN tr_order b ON a.id_tr_order = b.id_tr_order 
				WHERE a.batch_no ='$batch_no'";
    $qry_cek_batch_no = mysql_query($sql_cek_batch_no) or die('ERROR select : ' . $sql_cek_batch_no);
    //echo $sql_cek_batch_no;
    while ($row_cek_batch_no = mysql_fetch_array($qry_cek_batch_no)) {
        $batch_no_cek = trim($row_cek_batch_no['batch_no']);
        $order_no_cek = $row_cek_batch_no['order_no'];
    }
    if (isset($batch_no_cek) && $batch_no_cek != '') {
        ?>
        <script>
            var batch_no_cek = <?php echo $batch_no_cek ?>;
            var order_no = <?php echo "'" . $order_no . ",'" ?>;
            alert('Batch No : ' + batch_no_cek + ' already Exist in Order No : ' + order_no + ' ');
        </script>
        <?php
        die('<br>Batch No : ' . $batch_no_cek . ' already Exist in Order No : ' . $order_no_cek . ' ');
    }

    echo "<input type='hidden' id='text_id_grade_$var' name='text_id_grade_$var' class='textbox_2'  value='$id_grade' />";

    $sql_order =
        "SELECT or_x.id_tr_order,c.matcode, or_x.order_no, or_x.station, or_x.lebar as lebar_potongan, or_x.panjang as panjang_potongan, or_x.jumlah , c.berat, a.id_m_group
		FROM tr_order or_x 
		INNER JOIN tr_bahan a on or_x.id_tr_bahan = a.id_tr_bahan
		INNER JOIN tr_pk b ON a.id_tr_pk = b.id_tr_pk 
		INNER JOIN m_schedule_detail c ON a.id_m_schedule_detail = c.id_m_schedule_detail 
		WHERE or_x.id_tr_order  = '$id_tr_order' 
		ORDER BY a.id_m_group,a.id_tr_bahan,  a.id_m_schedule_detail,or_x.id_tr_order, c.lot, c.lebar, c.panjang ";
    $qry_order = mysql_query($sql_order) or die('ERROR select : ' . $sql_order);
//echo $sql_order;
    $panjang_potongan = 0;
    $j = 0;
    while ($row_order = mysql_fetch_array($qry_order)) {
        $j++;
        $id_tr_order = $row_order['id_tr_order'];
        //$id_tr_bahan = $row_order['id_tr_bahan'];
        $matcode = $row_order['matcode'];
        $berat = $row_order['berat'];
        $order_no = $row_order['order_no'];
        $lebar_potongan = $row_order['lebar_potongan'];
        $panjang_potongan = $row_order['panjang_potongan'];
        $station = $row_order['station'];
        $jumlah = $row_order['jumlah'];
        $material = $matcode . str_pad($lebar_potongan, 4, 0, STR_PAD_LEFT) . str_pad($panjang_potongan, 5, 0, STR_PAD_LEFT);

    }
    $sql_grade =
        " SELECT a.* 
            FROM m_grade a WHERE id_m_grade ='$id_grade' ORDER BY nama_grade
          ";
    $qry_grade = mysql_query($sql_grade) or die('ERROR select : ' . $sql_grade);
    while ($row = mysql_fetch_assoc($qry_grade)) {
        $nama_grade = trim($row["nama_grade"]);
    }


    $sisipan = '';
    $akhiran = '';

    if ($nama_grade == 'A') {
        $sisipan = $nama_grade;
        $akhiran = '';
        $panjang = intval($nilai_panjang);
    } elseif ($nama_grade == 'B') {
        $sisipan = $nama_grade;
        $akhiran = '';
        $panjang = intval($nilai_panjang);
    }elseif ($nama_grade == 'I') {
        $sisipan = 'A';
        $akhiran = 'I';
        //$panjang = ceil($nilai_panjang/100)*100;
        $panjang = intval($nilai_panjang);
        /*if ($panjang == 0) {?><script>alert('Length is empty !');</script><?php die(); }*/
    } elseif ($nama_grade == 'R') {
        $sisipan = 'B';
        $akhiran = $nama_grade;
        //$panjang = ceil($nilai_panjang/100)*100;
        $panjang = intval($nilai_panjang);
        /*if ($panjang == 0) {?><script>alert('Length is empty !');</script><?php die(); }*/
    } elseif ($nama_grade == 'RC') {
        $sisipan = 'B';
        $akhiran = $nama_grade;
        //$panjang = ceil($nilai_panjang/100)*100;
        $panjang = intval($nilai_panjang);
        /*if ($panjang == 0) {?><script>alert('Length is empty !');</script>die();<?php }*/
    } else {
        $sisipan = $nama_grade;
    }


    echo "<table cellpadding='0' cellspacing='3'>";

    echo '<tr><td >Order No</td>';
    echo '<td align="right">' . $order_no . '</td></tr>';

    echo '<tr><td>Batch</td>';
    echo '<td align="right">' . $batch_no . '</td></tr>';

    echo '<tr><td>Width</td>';
    echo '<td align="right">' . $cbo_lebar . '</td></tr>';

    echo '<tr><td>Length</td>';
    echo '<td align="right">' . $panjang . '</td></tr>';

//echo 'Width  : '.($cbo_lebar).'<br>';
    echo "<input type='hidden' id='text_batch_no_$var' name='text_batch_no_$var' class='' disabled='disabled'  value='$batch_no' />";
    echo "<input type='hidden' id='text_id_tr_order_$var' name='text_id_tr_order_$var' class='textbox_2'  value='$id_tr_order' />";
    //$matcode_hasil = tampil_matcode($id_grade,$matcode_order_no);
//echo "<input name='cccc_it' type='text'  class='' id='cccc_it' maxlength='40' value = '".$material."' />";


    if (isset($id_sliter) && $id_sliter == 'r') {
        $text = 'class="textbox_3"';
    } else {
        //$text ='readonly="readonly" class="textbox_3_read_only"';
        //$text ='class="textbox_3_read_only"';
        //$text ='class="textbox_3"';
        $text = 'class="textbox_15"';
    }
    //$material_hasil_x = substr($material, 0, 2) . $sisipan . substr($material, 3, strlen($material)) . $akhiran;
    if(!isset($material)) $material = '';
    $material_hasil = substr($material, 0, 2) . $sisipan . substr($material, 3, 4) . str_pad($cbo_lebar, 4, 0, STR_PAD_LEFT) . str_pad($panjang, 5, 0, STR_PAD_LEFT) . $akhiran;
    $material_hasil_data = '';
    if (isset($id_tr_produksi_detail) && $id_tr_produksi_detail !== '') {
        $sql_material_hasil =
            " SELECT matcode_hasil, keterangan_reject 
            FROM tr_produksi_detail a WHERE id_tr_produksi_detail ='$id_tr_produksi_detail'
          ";
        $qry_material_hasil = mysql_query($sql_material_hasil) or die('ERROR select : ' . $sql_material_hasil);
        while ($row_material_hasil = mysql_fetch_assoc($qry_material_hasil)) {
            $material_hasil_data = trim($row_material_hasil["matcode_hasil"]);
            $keterangan_reject = trim($row_material_hasil["keterangan_reject"]);

        }

        if (trim($material_hasil_data) <> trim($material_hasil)) {
//echo 'Material Sebelumnya : '.$material_hasil_data .'<br>';
        }

    }
//echo 'zz';
    ?>
    <!--<input name="text_material"<?php echo $text ?> value="<?= $material_hasil ?>" type="text"  id="text_material" maxlength="20"  />
-->

    <?php
    $text_berat = number_format(hitung_berat($material_hasil), 2);
//echo 'ooo';
    echo "<tr><input type='hidden' id='text_material$text' name='text_material$text' class='' disabled='disabled'  value='$material_hasil' />";
    echo '<td colspan="2" align="center">' . $material_hasil . '</td>';
    echo '</tr>';
    echo '<tr>';
    echo "<td colspan='2'><input type='text' id='text_berat_$var' name='text_berat_$var' class='textbox_angka_2' onkeyup='checkDec(this)' value='$text_berat' /> Kg</td></tr>";
// echo '</table>';


    echo "<input type='hidden' id='text_material_$var' name='text_material_$var'  value='$material_hasil' />";
    echo "<input type='hidden' id='text_berat_$var' name='text_berat_$var' class='textbox_angka_2' onkeyup='checkDec(this)' value='$text_berat' />";
    echo '<br>';
    echo $id_grade;
    if ($id_grade > 3) {
        $sql = "
 		SELECT a.* 
        FROM m_reason a WHERE status ='t'";
        $qry = mysql_query($sql) or die("Invalid query select!" . $sql);
        $jumlah_data = mysql_num_rows($qry);
        $i = 0;
        //echo $id_m_reason;
        echo '<tr></tr>';
        echo '<td colspan="2">';
        ?>

        <select id="cbo_reason_<?php echo $var ?>" name="cbo_reason_<?php echo $var ?>" class="combobox" onchange="">

            <?php while ($row = mysql_fetch_assoc($qry)) {
                //$isi_value = trim($row["id_m_reason"]);
                ?>
                <option value="<?= $row["id_m_reason"] ?>"
                    <?php
                    if (isset($id_m_reason)){
                        if ($row["id_m_reason"] == $id_m_reason) {
                            echo 'selected';
                            }
                        }
                    ?>
                    >
                    <?= $row["nama_reason"] ?></option>
            <?php } ?> </select>



            <?php
            echo '</td>';
            echo '<tr></tr>';
            echo '<td colspan="2">Reason</td>';
            echo '<tr></tr>';
            echo '<td colspan="2">';
            ?>
        <textarea name="txt_keterangan_reject_<?php echo $var ?>" rows="2" class="textarea_2"
                           id="txt_keterangan_reject_<?php echo $var ?>"><?php echo isset($keterangan_reject) ? $keterangan_reject : '' ?></textarea>

        <?php
        echo '</td>';
        //echo "<td><input type='text' id='text_berat_$var' name='text_berat_$var' class='textbox_angka_2' onkeyup='checkDec(this)' value='$text_berat' /></td>";
        echo '</table>';
        mysql_close();
    }
//


}

function show_grade()
{

    $par = $_REQUEST['par'];

    $par_matcode = "'" . str_replace('x', 'z', $par) . "'";
    //echo 'par show_grade = '.$par;
    $sql = "
	SELECT 10000 as val, 'Grade A' as display UNION
	SELECT 20000 as val, 'Grade B' as display UNION
	SELECT id_m_reason as val, nama_reason as display
		FROM m_reason WHERE status ='t' ";
    echo '&nbsp;Grade :';
    $sql = "SELECT id_m_grade as val , nama_grade as display FROM m_grade ORDER BY id_m_grade";
    makecomboonchange($sql, 'cbo_' . $par, 'cbo_' . $par, "", isset($id_m_tipe) ? $id_m_tipe : '', "- Pilih -", "", "change_grade_matcode(value+'|'+$par_matcode)");

}

function form_input_baru_per_partai()
{

    $lemparan_partai = $_REQUEST['lemparan_partai'];
    $txt_tambah_turunan = intval(isset($_REQUEST['txt_tambah_turunan']) ? $_REQUEST['txt_tambah_turunan'] : '');

    //echo 'xxx'.$txt_tambah_turunan;

    $arr_isi = explode("|", $lemparan_partai);
    $offset = trim($arr_isi[0]);
    $id_tr_pk = trim($arr_isi[1]);
    $id_m_group = trim($arr_isi[2]);
    $tt = trim(isset($arr_isi[3]) ? $arr_isi[3] : '');

    $var_mat = $id_tr_pk . "_" . $id_m_group;
//echo 'xxxxx'.$id_m_group;
    ?>

    <script type="text/javascript">


        var offset = '1';
        var div_material = <?php echo "'" . $var_mat . "'" ?>;
        Loaddiv('div_datax', 'inputan_baru.php', 'act=material_bahan&offset=' + offset + '&div_material=' + div_material);
    </script>
    <?php


    $sql_z = "SELECT * FROM m_group WHERE id_m_group = '$id_m_group'";
    $qry_z = mysql_query($sql_z) or die('ERROR select : ' . $sql_z);
    while ($row_z = mysql_fetch_array($qry_z)) {
        $nama_group = trim($row_z['nama_group']);
    }

    $sql_z2 = "SELECT max(baris_ke) as max_baris_ke FROM tr_produksi_detail WHERE id_tr_order IN 
	(SELECT id_tr_order FROM tr_order tr 
							INNER JOIN tr_bahan bh on tr.id_tr_bahan = bh.id_tr_bahan
							WHERE bh.id_tr_pk = '$id_tr_pk' and bh.id_m_group = '$id_m_group' ) ";
    $qry_z2 = mysql_query($sql_z) or die('ERROR select : ' . $sql_z);
    while ($row_z2 = mysql_fetch_array($qry_z2)) {
        $max_baris_ke = intval(trim(isset($row_z2['max_baris_ke']) ? $row_z2['max_baris_ke'] : 0));
    }

//echo $sql_z2 . ' max_baris_ke = '. $max_baris_ke;

    $baris_baru = (isset($max_baris_ke) ? $max_baris_ke : 0) + 1;

    $sql = "

SELECT 10000 as val, 'Grade A' as display UNION
SELECT 20000 as val, 'Grade B' as display UNION
SELECT id_m_reason as val, nama_reason as display
	FROM m_reason WHERE status ='t' ";
    $result = mysql_query($sql) or die(mysql_error());


    $sql_turunan = "SELECT * FROM tr_jumlah_turunan a
		WHERE a.id_tr_pk = '$id_tr_pk' and a.id_m_group = '$id_m_group'";
    $qry_turunan = mysql_query($sql_turunan) or die('ERROR select : ' . $sql_turunan);

    $max_turunan = 0;
    $jumlah_tambahan = 0;
    $jumlah_turunan = 0;
    $last_id_tr_order = '';
    $last_width = ''; $last_station = '';
    while ($row = mysql_fetch_assoc($qry_turunan)) {
        $jumlah_turunan = intval($row['jumlah']);
        $last_station = $row['last_station'];
        $jumlah_tambahan = intval($row['jumlah_tambahan']);

        $last_id_tr_order = ($row['last_id_tr_order']);
        $last_width = ($row['last_width']);
    }

    if ($jumlah_tambahan == '') {
        $jumlah_tambahan = 0;
    }
    $jumlah_tambahan_tambah_satu = intval($jumlah_tambahan + 1);

    $baris_ke = $jumlah_turunan + 1;
    if (isset($list_status_order) && $list_status_order != '') {
        $list_status_order = 'ada';
    }
    $sql_z = "
SELECT id_m_reason as val, nama_reason as display FROM m_reason ";

    $sql_cbo_order = "SELECT DISTINCT id_tr_order as val, order_no as display
							FROM tr_order tr 
							INNER JOIN tr_bahan bh on tr.id_tr_bahan = bh.id_tr_bahan
WHERE bh.id_tr_pk = '$id_tr_pk' and bh.id_m_group = '$id_m_group' and tr.status IS NULL ORDER BY id_tr_order";
    $qry_cbo_order = mysql_query($sql_cbo_order) or die('ERROR select : ' . $sql_cbo_order);
    //die();
    $max_turunan = 0;
    $jum_CW_terbesar = 0;
    while ($row_order = mysql_fetch_assoc($qry_cbo_order)) {
        $id_tr_order_x = $row_order['val'];
        //$id_tr_order_x = ($row['id_tr_order']);
        $jum_CW = cek_CW($id_tr_order_x);
        if ($jum_CW_terbesar < $jum_CW) {
            $jum_CW_terbesar = $jum_CW;
        }

        //echo 'jum_CW = ' . $jum_CW . ' '. $id_tr_order_x. '<br>';
        //jum_CW_terbesar
    }

    $sql_prod_detil = "SELECT order_no, case when station = '0' then 1 else station end as station, panjang,lebar,id_tr_order, jumlah
							FROM tr_order tr 
							INNER JOIN tr_bahan bh on tr.id_tr_bahan = bh.id_tr_bahan
WHERE bh.id_tr_pk = '$id_tr_pk' and bh.id_m_group = '$id_m_group' and tr.status IS NULL ORDER BY id_tr_order";
//echo $sql_prod_detil ;
    $qry_prod_detil = mysql_query($sql_prod_detil) or die('ERROR select : ' . $sql_prod_detil);
    //die();
    $max_turunan = 0;
    $itemID = []; $lebar = []; $station = [];
    while ($row = mysql_fetch_assoc($qry_prod_detil)) {
        $itemID[] = htmlentities($row['order_no']);
        $id_tr_order[] = htmlentities($row['id_tr_order']);
        $station[] = htmlentities($row['station']);
        $jumlah[] = htmlentities($row['jumlah']);

        $station_x = ($row['station']);
        $jumlah_x = htmlentities($row['jumlah']);
        $bagi = $jumlah_x / $station_x;

        if ($bagi > $max_turunan) {
            //	$max_turunan = $bagi;
        }

        $panjang[] = htmlentities($row['panjang']);
        $panjang_tabel = htmlentities($row['panjang']);
        $lebar[] = htmlentities($row['lebar']);

        if (intval($panjang_tabel) > '0') {
            $panjang_default = $panjang_tabel;
        }
        //  $id_tr_order[] = $row['id_tr_order'];

        //$total = $total + $station[];


    }
    /*$max_turunan = $max_turunan + $txt_tambah_turunan;
    if ($jumlah_turunan > 0)
        {
            $max_turunan = $jumlah_turunan ;
        }*/

    ?>

    <form name="form_add_input" id="form_add_input" class="">

        <div id="div_datax"></div>
        <?php

        echo "<table  width=100% border='' cellpadding='0' cellspacing='0'>";
        echo "<tr><td>";
        echo "<input name='txt_id_tr_pk' type='hidden'  class='' id='txt_id_tr_pk' maxlength='' value='$id_tr_pk' />";
        echo "<input name='txt_id_m_group' type='hidden'  class='' id='txt_id_m_group' maxlength='' value='$id_m_group' />";
        echo "<input name='list_cek' type='hidden'  class='textbox_angka' id='list_cek' maxlength='' />";
        echo "<input name='list_cekxx' type='hidden'  class='' id='list_cekxx' maxlength='' value='$last_id_tr_order'/>";
        echo "<input name='txt_jumlah_tambahan_tambah_satu' type='hidden'  class='' id='txt_jumlah_tambahan_tambah_satu'  value='$jumlah_tambahan_tambah_satu'/>";

        echo "</td></tr>";
        echo "</table>";
        echo "<table  width=100% border='' cellpadding='0' cellspacing='0'>";
        echo "<tr class='table_header'><td colspan=3 width='2%'>Order No</td>";
        $h = 0;
        for ($i = 0; $i < count($itemID); $i++) {

            for ($j = 0; $j < ($station[$i]); $j++) {
                $h++;
                if ($j == 0) {
                    echo "<td align='center' colspan=$station[$i]>&nbsp;$itemID[$i]";

                    echo "</td>";

                }
            }
        }
        echo "<td rowspan=3 width='5%'>Save
	</td>";

        echo "</tr>";
        echo "<tr><td colspan=3>ORDER</td>";

        if ($last_id_tr_order == '') {
            /*$c = 0;
            for ($i = 0; $i < count($lebar); $i++) {
                for ($j = 0; $j < ($station[$i]); $j++) {
                    $c++;
                    echo "<td width='' align='center'>&nbsp;" . $itemID_xxx[$i] . "&nbsp;";
                    makecomboonchange($sql_cbo_order, 'cbo_order_' . $c, 'cbo_order_' . $c, "", $id_tr_order[$i], "", "", "change_cbo_order(value+'|'+$c)");
                    echo "</td>";
                }
            }*/
        } else {
            $arr_order = explode("|", $last_id_tr_order);
            $c = 0;
            for ($i = 0; $i < count($lebar); $i++) {
                for ($j = 0; $j < ($station[$i]); $j++) {
                    $c++;
                    $b = $c - 1;
                    echo "<td width='' align='center'>";
                    makecomboonchange($sql_cbo_order, 'cbo_order_' . $c, 'cbo_order_' . $c, "", $arr_order[$b], "", "", "change_cbo_order(value+'|'+$c)");
                    echo "</td>";
                }
            }
        }
        echo "</tr>";

        echo "<tr><td colspan=3>Width</td>";

        $d = 0;
        for ($i = 0; $i < count($lebar); $i++) {

            for ($j = 0; $j < ($station[$i]); $j++) {
                $d++;
                $b = $d - 1;

                if ($last_width != '') {
                    $arr_width = explode("|", $last_width);
                    $where = " WHERE id_tr_order = '$arr_order[$b]' ";
                    $default_width = $arr_width[$b];
                } else {
                    $where = " WHERE id_tr_order = '$id_tr_order[$i]' ";
                    $default_width = $lebar[$i];
                }


                $sql = "SELECT lebar as val, lebar as display
				FROM tr_order tr  $where
				";

                echo "<td width='' align='center'><div id='div_cbo_order_" . $d . "'>";
                makecomboonchange($sql, "cbo_lebar_" . $d, "cbo_lebar_" . $d, "", $default_width, "", "", "");
                echo "</div></td>";

            }
        }
        echo "</tr>";


        echo "<tr><td colspan=3>Station</td>";
        $tabel_stasion_isi = '';
        for ($j = 0; $j < ($h); $j++) {
            $vj = $j + 1;
            $arr_station = explode("|", $last_station);
            if ($last_station != '') {
                echo "<td align='center'>
			<input name='text_station_$vj' type='text'  class='textbox_batch_no' id='text_station_$vj' maxlength='2' 
			value = '" . str_pad($arr_station[($j)], 2, '0', STR_PAD_LEFT) . "' onkeyup='checkDec(this)' />
			</td>";
            } else {
                echo "<td align='center'>
			<input name='text_station_$vj' type='text'  class='textbox_batch_no' id='text_station_$vj' maxlength='2' 
			value = '" . str_pad(($j + 1), 2, '0', STR_PAD_LEFT) . "' onkeyup='checkDec(this)' />
			</td>";
            }
            $tabel_stasion_isi .= "<td align='center'>
			<input name='text_station_$vj' type='text'  class='textbox_batch_no' id='text_station_$vj' maxlength='2' value = '" . str_pad(($j + 1), 2, '0', STR_PAD_LEFT) . "' onkeyup='checkDec(this)' />
			</td>";
        }
        /*if ($jum_CW_terbesar == 0)
        {
        echo "<td align='center'><input name='button_save' type='button' class='button' value='SAVE' onclick='simpan_detail_baru_all();' />";
        }
        else
        {
            echo "<td align='center'>CW";
        }*/
        echo "<td align='center'><input name='button_save' type='button' class='button' value='SAVE' onclick='simpan_detail_baru_all();' />";
        echo "</td>";
        echo "</tr>";
        echo "<tr><td align='center'>";
        /*echo "<tr>
        <td align='center' width='2%'>
        <div id='div_klik_'>
<a onclick='tutup()'><img src='../images/arrow_2.jpg' alt='Add' width='25' height='25' border='0' title='Show / Hide ALL()' /></a>
</div>
<input type='checkbox' id='check_all_inp_atas_' name='check_all_inp' onclick='checklist_all_inp(this)' />";*/
        echo "<input name='text_jumlah_stasion' type='hidden'  class='' id='text_jumlah_stasion' maxlength='' value= '$h' />";
        echo "No</td><td align='center' width ='5%' >Turunan</td><td align='center' width ='5%'>Length</td>";
        echo "
		</tr>";

        $yy = count($station);
        //$zz = $max_turunan;
        $zz = $baris_ke;

        //for ($k=0; $k<$zz;$k++)
        for ($k = $zz - 1; $k < $zz + $jumlah_tambahan; $k++) //for ($k=0; $k<$zz + $jumlah_tambahan;$k++)
        {
            $var_k = $k + 1;
            $par_cek_hide = "'" . $h . "_" . ($var_k) . "'";

            echo "<tr>";

            if (isset($panjang[$k]) && intval($panjang[$k]) == 0) {
                $panjang[$k] = $panjang_default;
            }
            ?>
            <!--<td width="2%" align="center"><div id="div_cek_inp_<?php echo $var_k ?>"><input type="checkbox" id="cek_inp_atas_<?= $var_k ?>" name="cek_inp_atas_[]" value="<?= $var_k ?>" onclick="choose_me_inp(<?= $var_k ?>,<?= $var_k ?>);"/></div></td>-->

            <?php echo "<td align='center'><div id='div_no_urut_" . $var_k . "'>" . ($var_k) . "</div></td>";
            /*echo "<td align='center'><div id='div_turunan_".$var_k."'><input name='text_turunan_$var_k' type='text'  class='textbox_batch_no' id='text_turunan_$var_k' maxlength='2' value = '".str_pad($var_k,2,'0',STR_PAD_LEFT)."' onkeyup='checkDec(this)' /></div></td>";

        echo "<td align='center'><div id='div_panjang_".$var_k."'><input name='text_pjg_$var_k' type='text'  class='textbox_angka' id='text_pjg_$var_k' maxlength='5' value = '".$panjang[$k]."' onkeyup='checkDec(this)' /></div></td>";*/

            echo "<td align='center'><div id='div_turunan_" . $var_k . "'><input name='text_turunan_$var_k' type='text'  class='textbox_batch_no' id='text_turunan_$var_k' maxlength='2' value = '' onkeyup='checkDec(this)' /></div></td>";

            echo "<td align='center'><div id='div_panjang_" . $var_k . "'><input name='text_pjg_$var_k' type='text'  class='textbox_angka' id='text_pjg_$var_k' maxlength='5' value = '' onkeyup='checkDec(this)' /></div></td>";


            /* echo "<td align='center'><div id='div_turunan_".$var_k."'><input name='text_turunan_$var_k' type='text'  class='textbox_batch_no' id='text_turunan_$var_k' maxlength='2' value = '' onkeyup='checkDec(this)' /></div></td>";

              echo "<td align='center'><div id='div_panjang_".$var_k."'><input name='text_pjg_$var_k' type='text'  class='textbox_angka' id='text_pjg_$var_k' maxlength='5' value = '' onkeyup='checkDec(this)' /></div></td>";*/


            $m = 0;
        for ($i = 0;
             $i < count($lebar);
             $i++)
        {
        for ($j = 0;
             $j < ($station[$i]);
             $j++)
        {
            $m++;
            $k1 = $k + 1;
            $par = '"' . 'x_' . $itemID[$i] . '_' . $m . '_' . ($k1) . '"';
            //$par = '"'.'x_'.$id_tr_order[$i].'_'.$m.'_'.($k1).'"';

            $par2 = str_replace('x', 'z', $par);
            $div_isi = 'div_isi_' . $m . '_' . $k1;

            $cek_box = 'x_' . $itemID[$i] . '_' . $m . '_' . ($k);
            echo "<td align='left' valign='top'><div id=$div_isi>";
            $test = 'x_' . $itemID[$i] . '_' . $m . '_' . ($var_k);
            ?>

        <input type="checkbox" id="cek_<?= $m . '_' . $k1 ?>" name="cek_<?= $m . '_' ?>[]"
               value="<?= "'" . $test . "'" ?>" onclick="change_grade_new(<?= "'" . $test . "'" ?>);"/>
        <?php

        echo "<div id=$par></div>";
        echo "<div id=$par2></div>";

        echo "</div></td>";
        ?>
            <script>
                val = <?= $par; ?>;
                var div_nya = val;
                var e = $("#" + div_nya);
                Loaddiv(div_nya, 'inputan_baru.php', 'act=show_grade&par=' + val);
                e.hide();

            </script>
        <?php
        }
        }
        $k1 = $k + 1;
        echo "<td align='center'><div id='div_save_" . $var_k . "'>";
        echo "<input name='list_cek_$k1' type='hidden'  class='textbox_angka' id='list_cek_$k1' maxlength='' />";
        ?>

        <?php
        echo "</div></td>";
        echo "</tr>";
        ?>

            <script>
                var val = <?= $par; ?>;
                //tutup_div(val);
            </script>
            <?php
        }

        $val = '"' . '0|' . $id_tr_pk . '|' . $id_m_group . '"';
        echo "</table>";
        echo "<input name='txt_awal_baris' type='hidden'  class='textbox_angka' id='txt_awal_baris' maxlength='' value='$baris_ke' />";
        echo "<input name='txt_jumlah_total_baris_atas' type='hidden'  class='textbox_angka' id='txt_jumlah_total_baris_atas' maxlength='' value='$k1' />";
        echo "<input name='txt_jumlah_total_kolom_atas' type='hidden'  class='textbox_angka' id='txt_jumlah_total_kolom_atas' maxlength='' value='$m' />";
        //$tabel_order ='';
        $tabel_atas =
            "<table  width=100% border='' cellpadding='0' cellspacing='0'>
<tr><td>
</td></tr>
</table>
<table  width=100% border='' cellpadding='0' cellspacing='0'>
<tr class='table_header'><td colspan=4 width='2%'>Order No</td>";


        echo "<table width='100%'>";
        echo "<tr>";
        echo "<td>";
        echo "<a onclick='show_hidden()'><img src='../images/arrow_2.jpg' alt='Add' width='25' height='25' border='0' title='Show / Hide Transaction' />&nbsp;Show / Hide Transaction</a>";
        echo "</td>";
        echo "<td>";
        echo "<a onclick='show_all($val)'><img src='../images/arrow_1.jpg' alt='Add' width='25' height='25' border='0' title='ALL / Last Transaction' />&nbsp;ALL / Last Transaction</a>";
        echo "<input name='txt_status_show' type='hidden'  class='' id='txt_status_show' maxlength='' value='' />";
        echo "</td>";
        echo "</tr>";
        echo "</table>";
        echo "<div id = 'view_history'></div>";

        /*<br>.$tabel_atas
               $tabel_order
            $tabel_print
            $tabel_width
            $tabel_lebar
        $tabel_stasion
        $tabel_stasion_isi*/
        ?>

    </form>


    <script>
        val = <?= "'" . '0|' . $id_tr_pk . '|' . $id_m_group . "'" ?>;
        //alert(' xxx ' + val);
        var div_nya = 'view_history';
        var e = $("#" + div_nya);
        Loaddiv(div_nya, 'inputan_baru.php', 'act=view_history&lemparan_partai=' + val);
        //e.hide();

    </script>
<?php } ?>
