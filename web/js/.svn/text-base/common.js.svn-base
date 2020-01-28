$(document).ready(function(){
	//$(".chzn-select").chosen({allow_single_deselect: true});
	
	$('input[type=submit]').button();
	$('input[type=button]').button();
	$('button').button();
	
	
	var oTable = new jqueryTable();
	oTable.create($("#table_tts_new"));
	oTable.generate();
	
	//  Cette action permet de vider le formulaire  datatable  après chaque Ajout
	$('[id^=btnAdd]').live('mousedown',function(){
		$('div[id*=form] form input[type=text]').val('');
		$('div[id*=form]  form select').val('');
		$('div[id*=form]  form select').trigger("liszt:updated");
	});

	$(".tabs").tabs( {
		"show": function(event, ui) {
			var jqTable = $('table.display', ui.panel);
			if ( jqTable.length > 0 ) {
				var oTableTools = TableTools.fnGetInstance( jqTable[0] );
				if ( oTableTools != null && oTableTools.fnResizeRequired() )
				{
					/* A resize of TableTools' buttons and DataTables' columns is only required on the
					 * first visible draw of the table
					 */
					jqTable.dataTable().fnAdjustColumnSizing();
					oTableTools.fnResizeButtons();
				}
			}
			
	       //  dans le cas où on utilise le ScrollY 
			
			var oTableTools = $('div.dataTables_scrollBody>table.display', ui.panel).dataTable();
			if ( oTableTools.length > 0 ) {
				oTableTools.fnAdjustColumnSizing();
			}
		}
	} );
	
	jQuery("form").validationEngine();
	
	/* set date picker --------------------*/
	$.datepicker.setDefaults($.datepicker.regional['fr']);
	$( ".input-datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });
	/* -----------------------------------*/
	
	if(typeof SIRH === 'undefined')
		$("select:not(.no-chozen):not([required=\"1\"]):not([required=\"required\"])").chosen({allow_single_deselect: true});
	
	$(document).on('nested:fieldRemoved', function (event) {
	    $('[required]', event.field).remoteAttr('required');
	});
	
	$('form').submit(function(){
		var form = $(this);
		var options = form.data('jqv');
	 	if(!options.InvalidFields.length) {
	 		loadPage();
	 	}else{
	 		return false;
	 	}
	});
	
	$(".accordion").accordion({
		active: "h3.opened", autoHeight: false,
		collapsible: true,
		change: function(event, ui) {
			var jqTable = $('table.display', ui.newContent);
			if ( jqTable.length > 0 ) {
				var oTableTools = TableTools.fnGetInstance( jqTable[0] );
				if ( oTableTools != null && oTableTools.fnResizeRequired() )
				{
					/* A resize of TableTools' buttons and DataTables' columns is only required on the
					 * first visible draw of the table
					 */
					jqTable.dataTable().fnAdjustColumnSizing();
					oTableTools.fnResizeButtons();
				}
			}
			
           //  dans le cas où on utilise le ScrollY 
			
			var oTableTools = $('div.dataTables_scrollBody>table.display', ui.panel).dataTable();
			if ( oTableTools.length > 0 ) {
				oTableTools.fnAdjustColumnSizing();
			}
	    }
	});
	
});



$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

$.fn.watchProperty = function(name, handler) {
	$obj = $(this);
	$obj.each(function(){
		var obj = this;
	    if ('watch' in obj) {
	        obj.watch(name, handler);
	    } else if ('onpropertychange' in obj) {
	        name= name.toLowerCase();
	        obj.onpropertychange= function() {
	            if (window.event.propertyName.toLowerCase()===name)
	                handler.call(obj);
	        };
	    } else {
	        var o= obj[name];
	        setInterval(function() {
	            var n= obj[name];
	            if (o!==n) {
	                o= n;
	                handler.call(obj);
	            }
	        }, 200);
	    }
	});
}

function getQueryTable(option){
	var url = option['url'];
	var query = option['query'];
	var table = option['table'];
	var mask = option['mask'];
	var data = option['data'] ? option['data'] : null;
	var triggerLine = option['triggerLine'] ? option['triggerLine'] : null; 
	var triggerAfter = option['triggerAfter'] ? option['triggerAfter'] : function(){ return true; };
	
	if(table instanceof jqueryTable){
		
		var wrapper = table.getTable().parents(".dataTables_wrapper");
		
	}else if(table instanceof TTS_Table){
		
		var wrapper = table.table.parents(".scroll_container");
		
	}else{

		var DomType = table.get(0).tagName;
		var wrapper = table;
	}
	
	
	wrapper.css('display','none');
	wrapper.after("<div class='query-charge' style='padding:6px;margin:6px'><img src='/img/loading.gif'> Chargement...</div>");
	
	$.ajax({
		url: url,
		type: 'post',
		data: {q: query, queryparam: data},
		success: function(data){
			wrapper.css('display','');
			wrapper.next(".query-charge").remove();
			if(table instanceof jqueryTable){
				table.getDataTable().fnClearTable();
			}else if(table instanceof TTS_Table){
				table.body_tr.remove();
			}else{
				if(DomType == 'TABLE'){
					table.find("tbody").find("tr").remove();
				}else if(DomType == 'DIV'){
					table.find(".body").find(".tr").remove();
				}
			}
			var obj = eval('('+data+')');
			var oData = new Array();
			for(key in obj){
				if(key == "remove" || key == "indexOf") continue;
				
				if(!$.isFunction(mask)){
					var line = JSON.stringify(mask);
				}else{
					var line = JSON.stringify(mask(obj[key]));
				}
				for(keyr in obj[key]){
					//line = line.replace(/":"+keyr/g,obj[key][keyr]);
					var reg = new RegExp("(\\\\\"|\')\:"+keyr+"(\\\\\"|\')","g");
					var reg2 = new RegExp("\#\:"+keyr+"\#","g");
					line = line.replace(reg,"'"+obj[key][keyr]+"'");
					line = line.replace(reg2,obj[key][keyr]);
				}
				
				var op = new RegExp("\\$\:((?!\:\\$).)+\:\\$","g");
				line = line.replace(op,function(match, contents, offset, s){ if(match) { 
					match = match.replace("$:","");
					match = match.replace(":$","");
					try {
					return eval(match);
					}catch(e){
						alert("Erreur d'execution : "+match);
						return "[Erreur]";
					};
				 } 
					else return match; });
				
				if(table instanceof jqueryTable){
					table.addLine(eval('('+line+')'),triggerLine ? triggerLine(obj[key]) : null);
				}else if(table instanceof TTS_Table){
					table.addLine(eval('('+line+')'));
				}else{
					
					try{
						objLine = eval('('+line+')');
					}catch(e){ alert("ERROR INSERTION !"); }
					
					if(DomType == 'TABLE'){
						table.find("tbody").append("<tr><td>"+objLine.join("</td><td>")+"</td></tr>");
					}else if(DomType == 'DIV'){
						table.find(".body").append("<div class='tr'><div>"+objLine.join("</div><div>")+"</div></div>");
					}
				}
			}
			try{
				triggerAfter(obj);
			}catch(e){
				triggerAfter();
			}
		}
	});
}

function setArbre(parent){
	
	zone = $(parent).parent();
	
	$(parent+' ul').hide();
	
	zone.find('img').click(function(event){
		if(!event.detail || event.detail==1){
			bloc = $(this).parent().find('ul:first');
			if(bloc){
				if (bloc.is(":hidden")) { 
					bloc.show("blind"); 
				} else { 
					bloc.hide("blind"); 
				}
			}
		}
	});
}

function setDataArbre(parent,data){
	
	zone = $(parent).parent();
	
	zone.find('span').click(function(event){

		zone.find('span').css('background-color','');
		zone.find('span').css('color','');
		
		$(this).css('background-color','#6666aa');
		$(this).css('color','#fff');
		
		if(!event.detail || event.detail==1){
			idObj = $(this).parent().attr('id');
			niveau = $(this).parents(parent).length - 1;
			//alert(niveau);
			id = parseInt(""+idObj+"");
			id = ""+id+"";
			if(id){
				dataParent = $(this).parents(parent);
				var tempData = data;
				if(niveau){
					for(i=niveau-1;i>=0;i--){
						ul = dataParent.get(i);
						id_parent = ul.parentNode.id;
						id_parent = ""+parseInt(""+id_parent+"")+"";
						//alert(id_parent+' '+data[id_parent]);
						tempData = tempData[id_parent]['_composant_'];
					}
				}

				
				for(key in tempData[id]){
					if($('#'+key)){
						if(!tempData[id][key]) tempData[id][key] = '';
						$('#'+key).text(tempData[id][key]);
					}
				}
			}
		}
	});
}


$.fn.setTotalTable = function(cols){
	var current = $(this);
	current.find("thead tr th").each(function(index){
  		var total = 0;
		if($.inArray(index,cols) >= 0){
			current.find("tbody tr").each(function(){
				var val = $(this).find("td:eq("+index+")").text();
				val = val.replace(",",".");
				val = val.replace(" ","");
				val = val.replace(" ","");
				val = val ? parseFloat(val) : 0;
				total += val;
			});
			current.find("tfoot tr td:eq("+index+")").text(total.toFixed(2));
		}
   	});
}

function loadPage(){
	var div = $("#tts_load_page");
	var wheight = $(document).height();
	var wwidth = $(document).width();
	div.css('height', wheight+'px');
	div.css('width', wwidth+'px');
	div.show();
}

function unloadPage(){
	$('#tts_load_page').hide();
}

function addToDate(date,d,m){
	d = parseInt(d);
	m = parseInt(m);
    var dateAdd = $.datepicker.parseDate('dd/mm/yy', date);
    dateAdd.setDate(dateAdd.getDate() + d);
    dateAdd.setMonth(dateAdd.getMonth() + m);
    
    var resDate =  dateAdd.getDate() < 10 ? '0'+dateAdd.getDate() : dateAdd.getDate();
    var resMonth =  dateAdd.getMonth()+1 < 10 ? '0'+Number(dateAdd.getMonth()+1) : dateAdd.getMonth()+1;
    var resYear =  dateAdd.getFullYear();
    
    var fullDate = resDate + "/" + resMonth + "/" + resYear;
    return fullDate;
}

function lastDate(date){
	 var dd = $.datepicker.parseDate('dd/mm/yy', date);
	 var dateAdd = new Date(dd.getFullYear(), dd.getMonth() + 1, 0);
	 var resDate =  dateAdd.getDate() < 10 ? '0'+dateAdd.getDate() : dateAdd.getDate();
	 var resMonth =  dateAdd.getMonth()+1 < 10 ? '0'+Number(dateAdd.getMonth()+1) : dateAdd.getMonth()+1;
	 var resYear =  dateAdd.getFullYear();
	 var fullDate = resDate + "/" + resMonth + "/" + resYear;
	 return fullDate;
}

function convertDate(date,format){
	if(format == "dd/mm/yyyy"){
		var dd = $.datepicker.parseDate('yy-mm-dd', date);
		fullDate = (dd.getDate()<9 ? "0" : "") + dd.getDate() + "/" + ((dd.getMonth()+1)<9 ? "0" : "") + (dd.getMonth()+1) + "/" + dd.getFullYear();
	}else if(format == "yyyy-mm-dd"){
		var dd = $.datepicker.parseDate('dd/mm/yy', date);
		fullDate = dd.getFullYear() + "-" + ((dd.getMonth()+1)<9 ? "0" : "") + (dd.getMonth()+1) + "-" + (dd.getDate()<9 ? "0" : "") + dd.getDate();
	}
	
	return fullDate;
}

$.fn.updateAttr = function(table,op,cond,url,show,trigger){
	trigger = trigger ? trigger : function(){};
	var obj = $(this);
	var val = obj.is(":checked") ? true : false;
	  if(!confirm("Voulez-vous vraiment executer l'operation ?")){ 
		  obj.attr("checked",!val);
		  return -1;
	  }
	  var text = $("<span>En cours...</span>");
	  obj.attr("disabled","disabled");
	  obj.parent().append(text);
	  $.ajax({
			url: url,
			type: 'post',
			data: {table: table, op: op, cond: cond},
			success: function( msg ) {
				if(msg == 1) {
					text.remove();
					if(show) obj.attr("disabled",false);
					trigger();
				}else {
					obj.attr("disabled",false);
					text.remove();
					alert(msg);
				}
			},
			error: function( msg ) {
				text.remove();
				alert(msg.responseText);
			}
		});
}

var tableToExcel_old = (function() {
	  var uri = 'data:application/vnd.ms-excel;base64,'
	    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
	    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
	    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
	  return function(table, name) {
	    if (!table.nodeType) table = document.getElementById(table)
	    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
	    window.location.href = uri + base64(format(template, ctx))
	  }
	})()
	
	
	
	
	function tableToExcel(tableid, name_file) {
		var table= document.getElementById(tableid);
		var html = table.outerHTML;
		name_file = name_file === undefined ? 'Download' : name_file ;
		//add more symbols if needed...
		while (html.indexOf('á') != -1) html = html.replace('á', '&aacute;');
		while (html.indexOf('é') != -1) html = html.replace('é', '&eacute;');
		while (html.indexOf('è') != -1) html = html.replace('è', '&egrave;');
		while (html.indexOf('ê') != -1) html = html.replace('ê', '&ecirc;');
		while (html.indexOf('à') != -1) html = html.replace('à', '&agrave;');
		while (html.indexOf('ç') != -1) html = html.replace('ç', '&ccedil;');
		while (html.indexOf('í') != -1) html = html.replace('í', '&iacute;');
		while (html.indexOf('ó') != -1) html = html.replace('ó', '&oacute;');
		while (html.indexOf('ú') != -1) html = html.replace('ú', '&uacute;');
		while (html.indexOf('û') != -1) html = html.replace('û', '&ucirc;');
		while (html.indexOf('º') != -1) html = html.replace('º', '&ordm;');
		while (html.indexOf("’") != -1) html = html.replace("’", "'");
		while (html.indexOf("°") != -1) html = html.replace("°", "&deg;");

		window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));

        return false;
	}
			
	
	$.fn.exportPDF = function(urlImg,urlPDF,ID){
		var capture = {};
		var target = $(this);
		html2canvas(target, {
			onrendered: function(canvas) {
				capture.img = canvas.toDataURL( "image/png" );
				capture.data = { 'image' : capture.img };
				$.ajax({
				url: urlImg+"?time="+ID,
				data: capture.data,
				type: 'post',
				success: function( result ) {
					document.location = urlPDF+"?image=capture"+ID+".png";
				}
				});
			}
	});
}

function TTSAutoPrint(url,ID,trigger) {
	loadPage();
	$.ajax({
		url: url,
		data: {ID_FILE: ID},
		type: 'post',
		success: function(msg){
			$("#exPDF").remove();
			var objet = $('<iframe id="exPDF" style="display:none" src="/doc/'+ID+'.pdf?rand='+(new Date()).getTime() + Math.floor(Math.random() * 1000000)+'"></iframe>');
			$('body').append(objet);
			document.getElementById('exPDF').focus(); 
			var w = document.getElementById('exPDF').contentWindow;
			w.print();
			unloadPage();
		}
	});
}

$.fn.setfieldStatut = function(libelle,style){
	$(this).attr('value',libelle);
	for(key in style){
		$(this).attr(key,style[key]);
	}
};


function upload_file(file,url,progress,trigger,param, optionel){
	var formData = new FormData();
	
	trigger = trigger ? trigger : function(text){ alert(text); };
	
	$.each(file[0].files,function(i, file){
		formData.append(i, file);
	});
	
	if(param) {
		$.each(param,function(i, p){
			if(typeof(p) == "object"){
				formData.append(i,JSON.stringify(p));
			}else{
				formData.append(i,p);
			}
		});
	}
	
	$.ajax({
		url: url,
		type: 'POST',
		xhr: function(){
			myXhr = $.ajaxSettings.xhr();
			if(myXhr.upload){
				myXhr.upload.addEventListener('progress',function(e){ progressHandling(e,progress); },false);
			}
			return myXhr;
		},
		beforeSend: function(){ if(!file.val() && !optionel) { alert('Vous devez choisir un fichier!'); return false; }; progress.show(); },
		success: function(text){ trigger(text); progress.attr({value: 0, max: 0}); progress.hide(); },
		error: function(){ alert("Erreur!"); progress.hide(); },
		data: formData,
		cache: false,
		contentType: false,
		processData: false
	});
}

function overflowPopUp(){
	$(".ui-dialog").css({'overflow': 'visible'});
	$(".ui-dialog .ui-dialog-content").css({'overflow': 'visible'});
}

function progressHandling(e,progress){
	if(e.lengthComputable){
		progress.attr({value: e.loaded, max: e.total});
	}
}

function multipleSelect(action_all,action_choice,list_add,list_eject){
	
	list_add.unbind("click");
	list_eject.unbind("click");
	
	var id_all=action_all.attr('id');
	var id_choice=action_choice.attr('id');
	
	list_add.live("click",function(){
		
		action_all.find("option:selected").each(function(){

			var all_selected = new Array();
			$("select[id="+id_all+"] option:selected").each(function(){
				all_selected.push($(this).val());
			});
			
			var option_val = $(this).val();
			var option_text = $(this).text();
			
			var option = "<option value='"+option_val+"' >"+option_text+"</option>";
			
			$('select[id='+id_choice+']').append(option);
			
			all_selected.push(option_val);
			
			$('select[id='+id_choice+']').val(all_selected);
			
			$(this).remove();
			
		});
	});

	list_eject.live("click",function(){
		
		action_choice.find('option:selected').each(function(){
			
			var option_val = $(this).val();
			var option_text = $(this).text();
			
			var option = "<option value='"+option_val+"' >"+option_text+"</option>";
			action_all.append(option);
							
			$(this).remove();
		});

	});
	
	$.fn.serializeObject = function()
	{
	   var o = {};
	   var a = this.serializeArray();
	   $.each(a, function() {
	       if (o[this.name]) {
	           if (!o[this.name].push) {
	               o[this.name] = [o[this.name]];
	           }
	           o[this.name].push(this.value || '');
	       } else {
	           o[this.name] = this.value || '';
	       }
	   });
	   return o;
	};

}