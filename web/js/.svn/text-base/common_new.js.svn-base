var common = common || {};

function trim(sString) {
    while (sString.substring(0,1) == ' ' || sString.substring(0,1) == '\t' || sString.substring(0,1) == '\r' || sString.substring(0,1) == '\n')
    {
        sString = sString.substring(1, sString.length);
    }
    while (sString.substring(sString.length-1, sString.length) == ' ' || sString.substring(sString.length-1, sString.length) == '\t' || sString.substring(sString.length-1, sString.length) == '\r' || sString.substring(sString.length-1, sString.length) == '\n')
    {
        sString = sString.substring(0,sString.length-1);
    }
    return sString;
}


function upfile(form,action,trait){

	var iframe = document.createElement("iframe");
	iframe.setAttribute("id","ajax-temp");
	iframe.setAttribute("name","ajax-temp");
	iframe.setAttribute("width","0");
	iframe.setAttribute("height","0");
	iframe.setAttribute("border","0");
	iframe.setAttribute("style","width: 0; height: 0; border: none;");
	form.parentNode.appendChild(iframe);
	window.frames['ajax-temp'].name="ajax-temp";
	var showRes = function(){
		removeEvent(document.getElementById('ajax-temp'),"load", showRes);
		document.getElementById('ajax-temp').src = trait;
		remove(document.getElementById('ajax-temp'));
    }
	addEvent(document.getElementById('ajax-temp'),"load", showRes);
	form.setAttribute("target","ajax-temp");
	form.setAttribute("action",action);
	form.setAttribute("method","post");
	form.setAttribute("enctype","multipart/form-data");
	form.setAttribute("encoding","multipart/form-data");
	form.submit();
}

function addEvent(obj, evType, fn){
	if(obj.addEventListener)
	    obj.addEventListener(evType, fn, true)
	if(obj.attachEvent)
	    obj.attachEvent("on"+evType, fn)
}

function removeEvent(obj, type, fn){
	if(obj.detachEvent){
		obj.detachEvent('on'+type, fn);
	}else{
		obj.removeEventListener(type, fn, false);
	}
}

function remove(obj){
	var parent = obj.parentNode;
	parent.removeChild(obj);
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

function daysInMonth(month,year) {
	
	return dd.getDate();
	}

$.fn.setfieldStatut = function(libelle,style){
	$(this).attr('value',libelle);
	for(key in style){
		$(this).attr(key,style[key]);
	}
};

$.fn.setSelectAdvanced = function(){
	
	var parent = $(this);
	$(this).find('ul').hide();
	
	$(this).find('li:first').addClass('adv-select-style');
	$(this).find('ul').addClass('adv-list-style');
	
	parent.find('li:first').click(function(event){
		if(!event.detail || event.detail==1){
			bloc = parent.find('ul');
			if(bloc){
				if (bloc.is(":hidden")) { 
					bloc.show("blind"); 
				} else { 
					bloc.hide("blind"); 
				}
			}
		}
	});
	
	parent.find('li:first').blur(function(){
		$(this).parent().find('ul').hide();
	});
};

jQuery(document).ready(
	    function() {
	    	
	    	
	    	$('body').find("input,select,textarea").each(function(){
	    		var required = $(this).attr("required");
	    		var hidden = $(this).attr("type") == "hidden" ? true : false;
	    		var readonly = $(this).attr("readonly") ? true : false;
	    		if(required && !hidden && !readonly) {
	    			var sign = $("<span style='color:red;font-weight:bold'> * </span>");
	    			$(this).parents("td:first").append(sign);
	    		}
	    	});
	    	
//------------- Afficher +/- ----------------------- //
	    	
	    	setBoxDetail();
	    	$(document).on('click', '.box-details legend',function(){
	    		fieldset = $(this).parent();
	    			    		
				table = $(this).parent().find('div:first');
				img_open = fieldset.find('img:nth-child(1)');
				img_close = fieldset.find('img:nth-child(2)');
								
	        	if(!$(this).find('.details_open:first').is(':hidden')){
	        		table.css('display','');
	        		img_close.hide();
	            	img_open.show();
	           	}
	        	else{
	        		table.css('display','none');
	        		img_close.show();
	            	img_open.hide();
	        	}
	    	});
	// ----------------------------------------------------------- // 
	    	
	    	/* set date picker --------------------*/
			$.datepicker.setDefaults($.datepicker.regional['fr']);
			$( ".input-datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });
			/* -----------------------------------*/
	    	
	    });

function setBoxDetail(){
	var legend_obj = $('.box-details legend');
	
	for(i=0;i<legend_obj.length;i++){
		
		var parent_legend = $(legend_obj[i]).parent();
		
		$(legend_obj[i]).remove();
		
		var zoneDiv = $("<div></div>");
		zoneDiv.append(parent_legend.children());
		
		parent_legend.children().remove();
		
		parent_legend.append($(legend_obj[i]));
		parent_legend.append(zoneDiv);

    	
		parent_legend.find('div:first').css('display','none');
		parent_legend.css({cursor:'pointer'});

		parent_legend.find('legend:first').prepend("<img src='/img/details_open.png' title='Plus details' class='details_open' />")
    	parent_legend.find('legend:first').prepend("<img src='/img/details_close.png' title='Moins details' class='details_close' />")
    	
    	parent_legend.find('.details_open').show();
		parent_legend.find('.details_close').hide();
    	
	}
	
	}

function setResultAjaxTable(result, zone, pagine, lien, keyLien, enteteLien, libelleLien){

	$('#'+zone).html('');
	
	try{
		var table = eval('('+result+')');
	}catch(er){
		alert(result);
	}

	//alert(JSON.stringify(table));
	var tableAffiche=$('<table cellpadding="0" cellspacing="0" border="0" class="display" id="ajaxTable"></table>');
	$('#'+zone).html(tableAffiche);

	var aaData = new Array();
	
	for(key in table){
		var tempData = new Object();
		var i=0;
		for(key2 in table[key]){
			
			if(key2=='id') tempData['DT_RowId'] = table[key]['id'];
			
			else {tempData[i] = table[key][key2];
			      i++;
			}
			//var str = $.html_entity.decode("&gt;&lt;");
			
		}

		if(lien)tempData[i] = '<a href='+lien+'?'+keyLien+'='+table[key][keyLien]+'>'+libelleLien+'</a>';
		aaData.push(tempData);
	}
	
	aaData.pop();
	//aaData.pop();
	
	//alert(JSON.stringify(aaData));
	var aaColumn = new Array();
	firstLine = table[0];
	
	for(key in firstLine){
		if(key!='id')aaColumn.push({ "bSortable": false,"sTitle": key});
		
	}
	if(lien)aaColumn.push({ "bSortable": false,"sTitle": enteteLien});
	if(pagine){
	var oTable = new jqueryTable();
	oTable.create($('#ajaxTable'),aaData,aaColumn);
	}
	else {
	$('#ajaxTable').dataTable({
		 "aaSorting": [],
		 "bJQueryUI":true,
       "sDom":'T<"clear">t',
       "oTableTools":{"sSwfPath": "/swf/copy_cvs_xls_pdf.swf"},
       "aaData": aaData,
       "aoColumns": aaColumn,
       "iDisplayLength": -1
   });
	}

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
					obj[key][keyr] = obj[key][keyr].replace(new RegExp("\"","g"),"\\\"");
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


function htmlentities(texte) {
	texte = $('<div/>').text(texte).html();
	return texte;
}

function html_decode(texte) {
	texte = $("<div/>").html(texte).text();
	return texte;
}

$(document).ready(function(){

	$('input').bind('keyup keypress', function(e) {
		var keyCode = e.keyCode || e.which;
		if (keyCode === 13) { 
			e.preventDefault();
			return false;
		}
	});

	// jQuery("form").validationEngine();
	$(".lock-field-number").keydown(function(event) {
        // Allow: backspace, delete, tab and escape
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || 
             // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) || 
             // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault(); 
            }   
        }
    });
	
	// tab container ------------------------------------------------------	
		
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
		//----------------------------------------------------------------------
	
		// $(".chzn-select").chosen({allow_single_deselect: true});
		//$("button").button();
		//$(".dual-select").chosen();
		$(".accordion").accordion({
			active: false, autoHeight: false,
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

$.fn.getArrayData = function(){
	var $table = $(this),
    $headerCells = $table.find("thead th"),
    $rows = $table.find("tbody tr");

	var headers = [],
	    rows = [];
	
	$headerCells.each(function(k,v) {
	   headers[headers.length] = $(this).text();
	});
	
	$rows.each(function(row,v) {
	  $(this).find("td").each(function(cell,v) {
	    if (typeof rows[cell] === 'undefined') rows[cell] = [];
	    rows[cell][row] = $(this).text();
	  });
	});
	
	return rows;
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

$.fn.valChange = function(value){
	$(this).val(value);
	$(this).trigger('change');
};

(function($){
    $.fn.getStyleObject = function(){
        var dom = this.get(0);
        var style;
        var returns = {};
        if(window.getComputedStyle){
            var camelize = function(a,b){
                return b.toUpperCase();
            };
            style = window.getComputedStyle(dom, null);
            for(var i = 0, l = style.length; i < l; i++){
                var prop = style[i];
                var camel = prop.replace(/\-([a-z])/g, camelize);
                var val = style.getPropertyValue(prop);
                returns[camel] = val;
            };
            return returns;
        };
        if(style = dom.currentStyle){
            for(var prop in style){
                returns[prop] = style[prop];
            };
            return returns;
        };
        return this.css();
    }
})(jQuery);

(function($){

    $.fn.extend({detachOptions: function(o) {
        var s = this;
        return s.each(function(){
            var d = s.data('selectOptions') || [];
            s.find(o).each(function() {
                d.push($(this).detach());
            });
            s.data('selectOptions', d);
        });
    }, attachOptions: function(o) {
        var s = this;
        return s.each(function(){
            var d = s.data('selectOptions') || [];
            for (var i in d) {
                if (d[i].is(o)) {
                    s.append(d[i]);
                    console.log(d[i]);
                    // TODO: remove option from data array
                }
            }
        });
    }});   

})(jQuery);


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


function progressHandling(e,progress){
	if(e.lengthComputable){
		progress.attr({value: e.loaded, max: e.total});
	}
}

$.fn.waiting = function(msg){
	$(this).data('text',!$(this).val() ? $(this).text() : $(this).val());
	$(this).val(msg);
	if(!$(this).has("span")){
		$(this).text(msg);
	}else{
		$(this).find("span").text(msg);
	}
	$(this).attr('disabled',true);
};

$.fn.noWaiting = function(){
	var text = $(this).data('text');
	$(this).val(text);
	if(!$(this).has("span")){
		$(this).text(text);
	}else{
		$(this).find("span").text(text);
	}
	$(this).attr('disabled',false);
};

$.fn.setTotalTable = function(cols,cumul,index_tr){
	var current = $(this);
	if(!index_tr){
		index_tr = 1;
	}
	var scroll = current.parents(".dataTables_scroll");
	if(scroll.get(0)){
		tfoot = scroll.find(".dataTables_scrollFootInner table tfoot");
	}else{
		tfoot = current.find("tfoot");
	}
	var total = 0;
	current.find("thead tr th").each(function(index){
  		if(!cumul) total = 0;
		if($.inArray(index,cols) >= 0){
			current.find("tbody tr").each(function(){
				var val = '';
				if($(this).find("td:eq("+index+")").children("input[type=text]").length != 0)
					val = $(this).find("td:eq("+index+")").children("input[type=text]").first().val();
				else
					val = $(this).find("td:eq("+index+")").text();
				
				var reg = new RegExp(" ","g");
				
				val = val.replace(",",".");
				val = val.replace(reg,"");
				val = val ? parseFloat(val) : 0;
				total += val;
			});
			tfoot.find("tr:eq("+(index_tr-1)+") td:eq("+index+")").text($.formatNumber(total,{locale: 'fr'}));
		}
   	});
};

var tableToExcel = function(tableid) {
						var table= document.getElementById(tableid);
						var html = table.outerHTML;
											
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
						  while (html.indexOf('º') != -1) html = html.replace('º', '&ordm;');
						  while (html.indexOf("’") != -1) html = html.replace("’", "'");
						  while (html.indexOf("°") != -1) html = html.replace("°", "&deg;");
						
						window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
					}

function getChart(msg,width){
	if(!width) width = '490';
	$('#result-stat').html('');
	
	allData = eval('('+msg+')');

	for(key in allData){

		if(key == 'remove') continue;
		
		data = allData[key];
		id_div = "result-stat-"+key;
		
		$('#result-stat').append($("<div style='float:left; margin-right:30px;' id='"+id_div+"'></div>"));
		
		chart = new Highcharts.Chart({
            chart: {
                renderTo: id_div,
                type: data["chart"],
                width: width
            },
            title: {
                text: data['title']
            },
            xAxis: {
                categories: data["catX"]
            },
            yAxis: {
                title: {
                    text: data["yTitle"]
                },
                labels: {
                    formatter: function() {
                        return this.value;
                    }
                }
            },
            tooltip: {
                formatter: function() {
                    return  Highcharts.numberFormat(this.y, 0);
                }
            },
            plotOptions: {
                area: {
                    fillOpacity: 0.5
                },
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ data["catX"][this.point.x] +'</b>: '+ Highcharts.numberFormat(this.percentage,2) +' %';
                        }
                    }
                }
            },
            series: data["resultChart"]
        });

	}
}

function getChartById(id, msg, width){
	if(!width) width = '490';
	$('#'+id).html('');
	
	allData = eval('('+msg+')');

	for(key in allData){

		if(key == 'remove') continue;
		
		data = allData[key];
		id_div = id+"-"+key;
		
		$('#'+id).append($("<div style='float:left; margin-right:30px;' id='"+id_div+"'></div>"));
		
		chart = new Highcharts.Chart({
            chart: {
                renderTo: id_div,
                type: data["chart"],
                width: width
            },
            title: {
                text: data['title']
            },
            xAxis: {
                categories: data["catX"]
            },
            yAxis: {
                title: {
                    text: data["yTitle"]
                },
                labels: {
                    formatter: function() {
                        return this.value;
                    }
                }
            },
            tooltip: {
                formatter: function() {
                    return  Highcharts.numberFormat(this.y, 0);
                }
            },
            plotOptions: {
                area: {
                    fillOpacity: 0.5
                },
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ data["catX"][this.point.x] +'</b>: '+ Highcharts.numberFormat(this.percentage,2) +' %';
                        }
                    }
                }
            },
            series: data["resultChart"]
        });

	}
}