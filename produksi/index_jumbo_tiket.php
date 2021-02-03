<?php require_once("../include/config.php"); ?>
<?php require_once("../include/session.php"); ?>
<?php require_once("../include/function.php"); ?>
<?php 
    $pr = trim($_GET["pr"]);
    $arr_pr = explode("|", $pr);
    $menu_id = (int)trim($arr_pr[1]);
    
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
	function checkDec_tanpa_titik(el){
	 var ex = /^[0-9]+\.?[0-9]*$/;
	 if(ex.test(el.value)==false){
	   el.value = el.value.substring(0,el.value.length - 1);
  }

}

function ubah_CS(val)
{
//alert(val);
			var myvar = val.split('|');
			var offset = myvar[0];
            var id_tr_jumbo_tiket = myvar[1];
			var id_tr_jumbo_order = myvar[2];
			var divnya = "div_cs_"+id_tr_jumbo_tiket;

				var nilai = prompt("Masukkan CS baru : " )
			
					if (nilai =='' )
						{
						alert('Note belum di input');
						//input_note_produksi(val);
						}
					{

			var par = id_tr_jumbo_tiket +'|'+ nilai;
			var var_add_order = offset ='|'+ id_tr_jumbo_order;
			$.post('script_jumbo_tiket.php?act=ubah_cs&par='+par+'&nilai='+nilai,'',function(respon_save){

            if(respon_save=='sukses')
			{
              alert('Berhasil di update');
				
               //  Loaddiv('div_data','script_data_produksi.php','act=show_table&cbo_orderby='+cbo_orderby);    
            }else
            {
                    alert('Batal');
                }
add_order(var_add_order);
            });
					}

}
function input_note_produksi(val)
{

						
				//	alert(nilai);


						

}

function tutup(val)
{
//tidak_muncul_form_add();
//alert(val);
add_order(val);
}

function add_alert(val){
//alert(val);
			var myvar = val.split('|');
			var offset = myvar[0];
            var id_tr_jumbo_order = myvar[1];
			//$("#div_batch_no").hide();
			txt_offset.value = offset;
			
			var txt_sembunyi = $("#txt_sembunyi").val();
         	var offset = $("#txt_offset").val();
	//alert(offset);
//tidak_muncul_form_add();
  			$.post('script_form_quality_alert.php?act=input_form&lemparan='+val,'',function(respon_edit){
                $.fancybox(respon_edit);
            }) ;
		
        }
function tidak_muncul_form_add()
{
	$("#div_detail").hide();
}
function muncul_form_add()
{
	$("#div_detail").show();
}
function enable(id)
{
    var eleman = document.getElementById(id);
    eleman.removeAttribute("disabled");        
}

function display_item(tipe,data)
 {
//alert(val);

 if (event.keyCode != 0 )
	{ 
		if (data !='')
		{
			document.getElementById(tipe).value = data;
		}
	}

/*var mat_value = document.getElementById(mat).value;


			//for (i = 0; i <= val; i++) {
$('#id_DP_L_'+i).disabled = false ;
			
		document.getElementById("id_DP_L_"+i).disabled = false;	*/		
				//}

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

function display_batch_no()
{ 
if (event.keyCode != 0 )
	{ 
		var obj = document.form_add_order;
		$("#div_awal").hide();
		$("#div_batch_no").show();
		//var text_no_jumbo =  document.getElementById(text_no_jumbo).value
		var text_no_jumbo = obj.text_no_jumbo.value;
		text_no_jumbo = text_no_jumbo.split(" ").join("");
		var text_tanggal_awal = obj.text_tanggal_awal.value;
		var id_m_line_jumbo = obj.id_m_line_jumbo.value;
		var par = "pr="+text_tanggal_awal+"|"+id_m_line_jumbo+"|"+text_no_jumbo;
		//alert(par);
		Loaddiv('div_batch_no','../ajax/batch_no_jumbo_tiket.php','act=material_bahan&pr='+par);
	}
	
}
function display_batch_no__()
{
//alert('xx');
 if (event.keyCode != 0 )
	{ 
		var obj = document.form_add_order;
		$("#div_awal").hide();
		$("#div_batch_no").show();
		//var text_no_jumbo =  document.getElementById(text_no_jumbo).value
		var text_no_jumbo = obj.text_no_jumbo.value;
		var text_tanggal_awal = obj.text_tanggal_awal.value;
		var id_m_line_jumbo = obj.id_m_line_jumbo.value;

	//	var atipe = atipe.toUpperCase();

//alert(hasil);
		var divnya = "div_batch_no";
		var xmlHttp = GetXmlHttpObject();
		var url = "../ajax/batch_no_jumbo_tiket.php";
	
		var par = "pr="+text_tanggal_awal+"|"+id_m_line_jumbo+"|"+text_no_jumbo+"&mr="+ Math.random();
		//var par = "pr="+text_no_jumbo+"&mr=" + Math.random();
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
       
 
}

function print_kecil_conf(val)
{
 	var list_antrian = $("#list_antrian").val();
	var copies = $("#copies").val();
	//var list_antrian = val;
	//alert (list_antrian);
	if (list_antrian != "")
	{
 		var cek = confirm('Anda yakin untuk Cetak Label KECIL ?\nPastikam Printer sudah siap untuk Cetak Label KECIL ! ');
          if(cek){
                cetak_label_kecil(list_antrian,copies);
           }
	}
}

function cetak_label_kecil(val,copies) 
   	{

		$.post('script_jumbo_tiket.php?act=cetak_label_kecil&id='+val+'&copies='+copies,'',function(respon_save){
        if(respon_save=='sukses'){}else{}});
	}


function delete_detail_conf(val)
        {
            
            var obj = document.form_add_order;                
       		var cek = confirm('Anda yakin untuk Hapus ?');
            if(cek)
			{
               delete_detail(val);
					var myvar = val.split('|');
					var offset = myvar[0];
					var id = myvar[1];
					var lemparan = offset+'|'+id;
					add_order(lemparan);
            }
        
         }

function delete_detail(val){
            var periode = $("#cbo_periode").val();
			var cbo_orderbyx ='1';
            var txt_sembunyi = $("#txt_sembunyi").val();
            var offset =  $("#txt_offset").val();
 	
$.post('script_jumbo_tiket.php?act=delete_detail&pilihan='+val,$("#form_add_order").serialize(),function(respon_save){
                if(respon_save=='sukses'){			

                    alert('Berhasil di Hapus');
                   // parent.jQuery.fancybox.close();
      
            }else{
                    alert(respon_save);
                }

Loaddiv('div_data','script_jumbo_tiket.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode+'&txt_menuid='+txt_menuid+'&id_m_line='+id_m_line+'&status='+status);  
 var myvar = val.split('|');
					
					var id = myvar[1];
					var lemparan = offset+'|'+id;
					add_order(lemparan);  
            });
        }



function add_received(val){
//alert(val);
        //$lemparan_group_mesin = "'".$offset.'|'.$id_tr_order."'";

			var myvar = val.split('|');
			var offset = myvar[0];
            var id_tr_jumbo_order = myvar[1];
			$("#div_batch_no").hide();
			//var grade = myvar[2];
          //  var id_tr_produksi_detail_batch_no = myvar[3];
			
			txt_offset.value = offset;
			
			var txt_sembunyi = $("#txt_sembunyi").val();
         	var offset =  $("#txt_offset").val();
			var txt_menuid =  $("#txt_menuid").val();

	//alert(offset);

  			$.post('script_jumbo_tiket.php?act=form_add_received&lemparan='+val+'&txt_menuid='+txt_menuid,'',function(respon_edit){
                $.fancybox(respon_edit);
            });

        }
		
function add_order(val){
//alert(val);
        //$lemparan_group_mesin = "'".$offset.'|'.$id_tr_order."'";

			var myvar = val.split('|');
			var offset = myvar[0];
            var id_tr_jumbo_order = myvar[1];
			$("#div_batch_no").hide();
			//var grade = myvar[2];
          //  var id_tr_produksi_detail_batch_no = myvar[3];
			
			txt_offset.value = offset;
			
			var txt_sembunyi = $("#txt_sembunyi").val();
         	var offset =  $("#txt_offset").val();
			var txt_menuid =  $("#txt_menuid").val();

	//alert(offset);

  			$.post('script_jumbo_tiket.php?act=form_add_order&lemparan='+val+'&txt_menuid='+txt_menuid,'',function(respon_edit){
                $.fancybox(respon_edit);
            });

        }
function save_quality_alert_conf(val)
{
		var obj = document.form_quality_alert;
       	var txt_corrective = obj.txt_corrective.value;
		
		if (txt_corrective =='' )
				{	
 				alert('Corrective Belum Di isi !');
				 return false;
				}
			var cek = confirm('Anda yakin untuk Simpan data ini?');
				if(cek)
				{				
					save_quality_alert(val);
				}
}
function save_quality_alert(val){
           //alert(val);
			var periode = $("#cbo_periode").val();
			var offset =  $("#txt_offset").val();
			var txt_menuid = $("#txt_menuid").val();
			var status = $("#cbo_pilihan").val();

 //alert(offset);
		
 $.post('script_jumbo_tiket.php?act=save_quality_alert&pilihan='+val,$("#form_quality_alert").serialize(),function(respon_save){
                if(respon_save=='sukses'){
               alert('Berhasil di simpan');
				}else
				{
                    alert(respon_save);
                }
                //$lemparan_group_mesin = "'".$offset.'|'.$id_tr_order."'";
Loaddiv('div_data','script_jumbo_tiket.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode+'&txt_menuid='+txt_menuid+'&id_m_line='+id_m_line+'&status='+status);  
 var myvar = val.split('|');
					
					var id = myvar[1];
					var lemparan = offset+'|'+id;
					add_order(lemparan);

            });  

        }

function save_received_conf(val)
	{
		var obj = document.form_add_received;
		var cek = confirm('Anda yakin untuk Simpan data ini?');
				if(cek)
				{				
					save_received(val);
				}
	}

function save_received(val)
{
	      // alert(val);
			var periode = $("#cbo_periode").val();
			var offset =  $("#txt_offset").val();
			var txt_menuid = $("#txt_menuid").val();
			var status = $("#cbo_pilihan").val();

 $.post('script_jumbo_tiket.php?act=save_received&pilihan='+val,$("#form_add_received").serialize(),function(respon_save){
                if(respon_save=='sukses')
				{
 					alert('Berhasil di simpan');
					parent.jQuery.fancybox.close();
				}else
				{
                    alert(respon_save);
                }
                //$lemparan_group_mesin = "'".$offset.'|'.$id_tr_order."'";
Loaddiv('div_data','script_jumbo_tiket.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode+'&txt_menuid='+txt_menuid+'&id_m_line='+id_m_line+'&status='+status);  
					
					/*var myvar = val.split('|');
					var id = myvar[1];
					var lemparan = offset+'|'+id;
					//add_order(lemparan);
					parent.jQuery.fancybox.close();*/

            });  

        
}
function save_jumbo_conf(val)
		{ 

			//alert(val);
			var obj = document.form_add_order;
           	//var text_batch_no = obj.text_batch_no.value;
			var text_batch_no = $("#text_batch_no").val();
			var text_tanggal_awal = obj.text_tanggal_awal.value;
		    var text_no_jumbo = obj.text_no_jumbo.value;
            var text_no_jumbo = text_no_jumbo.trim();
			var cbo_shift = obj.cbo_shift.value;
			var cbo_m_group_shift = obj.cbo_m_group_shift.value;
			
			var id_tr_jumbo_tiket = $("#id_tr_jumbo_tiket").val();
			
		/*	var txt_sembunyi = $("#txt_sembunyi").val();
			var status = $("#cbo_pilihan").val();
			txt_sembunyi = status+'|'+var_sembunyi;*/
			var offset = $("#txt_offset").val();
			//alert(text_no_jumbo);
			//alert('xxx = '+text_batch_no);
			if (text_tanggal_awal =='' )
				{
					
 				alert('Start Time Belum Di isi !');
					 return false;
				}
			
			if (id_tr_jumbo_tiket == '')
			 {
				if (text_batch_no =='' || text_batch_no == undefined )
					{
						
					alert('Batch No Belum Di isi !');
						 return false;
					}
			 }
			if (text_no_jumbo =='' )
				{
					
 				alert('No Jumbo Belum Di isi !');
					 return false;
				}
			if (cbo_shift =='' || cbo_shift =='0'  )
				{
					 alert('Shift Belum Di Pilih !');
					 return false;
				}
			if (cbo_m_group_shift =='' || cbo_m_group_shift =='0'  )
				{
					 alert('Group Shift Belum Di Pilih !');
					 return false;
				}
  		

				var cek = confirm('Anda yakin untuk Simpan data ini?');
				if(cek)
				{				
					save_jumbo(val);
				
				}
		
		}

		function save_jumbo(val){
           //alert(val);
			var periode = $("#cbo_periode").val();
			var offset =  $("#txt_offset").val();
			//var id_m_line = $("#id_m_line").val();
			//var txt_sembunyi = $("#txt_sembunyi").val();
			var txt_menuid = $("#txt_menuid").val();
			var status = $("#cbo_pilihan").val();

 //alert(offset);
		
 $.post('script_jumbo_tiket.php?act=save_jumbo&pilihan='+val,$("#form_add_order").serialize(),function(respon_save){
                if(respon_save=='sukses'){
                   
				//	parent.jQuery.fancybox.close();
 alert('Berhasil di simpan');
				}else
				{
                    alert(respon_save);
                }
                //$lemparan_group_mesin = "'".$offset.'|'.$id_tr_order."'";
Loaddiv('div_data','script_jumbo_tiket.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode+'&txt_menuid='+txt_menuid+'&id_m_line='+id_m_line+'&status='+status);  
 var myvar = val.split('|');
					
					var id = myvar[1];
					var lemparan = offset+'|'+id;
					add_order(lemparan);

            });  

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

function save_group_mesin(val){
             //alert(val);
			var periode = $("#cbo_periode").val();
			var offset =  $("#txt_offset").val();
			var id_m_line = $("#id_m_line").val();
			var txt_sembunyi = $("#txt_sembunyi").val();
			var txt_menuid = $("#txt_menuid").val();
			var status = $("#cbo_pilihan").val();

 $.post('script_jumbo_tiket.php?act=save_group_mesin&offset='+offset,$("#form_add_group_mesin").serialize(),function(respon_save){
                if(respon_save=='sukses'){
                    alert('Berhasil di simpan');
					parent.jQuery.fancybox.close();

				}else
				{
                    alert(respon_save);
                }
                
Loaddiv('div_data','script_jumbo_tiket.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode+'&txt_menuid='+txt_menuid+'&id_m_line='+id_m_line+'&status='+status);  

            });  

        }
function add_group_mesin(val){
//alert(val);
        //$lemparan_group_mesin = "'".$offset.'|'.$id_tr_order."'";

			var myvar = val.split('|');
			var offset = myvar[0];
            var id_tr_order = myvar[1];
			var grade = myvar[2];
            var id_tr_produksi_detail_batch_no = myvar[3];
			
			txt_offset.value = offset;
			
			var txt_sembunyi = $("#txt_sembunyi").val();
         	var offset =  $("#txt_offset").val();
	
  			$.post('script_jumbo_tiket.php?act=form_add_group_mesin&lemparan_group_mesin='+val,'',function(respon_edit){
                $.fancybox(respon_edit);
            });

        }


function isNumber_dan_minus(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if ( (charCode < 44 || charCode > 46) && (charCode < 48 || charCode > 57)  ) {
        return false;
    }
    return true;
}

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>

    <script>
  
 function show_winding(val) 
   {
//alert(val);
        var flagtrans = 8;
        var obj = document.form_add_order;
        var xmlHttp = GetXmlHttpObject();
        var url = "../ajax/show_winding.php";
        var par = "pr="+flagtrans +"|"+ val + "&mr=" + Math.random();
		//Change_lot(0);
        if (!xmlHttp) {
            return;
        }
                    
        xmlHttp.onreadystatechange = function() {
            var arrResponseText;
            if (xmlHttp.readyState == 4) {
                arrResponseText = xmlHttp.responseText.split("|");
                document.getElementById("div_show_winding").innerHTML = arrResponseText[1];
                
            } else {
               
                document.getElementById("div_show_winding").innerHTML = "<img src=\"../images/ajax.gif\" alt=\"loading...\" border=\"0\" />";
            }
        }
        xmlHttp.open("POST", url, true);
        xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlHttp.setRequestHeader("Content-length", par.length);
        xmlHttp.setRequestHeader("Connection", "close");
        xmlHttp.send(par);
    }
    function Change_periode(val) 
   {
        var flagtrans = 8;
        var obj = document.form_add;
        var xmlHttp = GetXmlHttpObject();
        var url = "../ajax/type.php";
        var par = "pr="+flagtrans +"|"+ val + "&mr=" + Math.random();
		Change_lot(0);
        if (!xmlHttp) {
            return;
        }
                    
        xmlHttp.onreadystatechange = function() {
            var arrResponseText;
            if (xmlHttp.readyState == 4) {
                arrResponseText = xmlHttp.responseText.split("|");
                document.getElementById("div_type").innerHTML = arrResponseText[1];
                
            } else {
               
                document.getElementById("div_type").innerHTML = "<img src=\"../images/ajax.gif\" alt=\"loading...\" border=\"0\" />";
            }
        }
        xmlHttp.open("POST", url, true);
        xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlHttp.setRequestHeader("Content-length", par.length);
        xmlHttp.setRequestHeader("Connection", "close");
        xmlHttp.send(par);
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
	
function choose_me_order(row,val){
		//alert(val);
			if($('#cek_order_'+row).attr('checked')==false){
				$('#cek_order_'+row).attr('checked',false);
				var list_val = $("#list_order").val();
				list_val = $("#list_order").val().replace(val+',','');
				$("#list_order").val(list_val);
			}else{
				$('#cek_order_'+row).attr('checked',true);
				var list_val = $("#list_order").val();
				if(list_val.search(val)==-1){
					list_val = list_val+val+',';
					$("#list_order").val(list_val);
				}
			}
		
		}

function checklist_all_app(val) {
	//	alert(val);
			var checkbox = document.form_add_order.elements['cek_app_[]'];
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
	function checklist_all(val) {
		//alert(val);
			var checkbox = document.form_add_order.elements['cek_[]'];
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
	
    function show_data()
        {
        var txt_sembunyi = $("#txt_sembunyi").val();
    	var cbo_orderbyx = '1';
    	Loaddiv('div_data','script_jumbo_tiket.php','act=show_table&cbo_orderbyx='+cbo_orderbyx+'&txt_sembunyi='+txt_sembunyi);
    
        }
        

	function edit_group(val){
	//alert(val);
			//var txt_sembunyi = $("#txt_sembunyi").val();
            var myvar = val.split('|');
			var id_tr_pk = myvar[0];
			var id_m_schedule_detail  = myvar[1];
			var offset = myvar[2];
         
 $.post('script_jumbo_tiket.php?act=form_edit_group&lemparan='+val,'',function(respon_edit){
                $.fancybox(respon_edit);
            });
        }



function save_group(val){
			
			var periode = $("#cbo_periode").val();
			var myvar = val.split('|');
			var id_tr_pk = myvar[0];
			var id_m_schedule_detail = myvar[1];
			var offset = myvar[2];
				
				$.post('script_jumbo_tiket.php?act=save_group',$("#form_edit_group").serialize(),function(respon_save){
					if(respon_save=='sukses'){
						alert('Berhasil disimpan');
						parent.jQuery.fancybox.close();
					 //   Loaddiv('div_data','script_jumbo_tiket.php','act=show_table&cbo_orderby='+cbo_orderby);   
	Loaddiv('div_data','script_jumbo_tiket.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode); 
				}else{
						alert(respon_save);
					}
				});
			}
	

/*function un_approve_conf(val){
            
            var myvar = val.split('|');
            var id_tr_pk = myvar[0];
            var offset = myvar[1];
            txt_offset.value = offset;
            
            var cek = confirm('Anda yakin untuk UN - Approve RPS/R ini ?');
            if(cek){
                un_approve_data(id_tr_pk);
            }
        }

function un_approve_data(val){
            var cbo_orderbyx ='1';
			var periode = $("#cbo_periode").val();
            var id_tr_pk = val;
            var txt_sembunyi = $("#txt_sembunyi").val();
            var offset =  $("#txt_offset").val();
var txt_menuid = $("#txt_menuid").val();
            
            $.post('script_jumbo_tiket.php?act=un_approve_data&id_tr_pk='+id_tr_pk,'',function(respon_delete){
                if(respon_delete=='sukses'){
                    alert('Berhasil di Approve');
                }else{
                    alert(respon_delete);
                }
            Loaddiv('div_data','script_jumbo_tiket.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode+'&txt_menuid='+txt_menuid);
          
            });
        }*/
function occurrences(string, subString, allowOverlapping) {

    string += "";
    subString += "";
    if (subString.length <= 0) return (string.length + 1);

    var n = 0,
        pos = 0,
        step = allowOverlapping ? 1 : subString.length;

    while (true) {
        pos = string.indexOf(subString, pos);
        if (pos >= 0) {
            ++n;
            pos += step;
        } else break;
    }
    return n;
}
function approve_conf(val){
            
            var myvar = val.split('|');
            var id = myvar[1];
            var offset = myvar[0];
            txt_offset.value = offset;
            var obj = document.form_add_order; 
            
            var a = obj.list_antrian_app.value;
            var pjg = occurrences(a,',');
               
            var cek = confirm('Anda yakin untuk Approve ' + pjg + ' data ? ');
            if(cek){
                approve_data(val);
            }
        }


 function approve_data(val){
           //alert(val);
			var periode = $("#cbo_periode").val();
			var offset =  $("#txt_offset").val();
			var id_m_line = $("#id_m_line").val();
			//var txt_sembunyi = $("#txt_sembunyi").val();
			var txt_menuid = $("#txt_menuid").val();
			var status = $("#cbo_pilihan").val();

 //alert(offset);
		
 $.post('script_jumbo_tiket.php?act=approve_detail&pilihan='+val,$("#form_add_order").serialize(),function(respon_save){
                if(respon_save.substring(0,6)=='sukses'){
                   alert('Berhasil di Approve');
				}else
				{
                    alert(respon_save);
                }
                //$lemparan_group_mesin = "'".$offset.'|'.$id_tr_order."'";
Loaddiv('div_data','script_jumbo_tiket.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode+'&txt_menuid='+txt_menuid+'&id_m_line='+id_m_line+'&status='+status);  
 					
					var myvar = val.split('|');
//var offset = myvar[0];
					var id = myvar[1];
					var lemparan = offset+'|'+id;
					add_order(lemparan);
            });  

        }
        
        function search_data(){
            $.post('script_search.php?act=form_search_kegiatan','',function(respon){
                $.fancybox(respon);
                
            });
        }
        
       
      
        
function cancel()
{

  var txt_sembunyi = $("#txt_sembunyi").val();
            var offset =  $("#txt_offset").val();
 parent.jQuery.fancybox.close();
//Loaddiv('div_data','script_jumbo_tiket.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi);
}
        
        function delete_data(val){
            var id_tr_pk = val;
          	var periode = $("#cbo_periode").val();
			var cbo_orderbyx ='1';
            var txt_sembunyi = $("#txt_sembunyi").val();
            var offset =  $("#txt_offset").val();
            var alasan_cancel = $("#txt_cancel").val();
			var alasan_cancel = alasan_cancel.split(' ').join('8764346466435364647768799667654537543756');
//alert(alasan_cancel);
            //$.post('script_jumbo_tiket.php?act=delete_data&id_tr_pk='+id_tr_pk,'',function(respon_delete){
			$.post('script_jumbo_tiket.php?act=delete_data&id_tr_pk='+id_tr_pk+'&alasan_cancel='+alasan_cancel,'',function(respon_delete){
                if(respon_delete=='sukses'){
                    alert('Berhasil di CANCEL');
                }else{
                    alert(respon_delete);
                }
            
Loaddiv('div_data','script_jumbo_tiket.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode);
            });
        }

function show_blth_log(val){
			//alert(val);
			var periode = $("#cbo_periode").val();
 			var offset =  $("#txt_offset").val();
			var id_m_line = $("#id_m_line").val();
			var status = $("#cbo_pilihan").val();
			//var status = val;
			 parent.jQuery.fancybox.close();
  			/*var cbo_orderbyx ='1';
            var txt_sembunyi = $("#txt_sembunyi").val();
			var txt_menuid = $("#txt_menuid").val();
           */

			Loaddiv('div_data','script_jumbo_tiket.php','act=show_table&offset='+offset+'&txt_menuid='+txt_menuid+'&periode='+periode+'&id_m_line='+id_m_line+'&status='+status);
			
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
				order by b.id_m_group_line, a.id_m_line 
				";

$sql_line = "SELECT a.id_m_line_jumbo as val , a.nama_line_jumbo as display FROM m_line_jumbo a 
					WHERE a.status = 't'
					ORDER BY a.nama_line_jumbo  ";
        $qry_line = mysql_query($sql_line) or die("Invalid query!" . $sql_line);
if(!isset($where_periode)) $where_periode="";
$sql = "SELECT DISTINCT periode 
				FROM m_schedule $where_periode
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
						  if(isset($periode)){
                            if($row["periode"]==$periode)
                                       {
                                           echo 'selected';
                                    }
						  }
                            ?>
                      >
                  <?=$row["periode"]?>
              </option>
                <?php } 
				?>
            </select></td>
                          <td rowspan="2" align="right"><select name="cbo_pilihan" id="cbo_pilihan" class="combobox"  onchange="show_blth_log(this.value)">
                            <option value="1">Approved</option>
                              <option value="2">Not Approved</option>
                              <option value="0">All</option>
                            </select>
                           <!-- <input type="button" name="button_add" id="button_search" value="Search" class="button" onclick="search_data()" />-->  </td>
                      </tr>
 <tr>
   <td align="left">Line &nbsp;: 
     &nbsp;
	 
<?php 
if(!isset($id_m_line)) $id_m_line = "";
makecomboonchange($sql_line,"id_m_line","id_m_line","",$id_m_line,"- All -","","show_blth_log(this.value)"); ?>
     </td>
 </tr>
                        <tr>
                            <td colspan="2" align="right">
                             <div id="tambah">
                                       <p>
                                         <label for="txt_sembunyi"></label>
                                         <input type="hidden" name="txt_cancel" id="txt_cancel" />
                                       </p>
                                       <p>
                                         <input type="hidden" name="txt_sembunyi" id="txt_sembunyi" />
                                         <label for="txt_offset"></label>
<input name="txt_menuid" type="hidden" id="txt_menuid" value ="<?php echo $menu_id ?>"  />
                                         <input type="hidden" name="txt_offset" id="txt_offset" />
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
            var txt_sembunyi = $("#txt_sembunyi").val();
var status = $("#cbo_pilihan").val();


// var offset =  $("#txt_offset").val();
//alert(periode);
var txt_menuid = $("#txt_menuid").val();
txt_offset.value= '0';
var id_m_line = $("#id_m_line").val();

            var offset =  $("#txt_offset").val();
			Loaddiv('div_data','script_jumbo_tiket.php','act=show_table&offset='+offset+'&txt_sembunyi='+txt_sembunyi+'&periode='+periode+'&txt_menuid='+txt_menuid+'&id_m_line='+id_m_line+'&status='+status);
   // Loaddiv('div_data','script_jumbo_tiket.php','act=show_table');
    //var cbo_orderbyx = '1';
  
</script>
<?php
    mysql_close();
?>
