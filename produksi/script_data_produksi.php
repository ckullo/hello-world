<?php require_once("../include/config.php"); ?>
<?php require_once("../include/session.php"); ?>
<?php require_once("../include/function.php"); ?>
<?php
$act = $_REQUEST['act'];
//die('xxx_act = '. $act);
switch ($act) {
    case 'show_table':
        show_table();
        break;
    //  case 'save': save(); break;
    case 'delete_data':
        delete_data();
        break;
    // case 'edit': edit(); break;
    case 'add_order':
        add_sub();
        break;
    //case 'approve_data': approve_data(); break;
    case 'save_produksi':
        save_produksi();
        break;
    //case 'delete_order': delete_order(); break;
    case 'edit_data_detail' :
        add_sub();
        break;
    case 'save_edit_produksi' :
        save_edit_produksi();
        break;
    case 'delete_detail_produksi' :
        delete_detail_produksi();
        break;

    case 'form_edit_data_waste' :
        form_edit_data_waste();
        break;
    case 'save_data_waste' :
        save_data_waste();
        break;

    case 'form_add_batch_no' :
        form_add_batch_no();
        break;
    case 'save_batch_no' :
        save_batch_no();
        break;
    case 'delete_batch_no' :
        delete_batch_no();
        break;

    case 'form_add_sisa_bahan' :
        form_add_sisa_bahan();
        break;
    case 'save_sisa_bahan' :
        save_sisa_bahan();
        break;
    case 'delete_sisa_bahan' :
        delete_sisa_bahan();
        break;

    case 'form_add_group_mesin' :
        form_add_group_mesin();
        break;
    case 'save_group_mesin' :
        save_group_mesin();
        break;

    case 'approve_order' :
        approve_order();
        break;

    case 'update_batch_no_bahan' :
        update_batch_no_bahan();
        break;
    case 'save_add_batch_no_bahan_qc' :
        save_add_batch_no_bahan_qc();
        break;
    case 'delete_all_batch_no' :
        delete_all_batch_no();
        break;
    case 'un_approve_order' :
        un_approve_order();
        break;

    case 'form_add_material_bahan' :
        form_add_material_bahan();
        break;
    case 'save_mat_bahan_awal' :
        save_mat_bahan_awal();
        break;

    case 'input_note_produksi' :
        input_note_produksi();
        break;
    case 'form_add_partai' :
        form_add_partai();
        break;
    case 'save_partai' :
        save_partai();
        break;

    case 'delete_partai_per_tgl_dan_shift' :
        delete_partai_per_tgl_dan_shift();
        break;
    case 'cetak_label_kecil' :
        cetak_label_kecil();
        break;
    case 'cetak_label_besar' :
        cetak_label_besar();
        break;
    case 'cetak_label_iljin' :
        cetak_label_iljin();
        break;


}

function cetak_label_iljin()
{
    require_once("../print_barcode/label_iljin.php");
    $txt_lemparan = $_REQUEST['id'];
    $copies = $_REQUEST['copies'];
    $usernya = $_SESSION['userid'];

    /*echo 'txt_lemparan = '.$txt_lemparan . '<br>';
echo 'copies = '.$copies . '<br>';
echo 'usernya = '.$usernya . '<br>';
die();*/


    $jum = substr_count($txt_lemparan, ",");
//echo '<br>'. $jum ;
    $arr = explode(",", $txt_lemparan);
//sort($arr);
    for ($i = 0; $i < $jum; $i++) {
        $id = $arr[$i];
        if (isset($copies)) {
            // The Copies Variable exists
            for ($j = 0; $j < $copies; $j++) {
                // Run X times - Once for each Copy
                //echo $j . ' - '. $arr[$i] .'<br>';
                proses_cetak_label_besar($arr[$i]);
            }
        } else {
            // The Copies Variable does not exist - Assume 1 Copy
            proses_cetak_label_besar($arr[$i]);
        }
        //$id = $arr[$i];
        //proses_cetak_label_besar($arr[$i]);

    }


}

function cetak_label_besar()
{
    require_once("../print_barcode/label_besar.php");
    $txt_lemparan = $_REQUEST['id'];
    $copies = $_REQUEST['copies'];
    $usernya = $_SESSION['userid'];

    /*echo 'txt_lemparan = '.$txt_lemparan . '<br>';
echo 'copies = '.$copies . '<br>';
echo 'usernya = '.$usernya . '<br>';
die();*/


    $jum = substr_count($txt_lemparan, ",");
//echo '<br>'. $jum ;
    $arr = explode(",", $txt_lemparan);
//sort($arr);
    for ($i = 0; $i < $jum; $i++) {
        $id = $arr[$i];
        if (isset($copies)) {
            // The Copies Variable exists
            for ($j = 0; $j < $copies; $j++) {
                // Run X times - Once for each Copy
                //echo $j . ' - '. $arr[$i] .'<br>';
                proses_cetak_label_besar($arr[$i]);
            }
        } else {
            // The Copies Variable does not exist - Assume 1 Copy
            proses_cetak_label_besar($arr[$i]);
        }
        //$id = $arr[$i];
        //proses_cetak_label_besar($arr[$i]);

    }


}

function cetak_label_kecil()
{
//die('vvxxx'.$copies);
    require_once("../print_barcode/label_kecil.php");
    $txt_lemparan = $_REQUEST['id'];
    $copies = $_REQUEST['copies'];
    $usernya = $_SESSION['userid'];


//echo 'vvv'.$txt_lemparan;

    $jum = substr_count($txt_lemparan, ",");
//echo '<br>'. $jum ;
    $arr = explode(",", $txt_lemparan);
//sort($arr);
    for ($i = 0; $i < $jum; $i++) {

        $id = $arr[$i];
        if (isset($copies)) {
            // The Copies Variable exists
            for ($j = 0; $j < $copies; $j++) {
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

function delete_partai_per_tgl_dan_shift()
{
    $txt_lemparan = $_REQUEST['txt_lemparan'];
    $data = explode("|", $txt_lemparan);
    $offset = $data[0];
    $list_id_tr_produksi_detail = substr($data[1], 1);
    $list_id_tr_produksi_detail = str_replace("x", ",", $list_id_tr_produksi_detail);
//die('ggg='.$list_id_tr_produksi_detail);
    $usernya = $_SESSION['userid'];

    $sql_update = " 
					UPDATE tr_produksi_detail
					SET  counter_awal = null ,
 						 counter_akhir = null, 
						 waste_edge = null,
						 waste_reclaime = null,
						 waste_edge_total = null,
						 waste_reclaime_total = null,
						 machine_time = null,
					     userid_cw = '$usernya',
		 				 date_cw  = now() 
					WHERE id_tr_produksi_detail in ($list_id_tr_produksi_detail) ; ";

    //$a =$a. $sql_update  .'<br>';
    $query = mysql_query($sql_update) or die('ERROR UPDATE data: ' . $sql_update);
//echo $sql_update;
    echo('sukses');
}

function save_partai()
{
    $txt_lemparan = $_REQUEST['txt_lemparan'];
    echo('txt_lemparan' . $txt_lemparan);
    //die();
    $usernya = $_SESSION['userid'];
    $periode = date("mY");

    $id_tr_pk = $_POST['id_tr_pk'];
    $id_m_group = $_POST['id_m_group'];


    if ($value_combo == '0') {
        $where_combo = "";
    } else {
        $where_combo = " AND DATE_FORMAT((a.waktu_awal), '%Y-%m-%d') = '$tgl'
						AND a.id_m_shift = '$id_m_shift' 
						AND a.id_m_group_shift = '$id_m_group_shift' ";
    }
    $cbo_prod_detil = $_POST['cbo_prod_detil'];


    $tgl = $_POST['tgl'];
    $id_m_shift = $_POST['id_m_shift'];
    $id_m_group_shift = $_POST['id_m_group_shift'];
    $text_counter_awal = $_POST['text_counter_awal'];
    $text_counter_akhir = $_POST['text_counter_akhir'];
    $text_waste_edge = $_POST['text_waste_edge'];
    $text_waste_reclaime = $_POST['text_waste_reclaime'];
    $list_id_tr_produksi_detail = $_POST['list_id_tr_produksi_detail'];
    $jumlah_order = $_POST['jumlah_order'];

    $z = count($tgl);

//echo 'ddd'.($txt_id_tr_order);
//echo 'z='.$z;
//die($berat_x[1]);

    for ($i = 0; $i < $z; $i++) {
        {
            $batch_no[$i] = $batch_no_1[$i] . $nilai[$i];
            $counter_awal[$i] = str_replace(",", "", $text_counter_awal[$i]);
            $counter_akhir[$i] = str_replace(",", "", $text_counter_akhir[$i]);
            $waste_edge[$i] = str_replace(",", "", $text_waste_edge[$i]);
            $waste_reclaime[$i] = str_replace(",", "", $text_waste_reclaime[$i]);
            $list_id_tr_produksi_detail[$i] = substr(str_replace("<br>", ",", $list_id_tr_produksi_detail[$i]), 1);
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
            if (trim($counter_awal[$i]) != '' and trim($counter_akhir[$i]) != '') {
                //	echo 'ff'. $counter_awal[$i];
                $query = mysql_query($sql_update) or die('ERROR UPDATE data: ' . $sql_update);
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
            while ($row_2 = mysql_fetch_array($qry_2)) {
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
                if (trim($counter_awal[$i]) != '' and trim($counter_akhir[$i]) != '') {
                    $query = mysql_query($sql_upd2) or die('ERROR UPDATE data: ' . $sql_upd2);
                }
            }

        }

    }
//die($a);
    echo('sukses');

}

function input_note_produksi()
{
    $id_tr_pk = $_REQUEST['id_tr_pk'];
    $nilai = ($_REQUEST['nilai']);

    $usernya = $_SESSION['userid'];

    $sql = "UPDATE tr_pk 
					SET 
					catatan_produksi = '$nilai',
					userid_produksi = '$usernya' ,
					date_produksi = now()  
					WHERE id_tr_pk = '$id_tr_pk' ";
    //die($sql);
    $query = mysql_query($sql) or die('ERROR  : ' . $sql);
    echo 'sukses';
}

function save_mat_bahan_awal()
{

    $id_tr_pk = ($_POST['id_tr_pk']);
    $id_m_group = ($_POST['id_m_group']);
    $batch_no = ($_POST['batch_no']);
    $jum_tambahan = sizeof($batch_no);

    if (intval($jum_tambahan) > 0) {

        $sql = " DELETE FROM tr_pk_m_group_matcode_bahan WHERE id_tr_pk = '$id_tr_pk' and id_m_group = '$id_m_group'  ";
        $query_data = mysql_query($sql) or die('ERROR DELETE : ' . $sql);

        $cek_tam = $_POST['cek_tam'];
        $mat = $_POST['mat'];
        $jb = $_POST['jb'];
        $cs = $_POST['cs'];
        $qty = $_POST['qty'];
        $lebar = $_POST['lebar'];
        $panjang = $_POST['panjang'];
        $tipe = $_POST['tipe'];
        $lot = $_POST['lot'];
        $berat = str_replace(',', '', $_POST['berat']);

        //Utk Batchno, CS,Lebar,Panjang, Berat
        for ($i = 0; $i < ($jum_tambahan); $i++) {

            if ($batch_no[$i] != '') {

                $bahan_tambahan = strtoupper($bahan_tambahan[$i]);
                $qty_tambahan = $qty[$i];
                $batch_no[$i] = strtoupper($batch_no[$i]);
                $mat[$i] = strtoupper($mat[$i]);
                $tipe[$i] = strtoupper($tipe[$i]);
                $berat[$i] = $berat[$i];
                $lot[$i] = $lot[$i];
                if ($berat[$i] == '' or intval($berat[$i]) == '0') {
                    $berat[$i] = hitung_berat($mat[$i]);
                }

                $sql_x = "INSERT INTO tr_pk_m_group_matcode_bahan 	(id_m_group,matcode,batch_no,qty,lebar,panjang,jb,cs,tipe,berat,lot,id_tr_pk)
		 VALUES ($id_m_group,'$mat[$i]','$batch_no[$i]','$qty[$i]','$lebar[$i]','$panjang[$i]','$jb[$i]','$cs[$i]','$tipe[$i]','$berat[$i]','$lot[$i]',$id_tr_pk)";
                //$a =  $a .'<br>'. $sql_x ;
                $query_data = mysql_query($sql_x) or die('ERROR insert data: ' . $sql_x);
            }
        }
        //die($a);
    }
    echo 'sukses';
}

function un_approve_order()
{
    $id_tr_order = $_REQUEST['id_tr_order'];
    $usernya = $_SESSION['userid'];
    //die($id_tr_order);
    $sql = "UPDATE tr_order 
				SET status = null,
				userid_modified = '$usernya' ,
				date_modified = now()  
				WHERE  id_tr_order = '$id_tr_order' ";
    //die($sql);
    $query = mysql_query($sql) or die('ERROR  : ' . $sql);
    echo 'sukses';
}

function save_add_batch_no_bahan_qc()
{
    $id_m_schedule_detail = $_REQUEST['id_m_schedule_detail'];
    $nilai = ($_REQUEST['nilai']);
    $batch_no = ($_REQUEST['batch_no']);
    $id_tr_order = ($_REQUEST['id_tr_order']);

    $usernya = $_SESSION['userid'];
    $sql = "SELECT * FROM tr_order_batch_no_qc WHERE batch_no = '$batch_no'  ";
//die($sql);

    $qry = mysql_query($sql) or die('ERROR select : ' . $sql);
    $jumlah_data = mysql_num_rows($qry);
    if ($jumlah_data > 0) {
        $sql = "UPDATE tr_order_batch_no_qc 
					SET 
					id_tr_order = '$id_tr_order',
					id_m_schedule_detail = '$id_m_schedule_detail',
					keterangan = '$nilai',
					userid_modified = '$usernya' ,
					date_modified = now()  
					WHERE batch_no = '$batch_no' ";
    } else {
        $sql = "INSERT INTO tr_order_batch_no_qc 
					(id_tr_order,id_m_schedule_detail,batch_no,keterangan,userid_created, date_created) 
		    VALUES ('$id_tr_order','$id_m_schedule_detail','$batch_no','$nilai','$usernya', now())";
    }

//die($sql);
    $query = mysql_query($sql) or die('ERROR  : ' . $sql);
    //die('aa'.$id_m_schedule_detail. ' - '.$nilai. ' - '.$batch_no);

    echo 'sukses';
}

function update_batch_no_bahan()
{
    $id_m_schedule_detail = $_REQUEST['id_m_schedule_detail'];
    $nilai = str_replace("'", "", substr($_REQUEST['nilai'], 0, 14));
    $nilai_jb = str_replace("'", "", substr($_REQUEST['nilai_jb'], 0, 10));
    $nilai_cs = str_replace("'", "", substr($_REQUEST['nilai_cs'], 0, 10));
    $usernya = $_SESSION['userid'];
    //die($id_tr_order);
    $sql = "UPDATE m_schedule_detail 
				SET 
				batch_no = '$nilai',
				jb = '$nilai_jb',
  				cs = '$nilai_cs',
				userid_modified = '$usernya' ,
				date_modified = now()  
				WHERE  id_m_schedule_detail = '$id_m_schedule_detail' ";
    //die($sql);
    $query = mysql_query($sql) or die('ERROR  : ' . $sql);
    echo 'sukses';
}

function delete_sisa_bahan()
{
    $txt_lemparan = $_REQUEST['txt_lemparan'];
    $arr_isi = explode("|", $txt_lemparan);
    $offset = trim($arr_isi[0]);
    $id_tr_order = trim($arr_isi[1]);
    $id_tr_sisa_bahan = trim($arr_isi[2]);

    $sql = "DELETE FROM tr_sisa_bahan WHERE  id_tr_sisa_bahan = '$id_tr_sisa_bahan' ";
//die($sql);
    $query = mysql_query($sql) or die('ERROR  : ' . $sql);

    /*$sql = "SELECT max(id_tr_produksi_detail) as id_tr_produksi_detail FROM tr_produksi_detail
		WHERE id_tr_order = '$id_tr_order' ";

		$qry = mysql_query($sql) or die('ERROR select : '.$sql);
		$jumlah_data = mysql_num_rows($qry);*/
    /*echo $sql .'<br>';
echo 'jumlah_data ='.$jumlah_data .'<br>';
die($jumlah_data);
*/
    /*	while ($row = mysql_fetch_array($qry))
				{
					$id_tr_produksi_detail = $row['id_tr_produksi_detail'];
				}*/

    $sql_del = " DELETE FROM m_seasoning_rack WHERE id_tr_sisa_bahan = '$id_tr_sisa_bahan' ";
    $qry_del = mysql_query($sql_del) or die('ERROR select : ' . $sql_del);

    $sql_del = " DELETE FROM m_wip WHERE id_tr_sisa_bahan = '$id_tr_sisa_bahan' ";
    $qry_del = mysql_query($sql_del) or die('ERROR select : ' . $sql_del);
    echo 'sukses';
}

function save_sisa_bahan()
{

    $pilihan = $_REQUEST['pilihan'];
    $usernya = $_SESSION['userid'];

    $id_tr_sisa_bahan = $_POST['id_tr_sisa_bahan'];
    $id_tr_order = $_POST['id_tr_order'];
    //$text_matcode = $_POST['text_matcode'];

    $text_matcode = strtoupper($_POST['text_matcode']);
    $text_berat = $_POST['text_berat'];
    $text_roll = $_POST['text_roll'];
    $batch_no_sisa = strtoupper($_POST['batch_no_sisa']);

    $sql = "SELECT max(id_tr_produksi_detail) as id_tr_produksi_detail FROM tr_produksi_detail 
		WHERE id_tr_order = '$id_tr_order' ";

    $sql = "SELECT max(id_tr_produksi_detail) as id_tr_produksi_detail, max(d.id_sliter) as id_sliter
FROM tr_produksi_detail a
INNER JOIN tr_order b ON a.id_tr_order = b.id_tr_order
INNER JOIN tr_bahan c ON b.id_tr_bahan = c.id_tr_bahan
INNER JOIN tr_pk d ON d.id_tr_pk = c.id_tr_pk
		WHERE a.id_tr_order = '$id_tr_order' ";

    $qry = mysql_query($sql) or die('ERROR select : ' . $sql);
    $jumlah_data = mysql_num_rows($qry);
    /*echo $sql .'<br>';
echo 'jumlah_data ='.$jumlah_data .'<br>';
die($jumlah_data);
*/
    while ($row = mysql_fetch_array($qry)) {
        $id_tr_produksi_detail = $row['id_tr_produksi_detail'];
        $id_sliter = $row['id_sliter'];
    }
    if ($id_tr_produksi_detail != '') {
        if ($pilihan == 'add') {
            $sql_exe =
                "INSERT INTO tr_sisa_bahan 
						( id_tr_order,matcode,roll, berat, batch_no_sisa,id_tr_produksi_detail,
						   userid_created,date_created)
						VALUES 
						('$id_tr_order','$text_matcode','$text_roll','$text_berat','$batch_no_sisa','$id_tr_produksi_detail',
						  '$usernya',now())";

            $query = mysql_query($sql_exe) or die('ERROR ' . $pilihan . ' : ' . $sql_exe);
            $sql_1 = "SELECT LAST_INSERT_ID()";
            $result = mysql_query($sql_1);
            while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
                $last_id = $row[0];
                $id_tr_sisa_bahan = $last_id;
            }

            $usernya = $_SESSION['userid'];
            $periode = date("mY");
            $lot_no = lot_no($id_tr_produksi_detail);
            $type_bahan = substr($text_matcode, 0, 7);
            $mikron = substr($text_matcode, 5, 2);
            $lebar = substr($text_matcode, 7, 4);
            $panjang = substr($text_matcode, 11, 5);

//die('xx'. $peroide);
            if ($id_sliter == 's') {
                $sql_inst =
                    "
					INSERT INTO m_seasoning_rack (id_tr_produksi_detail,periode,line,lot,matcode,type,mikron, 
					lebar, panjang, rolls,berat,berat_order,id_tr_sisa_bahan, 
					tgl_awal,jb,cs,batch_no, time_,rack, userid_created,date_created)
					
					SELECT '$id_tr_produksi_detail','$periode',id_m_line,'$lot_no','$text_matcode' as matcode,'$type_bahan','$mikron', 
					 '$lebar', '$panjang', '$text_roll' as rolls, NULL as berat, '$text_berat' as berat_order,'$id_tr_sisa_bahan',
					waktu_awal,'$no_jumbo','$no_cs','$batch_no_sisa', substring(waktu_awal,12,5) as time_ ,NULL as rack ,'$usernya',now()
					FROM tr_produksi_detail 
					WHERE id_tr_produksi_detail = '$id_tr_produksi_detail'
					";
            } elseif ($id_sliter == 'r') {
                $sql_inst =
                    "
					INSERT INTO m_wip (id_tr_produksi_detail,periode,line,lot,matcode,type,mikron, 
					lebar, panjang, rolls,berat,berat_order,id_tr_sisa_bahan, 
					tgl_awal,jb,cs,batch_no, time_,rack, userid_created,date_created)
					
					SELECT '$id_tr_produksi_detail','$periode',id_m_line,'$lot_no','$text_matcode' as matcode,'$type_bahan','$mikron', 
					 '$lebar', '$panjang', '$text_roll' as rolls, NULL as berat, '$text_berat' as berat_order,'$id_tr_sisa_bahan',
					waktu_awal,'$no_jumbo','$no_cs','$batch_no_sisa', substring(waktu_awal,12,5) as time_ ,NULL as rack ,'$usernya',now()
					FROM tr_produksi_detail 
					WHERE id_tr_produksi_detail = '$id_tr_produksi_detail'
					";
            }
            //echo $sql_inst .'<br>';
            //die();
            $qry = mysql_query($sql_inst) or die('ERROR : ' . $sql_inst);

        } elseif ($pilihan == 'edit') {
            $sql_exe = "UPDATE tr_sisa_bahan
								SET  matcode = '$text_matcode', 
									 roll = '$text_roll',
									 berat = '$text_berat', 
									 batch_no_sisa = '$batch_no_sisa',
									 id_tr_produksi_detail = '$id_tr_produksi_detail',
									 userid_modified = '$usernya',
									 date_modified  = now()
								WHERE id_tr_sisa_bahan = '$id_tr_sisa_bahan' ";
            $query = mysql_query($sql_exe) or die('ERROR ' . $pilihan . ' : ' . $sql_exe);

            if ($id_sliter == 's') {
                $sql_update =
                    "   UPDATE m_seasoning_rack
								SET  matcode = '$text_matcode', 
									 roll = '$text_roll',
									 berat_order = '$text_berat', 
									 batch_no = '$batch_no_sisa',
									 userid_modified = '$usernya',
									 date_modified  = now()
								WHERE id_tr_sisa_bahan = '$id_tr_sisa_bahan'";
            } elseif ($id_sliter == 'r') {
                $sql_update =
                    "   UPDATE m_wip
								SET  matcode = '$text_matcode', 
									 roll = '$text_roll',
									 berat_order = '$text_berat', 
									 batch_no = '$batch_no_sisa',
									 userid_modified = '$usernya',
									 date_modified  = now()
								WHERE id_tr_sisa_bahan = '$id_tr_sisa_bahan'";
            }
        }
        //echo $sql_exe;
        //die();


        echo 'sukses';
    } else {
        echo 'transaksi_belum_diinput';
    }
}

function save_group_mesin()
{

    $usernya = $_SESSION['userid'];
    $id_tr_order = $_POST['id_tr_order'];
    $id_m_line = $_POST['cbo_group_mesin'];
//die('xxx'. $cbo_group_mesin);

    {
        $sql_exe = "UPDATE tr_order
					SET  id_m_line = '$id_m_line', 
						 userid_modified = '$usernya',
						 date_modified  = now()
					WHERE id_tr_order = '$id_tr_order' ";
    }
//echo $sql_exe;
//die();
    $query = mysql_query($sql_exe) or die('ERROR ' . $pilihan . ' : ' . $sql_exe);
    echo 'sukses';

}

function approve_order()
{
    $id_tr_order = $_REQUEST['id_tr_order'];
    $usernya = $_SESSION['userid'];
    //die($id_tr_order);
    $sql = "UPDATE tr_order 
				SET status = 't',
				userid_approved = '$usernya' ,
				date_approved = now()  
				WHERE  id_tr_order = '$id_tr_order' ";
    //die($sql);
    $query = mysql_query($sql) or die('ERROR  : ' . $sql);

    $periode = date('mY');

    /* INSERT INTO m_finish_good dilakukan saat Transfer Slip
$sql = "

INSERT INTO m_finish_good
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
	WHERE b.id_tr_order = '$id_tr_order' AND b.id_m_grade in  ('1','2')
";
$query = mysql_query($sql) or die('ERROR  : '.$sql); */

    /* INSERT INTO m_wip , hanya utk Grade I,R dilakukan saat input CW
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
	WHERE b.id_tr_order = '$id_tr_order' AND b.id_m_grade in  ('3','4','5')
";
$query = mysql_query($sql) or die('ERROR  : '.$sql); */
    echo 'sukses';
}

function delete_batch_no()
{
//txt_lemparan = offset+'|'+id_tr_order+'|'+grade+'|'+id_tr_produksi_detail_batch_no;
    $lemparan_batch_no = $_REQUEST['lemparan_batch_no'];
    //echo $lemparan_batch_no;
//die();
    $arr_isi = explode("|", $lemparan_batch_no);
    $offset = trim($arr_isi[0]);
    $id_tr_order = trim($arr_isi[1]);
    $grade = trim($arr_isi[2]);
    $id_tr_produksi_detail_batch_no = trim($arr_isi[3]);
    $sql = "DELETE FROM tr_produksi_detail_batch_no WHERE  id_tr_produksi_detail_batch_no = '$id_tr_produksi_detail_batch_no' ";
//die($sql);
    $query = mysql_query($sql) or die('ERROR  : ' . $sql);
    echo 'sukses';
    /*echo $id_tr_produksi_detail .'<br>';
		echo $id_tr_produksi_detail_batch_no;
die();*/
}

function save_batch_no()
{

    $pilihan = $_REQUEST['pilihan'];
    //echo('xx' . $pilihan);
    $usernya = $_SESSION['userid'];

    $id_tr_produksi_detail = $_POST['cbo_prod_detil'];
    $id_tr_order = $_POST['id_tr_order'];
    $id_tr_produksi_detail_batch_no = $_POST['id_tr_produksi_detail_batch_no'];
    $id_m_grade = $_POST['grade'];
    $id_m_paper_core = $_POST['cbo_paper_core'];


    $sql_cek = "		
SELECT a.qty,
(SELECT count(*) FROM tr_produksi_detail_batch_no 
 WHERE id_tr_produksi_detail = a.id_tr_produksi_detail) as jum_batch_no
 FROM tr_produksi_detail a 
 WHERE id_tr_produksi_detail = '$id_tr_produksi_detail' ";
    $qry_cek = mysql_query($sql_cek) or die('ERROR select : ' . $sql_cek);
    while ($row = mysql_fetch_array($qry_cek)) {
        $qty = $row['qty'];
        $jum_batch_no = intval($row['jum_batch_no']);
        $selisih = $qty - $jum_batch_no;
    }
//echo $selisih .'<br>';

    $text_batch_no = strtoupper($_POST['text_batch_no']);
    $text_berat = $_POST['text_berat'];
    $ket = $_POST['ket'];
    $text_from = $_POST['text_from'];
    $text_to = $_POST['text_to'];

    $jumlah = intval($text_to) - intval($text_from) + 1;
//die($jumlah . ' = ' .$text_to . ' '.$text_from);

//die($jumlah . ' = ' .$text_to . ' '.$text_from);
    if ($pilihan == 'add') {
        if ($selisih >= $jumlah) {

            for ($i = $text_from; $i <= $text_to; $i++) {

                $data_batch_no = $text_batch_no . str_pad($i, 2, "0", STR_PAD_LEFT);
                $sql_cek = "SELECT batch_no FROM tr_produksi_detail_batch_no WHERE batch_no = '$data_batch_no' ";

                $qry_cek = mysql_query($sql_cek) or die('ERROR select : ' . $sql_cek);
                $jumlah_data = mysql_num_rows($qry_cek);
                if ($jumlah_data == 0) {
                    $sql_exe =
                        "INSERT INTO tr_produksi_detail_batch_no 
								( id_tr_order,id_tr_produksi_detail,id_m_paper_core,batch_no, berat, userid_created,date_created)
								VALUES 
								('$id_tr_order','$id_tr_produksi_detail','$id_m_paper_core','$data_batch_no','$text_berat', '$usernya',now())";
                    //	$a .= $sql_exe;
                    //	die($a);
                    $query = mysql_query($sql_exe) or die('ERROR ' . $pilihan . ' : ' . $sql_exe);
                }
            }
            echo 'sukses';

        } else {
            $x = $jumlah - $selisih;
            echo 'Gagal, kelebihan = ' . $x;
        }

    } elseif ($pilihan == 'edit') {
        $sql_exe = "UPDATE tr_produksi_detail_batch_no
					SET  batch_no = '$text_batch_no', 
						 id_tr_produksi_detail = '$id_tr_produksi_detail',
  					     berat = '$text_berat', 
						 id_m_paper_core =  '$id_m_paper_core',
						 userid_modified = '$usernya',
						 date_modified  = now()
					WHERE id_tr_produksi_detail_batch_no = '$id_tr_produksi_detail_batch_no' ";
        //echo $sql_exe;
        //die();
        $query = mysql_query($sql_exe) or die('ERROR ' . $pilihan . ' : ' . $sql_exe);


        echo 'sukses';
    } elseif ($pilihan == 'edit_all') {
        //$txt_id_tr_order= $_POST['txt_id_tr_order'];
        $id_tr_produksi_detail_batch_no_all = $_POST['id_tr_produksi_detail_batch_no_all'];
        $nilai = $_POST['nilai'];
        $berat_x = $_POST['berat_x'];
        $batch_no_1 = $_POST['batch_no_1'];
        $id_m_paper_core = $_POST['cbo_paper_core'];
        $z = count($berat_x);

//echo 'ddd'.($txt_id_tr_order);
//echo 'z='.$z;
//die($berat_x[1]);

        for ($i = 0; $i < $z; $i++) {
            {
                $batch_no[$i] = $batch_no_1[$i] . $nilai[$i];
                $sql_update = " 
					UPDATE tr_produksi_detail_batch_no 
					SET batch_no = '$batch_no[$i]' ,
 						 berat = '$berat_x[$i]', 
						 id_m_paper_core = '$id_m_paper_core',
						 userid_modified = '$usernya',
						 date_modified  = now() 
					WHERE  id_tr_produksi_detail_batch_no =  '$id_tr_produksi_detail_batch_no_all[$i]' ";

//$a =$a. $sql_update  .'<br>';
//die($sql_update);
                $query_ = mysql_query($sql_update) or die('ADA BATCH_NO DOUBLE ! ,ERROR UPDATE data: ' . $sql_update);
            }

        }
        /*echo $a;
die();
*/


        echo 'sukses';
    }
}

function delete_all_batch_no()
{
    $id_tr_order = $_POST['id_tr_order'];
    $id_tr_produksi_detail = $_POST['cbo_prod_detil'];
    $id_m_grade = $_POST['id_m_grade'];
//echo 'cc'. $id_tr_order . 'vv'. $id_m_grade. 'vv'.$id_tr_produksi_detail ;
    $sql = " DELETE FROM tr_produksi_detail_batch_no WHERE id_tr_order = '$id_tr_order' and id_tr_produksi_detail = '$id_tr_produksi_detail' ";
    $qry_order = mysql_query($sql) or die('ERROR DELETE : ' . $sql);
    echo 'sukses';
    //die();
}

function form_add_group_mesin()
{
    $lemparan_group_mesin = $_REQUEST['lemparan_group_mesin'];
//echo($lemparan_group_mesin);
    $arr_isi = explode("|", $lemparan_group_mesin);
    $offset = trim($arr_isi[0]);
    $id_tr_order = trim($arr_isi[1]);

    $sql_group_mesin = "SELECT a.id_m_line, a.nama_line,b.nama_group_line FROM m_line a 
					LEFT JOIN m_group_line b on a.id_m_group_line = b.id_m_group_line 
					WHERE a.status = 't'
					ORDER BY a.id_m_group_line,a.nama_line ,b.nama_group_line  ";
    $qry_group_mesin = mysql_query($sql_group_mesin) or die('ERROR select : ' . $sql_group_mesin);

    $sql_order = "	SELECT a.id_m_group_line, a.order_no, a.id_m_line, b.nama_group_line,  a.status as status_order
		      	FROM tr_order a
				LEFT OUTER JOIN m_group_line b on a.id_m_group_line = b.id_m_group_line 
				WHERE id_tr_order = '$id_tr_order' ";

    $qry_order = mysql_query($sql_order) or die('ERROR select : ' . $sql_order);

    while ($row = mysql_fetch_array($qry_order)) {
        $id_m_line = $row['id_m_line'];
        $order_no = $row['order_no'];
        $status_order = $row['status_order'];
        if ((isset($id_m_group_line) ? $id_m_group_line : '') == '') {
            $action = 'add';
        } else {
            $action = 'edit';
        }
        $lemparan = $id_tr_order;
    }
    ?>
    <form name="form_add_group_mesin" id="form_add_group_mesin" class="">
        <table width="320" align="center" class="body">
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td colspan="2"></td>
                            <td width="1%"></td>
                            <td></td>
                            <td width="4%"></td>
                            <td width="45%"></td>
                            <td width="18%" colspan="3"></td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td></td>
                            <td></td>
                            <td colspan="4">

                                <input type="hidden" name="id_tr_order" id="id_tr_order" value="<?= $id_tr_order ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                            <td>Order No</td>
                            <td align="center">:</td>
                            <td colspan="4"><strong><?php echo $order_no ?></strong></td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                            <td>&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <td colspan="4">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                            <td class="warning">Group - Mesin</td>
                            <td align="center">:</td>
                            <td colspan="4"><select name="cbo_group_mesin" id="cbo_group_mesin" class="combobox"
                                                    onchange="">
                                    <option value="0" selected="selected">- Pilih -</option>
                                    <?php while ($row_group_mesin = mysql_fetch_assoc($qry_group_mesin)) { ?>
                                        <option value="<?= $row_group_mesin["id_m_line"] ?>"
                                            <?php
                                            if ($row_group_mesin["id_m_line"] == $id_m_line) {
                                                echo 'selected';
                                            }
                                            ?>
                                        >
                                            <?= $row_group_mesin["nama_group_line"] . ' - ' . $row_group_mesin["nama_line"] ?>
                                        </option>
                                    <?php }
                                    ?>
                                </select></td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                            <td width="30%" height="3" align="left" valign="middle" class="warning">&nbsp;</td>
                            <td height="3" align="center" valign="middle">&nbsp;</td>
                            <td height="3" colspan="4" valign="bottom">&nbsp;</td>

                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td width="30%" height="3" align="left" valign="middle" class="warning"></td>
                            <td height="3" align="center" valign="middle"></td>
                            <td height="3" colspan="4" valign="bottom"></td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                            <td width="30%" align="left" valign="middle">&nbsp;</td>
                            <td align="center" valign="middle">&nbsp;</td>
                            <td colspan="4">&nbsp;</td>
                        </tr>

                        <tr>
                            <td width="1%"></td>
                            <td width="1%"></td>
                            <td></td>
                            <td width="30%"></td>
                            <td width="4%"></td>
                            <td width="45%"></td>
                        </tr>
                        <tr>
                            <td height="4" colspan="9" align="center"></td>
                        </tr>
                        <tr>

                            <td colspan="9" align="center">
                                <?php if ($action == 'add' and $status_order == '') {
                                    ?>
                                    <input type="button" name="button_save" id="button_save" class="button" value="SAVE"
                                           onclick="save_group_mesin_conf(<?= "'" . $lemparan . "'" ?>)"/>

                                <?php }
                                if ($action == 'edit' and $status_order == '') {

                                    ?>
                                    <input type="button" name="button_save2" id="button_save2" class="button"
                                           value="UPDATE"
                                           onclick="save_group_mesin_conf(<?= "'" . $lemparan . "'" ?>)"/>

                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="9" align="center">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="9" align="center"></td>
                        </tr>
                        <tr>
                    </table>
                </td>
            </tr>
        </table>

    </form>
<?php }


function form_add_sisa_bahan_2()
{

    $lemparan_sisa_bahan = $_REQUEST['lemparan_sisa_bahan'];
    //	echo $lemparan_sisa_bahan;
    $arr_isi = explode("|", $lemparan_sisa_bahan);
    $offset = trim($arr_isi[0]);
    $id_tr_order = trim($arr_isi[1]);
    $id_tr_sisa_bahan = trim($arr_isi[2]);
    //$id_tr_produksi_detail_batch_no = trim($arr_isi[3]);

    $sql_akses = "SELECT a.status as status_order, order_no,c.matcode as matcode_bahan 
			  FROM tr_order a
			  LEFT JOIN tr_bahan b on a.id_tr_bahan = b.id_tr_bahan 
			  LEFT JOIN tr_pk c on b.id_tr_pk = c.id_tr_pk
		      WHERE id_tr_order = '$id_tr_order' ";
    $qry_akses = mysql_query($sql_akses) or die('ERROR select : ' . $sql_akses);
    while ($row_akses = mysql_fetch_array($qry_akses)) {
        $status_order = trim($row_akses['status_order']);
        $order_no = $row_akses['order_no'];
        $matcode_bahan = $row_akses['matcode_bahan'];

    }


    $sql_select = " SELECT a.id_tr_sisa_bahan,a.matcode, a.id_tr_order, b.order_no
				FROM tr_sisa_bahan a
				LEFT JOIN tr_order b on a.id_tr_order = b.id_tr_order 
				WHERE a.id_tr_order = '$id_tr_order'   ORDER BY id_tr_sisa_bahan";

    $qry = mysql_query($sql_select) or die('ERROR select : ' . $sql_select);
    // echo $sql_select;


    $sql_prod_detil = "SELECT a.*,a.id_tr_sisa_bahan 
				   FROM tr_sisa_bahan a 
				   WHERE a.id_tr_order = '$id_tr_order'  ORDER BY id_tr_sisa_bahan
					";

    $qry_prod_detil = mysql_query($sql_prod_detil) or die('ERROR select : ' . $sql_prod_detil);

    while ($row = mysql_fetch_array($qry)) {
        $x = $row['x'];
        //$order_no = $row['order_no'];
        //$id_tr_order = $row['id_tr_order'];
    }

    if ($id_tr_sisa_bahan != '') {

        $action = 'edit';
        $sql_ = "SELECT * FROM tr_sisa_bahan 
					 WHERE id_tr_sisa_bahan = '$id_tr_sisa_bahan'  ORDER BY id_tr_sisa_bahan";
        $qry_ = mysql_query($sql_) or die('ERROR select : ' . $sql_);
        while ($row_ = mysql_fetch_array($qry_)) {
            $id_tr_sisa_bahan = $row_['id_tr_sisa_bahan'];
            $matcode = $row_['matcode'];
            $berat = $row_['berat'];
            $roll = $row_['roll'];
            $id_tr_order = $row_['id_tr_order'];
            $batch_no_sisa = $row_['batch_no_sisa'];
        }

    } else {
        $action = 'add';
    }
    $lemparan = $action . '|' . $id_tr_order . '|' . $id_tr_sisa_bahan;
//echo('lemparan '.$lemparan)
    ?>
    <form name="form_add_sisa_bahan" id="form_add_sisa_bahan" class="">
        <table width="420" align="center" class="body">
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td colspan="2"></td>
                            <td width="1%"></td>
                            <td></td>
                            <td width="5%"></td>
                            <td width="37%"></td>
                            <td width="24%" colspan="3"></td>
                        </tr>
                        <tr>
                            <td colspan="3" rowspan="2">&nbsp;</td>
                            <td colspan="6" align="center">
                                <input type="hidden" name="id_tr_sisa_bahan" id="id_tr_sisa_bahan"
                                       value="<?= $id_tr_sisa_bahan ?>"/>
                                <input type="hidden" name="id_tr_order" id="id_tr_order" value="<?= $id_tr_order ?>"/>

                                <strong> SISA BAHAN 2 </strong></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td></td>
                            <td colspan="4">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3" rowspan="4">&nbsp;</td>
                            <td>Order No</td>
                            <td align="center">:</td>
                            <td colspan="4"><strong><?php echo $order_no ?></strong></td>
                        </tr>
                        <tr>
                            <td>Type Bahan RPS</td>
                            <td align="center">:</td>
                            <td colspan="4"><strong><?php echo $matcode_bahan ?></strong></td>
                        </tr>
                        <tr>
                            <td>Tgl - Shift</td>
                            <td align="center">:</td>
                            <td colspan="4">
                                <?php
                                $sql_prod_detil = "

		SELECT substr(waktu_awal,1,10) as waktu_awal,max(a.id_tr_produksi_detail) as id_tr_produksi_detail, 
				b.nama_shift, c.nama_group_shift 
		FROM tr_produksi_detail a 
		LEFT JOIN m_shift b on a.id_m_shift = b.id_m_shift	
		LEFT JOIN m_group_shift c on a.id_m_group_shift = c.id_m_group_shift	
		WHERE a.id_tr_order = '$id_tr_order'
		GROUP BY substr(waktu_awal,1,10), 
				b.nama_shift, c.nama_group_shift
					";
                                echo $sql_prod_detil;
                                $qry_prod_detil = mysql_query($sql_prod_detil) or die('ERROR select : ' . $sql_prod_detil);
                                ?>
                                <select name="cbo_prod_detil" id="cbo_prod_detil" class="combobox"
                                        onchange="show_partai()">

                                    <?php while ($row_prod_detil = mysql_fetch_assoc($qry_prod_detil)) {

                                        $tgl = convDate(($row_prod_detil["waktu_awal"]), '-', '1');
                                        $shift = $row_prod_detil["nama_shift"] . '' . $row_prod_detil["nama_group_shift"];
                                        $id_m_shift = $row_prod_detil["id_m_shift"];
                                        $id_tr_produksi_detail = $row_prod_detil["id_tr_produksi_detail"];
//$value_combo =$row_prod_detil["waktu_awal"] ."xx". $id_m_shift ."xx". $row_prod_detil["id_m_group_shift"] ;
                                        $value_combo = $id_tr_produksi_detail;
                                        ?>
                                        <option value="<?= $value_combo ?>"
                                            <?php
                                            if ($row_prod_detil["id_tr_produksi_detail"] == $value_combo) {
                                                echo 'selected';
                                            }
                                            ?>
                                        >

                                            <?= $tgl . ", Shift:  " . $shift; ?>
                                        </option>
                                    <?php }
                                    ?>
                                </select></td>
                        </tr>
                        <tr>
                            <td>Material Bahan Asal</td>
                            <td align="center">:</td>
                            <td colspan="4">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td></td>
                            <td align="center"></td>
                            <td colspan="4"></td>
                        </tr>
                        <tr>
                            <td colspan="3" rowspan="2">&nbsp;</td>
                            <td class="warning">Material Code *)</td>
                            <td align="center">:</td>
                            <td colspan="4"><input style="text-transform: uppercase" name="text_matcode" type="text"
                                                   class="textbox_3" id="text_matcode" maxlength="20"
                                                   value="<?php echo $matcode ?>" onkeyup=""/>
                            </td>
                        </tr>
                        <tr>
                            <td class="">Batch No</td>
                            <td align="center">&nbsp;</td>
                            <td colspan="4"><input style="text-transform: uppercase" name="batch_no_sisa" type="text"
                                                   class="textbox_3" id="batch_no_sisa" maxlength="20"
                                                   value="<?php echo $batch_no_sisa ?>" onkeyup=""/></td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                            <td width="30%" height="3" align="left" valign="middle" class="">Roll</td>
                            <td height="3" align="center" valign="middle">:</td>
                            <td height="3" colspan="4" valign="bottom"><input style="text-transform: uppercase"
                                                                              name="text_roll" type="text"
                                                                              class="textbox_angka_2" id="text_roll"
                                                                              maxlength="15" value="<?php echo $roll ?>"
                                                                              onkeyup="checkDec(this)"/></td>

                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                            <td width="30%" height="3" align="left" valign="middle" class="warning">Berat *)</td>
                            <td height="3" align="center" valign="middle">:</td>
                            <td height="3" colspan="4" valign="bottom"><input name="text_berat" type="text"
                                                                              class="textbox_angka_2" id="text_berat"
                                                                              maxlength="10"
                                                                              value="<?php echo $berat ?>"
                                                                              onkeyup="checkDec(this)"/>
                                Kg
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                            <td width="30%" align="left" valign="middle">&nbsp;</td>
                            <td align="center" valign="middle">&nbsp;</td>
                            <td colspan="4">&nbsp;</td>
                        </tr>

                        <tr>
                            <td width="1%"></td>
                            <td width="2%"></td>
                            <td></td>
                            <td width="30%"></td>
                            <td width="5%"></td>
                            <td width="37%"></td>
                        </tr>
                        <tr>
                            <td height="4" colspan="9" align="center"></td>
                        </tr>
                        <tr>

                            <td colspan="9" align="center">
                                <?php if ($action == 'add' and $status_order == '') {
                                    ?>
                                    <input type="button" name="button_save" id="button_save" class="button" value="SAVE"
                                           onclick="save_sisa_bahan_conf(<?= "'" . $lemparan . "'" ?>)"/>

                                <?php }
                                if ($action == 'edit' and $status_order == '') {
                                    // echo 'fff = ' .$lemparan_detail;
//$lemparan = "'".$lemparan."'";
                                    ?>
                                    <input type="button" name="button_save2" id="button_save2" class="button"
                                           value="UPDATE" onclick="save_sisa_bahan_conf(<?= "'" . $lemparan . "'" ?>)"/>

                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="9" align="center">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="9" align="center"></td>
                        </tr>
                        <tr>

                            <?php
                            $sql = "SELECT * FROM tr_sisa_bahan WHERE id_tr_order = '$id_tr_order'  ORDER BY id_tr_sisa_bahan";

                            $qry_2 = mysql_query($sql) or die('ERROR select : ' . $sql);
                            // echo $sql;

                            ?>
                            <td colspan="9" align="center">
                                <table width="100%" border="1">
                                    <tr class="table_header">
                                        <td width="9%">No</td>
                                        <td width="12%"><span class="">Material Code</span></td>
                                        <td width="12%">Batch No</td>
                                        <td width="20%"><span class="">Roll</span></td>
                                        <td width="13%"> Berat (Kg)<br/></td>

                                        <td width="10%">ACT</td>
                                    </tr>

                                    <?php
                                    while ($row_2 = mysql_fetch_array($qry_2)) {
                                        $i++;
                                        $matcode = $row_2['matcode'];
                                        $berat = $row_2['berat'];
                                        $roll = $row_2['roll'];
                                        $id_tr_sisa_bahan = $row_2['id_tr_sisa_bahan'];
                                        $batch_no_sisa = $row_2['batch_no_sisa'];

                                        //	$lemparan_detail = "'".$offset.'|'.$id_tr_produksi_detail.'|'.$id_tr_produksi_detail_batch_no."'";
                                        $lemparan_detail = "'" . $offset . '|' . $id_tr_order . '|' . $id_tr_sisa_bahan . "'";
//echo $lemparan_detail;
                                        if ($i % 2 == 0) {
                                            $cls = 'table_row_odd';
                                        } else {
                                            $cls = 'table_row_even';
                                        }

                                        ?>
                                        <tr class="<?= $cls ?>">
                                            <td width="4%" align="center"><?php echo $i ?> </td>
                                            <td width="12%" align="center"><?php echo $matcode ?></td>
                                            <td width="20%" align="center"><?php echo $batch_no_sisa ?></td>
                                            <td width="10%" align="center"><?php echo $roll ?></td>
                                            <td width="10%" align="center"><?php echo($berat) ?></td>

                                            <td width="10%" align="center">
                                                <?php if ($status_order != 't') { ?>
                                                    <a onClick="add_sisa_bahan(<?= $lemparan_detail ?>)"><img
                                                                src="../images/icons/edit_data.png"
                                                                border="0"/></a>&nbsp;<a
                                                            onClick="delete_sisa_bahan_conf(<?= $lemparan_detail ?>)"><img
                                                                src="../images/icons/del_data.png" border="0"/></a>
                                                <?php } ?>
                                            </td>
                                        </tr>

                                    <?php }
                                    ?>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="9" align="center">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="9" align="center">&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <p>&nbsp;</p>
    </form>
<?php }


function form_add_sisa_bahan()
{

    $lemparan_sisa_bahan = $_REQUEST['lemparan_sisa_bahan'];
    //	echo $lemparan_sisa_bahan;
    $arr_isi = explode("|", $lemparan_sisa_bahan);
    $offset = trim($arr_isi[0]);
    $id_tr_order = trim($arr_isi[1]);
    $id_tr_sisa_bahan = trim(isset($arr_isi[2]) ? $arr_isi[2] : '');
    //$id_tr_produksi_detail_batch_no = trim($arr_isi[3]);

    $sql_akses = "SELECT a.status as status_order, order_no,c.matcode as matcode_bahan 
			  FROM tr_order a
			  LEFT JOIN tr_bahan b on a.id_tr_bahan = b.id_tr_bahan 
			  LEFT JOIN tr_pk c on b.id_tr_pk = c.id_tr_pk
		      WHERE id_tr_order = '$id_tr_order' ";
    $qry_akses = mysql_query($sql_akses) or die('ERROR select : ' . $sql_akses);
    while ($row_akses = mysql_fetch_array($qry_akses)) {
        $status_order = trim($row_akses['status_order']);
        $order_no = $row_akses['order_no'];
        $matcode_bahan = $row_akses['matcode_bahan'];

    }


    $sql_select = " SELECT a.id_tr_sisa_bahan,a.matcode, a.id_tr_order, b.order_no
				FROM tr_sisa_bahan a
				LEFT JOIN tr_order b on a.id_tr_order = b.id_tr_order 
				WHERE a.id_tr_order = '$id_tr_order'   ORDER BY id_tr_sisa_bahan";

    $qry = mysql_query($sql_select) or die('ERROR select : ' . $sql_select);
    // echo $sql_select;


    $sql_prod_detil = "SELECT a.*,a.id_tr_sisa_bahan 
				   FROM tr_sisa_bahan a 
				   WHERE a.id_tr_order = '$id_tr_order'  ORDER BY id_tr_sisa_bahan
					";

    $qry_prod_detil = mysql_query($sql_prod_detil) or die('ERROR select : ' . $sql_prod_detil);

    while ($row = mysql_fetch_array($qry)) {
        $x = $row['x'];
        //$order_no = $row['order_no'];
        //$id_tr_order = $row['id_tr_order'];
    }

    if ($id_tr_sisa_bahan != '') {

        $action = 'edit';
        $sql_ = "SELECT * FROM tr_sisa_bahan 
					 WHERE id_tr_sisa_bahan = '$id_tr_sisa_bahan'  ORDER BY id_tr_sisa_bahan";
        $qry_ = mysql_query($sql_) or die('ERROR select : ' . $sql_);
        while ($row_ = mysql_fetch_array($qry_)) {
            $id_tr_sisa_bahan = $row_['id_tr_sisa_bahan'];
            $matcode = $row_['matcode'];
            $berat = $row_['berat'];
            $roll = $row_['roll'];
            $id_tr_order = $row_['id_tr_order'];
            $batch_no_sisa = $row_['batch_no_sisa'];
        }

    } else {
        $action = 'add';
        $roll = '1';
    }
    $lemparan = $action . '|' . $id_tr_order . '|' . $id_tr_sisa_bahan;
//echo('lemparan '.$lemparan)
    ?>
    <form name="form_add_sisa_bahan" id="form_add_sisa_bahan" class="">
        <table width="420" align="center" class="body">
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td colspan="2"></td>
                            <td width="1%"></td>
                            <td></td>
                            <td width="5%"></td>
                            <td width="37%"></td>
                            <td width="24%" colspan="3"></td>
                        </tr>
                        <tr>
                            <td colspan="3" rowspan="2">&nbsp;</td>
                            <td colspan="6" align="center">
                                <input type="hidden" name="id_tr_sisa_bahan" id="id_tr_sisa_bahan"
                                       value="<?= $id_tr_sisa_bahan ?>"/>
                                <input type="hidden" name="id_tr_order" id="id_tr_order" value="<?= $id_tr_order ?>"/>

                                <strong> SISA BAHAN </strong></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td></td>
                            <td colspan="4">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3" rowspan="2">&nbsp;</td>
                            <td>Order No</td>
                            <td align="center">:</td>
                            <td colspan="4"><strong><?php echo $order_no ?></strong></td>
                        </tr>
                        <tr>
                            <td>Type Bahan RPS</td>
                            <td align="center">:</td>
                            <td colspan="4"><strong><?php echo $matcode_bahan ?></strong></td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td></td>
                            <td align="center"></td>
                            <td colspan="4"></td>
                        </tr>
                        <tr>
                            <td colspan="3" rowspan="2">&nbsp;</td>
                            <td class="warning">Material Code *)</td>
                            <td align="center">:</td>
                            <td colspan="4"><input style="text-transform: uppercase" name="text_matcode" type="text"
                                                   class="textbox_3" id="text_matcode" maxlength="20"
                                                   value="<?php echo isset($matcode) ? $matcode : '' ?>" onkeyup=""/>
                            </td>
                        </tr>
                        <tr>
                            <td class="">Batch No</td>
                            <td align="center">&nbsp;</td>
                            <td colspan="4"><input style="text-transform: uppercase" name="batch_no_sisa" type="text"
                                                   class="textbox_3" id="batch_no_sisa" maxlength="20"
                                                   value="<?php echo isset($batch_no_sisa) ? $batch_no_sisa : '' ?>"
                                                   onkeyup=""/></td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                            <td width="30%" height="3" align="left" valign="middle" class="">Roll</td>
                            <td height="3" align="center" valign="middle">:</td>
                            <td height="3" colspan="4" valign="bottom"><input style="text-transform: uppercase"
                                                                              name="text_roll" type="text"
                                                                              class="textbox_angka_2" id="text_roll"
                                                                              maxlength="15" value="<?php echo $roll ?>"
                                                                              onkeyup="checkDec(this)"/></td>

                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                            <td width="30%" height="3" align="left" valign="middle" class="warning">Berat *)</td>
                            <td height="3" align="center" valign="middle">:</td>
                            <td height="3" colspan="4" valign="bottom"><input name="text_berat" type="text"
                                                                              class="textbox_angka_2" id="text_berat"
                                                                              maxlength="10"
                                                                              value="<?php echo isset($berat) ? $berat : 0; ?>"
                                                                              onkeyup="checkDec(this)"/>
                                Kg
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                            <td width="30%" align="left" valign="middle">&nbsp;</td>
                            <td align="center" valign="middle">&nbsp;</td>
                            <td colspan="4">&nbsp;</td>
                        </tr>

                        <tr>
                            <td width="1%"></td>
                            <td width="2%"></td>
                            <td></td>
                            <td width="30%"></td>
                            <td width="5%"></td>
                            <td width="37%"></td>
                        </tr>
                        <tr>
                            <td height="4" colspan="9" align="center"></td>
                        </tr>
                        <tr>

                            <td colspan="9" align="center">
                                <?php if ($action == 'add' and $status_order == '') {
                                    ?>
                                    <input type="button" name="button_save" id="button_save" class="button" value="SAVE"
                                           onclick="save_sisa_bahan_conf(<?= "'" . $lemparan . "'" ?>)"/>

                                <?php }
                                if ($action == 'edit' and $status_order == '') {
                                    // echo 'fff = ' .$lemparan_detail;
//$lemparan = "'".$lemparan."'";
                                    ?>
                                    <input type="button" name="button_save2" id="button_save2" class="button"
                                           value="UPDATE" onclick="save_sisa_bahan_conf(<?= "'" . $lemparan . "'" ?>)"/>

                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="9" align="center">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="9" align="center"></td>
                        </tr>
                        <tr>

                            <?php
                            $sql = "SELECT * FROM tr_sisa_bahan WHERE id_tr_order = '$id_tr_order'  ORDER BY id_tr_sisa_bahan";

                            $qry_2 = mysql_query($sql) or die('ERROR select : ' . $sql);
                            // echo $sql;

                            ?>
                            <td colspan="9" align="center">
                                <table width="100%" border="1">
                                    <tr class="table_header">
                                        <td width="9%">No</td>
                                        <td width="12%"><span class="">Material Code</span></td>
                                        <td width="12%">Batch No</td>
                                        <td width="20%"><span class="">Roll</span></td>
                                        <td width="13%"> Berat (Kg)<br/></td>

                                        <td width="10%">ACT</td>
                                    </tr>

                                    <?php
                                    while ($row_2 = mysql_fetch_array($qry_2)) {
                                        $i++;
                                        $matcode = $row_2['matcode'];
                                        $berat = $row_2['berat'];
                                        $roll = $row_2['roll'];
                                        $id_tr_sisa_bahan = $row_2['id_tr_sisa_bahan'];
                                        $batch_no_sisa = $row_2['batch_no_sisa'];

                                        //	$lemparan_detail = "'".$offset.'|'.$id_tr_produksi_detail.'|'.$id_tr_produksi_detail_batch_no."'";
                                        $lemparan_detail = "'" . $offset . '|' . $id_tr_order . '|' . $id_tr_sisa_bahan . "'";
//echo $lemparan_detail;
                                        if ($i % 2 == 0) {
                                            $cls = 'table_row_odd';
                                        } else {
                                            $cls = 'table_row_even';
                                        }

                                        ?>
                                        <tr class="<?= $cls ?>">
                                            <td width="4%" align="center"><?php echo $i ?> </td>
                                            <td width="12%" align="center"><?php echo $matcode ?></td>
                                            <td width="20%" align="center"><?php echo $batch_no_sisa ?></td>
                                            <td width="10%" align="center"><?php echo $roll ?></td>
                                            <td width="10%" align="center"><?php echo($berat) ?></td>

                                            <td width="10%" align="center">
                                                <?php if ($status_order != 't') { ?>
                                                    <a onClick="add_sisa_bahan(<?= $lemparan_detail ?>)"><img
                                                                src="../images/icons/edit_data.png"
                                                                border="0"/></a>&nbsp;<a
                                                            onClick="delete_sisa_bahan_conf(<?= $lemparan_detail ?>)"><img
                                                                src="../images/icons/del_data.png" border="0"/></a>
                                                <?php } ?>
                                            </td>
                                        </tr>

                                    <?php }
                                    ?>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="9" align="center">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="9" align="center">&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <p>&nbsp;</p>
    </form>
<?php }

function form_add_material_bahan()
{

    $lemparan_material_bahan = $_REQUEST['lemparan_material_bahan'];
    //echo $lemparan_material_bahan;
    //$lemparan_material_bahan = "'".$offset.'|'.$id_tr_pk.'|'.$id_m_group."'";

    $arr_isi = explode("|", $lemparan_material_bahan);
    $offset = trim($arr_isi[0]);
    $id_tr_pk = trim($arr_isi[1]);
    $id_m_group = trim($arr_isi[2]);


    $sql = " SELECT a.id_tr_pk, b.no_rps,c.nama_group, a.id_m_group,count(*) 
		FROM tr_bahan a
		LEFT JOIN tr_pk b on a.id_tr_pk = b.id_tr_pk
		LEFT JOIN m_group c on a.id_m_group = c.id_m_group 
		WHERE a.id_tr_pk = '$id_tr_pk' and a.id_m_group = $id_m_group
		GROUP BY a.id_tr_pk, a.id_m_group
		order BY a.id_tr_pk, a.id_m_group
				 
			   ";

    $qry = mysql_query($sql) or die('ERROR select : ' . $sql);

    while ($row = mysql_fetch_array($qry)) {
        $no_rps = $row['no_rps'];
        $nama_group = $row['nama_group'];
    }


    $lemparan_material_bahan = $lemparan_material_bahan . '|' . $no_rps;
    $lemparan = $action . '|' . $id_tr_order . '|' . $grade;

    ?>
    <form name="form_add_material_bahan" id="form_add_material_bahan" class="">
        <table width="650" align="center" class="body">
            <tr>
                <td colspan="2">
                    <!--<table width="100%">-->
            <tr>
                <td colspan="2"></td>
                <td width="36%"></td>
                <td></td>
                <td width="36%"></td>
                <td width="36%"></td>
                <td width="36%" colspan="3"></td>
            </tr>
            <tr>
                <td colspan=""><strong></strong>

                    <input type="hidden" name="id_tr_pk" id="id_tr_pk" value="<?= $id_tr_pk ?>"/>
                    <input type="hidden" name="id_m_group" id="id_m_group" value="<?= $id_m_group ?>"/>
                    <input type="hidden" name="id_tr_order" id="id_tr_order" value="<?= $id_tr_order ?>"/>
                    <input type="hidden" name="id_m_grade" id="id_m_grade" value="<?= $id_m_grade ?>"/></td>
                <strong>MATERIAL BAHAN
                    <?php echo '<br><br>No RPS : ' ?> </strong>
                <strong><a target="_blank"
                           href="../template/index_form_perintah_kerja.php?id_tr_pk=<?php echo $id_tr_pk ?>">
                        <?= tampilan_no_rps($id_tr_pk) ?></a><?php echo ' ' . '<br> Partai : ' . $nama_group . '<br><br><br>' ?>
                </strong>

                <script>
                    //show_bahan();
                    show_tambahan_bahan('<?php $lemparan_material_bahan?>');
                </script>

            </tr>
            <tr>
                <div id="div_bahan"></div>
                <td colspan="7">
                    <div style="overflow:auto; width:750px; height:250px;" id="div_bahan_tambahan"></div>
                </td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td colspan="6"></td>
            </tr>
            <tr>
                <td colspan="9">
                    <table border="0" cellspacing="2" cellpadding="2" bgcolor="#FFFFFF" width="75%">
                        <tr class="table_header">
                            <td height="30" align="center" valign="middle">Total Berat (Kg)</td>
                            <td width="12%" align="center" valign="middle">

                                <?php echo number_format(total_berat_pk_m_group_matcode_bahan($id_tr_pk, $id_m_group), 2) ?></td>

                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="9" align="center">
                    <?php if ($status_order == '') {
                        ?>
                        <input type="button" name="button_save" id="button_save" class="button" value="SAVE"
                               onclick="cek_save_mat_bahan_awal(<?= "'" . $lemparan_material_bahan . "'" ?>)"/>

                    <?php }
                    ?></td>
            </tr>

            <tr>
                <td align="center">&nbsp;</td>
            </tr>


            <!--</table>-->
            </td>
            </tr>
        </table>

    </form>
<?php }

function form_add_batch_no_not()
{

    $lemparan_batch_no = $_REQUEST['lemparan_batch_no'];
    //echo $lemparan_batch_no;

//lemparan_batch_no_a = "'".$offset.'|'.$id_tr_order.'|'.'a'."'";
//$lemparan ="'".$id_tr_pk.'|'.$id_tr_order."'";

    $arr_isi = explode("|", $lemparan_batch_no);
    $offset = trim($arr_isi[0]);
    $id_tr_order = trim($arr_isi[1]);
    $grade = trim($arr_isi[2]);
    $id_tr_produksi_detail_batch_no = trim($arr_isi[3]);


    switch ($grade) {
        case "a":
            $id_m_grade = '1';
            break;
        case "b":
            $id_m_grade = '2';
            break;
        case "i":
            $id_m_grade = '3';
            break;
        case "r":
            $id_m_grade = '4';
            break;
        case "rc":
            $id_m_grade = '5';
            break;
        case "1":
            $id_m_grade = '1';
            break;
        case "2":
            $id_m_grade = '2';
            break;
        case "3":
            $id_m_grade = '3';
            break;
        case "4":
            $id_m_grade = '4';
            break;
        case "5":
            $id_m_grade = '5';
            break;
    }


    $sql_akses = "SELECT status as status_order FROM tr_order WHERE id_tr_order = '$id_tr_order' ";
    $qry_akses = mysql_query($sql_akses) or die('ERROR select : ' . $sql_akses);
    while ($row_akses = mysql_fetch_array($qry_akses)) {
        $status_order = trim($row_akses['status_order']);
    }

    //$id_tr_order = trim($arr_isi[1]);
    $sql_select = " SELECT a.id_tr_produksi_detail,a.matcode_bahan, a.id_tr_order,b.* 
				FROM tr_produksi_detail a
				LEFT JOIN tr_order b on a.id_tr_order = b.id_tr_order 
				WHERE a.id_tr_produksi_detail = '$id_tr_produksi_detail' ";

    $sql_select = " SELECT a.id_tr_produksi_detail,a.matcode_bahan, a.id_tr_order, b.order_no,a.matcode_hasil as hh
				FROM tr_produksi_detail a
				LEFT JOIN tr_order b on a.id_tr_order = b.id_tr_order 
				WHERE a.id_tr_order = '$id_tr_order' and id_m_grade = $id_m_grade ";

    $qry = mysql_query($sql_select) or die('ERROR select form_add_batch_no : ' . $sql_select);
    // echo $sql_select;


    $sql_prod_detil = "SELECT a.*,a.id_tr_produksi_detail, b.nama_shift, c.nama_group_shift,
					d.nama_line
				   FROM tr_produksi_detail a 
				   LEFT JOIN m_shift b on a.id_m_shift = b.id_m_shift	
				   LEFT JOIN m_group_shift c on a.id_m_group_shift = c.id_m_group_shift	
				   LEFT JOIN m_line d on a.id_m_line = d.id_m_line
				  WHERE a.id_tr_order = '$id_tr_order' and id_m_grade = $id_m_grade
					";
//echo $sql_prod_detil ;
    $qry_prod_detil = mysql_query($sql_prod_detil) or die('ERROR select : ' . $sql_prod_detil);

    while ($row = mysql_fetch_array($qry)) {
        $x = $row['x'];
        $order_no = $row['order_no'];
        $id_tr_order = $row['id_tr_order'];
        $matcode_hasil = $row['hh'];
        $berat = hitung_berat($matcode_hasil);


//$status_order = trim($row['status_order']);

    }

    if ($id_tr_produksi_detail_batch_no != '') {

        $action = 'edit';
        $sql_ = "SELECT * FROM tr_produksi_detail_batch_no 
					 WHERE id_tr_produksi_detail_batch_no = '$id_tr_produksi_detail_batch_no'";
        $qry_ = mysql_query($sql_) or die('ERROR select : ' . $sql_);
        while ($row_ = mysql_fetch_array($qry_)) {
            $id_tr_produksi_detail_batch_no = $row_['id_tr_produksi_detail_batch_no'];
            $batch_no = $row_['batch_no'];
            $berat = $row_['berat'];
            $id_tr_produksi_detail = $row_['id_tr_produksi_detail'];
//echo 'ddd'.$berat;
        }

    } else {
        $action = 'add';
    }
    $lemparan = $action . '|' . $id_tr_produksi_detail;
    $lemparan = $action . '|' . $id_tr_order . '|' . $grade;

    ?>
    <form name="form_add_batch_no__" id="form_add_batch_no__" class="">
        <table width="620" align="center" class="body">
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td colspan="2"></td>
                            <td width="1%"></td>
                            <td></td>
                            <td width="3%"></td>
                            <td width="35%"></td>
                            <td width="19%" colspan="3"></td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                            <td colspan="6" align="center"><strong>BATCH NO</strong>
                                <script>
                                    call_all_batch_no('0');
                                </script>
                                <input type="hidden" name="id_tr_produksi_detail_batch_no"
                                       id="id_tr_produksi_detail_batch_no"
                                       value="<?= $id_tr_produksi_detail_batch_no ?>"/>
                                <input type="hidden" name="id_tr_produksi_detail" id="id_tr_produksi_detail"
                                       value="<?= $id_tr_produksi_detail ?>"/>
                                <input type="hidden" name="id_tr_order" id="id_tr_order" value="<?= $id_tr_order ?>"/>
                                <input type="hidden" name="id_m_grade" id="id_m_grade" value="<?= $id_m_grade ?>"/></td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                            <td colspan="6" align="center">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                            <td>Order No x</td>
                            <td align="center">:</td>
                            <td colspan="4"><strong><?php echo $order_no ?></strong></td>
                        </tr>
                        <tr>
                            <td colspan="3" rowspan="2">&nbsp;</td>
                            <td>Grade</td>
                            <td align="center">:</td>
                            <td colspan="4"><strong><?php echo strtoupper($grade) ?></strong></td>
                        </tr>
                        <tr>
                            <td>Matcode</td>
                            <td align="center">:</td>
                            <td colspan="4"><strong><?php echo strtoupper($matcode_hasil) ?></strong></td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                            <td class="warning">Shift - Mesin -Qty *)</td>
                            <td align="center">:</td>
                            <td colspan="4"><select name="cbo_prod_detil" id="cbo_prod_detil" class="combobox"
                                                    onchange="call_all_batch_no()">
                                    <option value="0" selected="selected">- Pilih -</option>
                                    <?php while ($row_prod_detil = mysql_fetch_assoc($qry_prod_detil)) { ?>
                                        <option value="<?= $row_prod_detil["id_tr_produksi_detail"] ?>"
                                            <?php
                                            if ($row_prod_detil["id_tr_produksi_detail"] == $id_tr_produksi_detail) {
                                                echo 'selected';
                                            }

                                            ?>
                                        >
                                            <?php echo 'Shift : ' . $row_prod_detil["nama_shift"] . '' . $row_prod_detil["nama_group_shift"] . ' - Mesin : ' . $row_prod_detil["nama_line"] . ' - Qty : ' . $row_prod_detil["qty"] ?>
                                        </option>
                                    <?php }
                                    ?>
                                </select></td>
                        </tr>
                        <?php if ($action == 'edit') { ?>
                            <tr>
                                <td colspan="3">&nbsp;</td>
                                <td width="36%" height="0" align="left" valign="middle" class="warning">Batch *)<br/>No
                                    *)
                                </td>
                                <td height="0" align="center" valign="middle">:</td>
                                <td height="0" colspan="4" valign="bottom"><input style="text-transform: uppercase"
                                                                                  name="text_batch_no" type="text"
                                                                                  class="textbox_2" id="text_batch_no"
                                                                                  maxlength="15"
                                                                                  value="<?php echo $batch_no ?>"
                                                                                  onkeyup=""/>
                                </td>
                            </tr>
                        <?php } ?>

                        <?php if ($action == 'add') { ?>
                            <tr>
                                <td colspan="3">&nbsp;</td>
                                <td width="36%" height="1" align="left" valign="middle" class="warning">Batch *)<br/>No
                                    *)
                                </td>
                                <td height="1" align="center" valign="middle">:<br/>:</td>
                                <td height="1" colspan="4" valign="bottom">
                                    <div id="div_no"></div>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                            <td width="36%" height="3" align="left" valign="middle" class="">Berat Actual</td>
                            <td height="3" align="center" valign="middle">:</td>
                            <td height="3" colspan="4" valign="bottom"><input name="text_berat" type="text"
                                                                              class="textbox_angka_2" id="text_berat"
                                                                              maxlength="10"
                                                                              value="<?php echo $berat ?>"
                                                                              onkeyup="checkDec(this)"/>
                                Kg
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                            <td width="36%" align="left" valign="middle">&nbsp;</td>
                            <td align="center" valign="middle">&nbsp;</td>
                            <td colspan="4">&nbsp;</td>
                        </tr>

                        <tr>
                            <td width="3%"></td>
                            <td width="3%"></td>
                            <td></td>
                            <td width="36%"></td>
                            <td width="3%"></td>
                            <td width="35%"></td>
                        </tr>
                        <tr>
                            <td height="4" colspan="9" align="center"></td>
                        </tr>
                        <tr>

                            <td colspan="9" align="center">
                                <?php if ($action == 'add' and $status_order == '') {
                                    ?>
                                    <input type="button" name="button_save" id="button_save" class="button" value="SAVE"
                                           onclick="save_batch_no_conf(<?= "'" . $lemparan . "'" ?>)"/>

                                <?php }
                                if ($action == 'edit' and $status_order == '') {
                                    // echo 'fff = ' .$lemparan_detail;
//$lemparan = "'".$lemparan."'";
                                    ?>
                                    <input type="button" name="button_save2" id="button_save2" class="button"
                                           value="UPDATE" onclick="save_batch_no_conf(<?= "'" . $lemparan . "'" ?>)"/>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="button" name="button_save2" id="button_save2" class="button"
                                           value="CANCEL" onclick="add_batch_no(<?= "'" . $lemparan . "'" ?>)"/>

                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="9" align="center">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="9" align="center">
                                <!--<div id="div_tampil" style='overflow:auto; width:100px;height:100px;'>here is some text fgdfgdf gdgfd gdf gdfg dfg dfg dfg dfg dfg dfg fdg dfg df gddfgfd gdf gdf gdf gdfg dfg dfgdf gdfg df gdf gdfg fdg dfgfdg df gdfg df gdfgdfg dgdf gdfgdfgd fgdfg fdg df</div>
-->
                                <div id="div_tampil"></div>
                            </td>


                        </tr>
                        <tr>

                            <?php
                            $sql = "SELECT * FROM tr_produksi_detail_batch_no WHERE id_tr_produksi_detail = '$id_tr_produksi_detail'";
                            $sql = "SELECT da.* ,nama_shift,nama_group_shift,nama_line,qty,a.matcode_hasil
		FROM tr_produksi_detail_batch_no da
		LEFT JOIN tr_produksi_detail a on a.id_tr_produksi_detail = da.id_tr_produksi_detail
		LEFT JOIN m_shift b on a.id_m_shift = b.id_m_shift	
		LEFT JOIN m_group_shift c on a.id_m_group_shift = c.id_m_group_shift	
		LEFT JOIN m_line d on a.id_m_line = d.id_m_line
		WHERE da.id_tr_order = '$id_tr_order' and a.id_m_grade = $id_m_grade 
		ORDER BY da.id_tr_produksi_detail, da.id_tr_produksi_detail_batch_no ";
                            $qry_2 = mysql_query($sql) or die('ERROR select : ' . $sql);
                            // echo $sql;

                            ?>


                        </tr>

                        <tr>
                            <td colspan="9" align="center">&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <p>&nbsp;</p>
    </form>
<?php }

//xxxx

function form_add_batch_no()
{

    $lemparan_batch_no = $_REQUEST['lemparan_batch_no'];
    //	echo $lemparan_batch_no;

//lemparan_batch_no_a = "'".$offset.'|'.$id_tr_order.'|'.'a'."'";
//$lemparan ="'".$id_tr_pk.'|'.$id_tr_order."'";

    $arr_isi = explode("|", $lemparan_batch_no);
    $offset = trim($arr_isi[0]);
    $id_tr_order = trim($arr_isi[1]);
    $grade = trim($arr_isi[2]);
    $id_tr_produksi_detail_batch_no = trim((isset($arr_isi[3]) ? $arr_isi[3] : ''));
    $cbo_paper_core = trim((isset($arr_isi[4]) ? $arr_isi[4] : ''));

    /*echo  'id_tr_order = '. $id_tr_order .'<br>';
echo  'grade = ' .$grade .'<br>';
echo 'id_tr_produksi_detail_batch_no ' . $id_tr_produksi_detail_batch_no .'<br>';*/
//echo ('vvv'.$cbo_paper_core);


    switch ($grade) {
        case "a":
            $id_m_grade = '1';
            break;
        case "b":
            $id_m_grade = '2';
            break;
        case "i":
            $id_m_grade = '3';
            break;
        case "r":
            $id_m_grade = '4';
            break;
        case "rc":
            $id_m_grade = '5';
            break;
        case "1":
            $id_m_grade = '1';
            break;
        case "2":
            $id_m_grade = '2';
            break;
        case "3":
            $id_m_grade = '3';
            break;
        case "4":
            $id_m_grade = '4';
            break;
        case "5":
            $id_m_grade = '5';
            break;
    }


    $sql_akses = "SELECT status as status_order FROM tr_order WHERE id_tr_order = '$id_tr_order' ";
    $qry_akses = mysql_query($sql_akses) or die('ERROR select : ' . $sql_akses);
    while ($row_akses = mysql_fetch_array($qry_akses)) {
        $status_order = trim($row_akses['status_order']);
    }

    //$id_tr_order = trim($arr_isi[1]);

    $sql_paper_core_dari_detail_batchno = "SELECT id_m_paper_core
		FROM tr_produksi_detail_batch_no da
		LEFT JOIN tr_produksi_detail a on a.id_tr_produksi_detail = da.id_tr_produksi_detail
		WHERE da.id_tr_order = '$id_tr_order' and a.id_m_grade = $id_m_grade 
		ORDER BY da.id_tr_produksi_detail, da.id_tr_produksi_detail_batch_no limit 1";
    $qry_paper_core = mysql_query($sql_paper_core_dari_detail_batchno) or die('ERROR select : ' . $sql_paper_core_dari_detail_batchno);

    while ($row_paper_core = mysql_fetch_array($qry_paper_core)) {
        $id_m_paper_core_detail = $row_paper_core['id_m_paper_core'];
    }
//echo $id_m_paper_core_detail ;

    $sql_select =
        " 
			SELECT a.id_tr_produksi_detail,a.matcode_bahan, a.id_tr_order, b.order_no,
			a.matcode_hasil as hh, d.id_m_paper_core 
			FROM tr_produksi_detail a 
			LEFT JOIN tr_order b on a.id_tr_order = b.id_tr_order
			LEFT JOIN tr_bahan c on b.id_tr_bahan = c.id_tr_bahan 
			LEFT JOIN tr_pk d on c.id_tr_pk = d.id_tr_pk 
			WHERE a.id_tr_order = '$id_tr_order' and id_m_grade = $id_m_grade
			";

    $qry = mysql_query($sql_select) or die('ERROR select form_add_batch_no : ' . $sql_select);
    //  echo $sql_select;


    $sql_prod_detil = "SELECT a.*,a.id_tr_produksi_detail, b.nama_shift, c.nama_group_shift,
					d.nama_line
				   FROM tr_produksi_detail a 
				   LEFT JOIN m_shift b on a.id_m_shift = b.id_m_shift	
				   LEFT JOIN m_group_shift c on a.id_m_group_shift = c.id_m_group_shift	
				   LEFT JOIN m_line d on a.id_m_line = d.id_m_line
				  WHERE a.id_tr_order = '$id_tr_order' and id_m_grade = $id_m_grade
					";
//echo $sql_prod_detil ;
    $qry_prod_detil = mysql_query($sql_prod_detil) or die('ERROR select : ' . $sql_prod_detil);
    $id_m_paper_core_ppcd = '';
    $order_no = '';
    $matcode_hasil = 0;
    while ($row = mysql_fetch_array($qry)) {
        $x = (isset($row['x']) ? $row['x'] : '');
        $order_no = $row['order_no'];
        $id_tr_order = $row['id_tr_order'];
        $matcode_hasil = $row['hh'];
        $berat = hitung_berat($matcode_hasil);
        $id_m_paper_core_ppcd = $row['id_m_paper_core'];
        //$status_order = trim($row['status_order']);
    }

    if (isset($id_m_paper_core_detail) && $id_m_paper_core_detail <> "") {
        $id_m_paper_core = $id_m_paper_core_detail;
    } else {
        $id_m_paper_core = $id_m_paper_core_ppcd;
    }

    if ($id_tr_produksi_detail_batch_no != '') {

        $action = 'edit';
        $sql_ = "SELECT * FROM tr_produksi_detail_batch_no 
					 WHERE id_tr_produksi_detail_batch_no = '$id_tr_produksi_detail_batch_no'";
        $qry_ = mysql_query($sql_) or die('ERROR select : ' . $sql_);
        while ($row_ = mysql_fetch_array($qry_)) {
            $id_tr_produksi_detail_batch_no = $row_['id_tr_produksi_detail_batch_no'];
            $batch_no = $row_['batch_no'];
            $berat = $row_['berat'];
            $id_tr_produksi_detail = $row_['id_tr_produksi_detail'];
            $id_m_paper_core = $row_['id_m_paper_core'];
        }

    } else {
        $action = 'add';
    }
    $lemparan = $action . '|' . (isset($id_tr_produksi_detail) ? $id_tr_produksi_detail : '');
    $lemparan = $action . '|' . $id_tr_order . '|' . $grade;

    ?>
    <form name="form_add_batch_no" id="form_add_batch_no" class="">
        <table width="620" align="center" class="body">
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td colspan="2"></td>
                            <td width="1%"></td>
                            <td></td>
                            <td width="3%"></td>
                            <td width="35%"></td>
                            <td width="19%" colspan="3"></td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                            <td colspan="6" align="center"><strong>BATCH NO</strong>
                                <script>
                                    call_all_batch_no('0');
                                </script>
                                <input type="hidden" name="id_tr_produksi_detail_batch_no"
                                       id="id_tr_produksi_detail_batch_no"
                                       value="<?= $id_tr_produksi_detail_batch_no ?>"/>
                                <input type="hidden" name="id_tr_produksi_detail" id="id_tr_produksi_detail"
                                       value="<?= $id_tr_produksi_detail ?>"/>
                                <input type="hidden" name="id_tr_order" id="id_tr_order" value="<?= $id_tr_order ?>"/>
                                <input type="hidden" name="id_m_grade" id="id_m_grade" value="<?= $id_m_grade ?>"/></td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                            <td colspan="6" align="center"></td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                            <td>Order No x</td>
                            <td align="center">:</td>
                            <td colspan="4"><strong><?php echo $order_no ?></strong></td>
                        </tr>
                        <tr>
                            <td colspan="3" rowspan="3">&nbsp;</td>
                            <td>Grade</td>
                            <td align="center">:</td>
                            <td colspan="4"><strong><?php echo strtoupper($grade) ?></strong></td>
                        </tr>
                        <tr>
                            <td>Matcode</td>
                            <td align="center">:</td>
                            <td colspan="4"><strong><?php echo strtoupper($matcode_hasil) ?></strong></td>
                        </tr>
                        <tr>
                            <?php

                            $sql_paper = "SELECT * FROM m_paper_core ORDER BY nama_paper_core";
                            $qry_paper = mysql_query($sql_paper) or die('ERROR select : ' . $sql_paper);

                            ?>
                            <td class="warning">Paper Code *)</td>
                            <td align="center">:</td>
                            <td colspan="4"><select name="cbo_paper_core" id="cbo_paper_core" class="combobox"
                                                    onchange="ca)">
                                    <?php
                                    while ($row_paper = mysql_fetch_array($qry_paper)) { ?>
                                        <option value="<?= $row_paper["id_m_paper_core"] ?>"
                                            <?php
                                            if (isset($id_m_paper_core)) {
                                                if ($row_paper["id_m_paper_core"] == $id_m_paper_core) {

                                                    echo 'selected';
                                                }
                                            } ?>
                                        >
                                            <?= $row_paper["nama_paper_core"] ?>
                                        </option>
                                    <?php }
                                    ?>
                                </select></td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                            <td class="warning">Shift - Mesin -Qty *)</td>
                            <td align="center">:</td>
                            <td colspan="4"><select name="cbo_prod_detil" id="cbo_prod_detil" class="combobox"
                                                    onchange="call_all_batch_no()">
                                    <option value="0" selected="selected">- Pilih -</option>
                                    <?php while ($row_prod_detil = mysql_fetch_assoc($qry_prod_detil)) { ?>
                                        <option value="<?= $row_prod_detil["id_tr_produksi_detail"] ?>"
                                            <?php
                                            if (isset($id_tr_produksi_detail)) {
                                                if ($row_prod_detil["id_tr_produksi_detail"] == $id_tr_produksi_detail) {
                                                    echo 'selected';
                                                }
                                            }
                                            ?>
                                        >
                                            <?= 'Shift : ' . $row_prod_detil["nama_shift"] . '' . $row_prod_detil["nama_group_shift"] . ' - Mesin : ' . $row_prod_detil["nama_line"] . ' - Qty : ' . $row_prod_detil["qty"] ?>
                                        </option>
                                    <?php }
                                    ?>
                                </select></td>
                        </tr>
                        <?php if ($action == 'edit') { ?>
                            <tr>
                                <td colspan="3">&nbsp;</td>
                                <td width="36%" height="0" align="left" valign="middle" class="warning">Batch *)<br/>No
                                    *)
                                </td>
                                <td height="0" align="center" valign="middle">:</td>
                                <td height="0" colspan="4" valign="bottom"><input style="text-transform: uppercase"
                                                                                  name="text_batch_no" type="text"
                                                                                  class="textbox_2" id="text_batch_no"
                                                                                  maxlength="15"
                                                                                  value="<?php echo $batch_no ?>"
                                                                                  onkeyup=""/>
                                </td>
                            </tr>
                        <?php } ?>

                        <?php if ($action == 'add') { ?>
                            <tr>
                                <td colspan="3">&nbsp;</td>
                                <td width="36%" height="1" align="left" valign="middle" class="warning">Batch *)<br/>No
                                    *)
                                </td>
                                <td height="1" align="center" valign="middle">:<br/>:</td>
                                <td height="1" colspan="4" valign="bottom">
                                    <div id="div_no"></div>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                            <td width="36%" height="3" align="left" valign="middle" class="">Berat Actual</td>
                            <td height="3" align="center" valign="middle">:</td>
                            <td height="3" colspan="4" valign="bottom"><input name="text_berat" type="text"
                                                                              class="textbox_angka_2" id="text_berat"
                                                                              maxlength="10"
                                                                              value="<?php echo isset($berat) ? $berat : 0; ?>"
                                                                              onkeyup="checkDec(this)"/>
                                Kg
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                            <td width="36%" align="left" valign="middle">&nbsp;</td>
                            <td align="center" valign="middle">&nbsp;</td>
                            <td colspan="4">&nbsp;</td>
                        </tr>

                        <tr>
                            <td width="3%"></td>
                            <td width="3%"></td>
                            <td></td>
                            <td width="36%"></td>
                            <td width="3%"></td>
                            <td width="35%"></td>
                        </tr>
                        <tr>
                            <td height="4" colspan="9" align="center"></td>
                        </tr>
                        <tr>

                            <td colspan="9" align="center">
                                <?php if ($action == 'add' and $status_order == '') {
                                    ?>
                                    <!--<input type="button" name="button_save" id="button_save" class="button" value="SAVE" onclick="save_batch_no_conf(<?= "'" . $lemparan . "'" ?>)" />-->

                                <?php }
                                if ($action == 'edit' and $status_order == '') {
                                    // echo 'fff = ' .$lemparan_detail;
//$lemparan = "'".$lemparan."'";
                                    ?>
                                    <input type="button" name="button_save2" id="button_save2" class="button"
                                           value="UPDATE" onclick="save_batch_no_conf(<?= "'" . $lemparan . "'" ?>)"/>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="button" name="button_save2" id="button_save2" class="button"
                                           value="CANCEL" onclick="add_batch_no(<?= "'" . $lemparan . "'" ?>)"/>

                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="9" align="center">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="9" align="center">
                                <!--<div id="div_tampil" style='overflow:auto; width:100px;height:100px;'>here is some text fgdfgdf gdgfd gdf gdfg dfg dfg dfg dfg dfg dfg fdg dfg df gddfgfd gdf gdf gdf gdfg dfg dfgdf gdfg df gdf gdfg fdg dfgfdg df gdfg df gdfgdfg dgdf gdfgdfgd fgdfg fdg df</div>
-->
                                <div id="div_tampil"></div>
                            </td>


                        </tr>
                        <tr>

                            <?php
                            if (!isset($id_tr_produksi_detail)) $id_tr_produksi_detail = '';
                            $sql = "SELECT * FROM tr_produksi_detail_batch_no WHERE id_tr_produksi_detail = '$id_tr_produksi_detail'";
                            $sql = "SELECT da.* ,nama_shift,nama_group_shift,nama_line,qty,a.matcode_hasil
		FROM tr_produksi_detail_batch_no da
		LEFT JOIN tr_produksi_detail a on a.id_tr_produksi_detail = da.id_tr_produksi_detail
		LEFT JOIN m_shift b on a.id_m_shift = b.id_m_shift	
		LEFT JOIN m_group_shift c on a.id_m_group_shift = c.id_m_group_shift	
		LEFT JOIN m_line d on a.id_m_line = d.id_m_line
		WHERE da.id_tr_order = '$id_tr_order' and a.id_m_grade = $id_m_grade 
		ORDER BY da.id_tr_produksi_detail, da.id_tr_produksi_detail_batch_no ";
                            $qry_2 = mysql_query($sql) or die('ERROR select : ' . $sql);
                            // echo $sql;

                            ?>


                        </tr>

                        <tr>
                            <td colspan="9" align="center">&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <p>&nbsp;</p>
    </form>
<?php }


//xxx

function form_add_partai()
{

    $lemparan_partai = $_REQUEST['lemparan_partai'];
    //	echo $lemparan_partai;

    $arr_isi = explode("|", $lemparan_partai);
    $offset = trim($arr_isi[0]);
    $id_tr_pk = trim($arr_isi[1]);
    $id_m_group = trim($arr_isi[2]);

    $sql_z = "SELECT * FROM m_group WHERE id_m_group = '$id_m_group'";
    $qry_z = mysql_query($sql_z) or die('ERROR select : ' . $sql_z);
    while ($row_z = mysql_fetch_array($qry_z)) {
        $nama_group = trim($row_z['nama_group']);
    }

    $flag_status_order = '';
    $sql_order = "SELECT id_tr_order , order_no, status as status_order
							FROM tr_order tr 
							INNER JOIN tr_bahan bh on tr.id_tr_bahan = bh.id_tr_bahan
							WHERE bh.id_tr_pk = '$id_tr_pk' and bh.id_m_group = '$id_m_group' 
					ORDER BY order_no";
    $qry_order = mysql_query($sql_order) or die('ERROR select : ' . $sql_order);
    $list_status_order = '';
    $list_order = '';
    while ($row_order = mysql_fetch_array($qry_order)) {
        $flag_status_order = '';
        $order_no = trim($row_order['order_no']);
        $status_order = trim($row_order['status_order']);
        if ($status_order == 't') {
            $flag_status_order = '- App';
        }
        $list_status_order .= $flag_status_order;
        $list_order .= $order_no . ' ' . $flag_status_order . '<br>';
    }
    if ($list_status_order != '') {
        $list_status_order = 'ada';
    }
    /*$sql_akses = "SELECT status as status_order FROM tr_order WHERE id_tr_order = '$id_tr_order' ";
$qry_akses = mysql_query($sql_akses) or die('ERROR select : '.$sql_akses);
  while($row_akses = mysql_fetch_array($qry_akses))
		{
			$status_order = trim($row_akses['status_order']);
		}
*/
//$qry = mysql_query($sql_select) or die('ERROR select form_add_batch_no : '.$sql_select);

    $sql_prod_detil = " SELECT distinct 
					DATE_FORMAT((a.waktu_awal), '%Y-%m-%d') AS 'waktu_awal', b.nama_shift, c.nama_group_shift,
					b.id_m_shift, c.id_m_group_shift
				    FROM tr_produksi_detail a 
				   	LEFT JOIN m_shift b on a.id_m_shift = b.id_m_shift	
				   	LEFT JOIN m_group_shift c on a.id_m_group_shift = c.id_m_group_shift	
				   	LEFT JOIN m_line d on a.id_m_line = d.id_m_line
				  WHERE a.id_tr_order in 
					(	SELECT id_tr_order 
							FROM tr_order tr 
							INNER JOIN tr_bahan bh on tr.id_tr_bahan = bh.id_tr_bahan
							WHERE bh.id_tr_pk = '$id_tr_pk' and bh.id_m_group = '$id_m_group' 
							)
					";
//echo $sql_prod_detil ;
    $qry_prod_detil = mysql_query($sql_prod_detil) or die('ERROR select : ' . $sql_prod_detil);


    ?>
    <form name="form_add_partai" id="form_add_partai" class="">
        <table width="750" align="center" class="body">
            <tr>


            <tr>
                <td colspan="2"></td>
                <td width="20%"></td>
                <td></td>
                <td width="3%"></td>
                <td width="21%"></td>
                <td width="19%"></td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
                <td colspan="3" align="center"><strong>Input Counter - Waste (CW)</strong>
                    <script>
                        show_partai('0');
                    </script>
                    <input type="hidden" name="id_tr_produksi_detail_batch_no" id="id_tr_produksi_detail_batch_no"
                           value="<?= $id_tr_produksi_detail_batch_no ?>"/>
                    <input type="hidden" name="id_tr_produksi_detail" id="id_tr_produksi_detail"
                           value="<?= $id_tr_produksi_detail ?>"/>
                    <input type="hidden" name="id_tr_pk" id="id_tr_pk" value="<?= $id_tr_pk ?>"/>
                    <input type="hidden" name="id_m_group" id="id_m_group" value="<?= $id_m_group ?>"/></td>
                <input type="hidden" name="status_order" id="status_order" value="<?= $list_status_order ?>"/></td>


            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
                <td width="21%" align="center">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td align="center">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
                <td width="21%">RPS / R</td>
                <td align="center">:</td>
                <td colspan="2"><strong><?php echo tampilan_no_rps($id_tr_pk) ?></strong></td>
            </tr>
            <tr>
                <td colspan="3" rowspan="2">&nbsp;</td>
                <td width="21%">Partai</td>
                <td align="center">:</td>
                <td colspan="2"><strong><?php echo strtoupper($nama_group) ?></strong></td>
            </tr>
            <tr>
                <td width="21%" valign="top">No Order</td>
                <td align="center" valign="top">:</td>
                <td colspan="2"><strong><?php echo trim($list_order) ?></strong></td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
                <td width="21%" class="">Tanggal - Shift</td>
                <td align="center">:</td>
                <td colspan="2"><select name="cbo_prod_detil" id="cbo_prod_detil" class="combobox"
                                        onchange="show_partai()">
                        <option value="0" selected="selected">- All -</option>
                        <?php while ($row_prod_detil = mysql_fetch_assoc($qry_prod_detil)) {

                            $tgl = convDate(substr($row_prod_detil["waktu_awal"], 0, 10), '-', '1');
                            $shift = $row_prod_detil["nama_shift"] . '' . $row_prod_detil["nama_group_shift"];
                            $id_m_shift = $row_prod_detil["id_m_shift"];
                            $value_combo = $row_prod_detil["waktu_awal"] . "xx" . $id_m_shift . "xx" . $row_prod_detil["id_m_group_shift"];
                            ?>
                            <option value="<?= $value_combo ?>"
                                <?php

                                if (isset($row_prod_detil["value_combo"]) && $row_prod_detil["value_combo"] == $value_combo) {
                                    echo 'selected';
                                }

                                ?>
                            >

                                <?= $tgl . ", Shift:  " . $shift; ?>
                            </option>
                        <?php }
                        ?>
                    </select></td>
            </tr>
            <?php if (isset($action) && $action == 'edit') { ?>
                <tr>
                    <td colspan="3"></td>
                    <td width="21%" height="0" align="left" valign="middle" class="warning"></td>
                    <td height="0" align="center" valign="middle"></td>
                    <td height="0" colspan="2" valign="bottom"></td>
                </tr>
            <?php } ?>

            <?php if (isset($action) && $action == 'add') { ?>
            <?php } ?>

            <tr>
                <td width="3%"></td>
                <td width="3%"></td>
                <td></td>
                <td colspan="3" align="center"></td>
            </tr>
            <tr>
                <td height="4" colspan="7" align="center"></td>
            </tr>
            <tr>

                <td colspan="7" align="center">
                    <table width="95%" border="0">
                        <tr>
                            <td colspan="3" align="center"><span class="table_red_alert"><blink> Pastikan seluruh inputan data2 Produksi untuk No Order tsb sudah BENAR, <br/>
		      karena setelah proses CW disimpan data-data tsb otomatis akan  terkunci. Dan pastikan semua Order tsb tidak dalam keadaan Approve</blink></span>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>

                </td>
            </tr>
            <tr>
                <td colspan="7" align="center"></td>
            </tr>
            <tr>
                <td colspan="7" align="center">

                    <div id="div_show_partai"></div>
                </td>


            </tr>

            <tr>
                <td colspan="7" align="center">&nbsp;</td>
            </tr>
        </table>
        </td>
        </tr>
        </table>
        <p>&nbsp;</p>
    </form>
<?php }

function save_data_waste()
{
    $lemparan = $_REQUEST['lemparan'];
    //echo('xx' . $lemparan);
    $usernya = $_SESSION['userid'];
    $id_tr_pk = $lemparan;
    $text_waste_edge = $_POST['text_waste_edge'];
    $text_waste_reclaime = $_POST['text_waste_reclaime'];
    $text_labour = $_POST['text_labour'];
    $text_break = $_POST['text_break'];
    $text_machine = $_POST['text_machine'];
    $ket = $_POST['ket'];

    $sql = "SELECT COUNT(*) as jumlah FROM tr_produksi WHERE id_tr_pk = '$id_tr_pk' ";
    $qry = mysql_query($sql) or die('ERROR select : ' . $sql);
    // echo $sql;

    while ($row = mysql_fetch_array($qry)) {
        $jumlah = $row['jumlah'];
    }

    if ($jumlah == 0) {
        $sql_exe =
            "INSERT INTO tr_produksi 
		(id_tr_pk, keterangan, waste_edge, waste_reclaime, labour,break_time	,userid_created,date_created)
		VALUES 
		('$id_tr_pk','$ket','$text_waste_edge','$text_waste_reclaime','$text_labour','$text_break', '$usernya',now())";
    } else {
        $sql_exe = "UPDATE tr_produksi
					SET  keterangan = '$ket', 
  					     waste_edge = '$text_waste_edge', 
						 waste_reclaime = '$text_waste_reclaime', 
						 labour = '$text_labour',
						 break_time = '$text_break' ,
						 machine_time = '$text_machine' ,
						 userid_modified = '$usernya',
						 date_modified  = now()
					WHERE id_tr_pk = '$id_tr_pk' ";
    }
//echo $sql_exe;
//die();
    $query = mysql_query($sql_exe) or die('ERROR data Produksi : ' . $sql_exe);

    $sisa_panjang = $_POST['sisa_panjang'];
    $sisa_berat = $_POST['sisa_berat'];
    $sisa_roll = $_POST['sisa_roll'];
    $id_tr_bahan = $_POST['id_tr_bahan'];


//die(sizeof($sisa_panjang));
    for ($i = 0; $i < sizeof($id_tr_bahan); $i++) {

        if ($sisa_panjang[$i] == '') {
            $sisa_panjang[$i] = 'NULL';
        }
        if ($sisa_berat[$i] == '') {
            $sisa_berat[$i] = 'NULL';
        }
        if ($sisa_roll[$i] == '') {
            $sisa_roll[$i] = 'NULL';
        }


        $sql_x = "UPDATE tr_bahan SET " .
            " sisa_panjang =  " . $sisa_panjang[$i] .
            " ,	sisa_berat =  " . $sisa_berat[$i] .
            " ,	sisa_roll =  " . $sisa_roll[$i] .
            " WHERE id_tr_bahan  = " . $id_tr_bahan[$i];
        //		$a = $a .'<br>'.$sql_x;
        $query_ = mysql_query($sql_x) or die('ERROR UPDATE data: ' . $sql_x);

    }
    //die($a);

    echo 'sukses';
}

function form_edit_data_waste()
{


    $lemparan = $_REQUEST['lemparan'];
    //$lemparan_detail = $_REQUEST['lemparan_detail'];
    //echo $lemparan;

//$lemparan ="'".$id_tr_pk.'|'.$id_tr_order."'";

    $arr_isi = explode("|", $lemparan);
    $id_tr_pk = trim($arr_isi[0]);
    $id_tr_order = trim($arr_isi[1]);

    if ($lemparan != '') {

        $arr_isi = explode("|", $lemparan);
        $id_tr_pk = trim($arr_isi[0]);
        $id_tr_order = trim($arr_isi[1]);
        $id_tr_produksi_detail = trim($arr_isi[2]);
        $action = 'edit';
        $sql_edit =
            "
		SELECT a.*
		FROM tr_produksi a 
		WHERE a.id_tr_pk = '$id_tr_pk'
		";

        $qry_edit = mysql_query($sql_edit) or die('ERROR select : ' . $sql_edit);
        // echo $sql_edit;

        while ($row_edit = mysql_fetch_array($qry_edit)) {

            $waste_edge = cek_angka_kosong(isset($row_edit['waste_edge']) ? $row_edit['waste_edge'] : 0, 0);
            $waste_reclaime = cek_angka_kosong(isset($row_edit['waste_reclaime']) ? $row_edit['waste_reclaime'] : 0, 0);
            $labour = cek_angka_kosong(isset($row_edit['labour']) ? $row_edit['labour'] : 0, 0);
            $break_time = cek_angka_kosong(isset($row_edit['break_time']) ? $row_edit['break_time'] : 0, 0);
            $machine_time = cek_angka_kosong(isset($row_edit['machine_time']) ? $row_edit['machine_time'] : 0, 0);
            $keterangan = (isset($row_edit['keterangan']) ? $row_edit['keterangan'] : '');
        }


    }


    ?>
    <form name="form_edit_data_waste" id="form_edit_data_waste" class="">
        <table width="420" align="center" class="body">
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td colspan="2"></td>
                            <td width="1%"></td>
                            <td></td>
                            <td width="2%"></td>
                            <td width="18%"></td>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><strong>WASTE</strong></td>
                            <td></td>
                            <td>&nbsp;</td>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3" rowspan="11" class="warning"></td>
                            <td width="25%" height="3" align="left" valign="middle">Edge Trim</td>
                            <td height="3" align="center" valign="middle">:</td>
                            <td height="3" colspan="4" valign="bottom"><input name="text_waste_edge" type="text"
                                                                              class="textbox_angka" id="text_waste_edge"
                                                                              maxlength="10"
                                                                              value="<?php echo $waste_edge ?>"
                                                                              onkeyup="checkDec(this)"/>
                                Kg
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" height="3" align="left" valign="middle">Cut Sheet</td>
                            <td height="3" align="center" valign="middle">:</td>
                            <td height="3" colspan="4" valign="bottom"><input name="text_waste_reclaime" type="text"
                                                                              class="textbox_angka"
                                                                              id="text_waste_reclaime" maxlength="10"
                                                                              value="<?php echo $waste_reclaime ?>"
                                                                              onkeyup="checkDec(this)"/>
                                Kg
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" align="left" valign="middle">&nbsp;</td>
                            <td align="center" valign="middle">&nbsp;</td>
                            <td colspan="4">&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="25%" align="left" valign="middle">Labour</td>
                            <td align="center" valign="middle">:</td>
                            <td colspan="4"><input name="text_labour" type="text" class="textbox_angka" id="text_labour"
                                                   maxlength="10" value="<?php echo $labour ?>"
                                                   onkeyup="checkDec(this)"/>
                                Hour
                            </td>
                        </tr>
                        <tr>
                            <td align="left">Break Time</td>
                            <td align="center">:</td>
                            <td colspan="4"><input name="text_break" type="text" class="textbox_angka" id="text_break"
                                                   maxlength="10" value="<?php echo $break_time ?>"
                                                   onkeyup="checkDec(this)"/>
                                Hour
                            </td>
                        </tr>
                        <tr>
                            <td align="left">Machine</td>
                            <td align="center">:</td>
                            <td colspan="4"><input name="text_machine" type="text" class="textbox_angka"
                                                   id="text_machine" maxlength="10" value="<?php echo $machine_time ?>"
                                                   onkeyup="checkDec(this)"/>
                                Hour
                            </td>
                        </tr>
                        <tr>
                            <td align="left">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <td colspan="4">&nbsp;</td>
                        </tr>
                        <tr>
                            <td height="26" colspan="2" align="left">Sisa Bahan</td>
                            <td colspan="4">:</td>
                            <table width="100%" align="center" class="body">
                                <tr class="table_header">
                                    <td>Matcode Bahan</td>
                                    <td>Panjang</td>
                                    <td>Berat (Kg)</td>
                                    <td>Roll</td>
                                </tr>
                                <tr class="">
                                    <?php

                                    $sql =
                                        "
		SELECT a.*, b.matcode as matcode_bahan_awal, b.lebar as lebar_bahan, b.panjang as panjang_bahan,
id_sliter, sisa_panjang, sisa_berat, sisa_roll, b.rack
		FROM tr_bahan a
		INNER JOIN m_schedule_detail b on a.id_m_schedule_detail = b.id_m_schedule_detail
		INNER JOIN tr_pk c on a.id_tr_pk = c.id_tr_pk 
		WHERE a.id_tr_pk = '$id_tr_pk'
		";

                                    $qry = mysql_query($sql) or die('ERROR select : ' . $sql);
                                    //echo $sql;

                                    while ($row = mysql_fetch_array($qry))
                                    {
                                    $c++;
                                    $id_tr_bahan = $row['id_tr_bahan'];
                                    $matcode_bahan_awal = $row['matcode_bahan_awal'];
                                    $id_sliter = $row['id_sliter'];
                                    $lebar_bahan = $row['lebar_bahan'];
                                    $panjang_bahan = $row['panjang_bahan'];
                                    $sisa_panjang = $row['sisa_panjang'];
                                    $sisa_berat = $row['sisa_berat'];
                                    $sisa_roll = $row['sisa_roll'];
                                    $rack = $row['rack'];

                                    $matcode_bahan_awal = matcode_2($matcode_bahan_awal, $rack, $id_jenis, $lebar_bahan, $panjang_bahan);
                                    ?>

                                    <td><?php echo $matcode_bahan_awal ?>
                                        <input type="hidden" id="id_tr_bahan<?php echo $c ?>" name="id_tr_bahan[]"
                                               value="<?php echo $id_tr_bahan ?>"/>
                                    </td>
                                    <td align="center"><input type="text"
                                                              class="textbox_angka" <?php echo $text_disabled ?>
                                                              onkeyup="checkDec(this)" id="sisa_panjang<?php echo $c ?>"
                                                              name="sisa_panjang[]" maxlength="10"
                                                              value="<?php echo $row['sisa_panjang'] ?>"/></td>
                                    <td align="center"><input type="text"
                                                              class="textbox_angka" <?php echo $text_disabled ?>
                                                              onkeyup="checkDec(this)" id="sisa_berat<?php echo $c ?>"
                                                              name="sisa_berat[]" maxlength="10"
                                                              value="<?php echo $row['sisa_berat'] ?>"/></td>
                                    <td align="center">
                                        <input type="text" class="textbox_angka" <?php echo $text_disabled ?>
                                               onkeyup="checkDec(this)" id="sisa_roll<?php echo $c ?>"
                                               name="sisa_roll[]" maxlength="10"
                                               value="<?php echo $row['sisa_roll'] ?>"/>
                                    </td>
                                </tr>

                                <?php } ?>
                            </table>
                        <tr>
                            <td align="left">&nbsp;</td>
                            <td align="center">&nbsp;</td>

                        </tr>
                        <tr>
                            <td colspan="3" align="left">Keterangan per RPS :</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td width="18%"></td>
                            <td width="6%"></td>
                            <td width="26%"></td>
                        </tr>
                        <tr>
                            <td height="47" colspan="9" align="left"><textarea name="ket" cols="47" rows="3"
                                                                               id="ket"><?php echo $keterangan ?></textarea>
                            </td>
                        </tr>
                        <tr>

                            <td colspan="9" align="center">
                                <?php if ($action == 'add') {
                                    ?>
                                    <input type="button" name="button_save" id="button_save" class="button" value="SAVE"
                                           onclick="edit_waste_conf(<?= $lemparan ?>)"/>

                                <?php }
                                if ($action == 'edit') {
                                    // echo 'fff = ' .$lemparan_detail;
                                    $lemparan = "'" . $lemparan . "'";
                                    ?>
                                    <input type="button" name="button_save2" id="button_save2" class="button"
                                           value="UPDATE" onclick="edit_waste_conf(<?= $lemparan ?>)"/>

                                <?php } ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <p>&nbsp;</p>
    </form>
<?php }

function delete_detail_produksi()
{
    $lemparan = $_REQUEST['lemparan'];
    //die('ZZ '.$lemparan);

    $isi = explode("|", $lemparan);
    $id_tr_pk = trim($isi[0]);
    $id_tr_order = trim($isi[1]);
    $id_tr_produksi_detail = trim($isi[2]);

    $sql_x = "DELETE FROM tr_produksi_detail WHERE id_tr_produksi_detail = '$id_tr_produksi_detail' ";
    $query_data = mysql_query($sql_x) or die('ERROR delete data: ' . $sql_x);

    $sql_x = "DELETE FROM tr_produksi_detail_bahan WHERE id_tr_produksi_detail = '$id_tr_produksi_detail' ";
    $query_data = mysql_query($sql_x) or die('ERROR delete data: ' . $sql_x);

    $sql_x = "DELETE FROM tr_produksi_detail_batch_no WHERE id_tr_produksi_detail = '$id_tr_produksi_detail' ";
    $query_data = mysql_query($sql_x) or die('ERROR delete data: ' . $sql_x);

    $sql_ = "SELECT count(*) as jum FROM tr_order WHERE id_tr_order = '$id_tr_order' ";
    $qry_ = mysql_query($sql_) or die('ERROR select : ' . $sql_);

    while ($row_ = mysql_fetch_array($qry_)) {
        $jum = $row_['jum'];
    }

    if ($jum == 0) {
        $sql_upd =
            " UPDATE tr_order 
 				  SET batch_no_hasil = null , 
					  matcode_hasil = null
				  WHERE id_tr_order = '$id_tr_order' ";
        $query_upd = mysql_query($sql_upd) or die('ERROR UPDATE data: ' . $sql_upd);
    }

    echo('sukses');

}

function save_produksi()
{

    $lemparan = $_REQUEST['lemparan'];
//die('xx' . $lemparan);

    $temp_order = 'temp_order_' . $_SESSION['userid'];
    $usernya = $_SESSION['userid'];

    $catatan_order = htmlspecialchars($_POST['txt_catatan_order']);
    $catatan_packing = htmlspecialchars($_POST['txt_catatan_packing']);

    $cbo_shift = $_POST['cbo_shift'];
    $cbo_line = $_POST['cbo_line'];
    $cbo_group_shift = $_POST['cbo_group_shift'];

    $text_counter_awal = $_POST['text_counter_awal'];
    $text_counter_akhir = $_POST['text_counter_akhir'];

    $text_tanggal_awal = $_POST['text_tanggal_awal'];
    $text_tanggal_akhir = $_POST['text_tanggal_akhir'];

    $text_qty = $_POST['text_qty'];
    $text_bahan = $_POST['text_bahan'];
    $text_lot = $_POST['text_lot'];

    $hour_from = str_pad($_POST['hour_from'], 2, "0", STR_PAD_LEFT);
    $minute_from = str_pad($_POST['minute_from'], 2, "0", STR_PAD_LEFT);

    $waktu_awal = $text_tanggal_awal . " " . $hour_from . ":" . $minute_from;

    $hour_from2 = str_pad($_POST['hour_from2'], 2, "0", STR_PAD_LEFT);
    $minute_from2 = str_pad($_POST['minute_from2'], 2, "0", STR_PAD_LEFT);

    $waktu_akhir = $text_tanggal_akhir . " " . $hour_from2 . ":" . $minute_from2;

    $cbo_grade = $_POST['cbo_grade'];
    $cbo_reason = $_POST['cbo_reason'];
    $text_material = $_POST['text_material'];
    $txt_keterangan = $_POST['txt_keterangan'];
    $text_matcode_hasil = strtoupper($_POST['text_matcode_hasil']);
    $id_m_packing_detail = $_POST['cbo_packing'];

    $isi = explode("|", $lemparan);
    $id_tr_pk = trim($isi[0]);

    $id_tr_order = trim($isi[1]);
    $id_m_group = $_POST['id_m_group'];

    $text_waste_edge = $_POST['text_waste_edge'];
    $text_waste_reclaime = $_POST['text_waste_reclaime'];
    //$text_labour = $_POST['text_labour'];
    $text_break = $_POST['text_break'];
    $text_machine = $_POST['text_machine'];
    $txt_keterangan_reject = $_POST['txt_keterangan_reject'];
    $tgl = substr($waktu_awal, 0, 10);


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
    //echo $sql_detail;

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
    /*$sql_upd_CW = "
					UPDATE tr_produksi_detail
					SET  counter_awal = null,
 						 counter_akhir = null,
						 waste_edge = null,
						 waste_reclaime = null,
						 waste_edge_total = null,
						 waste_reclaime_total = null,
						 machine_time = null,
						 userid_modified = '$usernya',
						 date_modified  = now()
					WHERE id_tr_produksi_detail in ($list_id_tr_produksi_detail) ; ";
		$query_upd_CW = mysql_query($sql_upd_CW) or die('ERROR update CEW: '.$sql_upd_CW);*/
    //echo $sql_upd_CW ;
    //	die();

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

    $text_qty = '1';

    $sql_insert = " 
		INSERT INTO tr_produksi_detail 
		(id_tr_produksi,id_tr_order,id_m_shift,id_m_line,waktu_awal,waktu_akhir,
		 matcode_hasil,
		id_m_packing_detail,
		id_m_group_shift,id_m_grade, id_m_reason, qty,keterangan,
		 break_time, keterangan_reject, lot,
		userid_created,date_created )
		VALUES 
		('$id_tr_produksi','$id_tr_order','$cbo_shift','$cbo_line','$waktu_awal','$waktu_akhir',
		 '$text_material',
		 '$id_m_packing_detail',
		'$cbo_group_shift','$cbo_grade','$cbo_reason','$text_qty','$txt_keterangan',
		 '$text_break', '$txt_keterangan_reject', '$text_lot',
		'$usernya',now()
		) ";
//echo $sql_insert . '<br>';
    $query_ins = mysql_query($sql_insert) or die('ERROR INSERT : ' . $sql_insert);
    $sql = "SELECT LAST_INSERT_ID()";
    $result = mysql_query($sql);
    while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
        $last_id = $row[0];
        $berat_hasil = total_berat_per_tr_produksi_detail($last_id); //20161201 tambahan utk sisa
    }

    $cek_ = $_POST['cek_'];

    for ($i = 0; $i < sizeof($cek_); $i++) {

        $sql_x = "INSERT INTO tr_produksi_detail_bahan ( id_tr_produksi_detail, id_tr_bahan,id_m_group,id_tr_order,id_tr_pk) 
				  VALUES ( $last_id , $cek_[$i], $id_m_group, $id_tr_order,$id_tr_pk)";
        //$a =  $a .'<br>'. $sql_x ;
        $query_data = mysql_query($sql_x) or die('ERROR insert data: ' . $sql_x);
    }
//echo $a;
//die();


    $batch_no = ($_POST['batch_no']);
    $jum_tambahan = sizeof($batch_no);

    if (intval($jum_tambahan) > 0) {
        $cek_tam = $_POST['cek_tam'];
        $mat = $_POST['mat'];
        $lot = $_POST['lot'];
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

            if ($batch_no[$i] != '') {

                $bahan_tambahan = strtoupper($bahan_tambahan[$i]);
                $qty_tambahan = $qty[$i];
                $batch_no[$i] = strtoupper($batch_no[$i]);
                $mat[$i] = strtoupper($mat[$i]);
                $tipe[$i] = strtoupper($tipe[$i]);
                $berat[$i] = str_replace(',', '', ($berat[$i]));

                $sisa[$i] = $berat[$i] - ($berat[$i] / $total_berat_bahan * $berat_hasil);

                $sql_x = "INSERT INTO tr_produksi_detail_bahan 	(id_tr_produksi_detail,id_tr_bahan,id_m_group,id_tr_order,bahan_tambahan,batch_no_tambahan,rolls_tambahan,lebar,panjang,lot,jb,cs,tipe,berat,sisa,id_tr_pk)
		 VALUES ( $last_id , '0', $id_m_group, $id_tr_order,'$mat[$i]','$batch_no[$i]','$qty[$i]','$lebar[$i]','$panjang[$i]','$lot[$i]','$jb[$i]','$cs[$i]','$tipe[$i]','$berat[$i]','$sisa[$i]',$id_tr_pk)";
                //$a =  $a .'<br>'. $sql_x ;
                $query_data = mysql_query($sql_x) or die('ERROR insert data: ' . $sql_x);
            }
        }
        //die($a);
    }
    $temp_mat_tambahan = 'temp_mat_tambahan_' . $_SESSION['userid'];
    $sql1 = " DROP TABLE IF EXISTS $temp_mat_tambahan ";
    $qry_1 = mysql_query($sql1) or die('ERROR : ' . $sql1);

    echo 'sukses';
}


function save_edit_produksi()
{

    $lemparan = $_REQUEST['lemparan'];
//die('xx' . $lemparan);

    $temp_order = 'temp_order_' . $_SESSION['userid'];
    $usernya = $_SESSION['userid'];

    $txt_keterangan = htmlspecialchars($_POST['txt_keterangan']);

    $cbo_shift = $_POST['cbo_shift'];
    $cbo_line = $_POST['cbo_line'];
    $cbo_group_shift = $_POST['cbo_group_shift'];

    $text_counter_awal = $_POST['text_counter_awal'];
    $text_counter_akhir = $_POST['text_counter_akhir'];

    $text_tanggal_awal = $_POST['text_tanggal_awal'];
    $text_tanggal_akhir = $_POST['text_tanggal_akhir'];

    $text_qty = $_POST['text_qty'];
    $text_bahan = $_POST['text_bahan'];
    $hour_from = str_pad($_POST['hour_from'], 2, "0", STR_PAD_LEFT);
    $minute_from = str_pad($_POST['minute_from'], 2, "0", STR_PAD_LEFT);

    $waktu_awal = $text_tanggal_awal . " " . $hour_from . ":" . $minute_from;

    $hour_from2 = str_pad($_POST['hour_from2'], 2, "0", STR_PAD_LEFT);
    $minute_from2 = str_pad($_POST['minute_from2'], 2, "0", STR_PAD_LEFT);

    $waktu_akhir = $text_tanggal_akhir . " " . $hour_from2 . ":" . $minute_from2;

    $cbo_grade = $_POST['cbo_grade'];
    $cbo_reason = trim($_POST['cbo_reason']);
    $id_m_packing_detail = $_POST['cbo_packing'];
    $id_m_group = trim($_POST['id_m_group']);
    $id_tr_order = trim($_POST['id_tr_order']);
    $txt_keterangan_reject = trim($_POST['txt_keterangan_reject']);
    $cbo_reason = !empty($cbo_reason) ? $cbo_reason : '0';

    $text_material = $_POST['text_material'];
    $text_matcode_hasil = strtoupper($_POST['text_matcode_hasil']);

    $isi = explode("|", $lemparan);
    $id_tr_pk = trim($isi[0]);
    $id_tr_order = trim($isi[1]);

    $id_tr_pk = $_POST['id_tr_pk'];
    $text_lot = $_POST['text_lot'];

    $text_waste_edge = $_POST['text_waste_edge'];
    $text_waste_reclaime = $_POST['text_waste_reclaime'];
    //$text_labour = $_POST['text_labour'];
    $text_break = $_POST['text_break'];
    $text_machine = $_POST['text_machine'];

    $id_tr_produksi_detail = $_POST['id_tr_produksi_detail'];
    $tgl = substr($waktu_awal, 0, 10);

//die($id_tr_produksi_detail);

    if ($id_m_group == '') {
        $id_m_group = 0;
    }
    if ($id_tr_order == '') {
        $id_tr_order = 0;
    }

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
    //echo $sql_detail;

    while ($row_detail = mysql_fetch_array($qry_detail)) {
        $id_tr_produksi_detail_x = $row_detail['id_tr_produksi_detail'];
        $nama_group_shift = $row_detail['nama_group_shift'];

        if (trim($id_tr_produksi_detail) != '') {
            $list_id_tr_produksi_detail .= ',' . $id_tr_produksi_detail_x;
        }
    }
//2018-01-13 di BUKA sementara utk kasus, tr_produksi_detail_bahan yg ter DELETE//
    /*if ($list_id_tr_produksi_detail != '')
{
$tgl_tampilan = convDate($tgl,'-','1');
echo 'Gagal, data Tgl : ' . $tgl_tampilan . ' dan Shift :' . $cbo_shift . $nama_group_shift . ' sudah di input CW nya. DELETE dulu CW tsb' ;
die();
}*/
    $text_qty = '1';

    $sql_update = " 
		UPDATE tr_produksi_detail
		SET 
            id_m_shift ='$cbo_shift',
			id_m_group_shift = '$cbo_group_shift',
			id_m_line = '$cbo_line',
			waktu_awal = '$waktu_awal',
			waktu_akhir = '$waktu_akhir',
			matcode_hasil = '$text_material',
			id_m_packing_detail = '$id_m_packing_detail',
			id_m_grade = '$cbo_grade', 
			id_m_reason = '$cbo_reason', 
			break_time = '$text_break' ,
			keterangan = '$txt_keterangan', 
			keterangan_reject = '$txt_keterangan_reject',
			userid_modified = '$usernya',
			date_modified  = now()
			WHERE  id_tr_produksi_detail ='$id_tr_produksi_detail'
	 ";
    $sql_update = str_replace('', 'ddd', trim($sql_update));
//die('xx'.$sql_update);
    $query_ins = mysql_query($sql_update) or die('ERROR INSERT : ' . $sql_update);


    $tahun = substr($waktu_awal, 3, 1);
    $bulan = substr($waktu_awal, 5, 2);
    $tanggal = substr($waktu_awal, 8, 2);
    $bulan = convert_bulan_ke_huruf($bulan);

    $batch_no = $tahun . $bulan . $tanggal;

    $sql_update =
        " UPDATE tr_produksi_detail_batch_no SET batch_no = CONCAT('$batch_no', substring(batch_no, 5,15) ) 
	WHERE id_tr_produksi_detail ='$id_tr_produksi_detail' ";
    //die($sql_update);
    $query_update = mysql_query($sql_update) or die('ERROR UPDATE data: ' . $sql_update);


    $cek_ = $_POST['cek_'];

    $sql_del = "DELETE FROM tr_produksi_detail_bahan WHERE id_tr_produksi_detail ='$id_tr_produksi_detail' ";
    $query_del = mysql_query($sql_del) or die('ERROR DELETE data: ' . $sql_del);

    $id_tr_order_x = $_POST['id_tr_order_x'];
    $berat_hasil = total_berat_per_tr_produksi_detail($id_tr_produksi_detail); //20161201 tambahan utk sisa

    $cek_ = $_POST['cek_'];

    for ($i = 0; $i < sizeof($cek_); $i++) {

        $sql_x = "INSERT INTO tr_produksi_detail_bahan ( id_tr_produksi_detail, id_tr_bahan,id_m_group,id_tr_order,id_tr_pk) 
				  VALUES ( $id_tr_produksi_detail , $cek_[$i], $id_m_group, $id_tr_order,$id_tr_pk)";
        //$a =  $a .'<br>'. $sql_x ;
        $query_data = mysql_query($sql_x) or die('ERROR insert data: ' . $sql_x);
    }
    /*for($i=0;$i<sizeof($cek_);$i++)
		{

		$sql_x = "INSERT INTO tr_produksi_detail_bahan
						  ( id_tr_produksi_detail, id_tr_bahan,id_m_group,id_tr_order,id_tr_pk)
				  VALUES ( $id_tr_produksi_detail , $cek_[$i], '$id_m_group', '$id_tr_order_x',$id_tr_pk)";
						//$a =  $a .'<br>'. $sql_x ;
					$query_data = mysql_query($sql_x) or die('ERROR insert data: '.$sql_x);

		}
*/
//die($text_bahan);

    $batch_no = ($_POST['batch_no']);
    $jum_tambahan = sizeof($batch_no);

    if (intval($jum_tambahan) > 0) {
        $cek_tam = $_POST['cek_tam'];
        $mat = $_POST['mat'];
        $lot = $_POST['lot'];
        $jb = $_POST['jb'];
        $cs = $_POST['cs'];
        $qty = $_POST['qty'];
        $lebar = $_POST['lebar'];
        $panjang = $_POST['panjang'];
        $tipe = $_POST['tipe'];
        $berat = $_POST['berat'];
        $berat_1 = $_POST['berat_1'];


        $total_berat_bahan = 0; //20161201 tambahan utk sisa
        for ($i = 0; $i < ($jum_tambahan); $i++) {
            if ($batch_no[$i] != '') {
                $berat[$i] = str_replace(',', '', ($berat[$i]));
                $total_berat_bahan = $total_berat_bahan + $berat[$i];
            }
        }

        for ($i = 0; $i < ($jum_tambahan); $i++) {
            if ($batch_no[$i] != '') {

                $bahan_tambahan = strtoupper($bahan_tambahan[$i]);
                $qty_tambahan = $qty[$i];
                $batch_no[$i] = strtoupper($batch_no[$i]);
                $mat[$i] = strtoupper($mat[$i]);
                $tipe[$i] = strtoupper($tipe[$i]);
//					$berat[$i] = str_replace(',','',($berat[$i]));


                /*	echo 'bahan_tambahan '.  $bahan_tambahan[$i] .'<br>';
			echo 'batch_no '.  $batch_no[$i] .'<br>';
			echo 'mat '.  $mat[$i] .'<br>';
			echo 'tipe '.  $tipe[$i] .'<br>';
			echo 'berat '.  $berat[$i] .'<br>';
			echo 'lot '.  $lot[$i] .'<br>';	*/
                //	die();

                if (($total_berat_bahan * $berat_hasil) != 0) {
                    $sisa[$i] = $berat[$i] - ($berat[$i] / $total_berat_bahan * $berat_hasil);
                } else {
                    $sisa[$i] = 0;
                }

                $sql_x = "INSERT INTO tr_produksi_detail_bahan 	(id_tr_produksi_detail,id_tr_bahan,id_m_group,id_tr_order,bahan_tambahan,batch_no_tambahan,rolls_tambahan,lebar,panjang,lot,jb,cs,tipe,berat,sisa,id_tr_pk)
		 VALUES ( $id_tr_produksi_detail , '0', $id_m_group, $id_tr_order,'$mat[$i]','$batch_no[$i]','$qty[$i]','$lebar[$i]','$panjang[$i]','$lot[$i]','$jb[$i]','$cs[$i]','$tipe[$i]','$berat[$i]','$sisa[$i]',$id_tr_pk)";
                $data = "berat $i : " . $berat[$i] . " sisa : " . $sisa[$i] . " total_bahan : " . $total_berat_bahan . '<br>';
// echo $data;
                //$a =  $a .'<br>'. $sql_x ;
                $b = $b . '<br>' . $data;
//die($sql_x);
                $query_data = mysql_query($sql_x) or die('ERROR insert data: ' . $sql_x);
            }
        }
//die($b);
        /*$arr_isi=explode("\n",$text_bahan);

for($i=0;$i<sizeof($arr_isi);$i++)
	{
			if  ($arr_isi[$i] != '')
			{


			$arr_tambahan=explode(";",$arr_isi[$i]);
			$bahan_tambahan = mysql_real_escape_string($arr_tambahan[0]);
			$batch_no_tambahan = strtoupper($arr_tambahan[1]);
			$qty_tambahan = $arr_tambahan[2];

	$sql_x = "INSERT INTO tr_produksi_detail_bahan
		(id_tr_produksi_detail,id_tr_bahan,id_m_group,id_tr_order,bahan_tambahan,batch_no_tambahan,rolls_tambahan,id_tr_pk)
 VALUES ( $id_tr_produksi_detail , '0', $id_m_group, $id_tr_order_x,'$bahan_tambahan','$batch_no_tambahan','$qty_tambahan',$id_tr_pk)";
						$a =  $a .'<br>'. $sql_x ;

				$query_data = mysql_query($sql_x) or die('ERROR insert data: '.$sql_x);

			}*/

    }

    echo 'sukses';
}


function add_sub()
{
    ?>
    <script type="text/javascript">
        $("#text_tanggal_awal").datepicker({dateFormat: 'yy-mm-dd'});
        $("#text_tanggal_akhir").datepicker({dateFormat: 'yy-mm-dd'});
    </script>
    <?php

    $lemparan = $_REQUEST['lemparan'];
    $lemparan_detail = (isset($_REQUEST['lemparan_detail']) ? $_REQUEST['lemparan_detail'] : '');
    //$lemparan_detail = $_REQUEST['lemparan_detail'];
    $txt_menuid = $_REQUEST['txt_menuid'];
    /*echo 'lemparan : '.$lemparan .'<br>';
echo 'lemparan_detail : '.$lemparan_detail .'<br>';
echo 'txt_menuid : '.$txt_menuid .'<br>';
*/

    $arr_isi = explode("|", $lemparan);
    $id_tr_pk = trim($arr_isi[0]);
    $id_tr_order = trim($arr_isi[1]);

    if ($lemparan_detail != '') {

        $arr_isi_detail = explode("|", $lemparan_detail);
        $id_tr_pk = trim($arr_isi_detail[0]);
        $id_tr_order = trim($arr_isi_detail[1]);
        $id_tr_produksi_detail = trim($arr_isi_detail[2]);
        $action = 'edit';
        $sql_edit =
            "
		
SELECT a.*, b.nama_shift, c.nama_line ,batch_no_hasil,matcode_bahan,
		matcode_hasil, timediff(waktu_akhir, waktu_awal) as sel,nama_group_shift,nama_grade,a.qty,nama_reason,
		a.counter_awal, a.counter_akhir,a.keterangan, a.id_m_reason, a.id_m_grade,a.id_m_group_shift,a.userid_created, a.userid_modified,
		(TIMESTAMPDIFF(SECOND,waktu_awal,waktu_akhir)) AS time_diff,
a.waste_edge, a.waste_reclaime, a.break_time, a.machine_time, a.lot
		FROM tr_produksi_detail a 
		LEFT JOIN m_shift b on a.id_m_shift = b.id_m_shift 
		LEFT JOIN m_line c on a.id_m_line = c.id_m_line 
		LEFT JOIN m_group_shift d on a.id_m_group_shift = d.id_m_group_shift
		LEFT JOIN m_grade f on a.id_m_grade = f.id_m_grade
		LEFT JOIN m_reason g on a.id_m_reason = g.id_m_reason 
		LEFT JOIN
		 (SELECT id_tr_order,batch_no_hasil from tr_order) as px on px.id_tr_order = a.id_tr_order
		
		WHERE a.id_tr_produksi_detail = '$id_tr_produksi_detail'
		";

        $qry_edit = mysql_query($sql_edit) or die('ERROR select : ' . $sql_edit);
        //  echo $sql_edit;

        while ($row_edit = mysql_fetch_array($qry_edit)) {

            $id_m_shift = $row_edit['id_m_shift'];
            $id_m_line = $row_edit['id_m_line'];
            $qty = cek_angka_kosong(isset($row_edit['qty']) ? $row_edit['qty'] : 0, 0);
            $id_m_grade = ($row_edit['id_m_grade']);
            $id_m_reason = $row_edit['id_m_reason'];
            $id_m_group_shift = $row_edit['id_m_group_shift'];
            $userid_created = $row_edit['userid_created'];
            $userid_modified = trim($row_edit['userid_modified']);
            if ($userid_modified != '') {
                $userid = $userid_modified;
            } else {
                $userid = $userid_created;
            }
            $matcode_bahan = $row_edit['matcode_bahan'];
            $keterangan = $row_edit['keterangan'];
            $counter_awal = $row_edit['counter_awal'];
            $counter_akhir = $row_edit['counter_akhir'];
            $tanggal_awal = substr($row_edit['waktu_awal'], 0, 10);
            $jam_awal = substr($row_edit['waktu_awal'], 11, 2);
            $menit_awal = substr($row_edit['waktu_awal'], 14, 2);

            $tanggal_akhir = substr($row_edit['waktu_akhir'], 0, 10);
            $jam_akhir = substr($row_edit['waktu_akhir'], 11, 2);
            $menit_akhir = substr($row_edit['waktu_akhir'], 14, 2);
            $waste_edge = $row_edit['waste_edge'];
            $waste_reclaime = $row_edit['waste_reclaime'];
            $break_time = $row_edit['break_time'];
            $machine_time = $row_edit['machine_time'];
            $lot = $row_edit['lot'];

            $id_m_packing_detail = $row_edit['id_m_packing_detail'];


        }

    } else {
        $action = 'add';

        $tanggal_awal = date("Y-m-d");
        $tanggal_akhir = date("Y-m-d");
        $jam_akhir = date("H");
        $menit_akhir = date("i");
    }


    /*$sql_cek_CW = "SELECT count(*) as jum_CW from tr_produksi_detail a WHERE a.id_tr_order = '$id_tr_order'
				and a.machine_time is not null";
$qry_CW = mysql_query($sql_cek_CW) or die('ERROR select : '.$sql_cek_CW);
	 while($row_CW = mysql_fetch_array($qry_CW))
		{
         		$jum_CW = intval($row_CW['jum_CW']);
		}*/
    $jum_CW = cek_CW($id_tr_order);
//echo 'jum_CW =' .$jum_CW;
    $sql_ =
        "SELECT a.*, a.id_m_group_line,a.status as status_order, c.matcode, c.no_rps, c.tanggal, c.periode,c.catatan_order ,id_jenis,c.id_sliter,
			d.batch_no, a.batch_no_hasil as batch_no_hasil, d.rolls, d.jb, d.cs, d.lot,d.rack,
d.lebar as lebar_bahan, d.panjang as panjang_bahan, a.id_m_packing_detail as packing_awal,
b.roll_bahan, b.id_m_group, b.id_tr_pk,g.nama_group, a.id_m_line,
(SELECT CONCAT(nama_group_line, ' - ', nama_line) FROM m_line ma LEFT JOIN m_group_line mb on ma.id_m_group_line = mb.id_m_group_line WHERE id_m_line = a.id_m_line) as nama_group_line
            FROM tr_order a 
			LEFT JOIN tr_bahan b on a.id_tr_bahan = b.id_tr_bahan
			INNER JOIN m_schedule_detail d on b.id_m_schedule_detail = d.id_m_schedule_detail 
			LEFT JOIN tr_pk c on b.id_tr_pk = c.id_tr_pk
			LEFT JOIN m_group g on b.id_m_group = g.id_m_group

			WHERE a.id_tr_order = '$id_tr_order'  
			";

    $qry_ = mysql_query($sql_) or die('ERROR select : ' . $sql_);
    // echo $sql_;

    while ($row_ = mysql_fetch_array($qry_)) {
        $id_tr_pk = $row_['id_tr_pk'];
        $id_tr_order = $row_['id_tr_order'];
        $id_m_packing_detail = $row_['id_m_packing_detail'];
        $packing_awal = $row_['packing_awal'];
        $packing_produksi = (isset($row_['packing_produksi']) ? $row_['packing_produksi'] : '');
        //$packing_produksi = $row_['packing_produksi'];
        $id_m_group_line = $row_['id_m_group_line'];
        $nama_group_line = $row_['nama_group_line'];
        $id_m_line = $row_['id_m_line'];
        $rack = $row_['rack'];


        if ($packing_produksi != '') {
            $id_m_packing_detail = $packing_produksi;
        } else {
            $id_m_packing_detail = $packing_awal;
        }

        $periode = $row_['periode'];
        $tanggal = $row_['tanggal'];
        $id_sliter = strtolower($row_['id_sliter']);
        $no_rps = $row_['no_rps'];
        $nama_group = $row_['nama_group'];
        $matcode = $row_['matcode'];
        $catatan_order = $row_['catatan_order'];
        $order_no = $row_['order_no'];
        //$id_tr_order = $row_['id_tr_order'];
        $id_jenis = $row_['id_jenis'];
        $station = $row_['station'] . ' x';
        $panjang = $row_['panjang'];
        $lebar = $row_['lebar'];
        $jumlah = $row_['jumlah'];
        $status = $row_['status'];
        $batch_no = $row_['batch_no'];
        $lebar_bahan = $row_['lebar_bahan'];
        $panjang_bahan = $row_['panjang_bahan'];
        $roll_bahan = $row_['roll_bahan'];
        if ($action == 'add') {
            $lot = $row_['lot'];
        }
        $matcode_hasil = (isset($row_['matcode_hasil']) ? $row_['matcode_hasil'] : '');
        //$matcode_hasil = $row_['matcode_hasil'];
        $rolls = $row_['rolls'];
        $jb = $row_['jb'];
        $cs = $row_['cs'];
        $id_m_group = $row_['id_m_group'];
        $status_order = $row_['status_order'];
        if ((isset($matcode_bahan) ? $matcode_bahan : '') && $matocde_bahan != '') {
            $tampil_matcode_bahan = $matcode_bahan;
        } else //ambil bahan awal
        {
            $tampil_matcode_bahan = matcode_2($matcode, $rack, $id_jenis, $lebar_bahan, $panjang_bahan);
        }
//echo  'ddd '.$id_m_packing_detail;

        /*$id_tr_produksi_detail = $row_['id_tr_produksi_detail'];
				$id_m_shift = $row_['id_m_shift'];
				$id_m_group_shift = $row_['id_m_group_shift'];
				$id_m_line = $row_['id_m_line'];
				$qty = cek_angka_kosong($row_['qty'],0);
				$id_m_grade = $row_['id_m_grade'];
				$id_m_reason = $row_['id_m_reason'];
				$keterangan = $row_['keterangan'];
				$counter_awal = $row_['counter_awal'];
				$counter_akhir = $row_['counter_akhir'];
				$tanggal_awal  = substr($row_['waktu_awal'],0,10);
				$jam_awal  = substr($row_['waktu_awal'],11,2);
				$menit_awal = substr($row_['waktu_awal'],14,2);

				$tanggal_akhir  = substr($row_['waktu_akhir'],0,10);
				$jam_akhir  = substr($row_['waktu_akhir'],11,2);
				$menit_akhir = substr($row_['waktu_akhir'],14,2);
				$matcode_hasil_akhir  = $row_['matcode_hasil_akhir'];*/
    }

    if ((isset($id_tr_produksi_detail) ? $id_tr_produksi_detail : '') && $id_tr_produksi_detail != '') {
        $action = 'edit';
    }

    $lemparan = "'" . $lemparan . '|' . $order_no . "'";


    $judul = strtoupper($action);

    if ($id_sliter == 'r') //untuk text bahan
    {
        $text = 'class="textbox_3"';
        $tampil_reslitter = '(R)';
    } else {
        //$text ='readonly="readonly" class="textbox_3_read_only"';
        $text = 'class="textbox_3_read_only"'; //text bahan bisa di edit
    }

    $sql_shift =
        "
          SELECT a.* 
          FROM m_shift a WHERE status ='t'
                  ";
    $qry_shift = mysql_query($sql_shift) or die('ERROR select : ' . $sql_shift);

    $sql_group_shift =
        "
          SELECT a.* 
          FROM m_group_shift a WHERE status ='t'
                  ";
    $qry_group_shift = mysql_query($sql_group_shift) or die('ERROR select : ' . $sql_group_shift);

    $sql_grade =
        "
          SELECT a.* 
          FROM m_grade a WHERE status ='t' ORDER BY nama_grade
                  ";
    $qry_grade = mysql_query($sql_grade) or die('ERROR select : ' . $sql_grade);
    if ($id_m_group_line == '') {
        $where_group = '1 = 1';
    } else {
        $where_group = " id_m_group_line = '$id_m_group_line' ";
    }
    $sql_line =
        "
          SELECT a.* 
          FROM m_line a WHERE $where_group and status ='t' 
                  ";
    $qry_line = mysql_query($sql_line) or die('ERROR select : ' . $sql_line);

    $sql_x = "SELECT * FROM m_packing_detail a 
			INNER JOIN m_packing b on a.id_m_packing = b.id_m_packing 
			WHERE periode != '' AND  matcode = '$matcode' ";

    $sql_x = "SELECT * FROM m_packing_detail a 
			INNER JOIN m_packing b on a.id_m_packing = b.id_m_packing 
WHERE a.status ='t'
			 ORDER BY material_code1  ";


    $qry_x = mysql_query($sql_x) or die('ERROR select : ' . $sql_x);


    $sql_reason =
        "
          SELECT a.* 
          FROM m_reason a WHERE status ='t'
                  ";
    $qry_reason = mysql_query($sql_reason) or die('ERROR select : ' . $sql_reason);
    /*$qry_reason_i = mysql_query($sql_reason) or die('ERROR select : '.$sql_reason);
		$qry_reason_r = mysql_query($sql_reason) or die('ERROR select : '.$sql_reason);
		$qry_reason_rc = mysql_query($sql_reason) or die('ERROR select : '.$sql_reason);*/

    ?>
    <form name="form_view_sub" id="form_view_sub" class="">
        <table width="75%" align="center" class="body">
            <tr>
                <td colspan="2" align="left">
                    <table width="100%">
                        <tr>
                            <td width="5%" align="right" style="font-size:16px">
                                <label for="id_tr_produksi_detail"></label>
                                <input type="hidden" name="id_tr_produksi_detail" id="id_tr_produksi_detail"
                                       value="<?= $id_tr_produksi_detail ?>"/>
                                <input type="hidden" name="id_m_reason" id="id_m_reason" value="<?= isset($id_m_reason) ? $id_m_reason : '' ?>"/>
                                <input type="hidden" name="id_tr_pk" id="id_tr_pk" value="<?= $id_tr_pk ?>"/>
                                <input type="hidden" name="id_m_group" id="id_m_group" value="<?= $id_m_group ?>"/>
                                <input type="hidden" name="id_tr_order_x" id="id_tr_order_x"
                                       value="<?= $id_tr_order ?>"/>


                                <script type="text/Javascript">

                                    show_bahan();
                                </script>
                            </td>
                            <td width="1%" align="right" style="font-size:16px">&nbsp;</td>
                            <td align="right" style="font-size:16px"><b><?php echo $judul . ' DATA' ?></b></td>
                            <input type="hidden" name="id_tr_order" id="id_tr_order"
                                   value="<?= matcode_2($matcode, $rack, $id_jenis, $lebar, $panjang) . '|' . $id_sliter ?>"/>
                            <input type="hidden" name="id_tr_order_asli" id="id_tr_order_asli"
                                   value="<?= $id_tr_order ?>"/>
                            <td width="5%" align="center" style="font-size:16px"></td>
                            <td align="center" style="font-size:16px">&nbsp;</td>
                            <td colspan="4" align="center" style="font-size:16px">&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="5%" rowspan="2">No RPS(R)</td>
                            <td rowspan="2" align="center">:</td>
                            <td rowspan="2"><strong><a target="_blank"
                                                       href="../template/index_form_perintah_kerja.php?id_tr_pk=<?php echo $id_tr_pk ?>">
                                        <?= tampilan_no_rps($id_tr_pk) ?></a><?php echo ' ' . (isset($tampil_reslitter) ? $tampil_reslitter : '') ?>
                                </strong></td>
                            <td rowspan="2">Station</td>
                            <td align="right"></td>
                            <td colspan="2" rowspan="2" align="left"><?php echo $station ?></td>
                            <td width="7%" rowspan="2" align="left">Roll Awal</td>
                            <td width="52%" rowspan="2" align="left">: <?php echo $roll_bahan ?></td>
                        </tr>
                        <tr>
                            <td align="center">:</td>
                        </tr>
                        <tr>
                            <td width="5%">Tanggal</td>
                            <td align="center">:</td>
                            <td><?= convDate($tanggal, '-', '2') ?></td>
                            <td>Lebar</td>
                            <td align="center">:</td>
                            <td colspan="2" align="left"><?php echo number_format($lebar) ?></td>
                            <td align="left">JB</td>
                            <td align="left">: <?php echo $jb ?></td>
                        </tr>
                        <tr>
                            <td width="5%"><strong>Order No</strong></td>
                            <td align="center">:</td>
                            <td><strong><?php echo $order_no ?></strong> &nbsp;&nbsp; Partai : <?php echo $nama_group ?>
                            </td>
                            <td>Panjang</td>
                            <td align="center">:</td>
                            <td colspan="2"><?php echo number_format($panjang) ?></td>
                            <td>CS</td>
                            <td>: <?php echo $cs ?></td>
                        </tr>
                        <tr>
                            <td width="5%">Type</td>
                            <td align="center">:</td>
                            <td><?= $matcode ?></td>
                            <td>Qty Order</td>
                            <td align="center">:</td>
                            <td colspan="2"><strong><?php echo number_format($jumlah) ?></strong></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="5%">Batch No Bahan</td>
                            <td align="center">:</td>
                            <td><?= $batch_no ?></td>
                            <td>&nbsp;</td>
                            <td align="center">:</td>
                            <td colspan="4">
                                <!--<input name="text_lot" type="text"  class="textbox_angka" id="text_qty2" maxlength="10" value = "<?php echo $lot ?>"  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" />--></td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td width="1%"></td>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td width="5%">Material Bahan RPS</td>
                            <td align="center">:</td>
                            <td><strong><b style="color:red;">
                                        <?= matcode_2($matcode, $rack, $id_jenis, $lebar_bahan, $panjang_bahan) ?>
                                    </b></strong></td>
                            <td>&nbsp;</td>
                            <td></td>
                            <td colspan="4">&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="5%" class="warning">Shift *)</td>
                            <td align="center" class="warning">:</td>
                            <td height="3" valign="bottom"><select name="cbo_shift" id="cbo_shift" class="combobox"
                                                                   onchange="">
                                    <option value="0" selected="selected">- Pilih -</option>
                                    <?php while ($row_shift = mysql_fetch_assoc($qry_shift)) { ?>
                                        <option value="<?= $row_shift["id_m_shift"] ?>"
                                            <?php
                                            if (isset($id_m_shift)) {
                                                if ($row_shift["id_m_shift"] == $id_m_shift) {
                                                    echo 'selected';
                                                }
                                            }
                                            ?>
                                        >
                                            <?= $row_shift["nama_shift"] ?>
                                        </option>
                                    <?php }
                                    ?>
                                </select>

                                <span class="warning">&nbsp;Group *)</span>
                                <select name="cbo_group_shift" id="cbo_group_shift" class="combobox" onchange="">
                                    <option value="0" selected="selected">- Pilih -</option>
                                    <?php while ($row_group_shift = mysql_fetch_assoc($qry_group_shift)) { ?>
                                        <option value="<?= $row_group_shift["id_m_group_shift"] ?>"
                                            <?php
                                            if (isset($id_m_group_shift)) {
                                                if ($row_group_shift["id_m_group_shift"] == $id_m_group_shift) {
                                                    echo 'selected';
                                                }
                                            }
                                            ?>
                                        >
                                            <?= $row_group_shift["nama_group_shift"] ?>
                                        </option>
                                    <?php }
                                    ?>
                                </select></td>
                            <td height="3" align="left" valign="middle" class="warning">Qty *)</td>
                            <td height="3" align="center" valign="middle">:</td>
                            <td height="3" colspan="4" valign="bottom"><input name="text_qty" type="text"
                                                                              class="textbox_angka" id="text_qty"
                                                                              maxlength="10"
                                                                              value="<?php echo(isset($qty) ? $qty : "") ?>"
                                                                              onblur="hitung_berat_di_produksi()"
                                                                              onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"/>
                                Roll
                            </td>
                        </tr>
                        <tr>
                            <td width="5%" class="">Mesin</td>
                            <td align="center" class="warning">:</td>
                            <td height="0" valign="bottom"><strong><?php if ($nama_group_line != '') {
                                        echo $nama_group_line;
                                    } else {
                                        echo 'Mesin Belum di tentukan, hubungi Spv !!!';
                                    } ?></strong>&nbsp;
                                <input type="hidden" name="cbo_line" id="cbo_line" value="<?= $id_m_line ?>"/>
                                <!-- <select  disabled="disabled" name="cbo_line" id="cbo_line" class="combobox"  onchange="" >
          <option value="0" selected="selected">- Pilih -</option>
          <?php while ($row_line = mysql_fetch_assoc($qry_line)) { ?>
          <option value="<?= $row_line["id_m_line"] ?>"
                          <?php
                                    if (isset($id_m_line)) {
                                        if ($row_line["id_m_line"] == $id_m_line) {
                                            echo 'selected';
                                        }
                                    }
                                    ?>
                      >
            <?= $row_line["nama_line"] ?>
            </option>
          <?php }
                                ?>
        </select>--></td>
                            <td height="0" align="left" valign="middle" class="warning">Grade *)</td>
                            <td height="0" align="center" valign="middle">:</td>
                            <td height="0" colspan="4" valign="bottom">

                                <?php if ($action == 'edit') { ?>
                                    <script type="text/Javascript">
                                        change_grade(<?php echo $id_m_grade ?>);
                                    </script>
                                    <?php
                                }
                                ?>
                                <select name="cbo_grade" id="cbo_grade" class="combobox"
                                        onchange="change_grade(this.value)">
                                    <option value="0" selected="selected">- Pilih -</option>

                                    <?php while ($row_grade = mysql_fetch_assoc($qry_grade)) { ?>
                                        <option value="<?= $row_grade["id_m_grade"] ?>"
                                            <?php
                                            if (isset($id_m_grade)) {
                                                if ($row_grade["id_m_grade"] == $id_m_grade) {
                                                    echo 'selected';
                                                }
                                            }
                                            ?>
                                        >
                                            <?= $row_grade["nama_grade"] ?>
                                        </option>
                                    <?php }
                                    ?>
                                </select>
                                <?php
                                $total_berat_pk_m_group_matcode_bahan = total_berat_pk_m_group_matcode_bahan($id_tr_pk, $id_m_group);
                                if ($action == 'edit') {
                                    $tampung = '';

                                    $total_berat_pk_m_group_matcode_bahan = 0;
                                    $sql_bahan_tambahan =
                                        "
			SELECT bahan_tambahan,batch_no_tambahan,rolls_tambahan FROM tr_produksi_detail_bahan 
			WHERE id_tr_produksi_detail = '$id_tr_produksi_detail' and id_tr_bahan = 0
		";
//echo $sql_bahan_tambahan;
                                    $qry_bahan_tambahan = mysql_query($sql_bahan_tambahan) or die('ERROR select : ' . $sql_bahan_tambahan);
                                    while ($row_bahan_tambahan = mysql_fetch_assoc($qry_bahan_tambahan)) {
                                        $bahan_tambahan = $row_bahan_tambahan['bahan_tambahan'];
                                        $batch_no_tambahan = $row_bahan_tambahan['batch_no_tambahan'];
                                        $rolls_tambahan = $row_bahan_tambahan['rolls_tambahan'];
                                        $tampung = $tampung . "\n" . $bahan_tambahan . ";" . $batch_no_tambahan . ";" . $rolls_tambahan;
                                        $total_berat_pk_m_group_matcode_bahan = $total_berat_pk_m_group_matcode_bahan + hitung_berat($bahan_tambahan);


                                    }
                                    $tampung = str_replace(' ', '', $tampung);
                                } ?>


                            </td>
                        </tr>
                        <tr>
                            <td height="0" colspan="4" class="">
                                <div id="div_bahan_"></div>
                            </td>
                            <td height="0" align="center" valign="middle">&nbsp;</td>
                            <td height="1" colspan="4" rowspan="2" align="left" valign="top">
                                <div id="div_reason"></div>
                            </td>
                        </tr>
                        <tr>
                            <td height="-1" colspan="4" class="">
                                <div style="overflow:auto; width:ancho; height:200px;" id="div_bahan_tambahan"></div>
                            </td>
                            <td height="-1" align="center" valign="middle">&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="5%" height="14" valign="top" bgcolor="#FFFF00"></td>
                            <td align="center" bgcolor="#FFFF00"></td>
                            <td colspan="2" align="right" valign="" bgcolor="#FFFF00"><strong>Berat Bahan (Kg)
                                    : <?php echo number_format($total_berat_pk_m_group_matcode_bahan, 2) ?></strong>
                            </td>
                            <td align="center" valign="middle"></td>
                            <td colspan="4">
                            </td>
                        </tr>
                        <tr>
                            <td width="5%" class=""></td>
                            <td align="center"></td>
                            <td></td>
                            <td valign="middle"></td>
                            <td align="center" valign="middle"></td>
                            <td colspan="4" rowspan="2" valign="middle"></td>
                        </tr>
                        <tr>
                            <td width="5%" rowspan="2" valign="middle">Waktu Awal</td>
                            <td rowspan="2" align="center" valign="middle">:</td>
                            <td rowspan="2" valign="middle"><input name="text_tanggal_awal" value="<?= $tanggal_awal ?>"
                                                                   type="text" class="textbox_2" id="text_tanggal_awal"
                                                                   maxlength="40"/>
                                <select name="hour_from" class="combobox">
                                    <?php for ($i = 0; $i <= 23; $i++) { ?>
                                        <option value="<?= $i ?>"<?php
                                        if (isset($jam_awal)) {
                                            if ($i == $jam_awal) {
                                                echo(" selected=\"selected\"");
                                            }
                                        } ?>>
                                            <?= str_pad($i, 2, "0", STR_PAD_LEFT) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                :
                                <select name="minute_from" class="combobox">
                                    <?php for ($i = 0; $i <= 59; $i++) { ?>
                                        <option value="<?= $i ?>"<?php
                                        if (isset($menit_awal)) {
                                            if ($i == $menit_awal) {
                                                echo(" selected=\"selected\"");
                                            }
                                        }
                                        ?>>
                                            <?= str_pad($i, 2, "0", STR_PAD_LEFT) ?>
                                        </option>
                                    <?php } ?>
                                </select></td>
                            <td rowspan="2" align="left" valign="middle">Break Time <br/></td>
                            <td align="center" valign="middle"></td>
                        </tr>
                        <tr>
                            <td align="center" valign="middle">:</td>
                            <td colspan="4" align="left" valign="middle"><input name="text_break" type="text"
                                                                                class="textbox_angka" id="text_break"
                                                                                maxlength="10"
                                                                                value="<?php echo(isset($break_time) ? $break_time : "") ?>"
                                                                                onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"/>
                                Menit
                            </td>
                        </tr>
                        <tr>
                            <td width="5%" valign="middle">Waktu Akhir</td>
                            <td align="center" valign="middle">:</td>
                            <td valign="middle"><input name="text_tanggal_akhir" value="<?= $tanggal_akhir ?>"
                                                       type="text" class="textbox_2" id="text_tanggal_akhir"
                                                       maxlength="40"/>
                                <select name="hour_from2" class="combobox">
                                    <?php for ($i = 0; $i <= 23; $i++) { ?>
                                        <option value="<?= $i ?>"<?php if ($i == $jam_akhir) {
                                            echo(" selected=\"selected\"");
                                        } ?>>
                                            <?= str_pad($i, 2, "0", STR_PAD_LEFT) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                :
                                <select name="minute_from2" class="combobox">
                                    <?php for ($i = 0; $i <= 59; $i++) { ?>
                                        <option value="<?= $i ?>"<?php if ($i == $menit_akhir) {
                                            echo(" selected=\"selected\"");
                                        } ?>>
                                            <?= str_pad($i, 2, "0", STR_PAD_LEFT) ?>
                                        </option>
                                    <?php } ?>
                                </select></td>
                            <td align="left" valign="middle">Note</td>
                            <td align="center" valign="middle">:</td>
                            <td colspan="4" align="left" valign="middle"><textarea name="txt_keterangan" rows="3"
                                                                                   class="textarea_3"
                                                                                   id="ket2"><?php echo(isset($keterangan) ? $keterangan : "") ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td width="5%" valign="bottom">Packing :</td>
                            <td align="center">&nbsp;</td>
                            <td><input type="hidden" id="list_antrian" name="list_antrian"
                                       value="<?php echo $list_antrian ?>"/></td>
                            <td align="left" valign="baseline">&nbsp;</td>
                            <td align="center" valign="middle">&nbsp;</td>
                            <td colspan="4">&nbsp;</td>
                        </tr>
                    </table>
                    <table width="75%" align="center" class="body">
                        <tr>
                            <td colspan="9"><select id="cbo_packing" name="cbo_packing" class="combobox" onchange="">
                                    <option value="0" selected="selected"> - Pilih -</option>
                                    <?php while ($row_x = mysql_fetch_assoc($qry_x)) {

                                        $isi_value_packing = $row_x["id_m_packing_detail"];
                                        ?>
                                        <option value="<?= $isi_value_packing ?>"
                                            <?php
                                            if ($row_x["id_m_packing_detail"] == $id_m_packing_detail) {
                                                echo 'selected';
                                            }
                                            ?>
                                        >
                                            <?= trim($row_x["material_code1"]) . ' ' . 'bott: ' . trim($row_x["bottom_box"]) . ' top: ' . trim($row_x["top_box"]) . ' layer: ' . trim($row_x["layer"]) . ' pfoam: ' . trim($row_x["pe_foam"]) . ' cr_plug: ' . trim($row_x["core_plug"]) . ' ppr_core: ' . trim($row_x["paper_core"]) ?>
                                        </option>
                                    <?php }
                                    ?>
                                </select></td>
                        </tr>
                        <tr>
                            <td colspan="9"></td>
                        </tr>
                        <tr>
                            <td width="12%" align="center">

                            </td>
                            <td align="center">&nbsp;</td>
                            <td align="center">

                                <?php
                                $akses = get_akses($_SESSION['userid'], $txt_menuid);
                                /*echo 'akses : '. $akses .'<br>';
echo 'status_order : '. $status_order .'<br>';
echo 'action : '. $action .'<br>';
echo 'id_tr_order : '. $id_tr_order .'<br>';
*/
                                if ($action == 'add' and $status_order == '' and $nama_group_line != '' and ($akses == '11' or $akses == '111')) {
                                    ?>
                                    <!--     <input type="button" name="button_save" id="button_save" class="button" value="SAVE" onclick="cek_save_produksi(<?= $lemparan ?>)" />-->

                                <?php }
                                if ($action == 'edit' and $status_order == '' and ($akses == '11' or $akses == '111')) {
                                    // echo 'fff = ' .$lemparan_detail;
//$lemparan_detail = "'".$lemparan."'";

                                    $lemparan_detail = $id_tr_pk . '|' . $id_tr_order . '|' . $id_tr_produksi_detail . '|' . $order_no;
//echo $lemparan_detail;
                                    ?>
                                    <input type="button" name="button_save2" id="button_save2" class="button"
                                           value="UPDATE" onclick="edit_conf(<?= "'" . $lemparan_detail . "'" ?>)"/>
                                    <input type="button" name="button_save2" id="button_save2" class="button"
                                           value="CANCEL"
                                           onclick="cancel_produksi(<?= "'" . $lemparan_detail . "'" ?>)"/>

                                <?php } ?>
                            </td>
                            <td align="center">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                        </tr>
                    </table>
                    <table width="73%" border="1" align="left" cellpadding="0" cellspacing="0">
                        <tr class="table_header">
                            <td width="3%" rowspan="2">No</td>
                            <td width="4%" rowspan="2">Shift</td>
                            <td width="4%" rowspan="2" align="center">No Mesin<br/>LotNo</td>
                            <td width="3%" rowspan="2">Counter</td>
                            <td width="3%" rowspan="2">Mesin Time</td>
                            <td width="14%" rowspan="2" align="center">Waktu</td>
                            <td width="2%" rowspan="2" align="center"> Selisih<br/>Waktu</td>
                            <td width="3%" colspan="5" align="center">Material Bahan</td>
                            <td width="4%" rowspan="2" align="center">Batch No Hasil</td>
                            <td width="4%" rowspan="2" align="center">Material Hasil</td>
                            <td width="4%" rowspan="2" align="center">Berat (Kg)</td>
                            <td colspan="5" align="center">Grade (Roll)</td>
                            <td width="3%" rowspan="2" align="center">Reason</td>
                            <td width="3%" rowspan="2" align="center">Total Berat By BOM (Kg)</td>
                            <td width="2%" rowspan="2" align="center"><strong>W.<br/></strong>EdTr<br/>
                                CutSht
                            </td>
                            <td width="1%" rowspan="2" align="center"><strong>Break</strong></strong><br/>
                                (Mnt)
                            </td>
                            <td width="1%" rowspan="2" align="center">Labour</td>
                            <td width="7%" rowspan="2" align="center">Note</td>
                            <td colspan="2" rowspan="2" align="center">ACT</td>
                        </tr>
                        <tr class="table_header">
                            <td width="1%" align="center">Batch no</td>
                            <td width="2%" align="center">MatCode</td>
                            <td width="1%" align="center">Berat</td>
                            <td width="2%" align="center">Actual Berat</td>
                            <td width="3%" align="center">Sisa</td>
                            <td width="3%" align="center">A</td>
                            <td width="3%" align="center">B</td>
                            <td width="3%" align="center">I</td>
                            <td width="3%" align="center">R</td>
                            <td width="3%" align="center">RC</td>
                        </tr>
                        <?php
                        $sql =
                            "
          SELECT a.*, b.nama_shift, c.nama_line
          FROM tr_produksi_detail a
		  INNER JOIN m_shift b on a.id_m_shift = b.id_m_shift
		  INNER JOIN m_line c on a.id_m_line = c.id_m_line
          WHERE id_tr_order = '$id_tr_order'
          ";

                        $sql =
                            "
		SELECT a.*, b.nama_shift, c.nama_line ,matcode_bahan,
		matcode_hasil, timediff(waktu_akhir, waktu_awal) as sel,nama_group_shift,nama_grade,a.qty,nama_reason,
		a.counter_awal, a.counter_akhir,a.keterangan,a.userid_created, a.userid_modified, a.keterangan_reject,
		(TIMESTAMPDIFF(SECOND,waktu_awal,waktu_akhir)) AS time_diff,
			(CASE WHEN a.id_m_grade = 1 THEN qty ELSE 0 END) as jum_a,
			(CASE WHEN a.id_m_grade = 2 THEN qty ELSE 0 END) as jum_b,
			(CASE WHEN a.id_m_grade = 3 THEN qty ELSE 0 END) as jum_i,
			(CASE WHEN a.id_m_grade = 4 THEN qty ELSE 0 END) as jum_r,
			(CASE WHEN a.id_m_grade = 5 THEN qty ELSE 0 END) as jum_rc,
		a.waste_edge, a.waste_reclaime, a.break_time, a.machine_time, a.lot
		FROM tr_produksi_detail a 
		LEFT JOIN m_shift b on a.id_m_shift = b.id_m_shift 
		LEFT JOIN m_line c on a.id_m_line = c.id_m_line 
		LEFT JOIN m_group_shift d on a.id_m_group_shift = d.id_m_group_shift
		LEFT JOIN m_grade f on a.id_m_grade = f.id_m_grade
		LEFT JOIN m_reason g on a.id_m_reason = g.id_m_reason 
		
		WHERE a.id_tr_order = '$id_tr_order'
ORDER BY id_tr_produksi_detail 
		";

                        $qry_show = mysql_query($sql) or die('ERROR select : ' . $sql);
                        //  echo $sql;
                        $jumlah_data = mysql_num_rows($qry_show);

                        $i = 0;
                        //echo $sql_show;
                        $total = '00:00:00';
                        $total_waktu = '00:00:00';
                        $total_time_diff = '00:00:00';
                        $total_waste_edge = 0;
                        $total_waste_reclaime = 0;
                        $total_machine_time = 0;
                        $total_labour = 0;
                        $total_berat_hasil = 0;
                        $total_break_time = 0;
                        $total_a = 0;
                        $total_b = 0;
                        $total_i = 0;
                        $total_r = 0;
                        $total_rc = 0;
                        $i = 0;
                        $berat_hasil = 0;
                        while ($row = mysql_fetch_array($qry_show)){
                        $i++;
                        $hasil = '';
                        $id_tr_order = $row['id_tr_order'];
                        $id_tr_produksi_detail = $row['id_tr_produksi_detail'];
                        $lemparan_detail = $id_tr_pk . '|' . $id_tr_order . '|' . $id_tr_produksi_detail;
                        //$lemparan = $id_tr_produksi_detail;
                        $sql_2 = "SELECT lot FROM tr_produksi_detail_bahan WHERE id_tr_produksi_detail = '$id_tr_produksi_detail' and lot <> '' ORDER BY id_tr_produksi_detail_bahan LIMIT 1 ";
                        $qry_lot = mysql_query($sql_2) or die('ERROR select : ' . $sql_2);
                        while ($row_lot = mysql_fetch_array($qry_lot)) {
                            $lot = $row_lot['lot'];
                        }
                        $lemparan_detail = "'" . $lemparan_detail . "'";
                        $order_no = (isset($row['order_no']) ? $row['order_no'] : '');
                        $nama_shift = $row['nama_shift'];
                        $nama_line = $row['nama_line'];
                        $id_m_shift = $row['id_m_shift'];
                        $nama_group_shift = $row['nama_group_shift'];
                        $nama_reason = $row['nama_reason'];
                        $id_m_line = $row['id_m_line'];

                        $nama_grade = $row['nama_grade'];
                        $qty = $row['qty'];
                        $counter_awal = $row['counter_awal'];
                        $counter_akhir = $row['counter_akhir'];
                        $machine_time = $row['machine_time'];
                        $keterangan = $row['keterangan'];
                        $keterangan_reject = $row['keterangan_reject'];
                        //$lot = $row['lot'];
                        $userid_created = $row['userid_created'];
                        $userid_modified = trim($row['userid_modified']);
                        $date_created = $row['date_created'];
                        $date_modified = trim($row['date_modified']);
                        if ($userid_modified != '') {
                            $userid = $userid_modified;
                        } else {
                            $userid = $userid_created;
                        }
                        $tampil_nama = pilih_satu_nama($userid_created, $userid_modified);
                        $tampil_tgl = pilih_satu_tgl($date_created, $date_modified);
                        $waktu_awal = $row['waktu_awal'];
                        $waktu_akhir = $row['waktu_akhir'];
                        $batch_no_hasil = (isset($row['batch_no_hasil']) ? $row['batch_no_hasil'] : '');
                        $matcode_hasil = $row['matcode_hasil'];
                        $matcode_bahan = (isset($row['matcode_bahan']) ? $row['matcode_bahan'] : '');
//                        $sel = isset($row['sel']) ? $row['sel'] : '00:00:00';
                        $sel = $row['sel'];
                        $total_waktu = sum_the_time($total_waktu, $sel);

                        $jum_a = (isset($row['jum_a']) ? $row['jum_a'] : 0);
                        $jum_b = (isset($row['jum_b']) ? $row['jum_b'] : 0);
                        $jum_i = (isset($row['jum_i']) ? $row['jum_i'] : 0);
                        $jum_r = (isset($row['jum_r']) ? $row['jum_r'] : 0);
                        $jum_rc = (isset($row['jum_rc']) ? $row['jum_rc'] : 0);

                        $total_a = $total_a + $jum_a;
                        $total_b = $total_b + $jum_b;
                        $total_i = $total_i + $jum_i;
                        $total_r = $total_r + $jum_r;
                        $total_rc = $total_rc + $jum_rc;
                        $time_diff = $row['time_diff'];
                        $total_time_diff = $total_time_diff + $time_diff;
                        $waste_edge = $row['waste_edge'];
                        $waste_reclaime = $row['waste_reclaime'];
                        $break_time = $row['break_time'];

                        $labour = hitung_labour(0, $id_tr_produksi_detail);

                        $total_waste_edge = $total_waste_edge + $waste_edge;
                        $total_waste_reclaime = $total_waste_reclaime + $waste_reclaime;
                        $total_break_time = $total_break_time + $break_time;
                        $total_machine_time = $total_machine_time + $machine_time;
                        $total_labour = $total_labour + $labour;
                        //$berat_hasil = hitung_berat($matcode_hasil)*1.05*$qty;
                        $berat_hasil = total_berat_per_tr_produksi_detail($id_tr_produksi_detail);
                        $total_berat_hasil = $total_berat_hasil + $berat_hasil;

                        $status = $row['status'];
                        $waste_order = (isset($row['waste_order']) ? $row['waste_order'] : '');
                        //$batch_no_tambahan ='';

                        $sql_bahan = " SELECT a.*,
			    c.lot, c.lebar, c.panjang, c.matcode,  
				c.`type`,c.cs, c.jb,c.berat, c.batch_no, c.rack
			   FROM tr_produksi_detail_bahan a 
			   INNER JOIN tr_bahan b  on a.id_tr_bahan = b.id_tr_bahan
			   INNER JOIN m_schedule_detail c on b.id_m_schedule_detail = c.id_m_schedule_detail 	
			   WHERE id_tr_produksi_detail = '$id_tr_produksi_detail' ";

                        /*$qry_bahan = mysql_query($sql_bahan) or die('ERROR select : '.$sql_bahan);
      // echo $sql_bahan;
                while($row_bahan = mysql_fetch_array($qry_bahan))
				{
					$id_tr_bahan = $row_bahan['id_tr_bahan'];
					$lebar = $row_bahan['lebar'];
					$rack = $row_bahan['rack'];

					$panjang = $row_bahan['panjang'];
					$matcode = $row_bahan['matcode'];
					//$batch_no_tambahan = $row_bahan['batch_no_tambahan'];
					$hasil = matcode_2($matcode,$rack,$id_jenis,$lebar,$panjang) .'<br>'. $hasil;

				}*/
                        $tampung = '';

                        $list = '';
                        $list1 = '';
                        $list2 = '';
                        $list2b = '';
                        $list3 = '';
                        $list_sisa = "";
                        $sql_bahan_tambahan =
                            "
			SELECT bahan_tambahan,batch_no_tambahan,berat, px.total_berat FROM tr_produksi_detail_bahan a
LEFT JOIN 
(SELECT id_tr_produksi_detail, sum(berat) as total_berat FROM  tr_produksi_detail_bahan GROUP BY id_tr_produksi_detail) as px on px.id_tr_produksi_detail = a.id_tr_produksi_detail 
			WHERE a.id_tr_produksi_detail = '$id_tr_produksi_detail' ORDER BY a.id_tr_produksi_detail_bahan
		";
                        //	echo $sql_bahan_tambahan;

                        //	$qry_bahan_tambahan = mysql_query($sql_bahan_tambahan) or die('ERROR select : '.$sql_bahan_tambahan);

                        $sql_bahan_tambahan =
                            "
			SELECT bahan_tambahan,batch_no_tambahan,berat FROM tr_produksi_detail_bahan a
			WHERE a.id_tr_produksi_detail = '$id_tr_produksi_detail' ORDER BY a.id_tr_produksi_detail_bahan
		";
                        $qry_bahan_tambahan = mysql_query($sql_bahan_tambahan) or die('ERROR select : ' . $sql_bahan_tambahan);
                        $list_table = ' <table width="100%" border="1"  cellpadding="0" cellspacing="0" border="0" > 
						<tr class="">
 								<td align="left">Batch No</td>
							  <td align="left">Material Code</td>
							  <td align="right">Berat(Kg)</td>
							</tr>
';
                        $list_table = ' <table width="100%" border="0"  cellpadding="0" cellspacing="0" border="0" >';

                        $list_table1 = ' <table width="100%" border="1"  cellpadding="0" cellspacing="0" border="0" ><tr class=""><td align="left">Batch No</td></tr>';
                        $list_table2 = ' <table width="100%" border="1"  cellpadding="0" cellspacing="0" border="0" ><tr class=""><td align="left">Material Code</td></tr>';
                        $list_table3 = ' <table width="100%" border="1"  cellpadding="0" cellspacing="0" border="0" ><tr class=""><td align="left">Berat(Kg)</td></tr>';
                        $j = 0;
                        while ($row_bahan_tambahan = mysql_fetch_assoc($qry_bahan_tambahan)) {
                            $j++;
                            $bahan_tambahan = $row_bahan_tambahan['bahan_tambahan'];
                            $batch_no_tambahan = $row_bahan_tambahan['batch_no_tambahan'];
                            $berat = $row_bahan_tambahan['berat'];
                            $sql_2 = " SELECT sum(berat) as total_berat FROM  tr_produksi_detail_bahan 
WHERE id_tr_produksi_detail = '$id_tr_produksi_detail'  GROUP BY id_tr_produksi_detail";
                            $qry_2 = mysql_query($sql_2) or die('ERROR select : ' . $sql_2);
                            while ($row_2 = mysql_fetch_assoc($qry_2)) {
                                $total_berat = $row_2['total_berat'];

                            }

                            //$total_berat = $row_bahan_tambahan['total_berat'];

                            if (($berat == '')) {
                                $berat = hitung_berat($bahan_tambahan);
                            }

                            /*$list .=
						'	<tr >
 								<td align="left">'.$batch_no_tambahan.'</td>
							  <td align="left">'.$bahan_tambahan.'</td>
							  <td align="right">'.number_format($berat,2).'</td>
							</tr>
						';*/
                            $list1 .= '<tr ><td align="left">' . $batch_no_tambahan . '</td></tr>';
                            $list2 .= '<tr ><td align="left">' . $bahan_tambahan . '</td></tr>';
                            //$list2b .='<tr ><td align="left">'.number_format($berat/$total_berat * $berat_hasil,2).'</td></tr>';

                            $list3 .= '<tr ><td align="right">' . number_format($berat, 2) . '</td></tr>';
                            $xxx = $total_berat * $berat_hasil;
                            if ($total_berat * $berat_hasil != 0) {
                                $list_sisa .= '<tr ><td align="right">' . number_format($berat - ($berat / $total_berat * $berat_hasil), 2) . '</td></tr>';
                                $list2b .= '<tr ><td align="left">' . number_format($berat / $total_berat * $berat_hasil, 2) . '</td></tr>';
                            } else {
                                $list_sisa .= '<tr ><td align="right">' . number_format($berat, 2) . '</td></tr>';
                                $list2b .= '<tr ><td align="left">' . number_format($berat, 2) . '</td></tr>';
                            }


                        }
                        $list_tutup = ' </table>';
                        $list = $list_table . $list . $list_tutup;
                        $list1 = $list_table . $list1 . $list_tutup;
                        $list2 = $list_table . $list2 . $list_tutup;
                        $list2b = $list_table . $list2b . $list_tutup;
                        $list3 = $list_table . $list3 . $list_tutup;
                        $list_sisa = $list_table . $list_sisa . $list_tutup;

                        if ($i % 2 == 0) {
                            $cls = 'table_row_odd';
                        } else {
                            $cls = 'table_row_even';
                        }
                        //  $berat_hasil ='1000';
                        ?>
                        <tr class="<?php if ($i % 2 == 0) {
                            echo("table_row_even");
                        } else {
                            echo("table_row_odd");
                        } ?>">
                            <td width="3%" align="center"><?= $id_tr_produksi_detail ?></td>
                            <td width="4%" align="center"><?= $nama_shift . ' ' . $nama_group_shift ?></td>
                            <td width="4%" align="center"><?= $nama_line ?><br/><?= $lot ?></td>
                            <td width="3%" align="right" class=""> <?= $counter_awal . '&nbsp;<br>' . $counter_akhir ?>
                                &nbsp;
                            </td>
                            <td width="3%" align="right"><?= cek_kosong($machine_time, 2) ?>&nbsp;</td>
                            <td width="14%" align="center">
                                <?= convDate(substr($waktu_awal, 0, 10), '-', '1') . ' ' . substr($waktu_awal, 11, 5) ?>
                                <br/>
                                <?= convDate(substr($waktu_akhir, 0, 10), '-', '1') . ' ' . substr($waktu_akhir, 11, 5) ?>
                            </td>
                            <td width="2%" align="center"><?= substr($sel, 0, 5) ?></td>
                            <td width="0%" align="left"><?= $list1 ?></td>
                            <td width="0%" align="left"><?= $list2 ?></td>
                            <td width="0%" align="left"><?= $list2b ?></td>
                            <td width="0%" align="left"><?= $list3 ?></td>
                            <td width="3%" align="left"><?= $list_sisa ?></td>

                            <?php
                            $batch_no = '';
                            $sql_batch = "SELECT batch_no FROM tr_produksi_detail_batch_no WHERE id_tr_produksi_detail = '$id_tr_produksi_detail' LIMIT 1";
                            $qry_batch = mysql_query($sql_batch) or die('ERROR select : ' . $sql_batch);
                            while ($row_batch = mysql_fetch_assoc($qry_batch)) {
                                $batch_no = trim($row_batch['batch_no']);
                            }
                            if ($batch_no == '') {
                                $tampil_batchno = '<td width="4%" align="center"><strong><font color="#FF0000">NOT FOUND</font></strong></td>';
                            } else {
                                $tampil_batchno = '<td width="4%" align="center">' . $batch_no . '</td>';
                            }
                            echo $tampil_batchno;
                            ?>
                            <td width="4%" align="center"><?= $matcode_hasil ?></td>
                            <td width="4%" align="center"><?= hitung_berat($matcode_hasil) ?></td>
                            <td width="3%" align="center"><?= cek_angka_kosong($jum_a, 0) ?></td>
                            <td width="3%" align="center"><?= cek_angka_kosong($jum_b, 0) ?></td>
                            <td width="3%" align="center"><?= cek_angka_kosong($jum_i, 0) ?></td>
                            <td width="3%" align="center"><?= cek_angka_kosong($jum_r, 0) ?></td>
                            <td width="3%" align="center"><?= cek_angka_kosong($jum_rc, 0) ?></td>
                            <td width="3%" align="left"><?= ($nama_reason) . '<br>' . $keterangan_reject ?></td>
                            <td width="3%" align="right"><?= number_format($berat_hasil, 2) ?></td>
                            <td width="2%"
                                align="right"><?= cek_kosong($waste_edge, 2) . '<br>' . cek_kosong($waste_reclaime, 2) ?></td>
                            <td width="1%" align="right"><?= cek_kosong($break_time, 0) ?></td>
                            <td width="1%" align="right"><?= cek_kosong($labour, 2) ?>  </td>
                            <td width="7%" align="center"><?= ($keterangan) ?></td>
                            <td colspan="2" align="center" valign="middle">

                                <?php
                                //echo $_SESSION['userid'].' '. $txt_menuid. '<br>';
                                //echo $txt_menuid ;
                                $akses = get_akses($_SESSION['userid'], $txt_menuid);
                                //echo  $akses;
                                echo $tampil_nama . '<br>' . $tampil_tgl;

                                /*echo 'session_user : '.$_SESSION['userid'].'<br>';
echo 'txt_menuid : ' .$txt_menuid .'<br>';
echo 'akses : ' .$akses.'<br>';
echo 'status_order : ' .$status_order.'<br>';
echo 'machine_time : ' .$machine_time.'<br>';*/

                                // if  ($status_order != 't' and trim($machine_time) == '' )
                                {
//echo $userid_created; //. ' '.	$akses;
                                    if ($userid_created == $_SESSION['userid'] or $akses == '11') { //echo 'xxxxx'.$akses
                                        ?>
                                        <a onclick="edit_data_detail(<?= $lemparan_detail ?>)"><img
                                                    src="../images/icons/edit_data.png" alt="edit" border="0"
                                                    title="Edit"/></a>&nbsp;<a
                                                onclick="delete_detail_conf(<?= $lemparan_detail ?>)"><img
                                                    src="../images/icons/del_data.png" alt="del" border="0"
                                                    title="Del"/></a>
                                    <?php }
                                } ?>
                                <?php (isset($userid_) ? $userid_ : '') ?>

                            </td>
                            <?php }
                            ?>
                        </tr>
                        <tr class="<?= $clsx ?>">
                            <td colspan="4" align="center">TOTAL</td>
                            <td align="right"><?= cek_angka_kosong((isset($total_machine_time) ? $total_machine_time : 0), 2) ?>
                                &nbsp;
                            </td>
                            <td align="center"><?= waktu((isset($total_time_diff) ? $total_time_diff : 0)) . ' H' ?></td>
                            <td align="center"><?= (isset($total_waktu) ? $total_waktu : '00:00') ?></td>
                            <td colspan="5" align="center"></td>
                            <td colspan="2" align="center"></td>
                            <td width="4%" align="center">&nbsp;</td>
                            <td width="3%"
                                align="center"><?= cek_angka_kosong((isset($total_a) ? $total_a : 0), 0) ?></td>
                            <td width="3%"
                                align="center"><?= cek_angka_kosong((isset($total_b) ? $total_b : 0), 0) ?></td>
                            <td width="3%"
                                align="center"><?= cek_angka_kosong((isset($total_i) ? $total_i : 0), 0) ?></td>
                            <td width="3%"
                                align="center"><?= cek_angka_kosong((isset($total_r) ? $total_r : 0), 0) ?></td>
                            <td width="3%"
                                align="center"><?= cek_angka_kosong((isset($total_rc) ? $total_rc : 0), 0) ?></td>
                            <td width="3%" align="right">&nbsp;</td>
                            <td width="3%"
                                align="right"><?= number_format((isset($total_berat_hasil) ? $total_berat_hasil : 0), 2) ?></td>
                            <td align="right"><?= number_format((isset($total_waste_edge) ? $total_waste_edge : 0), 2) . '<br>' . number_format((isset($total_waste_reclaime) ? $total_waste_reclaime : 0), 2) ?> </td>
                            <td width="1%"
                                align="right"><?= cek_angka_kosong((isset($total_break_time) ? $total_break_time : 0), 0) ?> </td>
                            <td align="right"><?= number_format((isset($total_labour) ? $total_labour : 0), 2) ?></td>
                            <td align="center" colspan="1"></td>
                            <td width="6%" align="right">&nbsp;</td>

                        </tr>
                    </table>
                </td>
            </tr>
        </table>


    </form>
<?php }

function show_table()
{

    ?>
    <table width="100%" cellpadding="0" cellspacing="0" border="1">

        <tr class="table_header">
            <td width="2%" rowspan="2">No</td>
            <td rowspan="2" align="center">Tanggal<br/>
                Mat Code <br/>
                Ty Stock
            </td>
            <td colspan="1" align="center">Produksi</td>
            <!-- <td width="2%" rowspan="2" align="center">fgd</td>-->
        </tr>
        <tr class="table_header">
            <td align="center">&nbsp;</td>
        </tr>
        <?php

        if (isset($_REQUEST['offset'])) $offset = $_REQUEST['offset']; else $offset = 0;

        if (!isset($_REQUEST['input_search'])) $input_search = ""; else $input_search = $_REQUEST['input_search'];
        //	$input_search = $_REQUEST['input_search'];
        $input_search = str_replace('8764346466435364647768799667654537543756', ' ', $input_search);
        if (!isset($_REQUEST['cbo_orderby'])) $cbo_orderby = ""; else $cbo_orderby = $_REQUEST['cbo_orderby'];
        //	$cbo_orderby = $_REQUEST['cbo_orderby'];
        $txt_sembunyi = $_REQUEST['txt_sembunyi'];
        $periode = $_REQUEST['periode'];
        $txt_menuid = $_REQUEST['txt_menuid'];
        $cbo_program = $_REQUEST['cbo_program'];
        $id_m_line = $_REQUEST['id_m_line'];


        /*echo 'offset  '.$offset .'<br>';
echo 'cbo_orderby  '.$cbo_orderby .'<br>';
echo 'txt_sembunyi  '.$txt_sembunyi .'<br>';
echo 'periode  '.$periode .'<br>';
echo 'txt_menuid  '.$txt_menuid .'<br>';
echo 'cbo_program  '.$cbo_program .'<br>';
echo 'id_m_line  '.$id_m_line .'<br>';
*/

        $usernya = $_SESSION['userid'];
        $sql_akses = "SELECT akses FROM usermenu1 WHERE userid = '$usernya' and menuid = '$txt_menuid'";
        //echo 'sql_akses : ' .$sql_akses;
        $qry_akses = mysql_query($sql_akses) or die('ERROR select : ' . $sql_akses);
        while ($row_akses = mysql_fetch_array($qry_akses)) {
            $akses = $row_akses['akses'];
        }

        //echo('OK akses = '.$akses);
        if ($txt_sembunyi != '') {
            //die($txt_sembunyi);
            $txt_sembunyi = explode("|", $txt_sembunyi);
            $where_status = "";
            $status = $txt_sembunyi[0];
            if ($status == '1') {
                $where_status = " AND a.status = 't' ";
            } elseif ($status == '2') {
                $where_status = " AND (a.status  = 'f'  or a.status is null)";
            }


        }

        $where = " WHERE periode = '$periode' $where_status";
        // echo $where;
        $where_program = "";
        $where_m_line = "";
        $where_m_line_order_no = "";
        if ($input_search != '') {
        }

        if ($cbo_program != '0') {
            $where_program = " and id_sliter =  '$cbo_program' ";
        }
        $where = $where . $where_program;

        if ($id_m_line != '0') {
            $where_m_line = " AND id_tr_pk in (
				SELECT b.id_tr_pk FROM tr_order a
				INNER JOIN tr_bahan b on a.id_tr_bahan = b.id_tr_bahan
				INNER JOIN tr_pk c on b.id_tr_pk =  c.id_tr_pk
				WHERE a.id_m_line =  '$id_m_line' 
				)";
            $where_m_line_order_no = " AND c.id_m_line =  '$id_m_line' ";

        }
        $where = $where . $where_m_line;

        if ($cbo_orderby == '1') {
            $orderby = "ORDER BY a.date_modified desc,d.nama_komponen,b.nama_sub_komponen,a.id_tr_pk";
        } else if ($cbo_orderby == '0') {
            $orderby = " ORDER BY d.nama_komponen,b.nama_sub_komponen,a.nama_kegiatan,a.date_modified DESC,a.id_tr_pk";
        } else {
            $orderby = " ORDER BY d.nama_komponen,b.nama_sub_komponen,a.nama_kegiatan,a.date_modified DESC,a.id_tr_pk";

        }
        $i = 0;
        $limit = 20;

        $sql_show = "SELECT a.*, b.nama_type_stock from tr_pk a 
					 LEFT JOIN m_type_stock b on a.id_m_type_stock = b.id_m_type_stock
					 
                     $where  ORDER BY a.id_tr_pk DESC ";

        $sql_data = $sql_show . " LIMIT $limit OFFSET $offset";

        // echo $sql_data .'<br>';
        //echo $where;
        $qry_data = mysql_query($sql_data) or die('ERROR select kegiatan: ' . $sql_data);
        $qry_show = mysql_query($sql_show) or die('ERROR select kegiatan: ' . $sql_show);

        $jumlah_data = mysql_num_rows($qry_show);
        if ($jumlah_data == 0) {
            echo " No data";
        }

        //    echo $sql_show;
        while ($row_sel_kegiatan = mysql_fetch_array($qry_data)) {
            $i++;
            $total_jumlah_digunakan = 0;
            $total_jumlah_packing = 0;
            $total_jumlah_customer1 = 0;

            $id_tr_pk = $row_sel_kegiatan['id_tr_pk'];
            $periode = $row_sel_kegiatan['periode'];
            $tanggal = $row_sel_kegiatan['tanggal'];
            $no_rps = $row_sel_kegiatan['no_rps'];
            $matcode = $row_sel_kegiatan['matcode'];
            $id_jenis = $row_sel_kegiatan['id_jenis'];
            $id_slitter = $row_sel_kegiatan['id_sliter'];
            $id_corona = $row_sel_kegiatan['id_corona'];
            $id_heat_seal = $row_sel_kegiatan['id_heat_seal'];
            $status = $row_sel_kegiatan['status'];
            $nama_type_stock = $row_sel_kegiatan['nama_type_stock'];

            $keterangan = $row_sel_kegiatan['keterangan'];
            $alasan_cancel = $row_sel_kegiatan['alasan_cancel'];
            if (!isset($row_sel_kegiatan['jumlah_history'])) $jumlah_history = 0; else $jumlah_history = $row_sel_kegiatan['jumlah_history'];
            //  $jumlah_history  = $row_sel_kegiatan['jumlah_history'];
            if (!isset($row_sel_kegiatan['jumlah_sub'])) $jumlah_sub = 0; else $jumlah_sub = $row_sel_kegiatan['jumlah_sub'];
            //  $jumlah_sub  = $row_sel_kegiatan['jumlah_sub'];
            $userid_approved = $row_sel_kegiatan['userid_approved'];

            $catatan_produksi = $row_sel_kegiatan['catatan_produksi'];
            $userid_produksi = $row_sel_kegiatan['userid_produksi'];
            $date_produksi = $row_sel_kegiatan['date_produksi'];
            $date_produksi = convDate(substr($date_produksi, 0, 10), '-', '1') . ' ' . substr($date_produksi, 11, 5);
//$date_produksi = convDate($date_produksi,'-','1')  . ' '. substr($date_produksi,11,5) ;


            $date_approved = $row_sel_kegiatan['date_approved'];
            $date_approved = convDate(substr($date_approved, 0, 10), '-', '2') . ' ' . substr($date_approved, 11, 5);
            $userid_modified = $row_sel_kegiatan['userid_modified'];
            $date_modified = $row_sel_kegiatan['date_modified'];
            $date_modified = convDate(substr($date_modified, 0, 10), '-', '1') . '  ' . substr($date_modified, 11, 5);


            if ($id_jenis == 'i') {
                $jenis = 'INTERMEDIATE';
            } elseif ($id_jenis == 'f') {
                $jenis = 'FINISH GOOD';
            } else {
                $jenis = '-';
            }

            if ($id_slitter == 's') {
                $slitter = 'SLITTER';
            } elseif ($id_slitter == 'r') {
                $slitter = 'RESLITTER';
            } else {
                $slitter = '-';
            }

            if ($id_corona == 'i') {
                $corona = 'CORONA - IN';
            } elseif ($id_corona == 'o') {
                $corona = 'CORONA - OUT';
            } elseif ($id_corona == 'b') {
                $corona = 'CORONA - BOTH';
            } else {
                $corona = '-';
            }
            if ($id_heat_seal == 'i') {
                $heat_seal = 'HEAT SEAL - IN';
            } elseif ($id_heat_seal == 'o') {
                $heat_seal = 'HEAT SEAL - OUT';
            } elseif ($id_heat_seal == 'b') {
                $heat_seal = 'HEAT SEAL - BOTH';
            } else {
                $heat_seal = '-';
            }


            if ($i % 2 == 0) {
                $cls = 'table_row_odd';
            } else {
                $cls = 'table_row_even';
            }
            if ($offset != 0) {
                $no = ($offset + $i);
            } else {
                //$no =  $i;
                $no = ($offset + $i);
            }
            ?>
            <tr class="<?= $cls ?>">

                <td width="2%" align="center"><?= $no ?></td>
                <td width="3%" align="center"><a target="_blank"
                                                 href="../template/index_form_perintah_kerja.php?id_tr_pk=<?php echo $id_tr_pk ?>">
                        <?= tampilan_no_rps($id_tr_pk) ?>
                    </a>
                    <br/> <?= convDate($tanggal, '-', '1') . '<br>' . $matcode . '<br>' . $nama_type_stock . '<br>' . $jenis ?>
                    <?php

                    $link_catatan_produksi = '';
                    if ($catatan_produksi != '') {
                        $link_catatan_produksi = '<a title= " ' . $date_produksi . ', ' . $userid_produksi . ' : ' . $catatan_produksi . '" >' . substr($catatan_produksi, 0, 12) . ' ...' . '</a>';

                    }


                    if ($catatan_produksi == '' and $akses == '11') {
                        if (!isset($xxxbatch_no)) $xxxbatch_no = "";
//	$link_catatan_produksi ='<a title= " Input Note" > +</a>';
                        $lemparan_produksi = "'" . $id_tr_pk . '^' . $offset . '^' . $no_rps . "'";
                        $link_catatan_produksi = '<a title= " Input Note++" onclick=" input_note_produksi(' . $lemparan_produksi . ')">+' . ($xxxbatch_no) . '</a>';
                    }
                    if ($catatan_produksi != '' and $akses == '11') {
//	$link_catatan_produksi ='<a title= " Input Note" > +</a>';

                        $lemparan_produksi = "'" . $id_tr_pk . '^' . $offset . '^' . $no_rps . "'";
                        $link_catatan_produksi = '<a title= " ' . $date_produksi . ', ' . $userid_produksi . ' : ' . $catatan_produksi . '" onclick=" input_note_produksi(' . $lemparan_produksi . ')">' . substr($catatan_produksi, 0, 12) . ' ...' . '</a>';
                    }


                    echo $link_catatan_produksi;
                    ?>

                </td>
                <td colspan="2" align="left">
                    <?php

                    $sql_x = "
			";

                    $sql_x =
                        "
SELECT  b.matcode as matcode_bahan_awal, b.lot, b.lebar as lebar_bahan, b.panjang as panjang_bahan, 
			(select count(*) FROM tr_order WHERE id_tr_bahan = a.id_tr_bahan ) as jumlah_digunakan, 
			c.order_no,b.batch_no,c.jumlah as qty_order, c.id_tr_order,c.lebar as lebar_order,
			
			sum(qty),SUM(TIMESTAMPDIFF(SECOND,d.waktu_awal,d.waktu_akhir)) AS time_diff,
			SUM(CASE WHEN id_m_grade = 1 THEN qty ELSE 0 END) as jum_a,
			SUM(CASE WHEN id_m_grade = 2 THEN qty ELSE 0 END) as jum_b,
			SUM(CASE WHEN id_m_grade = 3 THEN qty ELSE 0 END) as jum_i,
			SUM(CASE WHEN id_m_grade = 4 THEN qty ELSE 0 END) as jum_r,
			SUM(CASE WHEN id_m_grade = 5 THEN qty ELSE 0 END) as jum_rc,
			sum(waste_edge) as waste_edge, sum(waste_reclaime) as waste_reclaime, 
			sum(break_time) as break_time, sum(machine_time) as machine_time,
			--(SELECT COUNT(*) FROM tr_produksi_detail_batch_no WHERE id_tr_order = c.id_tr_order) as jum_batch
			FROM tr_bahan a 
			INNER JOIN m_schedule_detail b on a.id_m_schedule_detail = b.id_m_schedule_detail
			LEFT JOIN tr_order c on c.id_tr_bahan = a.id_tr_bahan
			LEFT JOIN tr_produksi_detail d on d.id_tr_order = c.id_tr_order
			WHERE a.id_tr_pk = '$id_tr_pk'
			GROUP BY 
			b.matcode , b.lot, b.lebar , b.panjang ,b.batch_no,c.order_no,c.id_tr_order
			 
			ORDER BY d.id_tr_order,d.id_m_grade, b.lot, b.lebar, b.panjang, c.id_tr_order
";
                    $sql_x = "
SELECT a.id_tr_bahan,  e.id_m_group,e.nama_group,  b.lebar as lebar_bahan,
			(select count(*) FROM tr_order WHERE id_tr_bahan = a.id_tr_bahan ) as jumlah_digunakanX, 
			(SELECT COUNT(*) FROM tr_bahan	ab WHERE ab.id_tr_pk =  '$id_tr_pk' AND ab.id_m_group = e.id_m_group) as jumlah_digunakan_,
			
			(SELECT COUNT(*) FROM tr_bahan ab 
			 LEFT JOIN tr_order ax on ax.id_tr_bahan = ab.id_tr_bahan
			 WHERE ab.id_tr_pk =  '$id_tr_pk'  AND ax.id_m_line = c.id_m_line
			 AND ab.id_m_group = e.id_m_group
			 GROUP BY ab.id_m_group)  as jumlah_digunakan,
			 
			c.order_no,b.batch_no,c.jumlah as qty_order, c.id_tr_order,c.status as status_order, 
			c.lebar as lebar_order,c.alasan_cancel,c.userid_modified as user_cancel,c.date_modified as date_cancel,
			sum(qty) as jml_batch_no___x,SUM(TIMESTAMPDIFF(SECOND,d.waktu_awal,d.waktu_akhir)) AS time_diff,
			SUM(CASE WHEN id_m_grade = 1 THEN qty ELSE 0 END) as jum_a,
			SUM(CASE WHEN id_m_grade = 2 THEN qty ELSE 0 END) as jum_b,
			SUM(CASE WHEN id_m_grade = 3 THEN qty ELSE 0 END) as jum_i,
			SUM(CASE WHEN id_m_grade = 4 THEN qty ELSE 0 END) as jum_r,
			SUM(CASE WHEN id_m_grade = 5 THEN qty ELSE 0 END) as jum_rc,
			sum(counter_akhir -  counter_awal) as machine_time,
			sum(waste_edge) as waste_edge, sum(waste_reclaime) as waste_reclaime, 
			sum(break_time) as break_time,
(SELECT   COUNT(*) FROM 
 tr_pk_m_group_matcode_bahan WHERE id_tr_pk = a.id_tr_pk and id_m_group = a.id_m_group) as jum_mat_bahan_awal, 
			(SELECT COUNT(*) FROM tr_produksi_detail_batch_no WHERE id_tr_order = c.id_tr_order) as jum_batch,
(SELECT COUNT(*) FROM tr_produksi_detail_batch_no b2 
			 INNER JOIN tr_produksi_detail d2 on b2.id_tr_produksi_detail = d2.id_tr_produksi_detail 
			 WHERE b2.id_tr_order = c.id_tr_order and d2.id_m_grade = '1' ) as jum_batch_a,
(SELECT COUNT(*) FROM tr_produksi_detail_batch_no b2 
			 INNER JOIN tr_produksi_detail d2 on b2.id_tr_produksi_detail = d2.id_tr_produksi_detail 
			 WHERE b2.id_tr_order = c.id_tr_order and d2.id_m_grade = '2' ) as jum_batch_b,
(SELECT COUNT(*) FROM tr_produksi_detail_batch_no b2 
			 INNER JOIN tr_produksi_detail d2 on b2.id_tr_produksi_detail = d2.id_tr_produksi_detail 
			 WHERE b2.id_tr_order = c.id_tr_order and d2.id_m_grade = '3' ) as jum_batch_i,
(SELECT COUNT(*) FROM tr_produksi_detail_batch_no b2 
			 INNER JOIN tr_produksi_detail d2 on b2.id_tr_produksi_detail = d2.id_tr_produksi_detail 
			 WHERE b2.id_tr_order = c.id_tr_order and d2.id_m_grade = '4' ) as jum_batch_r,
(SELECT COUNT(*) FROM tr_produksi_detail_batch_no b2 
			 INNER JOIN tr_produksi_detail d2 on b2.id_tr_produksi_detail = d2.id_tr_produksi_detail 
			 WHERE b2.id_tr_order = c.id_tr_order and d2.id_m_grade = '5' ) as jum_batch_rc,
(SELECT COUNT(DISTINCT b2.batch_no) FROM tr_produksi_detail_batch_no b2  
			 WHERE b2.id_tr_order = c.id_tr_order ) as jml_batch_no_x,

(SELECT COUNT(DISTINCT b2.batch_no) 
			FROM tr_produksi_detail_batch_no b2
			INNER JOIN tr_produksi_detail d2 ON b2.id_tr_produksi_detail = d2.id_tr_produksi_detail  
			WHERE b2.id_tr_order = c.id_tr_order and d2.id_m_grade = '1') as jml_batch_no,

			(SELECT COUNT(*) FROM tr_sisa_bahan WHERE id_tr_order = c.id_tr_order) as jum_sisa_bahan,
			(SELECT CONCAT(nama_group_line, '-', nama_line) FROM m_line ma LEFT JOIN m_group_line mb on ma.id_m_group_line = mb.id_m_group_line WHERE id_m_line = c.id_m_line) as nama_group_line ,
			(	SELECT  count(*)
				FROM tr_produksi_detail a 
				INNER JOIN tr_order b on a.id_tr_order= b.id_tr_order
				INNER JOIN tr_bahan c on b.id_tr_bahan = c.id_tr_bahan
				WHERE c.id_tr_pk =  '$id_tr_pk' and c.id_m_group = e.id_m_group 
			) as jml_tr_prd_detail
			FROM tr_bahan a 
			INNER JOIN m_schedule_detail b on a.id_m_schedule_detail = b.id_m_schedule_detail
			LEFT JOIN tr_order c on c.id_tr_bahan = a.id_tr_bahan
			LEFT JOIN tr_produksi_detail d on d.id_tr_order = c.id_tr_order
			LEFT JOIN m_group e on a.id_m_group = e.id_m_group
			LEFT JOIN m_group_line f on c.id_m_group_line = f.id_m_group_line

			WHERE a.id_tr_pk = '$id_tr_pk' $where_m_line_order_no
			GROUP BY a.id_m_group,
			 b.lebar , c.order_no,c.id_tr_order
			ORDER BY a.id_m_group,d.id_tr_order  DESC,c.order_no,d.id_m_grade,  b.lebar,  c.id_tr_order

";
                    //echo  $sql_x;
                    //echo $where_m_line_order_no;
                    $qry_x = mysql_query($sql_x) or die('ERROR select : ' . $sql_x);

                    $list = '';

                    $jumlah_data_ = mysql_num_rows($qry_x);

                    if ($jumlah_data_ > 0) {

                        $no = 1;
                        $jum = 1;
                        //	$list_table = ' <table width="100%"border="0" cellpadding="0" cellspacing="0"> ';
                        echo '<table>';
                        echo '<tr>';
                        echo '</tr>';
                        echo '</table>';

                        echo '<table width="100%" border="0" cellpadding="0" cellspacing="0">  ';
                        echo '<tr align="center">
        <th width="2%"  align="center" style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000;" >No</th>
 <th width="5%"  align="center" style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000;" >Part</th>
<th width="5%"  align="center" style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000;" >Batch No</th>
        
<th width="5%"  align="center" style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000;" >Σ Bahan (Kg)</th>

<th width="5%"  align="center" style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000;" >Σ Hasil (Kg)</th>

		<th width="5%"  align="center"  style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000;">Order No</th>
<th width="5%"  align="center"  style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000;">Packing</th>
		<th width="5%"  align="center"  style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000;">Lebar</th>
		
		<th style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000;" >Qty Order</th>
		<th style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000;" >Σ A</th>
		<th style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000;" >Σ B</th>
		<th style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000;" >Σ I</th>
		<th style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000;" >Σ R</th>
		<th style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000;" >Σ RC</th>

		<th style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000;" >Σ Hours</th>
<th style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000;" >Σ W. Edge</th>
<th style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000;" >Σ W. CutSht</th>
<th style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000;" >Σ Break T</th>
<th style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000;" >Σ Mchn </th>
<th style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000;" >Σ Labour </th>
<th style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000;" >Sisa Bahan</th>
<th style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000;" >Mchn</th>
<th style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000;" >Hasil - Order</th>

<th style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000;" >App Order</th>
	  </tr>

	 

';
                        while ($row_x = mysql_fetch_array($qry_x)) {
                            $matcode_bahan = '';
                            $status_order = '';
                            $link_approve = '';
                            //	$j++;
                            $x = 0;
                            $id_tr_bahan = $row_x['id_tr_bahan'];
                            if ($id_tr_bahan != '') {
                                $berat_hasil_per_tr_bahan = total_berat_hasil_per_tr_bahan($id_tr_bahan);
                            }
                            $nama_group = $row_x['nama_group'];
                            if (!isset($row_x['lot'])) $lot = ""; else $lot = $row_x['lot'];
                            //	$lot = $row_x['lot'];
                            if (!isset($row_x['matcode_bahan_awal'])) $matcode_bahan_awal = ""; else $matcode_bahan_awal = $row_x['matcode_bahan_awal'];
                            if (!isset($row_x['lebar_bahan'])) $lebar_bahan = ""; else $lebar_bahan = $row_x['lebar_bahan'];
                            if (!isset($row_x['panjang_bahan'])) $panjang_bahan = ""; else $panjang_bahan = $row_x['panjang_bahan'];

                            //	$matcode_bahan_awal = $row_x['matcode_bahan_awal'];
                            //	$lebar_bahan = $row_x['lebar_bahan'];
                            //	$panjang_bahan = $row_x['panjang_bahan'];

                            if (!isset($row_x['rack'])) $rack = ""; else $rack = $row_x['rack'];
                            //	$rack = $row_x['rack'];
                            $matcode_bahan_awal = matcode_2($matcode_bahan_awal, $rack, $id_jenis, $lebar_bahan, $panjang_bahan);
                            if (!isset($row_x['rolls'])) $rolls = ""; else $rolls = $row_x['rolls'];
                            //	$rolls = $row_x['rolls'];
                            $order_no = $row_x['order_no'];
                            $status_order = trim($row_x['status_order']);
                            $jum_batch = $row_x['jum_batch'];
                            $id_tr_order = $row_x['id_tr_order'];
                            $lemparan = "'" . $id_tr_pk . '|' . $id_tr_order . '|' . $offset . "'";
                            $qty_order = $row_x['qty_order'];
                            $lebar_order = $row_x['lebar_order'];
                            $jum_mat_bahan_awal = $row_x['jum_mat_bahan_awal'];
                            $jml_tr_prd_detail = $row_x['jml_tr_prd_detail'];

                            $jml_batch_no = intval($row_x['jml_batch_no']);
                            $jum_a = $row_x['jum_a'];
                            $jum_b = $row_x['jum_b'];
                            $jum_i = $row_x['jum_i'];
                            $jum_r = $row_x['jum_r'];
                            $jum_rc = $row_x['jum_rc'];
                            $id_m_group = $row_x['id_m_group'];

                            if (!isset($prev_order_no)) $prev_order_no = "";
                            if ($prev_order_no != $order_no) {
                                $tampil_order_no = ($order_no);
                                $tampil_qty_order = $qty_order;
                                if ($id_jenis == 'f') {
                                    $selisih_order = $jum_a - $qty_order;
                                } elseif ($id_jenis == 'i') {
                                    $selisih_order = $jum_i - $qty_order;
                                }
                            } else {
                                $tampil_order_no = '';
                                $tampil_qty_order = '';
                                $tampil_group_line = '';
                                $selisih_order = '';
                            }
                            if (!isset($row_x['station'])) $station = ""; else $station = $row_x['station'];
                            if (!isset($row_x['lebar'])) $lebar = ""; else $lebar = $row_x['lebar'];
                            if (!isset($row_x['panjang'])) $panjang = ""; else $panjang = $row_x['panjang'];
                            if (!isset($row_x['berat'])) $berat = ""; else $berat = $row_x['berat'];

                            //	$station = $row_x['station'];
                            //	$lebar = $row_x['lebar'];
                            //	$panjang = $row_x['panjang'];
                            //	$berat = $row_x['berat'];

                            $jum_sisa_bahan = $row_x['jum_sisa_bahan'];
                            $nama_group_line = trim($row_x['nama_group_line']);
                            if ($nama_group_line == '' and $id_tr_order != '') {
                                $tampil_group_line = '-';
                            } elseif ($id_tr_order == '') {
                                $tampil_group_line = '';
                            } else {
                                $tampil_group_line = $nama_group_line;
                            }

                            if (!isset($row_x['id_shif'])) $id_shif = ""; else $id_shif = $row_x['id_shif'];

                            //	$id_shif = $row_x['id_shif'];


                            $jum_batch_a = $row_x['jum_batch_a'];
                            $jum_batch_b = $row_x['jum_batch_b'];
                            $jum_batch_i = $row_x['jum_batch_i'];
                            $jum_batch_r = $row_x['jum_batch_r'];
                            $jum_batch_rc = $row_x['jum_batch_rc'];
                            $tamp_selisih_batch_no_a = '';
                            $tamp_selisih_batch_no_b = '';
                            $tamp_selisih_batch_no_i = '';
                            $tamp_selisih_batch_no_r = '';
                            $tamp_selisih_batch_no_rc = '';

                            $selisih_batch_no_a = intval($jum_batch_a - $jum_a);
                            $selisih_batch_no_b = intval($jum_batch_b - $jum_b);
                            $selisih_batch_no_i = intval($jum_batch_i - $jum_i);
                            $selisih_batch_no_r = intval($jum_batch_r - $jum_r);
                            $selisih_batch_no_rc = intval($jum_batch_rc - $jum_rc);

                            if ($selisih_batch_no_a != 0) {
                                $tamp_selisih_batch_no_a = '<font color="red">*</font>';
                            }
                            if ($selisih_batch_no_b != 0) {
                                $tamp_selisih_batch_no_b = '<font color="red">*</font>';
                            }
                            if ($selisih_batch_no_i != 0) {
                                $tamp_selisih_batch_no_i = '<font color="red">*</font>';
                            }
                            if ($selisih_batch_no_r != 0) {
                                $tamp_selisih_batch_no_r = '<font color="red">*</font>';
                            }
                            if ($selisih_batch_no_rc != 0) {
                                $tamp_selisih_batch_no_rc = '<font color="red">*</font>';
                            }

                            $time_diff = waktu($row_x['time_diff']);
                            $batch_no = $row_x['batch_no'];

                            $sql_batch = "SELECT keterangan FROM tr_order_batch_no_qc WHERE batch_no = '$batch_no' ";
                            $qry_batch = mysql_query($sql_batch) or die('ERROR select : ' . $sql_batch);
                            $jumlah_batch = mysql_num_rows($qry_batch);
                            $keterangan_batch = '';
                            $link_batch_no_non_qc = $batch_no;
                            if ($jumlah_batch > 0) {
                                $batch_no = $batch_no . '*';
                                while ($row_batch = mysql_fetch_array($qry_batch)) {
                                    $keterangan_batch = $row_batch['keterangan'];
                                    $link_batch_no_non_qc = '<a title= " ' . $keterangan_batch . '" >' . ($batch_no) . '</a>';
                                }

                            }
                            $jumlah = $row_x['jumlah_digunakan'];
                            $matcode_2 = matcode_2($matcode, $rack, $id_jenis, $lebar, $panjang);
                            //$berat = hitung_berat($matcode_hasil);
                            if (!isset($row_x['matcode_hasil'])) $matcode_hasil = ""; else $matcode_hasil = $row_x['matcode_hasil'];
                            if (!isset($row_x['batch_no_hasil'])) $batch_no_hasil = ""; else $batch_no_hasil = $row_x['batch_no_hasil'];
                            //	$matcode_hasil = $row_x['matcode_hasil'];
                            //	$batch_no_hasil = $row_x['batch_no_hasil'];

                            $waste_edge = $row_x['waste_edge'];
                            $waste_reclaime = $row_x['waste_reclaime'];
                            $break_time = $row_x['break_time'];
                            $machine_time = $row_x['machine_time'];
                            $labour = hitung_labour($id_tr_order, '0');
                            //$matcode_hasil = $row_x['matcode_hasil'];
                            if (!isset($row_x['matcode_bahan'])) $matcode_bahan = ""; else $matcode_bahan = $row_x['matcode_bahan'];
                            //	$matcode_bahan = trim($row_x['matcode_bahan']);

                            if (!isset($row_x['userid_modified'])) $userid_modified = ""; else $userid_modified = $row_x['userid_modified'];
                            if (!isset($row_x['date_modified'])) $date_modified = ""; else $date_modified = $row_x['date_modified'];
                            //	$userid_modified = $row_x['userid_modified'];
                            //	$date_modified = $row_x['date_modified'];
                            $user_cancel = $row_x['user_cancel'];
                            $alasan_cancel = $row_x['alasan_cancel'];
                            $date_cancel = $row_x['date_cancel'];

                            if (!isset($userid_created)) $userid_created = "";
                            if (!isset($date_created)) $date_created = "";
                            $user_cancel = pilih_satu_nama($userid_created, $user_cancel);
                            $tgl_cancel = pilih_satu_tgl($date_created, $date_cancel);

                            //$user_cancel =  pilih_satu_nama($user_cancel,'');
                            if (!isset($row_x['id_m_schedule_detail'])) $id_m_schedule_detail = ""; else $id_m_schedule_detail = $row_x['id_m_schedule_detail'];
                            //	$id_m_schedule_detail = $row_x['id_m_schedule_detail'];

                            if ($id_tr_order != '') {
                                $berat_hasil_per_order = total_berat_tr_produksi_detail_per_order($id_tr_order);

                            }
                            if (!isset($row_x['id_tr_produksi_detail'])) $id_tr_produksi_detail = ""; else $id_tr_produksi_detail = $row_x['id_tr_produksi_detail'];
                            //	$id_tr_produksi_detail = $row_x['id_tr_produksi_detail'];
                            $lemparan_batch_no = "'" . $offset . '|' . $id_tr_produksi_detail . '|' . $id_tr_order . "'";
                            $lemparan_batch_no = "'" . $offset . '|' . $id_tr_order . "'";
                            $lemparan_batch_no_qc = "'" . $id_tr_pk . '^' . $id_tr_order . '^' . $id_m_schedule_detail . '^' . $batch_no . '^' . $offset . "'";
                            //$lemparan_batch_no_qc = "'".$offset.'|'.$id_tr_order.'|'.$id_m_schedule_detail."'";
                            $lemparan_batch_no_a = "'" . $offset . '|' . $id_tr_order . '|' . 'a' . "'";
                            $lemparan_batch_no_b = "'" . $offset . '|' . $id_tr_order . '|' . 'b' . "'";
                            $lemparan_batch_no_i = "'" . $offset . '|' . $id_tr_order . '|' . 'i' . "'";
                            $lemparan_batch_no_r = "'" . $offset . '|' . $id_tr_order . '|' . 'r' . "'";
                            $lemparan_batch_no_rc = "'" . $offset . '|' . $id_tr_order . '|' . 'rc' . "'";
                            $lemparan_group_mesin = "'" . $offset . '|' . $id_tr_order . "'";
                            $lemparan_sisa_bahan = "'" . $offset . '|' . $id_tr_order . "'";
                            $lemparan_material_bahan = "'" . $offset . '|' . $id_tr_pk . '|' . $id_m_group . "'";

                            $sql_pack = "SELECT COUNT(a.id_tr_packing) as jum_pack 
								 FROM tr_packing_batch_no a
								 INNER JOIN tr_packing b ON a.id_tr_packing = b.id_tr_packing 
								 WHERE a.id_tr_order  = '$id_tr_order' AND b.status ='t'  ";
                            $qry_pack = mysql_query($sql_pack) or die('ERROR select : ' . $sql_pack);
                            while ($row_pack = mysql_fetch_array($qry_pack)) {
                                $jum_pack = intval($row_pack['jum_pack']);
                            }

                            $link_batch_no_qc = '<a title= " ' . $keterangan_batch . '" onclick=" add_batch_no_qc(' . $lemparan_batch_no_qc . ')">' . ($batch_no) . '</a>';

                            $material_bahan = (total_berat_pk_m_group_matcode_bahan($id_tr_pk, $id_m_group));
//$link_material_bahan ='<a title = " '.'Berat : '.$material_bahan. ' Kg'.' " onclick=" form_add_material_bahan('.$lemparan_material_bahan.')">'.($jum_mat_bahan_awal).'&nbsp</a>';

                            $link_material_bahan = ($jum_mat_bahan_awal);

                            $link_add_partai = '';

                            $link_add_partai = $nama_group . '<a onclick=" inputan_baru(' . "'" . $offset . "|" . $id_tr_pk . '|' . $id_m_group . "'" . ')">' . '<br>INPUT' . '&nbsp</a>';

                            $link_packing_all = '<a onclick=" add_packing_all(' . "'" . $offset . "|" . $id_tr_pk . '|' . $id_m_group . "'" . ')">' . '<br>PACKING' . '&nbsp</a>';
                            if ($jml_tr_prd_detail > 0) {
                                if (!isset($nama_group_xxx)) $nama_group_xxx = "";
                                $link_add_partai .= '<br><a onclick=" add_partai(' . "'" . $offset . "|" . $id_tr_pk . '|' . $id_m_group . "'" . ')">' . ($nama_group_xxx) . '<br>CW' . '&nbsp</a>';
                            } else {
                            }

//echo $lemparan;
                            echo '<tr>';
                            if ($jum <= 1) {
                                echo '<td width="2%"  align="center" style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000; " scope="row" rowspan="' . $jumlah . '">' . $no . '</td>';
                                echo '<td width="5%"  align="center" style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000; " scope="row" rowspan="' . $jumlah . '">' . $link_add_partai . '</td>';
                                if ($akses == '111') {
                                    echo '<td width="5%"  align="center" style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000; " scope="row" rowspan="' . $jumlah . '">' . $link_batch_no_qc . '</td>';
                                } else {
                                    echo '<td width="5%"  align="center" style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000; " scope="row" rowspan="' . $jumlah . '">' . $link_batch_no_non_qc . '</td>';

                                }

                                echo '<td width="5%"  align="center" style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000; " scope="row" rowspan="' . $jumlah . '">' . $link_material_bahan . '<br>' . number_format($material_bahan, 2) . '</td>';
//$berat_hasil_per_tr_bahan = $id_tr_bahan;
                                echo '<td width="5%"  align="center" style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000; " scope="row" rowspan="' . $jumlah . '">' . '<br>' . $berat_hasil_per_tr_bahan . '</td>';


                                $jum = $jumlah;
                                $no++;
                            } else {
                                $jum = $jum - 1;
                            }
                            $link_order_no = '';
                            $link_packing = '';
                            if (trim($order_no) != '') {
                                if ($akses == '11' or $akses == '111') {
                                    $link_order_no = '<a title = " ' . 'Berat : ' . number_format($berat_hasil_per_order, 2) . ' Kg' . '" onclick=" add_order(' . $lemparan . ')">' . ($tampil_order_no) . '</a>';
                                } else {
                                    $link_order_no = ($tampil_order_no);
                                }

//$link_packing ='<a title = " '.'Berat : '.number_format($berat_hasil_per_order,2). ' Kg'.'" onclick=" add_packing('.$lemparan.')">'.($jum_pack .' / '. $jml_batch_no).'</a>';
                                $lemparan_pack_2 = $lemparan_material_bahan;
//$link_packing ='<a " onclick=" add_packing('.$lemparan.')">'.($jum_pack .' / '. $jml_batch_no).'</a>';
                                $link_packing = '<a onclick=" add_packing_all(' . $lemparan_material_bahan . ')">' . ($jum_pack . ' / ' . $jml_batch_no) . '</a>';


//$link_batch_no_non_qc ='<a title= " '.$keterangan_batch .'" >'.($batch_no).'</a>';
                                $link_jumlah_a = '<a title = " ' . $selisih_batch_no_a . ' " onclick=" add_batch_no(' . $lemparan_batch_no_a . ')">' . cek_angka_kosong($jum_a, 0) . '&nbsp</a>';
                                $link_jumlah_b = '<a title = " ' . $selisih_batch_no_b . ' " onclick=" add_batch_no(' . $lemparan_batch_no_b . ')">' . cek_angka_kosong($jum_b, 0) . '&nbsp</a>';
                                $link_jumlah_i = '<a title = " ' . $selisih_batch_no_i . ' " onclick=" add_batch_no(' . $lemparan_batch_no_i . ')">' . cek_angka_kosong($jum_i, 0) . '&nbsp</a>';
                                $link_jumlah_r = '<a title = " ' . $selisih_batch_no_r . ' " onclick=" add_batch_no(' . $lemparan_batch_no_r . ')">' . cek_angka_kosong($jum_r, 0) . '&nbsp</a>';
                                $link_jumlah_rc = '<a title = " ' . $selisih_batch_no_rc . ' " onclick=" add_batch_no(' . $lemparan_batch_no_rc . ')">' . cek_angka_kosong($jum_rc, 0) . '&nbsp</a>';
                                $link_sisa_bahan = '<a onclick=" add_sisa_bahan(' . $lemparan_sisa_bahan . ')">' . cek_angka_kosong($jum_sisa_bahan, 0) . '&nbsp</a>';
                                $link_approve = '';
                                $link_group_mesin = '';

                                $lemparan_approve = "'" . $offset . '|' . $id_tr_order . "'";
                                $lemparan_cancel = "'" . $offset . '|' . $id_tr_order . '|' . $order_no . "'";

                                $jum_CW = cek_CW($id_tr_order);
//echo 'jum_CW =' .$jum_CW;
                                $link_group_mesin = ($tampil_group_line);
//$link_group_mesin = '<a onclick=" add_group_mesin('.$lemparan_group_mesin.')">'.($tampil_group_line).'&nbsp</a>';
                                //if ($status_order == '' and $akses == '11' and $selisih_batch_no_a ==0 and $selisih_batch_no_b == 0 and $selisih_batch_no_i == 0 and $selisih_batch_no_r == 0 and $selisih_batch_no_rc == 0 and $jum_CW == 0)
                                if ($status_order == '' and $akses == '11') {
                                    //$link_approve ='<a onclick=" approve_conf('.$lemparan_approve.')"><img src="../images/icons/tick.png" border="0" title="Approve" /></a>';
                                    $link_approve .= '<a onclick=" cancel_conf(' . $lemparan_cancel . ')"><img src="../images/icons/del_data.png" border="0" title="Cancel" /></a>';
                                    $link_group_mesin = '<a onclick=" add_group_mesin(' . $lemparan_group_mesin . ')">' . ($tampil_group_line) . '&nbsp</a>';
                                } elseif ($status_order == 't') {
                                    $link_group_mesin = ($tampil_group_line);
                                    $date_approved = $row_x['date_approved'];
                                    $date_approved = convDate(substr($date_approved, 0, 10), '-', '1') . ' ' . substr($date_approved, 11, 5);
                                    $info_approve = $row_x['userid_approved'] . ' - ' . $date_approved;
                                    $link_approve = '<a onclick=""><img src="../images/icons/app.jpg" border="0" title=" ' . $info_approve . ' "/></a>';
                                    if ($akses == '111') {
                                        $lemparan_un_approve = "'" . $offset . '|' . $id_tr_order . '|' . $order_no . "'";
                                        $link_approve = '';
                                        //$link_approve = '<a onclick=" un_approve_conf('.$lemparan_approve.')">'.($info_approve).'&nbsp</a>';
                                        $link_approve .= '<a onclick=" un_approve_conf(' . $lemparan_un_approve . ')"><img src="../images/icons/un_lock.jpg" border="0" title="' . $info_approve . '" /></a>';
                                    }

                                } elseif ($status_order == 'f') {
                                    $link_group_mesin = ($tampil_group_line);
                                    $date_modified = convDate(substr($date_modified, 0, 10), '-', '1') . ' ' . substr($date_modified, 11, 5);
                                    $info_cancel = $user_cancel . ' - ' . $tgl_cancel . ' : ' . $alasan_cancel;
                                    $link_approve = '<a onclick=""><img src="../images/icons/cancel2.jpg" border="0" title=" ' . $info_cancel . ' "/></a>';
                                }

                            } else {
                                $link_order_no = '';
                                $link_jumlah_a = '';
                                $link_jumlah_b = '';
                                $link_jumlah_i = '';
                                $link_jumlah_r = '';
                                $link_jumlah_rc = '';
                                $link_group_mesin = '';
                                $link_approve = "";
                                $link_sisa_bahan = "";
                            }

                            echo '<td width="5%" align="center" style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000; " scope="row"> ' . $link_order_no . '</td>';
                            echo '<td width="5%" align="center" style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000; " scope="row">' . $link_packing . '</td>';

                            echo '<td width="5%" align="right" style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000; " scope="row"> ' . cek_angka_kosong($lebar_order, 0) . '</td>';
                            echo '<td width="5%"  align="right"  style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000; " scope="row"> ' . $tampil_qty_order . '&nbsp</td>';

                            echo '<td width="5%" align="right" style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000; " scope="row">' . $link_jumlah_a . $tamp_selisih_batch_no_a . '</td>';

                            echo '<td width="5%" align="right" style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000; " scope="row">' . $link_jumlah_b . $tamp_selisih_batch_no_b . '</td>';

                            echo '<td width="5%" align="right" style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000; " scope="row">' . $link_jumlah_i . $tamp_selisih_batch_no_i . '</td>';

                            echo '<td width="5%" align="right" style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000; " scope="row">' . $link_jumlah_r . $tamp_selisih_batch_no_r . '</td>';

                            echo '<td width="5%" align="right" style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000; " scope="row">' . $link_jumlah_rc . $tamp_selisih_batch_no_rc . '</td>';

                            /*echo '<td width="5%"  align="right"  style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000; "scope="row">'.cek_angka_kosong($jum_b,0).'&nbsp</td>';
 echo '<td width="5%" align="right" style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000; "scope="row">'.cek_angka_kosong($jum_i,0).'&nbsp
								</td>';
 echo '<td width="5%" align="right" style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000; "scope="row">'.cek_angka_kosong($jum_r,0).'&nbsp
								</td>';
 echo '<td width="5%" align="right" style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000; "scope="row">'.cek_angka_kosong($jum_rc,0).'&nbsp
								</td>';*/
                            /* echo '<td width="5%" align="right" style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000; "scope="row">
	<a onclick=" add_batch_no('.$lemparan_batch_no.')">'.cek_angka_kosong($jum_batch,0).'&nbsp</a>
								</td>';
*/

                            $link_add_partai = '<a onclick=" add_partai(' . "'" . $offset . "|" . $id_tr_pk . '|' . $id_m_group . "'" . ')">' . cek_angka_kosong($time_diff, 0) . '&nbsp</a>';


                            echo '<td width="5%"  align="right"  style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000; " scope="row"> ' . cek_angka_kosong($time_diff, 0) . '&nbsp</td>';;
                            echo '<td width="5%"  align="right"  style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000; " scope="row"> ' . cek_angka_kosong($waste_edge, 2) . '&nbsp</td>';;
                            echo '<td width="5%"  align="right"  style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000; " scope="row"> ' . cek_angka_kosong($waste_reclaime, 2) . '&nbsp</td>';;
                            echo '<td width="5%"  align="right"  style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000; " scope="row"> ' . cek_angka_kosong($break_time, 2) . '&nbsp</td>';;
                            echo '<td width="5%"  align="right"  style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000; " scope="row"> ' . number_format($machine_time) . '&nbsp</td>';;
                            echo '<td width="5%"  align="right"  style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000; " scope="row"> ' . cek_kosong($labour, 2) . '&nbsp</td>';
                            echo '<td width="5%" align="right" style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000; " scope="row">' . $link_sisa_bahan . '</td>';

                            echo '<td width="5%" align="center" style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000; " scope="row">' . $link_group_mesin . '</td>';

                            echo '<td width="5%" align="center" style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000; " scope="row"> ' . cek_angka_kosong($selisih_order, 0) . '</td>';

                            echo '<td width="5%" align="center" style="border-top: 1px dotted #000000; border-bottom: 1px dotted #000000; border-left: 1px dotted #000000; border-right: 1px dotted #000000; " scope="row">' . $link_approve . '</td>';


                            echo '</tr>';
                            $prev_order_no = $order_no;
                        }

                        echo '</table>';
                        echo '</center>';

                        echo '<table>';
                        echo '<tr>';
                        echo '</tr>';
                        echo '</table>';

                    }
                    $waste_edge = '-';
                    $waste_reclaime = '-';
                    $labour = '-';
                    $break_time = '-';
                    $machine_time = '-';

                    $sql = "SELECT a.* FROM tr_produksi a WHERE a.id_tr_pk = '$id_tr_pk'";
                    $qry = mysql_query($sql) or die('ERROR select : ' . $sql);
                    while ($row = mysql_fetch_array($qry)) {
                        $waste_edge = $row['waste_edge'];
                        $waste_reclaime = $row['waste_reclaime'];
                        $labour = $row['labour'];
                        $break_time = $row['break_time'];
                        $machine_time = $row['machine_time'];

                    }

                    $lemparan_offset = $id_tr_pk . '|' . $offset;
                    ?>              </td>
                <!--<td width="2%" align="center" valign="middle">-->

                </td>
            </tr>
            <?php
        }


        ?>
        <tr>
            <td align="center" colspan="5">
                <?php


                $periode = $_REQUEST['periode'];
                $txt_menuid = $_REQUEST['txt_menuid'];
                if (!isset($_REQUEST['cbo_sub_komponen'])) $cbo_sub_komponen = ""; else $cbo_sub_komponen = $_REQUEST['cbo_sub_komponen'];
                if (!isset($_REQUEST['cbo_kelompok'])) $cbo_kelompok = ""; else $cbo_kelompok = $_REQUEST['cbo_kelompok'];
                if (!isset($_REQUEST['cbo_status'])) $cbo_status = ""; else $cbo_status = $_REQUEST['cbo_status'];
                if (!isset($_REQUEST['cbo_output'])) $cbo_output = ""; else $cbo_output = $_REQUEST['cbo_output'];
                if (!isset($_REQUEST['cbo_kode1'])) $cbo_kode1 = ""; else $cbo_kode1 = $_REQUEST['cbo_kode1'];
                if (!isset($_REQUEST['cbo_orderby'])) $cbo_orderby = ""; else $cbo_orderby = $_REQUEST['cbo_orderby'];
                if (!isset($_REQUEST['txt_search_sub_kegiatan'])) $txt_search_sub_kegiatan = ""; else $txt_search_sub_kegiatan = strtolower($_REQUEST['txt_search_sub_kegiatan']);;

                //  $cbo_sub_komponen = $_REQUEST['cbo_sub_komponen'];
                //  $cbo_kelompok =$_REQUEST['cbo_kelompok'];
                //  $cbo_status =$_REQUEST['cbo_status'];
                //  $cbo_output =$_REQUEST['cbo_output'];
                //  $cbo_kode1 =$_REQUEST['cbo_kode1'];
                //  $cbo_orderby =$_REQUEST['cbo_orderby'];
                //  $txt_search_sub_kegiatan = strtolower($_REQUEST['txt_search_sub_kegiatan']);
                //    $txt_search_sub_kegiatan = trim(str_replace('8764346466435364647768799667654537543756',' ',$txt_search_sub_kegiatan));
                $txt_search_sub_kegiatan = (str_replace(' ', '8764346466435364647768799667654537543756', $txt_search_sub_kegiatan));
                $txt_sembunyi = $_REQUEST['txt_sembunyi'];

                if ($txt_sembunyi != '') {
                    //die($txt_sembunyi);
                    $txt_sembunyi = explode("|", $txt_sembunyi);
                    $periode = $_REQUEST['periode'];
                    $x = 0;
                    while ($x < count($txt_sembunyi)) {
                        switch ($x) {
                            case 0:
                                $cbo_komponen = $txt_sembunyi[0];
                                break;
                            case 1:
                                $cbo_sub_komponen = $txt_sembunyi[1];
                                break;
                            case 2:
                                $txt_search_sub_kegiatan = strtolower($txt_sembunyi[2]);
                                break;
                            case 3:
                                $cbo_kelompok = $txt_sembunyi[3];
                                break;
                            case 4:
                                $cbo_output = $txt_sembunyi[4];
                                break;
                            case 5:
                                $cbo_status = $txt_sembunyi[5];
                                break;
                            case 6:
                                $input_search = $txt_sembunyi[6];
                                break;
                            case 7:
                                $cbo_orderby = $txt_sembunyi[7];
                                break;
                            case 8:
                                $cbo_kode1 = $txt_sembunyi[8];
                                break;
                        }
                        $x++;
                    }
                    $cbo_program = $_REQUEST['cbo_program'];
                    $id_m_line = $_REQUEST['id_m_line'];

                    //    $txt_search_sub_kegiatan = trim(str_replace('8764346466435364647768799667654537543756',' ',$txt_search_sub_kegiatan));
                    $txt_search_sub_kegiatan = (str_replace(' ', '8764346466435364647768799667654537543756', $txt_search_sub_kegiatan));

                    //cbo_komponen +'|'+cbo_sub_komponen+'|'+ txt_search_sub_kegiatan+'|'+cbo_kelompok+'|'+cbo_output+'|'+cbo_status+'|'+input_search+'|'+ cbo_orderby+'|'+cbo_kode1;
                }
                $txt_sembunyi = $_REQUEST['txt_sembunyi'];
                echo '<br>';

                echo paging($offset, $jumlah_data, $limit, 'div_data', 'script_data_produksi.php', 'act=show_table&txt_menuid=' . $txt_menuid . '&txt_sembunyi=' . $txt_sembunyi . '&periode=' . $periode . '&input_search=' . $input_search . '&cbo_kelompok=' . $cbo_kelompok . '&cbo_status=' . $cbo_status . '&cbo_program=' . $cbo_program . '&cbo_orderby=' . $cbo_orderby . '&id_m_line=' . $id_m_line);

                ?>
            </td>
        </tr>
    </table>
    <?php

}

function ubah_kata($data)
{
    if ($data == '0') {
        $data = 'ALL';
    }
    return $data;
}


function add_order_create_temp($id_tr_pk)
{
}


function save()
{
}

function edit()
{
}


function delete_data()
{
    $id_tr_order = $_REQUEST['id_tr_order'];
    //$arr_isi = explode("|", $id_tr_pk);
    //$id_tr_pk = trim($arr_isi[0]);

    $alasan_cancel = $_REQUEST['alasan_cancel'];
    $alasan_cancel = str_replace('8764346466435364647768799667654537543756', ' ', $alasan_cancel);
    $sql_cancel =
        " UPDATE tr_order 
			  SET status = 'f',
			  userid_modified = '" . $_SESSION['userid'] . "',
			  alasan_cancel = '$alasan_cancel',
              date_modified = now()
			  WHERE id_tr_order = $id_tr_order";
//die($sql_cancel);
    $qry_cancel = mysql_query($sql_cancel) or die('ERROR cancel id_tr_order: ' . $sql_cancel);

    echo 'sukses';
}

mysql_close();
?>
