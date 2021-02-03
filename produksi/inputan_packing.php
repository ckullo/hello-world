<?php require_once("../include/config.php"); ?>
<?php require_once("../include/session.php"); ?>
<?php require_once("../include/function.php"); ?>
<?php
$act = $_REQUEST['act'];
//die('xxx_act = '. $act);

switch ($act) {
    case 'form_input':
        form_input();
        break;
    case 'nilai_rps':
        nilai_rps();
        break;
    case 'pilih_lebar':
        pilih_lebar();
        break;
    case 'save_packing':
        save_packing();
        break;
    case 'history_packing':
        history_packing();
        break;
    case 'del_batch_no':
        del_batch_no();
        break;
    case 'approve_packing':
        approve_packing();
        break;
    case 'change_lebar':
        change_lebar();
        break;
    case 'shift':
        shift();
        break;
    case 'list_belum_pack':
        list_belum_pack();
        break;
    case 'lihat_yg_mau_di_edit':
        lihat_yg_mau_di_edit();
        break;

}

function lihat_yg_mau_di_edit()
{
    $par = $_REQUEST['par'];   //0|5933|1|3         //940|(50875,50876,50877,50878,50879,50880)
//	$txt_list_order = $_REQUEST['txt_list_order'];
    $id_tr_packing = $_REQUEST['id_tr_packing'];

    $arr = explode("|", $par);
//	$id_tr_packing = intval($arr[3]);
    $join_exist = '';
    //echo 'ini edit <br>';
    //echo 'id_tr_packing : '. $id_tr_packing .'<br>';
    if (intval($id_tr_packing) > 0) {
        $where_status_exist = " b.id_tr_packing = '$id_tr_packing' ";
    } else {
        die();
    }

    $sql = "
		SELECT DISTINCT a.id_tr_produksi_detail_batch_no, a.batch_no, a.berat, b.batch_no as c_batch_no 
		, d.id_m_shift, d.id_m_group_shift, d.id_m_grade,d.date_created, d.userid_created, d.matcode_hasil
		, e.nama_shift, f.nama_group_shift
		, g.nama_grade , h.order_no, h.id_m_customer_detail, h.id_m_customer_detail2
		FROM tr_produksi_detail_batch_no a 
		LEFT JOIN tr_packing_batch_no b ON b.id_tr_produksi_detail_batch_no = a.id_tr_produksi_detail_batch_no
		LEFT JOIN tr_produksi_detail d ON a.id_tr_produksi_detail = d.id_tr_produksi_detail
		LEFT JOIN m_shift e ON e.id_m_shift = d.id_m_shift
		LEFT JOIN m_group_shift f ON f.id_m_group_shift = d.id_m_group_shift
		LEFT JOIN m_grade g ON g.id_m_grade = d.id_m_grade
		INNER JOIN tr_order h ON a.id_tr_order = h.id_tr_order
 		$join_exist 
		WHERE $where_status_exist AND d.id_m_grade = '1' 
		  ORDER BY a.id_tr_order,a.batch_no
		";
    //echo $id_tr_packing. ' xx '. $where_status_exist;
    $qry = mysql_query($sql) or die('ERROR select : ' . $sql);
    $jumlah_data = mysql_num_rows($qry);
    //die( $sql);
    //echo 'Total : '. $jumlah_data;
    ?>
    <form id="form_list_yg_mau_di_edit" name="form_list_yg_mau_di_edit">
        <table width="100%" border="1">
            <tr class="table_header">
                <td width="1%" rowspan="2">No</td>
                <td width="5%" rowspan="2" align="center">Batch No</td>
                <td colspan="9" align="center">LIST EXISTING FOR PACKING NO
                    : <?php echo ' ' . tampilan_no_packing($id_tr_packing) ?></td>
                <td align="center"><?php echo 'Total : ' . $jumlah_data ?></td>
                <td width="2%" rowspan="2" align="center"><input type="checkbox" id="check_all_batch_edit"
                                                                 name="check_all_batch_edit"
                                                                 onclick="checklist_all_batch_edit(this)"/>
                </td>
            <tr class="table_header">
                <td width="2%" align="center">Shift</td>
                <td width="7%" align="center">Date</td>
                <td width="8%" align="center">User</td>
                <td width="2%" align="center">Grade</td>
                <td width="2%" align="center">Width</td>
                <td width="2%" align="center">Length</td>
                <td width="2%" align="center">Weight (Kg)</td>
                <td width="4%" align="center">Material Code</td>
                <td width="4%" align="center">Order No</td>
                <td width="10%" align="center">Customer</td>
                <?php
                $i = 0;
                while ($row = mysql_fetch_array($qry))
                {
                $i++;
                $id_tr_produksi_detail_batch_no = (trim($row['id_tr_produksi_detail_batch_no']));
                $batch_no = (trim($row['batch_no']));
                $nama_shift = (trim($row['nama_shift']));
                $nama_group_shift = (trim($row['nama_group_shift']));
                $nama_grade = (trim($row['nama_grade']));
                $berat = (trim($row['berat']));
                $matcode_hasil = (trim($row['matcode_hasil']));
                $order_no = (trim($row['order_no']));
                $m_customer_detail = get_nama_customer(trim($row['id_m_customer_detail']));
                $m_customer_detail2 = get_nama_customer(trim($row['id_m_customer_detail2']));

                $date_created = (trim($row['date_created']));
                $userid_created = (trim($row['userid_created']));
                $tgl = pilih_satu_tgl($date_created, '');
                $user = pilih_satu_nama($userid_created, (isset($userid_modified) ? $userid_modified : ""));
                //PBA0030084003000
                $lebar = intval(substr($matcode_hasil, 7, 4));
                $panjang = intval(substr($matcode_hasil, 11, 5));
                $list_antrian_batch_edit .= $id_tr_produksi_detail_batch_no . ",";

                ?>
            <tr class="">
                <td width="1%" align="center"><?php echo $i ?></td>
                <td width="5%" align="center"><?php echo $batch_no ?></td>
                <td width="2%" align="center"><?php echo $nama_shift . ' ' . $nama_group_shift ?></td>
                <td width="7%" align="center"><?php echo $tgl ?></td>
                <td width="8%" align="center"><?php echo $user ?></td>
                <td width="2%" align="center"><?php echo $nama_grade ?></td>
                <td width="2%" align="center"><?php echo number_format($lebar) ?></td>
                <td width="2%" align="center"><?php echo number_format($panjang) ?></td>
                <td width="2%" align="center"><?php echo $berat ?></td>
                <td width="4%" align="center"> <?php echo $matcode_hasil ?></td>
                <td width="4%" align="center"> <?php echo $order_no ?></td>
                <td width="10%" align="center"><?php echo potong_data($m_customer_detail, 12) ?></td>
                <td width="2%" align="center">
                    <input type="checkbox" id="cek_batch_edit_<?= $i ?>" name="cek_batch_edit_[]"
                           value="<?= $id_tr_produksi_detail_batch_no ?>"
                           onclick="choose_me_batch_edit(<?= $i ?>,<?= $id_tr_produksi_detail_batch_no ?>);"

                        <?php
                        if ($id_tr_packing > '0') {
                            echo 'checked="checked"';
                            /*  echo 'disabled="disabled"'; */

                        } else {
                            echo '';
                        }

                        ?>

                    />

                </td>
            </tr>

            <?php } ?>

            <tr>
                <td><input type="hidden" id="list_antrian_batch_edit" name="list_antrian_batch_edit"
                           value="<?php echo $list_antrian_batch_edit ?>"/></td>
            </tr>
        </table>
    </form>

    <?php
}

function shift()
{
    $txt_list_order = $_REQUEST['txt_list_order'];
    $id_tr_order = str_replace("'", '', $txt_list_order);
//echo 'txt_list_order = ' . $txt_list_order;
    $sql_shift = " 
		SELECT DISTINCT CONCAT(d.id_m_shift, '|',f.id_m_group_shift) as val, CONCAT(e.nama_shift, ' ',f.nama_group_shift) as display,
        f.id_m_group_shift, f.nama_group_shift
		FROM tr_produksi_detail_batch_no a 
		LEFT JOIN tr_packing_batch_no b ON b.batch_no = a.batch_no
		LEFT JOIN tr_produksi_detail d ON a.id_tr_produksi_detail = d.id_tr_produksi_detail
		LEFT JOIN m_shift e ON e.id_m_shift = d.id_m_shift
		LEFT JOIN m_group_shift f ON f.id_m_group_shift = d.id_m_group_shift
		LEFT JOIN m_grade g ON g.id_m_grade = d.id_m_grade 
		WHERE a.id_tr_order IN $id_tr_order AND b.batch_no is NULL AND d.id_m_grade = '1'
		GROUP BY d.id_m_shift ";
//echo '<br>sql_shift = ' . $sql_shift.'<br>';
    echo 'Shift : ';
    makecomboonchange($sql_shift, "cbo_shift_not_yet", "cbo_shift_not_yet", "", (isset($model_) ? $model_ : ""), "- ALL -", "", "pilih_shift(value)");
}

function change_order_no()
{
    $id_tr_pk = $_REQUEST['par'];
    //$id_group;
}

function change_lebar()
{
    //$id_m_shift = $_REQUEST['id_m_shift'];
    $par = $_REQUEST['par'];
    $txt_list_order = $_REQUEST['txt_list_order'];

    $arr = explode("|", $par);
    $lebar = $arr[0];
    $id_tr_order = $arr[1];
//	die('zzzzzzzzzzzzzz'.$par);
//	echo 'change_lebar = '.$par;
    $jumlah_koma = substr_count($id_tr_order, ",");
    if ($lebar == '0') {
        if ($jumlah_koma == 0) {
            $where_order = " WHERE id_tr_order = $id_tr_order ";
        } elseif ($jumlah_koma > 0) {
            $where_order = " WHERE id_tr_order IN $id_tr_order ";
        }
    } else {
        $where_order = " WHERE id_tr_order IN $id_tr_order AND lebar = '$lebar' ";
    }

    $sql = "SELECT id_tr_order as val, order_no as display 
		FROM tr_order 
		$where_order ";
    //echo $sql;
    $lebar = "'" . $lebar . "'";
//	echo 'where_order = '.$where_order;
    echo '&nbsp;&nbsp;Order No : ';
    makecomboonchange($sql, "cbo_order", "cbo_order", "", (isset($model_) ? $model_ : ""), "- ALL -", "", "change_order($lebar+'|'+value)");
}

function pilih_lebar()
{
    $lemparan = $_REQUEST['lemparan'];
    //echo 'xxx'. $id_tr_order.'<br>';
    //echo $lemparan;

    $par = $_REQUEST['lemparan'];
    $arr = explode("|", $par);
    $offset = $arr[0];
    $id_tr_pk = $arr[1];
    $id_m_group = $arr[2];
    $id_tr_packing = isset($arr[3]) ? $arr[3] : '';

    $sql = "SELECT DISTINCT a.id_tr_order  from tr_order a	 
INNER JOIN tr_bahan b ON a.id_tr_bahan = b.id_tr_bahan
INNER JOIN tr_pk c ON b.id_tr_pk = c.id_tr_pk
WHERE c.id_tr_pk = '$id_tr_pk' and b.id_m_group = '$id_m_group'
ORDER BY a.id_tr_order ";
    $qry = mysql_query($sql) or die('ERROR select : ' . $sql);
    $all_id_tr_order = '';
    while ($row = mysql_fetch_array($qry)) {
        $id_tr_order = (trim($row['id_tr_order']));
        $all_id_tr_order .= $id_tr_order . ',';
    }
    $all_id_tr_order = "'(" . substr($all_id_tr_order, 0, -1) . ")'";

    /*$sql = "SELECT DISTINCT a.lebar  as val, a.lebar  as display  from tr_order a
    INNER JOIN tr_bahan b ON a.id_tr_bahan = b.id_tr_bahan
    INNER JOIN tr_pk c ON b.id_tr_pk = c.id_tr_pk
    WHERE c.id_tr_pk = '$id_tr_pk' and b.id_m_group = '$id_m_group'
    ORDER BY a.lebar ";*/

    $sql = "
SELECT DISTINCT a.lebar as val, a.lebar as display 
FROM tr_produksi_detail a1
INNER JOIN tr_order a ON a1.id_tr_order = a.id_tr_order
INNER JOIN tr_bahan b ON a.id_tr_bahan = b.id_tr_bahan 
INNER JOIN tr_pk c ON b.id_tr_pk = c.id_tr_pk 
WHERE c.id_tr_pk = '$id_tr_pk' and b.id_m_group = '$id_m_group' AND a1.id_m_grade = '1'
ORDER BY a.lebar";

//echo $sql;
    ?>

    <table width="100%" border="0">
        <tr class="">
            <td width="12%">Width :
            <td width="4%">
                <?php makecomboonchange($sql, "cbo_lebar", "cbo_lebar", "", (isset($model_) ? $model_ : ""), "- ALL -", "", "change_lebar(value+'|'+$all_id_tr_order)"); ?></td>
            <td width="40%" colspan="2">
                <div id="div_order_no"></div>
            </td>

        </tr>
        <!--<tr>
        <td colspan="4"><div id="list_div_not_yet"></div></td>
        </tr>-->
    </table>

    <?php
}

function approve_packing()
{

    $usernya = $_SESSION['userid'];
    $list_antrian_app = $_REQUEST['list_antrian_app'];
    //echo $list_antrian_app;
    $list_antrian_app = " (" . substr($list_antrian_app, 0, -1) . ")";
    $jumlah_data = substr_count($list_antrian_app, ",");

    $sql = " UPDATE tr_packing 
			SET  userid_approved = '$usernya',
			status = 't',
			date_approved = now()
	        WHERE id_tr_packing IN $list_antrian_app";
    $qry = mysql_query($sql) or die('ERROR select : ' . $sql);
    $jumlah = mysql_affected_rows();

    if ($jumlah > 0) {
        echo 'sukses';
    } else {
        echo 'GAGAL ' . $sql;
    }


}

function buang_double($data)
{
    $arr_data = explode(",", $data);
    $data = $arr_data[0];
    return ($data);
}

function sql_vendor($lokasi)
{
    $sql = "SELECT id_m_vendor_packing as val,nama_vendor_packing as display FROM m_vendor_packing ";
    $sql = $sql . " WHERE status ='t' AND lower(lokasi) like '%$lokasi%' ORDER BY nama_vendor_packing ";
    return ($sql);
}

function del_batch_no()
{
    $par = $_REQUEST['par'];
    $arr = explode("|", $par);
    $batch_no = $arr[0];
    $id_tr_packing = $arr[0];

    $sql = "DELETE FROM tr_packing_detail WHERE id_tr_packing ='$id_tr_packing' ";
    $qry = mysql_query($sql) or die('ERROR select : ' . $sql);

    $sql = "DELETE FROM tr_packing_batch_no WHERE id_tr_packing ='$id_tr_packing' ";
    $qry = mysql_query($sql) or die('ERROR select : ' . $sql);

    $sql = "DELETE FROM tr_packing WHERE id_tr_packing ='$id_tr_packing' ";
    $qry = mysql_query($sql) or die('ERROR select : ' . $sql);
    echo 'sukses';
}

function history_packing()
{

    $val = $_REQUEST['val'];
    $txt_menuid = $_REQUEST['txt_menuid'];
    $txt_list_order = $_REQUEST['txt_list_order'];

    $id_tr_pk = $_REQUEST['id_tr_pk'];
    $id_group = $_REQUEST['id_group'];
    $id_tr_order = $_REQUEST['id_tr_order'];
    $offset = $_REQUEST['offset'];

//die($val);
// '"'.$id_tr_pk."|".$id_tr_order."|000|".$id_tr_packing.'"'
    /*$arr_isi = explode("|",$val);
    $id_tr_pk = trim($arr_isi[0]);
    $id_tr_order = trim($arr_isi[1]);
    $offset = trim($arr_isi[2]);*/
    $akses = get_akses($_SESSION['userid'], $txt_menuid);


    //$id_tr_order = $_REQUEST['id_tr_order'];
    /*echo 'val = '.$val.'<br>';
    echo 'id_tr_pk = '.$id_tr_pk.'<br>';
    echo 'id_tr_order = '.$id_tr_order.'<br>';*/


    $sql = "
		SELECT DISTINCT a.id_tr_packing,  a.model_, a.note, a.tr_date, a.no_packing
		, a.id_m_shift, a.id_m_group_shift, a.date_created, a.userid_created
		, e.nama_shift, f.nama_group_shift, a.date_approved, a.userid_approved, a.status
		
		FROM tr_packing a 
		LEFT JOIN m_shift e ON e.id_m_shift = a.id_m_shift
		LEFT JOIN m_group_shift f ON f.id_m_group_shift = a.id_m_group_shift
		INNER JOIN tr_packing_batch_no d ON a.id_tr_packing = d.id_tr_packing
		WHERE d.id_tr_order IN $txt_list_order ORDER BY a.id_tr_packing ASC
		";
    $qry = mysql_query($sql) or die('ERROR select : ' . $sql);
    //echo 'xx'.$sql;
//die();
    ?>
    <form name="form_history" id="form_history" class="">
        <table width="100%" border="1">
            <tr class="table_header">
                <td colspan="8" align="center">PACKING</td>
                <td width="2%" colspan="2"></td>
            <tr class="table_header">
                <td width="1%" align="center">No.</td>
                <td width="2%" align="center">Pack. No</td>
                <td width="1%" align="center">Shift<br/>Model</td>
                <td width="1%" align="center">Note</td>
                <td width="4%" align="center">OrderNo</td>
                <td width="2%" align="center">Width</td>
                <td width="2%" align="center">Batch No</td>
                <td width="55%" align="center">Material</td>
                <td width="1%" align="center">ACT</td>
                <td width="1%" align="center">App
                    <input type="checkbox" id="check_all_app" name="check_all_app"
                           onclick="checklist_all_app_packing(this)"/>
                    <input type="hidden" id="list_antrian_app" name="list_antrian_app"
                           value="<?php echo (isset($list_antrian_app) ? $list_antrian_app : "") ?>"/></td>

                <?php
                $i = 0 ;
                while ($row = mysql_fetch_array($qry))
                {
                $i++;

                $id_tr_packing = (trim($row['id_tr_packing']));
                $no_packing = (trim($row['no_packing']));
                $nama_shift = (trim($row['nama_shift']));
                $nama_group_shift = (trim($row['nama_group_shift']));
                $nama_grade = (trim(isset($row['nama_grade']) ? $row['nama_grade'] : ''));
                $model_ = (trim($row['model_']));
                $note = (trim($row['note']));
                $date_created = (trim($row['tr_date']));
                $userid_created = (trim($row['userid_created']));
                $tgl = pilih_satu_tgl($date_created, '');
                $user = pilih_satu_nama($userid_created, (isset($userid_modified) ? $userid_modified : ""));

                $status = $row['status'];
                $date_approved = pilih_satu_tgl($row['date_approved'], '');
                $userid_approved = pilih_satu_nama(trim($row['userid_approved']), '');

                $lemparan_detil = $val . "|" . $id_tr_packing;
                $list_batch = '';
                $list_batch2 = '';
                $list_lebar = '';
                $list_order = '';
                $sql_batch = "
			SELECT a.batch_no , b.id_tr_order, c.lebar, c.order_no
			FROM tr_packing_batch_no a 
			INNER JOIN tr_produksi_detail_batch_no b ON a.id_tr_produksi_detail_batch_no = b.id_tr_produksi_detail_batch_no
			INNER JOIN tr_order c ON b.id_tr_order = c.id_tr_order
			WHERE id_tr_packing = '$id_tr_packing' ";
                $qry_batch = mysql_query($sql_batch) or die('ERROR select : ' . $sql_batch);
                while ($row_batch = mysql_fetch_array($qry_batch)) {
                    $batch_no = $row_batch['batch_no'];
                    $lebar = $row_batch['lebar'];
                    $order_no = $row_batch['order_no'];
                    $list_batch .= $batch_no . '<br>';
                    $list_batch2 .= $batch_no . ", ";
                    $list_lebar .= $lebar . '<br>';
                    $list_order .= $order_no . '<br>';
                    //$list_batch .= $batch_no.'<br>';
                }

                $list1 = '';
                $j = 0;
                $list_table = ' <table width="100%" border="0"  cellpadding="2" cellspacing="2">';
                $sql_ = " SELECT DISTINCT b.nama_materal_packing,a.code_materal_packing,jumlah,lokasi FROM tr_packing_detail a
			  LEFT JOIN m_material_packing b ON a.code_materal_packing = b.code_materal_packing 
			  WHERE id_tr_packing = '$id_tr_packing' ORDER BY id_tr_packing_detail ";

                $qry_ = mysql_query($sql_) or die('ERROR select : ' . $sql_);
                while ($row_ = mysql_fetch_array($qry_)) {
                    $j++;
                    $code_materal_packing = (trim($row_['code_materal_packing']));
                    $jumlah = (trim($row_['jumlah']));
                    $lokasi = (trim($row_['lokasi']));
                    $nama_materal_packing = (trim($row_['nama_materal_packing']));

                    ($j % 2 == 1) ? ($tr = "<tr>") : ($tr = "");
                    //echo $tr;
                    $list1 .= $tr;
                    //$list1 .='<tr >';
                    $list1 .= '<td align="left">' . $code_materal_packing . ' (' . $jumlah . ') - ' . $nama_materal_packing . '</td>';
                    //	$list1 .='<td align="left">'.$nama_materal_packing.'</td>';
                    //$list1 .='</tr>';
                    ($j % 2 == 0) ? ($tr = "</tr>") : ($tr = "");
                    //	echo $tr;
                    $list1 .= $tr;

                    //	$j=$j+1;

                }
                $list_tutup = ' </table>';
                $list = $list_table . $list1 . $list_tutup;
                //echo $list;
                //offset+'|'+id_tr_pk+'|'+id_group+'|'+id_tr_order
                ?>
            <tr class="<?php if ($i % 2 == 0) {
                echo("table_row_even");
            } else {
                echo("table_row_odd");
            } ?>">
                <td width="1%" align="center"><?php echo $i ?></td>
                <td width="2%" align="center"><?php echo($id_tr_packing) ?></td>
                <td width="1%"
                    align="center"><?php echo $nama_shift . ' ' . $nama_group_shift . '<br>' . $model_ ?></td>
                <td width="1%" align="center"><?php echo $note ?></td>
                <td width="4%" align="center"><?php echo $list_order ?></td>
                <td width="2%" align="center"><?php echo $list_lebar ?></td>
                <td width="2%" align="center"><?php echo $list_batch ?></td>
                <td width="55%" align="center"><?php echo $list ?></td>
                <td width="1%" align="center"><?php echo $tgl . ' ' . $user ?>
                    <a onClick="add_packing_all(<?= "'" . $offset . '|' . $id_tr_pk . '|' . $id_group . '|' . $id_tr_order . '|' . $id_tr_packing . "'" ?>)"><img
                                src="../images/icons/edit_data.png" border="0"/></a>
                    <?php if ($status != 't') { ?>
                        <a onClick="del_batch_no_conf(<?= "'" . $id_tr_packing . '|' . $list_batch2 . '|' . $id_tr_order . "'" ?>)"><img
                                    src="../images/icons/del_data.png" border="0"/></a>
                    <?php } ?>
                </td>
                <td width="1%" align="center"><input type="checkbox" id="cek_app_<?= $i ?>" name="cek_app_[]"
                                                     value="<?= $id_tr_packing ?>"
                                                     onclick="choose_me_app(<?= $i ?>,<?= $id_tr_packing ?>);"

                        <?php if (trim($status) == 't') {
                            echo 'checked="checked"';
                            echo 'disabled="disabled"';

                        } else {
                            echo '';
                        }

                        ?>

                    />
                    <?php if ($status == 't') {
                        echo '<br> ' . nama_user($userid_approved) . '<br> ' . $date_approved;
                    } ?></td>
            </tr>

            <?php } ?>
        </table>
        <table width="100%">
            <tr class="">
                <td colspan="7" align="center"></td>
                <td width="9%" align="right">
                    <?php if ($akses <> '' or $akses <> ' ') { ?>
                        <input type="button" name="button_save2" id="button_save2" class="button" value="APPROVE"
                               onclick="approve_packing_conf(<?= "'" . (isset($lemparan) ? $lemparan : "") . '|3' . "'" ?>)"/>
                    <?php } ?>
                </td>
            </tr>
        </table>
    </form>
    <?php

}

function list_belum_pack()
{

    $par = isset($_REQUEST['par']) ? $_REQUEST['par'] : '';   //0|5933|1|3         //940|(50875,50876,50877,50878,50879,50880)
    $txt_list_order = $_REQUEST['txt_list_order'];

    $cbo_lebar = $_REQUEST['cbo_lebar'];
    $cbo_order = $_REQUEST['cbo_order'];
    $cbo_shift = $_REQUEST['cbo_shift'];

    $arr = explode("|", $par);
    $id_tr_packing = intval(isset($arr[3]) ? $arr[3] : 0);
    $join_exist = '';

    /*if ($id_tr_packing	> 0)
    {
        $act ='edit';
        $where_status_exist = " AND b.id_tr_packing = '$id_tr_packing' ";
    }
    else
    { $where_status_exist = ' AND b.batch_no is NULL';
    }
    */
    $where_status_exist = ' AND b.batch_no is NULL';
    /*echo 'cbo_lebar = '.$cbo_lebar .'<br>';
    echo 'cbo_order = '.$cbo_order .'<br>';
    echo 'cbo_shift = '.$cbo_shift .'<br>';
    echo 'id_tr_order = '.$id_tr_order .'<br>';

    echo 'list_belum_pack = '.$par .'<br>';
    echo 'txt_list_order = '.$txt_list_order .'<br>';*/

    $where_order = ''; $where_lebar = ''; $where_shift = '';
    if (intval($cbo_order) > 0) {
        $where_order = "  WHERE a.id_tr_order = '$cbo_order' ";
    } else {
        $where_order = " WHERE a.id_tr_order IN $txt_list_order ";
    }
    if (intval($cbo_lebar) > 0) {
        $where_lebar = " AND h.lebar ='$cbo_lebar'";
    }
    if (intval($cbo_shift) != 0) {
        $arr_shift = explode("|", $cbo_shift);
        $id_m_shift = $arr_shift[0];
        $id_m_group_shift = $arr_shift[1];
        $where_shift = " AND d.id_m_shift ='$id_m_shift' AND  d.id_m_group_shift ='$id_m_group_shift' ";
    }

    /*	echo 'where_order = '.$where_order. '<br>';
        echo 'where_lebar = '.$where_lebar. '<br>';
        echo 'where_shift = '.$where_shift. '<br>';*/

    $sql = "
		SELECT DISTINCT a.id_tr_produksi_detail_batch_no, a.batch_no, a.berat, b.batch_no as c_batch_no 
		, d.id_m_shift, d.id_m_group_shift, d.id_m_grade,d.date_created, d.userid_created, d.matcode_hasil
		, e.nama_shift, f.nama_group_shift
		, g.nama_grade , h.order_no, h.id_m_customer_detail, h.id_m_customer_detail2
		FROM tr_produksi_detail_batch_no a 
		LEFT JOIN tr_packing_batch_no b ON b.id_tr_produksi_detail_batch_no = a.id_tr_produksi_detail_batch_no
		LEFT JOIN tr_produksi_detail d ON a.id_tr_produksi_detail = d.id_tr_produksi_detail
		LEFT JOIN m_shift e ON e.id_m_shift = d.id_m_shift
		LEFT JOIN m_group_shift f ON f.id_m_group_shift = d.id_m_group_shift
		LEFT JOIN m_grade g ON g.id_m_grade = d.id_m_grade
		INNER JOIN tr_order h ON a.id_tr_order = h.id_tr_order
 		$join_exist 
		$where_order $where_lebar $where_shift $where_status_exist AND d.id_m_grade = '1' 
		  ORDER BY a.id_tr_order,a.batch_no
		";
//echo $id_tr_packing. ' xx '. $where_status_exist;
    $qry = mysql_query($sql) or die('ERROR select : ' . $sql);
    $jumlah_data = mysql_num_rows($qry);
    //die( $sql);
    //echo 'Total : '. $jumlah_data;
    ?>
    <form id="form_list_belum_pack" name="form_list_belum_pack">
        <table width="100%" border="1">
            <tr class="table_header">
                <td width="1%" rowspan="2">No</td>
                <td width="5%" rowspan="2" align="center">Batch No</td>
                <td colspan="9" align="center">LIST PRODUCTION, NOT YET PACK</td>
                <td align="center"><?php echo 'Total : ' . $jumlah_data ?></td>
                <td width="2%" rowspan="2" align="center"><input type="checkbox" id="check_all_batch"
                                                                 name="check_all_batch"
                                                                 onclick="checklist_all_batch(this)"/>
                    <input type="hidden" id="list_antrian_batch" name="list_antrian_batch"
                           value="<?php echo (isset($list_antrian_batch) ? $list_antrian_batch : "" ) ?>"/></td>
            <tr class="table_header">
                <td width="2%" align="center">Shift</td>
                <td width="7%" align="center">Date</td>
                <td width="8%" align="center">User</td>
                <td width="2%" align="center">Grade</td>
                <td width="2%" align="center">Width</td>
                <td width="2%" align="center">Length</td>
                <td width="2%" align="center">Weight (Kg)</td>
                <td width="4%" align="center">Material Code</td>
                <td width="4%" align="center">Order No</td>
                <td width="10%" align="center">Customer</td>
                <?php
                $i = 0;
                while ($row = mysql_fetch_array($qry))
                {
                $i++;
                $id_tr_produksi_detail_batch_no = (trim($row['id_tr_produksi_detail_batch_no']));
                $batch_no = (trim($row['batch_no']));
                $nama_shift = (trim($row['nama_shift']));
                $nama_group_shift = (trim($row['nama_group_shift']));
                $nama_grade = (trim($row['nama_grade']));
                $berat = (trim($row['berat']));
                $matcode_hasil = (trim($row['matcode_hasil']));
                $order_no = (trim($row['order_no']));
                $m_customer_detail = get_nama_customer(trim($row['id_m_customer_detail']));
                $m_customer_detail2 = get_nama_customer(trim($row['id_m_customer_detail2']));

                $date_created = (trim($row['date_created']));
                $userid_created = (trim($row['userid_created']));
                $tgl = pilih_satu_tgl($date_created, '');
                $user = pilih_satu_nama($userid_created, (isset($userid_modified) ? $userid_modified : "" ));
                //PBA0030084003000
                $lebar = intval(substr($matcode_hasil, 7, 4));
                $panjang = intval(substr($matcode_hasil, 11, 5));


                ?>
            <tr class="">
                <td width="1%" align="center"><?php echo $i ?></td>
                <td width="5%" align="center"><?php echo $batch_no ?></td>
                <td width="2%" align="center"><?php echo $nama_shift . ' ' . $nama_group_shift ?></td>
                <td width="7%" align="center"><?php echo $tgl ?></td>
                <td width="8%" align="center"><?php echo $user ?></td>
                <td width="2%" align="center"><?php echo $nama_grade ?></td>
                <td width="2%" align="center"><?php echo number_format($lebar) ?></td>
                <td width="2%" align="center"><?php echo number_format($panjang) ?></td>
                <td width="2%" align="center"><?php echo $berat ?></td>
                <td width="4%" align="center"> <?php echo $matcode_hasil ?></td>
                <td width="4%" align="center"> <?php echo $order_no ?></td>
                <td width="10%" align="center"><?php echo potong_data($m_customer_detail, 12) ?></td>
                <td width="2%" align="center">
                    <input type="checkbox" id="cek_batch_<?= $i ?>" name="cek_batch_[]"
                           value="<?= $id_tr_produksi_detail_batch_no ?>"
                           onclick="choose_me_batch(<?= $i ?>,<?= $id_tr_produksi_detail_batch_no ?>);"

                        <?php
                        if ($id_tr_packing > '0') {
                            // echo 'checked="checked"';
                            // echo 'disabled="disabled"';

                        } else {
                            echo '';
                        }

                        ?>

                    />

                </td>
            </tr>

            <?php } ?>
        </table>
    </form>

    <?php
}

function nilai_rps()
{
    $id_tr_order = $_REQUEST['id_tr_order'];
    $sql = "SELECT material_code1,bottom_box,material_code2,top_box,material_code3,layer, 
			material_code4, pe_foam ,material_code5, core_plug,
			material_code6,paper_core, jumlah  FROM tr_order a 
			LEFT JOIN m_packing_detail b ON a.id_m_packing_detail = b.id_m_packing_detail
			WHERE id_tr_order = '$id_tr_order' ";
    //echo 'xx'.$sql;
    $qry = mysql_query($sql) or die('ERROR select : ' . $sql);
    $jum_bottom = $jum_top = $jum_layer = $jum_core_plug = $jum_pe_foam = $jum_paper_core = 0;
    while ($row = mysql_fetch_array($qry)) {
        $jumlah = intval(trim($row['jumlah']));
        $jumlah = 1;

        $mat_bottom = intval(trim($row['material_code1']));
        $bottom_box = trim($row['bottom_box']);
        if ($mat_bottom != '') {
            $jum_bottom = $jumlah;
        }

        $mat_top = trim($row['material_code2']);
        $top_box = trim($row['top_box']);
        if ($mat_top != '') {
            $jum_top = $jumlah;
        }

        $mat_layer = trim($row['material_code3']);
        $layer = trim($row['layer']);
        //if ($mat_layer != '') {$jum_layer = 2*$jumlah;}
        if ($mat_layer != '') {
            $jum_layer = 2 * $jumlah;
        }

        $mat_pe_foam = trim($row['material_code4']);
        $pe_foam = trim($row['pe_foam']);
        //if ($mat_pe_foam != '') {$jum_pe_foam = 2*$jumlah;}
        if ($mat_pe_foam != '') {
            $jum_pe_foam = 2 * $jumlah;
        }

        $mat_core_plug = trim($row['material_code5']);
        $core_plug = trim($row['core_plug']);
        //if ($mat_core_plug != '') {$jum_core_plug = 2*$jumlah;}
        if ($mat_core_plug != '') {
            $jum_core_plug = 2 * $jumlah;
        }

        $mat_paper_core = trim($row['material_code6']);
        $paper_core = trim($row['paper_core']);
        if ($mat_paper_core != '') {
            $jum_paper_core = $jumlah;
        }
    }

    ?>

    <table width="100%" border="1">
        <tr class="table_header">
            <td width="20%">MATERIAL</td>
            <td width="70%"> FROM RPS</td>
            <td width="10%">QTY</td>
        <tr class="">
            <td>BOTTOM</td>
            <td><?php echo $mat_bottom . ' - ' . $bottom_box ?></td>
            <td align="center"><?php echo $jum_bottom ?></td>
        </tr>
        <tr class="">
            <td>TOP BOX</td>
            <td><?php echo $mat_top . ' - ' . $top_box ?></td>
            <td align="center"><?php echo $jum_top ?></td>
        </tr>
        <tr class="">
            <td>LAYER</td>
            <td><?php echo $mat_layer . ' - ' . $layer ?></td>
            <td align="center"><?php echo $jum_layer ?></td>
        </tr>
        <tr class="">
            <td>PE FOAM</td>
            <td><?php echo $mat_pe_foam . ' - ' . $pe_foam ?></td>
            <td align="center"><?php echo $jum_pe_foam ?></td>
        </tr>
        <tr class="">
            <td>CORE PLUG</td>
            <td><?php echo $mat_core_plug . ' - ' . $core_plug ?></td>
            <td align="center"><?php echo $jum_core_plug ?></td>
        </tr>
        <!--<tr class=""><td>PAPER CORE</td><td><?php echo $mat_paper_core . ' - ' . $paper_core ?></td><td align="center"><?php echo $jum_paper_core ?></td></tr>-->
    </table>

    <?php
}

function save_packing()
{
    $usernya = $_SESSION['userid'];
    $par = $_REQUEST['par'];


    $arr_par = explode("|", $par);
    $id_tr_order = intval($arr_par[0]);
    $id_tr_packing = intval($arr_par[1]);

    //die($list_antrian_batch);
    if ($id_tr_packing == 0) {
        $jenis = 'add';
    } else {
        $jenis = 'edit';
    }

//die('jenis : '.$jenis);
    $text_batch_no = isset($_POST['text_batch_no']) ? $_POST['text_batch_no'] : '';
    $cbo_merge = isset($_POST['cbo_merge']) ? $_POST['cbo_merge'] : '';

    $cek_akhir = substr($text_batch_no, -1);

    /*  ini utk input batch no
    if ($cek_akhir != "\n" )
        {
            $text_batch_no = $text_batch_no ."\n";
        }

      $jumlah_batch_no = substr_count( $text_batch_no, "\n" );

    if (($jumlah_batch_no == 0) and ($text_batch_no !=''))
    {
        $jumlah_batch_no = 1;
    }
     if (($jumlah_batch_no == 0) and ($text_batch_no ==''))
    {
        die('Batch No Empty');
    }
    $arr_batch_no = explode("\n",$text_batch_no);*/

    //start ini utk cek list bath cno
    $list_antrian_batch = $_REQUEST['list_antrian_batch'];
    $jumlah_batch_no = substr_count($list_antrian_batch, ",");
    $arr_batch_no = explode(",", $list_antrian_batch);
    //selesai ini utk cek list bath cno

    //die('xx'.$jumlah_batch_no);
    //die('xxx'.$list_antrian_batch);
    $id_tr_order = isset($_POST['text_id_tr_order']) ? $_POST['text_id_tr_order'] : '';
    $text_tanggal_awal = isset($_POST['text_tanggal_awal']) ? $_POST['text_tanggal_awal'] : '';

    $hour_from = $_POST['hour_from'];
    $minute_from = $_POST['minute_from'];
    $tr_date = $text_tanggal_awal . ' ' . $hour_from . ':' . $minute_from;

    $cbo_shift = isset($_POST['cbo_shift']) ? $_POST['cbo_shift'] : '';
    $cbo_group_shift = isset($_POST['cbo_group_shift']) ? $_POST['cbo_group_shift'] : '';

    $cbo_model = isset($_POST['cbo_model']) ? $_POST['cbo_model'] : '';
    $txt_keterangan = isset($_POST['txt_keterangan']) ? $_POST['txt_keterangan'] : '';

    $tgl = substr($text_tanggal_awal, 0, 10);

    $cbo_bottom = intval(isset($_POST['cbo_bottom']) ? $_POST['cbo_bottom'] : '');
    $text_bottom = isset($_POST['text_bottom']) ? $_POST['text_bottom'] : '';

    $cbo_top = intval(isset($_POST['cbo_top']) ? $_POST['cbo_top'] : '');
    $text_top = isset($_POST['text_top']) ? $_POST['text_top'] : '';

    $cbo_suspend = intval(isset($_POST['cbo_suspend']) ? $_POST['cbo_suspend'] : '');
    $text_suspend = isset($_POST['text_suspend']) ? $_POST['text_suspend'] : '';

    $cbo_layer = intval(isset($_POST['cbo_layer']) ? $_POST['cbo_layer'] : '');
    $text_layer = isset($_POST['text_layer']) ? $_POST['text_layer'] : '';

    $cbo_core_plug = intval(isset($_POST['cbo_core_plug']) ? $_POST['cbo_core_plug'] : '');
    $text_core_plug = isset($_POST['text_core_plug']) ? $_POST['text_core_plug'] : '';

    $cbo_pallet = intval(isset($_POST['cbo_pallet']) ? $_POST['cbo_pallet'] : '');
    $text_pallet = isset($_POST['text_pallet']) ? $_POST['text_pallet'] : '';

    $cbo_pe_foam = intval(isset($_POST['cbo_pe_foam']) ? $_POST['cbo_pe_foam'] : '');
    $text_pe_foam = isset($_POST['text_pe_foam']) ? $_POST['text_pe_foam'] : '';

    $cbo_paper_core = intval(isset($_POST['cbo_paper_core']) ? $_POST['cbo_paper_core'] : '');
    $text_paper_core = isset($_POST['text_paper_core']) ? $_POST['text_paper_core'] : '';

    $cbo_vendor_top = intval($_POST['cbo_vendor_top']);
    $cbo_vendor_bottom = intval($_POST['cbo_vendor_bottom']);
    $cbo_vendor_suspend = intval(isset($_POST['cbo_vendor_suspend']) ? $_POST['cbo_vendor_suspend'] : '');
    $cbo_vendor_layer = intval($_POST['cbo_vendor_layer']);
    $cbo_vendor_core_plug = intval($_POST['cbo_vendor_core_plug']);
    $cbo_vendor_pallet = intval($_POST['cbo_vendor_pallet']);
    $cbo_vendor_pe_foam = intval($_POST['cbo_vendor_pe_foam']);
    $cbo_vendor_paper_core = intval(isset($_POST['cbo_vendor_paper_core']) ? $_POST['cbo_vendor_paper_core'] : '');

    $var_top = "'" . $cbo_top . "','" . $text_top . "','" . $cbo_vendor_top . "','top'";
    //die('xxx'.$var_top);
    $var_bottom = "'" . $cbo_bottom . "','" . $text_bottom . "','" . $cbo_vendor_bottom . "','bottom'";
    $var_suspend = "'" . $cbo_suspend . "','" . $text_suspend . "','" . $cbo_vendor_suspend . "','suspend'";
    $var_layer = "'" . $cbo_layer . "','" . $text_layer . "','" . $cbo_vendor_layer . "','layer'";
    $var_core_plug = "'" . $cbo_core_plug . "','" . $text_core_plug . "','" . $cbo_vendor_core_plug . "','core_plug'";
    $var_pallet = "'" . $cbo_pallet . "','" . $text_pallet . "','" . $cbo_vendor_pallet . "','pallet'";
    $var_pe_foam = "'" . $cbo_pe_foam . "','" . $text_pe_foam . "','" . $cbo_vendor_pe_foam . "','pe_foam'";
    $var_paper_core = "'" . $cbo_paper_core . "','" . $text_paper_core . "','" . $cbo_vendor_paper_core . "','paper_core'";


    if ($jenis == 'add') {

        if ($cbo_merge == 'y') {
            $id_tr_packing = insert_into_tr_packing($id_tr_order, $cbo_shift, $cbo_group_shift, $tr_date, $cbo_model, $txt_keterangan);
        }

        $jumlah_add = 0;
        $jumlah_add_total = 0;
        for ($i = 0; $i < $jumlah_batch_no; $i++) {
            $batch_no_arr = $arr_batch_no[$i];

            if ($cbo_merge == 'n') {
                $id_tr_packing = insert_into_tr_packing($id_tr_order, $cbo_shift, $cbo_group_shift, $tr_date, $cbo_model, $txt_keterangan);
            }
            /* $sql_exe =
              "INSERT INTO tr_packing_batch_no(id_tr_packing,id_tr_produksi_detail_batch_no,batch_no)
               SELECT  '$id_tr_packing', id_tr_produksi_detail_batch_no,batch_no
               FROM tr_produksi_detail_batch_no WHERE batch_no = '$batch_no_arr' LIMIT 1 ";
              */
            $a = '';
            $sql_exe =
                "INSERT INTO tr_packing_batch_no(id_tr_packing,id_tr_order,id_tr_produksi_detail_batch_no,batch_no)
					 SELECT  '$id_tr_packing', id_tr_order, id_tr_produksi_detail_batch_no,batch_no 
					 FROM tr_produksi_detail_batch_no WHERE id_tr_produksi_detail_batch_no = '$batch_no_arr' LIMIT 1 ";

            $a .= $sql_exe . '<br';
            $query = mysql_query($sql_exe) or die('ERROR ' . (isset($pilihan) ? $pilihan : "") . ' : ' . $sql_exe);
            $list_sukses = '';
            $jumlah_add = mysql_affected_rows();
            if ($jumlah_add > 0) {

                $list_sukses .= $batch_no_arr . '\n';
                insert_into_tr_packing_detail($id_tr_packing, $cbo_top, $var_top, $cbo_bottom, $var_bottom, $cbo_suspend, $var_suspend, $cbo_layer, $var_layer, $cbo_core_plug, $var_core_plug, $cbo_pallet, $var_pallet, $cbo_pe_foam, $var_pe_foam, $cbo_paper_core, $var_paper_core);

            } else //jika tidak ada batch no nya
            {

            }
            $jumlah_add_total = $jumlah_add_total + $jumlah_add;
        }
        if ($jumlah_add == 0) //jika tidak ada BERHASIL, batch no nya
        {
            $sql_delete = " DELETE FROM tr_packing WHERE id_tr_packing = '$id_tr_packing' ";
            $query = mysql_query($sql_delete) or die('ERROR DELETE : ' . $sql_delete);
        }

        //die('xxx'.$a);
        //
    } else  // exist -- update
    {

        if ($cbo_merge == 'n' and $jumlah_batch_no > 1) // Kalau EDIT id_tr_packing TDK BISA di pecah per batch
        {
            die("Can't split, pls use Add");
            //$id_tr_packing = insert_into_tr_packing($id_tr_order,$cbo_shift,$cbo_group_shift,$tr_date,$cbo_model,$txt_keterangan);
        }
        $sql = " UPDATE tr_packing SET 
					id_m_shift = '$cbo_shift',
					id_m_group_shift = '$cbo_group_shift',
					tr_date = '$tr_date',
					model_ = '$cbo_model' ,
					note = '$txt_keterangan', 
					userid_modified = '$usernya',
					date_modified = now()
               WHERE  id_tr_packing = '$id_tr_packing' ";
        //die($sql);
        $query_inst_data = mysql_query($sql) or die('ERROR UPDATE : ' . $sql);

        $sql_del = "DELETE FROM tr_packing_detail WHERE id_tr_packing = '$id_tr_packing'";
        $query_ = mysql_query($sql_del) or die('ERROR DEL : ' . $sql_del);

        $sql_del = "DELETE FROM tr_packing_batch_no WHERE id_tr_packing = '$id_tr_packing'";
        $query_ = mysql_query($sql_del) or die('ERROR DEL : ' . $sql_del);

//$sql = "UPDATE SET ";

        for ($i = 0; $i < $jumlah_batch_no; $i++) {
            $batch_no_arr = $arr_batch_no[$i];

            if ($cbo_merge == 'n') // id_tr_packing di pecah per batch
            {

                //$id_tr_packing = insert_into_tr_packing($id_tr_order,$cbo_shift,$cbo_group_shift,$tr_date,$cbo_model,$txt_keterangan);
            }
            $sql_exe =
                "INSERT INTO tr_packing_batch_no(id_tr_packing,id_tr_order,id_tr_produksi_detail_batch_no,batch_no)
					 SELECT  '$id_tr_packing', id_tr_order, id_tr_produksi_detail_batch_no,batch_no 
					 FROM tr_produksi_detail_batch_no WHERE id_tr_produksi_detail_batch_no = '$batch_no_arr' LIMIT 1";

            $a .= $sql_exe . '<br';
            //	die($a);
            $query = mysql_query($sql_exe) or die('ERROR ' . (isset($pilihan) ? $pilihan : "" ) . ' : ' . $sql_exe);

            $jumlah_add = mysql_affected_rows();
            if ($jumlah_add > 0) {

                $list_sukses .= $batch_no_arr . '\n';
                insert_into_tr_packing_detail($id_tr_packing, $cbo_top, $var_top, $cbo_bottom, $var_bottom, $cbo_suspend, $var_suspend, $cbo_layer, $var_layer, $cbo_core_plug, $var_core_plug, $cbo_pallet, $var_pallet, $cbo_pe_foam, $var_pe_foam, $cbo_paper_core, $var_paper_core);

            } else //jika tidak ada batch no nya
            {

            }
            $jumlah_add_total = $jumlah_add_total + $jumlah_add;
        }

    }

    //	echo 'sukses';
    if ($jumlah_add_total > 0) {
        echo 'sukses';
    } else {
        echo $jumlah_add_total;
    }

}

function insert_into_tr_packing_detail($id_tr_packing, $cbo_top, $var_top, $cbo_bottom, $var_bottom, $cbo_suspend, $var_suspend, $cbo_layer, $var_layer, $cbo_core_plug, $var_core_plug, $cbo_pallet, $var_pallet, $cbo_pe_foam, $var_pe_foam, $cbo_paper_core, $var_paper_core)
{
//$var_top,$var_bottom,$var_suspend,$var_layer,$var_core_plug,$var_pallet,$var_pe_foam,$var_paper_core
//$var_bottom = $cbo_bottom.'|'.$text_bottom.'|'.$cbo_vendor_bottom;
    /*$var_top = $cbo_top.'|'.$text_top.'|'.$cbo_vendor_top;
    $var_bottom = $cbo_bottom.'|'.$text_bottom.'|'.$cbo_vendor_bottom;
    $var_suspend = $cbo_suspend.'|'.$text_suspend.'|'.$cbo_vendor_suspend;
    $var_layer = $cbo_layer.'|'.$text_layer.'|'.$cbo_vendor_layer;
    $var_core_plug = $cbo_core_plug.'|'.$text_core_plug.'|'.$cbo_vendor_core_plug;
    $var_pallet = $cbo_pallet.'|'.$text_pallet.'|'.$cbo_vendor_pallet;
    $var_pe_foam = $cbo_pe_foam.'|'.$text_pe_foam.'|'.$cbo_vendor_pe_foam;
    $var_paper_core = $cbo_paper_core.'|'.$text_paper_core.'|'.$cbo_vendor_paper_core;*/
    if ($cbo_bottom > 0) {
        $sql_insert = " 
				INSERT INTO tr_packing_detail 
				(id_tr_packing,code_materal_packing,jumlah,id_m_vendor_packing,lokasi) VALUES ('$id_tr_packing',$var_bottom) ";
        $query_ins = mysql_query($sql_insert) or die('ERROR INSERT : ' . $sql_insert);
    }
    if ($cbo_top > 0) {
        $sql_insert = " 
			INSERT INTO tr_packing_detail 
			(id_tr_packing,code_materal_packing,jumlah,id_m_vendor_packing,lokasi) VALUES ('$id_tr_packing',$var_top) ";
        $query_ins = mysql_query($sql_insert) or die('ERROR INSERT : ' . $sql_insert);
    }
    if ($cbo_suspend > 0) {
        $sql_insert = " 
		INSERT INTO tr_packing_detail 
		(id_tr_packing,code_materal_packing,jumlah,id_m_vendor_packing,lokasi) VALUES ('$id_tr_packing',$var_suspend) ";
        $query_ins = mysql_query($sql_insert) or die('ERROR INSERT : ' . $sql_insert);
    }
    if ($cbo_layer > 0) {
        $sql_insert = " 
		INSERT INTO tr_packing_detail 
		(id_tr_packing,code_materal_packing,jumlah,id_m_vendor_packing,lokasi) VALUES ('$id_tr_packing',$var_layer) ";
        $query_ins = mysql_query($sql_insert) or die('ERROR INSERT : ' . $sql_insert);
    }
    if ($cbo_core_plug > 0) {
        $sql_insert = " 
		INSERT INTO tr_packing_detail 
		(id_tr_packing,code_materal_packing,jumlah,id_m_vendor_packing,lokasi) VALUES ('$id_tr_packing',$var_core_plug) ";
        $query_ins = mysql_query($sql_insert) or die('ERROR INSERT : ' . $sql_insert);
    }
    if ($cbo_pallet > 0) {
        $sql_insert = " 
		INSERT INTO tr_packing_detail 
		(id_tr_packing,code_materal_packing,jumlah,id_m_vendor_packing,lokasi) VALUES ('$id_tr_packing',$var_pallet) ";
        $query_ins = mysql_query($sql_insert) or die('ERROR INSERT : ' . $sql_insert);
    }
    if ($cbo_pe_foam > 0) {
        $sql_insert = " 
		INSERT INTO tr_packing_detail 
		(id_tr_packing,code_materal_packing,jumlah,id_m_vendor_packing,lokasi) VALUES ('$id_tr_packing',$var_pe_foam) ";
        $query_ins = mysql_query($sql_insert) or die('ERROR INSERT : ' . $sql_insert);
    }
    if ($cbo_paper_core > 0) {
        $sql_insert = " 
		INSERT INTO tr_packing_detail 
		(id_tr_packing,code_materal_packing,jumlah,id_m_vendor_packing,lokasi) VALUES ('$id_tr_packing',$var_paper_core) ";
        $query_ins = mysql_query($sql_insert) or die('ERROR INSERT : ' . $sql_insert);
    }
}

function insert_into_tr_packing($id_tr_order, $cbo_shift, $cbo_group_shift, $tr_date, $cbo_model, $txt_keterangan)
{
    $usernya = $_SESSION['userid'];

    $tahun = substr($tr_date, 0, 4);
    $bulan = substr($tr_date, 5, 2);
    $periode = $bulan . $tahun;
    //die($periode);
    $sql_no = "SELECT max(no_packing) as max_no FROM tr_packing WHERE periode = '$periode'";
    $query_no = mysql_query($sql_no) or die('ERROR SELECT : ' . $sql_no);
    while ($row = mysql_fetch_array($query_no)) {
        $max_no = intval($row['max_no']) + 1;
    }


    $sql = " INSERT INTO tr_packing (no_packing,periode, id_m_shift,id_m_group_shift,tr_date,model_,note, userid_created,date_created)
    VALUES ('$max_no','$periode','$cbo_shift','$cbo_group_shift','$tr_date','$cbo_model','$txt_keterangan','$usernya',now()) ";
    //die($sql);
    $query_inst_data = mysql_query($sql) or die('ERROR INSERT : ' . $sql);

    $sql_1 = "SELECT LAST_INSERT_ID()";
    $result = mysql_query($sql_1);
    while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
        $last_id = $row[0];
        $id_tr_packing = $last_id;
    }
    return ($last_id);
}

function form_input()
{
    $all_id_tr_order = "";
    $lemparan_partai = (isset($_REQUEST['lemparan_partai']) ? $_REQUEST['lemparan_partai'] : "");
    $lemparan_partai_all = $_REQUEST['lemparan_partai_all'];
    if ($lemparan_partai_all != '')  //$offset ."|".$id_tr_pk.'|'. $id_m_group
    {
        $arr_isi = explode("|", $lemparan_partai_all);
        $offset = trim($arr_isi[0]);
        $id_tr_pk = trim($arr_isi[1]);
        $id_m_group = trim($arr_isi[2]);
        $id_tr_order = trim(isset($arr_isi[4]) ? $arr_isi[3] : "");
        $id_tr_packing = trim(isset($arr_isi[4]) ? $arr_isi[4] : "");
        $lemparan_belum_pack = $lemparan_partai_all;
    } else {
        $arr_isi = explode("|", $lemparan_partai);
        $id_tr_pk = trim($arr_isi[0]);
        $id_tr_order = trim($arr_isi[1]);
        $offset = trim($arr_isi[2]);
        $id_tr_packing = trim($arr_isi[3]);
        $lemparan_belum_pack = $lemparan_partai;
    }
// echo 'lemparan_partai_all'.$lemparan_partai_all;

    $var_mat = $id_tr_pk . "_" . $id_m_group;

    /*$par = $_REQUEST['lemparan'];
        $arr = explode("|",$par);
        $offset = $arr[0];
        $id_tr_pk = $arr[1];
        $id_m_group = $arr[2];*/


    $sql_order = "SELECT DISTINCT a.id_tr_order  from tr_order a	 
INNER JOIN tr_bahan b ON a.id_tr_bahan = b.id_tr_bahan
INNER JOIN tr_pk c ON b.id_tr_pk = c.id_tr_pk
WHERE c.id_tr_pk = '$id_tr_pk' and b.id_m_group = '$id_m_group'
ORDER BY a.id_tr_order ";
    $qry_order = mysql_query($sql_order) or die('ERROR select : ' . $sql_order);
    while ($row_order = mysql_fetch_array($qry_order)) {
        $id_tr_order = (trim($row_order['id_tr_order']));
        $all_id_tr_order .= $id_tr_order . ',';
    }

    $all_id_tr_order = "(" . substr($all_id_tr_order, 0, -1) . ")";
// echo 'xx'. $sql_order ;

    /*	echo 'lemparan_partai = '. $lemparan_partai.'<br>';
        echo 'id_tr_pk '. $id_tr_pk.'<br>';
        echo 'id_tr_order '. $id_tr_order.'<br>';
        echo 'id_tr_packing '. $id_tr_packing.'<br>';*/
//	echo ($lemparan_partai.'xx'.$id_tr_order);

    $tanggal_awal = date("Y-m-d");
    $tanggal_akhir = date("Y-m-d");
    $jam_awal = date("H");
    $menit_awal = date("i");
    ?>
    <script>
        $("#text_tanggal_awal").datepicker({dateFormat: 'yy-mm-dd'});
        $("#text_tanggal_akhir").datepicker({dateFormat: 'yy-mm-dd'});
    </script>

    <?php

    //nila RPS

    $sql = "SELECT * FROM tr_packing WHERE id_tr_packing = '$id_tr_packing' ";
    $lemparan = $id_tr_order . '|' . $id_tr_pk;

//echo $sql;
    $qry = mysql_query($sql) or die('ERROR select : ' . $sql);
    $jumlah_data_exist = mysql_num_rows($qry);

    if ($jumlah_data_exist > 0) {
        $act = 'edit';
        $button = 'UPDATE';
        $disabled = ' disabled = "disabled" ';
        $class = '';
        while ($row = mysql_fetch_array($qry)) {
            $id_m_shift = trim($row['id_m_shift']);
            $id_m_group_shift = trim($row['id_m_group_shift']);
            $tr_date = trim($row['tr_date']);
            $note = trim($row['note']);
            $model_ = trim($row['model_']);
            $batch_no = trim($row['batch_no']);
            $no_packing = trim($row['no_packing']);


            $tanggal_awal = substr($row['tr_date'], 0, 10);
            $jam_awal = substr($row['tr_date'], 11, 2);
            $menit_awal = substr($row['tr_date'], 14, 2);
            $id_tr_packing = $row['id_tr_packing'];
            $status = $row['status'];

            $userid_created = $row['userid_created'];
            $userid_modified = trim($row['userid_modified']);
            $user = pilih_satu_nama($userid_created, $userid_modified);

            $date_created = $row['date_created'];
            $date_modified = trim($row['date_modified']);
            $tgl = pilih_satu_tgl($date_created, $date_modified);
        }

        $sql = "SELECT id_tr_packing, 
				GROUP_CONCAT(IF(lokasi='bottom',(jumlah),NULL)) AS `jum_bottom`, 
				GROUP_CONCAT(IF(lokasi='bottom',code_materal_packing,NULL)) AS `mat_bottom`, 
				GROUP_CONCAT(IF(lokasi='bottom',id_m_vendor_packing,NULL)) AS `id_m_vendor_bottom`, 
				GROUP_CONCAT(IF(lokasi='top',jumlah,NULL)) AS `jum_top`, 
				GROUP_CONCAT(IF(lokasi='top',code_materal_packing,NULL)) AS `mat_top`,
				GROUP_CONCAT(IF(lokasi='top',id_m_vendor_packing,NULL)) AS `id_m_vendor_top`, 
				GROUP_CONCAT(IF(lokasi='suspend',jumlah,NULL)) AS `jum_suspend`, 
				GROUP_CONCAT(IF(lokasi='suspend',code_materal_packing,NULL)) AS `mat_suspend`,
				GROUP_CONCAT(IF(lokasi='suspend',id_m_vendor_packing,NULL)) AS `id_m_vendor_suspend`, 
				GROUP_CONCAT(IF(lokasi='layer',jumlah,NULL)) AS `jum_layer`, 
				GROUP_CONCAT(IF(lokasi='layer',code_materal_packing,NULL)) AS `mat_layer`,
				GROUP_CONCAT(IF(lokasi='layer',id_m_vendor_packing,NULL)) AS `id_m_vendor_layer`,  
				GROUP_CONCAT(IF(lokasi='core_plug',jumlah,NULL)) AS `jum_core_plug`, 
				GROUP_CONCAT(IF(lokasi='core_plug',code_materal_packing,NULL)) AS `mat_core_plug`,
				GROUP_CONCAT(IF(lokasi='core_plug',id_m_vendor_packing,NULL)) AS `id_m_vendor_core_plug`, 
				GROUP_CONCAT(IF(lokasi='pallet',jumlah,NULL)) AS `jum_pallet`, 
				GROUP_CONCAT(IF(lokasi='pallet',code_materal_packing,NULL)) AS `mat_pallet` ,
				GROUP_CONCAT(IF(lokasi='pallet',id_m_vendor_packing,NULL)) AS `id_m_vendor_pallet`, 
				GROUP_CONCAT(IF(lokasi='pe_foam',jumlah,NULL)) AS `jum_pe_foam`, 
				GROUP_CONCAT(IF(lokasi='pe_foam',code_materal_packing,NULL)) AS `mat_pe_foam`, 
				GROUP_CONCAT(IF(lokasi='pe_foam',id_m_vendor_packing,NULL)) AS `id_m_vendor_pe_foam`,
				GROUP_CONCAT(IF(lokasi='paper_core',jumlah,NULL)) AS `jum_paper_core`, 
				GROUP_CONCAT(IF(lokasi='paper_core',code_materal_packing,NULL)) AS `mat_paper_core`,
				GROUP_CONCAT(IF(lokasi='paper_core',id_m_vendor_packing,NULL)) AS `id_m_vendor_paper_core` 
			 FROM  tr_packing_detail
			 WHERE id_tr_packing ='$id_tr_packing'
			 GROUP BY id_tr_packing";
//echo 'xx'.$sql;

        $qry = mysql_query($sql) or die('ERROR select : ' . $sql);
        while ($row = mysql_fetch_array($qry)) {
            $jum_bottom = buang_double(trim($row['jum_bottom']));
            $mat_bottom = buang_double(trim($row['mat_bottom']));
            $id_m_vendor_bottom = buang_double(trim($row['id_m_vendor_bottom']));

            $jum_top = buang_double(trim($row['jum_top']));
            $mat_top = buang_double(trim($row['mat_top']));
            $id_m_vendor_top = buang_double(trim($row['id_m_vendor_top']));

            $jum_suspend = buang_double(trim($row['jum_suspend']));
            $mat_suspend = buang_double(trim($row['mat_suspend']));
            $id_m_vendor_suspend = buang_double(trim($row['id_m_vendor_suspend']));

            $jum_layer = buang_double(trim($row['jum_layer']));
            $mat_layer = buang_double(trim($row['mat_layer']));
            $id_m_vendor_layer = buang_double(trim($row['id_m_vendor_layer']));

            $jum_core_plug = buang_double(trim($row['jum_core_plug']));
            $mat_core_plug = buang_double(trim($row['mat_core_plug']));
            $id_m_vendor_core_plug = buang_double(trim($row['id_m_vendor_core_plug']));

            $jum_pallet = buang_double(trim($row['jum_pallet']));
            $mat_pallet = buang_double(trim($row['mat_pallet']));
            $id_m_vendor_pallet = buang_double(trim($row['id_m_vendor_pallet']));

            $jum_pe_foam = buang_double(trim($row['jum_pe_foam']));
            $mat_pe_foam = buang_double(trim($row['mat_pe_foam']));
            $id_m_vendor_pe_foam = buang_double(trim($row['id_m_vendor_pe_foam']));

            $jum_paper_core = buang_double(trim($row['jum_paper_core']));
            $mat_paper_core = buang_double(trim($row['mat_paper_core']));
            $id_m_vendor_paper_core = buang_double(trim($row['id_m_vendor_paper_core']));
        }
        $list_batch_no = '';
        $sql_batch = "SELECT batch_no FROM tr_packing_batch_no WHERE id_tr_packing = '$id_tr_packing' ORDER BY id_tr_packing_batch_no";
        $qry_batch = mysql_query($sql_batch) or die('ERROR select : ' . $sql_batch);

        $jumlah_batch_no = mysql_num_rows($qry_batch);
        if ($jumlah_batch_no > 1) {
            $id_cbo_merge = 'y';
        } else {
            $id_cbo_merge = 'n';
        }

        while ($row_batch = mysql_fetch_array($qry_batch)) {
            $batch_no = $row_batch['batch_no'];
            $list_batch_no .= $batch_no . "\r\n";

        }

    } else {
        $act = 'add';
        $button = 'SAVE';
        $class = "textbox_batch_no_lengkap";
        $sql = "SELECT material_code1,bottom_box,material_code2,top_box,material_code3,layer, 
			material_code4, pe_foam ,material_code5, core_plug,
			material_code6,paper_core, jumlah  FROM tr_order a 
			LEFT JOIN m_packing_detail b ON a.id_m_packing_detail = b.id_m_packing_detail
			WHERE id_tr_order = '$id_tr_order' ";
        $qry = mysql_query($sql) or die('ERROR select : ' . $sql);
        while ($row = mysql_fetch_array($qry)) {
            $jumlah = intval(trim($row['jumlah']));
            $jumlah = 1;
            $mat_bottom = intval(trim($row['material_code1']));
            $bottom_box = trim($row['bottom_box']);
            if ($mat_bottom != '') {
                $jum_bottom = $jumlah;
            }

            $mat_top = trim($row['material_code2']);
            $top_box = trim($row['top_box']);
            if ($mat_top != '') {
                $jum_top = $jumlah;
            }

            $mat_layer = trim($row['material_code3']);
            $layer = trim($row['layer']);
            //if ($mat_layer != '') {$jum_layer = 2*$jumlah;}
            if ($mat_layer != '') {
                $jum_layer = 2 * $jumlah;
            }

            $mat_pe_foam = trim($row['material_code4']);
            $pe_foam = trim($row['pe_foam']);
            //if ($mat_pe_foam != '') {$jum_pe_foam = 2*$jumlah;}
            if ($mat_pe_foam != '') {
                $jum_pe_foam = 2 * $jumlah;
            }

            $mat_core_plug = trim($row['material_code5']);
            $core_plug = trim($row['core_plug']);
            //if ($mat_core_plug != '') {$jum_core_plug = 2*$jumlah;}
            if ($mat_core_plug != '') {
                $jum_core_plug = 2 * $jumlah;
            }

            $mat_paper_core = trim($row['material_code6']);
            $paper_core = trim($row['paper_core']);
            if ($mat_paper_core != '') {
                $jum_paper_core = $jumlah;
            }
        }

    }
    $sql_shift = "SELECT a.id_m_shift as val , nama_shift as display FROM m_shift a WHERE status ='t' ";
    $sql_group_shift = "SELECT a.id_m_group_shift as val , nama_group_shift as display FROM m_group_shift a WHERE status ='t'";
    $sql_merge = " SELECT 'n' as val, 'NO' as display
         UNION SELECT 'y' as val, 'YES' as display ";

    $sql_model = "       SELECT 'S' as val , 'S' as display 
			  UNION  SELECT 'B' as val , 'B' as display
			  UNION  SELECT 'C' as val , 'C' as display";

    $sql_z = "SELECT a.order_no, b.id_m_group, a.id_m_customer_detail, a.id_m_customer_detail2 , c.nama_line
	 FROM tr_order a
	 INNER JOIN tr_bahan b ON a.id_tr_bahan = b.id_tr_bahan
	 LEFT JOIN m_line c on a.id_m_line = c.id_m_line
	 WHERE a.id_tr_order ='$id_tr_order'";
    $qry_z = mysql_query($sql_z) or die('ERROR select : ' . $sql_z);
    while ($row_z = mysql_fetch_array($qry_z)) {
        $order_no = trim($row_z['order_no']);
        $id_m_group = trim($row_z['id_m_group']);
        $id_m_packing_detail = trim(isset($row_z['id_m_packing_detail']) ? $row_z['id_m_packing_detail'] : "");
        $nama_customer_detail = get_nama_customer($row_z['id_m_customer_detail']);
        $nama_customer_detail2 = get_nama_customer($row_z['id_m_customer_detail2']);
        $nama_line = trim($row_z['nama_line']);
    }
    //echo $sql_z;

    ?>

    <table width=100% border='0'>
        <tr>
            <td align="center" colspan="3"><h2><?php echo strtoupper($act) ?> PACKING </h2></td>
            <td width="54%"><h2>NO &nbsp;: &nbsp;<?php echo tampilan_no_packing($id_tr_packing) ?></h2></td>
        </tr>
    </table>
    <form name="form_add_input" id="form_add_input" class="">
        <table width=100% border='0'>
            <tr class=''>
                <td width="11%">RPS</td>
                <td colspan="2"><strong><a target="_blank"
                                           href="../template/index_form_perintah_kerja.php?id_tr_pk=<?php echo $id_tr_pk ?>">
                            :&nbsp;<?= tampilan_no_rps($id_tr_pk) ?></a><?php echo ' ' . (isset($tampil_reslitter) ? $tampil_reslitter : "") ?></strong>
                    <input name='text_id_tr_order' type='hidden' class='' id='text_id_tr_order'
                           value='<?php echo $id_tr_order ?>'/>
                    <input name='text_id_tr_pk' type='hidden' class='' id='text_id_tr_pk'
                           value='<?php echo $id_tr_pk ?>'/>
                    <input name='text_id_group' type='hidden' class='' id='text_id_group'
                           value='<?php echo $id_m_group ?>'/></td>
                <td width='16%'>Date</td>
                <td width="38%"><strong>:&nbsp;</strong><input name="text_tanggal_awal" value="<?= $tanggal_awal ?>"
                                                               type="text" class="textbox_2" id="text_tanggal_awal"
                                                               maxlength="40"/>
                    <select id="hour_from" name="hour_from" class="combobox">
                        <?php for ($i = 0; $i <= 23; $i++) {
                            $data = str_pad($i, 2, "0", STR_PAD_LEFT);
                            ?>

                            <option value="<?= $data ?>"<?php if ($data == $jam_awal) {
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
                            <option value="<?= $data ?>"<?php if ($data == $menit_awal) {
                                echo(" selected=\"selected\"");
                            } ?>>
                                <?= $data ?>
                            </option>
                        <?php } ?>
                    </select>
                    <input type="hidden" name="txt_list_order" id="txt_list_order"
                           value="<?php echo $all_id_tr_order ?>"/></td>
            </tr>
            <tr>
                <td>Partai</td>
                <td width="8%"><strong>: <?php echo $id_m_group ?></strong></td>
                <td width="27%">Machine : <strong><?php echo $nama_line ?></strong></td>
                <td width='16%'>Model</td>
                <td>:<strong>
                        <?php makecomboonchange($sql_model, "cbo_model", "cbo_model", "", (isset($model_) ? $model_ : ""), "- Pilih -", "", ""); ?>
                    </strong></td>
            </tr>
            <tr>
                <td rowspan="3">Note</td>
                <td colspan="2" rowspan="3"><strong>
                        <textarea name="txt_keterangan" rows="3" class="textarea_3"
                                  id="txt_keterangan"><?php echo (isset($note) ? $note : "") ?></textarea>
                    </strong></td>
                <td align="left" valign="middle"><span class="warning">Shift *)</span></td>
                <td colspan="4" align="left" valign="middle"><strong>:
                        <?php makecomboonchange($sql_shift, "cbo_shift", "cbo_shift", "", (isset($id_m_shift) ? $id_m_shift : ""), "- Pilih -", "", ""); ?>
                        <span class="warning">&nbsp;Group *)&nbsp;</span>
                        <?php makecomboonchange($sql_group_shift, "cbo_group_shift", "cbo_group_shift", "", (isset($id_m_group_shift) ? $id_m_group_shift : ""), "- Pilih -", "", ""); ?>
                    </strong></td>

            </tr>
            <tr>
                <td align="left" valign="middle">&nbsp;</td>
                <td colspan="4" align="left" valign="middle">&nbsp;</td>
            </tr>
            <tr>
                <td align="left" valign="middle">Merged into one pack ?</td>
                <td colspan="4" align="left" valign="middle">:
                    <?php
                    if ($act == 'edit' and $id_cbo_merge == 'y') {
//makecomboonchange($sql_merge,"cbo_merge","cbo_merge","",$id_cbo_merge,"","disabled","");
                        echo 'YES';
                        ?>
                        <input name="cbo_merge" type="hidden" id="cbo_merge" value="<?php echo $id_cbo_merge ?>"/>
                        <?php
                    } else {
                        makecomboonchange($sql_merge, "cbo_merge", "cbo_merge", "", (isset($id_cbo_merge) ? $id_cbo_merge : "" ), "", "", "");
                    }
                    ?> </td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2"></td>
                <td align="left" valign="middle"></td>
                <td colspan="4" align="left" valign="middle"></td>
            </tr>
            <tr>
                <td colspan="5">
                    <div id="div_lihat_yg_mau_di_edit">
                        <hr/>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3" valign="top"><a onclick='show_hide_div(0)'><img src='../images/arrow_2.jpg' alt='Add'
                                                                                width='25' height='25' border='0'
                                                                                title='Show/Hide'/>&nbsp;&nbsp;&nbsp;Show
                        / Hide Packing From RPS</a></td>
                <td align="left" valign="middle"></td>
                <td colspan="4" align="left" valign="middle"><a
                            onclick='pilih_lebar(<?php echo '"' . $lemparan_belum_pack . '"' ?>)'><img
                                src='../images/arrow_2.jpg' alt='Add' width='25' height='25' border='0'
                                title='Show/Hide Batch No'/>&nbsp;&nbsp;&nbsp;Show / Hide Batch not yet pack</a>
                </td>
            </tr>


            <tr>

                <td colspan="5">
                    <div id="div_nilai_rps"></div>
                </td>
                <table width="60%">
                    <tr>
                        <td colspan="3">
                            <div id="div_belum_pack"></div>
                        </td>
                        <td>
                            <div id="div_shift"></div>
                        </td>
                    </tr>
                </table>

            </tr>
            <tr>
                <td colspan="6">
                    <div id="list_div_not_yet"></div>
                </td>
            </tr>


        </table>
        <script>
            <?php if (intval($id_tr_packing) > 0)
            { ?>
            var div_nya = "div_lihat_yg_mau_di_edit";
            var e = $("#" + div_nya);
            var val = <?php echo $id_tr_packing?>;

            Loaddiv(div_nya, 'inputan_packing.php', 'act=lihat_yg_mau_di_edit&id_tr_packing=' + val);

            e.show();
            <?php } ?>


            val = "div_nilai_rps";
            var div_nya = val;
            var e = $("#" + div_nya);
            var id_tr_order = <?php echo $id_tr_order ?>;
            Loaddiv(div_nya, 'inputan_packing.php', 'act=nilai_rps&id_tr_order=' + id_tr_order);
            e.hide();

        </script>

        <table width="100%" border="1" cellpadding="2" cellspacing="2">
            <tr class="table_header">
                <td width="20%">MATERIAL</td>
                <td width="35%" align="center">DESC</td>
                <td width="35%" align="center">VENDOR</td>
                <td width="10%">QTY</td>
            </tr>
            <tr class="">
                <td width="20%">BOTTOM BOX</td>
                <td width="35%">
                    <?php

                    $sql_combo = "SELECT code_materal_packing as val,nama_materal_packing as display FROM m_material_packing ";
                    $order_by = " ORDER BY nama_materal_packing";

                    $sql_bottom = $sql_combo . " WHERE group_materal_packing = 'PM_BXBOT' " . $order_by;
                    makecomboonchange($sql_bottom, "cbo_bottom", "cbo_bottom", "", $mat_bottom, "-- Pilih --", "", ""); ?>
                </td>
                <td width="35%">
                    <?php $sql = sql_vendor('bottom');
                    makecomboonchange($sql, "cbo_vendor_bottom", "cbo_vendor_bottom", "", (isset($id_m_vendor_bottom) ? $id_m_vendor_bottom : ""), "-- Pilih --", "", ""); ?>
                </td>
                <td width="10%" align="right">
                    <input name='text_bottom' type='text' class='textbox_batch_no' id='text_bottom' maxlength='3'
                           value='<?php echo (isset($jum_bottom) ? $jum_bottom : 0) ?>' onkeyup='checkDec(this)'/>
                </td>
            </tr>
            <tr class="">
                <!--<td  width="20%">SUSPENDED</td><td width="35%"><?php
                $sql_bottom = $sql_combo . " WHERE nama_materal_packing like '%SUSPEND%' " . $order_by;

                makecomboonchange($sql_bottom, "cbo_suspend", "cbo_suspend", "", $mat_suspend, "-- Pilih --", "", ""); ?></td>
<td width="35%"><?php $sql = sql_vendor('suspend');
                makecomboonchange($sql, "cbo_vendor_suspend", "cbo_vendor_suspend", "", $id_m_vendor_suspend, "-- Pilih --", "", ""); ?></td>
<td width="10%" align="right"><input name='text_suspend' type='text'  class='textbox_batch_no' id='text_suspend' maxlength='3' value = '<?php echo $jum_suspend ?>' onkeyup='checkDec(this)' /></td>-->
            </tr>
            <tr class="">
                <td width="20%">TOP BOX</td>
                <td width="35%">
                    <?php

                    $sql_bottom = $sql_combo . " WHERE group_materal_packing = 'PM_BXTOP' " . $order_by;
                    makecomboonchange($sql_bottom, "cbo_top", "cbo_top", "", $mat_top, "-- Pilih --", "", ""); ?>
                </td>
                <td width="35%"><?php $sql = sql_vendor('top');
                    makecomboonchange($sql, "cbo_vendor_top", "cbo_vendor_top", "", (isset($id_m_vendor_top) ? $id_m_vendor_top : ""), "-- Pilih --", "", ""); ?></td>
                <td width="10%" align="right"><input name='text_top' type='text' class='textbox_batch_no' id='text_top'
                                                     maxlength='3' value='<?php echo (isset($jum_top) ? $jum_top : "") ?>'
                                                     onkeyup='checkDec(this)'/></td>
            </tr>

            <tr class="">
                <td width="20%">LAYER / PLYWOOD</td>
                <td width="35%">
                    <?php

                    $sql_bottom = $sql_combo . " WHERE group_materal_packing = 'PM_LAWOD' " . $order_by;

                    makecomboonchange($sql_bottom, "cbo_layer", "cbo_layer", "", $mat_layer, "-- Pilih --", "", ""); ?></td>
                <td width="35%"><?php $sql = sql_vendor('layer');
                    makecomboonchange($sql, "cbo_vendor_layer", "cbo_vendor_layer", "", (isset($id_m_vendor_layer) ? $id_m_vendor_layer : ""), "-- Pilih --", "", ""); ?></td>
                <td width="10%" align="right"><input name='text_layer' type='text' class='textbox_batch_no'
                                                     id='text_layer2' maxlength='3' value='<?php echo (isset($jum_layer) ? $jum_layer : "") ?>'
                                                     onkeyup='checkDec(this)'/></td>
            </tr>
            <tr class="">
                <td>PE FOAM</td>
                <td width="35%"><?php

                    $sql_bottom = $sql_combo . " WHERE group_materal_packing IN ('PM_ACCES','PM_CLAY') " . $order_by;

                    makecomboonchange($sql_bottom, "cbo_pe_foam", "cbo_pe_foam", "", $mat_pe_foam, "-- Pilih --", "", ""); ?></td>
                <td width="35%"><?php $sql = sql_vendor('pe_foam');
                    makecomboonchange($sql, "cbo_vendor_pe_foam", "cbo_vendor_pe_foam", "", (isset($id_m_vendor_pe_foam) ? $id_m_vendor_pe_foam : ""), "-- Pilih --", "", ""); ?></td>
                <td width="10%" align="right"><input name='text_pe_foam' type='text' class='textbox_batch_no'
                                                     id='text_pe_foam' maxlength='3' value='<?php echo (isset($jum_pe_foam) ? $jum_pe_foam : "") ?>'
                                                     onkeyup='checkDec(this)'/></td>
            </tr>

            <tr class="">
                <td width="20%">CORE PLUG</td>
                <td width="35%">
                    <?php

                    $sql_bottom = $sql_combo . " WHERE group_materal_packing = 'PM_ACCES' " . $order_by;

                    makecomboonchange($sql_bottom, "cbo_core_plug", "cbo_core_plug", "", $mat_core_plug, "-- Pilih --", "", ""); ?>
                </td>
                <td width="35%">
                    <?php $sql = sql_vendor('core_plug');
                    makecomboonchange($sql, "cbo_vendor_core_plug", "cbo_vendor_core_plug", "", (isset($id_m_vendor_core_plug) ? $id_m_vendor_core_plug : ""), "-- Pilih --", "", ""); ?></td>
                <td width="10%" align="right"><input name='text_core_plug' type='text' class='textbox_batch_no'
                                                     id='text_core_plug' maxlength='3'
                                                     value='<?php echo (isset($jum_core_plug) ? $jum_core_plug : "") ?>' onkeyup='checkDec(this)'/>
                </td>
            </tr>
            <tr class="">
                <!-- <td>PAPER CORE</td>
  <td width="35%"><?php
                $sql_bottom = "SELECT code_materal_packing as val ,nama_materal_packing as display FROM m_material_packing WHERE group_materal_packing IN ('PM_ACCES','PM_PACOS','PM_PACOB')  ORDER BY nama_materal_packing ";
                $sql_bottom = $sql_combo . " WHERE group_materal_packing IN ('PM_ACCES','PM_PACOS','PM_PACOB') " . $order_by;

                makecomboonchange($sql_bottom, "cbo_paper_core", "cbo_paper_core", "", $mat_paper_core, "-- Pilih --", "", ""); ?></td>
  <td width="35%"><?php $sql = sql_vendor('paper_core');
                makecomboonchange($sql, "cbo_vendor_paper_core", "cbo_vendor_paper_core", "", $id_m_vendor_paper_core, "-- Pilih --", "", ""); ?></td>
  <td width="10%" align="right"><input name='text_paper_core' type='text'  class='textbox_batch_no' id='text_paper_core' maxlength='3' value = '<?php echo $jum_paper_core ?>' onkeyup='checkDec(this)' /></td>-->
            </tr>

            <tr class="">
                <td width="20%">OTHER</td>
                <td width="35%">
                    <?php
                    $sql_bottom = "SELECT code_materal_packing as val ,nama_materal_packing as display FROM m_material_packing ORDER BY nama_materal_packing ";

                    $sql_bottom = $sql_combo . " " . $order_by;
                    makecomboonchange($sql_bottom, "cbo_pallet", "cbo_pallet", "", (isset($mat_pallet) ? $mat_pallet : ""), "-- Pilih --", "", ""); ?>
                </td>
                <td width="35%"><?php $sql = sql_vendor(' ');
                    makecomboonchange($sql, "cbo_vendor_pallet", "cbo_vendor_pallet", "", (isset($id_m_vendor_pallet) ? $id_m_vendor_pallet : ""), "-- Pilih --", "", ""); ?></td>
                <td width="10%" align="right"><input name='text_pallet' type='text' class='textbox_batch_no'
                                                     id='text_layer' maxlength='3' value='<?php echo (isset($jum_pallet) ? $jum_pallet : "") ?>'
                                                     onkeyup='checkDec(this)'/></td>
            </tr>
        </table>
        <table width="100%">
            <tr class="">
                <td>
                </td>
            </tr>
            <tr class="">
                <td width="20%"><a
                            onclick='sudah_pack(<?= '"' . $id_tr_pk . "|" . $id_tr_order . "|00011|" . '"' ?>)'><img
                                src='../images/arrow_2.jpg' alt='Add' width='25' height='25' border='0'
                                title='Show/Hide History'/>&nbsp;&nbsp;&nbsp;Show / Hide History</a></td>
                <td width="65%" align="center">
                    <?php
                    $lemparan_save = $order_no . '|' . $id_tr_packing;
                    //echo  $lemparan_save;
                    if ($act == 'edit' and $status == 't') {
                    } else {
                        ?>

                        <input type="button" name="button_save" id="button_save" class="button"
                               value="<?php echo $button ?>"
                               onclick="save_packing(<?= "'" . $lemparan_save . "'" ?>)"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php }
                    if ($act == 'add') { ?>
                        <input type="button" name="button_tutup" id="button_tutup" class="button" value="CLOSE"
                               onclick="tutup_popup()"/>
                    <?php } else { ?> <input type="button" name="button_tutup" id="button_tutup" class="button"
                                             value="CANCEL" onclick="cancel_update()"/>
                    <?php } ?>
                </td>
                <td width="15%"></td>
            </tr>


        </table>
    </form>

    <table width="100%">
        <tr>
            <td>
                <div id="div_history_packing"></div>
            </td>
        </tr>
    </table>


    <?php

} ?>
