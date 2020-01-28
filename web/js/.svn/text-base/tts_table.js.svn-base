function TTS_Table(obj){
	
	
	/* variables --------------------------------------------- */
	var table,head,body,body_tr,head_tr,tr_td,tr_th,scroll_area,scroll_container,tts_head,last_tr_th,last_head_tr;
	var title;
	var options;
	var _extension;
	var _selectable,_selectable_multi;
	var _addForm,_mask;
	var validate;
	var _trigger;
	/* ------------------------------------------------------- */
	
	/* construction ------------------------------------------ */
	this.table = obj;
	this.options = new Object();
	this._extension = new Object();
	this._selectable = false;
	this._selectable_multi = false;
	this._addForm = 'tts_add_form';
	this.title = new Array();
	this._trigger = new Object();
	/* ------------------------------------------------------- */
	
	/* Definition Extension ---------------------------------- */
	this._extension = {
		'_scroll': function(obj,options){
			var h = $(obj.tr_th[0]).height();
			var h_table = obj.table.height();
			
			var height = parseFloat(options['Y']);
			var outer_width = parseFloat(options['X']);
			
			obj.tr_th.each(function(){
				$(this).width($(this).width());
				$(this).height($(this).height());
				$(this).attr("rowspan",1);
				$(this).attr("colspan",1);
			});
			
			var copy_head = obj.head.clone();
			
			var width = obj.table.width();
			
			var outer_width = outer_width ? outer_width : width;
			
			obj.scroll_area.css({overflow: 'auto',
								height: height,
								width: (parseFloat(outer_width)+22)+'px',
								'margin-top':'-4px',
								'padding': '0px'
								});
			
			obj.head_tr.css('height','0px');
			obj.tr_th.css({
							'height':'0px',
							'padding-top': '0px',
							'padding-bottom': '0px',
							'border-top-width': '0px',
							'border-bottom-width': '0px'
						  });
			
			obj.table.css({'margin-top': '-3px'});
			
			obj.tr_th.html('');
			
			var table = $("<table class='tts_head' style='width:"+width+"px;'></table>");
			
			table.append(copy_head);
			
			table.insertBefore(obj.scroll_area);
			
			obj.scroll_container.css({
				'overflow': 'hidden',
				'width': outer_width+22
			});
			
			obj.tts_head = table;
			
			obj.scroll_area.scroll(function(){
				var left = 5 - obj.scroll_area.scrollLeft();
				table.css('margin-left',left);
				//obj.head.scrollLeft(obj.scroll_area.scrollLeft());
			});
		},
		'_fixedColumn': function(obj,col){
			
			for(i=0;i<col.length;i++){
				obj.body_tr.each(function(){
					var icol = $(this).find("td:eq("+col[i]+")");
					icol.width(icol.width());
					icol.addClass('locked_left');
					var position = icol.position();
					//alert(position.left);
				});
				
				head = obj.tts_head.find("thead tr th:eq("+col[i]+")");
				
				head.addClass('locked_left');
				
			}
			
			obj.scroll_area.scroll(function(){
				var left = obj.scroll_area.scrollLeft();
				obj.body.find('td.locked_left').css('left',left);
				obj.tts_head.find('th.locked_left').css('left',left);
			});
		},
		'_sheet': function(obj,options){
			
			var input_updated = []; // les input qui vont être transformt au type hidden, cad qui probable modifié
			var input_changed = []; // les input qui ne sont pas modifiable à la main, mais il peut être modifié par un script
			
			// chaine utilisé pour déclarer des évenements globals sur tous les inputs => $(chaine).event..
			var chaine_updated = "";
			var chaine_changed = "";
			//-----------------------------------------------------------------
			
			if(typeof(options["updated"]) == 'undefined'){
				if(options["class"])
					var all_type_text_not_readonly = $("input.sheet-updated");
				else
					var all_type_text_not_readonly = obj.table.find("tbody tr:first").find("input[type=text]:not([readonly='readonly'])");
				
				all_type_text_not_readonly.each(function(){
		    		input_updated.push($(this).attr("name"));
		        });
				
			}else input_updated = options["updated"];
			
			
			if(typeof(options["changed"]) == 'undefined'){
				
				if(options["class"])
					var all_type_text_readonly = $("input.sheet-changed");
				else
					var all_type_text_readonly = obj.table.find("tbody tr:first").find("input[type=text][readonly='readonly']");
				
				all_type_text_readonly.each(function(){
					input_changed.push($(this).attr("name"));
		        });
				
			}else input_changed = options["changed"];
			
			//construire la chaine des inputs "updated"
			var tempArray = [];
			for(key=0;key<input_updated.length;key++){
				var reg1 = new RegExp("\\[","g");
				var reg2 = new RegExp("\\]","g");
				var ch = input_updated[key].replace(reg1,"\\[");
				ch = ch.replace(reg2,"\\]");
				tempArray.push("input[name="+ch+"]");
			}
			chaine_updated = tempArray.join(",");
			//--------------------------------------------
			
			//construire la chaine des inputs "changed"
			var tempArray = [];
			for(key=0;key<input_changed.length;key++){
				var ch = input_changed[key].replace("[","\\[").replace("]","\\]");
				tempArray.push("input[name="+ch+"]");
			}
			chaine_changed = tempArray.join(",");
			//---------------------------------------------
			
			//Tous les inputs doit être transformer au type hidden 
			//et modifier le TD conteneur avec le contenu de l'input
			$(chaine_updated).each(function(){
				this.type = "hidden";
				$(this).parents("td:first").append(document.createTextNode(this.value));
			});
			
			$(chaine_changed).each(function(){
				this.type = "hidden";
				$(this).parents("td:first").append(document.createTextNode(this.value));
			});
			//---------------------------------------------------------
			
			//une fois on fait une double click sur les TDs contenants les inputs "updated", 
			//les inputs transformeront en type text
			$(chaine_updated).parents("td").dblclick(function(){
				var td = $(this);

				$(this).find("input[type=hidden]").each(function(){
					var name_hidden = $(this).attr("name");

					if($.inArray(name_hidden, input_updated) >= 0){
						this.type = "text";
						$(this).focus();
						td.contents().filter(function() {
							  return this.nodeType == 3;
							}).remove();
					}
				});
			});
			//---------------------------------------------------------
			
			//traiter le Bouton Entrer et les flèches et TAB ---------------------
			$(chaine_updated).keydown(function(event) {
				  if (event.which == 13) {
					  $(this).blur();
					  return false;
				  }else if (event.which == 40) {
					  
					  var tr = $(this).parents("tr:first");
					  var td = $(this).parents("td:first");
					  
					  if(tr.next('tr').length > 0){
						  $(this).blur();
				          var nextTableRow = tr.next('tr');
				          var colId = tr.children().index(td);
				          var next_td = nextTableRow.find("td:eq("+colId+")");
				          next_td.dblclick();
					  }
					  
					 return false;
				  }else if (event.which == 38) {
					  
					  var tr = $(this).parents("tr:first");
					  var td = $(this).parents("td:first");
					  
					  if(tr.prev('tr').length > 0){
						  $(this).blur();
				          var nextTableRow = tr.prev('tr');
				          var colId = tr.children().index(td);
				          var next_td = nextTableRow.find("td:eq("+colId+")");
				          next_td.dblclick();
					  }
					  
					 return false;
				  }else if (event.which == 9) {
					  var actuel_input = $(this);
					  var td = $(this).parents("td:first");
					  var td_next = td.nextAll('td').length ? td.nextAll('td') : td.prevAll('td:last').nextAll('td');
					  var exist = false;
					  if(td_next.length > 0){
						  td_next.each(function(){
							  var td = $(this);
							  td.find("input[type=hidden]").each(function(){
									var name_hidden = $(this).attr("name");
									if($.inArray(name_hidden, input_updated) >= 0){
										actuel_input.blur();
										td.dblclick();
										exist = true;
										return false;
									}
							  });
							  if(exist) return false;
						  });
					  }
					  if(exist) return false;
				  }
			});
			
			$(chaine_updated).blur(function(){
				$(this).change();
			});
			//----------------------------------------------------------
			
			//une fois quitter le changement de la valeur d'un input "updated", on réintialise le contenu du td
			$(chaine_updated).blur(function(){
				this.type = 'hidden';
				$(this).parents("td:first").contents().filter(function() {
					  return this.nodeType == 3;
				}).remove();
				$(this).parents("td:first").append(document.createTextNode(this.value));
			});
			//---------------------------------------------------------
			
			//une fois changer le valeur des inputs "changed", réninitialiser le contenu du TD contenant l'input
			$(chaine_changed).change(function(){
				
				var td = $(this).parents("td:first");
				
				td.contents().filter(function() {
					  return this.nodeType == 3;
				}).remove();
				
				td.append(document.createTextNode(this.value));
				
			});
			
			//Permer au propriete "value" d'executer l'evenement "Change" une fois appelé pour les inputs "changed"
			$(chaine_changed).watchProperty('value', function() {
			    $(this).change();
			});
			//---------------------------------------------------------
			
			
		},
		'_resizeColumn': function(obj,options){
			var pressed = false;
			var col = undefined;
			var mouseX, coltWidth;
			var colIndex = null;
			
			var column = obj.scroll_container.find("table.tts_head th");
			var table = obj.scroll_area.find("table.tts_table");
			var column_table = obj.scroll_area.find("table.tts_table th");
			
			column.each(function(index){
				$(this).resizable({ 
									alsoResize: table.find("thead th:eq("+index+")"),
									resize: function(event, ui) {
										ui.size.height = ui.originalSize.height;
										/*if($(this).width() < table.find("thead th:eq("+index+")").width()){
											$(this).width(table.find("thead th:eq("+index+")").width());
										}*/
								    },
								    stop: function(event, ui){
								    	/*column.each(function(index){
								    		$(this).width(table.find("thead th:eq("+index+")").width());
								    	});*/
								    }
								});
			});
			
		},
		'_cacheColumn': function(obj,options){
			var table = obj.table;
			var affiche = $('<div style="padding:9px;margin:6px;background-color:#ccc;position:absolute;z-index:9999;border:1px solid #777; max-height:200px; overflow:auto"><b><span class="hide_show_col" style="cursor:pointer">Gestion d\'affichage :</span> </b></div>');
			var titles = $('<ul class="report-css-zone" style="margin-top:9px;"></ul>');
			
			for(i=0;i<obj.title.length;i++){
				titles.append('<li><input type="checkbox" id="cache_column_'+i+'"> <label for="cache_column_'+i+'"><b>'+obj.title[i]+'</b></label></li>');
			}
			
			titles.hide();
			
			affiche.append(titles);
			
			var spacer = $('<div style="margin-bottom:40px;"></div>');
			spacer.append(affiche);
			
			obj.scroll_container.prepend(spacer);
			
			$("[id^=cache_column_]").change(function(){
				var id = this.id.replace('cache_column_','');
				if($(this).is(":checked")){
					obj.tts_head.find("tr th:eq("+id+")").css('display','none');
					obj.body_tr.find("td:eq("+id+")").css('display','none');
					obj.head_tr.find("th:eq("+id+")").css('display','none');
				}else{
					obj.tts_head.find("tr th:eq("+id+")").css('display','');
					obj.body_tr.find("td:eq("+id+")").css('display','');
					obj.head_tr.find("th:eq("+id+")").css('display','');
				}
			});
			
			$('.hide_show_col').click(function(){
				var ul = $(this).parents("div:first").find("ul");
				ul.is(':hidden') ? ul.show('fast') : ul.hide('fast');
			});
			
		}
	};
	/* ------------------------------------------------------- */
	
	this.definition = function(){
		
		var tag = this.table.get(0).tagName;
		
		if(tag == 'DIV'){
		
			this.body = this.table.find('div.body');
			this.body_tr = this.table.find('div.body div.tr');
			this.tr_td = this.table.find('div.body div.tr div');
			this.head = this.table.find('div.head');
			this.head_tr = this.table.find('div.head div.tr');
			this.tr_th = this.table.find('div.head div.tr div');
		
		}else if(tag == 'TABLE'){
			
			var current = this;
			
			this.body = this.table.find('tbody');
			this.body_tr = this.table.find('tbody tr');
			this.tr_td = this.table.find('tbody tr td');
			this.head = this.table.find('thead');
			this.head_tr = this.table.find('thead tr');
			this.tr_th = this.table.find('thead tr th');
			this.scroll_area = this.table.parents('.scroll_area:first');
			this.scroll_container = this.table.parents('.scroll_container:first');
			this.scroll_head = this.scroll_container.find(".scroll_head:first");
			this.tr_th.each(function(){
				current.title.push($(this).text());
			});
			/*if(!this.body_tr.length){
				var n_th = this.tr_th.length;
				var chaine_td = "<td colspan="+n_th+">Aucun Enregistrement existe!</td>";
				this.body.append("<tr>"+chaine_td+"</tr>");
			}*/
			
		}
		
		if(!this.scroll_container.find('.info_tts_table').length){
		
			var info = $("<div style='padding:9px' class='info_tts_table'></div>");
			info.html("Affichage de "+this.body_tr.length+" &eacute;l&eacute;ments");
			this.scroll_container.append(info);
		
		}else{
			this.scroll_container.find('.info_tts_table').html("Affichage de "+this.body_tr.length+" &eacute;l&eacute;ments");
		}
		
	};
	
	this.init = function(){
		
		this.definition();
		
		this.loadExtension();
	};
	
	this.isSelectable = function(multi){
		var obj = this;
		if(!multi) this._selectable = true;
		else this._selectable_multi = true;
		this.body_tr.click(function(){
			if(!multi){
				obj.table.find("tbody tr.tts-table-selected").each(function(){
					$(this).removeClass("tts-table-selected");
				});
			}
			if($(this).hasClass("tts-table-selected")){
				$(this).removeClass("tts-table-selected");
			}else{
				$(this).addClass("tts-table-selected");
			}
		});
	};
	
	this.addLine = function(objLine){
		this.body.append("<tr><td>"+objLine.join("</td><td>")+"</td></tr>");
		if(!this.body_tr.length){
			var tts_head = $('.tts_head thead');
			var th = tts_head.find("th");
			this.tr_th.each(function(index){
				$(th[index]).width($(this).width());
			});
		}
		this.definition();
		if(this._selectable) this.isSelectable();
		else if(this._selectable_multi) this.isSelectable(true); 
	}
	
	this.getSelected = function(){
		return this.table.find("tbody tr.tts-table-selected");
	};
	
	this.deleteSelected = function(){
		this.table.find("tbody tr.tts-table-selected").remove();
	};
	
	this.sdelectAll = function(){
		 current=this;
		 if(!this.getSelected().length){
			 this.table.find("tbody tr").addClass('tts-table-selected');
		 }else{
			 $(current.oTable.fnSettings().aoData).each(function (){
				 this.table.find("tbody tr").removeClass('tts-table-selected');
			 });
		 }
	 }
	
	this.loadExtension = function(){
		for(key in this.options){
			var func = this._extension["_"+key];
			func(this,this.options[key]);
		}
	}
	
	this.reloadExtension = function(ext){
		if(typeof(this.options[ext]) == 'undefined') return;
		var func = this._extension["_"+ext];
		func(this,this.options[ext]);
	}
	
	this.addOption = function(options){
		for(key in options){
			 this.options[key] = options[key];
		}
	}
	
	this.setAction = function(options){
		var action = options["action"];
		switch(action){
			case "add":
				var mask = options["mask"];
				this._mask = mask;
				if(typeof(options["addForm"]) != "undefined") this._addForm = options["addForm"];
				this.setTemplate("add");
				this.executeActionAdd();
			break;
		}
	};
	
	this.setTemplate = function(action){
		switch(action){
			case "add":
				var btn_add = $("<button style='margin:9px;' type='button' id='btn_add"+this.table.attr("id")+"'>Ajouter</button>");
				this.table.parents('.scroll_container:first').prepend(btn_add);
				btn_add.button();
			break;
		}
	};
	
	this.executeActionAdd = function(){
		
		var current = this;
		
		$('#'+current._addForm).dialog({
			autoOpen: false,
			width: 600,
			buttons: [
			          {
			              text: "Valider",
			              click: function() { $('#'+current._addForm+' form').submit(); }
			          },
			          {
			              text: "Annuler",
			              click: function() { $(this).dialog("close"); }
			          }
			      ]
		});
		
		$('#btn_add'+this.table.attr("id")).click(function(){
			$('#'+current._addForm).dialog('open');
			return false;
		});
		
		$('#'+this._addForm+' form').submit(function(){
			if(current.validate){
				var form = $(this);
				var options = form.data('jqv');
			 	if(options.InvalidFields.length != 0) return false;
			}
			
			var line = JSON.stringify(current._mask);
			
			$(this).find("input,select,textarea").each(function(){
				var reg2 = new RegExp("\#\:"+$(this).attr("id")+"\#","g");
				line = line.replace(reg2,$(this).val());
			});
			
			current.addLine(eval('('+line+')'));
			
			current.startTrigger("add","after");
			
			$('#'+current._addForm).dialog("close");
			
			return false;
		});
		
	};
	
	this.setTrigger = function(action,time,func){
		this._trigger[action] = new Object();
		this._trigger[action][time] = func;
	};
	
	this.startTrigger = function(action,time){
		if(typeof(this._trigger[action]) != 'undefined' && typeof(this._trigger[action][time]) != 'undefined'){
			var func = this._trigger[action][time];
			func();
		}
	}
	
	this.isValidate = function(){
		this.validate = true;
	}
}