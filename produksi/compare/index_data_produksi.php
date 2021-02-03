<?php require_once("../include/config.php"); ?>
<?php require_once("../include/session.php"); ?>
<?php require_once("../include/function.php"); ?>
<?php 
    $pr = trim($_GET["pr"]);
    $arr_pr = explode("|", $pr);
    $menu_id = (int)trim($arr_pr[1]);
   // echo 'xxx' .$menu_id;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?= $title ?></title>
    </head>
 <script type="text/Javascript">
	function checkDec(el){
	 var ex = /^[0-9]+\.?[0-9]*$/;
	 if(ex.test(el.value)==false){
	   el.value = el.value.substring(0,el.value.length - 1);
  }
}

function approve_cw_conf(val)
{
		var cek = confirm('Are you sure to APPROVE ?');
            if(cek)
			{
				approve_cw(val);
			}
}

function approve_cw(val)
{

//alert(val);
	
	 		$.post('inputan_baru.php?act=approve_cw&list_antrian_app='+val,'',function(respon){
					if(respon=='sukses')
						{
							alert('success');
						}
					else
						{
							alert(respon); 
						}	
						
				});
			show_awal();

show_partai();
            
}

function checklist_all_batch_edit(val) {
	//	alert(val);
			var checkbox = document.form_list_yg_mau_di_edit.elements['cek_batch_edit_[]'];
			if ( checkbox.length > 0 ) {
				for (i = 0; i < checkbox.length; i++) {
					if ( val.checked ) {
						if  (checkbox[i].disabled == false)
						{
						checkbox[i].checked = true;
						choose_me_batch_edit((i+1),$('#cek_batch_edit_'+(i+1)).val());
						}
						
					}
					else {
						if  (checkbox[i].disabled == false)
						{
						checkbox[i].checked = false;
						choose_me_batch_edit((i+1),$('#cek_batch_edit_'+(i+1)).val());
						}
					}
				}
			}
			else {
				if ( val.checked ) {
					checkbox.checked = true;
					choose_me_batch_edit(1,$('#cek_batch_edit_'+1).val());
				}
				else {
					checkbox.checked = false;
					choose_me_batch_edit(1,$('#cek_batch_edit_'+1).val());
				}
			}
		}
		
	function choose_me_batch_edit(row,val){
		//alert(val);
			if($('#cek_batch_edit_'+row).attr('checked')==false){
				$('#cek_batch_edit_'+row).attr('checked',false);
				var list_val = $("#list_antrian_batch_edit").val();
				list_val = $("#list_antrian_batch_edit").val().replace(val+',','');
				$("#list_antrian_batch_edit").val(list_val);

			}else{
				$('#cek_batch_edit_'+row).attr('checked',true);
				var list_val = $("#list_antrian_batch_edit").val();
				if(list_val.search(val)==-1){
					list_val = list_val+val+',';
					$("#list_antrian_batch_edit").val(list_val);
				}
			}
		//alert(list_val);
		}

function edit_packing_all(val)
{	//add_packing_all(val);
	
	var div_nya = "div_lihat_yg_mau_di_edit"; 
	var e = $("#"+div_nya);
//  alert('var_simpan'+var_simpan);
	var txt_menuid = $("#txt_menuid").val();
	var txt_list_order = $("#txt_list_order").val();
	var id_tr_pk = $('#text_id_tr_pk').val();
	var id_group = $('#text_id_group').val();
	var id_tr_order = $('#text_id_tr_order').val();
	var offset = $('#txt_offset').val();
	
	Loaddiv(div_nya,'inputan_packing.php','act=lihat_yg_mau_di_edit&val='+val+'&txt_menuid='+txt_menuid+'&txt_list_order='+txt_list_order+'&id_tr_pk='+id_tr_pk+'&id_group='+id_group+'&id_tr_order='+id_group);
	e.show();
	
/*//	alert('txt_list_order :' + txt_list_order); 
	if (var_simpan != '1')
	{
     //alert('var_simpan___X___'+var_simpan);
 //	document.getElementById("txt_sembunyi").value = "1";
	
	}
	else if (var_simpan == '1')
	{

	//	document.getElementById("txt_sembunyi").value = "0";
	//	e.hide();
	}*/


	}
function pilih_shift(val)
{
	var var_simpan = $('#txt_var_simpan').val(); 
	var cbo_order = $('#cbo_order').val();
	var cbo_lebar = $('#cbo_lebar').val(); 
	var cbo_shift = val;

//alert (cbo_order +'__'+ cbo_lebar+'__'+ cbo_shift);
	var txt_list_order = $('#txt_list_order').val();

	var div_nya = "list_div_not_yet"; 
	var e = $("#"+div_nya);
 
	Loaddiv(div_nya,'inputan_packing.php','act=list_belum_pack&cbo_lebar='+cbo_lebar+'&txt_list_order='+txt_list_order+'&cbo_order='+cbo_order+'&cbo_shift='+cbo_shift);

/*
	if (var_simpan == '0' || var_simpan == '' )
	{e.hide(); }
else if (var_simpan == '1')
	{ e.show(); }*/
}
function pilih_lebar(val)
{
	var var_simpan = $('#txt_var_simpan').val(); 
	var txt_list_order = $('#txt_list_order').val(); 

	var div_nya = "div_belum_pack"; 
	var e = $("#"+div_nya);
	var div_nya_2 = "div_shift";
	var f = $("#"+div_nya_2);
	if (var_simpan == '0' || var_simpan == '' )
	{
 		txt_var_simpan.value='1';
		Loaddiv(div_nya,'inputan_packing.php','act=pilih_lebar&lemparan='+val); 
		Loaddiv(div_nya_2,'inputan_packing.php','act=shift&par='+val+'&txt_list_order='+txt_list_order);	
	    e.show();
		f.show();
	}
	else if (var_simpan == '1')
	{
		txt_var_simpan.value='0';
		e.hide();
		f.hide();
	}
change_order(val); 
}
function change_order(val)
{
 	//alert('change_order'+val);
	var var_simpan = $('#txt_var_simpan').val(); 
	var cbo_shift = $('#cbo_shift_not_yet').val(); 
	var cbo_order = $('#cbo_order').val();
	var cbo_lebar = $('#cbo_lebar').val();

	var div_nya = "list_div_not_yet"; 

	var e = $("#"+div_nya);

	var txt_list_order = $('#txt_list_order').val(); 
	Loaddiv(div_nya,'inputan_packing.php','act=list_belum_pack&par='+val+'&txt_list_order='+txt_list_order+'&cbo_shift='+cbo_shift+'&cbo_order='+cbo_order+'&cbo_lebar='+cbo_lebar);


	if (var_simpan == '0' || var_simpan == '' )
	{
	e.hide();
	
			}
else if (var_simpan == '1')
	{
		//txt_var_simpan.value='0';
	e.show();

	}
//Loaddiv(div_nya,'inputan_packing.php','act=history_packing&val='+val+'&txt_menuid='+txt_menuid);
}

function change_lebar(val)
{
//	alert(val);
	//txt_list_order.value = val;
	var cbo_shift = $('#cbo_shift_not_yet').val();
	var cbo_lebar = $('#cbo_lebar').val();
	//alert(cbo_lebar);
	var txt_list_order = $('#txt_list_order').val(); 
	Loaddiv("div_order_no",'inputan_packing.php','act=change_lebar&par='+val+'&txt_list_order='+txt_list_order+'&cbo_shift='+cbo_shift);
	//Loaddiv("div_shift",'inputan_packing.php','act=shift&par='+val+'&txt_list_order='+txt_list_order);
    change_order(val);
}

function add_packing_all(val)
{
//alert('add_packing_all = '+val);
			//alert(val);	 $offset ."|".$id_tr_pk.'|'. $id_m_group		
			var jumlah = (val.split("|").length-1);

			var myvar = val.split('|');
			//txt_offset.value = offset;
			var offset = myvar[0]
			var id_tr_pk = myvar[1];			
			var id_m_group = myvar[2];
			var id_tr_packing = myvar[3];
			txt_offset.value = offset;
			
  			$.post('inputan_packing.php?act=form_input&lemparan_partai_all='+val,'',function(respon_edit){
                $.fancybox(respon_edit);
            });
		
	
}

function checklist_all_batch(val) {
	//	alert(val);
			var checkbox = document.form_list_belum_pack.elements['cek_batch_[]'];
			if ( checkbox.length > 0 ) {
				for (i = 0; i < checkbox.length; i++) {
					if ( val.checked ) {
						if  (checkbox[i].disabled == false)
						{
						checkbox[i].checked = true;
						choose_me_batch((i+1),$('#cek_batch_'+(i+1)).val());
						}
						
					}
					else {
						if  (checkbox[i].disabled == false)
						{
						checkbox[i].checked = false;
						choose_me_batch((i+1),$('#cek_batch_'+(i+1)).val());
						}
					}
				}
			}
			else {
				if ( val.checked ) {
					checkbox.checked = true;
					choose_me_batch(1,$('#cek_batch_'+1).val());
				}
				else {
					checkbox.checked = false;
					choose_me_batch(1,$('#cek_batch_'+1).val());
				}
			}
		}
		
	function choose_me_batch(row,val){
		//alert(val);
			if($('#cek_batch_'+row).attr('checked')==false){
				$('#cek_batch_'+row).attr('checked',false);
				var list_val = $("#list_antrian_batch").val();
				list_val = $("#list_antrian_batch").val().replace(val+',','');
				$("#list_antrian_batch").val(list_val);

			}else{
				$('#cek_batch_'+row).attr('checked',true);
				var list_val = $("#list_antrian_batch").val();
				if(list_val.search(val)==-1){
					list_val = list_val+val+',';
					$("#list_antrian_batch").val(list_val);
				}
			}
		//alert(list_val);
		}




function approve_packing_conf()
{
		var cek = confirm('Are you sure to APPROVE ?');
            if(cek)
			{
				approve_packing();
			}
}

function approve_packing(val)
{

//alert(val);
	//var $list_antrian_app = $_POST['list_antrian_app'];
	var list_antrian_app = $('#list_antrian_app').val(); 
	//var myvar = val.split('|');
	
	 		$.post('inputan_packing.php?act=approve_packing&list_antrian_app='+list_antrian_app,'',function(respon_del){
					if(respon_del=='sukses')
						{
							alert('Success');
						}
					else
						{
							alert(respon_del); 
						}				
				});
			show_awal();
			cancel_update(); 

            
}
function approve_packing________()
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
		approve_data_pa($arr[$i]);
	}
	//echo 'sukses';
}
function checklist_all_app_packing(val) {
	//	alert(val);
			var checkbox = document.form_history.elements['cek_app_[]'];
			if ( checkbox.length > 0 ) {
				for (i = 0; i < checkbox.length; i++) {
					if ( val.checked ) {
						if  (checkbox[i].disabled == false)
						{
						checkbox[i].checked = true;
						choose_me_app((i+1),$('#cek_app_'+(i+1)).val());
						}
						
					}
					else {
						if  (checkbox[i].disabled == false)
						{
						checkbox[i].checked = false;
						choose_me_app((i+1),$('#cek_app_'+(i+1)).val());
						}
					}
				}
			}
			else {
				if ( val.checked ) {
					checkbox.checked = true;
					choose_me_app(1,$('#cek_app_'+1).val());
				}
				else {
					checkbox.checked = false;
					choose_me_app(1,$('#cek_app_'+1).val());
				}
			}
		}
		
	function choose_me_app(row,val){
		//alert(val);
			if($('#cek_app_'+row).attr('checked')==false){
				$('#cek_app_'+row).attr('checked',false);
				var list_val = $("#list_antrian_app").val();
				list_val = $("#list_antrian_app").val().replace(val+',','');
				$("#list_antrian_app").val(list_val);

			}else{
				$('#cek_app_'+row).attr('checked',true);
				var list_val = $("#list_antrian_app").val();
				if(list_val.search(val)==-1){
					list_val = list_val+val+',';
					$("#list_antrian_app").val(list_val);
				}
			}
		//alert(list_val);
		}
		
function del_batch_no_conf(val)
{

//alert(val);
	var myvar = val.split('|');
	var id_tr_packing = myvar[0];
	var batch_no = myvar[1];
	var id_tr_order = myvar[2];
 
	var cek = confirm('Are you sure to DELETE Packing Batch No : \n ' + batch_no + ' ?');
            if(cek)
			{
				$.post('inputan_packing.php?act=del_batch_no&par='+val,'',function(respon_del){
					if(respon_del=='sukses')
						{
							alert(batch_no + ' DEL Success');
						}
					else
						{
							alert(respon_del); 
						}				
				});
			show_awal();
			cancel_update(); 

            }
}


function sudah_pack(val)
{
	//alert(val);
	var var_simpan = $('#txt_sembunyi').val(); 

	var div_nya = "div_history_packing"; 
	var e = $("#"+div_nya);
//  alert('var_simpan'+var_simpan);
	var txt_menuid = $("#txt_menuid").val();
	var txt_list_order = $("#txt_list_order").val();

	var id_tr_pk = $('#text_id_tr_pk').val();
	var id_group = $('#text_id_group').val();
	var id_tr_order = $('#text_id_tr_order').val();
	var offset = $('#txt_offset').val();
//	alert('txt_list_order :' + txt_list_order); 
	if (var_simpan != '1')
	{
     //alert('var_simpan___X___'+var_simpan);
 	document.getElementById("txt_sembunyi").value = "1";
	Loaddiv(div_nya,'inputan_packing.php','act=history_packing&val='+val+'&txt_menuid='+txt_menuid+'&txt_list_order='+txt_list_order+'&id_tr_pk='+id_tr_pk+'&id_group='+id_group+'&id_tr_order='+id_group+'&offset='+offset);
	e.show();
	}
	else if (var_simpan == '1')
	{

		document.getElementById("txt_sembunyi").value = "0";
		e.hide();
	}
}

function ubah(val)
{
	
    var str = val.trim(); 
    var res = str.replace(" ", "zxxzxxxz");
 //   document.getElementById("text_id_batch_no").innerHTML = res;
	return(res);

}
function packing_show_batch_no(val){
	 if (event.keyCode == '13' )
	 {
		// var val = val.replace(" ", "zzzyyy131321xxxxxxcccccc");
		 var hasil = ubah(val);
		Loaddiv("div_text_batch_no",'inputan_packing.php','act=text_batch_no&batch_no='+hasil);  
	 }
}
function default_batch_no(baris_ke,type,val,sumber_data)
{
	//alert(event.keyCode);
 // alert('xxx'+tipe);
	//alert(jenis);

if (sumber_data !='')
{var jenis = '1';}
else
{ var jenis = '0';}

	 if (sumber_data !='' || event.keyCode == '13' )
	//if (jenis =='1')
	{ 
		//if (data !='')
		//alert(sumber_data);
		{
			//document.getElementById(tipe).value = data;
			//alert(tipe);
			var cbo_db = $('#cbo_db').val();

			var div_nya = "div_lot_no_"+baris_ke; 
			Loaddiv(div_nya,'inputan_baru.php','act=show_batch_no&paramater='+val+'&baris_ke='+baris_ke+'&jenis='+jenis+'&sumber_data='+sumber_data+'&tipe='+type+'&cbo_db='+cbo_db+'&kolom=lot_no');  

 			var div_nya = "div_jb_"+baris_ke;
			Loaddiv(div_nya,'inputan_baru.php','act=show_batch_no&paramater='+val+'&baris_ke='+baris_ke+'&jenis='+jenis+'&sumber_data='+sumber_data+'&tipe='+type+'&cbo_db='+cbo_db+'&kolom=jb'); 

			var div_nya = "div_cs_"+baris_ke; 
			Loaddiv(div_nya,'inputan_baru.php','act=show_batch_no&paramater='+val+'&baris_ke='+baris_ke+'&jenis='+jenis+'&sumber_data='+sumber_data+'&tipe='+type+'&cbo_db='+cbo_db+'&kolom=cs'); 

			var div_nya = "div_lebar_"+baris_ke; 
			Loaddiv(div_nya,'inputan_baru.php','act=show_batch_no&paramater='+val+'&baris_ke='+baris_ke+'&jenis='+jenis+'&sumber_data='+sumber_data+'&tipe='+type+'&cbo_db='+cbo_db+'&kolom=lebar');  

			var div_nya = "div_panjang_"+baris_ke; 
			Loaddiv(div_nya,'inputan_baru.php','act=show_batch_no&paramater='+val+'&baris_ke='+baris_ke+'&jenis='+jenis+'&sumber_data='+sumber_data+'&tipe='+type+'&cbo_db='+cbo_db+'&kolom=panjang');  

			var div_nya = "div_type_"+baris_ke; 
			Loaddiv(div_nya,'inputan_baru.php','act=show_batch_no&paramater='+val+'&baris_ke='+baris_ke+'&jenis='+jenis+'&sumber_data='+sumber_data+'&tipe='+type+'&cbo_db='+cbo_db+'&kolom=type'); 
			
			var div_nya = "div_mat_"+baris_ke; 
			Loaddiv(div_nya,'inputan_baru.php','act=show_batch_no&paramater='+val+'&baris_ke='+baris_ke+'&jenis='+jenis+'&sumber_data='+sumber_data+'&tipe='+type+'&cbo_db='+cbo_db+'&kolom=mat'); 
			
			var div_nya = "div_berat_matcode"+baris_ke; 
			Loaddiv(div_nya,'inputan_baru.php','act=show_batch_no&paramater='+val+'&baris_ke='+baris_ke+'&jenis='+jenis+'&sumber_data='+sumber_data+'&tipe='+type+'&cbo_db='+cbo_db+'&kolom=berat');  

		}
	}
	
	//var mat_value = document.getElementById(mat).value;
}
function show_hide_div(nilai)
{
	//alert("'"+val+"'");
	//var val = "'"+val+"'"
	if (nilai == '0') {var divnya = "div_nilai_rps";}
	else if (nilai == '1') {var divnya = "div_belum_pack";}
	
	var e = $("#"+divnya);
		e.toggle();
}
function save_packing(val)
{
	//alert(val);
	var order_no = val;
	var cbo_shift = $('#cbo_shift').val();
	var cbo_group_shift = $('#cbo_group_shift').val();
	var text_batch_no = $('#text_batch_no').val();
	var id_tr_pk = $('#text_id_tr_pk').val();
	var id_group = $('#text_id_group').val();
	
	var id_tr_order = $('#text_id_tr_order').val();
	

	var offset = $('#txt_offset').val();
	var list_antrian_batch = $('#list_antrian_batch').val();
	var list_antrian_batch_edit = $('#list_antrian_batch_edit').val();
	
	//alert('xxx'+list_antrian_batch_edit);
	//alert(list_antrian_batch);  
	//alert(text_batch_no);
	//text_batch_no.value='';
if (list_antrian_batch_edit === undefined || list_antrian_batch_edit === null) {
		if (list_antrian_batch === undefined || list_antrian_batch === null) {
			 // do something 
		 alert('Proses GAGAL, BATCH NO Belum Di Pilih  !');
				 return false;
		}
  	}
else
{
	list_antrian_batch = list_antrian_batch + list_antrian_batch_edit;
	list_antrian_batch = list_antrian_batch.replace("undefined", "");
}
	
	if (cbo_shift == '0')
		{
		 alert('Proses GAGAL, Shift Belum Di Pilih !');
		 return false;
		}
	if (cbo_group_shift == '0')
		{
			 alert('Proses GAGAL, Group Belum Di Pilih !');
			 return false;
		}

	
	var cek = confirm('Anda yakin untuk Simpan data ini?');
	if(cek)
	{
		$.post('inputan_packing.php?act=save_packing&par='+val+'&list_antrian_batch='+list_antrian_batch,$("#form_add_input").serialize(),function(respon_save){
					if(respon_save=='sukses')
						{
							alert('Success');
							//document.getElementById("text_batch_no").value = "";
							//document.getElementById("txt_var_simpan").value = "0";
							//belum_pack();
						}
					else
						{
							alert(respon_save); 
						}				
				});

		show_awal(); 

var par = offset+'|'+id_tr_pk+'|'+id_group+'|'+id_tr_order;
//alert(par);
//add_packing(par);
add_packing_all(par);
//parent.jQuery.fancybox.close();
	}
}
function cancel_update()
{
	var id_tr_pk = $('#text_id_tr_pk').val();
	var id_group = $('#text_id_group').val();
	var offset = $('#txt_offset').val();
	var id_tr_order = $('#text_id_tr_order').val();
	//var par = id_tr_pk+'|'+id_tr_order+'|'+offset;
	var par = offset+'|'+id_tr_pk+'|'+id_group+'|'+id_tr_order;
	//add_packing(par);
	add_packing_all(par);
}
function tutup_popup()
{
	parent.jQuery.fancybox.close();
}


function add_packing(val)
{
			//alert(val);			
			var jumlah = (val.split("|").length-1);

			var myvar = val.split('|');
			//txt_offset.value = offset;
			var id_tr_order = myvar[1];			
			var offset = myvar[2];
			var id_tr_packing = myvar[3];
			txt_offset.value = offset;
			
  			$.post('inputan_packing.php?act=form_input&lemparan_partai='+val,'',function(respon_edit){
                $.fancybox(respon_edit);
            });
		if ( jumlah == '3')
			{
				//alert(id_tr_packing);
				//document.getElementById("txt_sembunyi").value = "0";
				//sudah_pack(id_tr_order);
				//alert('ZZZZZZZZZZZZZZ');
			}
}
function simpan_detail_baru_all(val)
{
	
	
	var txt_awal_baris = $("#txt_awal_baris").val();
	var txt_jumlah_total_baris_atas = $("#txt_jumlah_total_baris_atas").val();
	var txt_jumlah_total_kolom_atas = $("#txt_jumlah_total_kolom_atas").val();
	var txt_jumlah_bahan = $("#txt_jumlah_bahan").val();
	var txt_jumlah_tambahan_tambah_satu = $("#txt_jumlah_tambahan_tambah_satu").val();
	var txt_jumlah_tambahan_tambah_satu = parseInt(txt_jumlah_tambahan_tambah_satu);
	
	//txt_jumlah_bahan = parseInt(txt_jumlah_bahan )+ 1;
	
		for (h = 1; h < txt_jumlah_bahan; h++) 
		{
			var text_bahan = text_bahan + $('#batch_no'+h).val();
			var text_mat = text_mat + $('#mat'+h).val();
			
		}
	
	var text_bahan = text_bahan.replace("undefined", "");
	var text_mat = text_mat.replace("undefined", "");
	//alert(text_bahan);
	if(text_bahan =='' )
		{
			 alert('Batch No Bahan Belum Di Isi! ');
			 return false;
		} 
	//alert(text_mat);
	if(text_mat =='' )
		{
			 alert('Matcode Belum Di Isi! ');
			 return false;
		} 
		
		var a = parseInt(txt_awal_baris);
		var b = parseInt(txt_jumlah_total_baris_atas);
		var c = parseInt(txt_jumlah_total_kolom_atas);
		var d = parseInt(txt_jumlah_tambahan_tambah_satu);
		var e = b-d;		
	
	//alert('txt_jumlah_tambahan_tambah_satu :'+d + 'txt_jumlah_total_baris_atas' + b);
	//return false;
	
	for (h = e; h < b ; h++) 
		{
			//alert(h);
			var h1 = h+1;
			var text_pjg = $('#text_pjg_'+h1).val();
			//alert(h1 + '|'+ text_pjg);
			var text_pjg = text_pjg.replace("undefined", "");
			if (text_pjg == '')
			{
				alert('Length ' +h1 +' empty' );
				return false;
			}

			var text_turunan_ = $('#text_turunan_'+h1).val();
			var text_turunan_ = text_turunan_.replace("undefined", "");
			if (text_turunan_ == '')
			{
				alert('Turunan ' +h1 +' empty' );	
				return false;
			}

			
			
		}								
		
	//return false;

	var offset =  $("#txt_offset").val();
	var cbo_shift = $('#cbo_shift').val();
	var cbo_group_shift = $('#cbo_group_shift').val();
	var cbo_m_line = $('#cbo_m_line').val();
	
	var txt_id_tr_pk = $('#txt_id_tr_pk').val();
	var txt_id_m_group = $('#txt_id_m_group').val();
	var cbo_shift = $('#cbo_shift').val();
	var cbo_group_shift = $('#cbo_group_shift').val();
	var cbo_m_line = $('#cbo_m_line').val();
	
	var text_date_awal = $('#text_tanggal_awal').val();
	var text_tanggal_awal = $('#text_tanggal_awal').val();
	var hour_from = $('#hour_from').val();
	var minute_from = $('#minute_from').val();
	var text_tanggal_awal = text_tanggal_awal + ' '+ hour_from +':'+minute_from;
	var text_tanggal_akhir = $('#text_tanggal_akhir').val();
	var hour_to = $('#hour_to').val();
	var minute_to = $('#minute_to').val();
	var text_tanggal_akhir = text_tanggal_akhir + ' '+hour_to+ ':'+minute_to;
	var text_break = $('#text_break').val();
	var txt_keterangan = $('#txt_keterangan').val();
	var mat1 ='';
	var mat2 ='';
	var mat3 ='';
	
	var batch_no1 = $('#batch_no1').val();
	var batch_no2 = $('#batch_no2').val();
	var batch_no3 = $('#batch_no3').val();
	

	if((text_date_awal =='' ))
						{
							 alert('Tanggal Awal Belum Di Isi! ');
							 return false;
						}

	if((batch_no2 !='' ))
				{
					var mat2 = $('#mat2').val();
					if((mat2 =='' ))
						{
							 alert('Material 2 Bahan Belum Di Isi! ');
							 return false;
						}
					
				}
	
	if((batch_no3 !='' ))
				{
					var mat3 = $('#mat3').val();
					if((mat3 =='' ))
						{
							 alert('Material 3 Bahan Belum Di Isi! ');
							 return false;
						}
					
				}

	
		if (cbo_shift == '0')
					{
					 alert('Proses GAGAL, Shift Belum Di Pilih !');
					 return false;
					}
			if (cbo_group_shift == '0')
					{
					 alert('Proses GAGAL, Group Belum Di Pilih !');
					 return false;
					}
			 if((batch_no1 !='' ))
				{
					var mat1 = $('#mat1').val();
					if((mat1 =='' ))
						{
							 alert('Material Bahan 1 Belum Di Isi! ');
							 return false;
						}
					
				}
	

var cek = confirm('Anda yakin untuk Simpan data ini?');
	if(cek)
	{
		for(z = a; z < b+1; z++) 
		{
			var list_val = $('#list_cek_'+z).val();
			
			var baris_ke = z;
			var jumlah_koma = (list_val.split(",").length - 1) 
			if (jumlah_koma > 0)
			{
				for (i = 0; i < jumlah_koma; i++) {
					var myvar = list_val.split(','); 
						if (myvar[i] != 'undefined')
						{
							var data = myvar[i];
							
							var cbo_ = $('#cbo_'+data).val();
							var data = data.replace("x", "z");
							var text_id_grade = $('#text_id_grade_'+data).val();
							var text_batch_no = $('#text_batch_no_'+data).val();
							var text_turunan = $('#text_turunan_'+data).val();
							var text_station = $('#text_station_'+data).val();
							var text_material = $('#text_material_'+data).val();
							var text_berat = $('#text_berat_'+data).val();
//alert('text_berat = ' + text_berat);
							var cbo_reason = $('#cbo_reason_'+data).val();
							var txt_keterangan_reject = $('#txt_keterangan_reject_'+data).val();
							var text_id_tr_order = $('#text_id_tr_order_'+data).val();
							var var_data = data.split('_');
							var kolom_ke = var_data[2];
							var text_pjg = $('#text_pjg_'+baris_ke).val();
							
							
			
							//var baris_ke = var_data[3];
						//	alert(cbo_ +'\n _text_batch_no : '+ text_batch_no  +'\n _text_material : '+ text_material +'\n _cbo_reason :'+ cbo_reason_  +'\n _txt_keterangan_reject : '+ txt_keterangan_reject_);
							if (cbo_ == '0')
								{
									 alert('Proses GAGAL, ada Grade Belum Di Pilih !');
									 return false;
								}
						
						var par = text_tanggal_awal+'^'+text_tanggal_akhir+'^'+cbo_shift+'^'+cbo_group_shift+'^'+text_break+'^'+txt_keterangan+'^'+mat1+'^'+mat2+'^'+mat3+'^'+cbo_m_line+'^'+cbo_+'^'+text_id_grade+'^'+text_batch_no+'^'+text_material+'^'+cbo_reason+'^'+txt_keterangan_reject+'^'+text_turunan+'^'+text_station+'^'+txt_id_tr_pk+'^'+txt_id_m_group+'^'+text_id_tr_order+'^'+kolom_ke+'^'+baris_ke+'^'+text_berat+'^'+i
								//alert(par); 
								if (par != '') {simpan_detail_baru(par);}
							
						}
				
					}
			}
		}

	//cek
		var text_cbo_order;
		var total_width;
		var total_text_station;
		//UPDATE station
		var total_kolom_ke = txt_jumlah_total_kolom_atas;
		for (i = 0; i < total_kolom_ke; i++) 
		{
			var j = i+1;
			
			var text_station = $('#text_station_'+j).val()+'|';
			var total_text_station = total_text_station + text_station ; 

			var text_cbo_order = $('#cbo_order_'+j).val()+'|';
			var total_text_cbo_order = total_text_cbo_order + text_cbo_order ; 

			var text_cbo_lebar = $('#cbo_lebar_'+j).val()+'|';
			var total_text_cbo_lebar = total_text_cbo_lebar + text_cbo_lebar ;

		} 
		lemparan_station = txt_id_tr_pk+'^'+txt_id_m_group+'^'+total_text_station+'^'+total_text_cbo_order+'^'+total_text_cbo_lebar
		//alert(total_text_station);

		
		$.post('inputan_baru.php?act=update_station&par='+lemparan_station,$("#form_add_input").serialize(),function(respon_save){
					if(respon_save=='sukses'){alert('Berhasil di simpan');	
					}			
				}); 
		//selesai

		var lemparan_inputan_baru = offset+'|'+ txt_id_tr_pk +'|'+ txt_id_m_group;

		show_awal();
		inputan_baru(lemparan_inputan_baru);	
	//
	}
}
function change_cbo_order(val)
{
	//alert(val);
	var myvar = val.split('|');
    var id_tr_order = myvar[0];
	var kolom_ke = myvar[1];

Loaddiv('div_cbo_order_'+kolom_ke,'inputan_baru.php','act=show_lebar_order&id_tr_order='+id_tr_order+'&kolom_ke='+kolom_ke);  

}
function hitung_berat_di_produksi()
{
 
       var obj = document.form_view_sub;
        var text_material = $("#text_material").val();
		var text_qty = $("#text_qty").val();
		
		var xmlHttp = GetXmlHttpObject();
        var url = "../ajax/hitung_berat_produksi.php";

        var par = "pr="+text_qty +"|"+ text_material+"|"+ "&mr=" + Math.random();
        if (!xmlHttp) {
            return;
        }
                    
        xmlHttp.onreadystatechange = function() {
            var arrResponseText;
            if (xmlHttp.readyState == 4) {
                arrResponseText = xmlHttp.responseText.split("|");
                document.getElementById("div_hitung_berat").innerHTML = arrResponseText[1];
                
            } else {
               
                document.getElementById("div_hitung_berat").innerHTML = "<img src=\"../images/ajax.gif\" alt=\"loading...\" border=\"0\" />";
            }
        }
        xmlHttp.open("POST", url, true);
        xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlHttp.setRequestHeader("Content-length", par.length);
        xmlHttp.setRequestHeader("Connection", "close");
        xmlHttp.send(par);
    
}


function display_tipe(tipe,data,mat,baris_ke,batch_no,id_tr_produksi_detail_bahan)
{

//alert(mat+'zz'+ batch_no+'zz'+id_tr_produksi_detail_bahan);
 if (event.keyCode != 0 )
	{ 
		if (data !='')
		{
			document.getElementById(tipe).value = data;
		}
	}
var mat_value = document.getElementById(mat).value;
//alert(mat_value+'xx'+ baris_ke+'xx'+batch_no+'xx'+id_tr_produksi_detail_bahan);
//alert('xx'+ mat_value);
show_berat_matcode(mat_value,baris_ke,batch_no,id_tr_produksi_detail_bahan);
}
function delete_bahan_awal(lot,batch_no,jb,cs,tipe,lebar,panjang,mat,berat)
{
//alert(lot);
document.getElementById(lot).value = '';
document.getElementById(batch_no).value = '';
document.getElementById(jb).value = '';
document.getElementById(cs).value = '';
document.getElementById(tipe).value = '';
document.getElementById(lebar).value = '';
document.getElementById(panjang).value = '';
document.getElementById(mat).value = '';
document.getElementById(berat).value = '0';

//show_tambahan_bahan('0');
}

function display(tipe,lebar,panjang,val,val2) {

 if (event.keyCode != 0 )
	{ 
//alert(no);
//alert(val);
		var atipe =  document.getElementById(tipe).value ;	
		
		var atipe = atipe.toUpperCase();
		
		var alebar =  document.getElementById(lebar).value ;
		var apanjang =  document.getElementById(panjang).value ;
		
		var str = "" + alebar
		var pad = "0000"
		var lebar = pad.substring(0, pad.length - str.length) + str
		
		var str2 = "" + apanjang
		var pad = "00000"
		var panjang = pad.substring(0, pad.length - str2.length) + str2
		if (atipe != '')
			{
var matcode = atipe +lebar+panjang;
				//document.getElementById(val).value = atipe +lebar+panjang;
		document.getElementById(val).value = matcode;
//document.getElementById(val2).value = panjang;
//document.getElementById(val2).value = matcode;

			}
//var berat = 


//alert(matcode);
	}
       
    }

function nextfield(val)
{
 if (event.keyCode != 0 )
	{ 
	document.getElementById(val).focus();
	}
 /*  if (event.keyCode == 16 )
	{ 
	document.getElementById(val).focus().select();
	}*/
}

function nextfield_enter(val)
{
 if (event.keyCode == 13 )
	{ 
	document.getElementById(val).focus();
	}
}




function choose_me_cetak(kolom,row,val){
	//	alert(kolom + '--'+row + '--'+val);
		
			if($('#cek_cetak_'+kolom+'_'+row).attr('checked')==false){
				$('#cek_cetak_'+kolom+'_'+row).attr('checked',false);
				var list_val = $('#var_print_'+row).val();
				list_val = $('#var_print_'+row).val().replace(val+',','');
				$('#var_print_'+row).val(list_val);
				/*$("#nilai"+row).attr("disabled", true);
				$("#roll_bahan"+row).attr("disabled", true);
				$("#cbo_group"+row).attr("disabled", true);*/


			}else{
				$('#cek_cetak_'+kolom+'_'+row).attr('checked',true);
				/*$("#nilai"+row).attr("disabled", false);
				$("#roll_bahan"+row).attr("disabled", false);
				$("#cbo_group"+row).attr("disabled", false);*/
				var list_val = $('#var_print_'+row).val();
				if(list_val.search(val)==-1){
					list_val = list_val+val+',';
					$('#var_print_'+row).val(list_val);
				}
			}
		
		}

function choose_me(row,val){
		//alert(val);
			if($('#cek_'+row).attr('checked')==false){
				$('#cek_'+row).attr('checked',false);
				var list_val = $("#list_antrian").val();
				list_val = $("#list_antrian").val().replace(val+',','');
				$("#list_antrian").val(list_val);
				/*$("#nilai"+row).attr("disabled", true);
				$("#roll_bahan"+row).attr("disabled", true);
				$("#cbo_group"+row).attr("disabled", true);*/


			}else{
				$('#cek_'+row).attr('checked',true);
				/*$("#nilai"+row).attr("disabled", false);
				$("#roll_bahan"+row).attr("disabled", false);
				$("#cbo_group"+row).attr("disabled", false);*/
				var list_val = $("#list_antrian").val();
				if(list_val.search(val)==-1){
					list_val = list_val+val+',';
					$("#list_antrian").val(list_val);
				}
			}
		
		}
function checklist_all(val) {
	//	alert(val);
			var checkbox = document.form_view_sub.elements['cek_[]'];
			if ( checkbox.length > 0 ) {
				for (i = 0; i < checkbox.length; i++) {
					if ( val.checked ) {
						if  (checkbox[i].disabled == false)
						{
						checkbox[i].checked = true;
						choose_me((i+1),$('#cek_'+(i+1)).val());
						}
						
					}
					else {
						if  (checkbox[i].disabled == false)
						{
						checkbox[i].checked = false;
						choose_me((i+1),$('#cek_'+(i+1)).val());
						}
					}
				}
			}
			else {
				if ( val.checked ) {
					checkbox.checked = true;
					choose_me(1,$('#cek_'+1).val());
				}
				else {
					checkbox.checked = false;
					choose_me(1,$('#cek_'+1).val());
				}
			}
		}
////

function checklist_all_inp(val) {
	//	alert(val);
			list_antrian_input='';
list_antrian_input.value ='';
			var checkbox = document.form_add_input.elements['cek_inp_[]'];
			if ( checkbox.length > 0 ) {
				for (i = 0; i < checkbox.length; i++) {
					if ( val.checked ) {
						if  (checkbox[i].disabled == false)
						{
						checkbox[i].checked = true;
						choose_me_inp((i+1),$('#cek_inp_'+(i+1)).val());
						}
						
					}
					else {
						if  (checkbox[i].disabled == false)
						{
						checkbox[i].checked = false;
						choose_me_inp((i+1),$('#cek_inp_'+(i+1)).val());
						}
					}
				}
			}
			else {
				if ( val.checked ) {
					checkbox.checked = true;
					choose_me_inp(1,$('#cek_inp_'+1).val());
				}
				else {
					checkbox.checked = false;
					choose_me_inp(1,$('#cek_inp_'+1).val());
				}
			}
		}
function show_berat_matcode_x(mat, baris_ke) 
{
      
		//var matcode = val;
		//var divnya = "div_berat_matcode"+baris_ke;
		var mat_value = document.getElementById(mat).value;
alert (mat_value);
alert (baris_ke);
//div_berat_matcode_x

document.getElementById(mat).style.display = 'block'
show_berat_matcode(mat_value,baris_ke);

}

function show_berat_matcode_1(val, baris_ke,berat) 
{
      
		var matcode = val;
		var divnya = "div_berat_matcode"+baris_ke;
		var batchno_nya = "batch_no"+baris_ke;
		var batch_no_value = document.getElementById(batchno_nya).value;

//alert ('batch_no_value');
		var xmlHttp = GetXmlHttpObject();
        var url = "../ajax/berat_matcode.php";

        var par = "pr="+matcode+"|"+baris_ke+"|"+batch_no_value+ "&mr=" + Math.random();
        if (!xmlHttp) {
            return;
        }
                    
        xmlHttp.onreadystatechange = function() {
            var arrResponseText;
            if (xmlHttp.readyState == 4) {
                arrResponseText = xmlHttp.responseText.split("|");
                document.getElementById(divnya).innerHTML = arrResponseText[1];
                
            } else {
               
                document.getElementById(divnya).innerHTML = "<img src=\"../images/ajax.gif\" alt=\"loading...\" border=\"0\" />";
            }
        }

        xmlHttp.open("POST", url, true);
        xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlHttp.setRequestHeader("Content-length", par.length);
        xmlHttp.setRequestHeader("Connection", "close");
        xmlHttp.send(par);
    }
function show_berat_matcode(val,baris_ke, batch_no,id_tr_produksi_detail_bahan) 
   {
	  // alert(val + 'baris_ke ='+baris_ke+ 'batch_no ='+batch_no+ 'id_tr_produksi_detail_bahan ='+id_tr_produksi_detail_bahan);
      //  var obj = document.form_view_sub;
//alert(obj.berat[baris_ke].value);
       /* var cbo_prod_detil = $("#cbo_prod_detil").val();
		var id_m_reason = $("#id_m_reason").val();*/
//var berat = berat.replace(" ", "x");
//alert(id_tr_produksi_detail_bahan);
	//var batch_no_value = document.getElementById(batch_no).value;
	var batch_no_value = $("#batch_no").val();
	var matcode = val;
//var berat = '0';
	var divnya = "div_berat_matcode"+baris_ke;
//alert (divnya);
	var xmlHttp = GetXmlHttpObject();
    var url = "../ajax/berat_matcode.php";

    var par = "pr="+matcode+"|"+baris_ke+"|"+batch_no_value+"|"+id_tr_produksi_detail_bahan+ "&mr=" + Math.random();
        if (!xmlHttp) {
            return;
        }
                    
        xmlHttp.onreadystatechange = function() {
            var arrResponseText;
            if (xmlHttp.readyState == 4) {
                arrResponseText = xmlHttp.responseText.split("|");
                document.getElementById(divnya).innerHTML = arrResponseText[1];
                
            } else {
               
                document.getElementById(divnya).innerHTML = "<img src=\"../images/ajax.gif\" alt=\"loading...\" border=\"0\" />";
            }
        }

        xmlHttp.open("POST", url, true);
        xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlHttp.setRequestHeader("Content-length", par.length);
        xmlHttp.setRequestHeader("Connection", "close");
        xmlHttp.send(par);
    }

function call_all_batch_no(val)
{
show_no_bath(val);
show_batchno(val);
}
function show_no_bath(val) 
   {
        var obj = document.form_add_batch_no;
       /* var cbo_prod_detil = $("#cbo_prod_detil").val();
		var id_m_reason = $("#id_m_reason").val();*/
		var id_tr_produksi_detail = $("#cbo_prod_detil").val();

		var xmlHttp = GetXmlHttpObject();
        var url = "../ajax/no_batch.php";

        var par = "pr="+id_tr_produksi_detail + "&mr=" + Math.random();
        if (!xmlHttp) {
            return;
        }
                    
        xmlHttp.onreadystatechange = function() {
            var arrResponseText;
            if (xmlHttp.readyState == 4) {
                arrResponseText = xmlHttp.responseText.split("|");
                document.getElementById("div_no").innerHTML = arrResponseText[1];
                
            } else {
               
                document.getElementById("div_no").innerHTML = "<img src=\"../images/ajax.gif\" alt=\"loading...\" border=\"0\" />";
            }
        }

        xmlHttp.open("POST", url, true);
        xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlHttp.setRequestHeader("Content-length", par.length);
        xmlHttp.setRequestHeader("Connection", "close");
        xmlHttp.send(par);
    }



function show_bahan(val) 
   {
        var flagtrans = 8;
//alert(val);

		var id_tr_pk = $("#id_tr_pk").val();
		var id_tr_order = $("#id_tr_order_asli").val();
		var id_tr_produksi_detail = $("#id_tr_produksi_detail").val();
		var id_m_group = $("#id_m_group").val();
		data = "pr="+id_tr_pk +"|"+ id_m_group+"|"+ id_tr_order +"|"+id_tr_produksi_detail + "&mr=" + Math.random();
//alert(data );

		//var periode = $("#cbo_periode").val();
        var obj = document.form_view_sub;
        var xmlHttp = GetXmlHttpObject();
        var url = "../ajax/show_bahan.php";
        //var par = "pr="+id_tr_pk +"|"+ id_m_group+"|"+ id_tr_order +"|"+id_tr_produksi_detail + "&mr=" + Math.random();
var par = data;
		if (!xmlHttp) {
            return;
        }
                    
        xmlHttp.onreadystatechange = function() {
            var arrResponseText;
            if (xmlHttp.readyState == 4) {
                arrResponseText = xmlHttp.responseText.split("|");
                document.getElementById("div_bahan").innerHTML = arrResponseText[1];
		    } else {
                document.getElementById("div_bahan").innerHTML = "<img src=\"../images/ajax.gif\" alt=\"loading...\" border=\"0\" />";
            }
        }
        xmlHttp.open("POST", url, true);
        xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlHttp.setRequestHeader("Content-length", par.length);
        xmlHttp.setRequestHeader("Connection", "close");
        xmlHttp.send(par);
show_tambahan_bahan(data);
    }       
function show_tambahan_bahan(val) 
   {
        var flagtrans = 8;
//alert(val);

var id_tr_pk = $("#id_tr_pk").val();
var id_tr_order = $("#id_tr_order_asli").val();
var id_tr_produksi_detail = $("#id_tr_produksi_detail").val();
var id_m_group = $("#id_m_group").val();
data = "pr="+id_tr_pk+"|"+ id_m_group+"|"+id_tr_order +"|"+id_tr_produksi_detail + "&mr=" + Math.random();
//alert(data);
		//var periode = $("#cbo_periode").val();
        var obj = document.form_view_sub;
        var xmlHttp = GetXmlHttpObject();
        var url = "../ajax/show_mat_tambahan.php";
	var par = data;
		if (!xmlHttp) {
            return;
        }
                    
        xmlHttp.onreadystatechange = function() {
            var arrResponseText;
            if (xmlHttp.readyState == 4) {
                arrResponseText = xmlHttp.responseText.split("|");
                document.getElementById("div_bahan_tambahan").innerHTML = arrResponseText[1];
		    } else {
                document.getElementById("div_bahan_tambahan").innerHTML = "<img src=\"../images/ajax.gif\" alt=\"loading...\" border=\"0\" />";
            }
        }
        xmlHttp.open("POST", url, true);
        xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlHttp.setRequestHeader("Content-length", par.length);
        xmlHttp.setRequestHeader("Connection", "close");
        xmlHttp.send(par);
    }  

function simpan_detail_baru_conf(val)
{
	//alert(val);
	var myvar = val.split('_');
    var id_tr_order = myvar[1];
	var div_nya = myvar[1];
	var total_kolom_ke = myvar[2];
	var baris_ke = myvar[3];
	
	var offset =  $("#txt_offset").val();
	var list_val = $('#list_cek_'+baris_ke).val();
//	alert('list_val : '+ list_val);
	var txt_id_tr_pk = $('#txt_id_tr_pk').val();
	var txt_id_m_group = $('#txt_id_m_group').val();
	var cbo_shift = $('#cbo_shift').val();
	var cbo_group_shift = $('#cbo_group_shift').val();
	var cbo_m_line = $('#cbo_m_line').val();
	
	var text_tanggal_awal = $('#text_tanggal_awal').val();
	var hour_from = $('#hour_from').val();
	var minute_from = $('#minute_from').val();
	var text_tanggal_awal = text_tanggal_awal + ' '+ hour_from +':'+minute_from;
	var text_tanggal_akhir = $('#text_tanggal_akhir').val();
	var hour_to = $('#hour_to').val();
	var minute_to = $('#minute_to').val();
	var text_tanggal_akhir = text_tanggal_akhir + ' '+hour_to+ ':'+minute_to;
	var text_break = $('#text_break').val();
	var txt_keterangan = $('#txt_keterangan').val();
	
	var mat1 = $('#mat1').val();
	var mat2 = $('#mat2').val();
	var mat3 = $('#mat3').val();
	
	var text_pjg_ = $('#text_pjg_'+baris_ke).val();
	//alert('txt_keterangan : '+ txt_keterangan + '\n  text_tanggal_akhir : '+ text_tanggal_akhir);

			if (cbo_shift == '0')
					{
					 alert('Proses GAGAL, Shift Belum Di Pilih !');
					 return false;
					}
			if (cbo_group_shift == '0')
					{
					 alert('Proses GAGAL, Group Belum Di Pilih !');
					 return false;
					}
			if((mat1 =='' ))
				{
					 alert('Material Bahan Belum Di Isi! ');
					 return false;
				}
			if((text_pjg_ =='' ))
				{
					 alert('Panjang Belum Di Isi! ');
					 return false;
				}
			
	
	var jumlah_koma = (list_val.split(",").length - 1) 

	var cek = confirm('Anda yakin untuk Simpan data ini?');
	if(cek)
		{
			if (jumlah_koma > 0)
			{
				var myvar = list_val.split(',');
				for (i = 0; i < jumlah_koma; i++) { 
						if (myvar[i] != 'undefined')
						{
							var data = myvar[i];
							
							var cbo_ = $('#cbo_'+data).val();
							var data = data.replace("x", "z");
							var text_id_grade = $('#text_id_grade_'+data).val();
							var text_batch_no = $('#text_batch_no_'+data).val();
							var text_turunan = $('#text_turunan_'+data).val();
							var text_station = $('#text_station_'+data).val();
							var text_material = $('#text_material_'+data).val();
							var text_berat = $('#text_berat_'+data).val();
//alert('text_berat = ' + text_berat);
							var cbo_reason = $('#cbo_reason_'+data).val();
							var txt_keterangan_reject = $('#txt_keterangan_reject_'+data).val();
							var text_id_tr_order = $('#text_id_tr_order_'+data).val();
							var var_data = data.split('_');
							var kolom_ke = var_data[2];
							//var baris_ke = var_data[3];
						//	alert(cbo_ +'\n _text_batch_no : '+ text_batch_no  +'\n _text_material : '+ text_material +'\n _cbo_reason :'+ cbo_reason_  +'\n _txt_keterangan_reject : '+ txt_keterangan_reject_);
							if (cbo_ == '0')
								{
									 alert('Proses GAGAL, ada Grade Belum Di Pilih !');
									 return false;
								}
						
						var par = text_tanggal_awal+'^'+text_tanggal_akhir+'^'+cbo_shift+'^'+cbo_group_shift+'^'+text_break+'^'+txt_keterangan+'^'+mat1+'^'+mat2+'^'+mat3+'^'+cbo_m_line+'^'+cbo_+'^'+text_id_grade+'^'+text_batch_no+'^'+text_material+'^'+cbo_reason+'^'+txt_keterangan_reject+'^'+text_turunan+'^'+text_station+'^'+txt_id_tr_pk+'^'+txt_id_m_group+'^'+text_id_tr_order+'^'+kolom_ke+'^'+baris_ke+'^'+text_berat+'^'+i
								 
							simpan_detail_baru(par);
							
						}
				
					}
			}

		var total_text_station;
		//UPDATE station
		for (i = 0; i < total_kolom_ke; i++) 
		{
			var j = i+ 1;
			var text_station = $('#text_station_'+j).val()+'|';
			var total_text_station = total_text_station + text_station ; 
		} 
		lemparan_station = txt_id_tr_pk+'^'+txt_id_m_group+'^'+total_text_station
		//alert(total_text_station);

		
		$.post('inputan_baru.php?act=update_station&par='+lemparan_station,$("#form_add_input").serialize(),function(respon_save){
					if(respon_save=='sukses'){alert('Berhasil di simpan');	
					}			
				}); 
		//selesai

		var lemparan_inputan_baru = offset+'|'+ txt_id_tr_pk +'|'+ txt_id_m_group;



	show_awal();
	inputan_baru(lemparan_inputan_baru);	
	}
}

function simpan_detail_baru(val)
{
	//alert('xxx  '+val);	 
	
	$.post('inputan_baru.php?act=save&par='+val,$("#form_add_input").serialize(),function(respon_save){
					if(respon_save=='sukses'){alert('Berhasil di simpan');	
					}
/*else{alert(respon_save);}
*/			
				});  

}
function show_awal(val)
{
 			var periode = $("#cbo_periode").val();
			var cbo_orderbyx ='1';
            var txt_sembunyi = $("#txt_sembunyi").val();
            var offset =  $("#txt_offset").val();
			var txt_menuid =  $("#txt_menuid").val();
			var cbo_program =  $("#cbo_program").val();
			var id_m_line =  $("#id_m_line").val();
Loaddiv('div_data','script_data_produksi.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode+'&txt_menuid='+txt_menuid+'&cbo_program='+cbo_program+'&id_m_line='+id_m_line);  
}
function show_all(val)
{

var status_show = $("#txt_status_show").val();
//alert(val);
//alert(status_show);
if (status_show == '')
	{
	txt_status_show.value ='all';
		val = val + '|all';
Loaddiv(div_nya,'inputan_baru.php','act=view_history&lemparan_partai='+val);
	}
else
	{
txt_status_show.value ='';
Loaddiv(div_nya,'inputan_baru.php','act=view_history&lemparan_partai='+val);
	}
}
function show_hidden()
{
//alert('xx');

var divnya = "view_history";
	var e = $("#"+divnya);
		e.toggle();
}
function tutup()
{
	var jumlah_kolom = $('#text_jumlah_stasion').val();
	var list_antrian_input = $('#list_antrian_input').val();
	var jumlah_total_baris = $('#txt_jumlah_total_baris').val();
	
	var jumlah_koma = (list_antrian_input.split(",").length - 1) //4
	//alert('jumlah_kolom :' + jumlah_kolom + 'jumlah_koma : ' +jumlah_koma);
	//alert('jumlah_koma :' +jumlah_koma);
	var div_nya2 = val.replace("x", "z");
	//toggle_visibility(div_nya);
	//toggle_visibility(div_nya2);
	
	if (jumlah_koma < 1 )
	{
			for (i = 0; i < jumlah_total_baris; i++) { 
			//if (myvar[i] != 'undefined')
			{
				tutup_div(i+1,jumlah_koma);
			}
	
		}
	}
	else if (jumlah_koma > 0)
	{
		var myvar = list_antrian_input.split(',');
		for (i = 0; i < jumlah_koma; i++) { 
				if (myvar[i] != 'undefined')
				{
					tutup_div(myvar[i],jumlah_koma);
				}
		
			}
	}

}
function tutup_div(val,jumlah_koma)
{
	//alert(val);
	//	var jumlah_kolom = myvar[2];
/*	var myvar = val.split('_');
    var id_tr_order = myvar[1];
	var div_nya = myvar[1];
	var baris_ke = myvar[3];
*/	
	var baris_ke = val;
	var jumlah_kolom = $('#text_jumlah_stasion').val();
	var list_val = $('#list_cek_'+baris_ke).val();
	var jumlah_koma = jumlah_koma;
	
	//alert('jumlah_koma xxx= ' +jumlah_koma);
	
	var divnya = "div_dataz_"+baris_ke;
	var e = $("#"+divnya);
		e.toggle();

	for (x = 0; x < jumlah_kolom; x++) 
	{
		var j = x+1;
		var divnya = "div_isi_"+j+"_"+baris_ke;
		var e = $("#"+divnya);
		e.toggle();
		
		if (jumlah_koma == "0"){e.show();}
		
	}

	var divnya = "div_panjang_"+baris_ke;
	var e = $("#"+divnya);
   	e.toggle();
if (jumlah_koma == "0"){e.show();}

	var divnya = "div_cek_inp_"+baris_ke;
	var e = $("#"+divnya);
   	e.toggle();
	if (jumlah_koma == "0"){e.show();}
	
	var divnya = "div_no_urut_"+baris_ke;
	var e = $("#"+divnya);
   	e.toggle();
	if (jumlah_koma == "0"){e.show();}

	var divnya = "div_turunan_"+baris_ke;
	var e = $("#"+divnya);
   	e.toggle();
	if (jumlah_koma == "0"){e.show();}

	var divnya = "div_save_"+baris_ke;
	var e = $("#"+divnya);
   	e.toggle();
	if (jumlah_koma == "0"){e.show();}
	
}

	function change_grade_matcode(val)
	{
		//alert('xxx'+val);
		var myvar = val.split('|');
        var id_grade = myvar[0];
		var div_nya = myvar[1];
		//var panjang_ke = myvar[2];
			

		var myvar2 = div_nya.split('_');
		var kolom_ke = myvar2[2];
		var panjang_ke = myvar2[3];
		var nilai_panjang = $('#text_pjg_'+(panjang_ke)).val();
		
		var text_date_awal = $('#text_tanggal_awal').val();
		
		if((text_date_awal =='' ))
						{
							 alert('Start Date empty! ');
							 return false;
						}
		//alert(nilai_panjang);
		//var d = parseInt(nilai_panjang);
		if (nilai_panjang == '')
		{
		alert ('Length empty');
		return false;
		}

		var nilai_turunan =  $('#text_turunan_'+(panjang_ke)).val();
		if (nilai_turunan == '')
		{
		alert ('Turunan empty');
		return false;
		}
		//alert('2. '+myvar2 + '3. '+kolom_ke);
		//alert('nilai_panjang : ' +nilai_panjang + ' - nilai_turunan : ' + nilai_turunan);
		var station_ke = myvar2[2];
		var nilai_station = $('#text_station_'+(station_ke)).val();
		var text_tanggal_awal = $("#text_tanggal_awal").val();
		var id_m_line = $("#cbo_m_line").val();
		var cbo_order = $("#cbo_order_"+kolom_ke).val();
		var cbo_lebar = $("#cbo_lebar_"+kolom_ke).val();
		var txt_id_tr_pk = $("#txt_id_tr_pk").val();
		var txt_id_m_group = $("#txt_id_m_group").val();

		
		//alert(txt_id_m_group);
Loaddiv(div_nya,'inputan_baru.php','act=change_grade_matcode&par_matcode='+val+'&nilai_panjang='+nilai_panjang+'&nilai_station='+nilai_station+'&text_tanggal_awal='+text_tanggal_awal+'&id_m_line='+id_m_line+'&nilai_turunan='+nilai_turunan+'&cbo_order='+cbo_order+'&cbo_lebar='+cbo_lebar+'&txt_id_tr_pk='+txt_id_tr_pk+'&txt_id_m_group='+txt_id_m_group);
		
	
	}

  function toggle_visibility(id) 
    {
        var e = document.getElementById(id);
        if ( e.style.display == 'block' )
            e.style.display = 'none';
        else
            e.style.display = 'block';
    }
function change_grade_new(val)
{
	var div_nya = val;

	//alert(row+'-'+ val);
	//var div_nya = 'z_'+val;
	var myvar = val.split('_');
    var nilai_kolom = myvar[2];
	var nilai_baris = myvar[3];
	
	//alert(nilai_baris);
	// var nilai_k = nilai_baris+1;

	//alert(nilai_kolom);
	//alert(nilai_panjang);
	
	var div_nya2 = val.replace("x", "z");
	toggle_visibility(div_nya);
	toggle_visibility(div_nya2);
	clik_saya(nilai_kolom,nilai_baris,val);

}


function clik_saya(nilai_kolom,nilai_baris,val){
		//alert('kolom: '+nilai_kolom+'baris: '+nilai_baris+'val: '+val);
		var row = nilai_kolom+'_'+nilai_baris;
		var nilai_k = nilai_baris;
		// alert('cek_'+row); 
			if($('#cek_'+row).attr('checked')==false){
				//alert('tidak cek');
				$('#cek_'+row).attr('checked',false);
				var list_val = $('#list_cek_'+nilai_k).val();
				list_val = $('#list_cek_'+nilai_k).val().replace(val+',','');
				$('#list_cek_'+nilai_k).val(list_val);

			}
			else{
			//	alert('cek');
				$('#cek_'+row).attr('checked',true);
				var list_val = $('#list_cek_'+nilai_k).val();
				if(list_val.search(val)==-1){
					list_val = list_val+val+',';
					$('#list_cek_'+nilai_k).val(list_val);
				}
			}
		//alert(list_val);
		}


function change_grade(val) 
   {
        var obj = document.form_view_sub;
        var id_tr_order = $("#id_tr_order").val();
		var id_m_reason = $("#id_m_reason").val();
		var id_tr_produksi_detail = $("#id_tr_produksi_detail").val();
  		var text_material = $("#text_material").val();
		var text_qty = $("#text_qty").val();

		var xmlHttp = GetXmlHttpObject();
        var url = "../ajax/change_grade.php";


        var par = "pr="+id_tr_order +"|"+ val +"|"+ id_m_reason+"|"+ id_tr_produksi_detail+"|"+ text_material+"|"+ text_qty+"|"+ "&mr=" + Math.random();
        if (!xmlHttp) {
            return;
        }
                    
        xmlHttp.onreadystatechange = function() {
            var arrResponseText;
            if (xmlHttp.readyState == 4) {
                arrResponseText = xmlHttp.responseText.split("|");
                document.getElementById("div_reason").innerHTML = arrResponseText[1];
                
            } else {
               
                document.getElementById("div_reason").innerHTML = "<img src=\"../images/ajax.gif\" alt=\"loading...\" border=\"0\" />";
            }
        }
        xmlHttp.open("POST", url, true);
        xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlHttp.setRequestHeader("Content-length", par.length);
        xmlHttp.setRequestHeader("Connection", "close");
        xmlHttp.send(par);
//nextfield(text_material);
//hitung_berat_di_produksi();
    }

function show_partai(val) 
   {
        var obj = document.form_add_partai;
        var id_tr_pk = $("#id_tr_pk").val();

		var id_m_group = $("#id_m_group").val();
		var value_combo =  $("#cbo_prod_detil").val();
		var offset =  $("#txt_offset").val();
		var txt_menuid = $("#txt_menuid").val();
		var status_order = $("#status_order").val();
 
		var xmlHttp = GetXmlHttpObject();
        var url = "../ajax/show_partai.php";
//alert(status_order);
        var par="pr="+offset+"|"+id_tr_pk+"|"+id_m_group+"|"+value_combo+"|"+txt_menuid+"|"+status_order+"|"+"&mr=" + Math.random();
//alert(par);
        if (!xmlHttp) {
            return;
        }
                    
        xmlHttp.onreadystatechange = function() {
            var arrResponseText;
            if (xmlHttp.readyState == 4) {
                arrResponseText = xmlHttp.responseText.split("|");
                document.getElementById("div_show_partai").innerHTML = arrResponseText[1];
                
            } else {
               
                document.getElementById("div_show_partai").innerHTML = "<img src=\"../images/ajax.gif\" alt=\"loading...\" border=\"0\" />";
            }
        }
        xmlHttp.open("POST", url, true);
        xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlHttp.setRequestHeader("Content-length", par.length);
        xmlHttp.setRequestHeader("Connection", "close");
        xmlHttp.send(par);
    }

function checklist_all(val) {
	//	alert(val);
			var checkbox = document.form_add_batch_no.elements['cek_[]'];
			if ( checkbox.length > 0 ) {
				for (i = 0; i < checkbox.length; i++) {
					if ( val.checked ) {
						if  (checkbox[i].disabled == false)
						{
						checkbox[i].checked = true;
						choose_me((i+1),$('#cek_'+(i+1)).val());
						}
						
					}
					else {
						if  (checkbox[i].disabled == false)
						{
						checkbox[i].checked = false;
						choose_me((i+1),$('#cek_'+(i+1)).val());
						}
					}
				}
			}
			else {
				if ( val.checked ) {
					checkbox.checked = true;
					choose_me(1,$('#cek_'+1).val());
				}
				else {
					checkbox.checked = false;
					choose_me(1,$('#cek_'+1).val());
				}
			}
		}

function print_kecil_conf____()
{
 var list_antrian = $("#list_antrian").val();
	alert (list_antrian);
	if (list_antrian != "")
	{
 			var cek = confirm('Anda yakin untuk Cetak Label KECIL ?\nPastikam Printer sudah siap untuk Cetak Label KECIL ! ');
            if(cek){
                cetak_label_kecil(list_antrian);
            }
	}
}

function cetak_label_kecil(val,copies) 
   	{
//alert('xxxx');
		$.post('script_data_produksi.php?act=cetak_label_kecil&id='+val+'&copies='+copies,'',function(respon_save){
        if(respon_save=='sukses'){}else{}});
	}

function print_kecil_inputan_baru_conf(row)
{
 //	var list_antrian = $("#list_antrian").val();
	var copies = $("#copies_inputan_baru").val();
//alert(row);
	var list_antrian = $('#var_print_'+row).val();

	//alert(aa);
	//alert (copies);
	if (list_antrian != "")
	{
 		var cek = confirm('Anda yakin untuk Cetak Label KECIL ?\nPastikam Printer sudah siap untuk Cetak Label KECIL ! ');
          if(cek){
                cetak_label_kecil(list_antrian,copies);
           }
	}
}

function print_kecil_conf()
{
 	var list_antrian = $("#list_antrian").val();
	var copies = $("#copies").val();
	//alert (copies);
	if (list_antrian != "")
	{
 		var cek = confirm('Anda yakin untuk Cetak Label KECIL ?\nPastikam Printer sudah siap untuk Cetak Label KECIL ! ');
          if(cek){
                cetak_label_kecil(list_antrian,copies);
           }
	}
}
function print_besar_conf()
{
 var list_antrian = $("#list_antrian").val();
	//alert (list_antrian);
if (list_antrian != "")
{var cek = confirm('Anda yakin untuk Cetak Label BESAR ?\nPastikam Printer sudah siap untuk Cetak Label BESAR ! ');
            if(cek){cetak_label_besar(list_antrian);}
	}
}

function print_besar_inputan_baru_conf(row)
{
 //var list_antrian = $("#list_antrian").val();
 var copies = $("#copies_inputan_baru").val();
//alert(row);
 var list_antrian = $('#var_print_'+row).val();
//	alert (list_antrian);
if (list_antrian != "")
{var cek = confirm('Anda yakin untuk Cetak Label BESAR ?\nPastikam Printer sudah siap untuk Cetak Label BESAR ! ');
            if(cek){cetak_label_besar(list_antrian,copies);}
	}
}

function cetak_label_besar(val,copies) 
   	{
		$.post('script_data_produksi.php?act=cetak_label_besar&id='+val+'&copies='+copies,'',function(respon_save){
        if(respon_save=='sukses'){}else{}});
	}

function choose_me(row,val){
		//alert(val);
			if($('#cek_'+row).attr('checked')==false){
				$('#cek_'+row).attr('checked',false);
				var list_val = $("#list_antrian").val();
				list_val = $("#list_antrian").val().replace(val+',','');
				$("#list_antrian").val(list_val);

			}else{
				$('#cek_'+row).attr('checked',true);
				var list_val = $("#list_antrian").val();
				if(list_val.search(val)==-1){
					list_val = list_val+val+',';
					$("#list_antrian").val(list_val);
				}
			}
		//alert(list_val);
		}

function choose_me_inp(row,val){
		//alert(val);
			if($('#cek_inp_'+row).attr('checked')==false){
				$('#cek_inp_'+row).attr('checked',false);
				var list_val = $("#list_antrian_input").val();
				list_val = $("#list_antrian_input").val().replace(val+',','');
				$("#list_antrian_input").val(list_val);

			}else{
				$('#cek_inp_'+row).attr('checked',true);
				var list_val = $("#list_antrian_input").val();
				if(list_val.search(val)==-1){
					list_val = list_val+val+',';
					$("#list_antrian_input").val(list_val);
				}
			}
		//alert(list_val);
		}
		
function show_batchno(val) 
   {
        var obj = document.form_add_batch_no;
        var id_tr_order = $("#id_tr_order").val();
		var id_m_grade = $("#id_m_grade").val();
		var id_tr_produksi_detail =  $("#cbo_prod_detil").val();
		var cbo_paper_core = $("#cbo_paper_core").val();
		var offset =  $("#txt_offset").val();
		var txt_menuid = $("#txt_menuid").val();
		var xmlHttp = GetXmlHttpObject();
        var url = "../ajax/show_batch_no_hasil.php";

        var par="pr="+offset+"|"+id_tr_order+"|"+id_m_grade+"|"+id_tr_produksi_detail+"|"+txt_menuid+"|"+cbo_paper_core+"|"+"&mr=" + Math.random();
//alert(par);
        if (!xmlHttp) {
            return;
        }
                    
        xmlHttp.onreadystatechange = function() {
            var arrResponseText;
            if (xmlHttp.readyState == 4) {
                arrResponseText = xmlHttp.responseText.split("|");
                document.getElementById("div_tampil").innerHTML = arrResponseText[1];
                
            } else {
               
                document.getElementById("div_tampil").innerHTML = "<img src=\"../images/ajax.gif\" alt=\"loading...\" border=\"0\" />";
            }
        }
        xmlHttp.open("POST", url, true);
        xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlHttp.setRequestHeader("Content-length", par.length);
        xmlHttp.setRequestHeader("Connection", "close");
        xmlHttp.send(par);
    }

 function Change_lot(val) 
   {}
    
		
    function show_data()
        {
        var txt_sembunyi = $("#txt_sembunyi").val();
    	var cbo_orderbyx = '1';
    	Loaddiv('div_data','script_data_produksi.php','act=show_table&cbo_orderbyx='+cbo_orderbyx+'&txt_sembunyi='+txt_sembunyi);
    
        }
  
      function add_data(){}
  
    
        function save(){
            var periode = $("#cbo_periode").val();
			var cbo_orderbyx ='1';
            var txt_sembunyi = $("#txt_sembunyi").val();
            var offset =  $("#txt_offset").val();
			
            $.post('script_data_produksi.php?act=save',$("#form_add").serialize(),function(respon_save){
                if(respon_save=='sukses'){
                    alert('Berhasil disimpan');
                    parent.jQuery.fancybox.close();
                 //   Loaddiv('div_data','script_data_produksi.php','act=show_table&cbo_orderby='+cbo_orderby);   
Loaddiv('div_data','script_data_produksi.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode); 
            }else{
                    alert(respon_save);
                }
            });
        }
        
 		function save_order(){
            var periode = $("#cbo_periode").val();
			var cbo_orderbyx ='1';
            var txt_sembunyi = $("#txt_sembunyi").val();
            var offset =  $("#txt_offset").val();
			
            $.post('script_data_produksi.php?act=save_order',$("#form_add_order").serialize(),function(respon_save){
                if(respon_save=='sukses'){
                    alert('Berhasil disimpan');
                    parent.jQuery.fancybox.close();
      
            }else{
                    alert(respon_save);
                }
 Loaddiv('div_data','script_data_produksi.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode); 
            });
        }

 function input_note_produksi (val)
{
  		//alert(val);
          // $lemparan_produksi = "'".$id_tr_pk.'^'.$offset.'^'.$no_rps."'";
			
			var myvar = val.split('^');
            var id_tr_pk = myvar[0];
			var offset = myvar[1];
			txt_offset.value = offset;            
			var no_rps = myvar[2];
			
			var periode = $("#cbo_periode").val();
			var offset =  $("#txt_offset").val();
			//var txt_sembunyi = $("#txt_sembunyi").val();
			var txt_menuid = $("#txt_menuid").val();
			var cbo_program = $("#cbo_program").val();
			var status = $("#cbo_pilihan").val();

			var txt_sembunyi = $("#txt_sembunyi").val();
			var status = $("#cbo_pilihan").val();
			txt_sembunyi = status+'|'+var_sembunyi;
			var id_m_line = $("#id_m_line").val();
			//var lemparan = id_tr_pk+'|'+id_tr_order+'|'+offset ;

			var nilai = prompt("Masukkan Note untuk No. RPS : " + no_rps,'')
			
					if (nilai =='' )
						{
						alert('Note belum di input');
						input_note_produksi(val);
						}
					else if (nilai != '' && nilai != null )
						{
						
				//	alert(nilai);
$.post('script_data_produksi.php?act=input_note_produksi&id_tr_pk='+id_tr_pk+'&nilai='+nilai,'',function(respon_save){

                if(respon_save=='sukses'){
                    alert('Berhasil di-update No. RPS : ' + no_rps);
                  //  parent.jQuery.fancybox.close();
                //  Loaddiv('div_data','script_data_produksi.php','act=show_table&cbo_orderby='+cbo_orderby);    
            }else
            {
                    alert(respon_save);
                }
//alert(offset);
Loaddiv('div_data','script_data_produksi.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode+'&txt_menuid='+txt_menuid+'&cbo_program='+cbo_program+'&id_m_line='+id_m_line);  
 

            });

						}
            
           
            
        
}

 function add_batch_no_qc (val)
{
//alert(val);

  		//alert(val);
          // $lemparan ="'".$id_tr_pk.'|'.$id_tr_order.'|'.$offset."'";
			//$var_lemparan = "'".$id_tr_pk.'^'.$id_tr_order.'^'.$id_m_schedule_detail."'";
			var myvar = val.split('^');
            var id_tr_pk = myvar[0];
            var id_tr_order = myvar[1];
			var id_m_schedule_detail = myvar[2];
			var batch_no = myvar[3];
			var offset = myvar[4];
			txt_offset.value = offset;

			var periode = $("#cbo_periode").val();
			var offset =  $("#txt_offset").val();
			//var txt_sembunyi = $("#txt_sembunyi").val();
			var txt_menuid = $("#txt_menuid").val();
			var cbo_program = $("#cbo_program").val();
			var status = $("#cbo_pilihan").val();

			var txt_sembunyi = $("#txt_sembunyi").val();
			var status = $("#cbo_pilihan").val();
			txt_sembunyi = status+'|'+var_sembunyi;
			var id_m_line = $("#id_m_line").val();
			var lemparan = id_tr_pk+'|'+id_tr_order+'|'+offset ;

			var nilai = prompt("Masukkan Keterangan Batch No ",'')
			
					if (nilai =='' )
						{
						alert('Keterangan Batch No belum di input');
						add_batch_no_qc(val);
						}
					else if (nilai != '' && nilai != null )
						{
						
				//	alert(nilai);
$.post('script_data_produksi.php?act=save_add_batch_no_bahan_qc&id_m_schedule_detail='+id_m_schedule_detail+'&nilai='+nilai+'&batch_no='+batch_no+'&id_tr_order='+id_tr_order,'',function(respon_save){

                if(respon_save=='sukses'){
                    alert('Berhasil di-update Batch No : ' + batch_no);
                  //  parent.jQuery.fancybox.close();
                //  Loaddiv('div_data','script_data_produksi.php','act=show_table&cbo_orderby='+cbo_orderby);    
            }else
            {
                    alert(respon_save);
                }
//alert(offset);
Loaddiv('div_data','script_data_produksi.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode+'&txt_menuid='+txt_menuid+'&cbo_program='+cbo_program+'&id_m_line='+id_m_line);  
 

            });

						}
            
           
            
        
}


function ubah_batch_no_bahan(val){
            
			//alert(val);
          // $lemparan ="'".$id_tr_pk.'|'.$id_tr_order.'|'.$offset."'";
			//$var_lemparan = "'".$id_tr_pk.'^'.$id_tr_order.'^'.$id_m_schedule_detail."'";


			var myvar = val.split('^');
            var id_tr_pk = myvar[0];
            var id_tr_order = myvar[1];
			var id_m_schedule_detail = myvar[2];
			var id_m_group = myvar[3];

			var periode = $("#cbo_periode").val();
           
            var cbo_orderbyx ='1';
            var txt_sembunyi = $("#txt_sembunyi").val();
			var status = $("#cbo_pilihan").val();
			txt_sembunyi = status+'|'+var_sembunyi;
			var txt_menuid = $("#txt_menuid").val();
 
            var offset =  $("#txt_offset").val();
			var lemparan = id_tr_pk+'|'+id_tr_order+'|'+offset ;
			var lemparan_material_bahan = offset+'|'+id_tr_pk+'|'+id_m_group;

			var nilai = prompt("Masukkan Batch No ",'')
			var nilai_jb = prompt("Masukkan JB ",'')
			var nilai_cs = prompt("Masukkan CS ",'')

					if (nilai =='' )
						{
						alert('Batch No belum di input');
						ubah_batch_no_bahan (val);
						}
					else if (nilai != '' && nilai != null )
						{
						
				//	alert(nilai);
$.post('script_data_produksi.php?act=update_batch_no_bahan&id_m_schedule_detail='+id_m_schedule_detail+'&nilai='+nilai+'&nilai_jb='+nilai_jb+'&nilai_cs='+nilai_cs,'',function(respon_save){

                if(respon_save=='sukses'){
                  //  alert('Berhasil di-update');
                  //  parent.jQuery.fancybox.close();
                //    Loaddiv('div_data','script_data_produksi.php','act=show_table&cbo_orderby='+cbo_orderby);    
            }else
            {
                    alert(respon_save);
                }
/*Loaddiv('div_data','script_data_produksi.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode+'&txt_menuid='+txt_menuid); */ 
if (id_tr_order != 'undefined')
{
$.post('script_data_produksi.php?act=add_order&lemparan='+lemparan,'',function(respon_)
			{$.fancybox(respon_);}
				   ); 
}
else
{
$.post('script_data_produksi.php?act=form_add_material_bahan&lemparan_material_bahan='+lemparan_material_bahan,'',function(respon_)
			{$.fancybox(respon_);}
				   ); 
}

 
           });

						}
            
           
            
        }



function un_approve_conf(val){
            
//$lemparan_approve = "'".$offset.'|'.$id_tr_order."'";

            var myvar = val.split('|');
            var offset = myvar[0];
            var id_tr_order = myvar[1];
			var order_no = myvar[2];

            txt_offset.value = offset;
            
            var cek = confirm('Anda yakin untuk UN Approve Order No.  ' + order_no + ' ini ?');
            if(cek){
                un_approve_order(id_tr_order);
            }
        }

 function un_approve_order(val){
            var cbo_orderbyx ='1';
			var periode = $("#cbo_periode").val();
            var id_tr_order = val;
            var status = $("#cbo_pilihan").val();
			var var_sembunyi = $("#txt_sembunyi").val();
			txt_sembunyi = status+'|'+var_sembunyi;
			var txt_menuid = $("#txt_menuid").val();
            var offset =  $("#txt_offset").val();
			var cbo_program =  $("#cbo_program").val();
			var id_m_line = $("#id_m_line").val();

    $.post('script_data_produksi.php?act=un_approve_order&id_tr_order='+id_tr_order,'',function(respon_delete){
                if(respon_delete=='sukses'){
                    alert('Berhasil di UN - Approve');
                }else{
                    alert(respon_delete);
                }
            Loaddiv('div_data','script_data_produksi.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode+'&status='+status+'&txt_menuid='+txt_menuid+'&cbo_program='+cbo_program+'&id_m_line='+id_m_line);
          
            });
        }

function approve_conf(val){
            
//$lemparan_approve = "'".$offset.'|'.$id_tr_order."'";

            var myvar = val.split('|');
            var offset = myvar[0];
            var id_tr_order = myvar[1];
            txt_offset.value = offset;
            
            var cek = confirm('Anda yakin untuk Approve Order ini ?');
            if(cek){
                approve_order(id_tr_order);
            }
        }


 function approve_order(val){
            var cbo_orderbyx ='1';
			var periode = $("#cbo_periode").val();
            var id_tr_order = val;
            var status = $("#cbo_pilihan").val();
			var var_sembunyi = $("#txt_sembunyi").val();
			txt_sembunyi = status+'|'+var_sembunyi;
			var txt_menuid = $("#txt_menuid").val();
            var offset =  $("#txt_offset").val();
var cbo_program =  $("#cbo_program").val();
var id_m_line = $("#id_m_line").val();
            

            $.post('script_data_produksi.php?act=approve_order&id_tr_order='+id_tr_order,'',function(respon_delete){
                if(respon_delete=='sukses'){
                    alert('Berhasil di Approve');
                }else{
                    alert(respon_delete);
                }
            Loaddiv('div_data','script_data_produksi.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode+'&status='+status+'&txt_menuid='+txt_menuid+'&cbo_program='+cbo_program+'&id_m_line='+id_m_line);
          
            });
        }

        function cancel_conf(val){
            
            var myvar = val.split('|');
            var offset = myvar[0];
            var id_tr_order = myvar[1];
            txt_offset.value = offset;
            
            var cek = confirm('Anda yakin untuk CANCEL Order ini ?');
            if(cek){
                cek_isi (val);
            }
        }
        
		function cek_isi (val)
		{
			var myvar = val.split('|');
			var offset = myvar[0];           
			var id_tr_order = myvar[1];
            txt_offset.value = offset;
			txt_cancel.value ='';
			var nilai ='';
					var nilai = prompt("Masukkan alasan Cancel",'')
					if (nilai =='' )
						{
						alert('Alasan belum di input');
						cek_isi (val);
						}
					else if (nilai != '' && nilai != null )
						{
						txt_cancel.value = nilai;
						delete_data(val)
					//alert(txt_cancel.value);
						}
						
										
		}


		function delete_sisa_bahan_conf(val)
			{
  				//alert(val);
				var cek = confirm('Anda yakin untuk Hapus data ini?');
					if(cek)
					{
						delete_sisa_bahan(val);
					}
			}

		function delete_sisa_bahan(val){

          var periode = $("#cbo_periode").val();
			var myvar = val.split('|');
 			var offset = myvar[0];
            var id_tr_order = myvar[1];
            var id_tr_sisa_bahan = myvar[2];
			txt_lemparan = offset+'|'+id_tr_order +'|'+id_tr_sisa_bahan;
			var txt_menuid = $("#txt_menuid").val();
           
            var cbo_orderbyx ='1';
            var txt_sembunyi = $("#txt_sembunyi").val();
			var status = $("#cbo_pilihan").val();
			txt_sembunyi = status+'|'+var_sembunyi;
            var offset =  $("#txt_offset").val();
			var cbo_program =  $("#cbo_program").val();
var id_m_line = $("#id_m_line").val();

 $.post('script_data_produksi.php?act=delete_sisa_bahan&txt_lemparan='+val,$("#form_add_sisa_bahan").serialize(),function(respon_save){
                if(respon_save=='sukses'){
                    alert('Berhasil di Hapus');
                   // parent.jQuery.fancybox.close();
                  
            }else
            {
                    alert(respon_save);
                }
                
Loaddiv('div_data','script_data_produksi.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode+'&txt_menuid='+txt_menuid+'&cbo_program='+cbo_program+'&id_m_line='+id_m_line);  

			add_sisa_bahan(txt_lemparan);


            });  

        }

function delete_batch_no(val){
//alert(val);

//$lemparan_detail = "'".$offset.'x'.$id_tr_order.'x'.$grade.'x'.$id_tr_produksi_detail_batch_no."'";

          	var periode = $("#cbo_periode").val();
			//var myvar = val.split('|');
			/*var offset = myvar[0];
            var id_tr_produksi_detail = myvar[1];
            var id_tr_produksi_detail_batch_no = myvar[2];*/


/*$arr_isi = explode("|", $lemparan_batch_no);
	$offset = trim($arr_isi[0]);
	$id_tr_order = trim($arr_isi[1]);
	$grade = trim($arr_isi[2]);
	$id_tr_produksi_detail_batch_no = trim($arr_isi[3]);*/


			var myvar = val.split('x');
 			var offset = myvar[0];
            var id_tr_order = myvar[1];
            var grade = myvar[2];
			var id_tr_produksi_detail_batch_no = myvar[3];

			txt_lemparan = offset+'|'+id_tr_order+'|'+grade+'|'+id_tr_produksi_detail_batch_no;
			var txt_menuid = $("#txt_menuid").val();
            //var pilihan = val;
            var cbo_orderbyx ='1';
            var txt_sembunyi = $("#txt_sembunyi").val();
			var status = $("#cbo_pilihan").val();
			txt_sembunyi = status+'|'+var_sembunyi;

//alert(txt_lemparan);
            var offset =  $("#txt_offset").val();
var cbo_program =  $("#cbo_program").val();
var id_m_line = $("#id_m_line").val();


 $.post('script_data_produksi.php?act=delete_batch_no&lemparan_batch_no='+txt_lemparan,$("#form_add_batch_no").serialize(),function(respon_save){
                if(respon_save=='sukses'){
                    alert('Berhasil di Hapus');
                   // parent.jQuery.fancybox.close();
                  
            }else
            {
                    alert(respon_save);
                }
                
Loaddiv('div_data','script_data_produksi.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode+'&txt_menuid='+txt_menuid+'&cbo_program='+cbo_program+'&id_m_line='+id_m_line);  

//$lemparan_batch_no_a = "'".$offset.'|'.$id_tr_order.'|'.'a'."'";		
	add_batch_no(txt_lemparan);


            });  

        }


function delete_partai_per_tgl_dan_shift(val){

//$lemparan_detail = "'".$offset.'z'.$list_id_tr_produksi_detail.'x'.$grade.'x'.$id_tr_produksi_detail_batch_no."'";

//$offset ."|".$id_tr_pk.'|'. $id_m_group
          	var periode = $("#cbo_periode").val();
			
			var myvar = val.split('z');
 			var offset = myvar[0];
			var id_tr_pk = myvar[1];
			var id_m_group = myvar[2];
			var list_id_tr_produksi_detail = myvar[3];
//alert(list_id_tr_produksi_detail);
			
			var txt_menuid = $("#txt_menuid").val();
           var cbo_orderbyx ='1';
            var txt_sembunyi = $("#txt_sembunyi").val();
			var status = $("#cbo_pilihan").val();
			var strx = "|";

			var txt_lemparan = offset.concat(strx,list_id_tr_produksi_detail);
 			var next_lemparan = offset.concat(strx,id_tr_pk,strx,id_m_group);
	
			txt_sembunyi = status+'|'+var_sembunyi;

//alert(txt_lemparan);
            var offset =  $("#txt_offset").val();
			var cbo_program =  $("#cbo_program").val();
			var id_m_line = $("#id_m_line").val();


 $.post('script_data_produksi.php?act=delete_partai_per_tgl_dan_shift&txt_lemparan='+txt_lemparan,$("#form_add_partai").serialize(),function(respon_save){
                if(respon_save=='sukses'){
                    alert('Berhasil di Hapus');
                   // parent.jQuery.fancybox.close();
                  
            }else
            {
                    alert(respon_save);
                }
                
Loaddiv('div_data','script_data_produksi.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode+'&txt_menuid='+txt_menuid+'&cbo_program='+cbo_program+'&id_m_line='+id_m_line);  

	add_partai(next_lemparan);


            });  

        }
			function delete_batch_no_conf(val)
			{
  				//alert(val);
				var cek = confirm('Anda yakin untuk Hapus data ini?');
					if(cek)
					{
						delete_batch_no(val);
					}
			}

		function delete_partai_per_tgl_dan_shift_conf(val)
			{
  		//alert(val);
				var cek = confirm('Anda yakin untuk Hapus data ini?');
					if(cek)
					{
						delete_partai_per_tgl_dan_shift(val);
					}
			}	
	
function form_add_material_bahan(val){
//alert(val);
        //$lemparan_group_mesin = "'".$offset.'|'.$id_tr_order."'";
//$lemparan_material_bahan = "'".$offset.'|'.$id_tr_pk.'|'.$id_m_group."'";

			var myvar = val.split('|');
			var offset = myvar[0];
           /* var id_tr_produksi_detail = myvar[1];
            var id_tr_produksi_detail_batch_no = myvar[2];*/
 			var id_tr_order = myvar[1];
			var grade = myvar[2];
            var id_tr_produksi_detail_batch_no = myvar[3];
			
			txt_offset.value = offset;
			
			var txt_sembunyi = $("#txt_sembunyi").val();
         	var offset =  $("#txt_offset").val();
	
  			$.post('script_data_produksi.php?act=form_add_material_bahan&lemparan_material_bahan='+val,'',function(respon_edit){
                $.fancybox(respon_edit);
            });

        }

function add_group_mesin(val){
//alert(val);
        //$lemparan_group_mesin = "'".$offset.'|'.$id_tr_order."'";

			var myvar = val.split('|');
			var offset = myvar[0];
           /* var id_tr_produksi_detail = myvar[1];
            var id_tr_produksi_detail_batch_no = myvar[2];*/
 			var id_tr_order = myvar[1];
			var grade = myvar[2];
            var id_tr_produksi_detail_batch_no = myvar[3];
			
			txt_offset.value = offset;
			
			var txt_sembunyi = $("#txt_sembunyi").val();
         	var offset =  $("#txt_offset").val();
	
  			$.post('script_data_produksi.php?act=form_add_group_mesin&lemparan_group_mesin='+val,'',function(respon_edit){
                $.fancybox(respon_edit);
            });

        }


function add_sisa_bahan(val){
//alert('add_sisa_bahan');
        //$lemparan_batch_no_a = "'".$offset.'|'.$id_tr_order.'|'.'a'."'";
//alert(val);
			var myvar = val.split('|');
			var offset = myvar[0];
           	var id_tr_order = myvar[1];
			//var grade = myvar[2];
            var id_tr_produksi_detail_batch_no = myvar[3];
			
			txt_offset.value = offset;
			
			var txt_sembunyi = $("#txt_sembunyi").val();
         	var offset =  $("#txt_offset").val();
	
  			$.post('script_data_produksi.php?act=form_add_sisa_bahan&lemparan_sisa_bahan='+val,'',function(respon_edit){
                $.fancybox(respon_edit);
            });

        }

 function add_batch_no(val){
//alert(val)
        //$lemparan_batch_no_a = "'".$offset.'|'.$id_tr_order.'|'.'a'."'";
//alert('add_batch_no = ' + val)
			var myvar = val.split('|');
			var offset = myvar[0];
           /* var id_tr_produksi_detail = myvar[1];
            var id_tr_produksi_detail_batch_no = myvar[2];*/
 			var id_tr_order = myvar[1];
			var grade = myvar[2];
            var id_tr_produksi_detail_batch_no = myvar[3];
			var cbo_paper_core = myvar[4];
			txt_offset.value = offset;
			
			var txt_sembunyi = $("#txt_sembunyi").val();
         	var offset =  $("#txt_offset").val();
	
  			$.post('script_data_produksi.php?act=form_add_batch_no&lemparan_batch_no='+val,'',function(respon_edit){
                $.fancybox(respon_edit);
            });

        }

 function add_partai(val){
        //$lemparan_partai = "'".$offset.'|'.$id_tr_order.'|'.'a'."'";
//alert('add_batch_no = ' + val)
			var myvar = val.split('|');
			var offset = myvar[0];
           /* var id_tr_produksi_detail = myvar[1];
            var id_tr_produksi_detail_batch_no = myvar[2];*/
 			/*var id_tr_order = myvar[1];
			var grade = myvar[2];
            var id_tr_produksi_detail_batch_no = myvar[3];*/
			
			txt_offset.value = offset;
			
			var txt_sembunyi = $("#txt_sembunyi").val();
         	var offset =  $("#txt_offset").val();
	
  			$.post('script_data_produksi.php?act=form_add_partai&lemparan_partai='+val,'',function(respon_edit){
                $.fancybox(respon_edit);
            });

        }

function tambah_turunan(val)
{
			var myvar = val.split('|');
			var offset = myvar[0];
			var id_tr_pk = myvar[1]
			var id_m_group = myvar[2];

         	
			var txt_jumlah_total_baris = $("#txt_jumlah_total_baris").val();
			var txt_tambah_turunan = $("#txt_tambah_turunan").val();

$.post('inputan_baru.php?act=save_tambah_turunan&lemparan_partai='+val+'&txt_jumlah_total_baris='+txt_jumlah_total_baris+'&txt_tambah_turunan='+txt_tambah_turunan,'',function(respon_edit){
                if(respon_edit=='sukses'){
                 //   alert('Berhasil di simpan No RPS : ' + no_rps );
					//parent.jQuery.fancybox.close();

				}else
				{
                   // alert(respon_save);
                }
                
/*Loaddiv('div_data','script_data_produksi.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode+'&txt_menuid='+txt_menuid+'&cbo_program='+cbo_program+'&id_m_line='+id_m_line);  */
val = val +'|tt';
inputan_baru(val);
            });  


			



}
function inputan_baru(val){
			var myvar = val.split('|');
			//var turunan_tambahan = myvar[0];
			//var div_material = myvar[1]+'|'+myvar[2];
         	//alert(div_material);
			//txt_offset.value = offset;
			var offset = myvar[0];
			txt_offset.value = offset;
			//alert(offset);
			//var txt_tambah_turunan = $("#txt_tambah_turunan").val();
//alert(txt_tambah_turunan);
//if (txt_tambah_turunan != 'undefined')
/*{
txt_jum_turunan_awal.value = txt_tambah_turunan;
}
*/
  			$.post('inputan_baru.php?act=form_input_baru_per_partai&lemparan_partai='+val,'',function(respon_edit){
                $.fancybox(respon_edit);
            });
//alert('view_history');
		//	Loaddiv('view_history','inputan_baru.php','act=form_input_per_turunan&lemparan_partai='+val);
        }
function save_group_mesin_conf(val)
		{ 

			//alert(val);
			var obj = document.form_add_group_mesin;
           	var cbo_group_mesin = obj.cbo_group_mesin.value;
			var offset =  $("#txt_offset").val();

			if (cbo_group_mesin =='' || cbo_group_mesin =='0'  )
				{
					 alert('Group Mesin Belum Di Pilih !');
					 return false;
				}
  		
				var cek = confirm('Anda yakin untuk Simpan data ini?');
				if(cek)
				{
					save_group_mesin(val);
				}
		
		}
function cek_save_mat_bahan_awal(val)
		{ 

		//	alert(val);
			
	var myForm = document.forms.form_add_material_bahan;
	var myControls = myForm.elements['batch_no[]'];
	var mat = myForm.elements['mat[]'];
	var jb = myForm.elements['jb[]'];
	var cs = myForm.elements['cs[]'];
	var lebar = myForm.elements['lebar[]'];
	var panjang = myForm.elements['panjang[]'];
	var lot = myForm.elements['lot[]'];

	var jum_batch =0;
	var jum_mat =0;
	var jum_jb =0;
	var jum_cs =0;
	var jum_lebar =0;
	var jum_panjang =0;
	var jum_lot =0;

	var tinggi = 0;

	//alert(myControls.length);
	for (var i = 0; i < myControls.length; i++) 
	{
		var aControl = myControls[i];
			if(myControls[i].value != '')
		{
			jum_batch++;
		}
	}

	for (var i = 0; i < mat.length; i++) 
	{if(mat[i].value != ''){jum_mat++;}}

	for (var i = 0; i < jb.length; i++) 
	{if(jb[i].value != ''){jum_jb++;}}

	for (var i = 0; i < cs.length; i++) 
	{if(cs[i].value != ''){jum_cs++;}}

for (var i = 0; i < panjang.length; i++) 
	{if(panjang[i].value != ''){jum_panjang++;}}

for (var i = 0; i < lebar.length; i++) 
	{if(lebar[i].value != ''){jum_lebar++;}}

/*for (var i = 0; i < lot.length; i++) 
	{if(lot[i].value != ''){jum_lot++;}}*/

  	var angka =[jum_batch, jum_mat, jum_jb, jum_cs,jum_lebar,jum_panjang];  	
	var tinggi = Math.max.apply(Math,angka);

if	( jum_batch < tinggi) {alert('Batch No belum di isi!'); return false;}
if	( jum_jb < tinggi) {alert('JB belum di isi!'); return false;}
if	( jum_cs < tinggi) {alert('CS belum di isi!'); return false;}
if	( jum_lebar < tinggi) {alert('Lebar belum di isi!'); return false;}
if	( jum_panjang < tinggi) {alert('Panjang belum di isi!'); return false;}
if	( jum_mat < tinggi) {alert('Material Code belum di isi!'); return false;}
/*if	( jum_lot < tinggi) {alert('Lot belum di isi!'); return false;}*/

			save_mat_bahan_awal(val);
				//var cek = confirm('Anda yakin untuk Simpan data ini?');
				//if(cek)
				{
				
//alert('tinggi : ' +tinggi);
//alert('jum_batch :' +jum_batch + ' jum_mat :' +jum_mat+ ' jum_jb :' +jum_jb+ ' jum_cs :' +jum_cs);
				}
		
		}

function save_mat_bahan_awal(val){
           //  alert(val);
			var periode = $("#cbo_periode").val();
			var offset =  $("#txt_offset").val();
			var txt_sembunyi = $("#txt_sembunyi").val();
			var txt_menuid = $("#txt_menuid").val();
			var cbo_program = $("#cbo_program").val();
  			var id_m_line = $("#id_m_line").val();
 

			var myvar = val.split('|');
            var group_partai = myvar[2];
			var no_rps = myvar[3];
		

			txt_sembunyi = status+'|'+var_sembunyi;

 $.post('script_data_produksi.php?act=save_mat_bahan_awal&offset='+offset,$("#form_add_material_bahan").serialize(),function(respon_save){
                if(respon_save=='sukses'){
                    alert('Berhasil di simpan No RPS : ' + no_rps );
					parent.jQuery.fancybox.close();

				}else
				{
                    alert(respon_save);
                }
                
Loaddiv('div_data','script_data_produksi.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode+'&txt_menuid='+txt_menuid+'&cbo_program='+cbo_program+'&id_m_line='+id_m_line);  

            });  

        }


function save_group_mesin(val){
           //  alert(val);
			var periode = $("#cbo_periode").val();
			var offset =  $("#txt_offset").val();
			var txt_sembunyi = $("#txt_sembunyi").val();
			var txt_menuid = $("#txt_menuid").val();
			var cbo_program = $("#cbo_program").val();
  			var id_m_line = $("#id_m_line").val();
 
			txt_sembunyi = status+'|'+var_sembunyi;

 $.post('script_data_produksi.php?act=save_group_mesin&offset='+offset,$("#form_add_group_mesin").serialize(),function(respon_save){
                if(respon_save=='sukses'){
                    alert('Berhasil di simpan');
					parent.jQuery.fancybox.close();

				}else
				{
                    alert(respon_save);
                }
                
Loaddiv('div_data','script_data_produksi.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode+'&txt_menuid='+txt_menuid+'&cbo_program='+cbo_program+'&id_m_line='+id_m_line);  

            });  

        }
       	

function save_sisa_bahan_conf(val)
		{ 

			//var pilihan = val;
			//alert('save_sisa_bahan_conf'+'|'+ val);
			var obj = document.form_add_sisa_bahan;
           	var text_matcode = obj.text_matcode.value;
			var text_berat = obj.text_berat.value;
			//var id_tr_produksi_detail = obj.cbo_prod_detil.value;
	
			var offset =  $("#txt_offset").val();

			if (text_matcode =='')
				{
					 alert('Matcode Belum Di Isi !');
					 return false;
				}
			

			if (text_berat =='' || text_berat =='0' || text_berat == '-' )
				{
					 alert('Berat Belum Di Isi !');
					 return false;
				}
			  		
				var cek = confirm('Anda yakin untuk Simpan Sisa Bahan ini?');
				if(cek)
				{
					save_sisa_bahan(val);
				}
		
		}
	
		function save_batch_no_conf(val)
		{ 

			//var pilihan = val;
			//alert(val);
			var obj = document.form_add_batch_no;
           	var text_batch_no = obj.text_batch_no.value;
			var text_berat = obj.text_berat.value;
			var id_tr_produksi_detail = obj.cbo_prod_detil.value;

			
			var offset =  $("#txt_offset").val();
//alert(pilihan);
			if (text_batch_no =='')
				{
					 alert('Batch No Belum Di Isi !');
					 return false;
				}
			if (id_tr_produksi_detail =='' || id_tr_produksi_detail =='0'  )
				{
					 alert('Shift - Mesin Belum Di Pilih !');
					 return false;
				}

			/*if (text_berat =='' || text_berat =='0' || text_berat == '-' )
				{
					 alert('Berat Belum Di Isi !');
					 return false;
				}*/
			  		
				var cek = confirm('Anda yakin untuk Simpan data ini?');
				if(cek)
				{
					save_batch_no(val);
				}
		
		}
function save_sisa_bahan(val){
           //  alert('save_sisa_bahan' +'|'+ val);
			var periode = $("#cbo_periode").val();
			var myvar = val.split('|');
            var pilihan = myvar[0];
          	var txt_menuid = $("#txt_menuid").val();
			var id_tr_order = myvar[1];
			var offset =  $("#txt_offset").val();
			txt_lemparan = offset+'|'+id_tr_order;

            var txt_sembunyi = $("#txt_sembunyi").val();
			var status = $("#cbo_pilihan").val();
			txt_sembunyi = status+'|'+var_sembunyi;
var id_m_line = $("#id_m_line").val();
var cbo_program = $("#cbo_program").val();
//alert(pilihan);
           
 $.post('script_data_produksi.php?act=save_sisa_bahan&pilihan='+pilihan,$("#form_add_sisa_bahan").serialize(),function(respon_save){
                if(respon_save=='sukses'){
                    alert('Berhasil di-update');
                   // parent.jQuery.fancybox.close();
                  
            }else
            {
                    alert(respon_save);
                }
                
Loaddiv('div_data','script_data_produksi.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode+'&txt_menuid='+txt_menuid+'&cbo_program='+cbo_program+'&id_m_line='+id_m_line);  

			add_sisa_bahan(txt_lemparan);


            });  

        }

function delete_all_batch_no_conf(val)
		{ 

			//var pilihan = val;
			//alert(val);
			var obj = document.form_add_batch_no;
           	var text_batch_no = obj.text_batch_no.value;
			var cbo_prod_detil = obj.cbo_prod_detil.value;
			var id_tr_produksi_detail = obj.cbo_prod_detil.value;
		
			var offset =  $("#txt_offset").val();
						  		
			if(  (cbo_prod_detil =='' || cbo_prod_detil =='0')     )
				{
					 alert('Shift - Mesin -Qty Belum Di Pilih !');
					 return false;
				}

				var cek = confirm('Anda yakin untuk HAPUS SEMUA data ini?');
				if(cek)
				{
					delete_all_batch_no(val);
				}
		
		}

function delete_all_batch_no(val){
           // alert(val);
			var periode = $("#cbo_periode").val();
			var myvar = val.split('xxx');
            var pilihan = myvar[0];
          	var txt_menuid = $("#txt_menuid").val();
			var id_tr_order = myvar[1];
			var grade = myvar[2];

 			var offset =  $("#txt_offset").val();
			txt_lemparan = offset+'|'+id_tr_order+'|'+grade;
//alert(txt_lemparan);

            var txt_sembunyi = $("#txt_sembunyi").val();
			var status = $("#cbo_pilihan").val();
			txt_sembunyi = status+'|'+var_sembunyi;
			var cbo_program = $("#cbo_program").val();
			var id_m_line = $("#id_m_line").val();
//alert(pilihan);
           
 $.post('script_data_produksi.php?act=delete_all_batch_no&pilihan='+pilihan,$("#form_add_batch_no").serialize(),function(respon_save){
                if(respon_save=='sukses'){
                    alert('Berhasil di-update');
                   // parent.jQuery.fancybox.close();
                  
            }else
            {
                    alert(respon_save);
                }
                
Loaddiv('div_data','script_data_produksi.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode+'&txt_menuid='+txt_menuid+'&cbo_program='+cbo_program+'&id_m_line='+id_m_line+'&id_m_grade='+grade+'&grade='+grade);  

			add_batch_no(txt_lemparan);


            });  

        }

function update_all_partai(val){
           // alert(val);
//$lemparan = 'save_allxx'.$id_tr_pk .'xx'.$id_m_group .'xx'.$value_combo ;
			var periode = $("#cbo_periode").val();
			var myvar = val.split('xx');
            var pilihan = myvar[0];
          	var txt_menuid = $("#txt_menuid").val();
			var id_tr_pk = myvar[1];
			var id_m_group = myvar[2];
			var tgl = myvar[3];
			var id_m_shift = myvar[4];
			var id_m_group_shift = myvar[5];
 			var offset =  $("#txt_offset").val();
			txt_lemparan = offset+'|'+id_tr_pk+'|'+id_m_group+'|'+tgl+'|'+id_m_shift+'|'+id_m_group_shift;
//alert(txt_lemparan);

            var txt_sembunyi = $("#txt_sembunyi").val();
			var status = $("#cbo_pilihan").val();
			txt_sembunyi = status+'|'+var_sembunyi;
			var cbo_program = $("#cbo_program").val();
			var id_m_line = $("#id_m_line").val();
var grade = 0;
//alert(pilihan);
           
 $.post('script_data_produksi.php?act=save_partai&txt_lemparan='+txt_lemparan,$("#form_add_partai").serialize(),function(respon_save){
                if(respon_save=='sukses'){
                    alert('Berhasil di-update');
                   // parent.jQuery.fancybox.close();
                  
            }else
            {
                    alert(respon_save);
                }
                
Loaddiv('div_data','script_data_produksi.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode+'&txt_menuid='+txt_menuid+'&cbo_program='+cbo_program+'&id_m_line='+id_m_line+'&id_m_grade='+grade+'&grade='+grade);  

		
            });  

        }

function update_all_batch_no(val){
           // alert(val);
			var periode = $("#cbo_periode").val();
			var myvar = val.split('xxx');
            var pilihan = myvar[0];
          	var txt_menuid = $("#txt_menuid").val();
			var id_tr_order = myvar[1];
			var grade = myvar[2];
			//var cbo_paper_core = myvar[3];
//var cbo_paper_core = $("cbo_paper_core").val();
 			var offset =  $("#txt_offset").val();
			txt_lemparan = offset+'|'+id_tr_order+'|'+grade;
//alert(txt_lemparan);

            var txt_sembunyi = $("#txt_sembunyi").val();
			var status = $("#cbo_pilihan").val();
			txt_sembunyi = status+'|'+var_sembunyi;
			var cbo_program = $("#cbo_program").val();
			var id_m_line = $("#id_m_line").val();
//alert(pilihan);
           
 $.post('script_data_produksi.php?act=save_batch_no&pilihan='+pilihan,$("#form_add_batch_no").serialize(),function(respon_save){
                if(respon_save=='sukses'){
                    alert('Berhasil di-update');
                   // parent.jQuery.fancybox.close();
                  
            }else
            {
                    alert(respon_save);
                }
                
Loaddiv('div_data','script_data_produksi.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode+'&txt_menuid='+txt_menuid+'&cbo_program='+cbo_program+'&id_m_line='+id_m_line+'&id_m_grade='+grade+'&grade='+grade);  

			add_batch_no(txt_lemparan);


            });  

        }

function save_batch_no(val){
           //  alert(val);
			var periode = $("#cbo_periode").val();
			
			var myvar = val.split('|');
            var pilihan = myvar[0];
          	var txt_menuid = $("#txt_menuid").val();
			var id_tr_order = myvar[1];
			var grade = myvar[2];
			var cbo_paper_core = $("cbo_paper_core").val();
 			var offset =  $("#txt_offset").val();
			txt_lemparan = offset+'|'+id_tr_order+'|'+grade+'|'+cbo_paper_core;

            var txt_sembunyi = $("#txt_sembunyi").val();
			var status = $("#cbo_pilihan").val();
			txt_sembunyi = status+'|'+var_sembunyi;
var cbo_program = $("#cbo_program").val();
var id_m_line = $("#id_m_line").val();

//alert(pilihan);
           
 $.post('script_data_produksi.php?act=save_batch_no&pilihan='+pilihan,$("#form_add_batch_no").serialize(),function(respon_save){
                if(respon_save=='sukses'){
                    alert('Berhasil di-update');
                   // parent.jQuery.fancybox.close();
                  
            }else
            {
                    alert(respon_save);
                }
                
Loaddiv('div_data','script_data_produksi.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode+'&txt_menuid='+txt_menuid+'&cbo_program='+cbo_program+'&id_m_line='+id_m_line);  

			add_batch_no(txt_lemparan);


            });  

        }
       		
        function edit_data_detail(val){
        
		//alert(val);
			var txt_sembunyi = $("#txt_sembunyi").val();
         	var offset =  $("#txt_offset").val();
			var txt_menuid = $("#txt_menuid").val();

//$.post('script_data_produksi.php?act=delete_data&id_tr_order='+id_tr_order+'&alasan_cancel='+alasan_cancel,'',function(respon_delete)
	
  $.post('script_data_produksi.php?act=add_order&lemparan_detail='+val+'&txt_menuid='+txt_menuid,'',function(respon_edit){
                $.fancybox(respon_edit);
            });

        }

		function edit_waste_conf(val)
		{
				var cek = confirm('Anda yakin untuk Simpan perubahan ini?');
				if(cek)
				{
				   save_data_waste(val);
				}
		}

		function save_data_waste(val){
           //  alert(val);
			var periode = $("#cbo_periode").val();
            var lemparan_detail = val;
            var cbo_orderbyx ='1';
            var txt_sembunyi = $("#txt_sembunyi").val();
			var status = $("#cbo_pilihan").val();
			txt_sembunyi = status+'|'+var_sembunyi;

            var offset =  $("#txt_offset").val();

            
            $.post('script_data_produksi.php?act=save_data_waste&lemparan='+val,$("#form_edit_data_waste").serialize(),function(respon_save){
                if(respon_save=='sukses'){
                    alert('Berhasil di-update');
                    parent.jQuery.fancybox.close();
                //    Loaddiv('div_data','script_data_produksi.php','act=show_table&cbo_orderby='+cbo_orderby);    
            }else
            {
                    alert(respon_save);
                }
                
Loaddiv('div_data','script_data_produksi.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode);  

            });
        }
        

        function edit_conf(val){
		//alert('edit_conf : '+ val);
			var obj = document.form_view_sub;
            var a1 =obj.cbo_shift.value;
			var b1 = obj.cbo_line.value;
			var text_qty = obj.text_qty.value;
			var cbo_grade = obj.cbo_grade.value;
			var cbo_group_shift = obj.cbo_group_shift.value;
			var mat1 = obj.mat1.value;
//alert(mat1);

			if(  (cbo_group_shift =='' || cbo_group_shift =='0')     )
				{
					 alert('Group Belum Di Pilih !');
					 return false;
				}

			if (a1 =='0')
				{
					 alert('Shift Belum Di Pilih !');
					 return false;
				}
			if (b1 =='0')
				{
					 alert('Mesin Belum Di Pilih !');
					 return false;
				}
			  
			if(  (text_qty =='' || text_qty =='0' || text_qty =='-' )   )
				{
					 alert('Quantity Belum Di Isi !');
					 return false;
				}
			if(  (cbo_grade =='' || cbo_grade =='0')     )
				{
					 alert('Grade Belum Di Pilih !');
					 return false;
				}
if(  (mat1 =='' && mat2 =='' && mat3 =='' && mat4 ==''&& mat5 =='' && mat6 ==''&& mat7 =='' && mat8 ==''&& mat9 =='' && mat10 =='' )     )
				{
					 alert('Material Bahan Belum Di Isi! ');
					 return false;
				}

			
		/*if(  (text_counter_awal =='' || text_counter_awal =='0')   )
            {
                 alert('Counter Awal Belum Di Isi !');
                 return false;
            }
		if(  (text_counter_akhir =='' || text_counter_akhir =='0')   )
            {
                 alert('Counter Akhir Belum Di Isi !');
                 return false;
            }*/
          
		
		/*if (parseFloat(text_counter_akhir) < parseFloat(text_counter_awal))
			{
 			alert('Counter Akhir Harus Lebih BESAR dari Counter Awal !');
                 return false;
			}*/
	
				var cek = confirm('Anda yakin untuk Simpan perubahan ini?');
				if(cek)
				{
				   save_edit_produksi(val);

				}
        }     


 function save_edit_produksi(val){
           // alert('edit :'+val);
			var periode = $("#cbo_periode").val();
            var lemparan = val;
			var myvar = val.split('|');
            var order_no = myvar[3];
 		//alert('order_no :' + order_no);
            var cbo_orderbyx ='1';
            var txt_sembunyi = $("#txt_sembunyi").val();
			var status = $("#cbo_pilihan").val();
			txt_sembunyi = status+'|'+var_sembunyi;
			var txt_menuid = $("#txt_menuid").val();
			var cbo_program = $("#cbo_program").val();
			var id_m_line = $("#id_m_line").val();
            var offset =  $("#txt_offset").val();

            
            $.post('script_data_produksi.php?act=save_edit_produksi&lemparan='+val,$("#form_view_sub").serialize(),function(respon_save){
                if(respon_save=='sukses'){
                    alert('Berhasil di-update Order_no: ' + order_no);
                    parent.jQuery.fancybox.close();
                //    Loaddiv('div_data','script_data_produksi.php','act=show_table&cbo_orderby='+cbo_orderby);    
            }else
            {
                    alert(respon_save);
                }
 
Loaddiv('div_data','script_data_produksi.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode+'&txt_menuid='+txt_menuid+'&cbo_program='+cbo_program+'&id_m_line='+id_m_line);  
$.post('script_data_produksi.php?act=add_order&lemparan='+val+'&txt_menuid='+txt_menuid,'',function(respon_)
			{$.fancybox(respon_);}
				   ); 

            });
        }
        
                
        function edit(val)
        {
                        
 			var periode = $("#cbo_periode").val();
			var cbo_orderbyx ='1';
            var txt_sembunyi = $("#txt_sembunyi").val();
            var offset =  $("#txt_offset").val();
			var txt_menuid = $("#txt_menuid").val();
var cbo_program = $("#cbo_program").val();
var id_m_line = $("#id_m_line").val();
 
            //alert(val);
            
            $.post('script_data_produksi.php?act=edit&id_tr_pk='+val,$("#form_add").serialize(),function(respon_edit){
                if(respon_edit=='sukses')
                {
                    alert('Berhasil di-update xxx');
                    parent.jQuery.fancybox.close();
                 }
				else
                {
                    alert(respon_edit);
                }
             

Loaddiv('div_data','script_data_produksi.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode+'&txt_menuid='+txt_menuid+'&cbo_program='+cbo_program+'&id_m_line='+id_m_line);   
                     
            });
        }
        
        function search_data(){
            $.post('script_search.php?act=form_search_kegiatan','',function(respon){
                $.fancybox(respon);
                
            });
        }
        
        function search_kegiatan (val)
        {}
        
        function delete_detail_conf(val)
		{
			var cek = confirm('Anda yakin untuk Hapus ?');
            if(cek)
			{
               delete_detail(val);
            }


		}
        
		function delete_detail(val)
		{
		//alert('det :'+val);
            var periode = $("#cbo_periode").val();
			var status  = $("#cbo_pilihan").val();
  			var cbo_orderbyx ='1';
            var var_sembunyi = $("#txt_sembunyi").val();
			txt_sembunyi = status+'|'+var_sembunyi;
			var txt_menuid = $("#txt_menuid").val();
var cbo_program = $("#cbo_program").val();
            var offset =  $("#txt_offset").val();
var id_m_line = $("#id_m_line").val();
            
            $.post('script_data_produksi.php?act=delete_detail_produksi&lemparan='+val,$("#form_view_sub").serialize(),function(respon_save){
                if(respon_save=='sukses'){
                    alert('Berhasil di Hapus');
                     
            }else
            {
                    alert(respon_save);
                }
          
Loaddiv('div_data','script_data_produksi.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode+'&txt_menuid='+txt_menuid+'&cbo_program='+cbo_program+'&id_m_line='+id_m_line);  
    		$.post('script_data_produksi.php?act=add_order&lemparan='+val,'',function(respon_edit)
			{$.fancybox(respon_edit);}
				   ); 
  
            });
       
		}
        
        function cek_save_produksi(val)
        {
          
            var obj = document.form_view_sub;
            var a1 =obj.cbo_shift.value;
			var b1 = obj.cbo_line.value;
			var text_qty = obj.text_qty.value;
			var cbo_grade = obj.cbo_grade.value;
			var mat1 = obj.mat1.value;
			/*var text_counter_awal = obj.text_counter_awal.value;
			var text_counter_akhir = obj.text_counter_akhir.value;*/
			var cbo_group_shift = obj.cbo_group_shift.value;

			if(  (cbo_group_shift =='' || cbo_group_shift =='0')     )
				{
					 alert('Group Belum Di Pilih !');
					 return false;
				}

if(  (mat1 =='' && mat2 =='' && mat3 =='' && mat4 ==''&& mat5 =='' && mat6 ==''&& mat7 =='' && mat8 ==''&& mat9 =='' && mat10 =='' )     )
				{
					 alert('Material Bahan Belum Di Isi! XX');
					 return false;
				}

		if (a1 =='0')
            {
                 alert('Shift Belum Di Pilih !');
                 return false;
            }
		if (b1 =='0')
            {
                 alert('Mesin Belum Di Pilih !');
                 return false;
            }
		/*if(  (text_counter_awal =='' || text_counter_awal =='0')   )
            {
                 alert('Counter Awal Belum Di Isi !');
                 return false;
            }
		if(  (text_counter_akhir =='' || text_counter_akhir =='0')   )
            {
                 alert('Counter Akhir Belum Di Isi !');
                 return false;
            }*/
          
		if(  (text_qty =='' || text_qty =='0' || text_qty =='0' )   )
            {
                 alert('Quantity Belum Di Isi !');
                 return false;
            }
		/*if (parseFloat(text_counter_akhir) < parseFloat(text_counter_awal))
			{
 			alert('Counter Akhir Harus Lebih BESAR dari Counter Awal !');
                 return false;
			}
*/
		if(  (cbo_grade =='' || cbo_grade =='0')     )
            {
                 alert('Grade Belum Di Pilih !');
                 return false;
            }
		
            
			var cek = confirm('Anda yakin untuk Simpan Data?');
            if(cek)
			{
               save_produksi(val);
            }    
    
        }



function edit_data_waste(val){
			
			//alert('add_order ' + val);
			var myvar = val.split('|');
            var id_tr_pk = myvar[0];
            var offset = myvar[1];

			var txt_sembunyi = $("#txt_sembunyi").val();
         	//var offset =  $("#txt_offset").val();
txt_offset.value = offset;
	
  $.post('script_data_produksi.php?act=form_edit_data_waste&lemparan='+id_tr_pk,'',function(respon_edit){
                $.fancybox(respon_edit);

            });
        }


 function add_order(val){
			
			//alert('add_order ' + val);
			var myvar = val.split('|');
            var offset = myvar[2];
			var txt_sembunyi = $("#txt_sembunyi").val();
			var txt_menuid = $("#txt_menuid").val();
         	//var offset =  $("#txt_offset").val();
//alert('txt_menuid ' +txt_menuid);
			txt_offset.value = offset;

  $.post('script_data_produksi.php?act=add_order&lemparan='+val+'&txt_menuid='+txt_menuid,'',function(respon_edit){
                $.fancybox(respon_edit);

            });
        }


        function save_produksi(val){
            // alert('save_produksi ' + val);
            var lemparan = val;

			var myvar = val.split('|');
			var order_no = myvar[3];     

        	var periode = $("#cbo_periode").val();
			var status  = $("#cbo_pilihan").val();
  			var cbo_orderbyx ='1';
//$("#txt_sembunyi").value = status;
            var var_sembunyi = $("#txt_sembunyi").val();
			txt_sembunyi = status+'|'+var_sembunyi;
			var txt_menuid = $("#txt_menuid").val();
			var cbo_program = $("#cbo_program").val();
var id_m_line = $("#id_m_line").val();
  
            var offset =  $("#txt_offset").val();
            
            $.post('script_data_produksi.php?act=save_produksi&lemparan='+val,$("#form_view_sub").serialize(),function(respon_save){
                if(respon_save=='sukses'){
                    alert('Berhasil disimpan , Order No: ' + order_no);
                   // parent.jQuery.fancybox.close();
               
            }else
            {
                    alert(respon_save);
                }
                
         
Loaddiv('div_data','script_data_produksi.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode+'&txt_menuid='+txt_menuid+'&cbo_program='+cbo_program+'&id_m_line='+id_m_line);  
$.post('script_data_produksi.php?act=add_order&lemparan='+val,'',function(respon_){$.fancybox(respon_);}); 
   
            });
        }
        
   function cancel_produksi(val){
            // alert('save_produksi ' + val);
            var lemparan = val;

			var myvar = val.split('|');
			var order_no = myvar[3];     

        	var periode = $("#cbo_periode").val();
			var status  = $("#cbo_pilihan").val();
  			var cbo_orderbyx ='1';
//$("#txt_sembunyi").value = status;
            var var_sembunyi = $("#txt_sembunyi").val();
			txt_sembunyi = status+'|'+var_sembunyi;
			var txt_menuid = $("#txt_menuid").val();
			var cbo_program = $("#cbo_program").val();
  var id_m_line = $("#id_m_line").val();
            var offset =  $("#txt_offset").val();
            
            Loaddiv('div_data','script_data_produksi.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode+'&txt_menuid='+txt_menuid+'&cbo_program='+cbo_program+'&id_m_line='+id_m_line);  
$.post('script_data_produksi.php?act=add_order&lemparan='+val,'',function(respon_){$.fancybox(respon_);}); 
        }
        
        
        function view_sub(val){
            $.post('script_data_produksi.php?act=view_sub&id_m_kegiatan='+val,'',function(respon_edit){
                $.fancybox(respon_edit);
                                    
            });
        }
        
function cancel()
{
  var txt_sembunyi = $("#txt_sembunyi").val();
            var offset =  $("#txt_offset").val();
 parent.jQuery.fancybox.close();
//Loaddiv('div_data','script_data_produksi.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi);
}
        
        function delete_data(val){
           var myvar = val.split('|');
			var offset = myvar[0];           
			var id_tr_order = myvar[1];
            txt_offset.value = offset;
            var alasan_cancel = $("#txt_cancel").val();
			var alasan_cancel = alasan_cancel.split(' ').join('8764346466435364647768799667654537543756');
    		var var_sembunyi = $("#txt_sembunyi").val();
			txt_sembunyi = status+'|'+var_sembunyi;
			var txt_menuid = $("#txt_menuid").val();
			var cbo_program = $("#cbo_program").val();
var id_m_line = $("#id_m_line").val();

            //$.post('script_data_produksi.php?act=delete_data&id_tr_pk='+id_tr_pk,'',function(respon_delete){
			$.post('script_data_produksi.php?act=delete_data&id_tr_order='+id_tr_order+'&alasan_cancel='+alasan_cancel,'',function(respon_delete){
                if(respon_delete=='sukses'){
                    alert('Berhasil di CANCEL');
                }else{
                    alert(respon_delete);
                }
            
Loaddiv('div_data','script_data_produksi.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode+'&txt_menuid='+txt_menuid+'&cbo_program='+cbo_program+'&id_m_line='+id_m_line);
            });
        }

function show_blth_log(){
			
			var periode = $("#cbo_periode").val();
			var status  = $("#cbo_pilihan").val();
  			var cbo_orderbyx ='1';
			var cbo_program = $("#cbo_program").val();
            var var_sembunyi = $("#txt_sembunyi").val();
			txt_sembunyi = status+'|'+var_sembunyi;
 			var txt_menuid = $("#txt_menuid").val();
			var id_m_line = $("#id_m_line").val();
 
//alert(cbo_program);
            var offset =  $("#txt_offset").val();
			Loaddiv('div_data','script_data_produksi.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode+'&txt_menuid='+txt_menuid+'&cbo_program='+cbo_program+'&id_m_line='+id_m_line);
			
		}

    </script>
    <body>
        <?php require_once("../include/script.php"); ?>
        <?php require_once("../include/message.php"); ?>
        <table id="container" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td align="center" valign="top">
                    <?php require_once("../include/header.php"); ?>
                    <?php require_once("../include/menu.php"); ?>
                    <?php require_once("../include/greeting.php"); ?>
                </td>
            </tr>
            <tr>
                <td height="500" align="center" valign="top">
                    <table width="90%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td colspan="4">
                                <?php require_once("../include/page_title.php"); ?>
                            </td>

                        </tr>
 <tr>
<?php 

$sql_line = "SELECT DISTINCT id_m_line, nama_line , nama_group_line
				FROM m_line a 
INNER JOIN m_group_line b on a.id_m_group_line = b.id_m_group_line
				order by nama_line,b.id_m_group_line DESC, a.id_m_line 
				";
        $qry_line = mysql_query($sql_line) or die("Invalid query!" . $sql_line);

$sql = "SELECT DISTINCT periode 
				FROM tr_pk $where_periode
				ORDER BY substring(periode,3,4) DESC, substring(periode,1,2) DESC 
				";
        $qry = mysql_query($sql) or die("Invalid query!" . $sql);
?>
                          <td align="left">Periode :
                            <select name="cbo_periode" id="cbo_periode" class="combobox"  onchange="show_blth_log(this.value)" >
              <!--<option value="0" selected="selected">- Pilih -</option>-->
              <?php while ($row = mysql_fetch_assoc($qry)) 
				{ ?>
          <option value="<?=$row["periode"] ?>"
                          <?php 
                            if($row["periode"]==$periode)
                                       {
                                           echo 'selected';
                                    }
                            ?>
                      >
                  <?=$row["periode"]?>
              </option>
                <?php } 
				?>
            </select></td>
                          <td rowspan="3" align="right"><label for="cbo_pilihan">Status RPS(R)</label>
                            <select name="cbo_pilihan" id="cbo_pilihan" class="combobox"  onchange="show_blth_log(this.value)">
                              <option value="1">Approved</option>
                              <option value="2">Not Approved</option>
                              <option value="0">All</option>
                            </select>
                            <!--<input type="button" name="button_add2" id="button_add" value="Add" class="button" onclick="add_data()" />-->
                           <!-- <input type="button" name="button_add" id="button_search" value="Search" class="button" onclick="search_data()" />--></td>
                      </tr>
 <tr>
   <td align="left">Program :
     <select name="cbo_program" id="cbo_program" class="combobox"  onchange="show_blth_log(this.value)" >
     <option value="0">- All -</option>
     <option value="s">Slitter</option>
     <option value="r">Re-Slitter</option>
   </select></td>
 </tr>
 <tr>
   <td align="left">Mesin : 
     <select id="id_m_line" name="id_m_line" class="combobox" onchange="show_blth_log(this.value)"  >
       <option value="0" selected="selected">- All -</option>
       <?php while ($row_line = mysql_fetch_assoc($qry_line)) 
	{ ?>
       <option value="<?= $row_line["id_m_line"] ?>">
         <?= ($row_line["nama_group_line"] . ' - '.$row_line["nama_line"]) ?>
         </option>
       <?php } 
	?>
     </select></td>
 </tr>
                        <tr>
                            <td colspan="2" align="right">
                             <div id="tambah">
                                       <p>
                                        
                                         <input type="hidden" name="txt_cancel" id="txt_cancel" />
                                       </p>
                                       <p>
                                         
 										<label for="txt_sembunyi"></label>
                                         <input name="txt_sembunyi"  type="hidden" id="txt_sembunyi"  />
										<input name="txt_menuid" type="hidden" id="txt_menuid" value ="<?php echo $menu_id ?>"  />
                                         <label for="txt_offset"></label>
                                         <input type="hidden" name="txt_offset" id="txt_offset" />
<input type="hidden" name="txt_var_simpan" id="txt_var_simpan" />
                                       </p>
                             </div>
                                <div id="div_data">
<div id="div_calculator">
                                   
                                </div>
                            </td>
                        </tr>
                       
                        <tr>
                            <td height="30" colspan="2">&nbsp;</td>
                        </tr>
                        
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center" valign="top">
                    <?php require_once("../include/footer.php"); ?>
                </td>
            </tr>
            <input type="hidden" id="n" value="0"  />                        
        </table>
    </body>
</html>
<script>
			var periode = $("#cbo_periode").val();
			var cbo_orderbyx ='1';
			var status = $("#cbo_pilihan").val();
            txt_offset.value= '0';
			var txt_menuid = $("#txt_menuid").val();
			var cbo_program = $("#cbo_program").val();
			var var_sembunyi = $("#txt_sembunyi").val();
			txt_sembunyi = status+'|'+var_sembunyi;
			var id_m_line = $("#id_m_line").val();

            var offset =  $("#txt_offset").val();
			Loaddiv('div_data','script_data_produksi.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode+'&txt_menuid='+txt_menuid+'&cbo_program='+cbo_program+'&id_m_line='+id_m_line);
   
   
</script>
<?php 
    mysql_close();
?>
