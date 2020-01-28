//jquery table
function jqueryTable( obj ){
	
	/* les actions ----------------- */
	var action_add;
	var action_delete;
	var action_update;
	var action_duplicate;
	var action_delete_all;
	/* ------------------------------*/
	
	/* Msg -------------------------*/
	var __msg;
	/* --------------------------------*/
	/* Result -------------------------*/
	var __result;
	/* --------------------------------*/
	
	/* Triggers -------------------------*/
	var __trigger;
	/* --------------------------------*/
	
	/* discription des colonnes ---- */
	var description_column;
	/* ------------------------------*/
	
	/* Tableau --------------------- */
	var Table;
	/* ------------------------------*/
	
	/* options --------------------- */
	var options;
	/* ------------------------------*/
	
	/* params --------------------- */
	var multipleSelect;
	var validate;
	var beforeAjax;
	/* ------------------------------*/
	
	/* data and columns not pre-defined --------------------- */
	var aaData;
	var aoColumns;
	/* ------------------------------*/
	
	/* objet dataTable ------------- */
	var oTable;
	/* ------------------------------*/
	
	/* init variable -----------------*/
	this.options = {};
	this.multipleSelect = false;
	this.validate = false;
	this.beforeAjax = false;
	/* ------------------------------*/
	
	 this.create = function( obj , aaData , aoColumns){
		this.action_add = new Array();
		this.action_delete = new Array();
		this.action_update = new Array();
		this.action_duplicate = new Array();
		this.action_delete_all = new Array();
		this.column = new Array();
		this.__trigger = new Array();
		this.__trigger['add'] =  function(){ return true; };
		this.__trigger['delete'] =  function(){ return true; };
		this.__trigger['duplicate'] =  function(){ return true; };
		
		this.__triggerAfter = new Array();
		this.__triggerAfter['add'] =  function(){ return true; };
		this.__triggerAfter['delete'] =  function(){ return true; };
		this.__triggerAfter['duplicate'] =  function(){ return true; };
		
		this.description_column = new Array();
		this.__result = new Array();
		this.Table = obj;
		this.createColumn();
		
		this.aaData = aaData;
		this.aoColumns = aoColumns;

		if(typeof(this.options['bJQueryUI']) == 'undefined') this.options['bJQueryUI'] = true;
		if(typeof(this.options['sPaginationType']) == 'undefined') this.options['sPaginationType'] = "full_numbers";
		if(typeof(this.options['bDestroy']) == 'undefined') this.options['bDestroy'] = true;
		if(typeof(this.options['sDom']) == 'undefined') this.options['sDom'] = 'T<"clear">lfrtip';
		if(typeof(this.options['oTableTools']) == 'undefined') this.options['oTableTools'] = {"sSwfPath": "/swf/copy_cvs_xls_pdf.swf"};
				
		if(this.aaData){
			this.options["aaData"] = this.aaData;
		}
		
		if(this.aoColumns){
			this.options["aoColumns"] = this.aoColumns;
		}
		
		for(key in this.options){
			if(this.options[key] == '') delete this.options[key];
		}
		
		//alert(JSON.stringify(this.options));
		
		this.oTable = obj.dataTable(this.options);
	}
	 
	 this.addOption = function(option){
		 for(key in option){
			 this.options[key] = option[key];
		 }
	 }
	 
	 this.getTable = function(){
		 return this.Table;
	 }
	 
	 this.executeBeforeRequest = function(){
		 this.beforeAjax = true;
	 }
	 
	 this.getDataTable = function(){
		 return this.oTable;
	 }
	 
	 this.isValidate = function(){
		 this.validate = true;
	 }
	
	this.makeEditable = function(){
		this.oTable.makeEditable({
            sUpdateURL: this.action_update['url'],
            sReadOnlyCellClass: "read_only",
            "aoColumns": this.description_column
			});
	}
	
	this.setDefaultOption = function(){
		this.addOption({iDisplayLength: -1,sDom: 't'});  
	}
	
	this.getResult = function(){
		return this.__result;
	}
	
	this.getMsg = function(){
		return this.__msg;
	}
	
	this.defineTrigger = function(action,func){
		this.__trigger[action] = func;
	}
	
	this.defineTriggerAfter = function(action,func){
		this.__triggerAfter[action] = func;
	}
	
	this.startTrigger = function(action){
		return this.__trigger[action]();
	}
	
	this.startTriggerAfter = function(action){
		return this.__triggerAfter[action]();
	}
	
	 this.constructEditable = function(){
		this.makeEditable();
		this.isSelectable();
	}
	 
	 this.isEditable  = function(){
		 this.constructEditable();
		 this.setTemplate();
	 }
	 
	 this.isMultipleSelected  = function(){
		 this.multipleSelect=true;
	 }
	
	 this.createColumn = function(){
		 var obj = this.Table;
		 try{
			 var cols = obj.find('tr')[0].cells.length;
			 for(i=1;i<=cols;i++){
				 this.setColumn(i);
			 }
		 }catch(e){};
	 }
	 
	 this.makeDown = function(){
		var tr = this.fnGetSelected();
        tr.reverse();
        
        $(tr).each(function(index,value){
	         var tableRow = $(value);
	         if(tableRow.next('tr').length > 0){
	           var nextTableRow = tableRow.next('tr');
	           tableRow.insertAfter(nextTableRow);
	      	 }
        });
	 }
	 
	 this.makeUp = function(){
		var tr = this.fnGetSelected();
			
        $(tr).each(function(index,value){
            var tableRow = $(value);
        	if(tableRow.prev('tr').length > 0){
                var previousTableRow = tableRow.prev('tr');
                tableRow.insertBefore(previousTableRow);
             }
        });
	 }
	 
	 this.setColumn = function(num,description){
		num--;
		var temp = new Array();
		if(description){			
			temp = description;
			if(description["type"]){
				temp["type"] = description["type"];
			}else{
				temp["type"] = "text";
			}
			if(description["indicator"]){
				temp["indicator"] = description["indicator"];
			}else{
				temp["indicator"] = "Enregistrement...";
			}
			if(description["tooltip"]){
				temp["tooltip"] = description["tooltip"];
			}else{
				temp["tooltip"] = "cliquer pour editer";
			}
			if(description["onblur"]){
				temp["onblur"] = description["onblur"];
			}else{
				temp["onblur"] = "submit";
			}
			
			this.description_column[num] = temp;
			
			
		}else{
			this.description_column[num] = null;
		}
		
	}
	
	 this.setActionAdd = function( options ){
		this.action_add["id_form"] = options["id_form"] ? options["id_form"] : "addForm";
		this.action_add["method"] = options["method"] ? options["method"] : "get";
		this.action_add["url"] = options["url"] ? options["url"] : "";
		this.action_add["id_line"] = options["id_line"] ? options["id_line"] : "id";
	}
	
	 this.setActionDuplicate = function( options ){
		this.action_duplicate["url"] = options["url"] ? options["url"] : "";
		this.action_duplicate["id_line"] = options["id_line"] ? options["id_line"] : "id";
	}
	
	 this.setActionDelete = function( options ){
		this.action_delete["url"] = options["url"] ? options["url"] : "";
	}
	
	 this.setActionUpdate = function( options ){
		this.action_update["url"] = options["url"] ? options["url"] : "";
	}
	 
	 this.setActionDeleteAll = function( options ){
			this.action_delete_all["url"] = options["url"] ? options["url"] : "";
		}
	
	 this.setTemplate = function(){
		
		//Button add --------------------------------------------------------------------------
		var btnAdd = $("<input type='button' style='margin-right:6px' class='btn btn-default' id='btnAdd"+this.Table.attr('id')+"' value='Ajouter' >");
		//Button delete -----------------------------------------------------------------------
		var btnDelete = $("<input type='button' style='margin-right:6px' class='btn btn-default' id='btnDelete"+this.Table.attr('id')+"' value='Supprimer' >");
		//form Duplicate ----------------------------------------------------------------------
		var formDuplicate = $("<form id='formDuplicate"+this.Table.attr('id')+"' action='javascript:;'></form>");
		//number of duplicateion --------------------------------------------------------------
		var inputDuplicate = $("<input type='text' name='numberDuplicate"+this.Table.attr('id')+"' id='numberDuplicate"+this.Table.attr('id')+"' size='4'>");
		//Button duplication ------------------------------------------------------------------
		var btnDuplicate = $("<input type='submit' style='margin-right:6px' class='btn btn-default' id='btnDuplicate"+this.Table.attr('id')+"' value='Dupliquer' >");
		//Button delete all -----------------------------------------------------------------------
		var btnDeleteAll = $("<input type='button' style='margin-right:6px' class='btn btn-default' id='btnDeleteAll"+this.Table.attr('id')+"' value='Supprimer Tout' >");
		
		/*progress of duplication -------------------------------------------------------------*/
		var progressDuplicate = $("<span id='progressDuplicate"+this.Table.attr('id')+"'></span>");
		progressDuplicate.css('margin-left','6px');
		/*-------------------------------------------------------------------------------------*/
		
		/*validation of form Duplication ----------------------------------*/
		formDuplicate.validate({
			rules: {
				numberDuplicate: {
					min: 1
				}
			},messages: {
				numberDuplicate: {
					min: "nombre non valide"
				}
			}
		});
		/*-----------------------------------------------------------------*/
		
		/*add element to form --------------*/
		if(this.action_add['url']) formDuplicate.append(btnAdd);
		if(this.action_delete['url']) formDuplicate.append(btnDelete);
		if(this.action_delete_all['url']) formDuplicate.append(btnDeleteAll);
		if(this.action_duplicate['url']){
			formDuplicate.append(btnDuplicate);
			formDuplicate.append(inputDuplicate);
			formDuplicate.append(progressDuplicate);
		}
		
		/*----------------------------------*/
		
		//create layout ---------------
		var layout = $("<div></div>");
		
		//add form to layout ----------
		layout.append(formDuplicate);
		
		//make layout flaot in left----
		layout.css("float","left");
		
		/*add all elements in the start of Table ---*/
		var parent = this.Table.parents("div.dataTables_wrapper:first");
		$(parent).prepend(layout);
		/*------------------------------------------*/
		
	}
	 
	 this.isSelectable = function(){
		 current=this;
		 this.Table.children('tbody').unbind('click');
		this.Table.children('tbody').click(function(event) {
			
			if(!current.multipleSelect){
				$(current.oTable.fnSettings().aoData).each(function (){
					$(this.nTr).removeClass('row_selected');
				});
				$(event.target.parentNode).addClass('row_selected');
			}
				
			else {
				if ( $(event.target.parentNode).hasClass('row_selected') )
					$(event.target.parentNode).removeClass('row_selected');  
				else $(event.target.parentNode).addClass('row_selected');
			}
		}); 
	 }
	 
	 this.sdelectAll = function(){
		 current=this;
		 if(!this.fnGetSelected().length){
			 $(current.oTable.fnSettings().aoData).each(function (){
					$(this.nTr).addClass('row_selected');
			 });
		 }else{
			 $(current.oTable.fnSettings().aoData).each(function (){
					$(this.nTr).removeClass('row_selected');
			 });
		 }
	 }
	 
	 this.fnGetSelected = function() {
		   var aReturn = new Array();
		   var aTrs = this.oTable.find("tbody tr");
		    
		   for ( var i=0 ; i<aTrs.length ; i++ )
		   {
		       if ( $(aTrs[i]).hasClass('row_selected') )
		       {
		           aReturn.push( aTrs[i] );
		       }
		   }
		   return aReturn;
		}
	 
	 this.fnGetSelectedAll = function() {
		   var aReturn = new Array();
		   var aTrs = this.oTable.fnGetNodes();
		   for ( var i=0 ; i<aTrs.length ; i++ ) {aReturn.push( aTrs[i] );}
		   return aReturn;
		}
	 
	 this.addLine = function(data,id_,func){
		 var nl = this.oTable.fnAddData(data);
		 this.constructEditable();
		 if(id_){ 
			 for(k in nl){
				 if(k == "remove") continue;
				 var n = current.oTable.fnSettings().aoData[ nl[k] ].nTr;
				 if(id_.length) n.setAttribute('id',id_[k]);
				 if(func) func(n);
			 }
		 }
		 return nl;
	 }
	 
	 this.removeLine = function(msg_after,force){
		 
		 
		 var anSelected = this.fnGetSelected();
			if(anSelected.length){
				if(anSelected.length==1){
					if(!force){
						var msg="Voulez-vous vraiment supprimer cet element?";
						if(!confirm(msg)) return false;
					}
					 this.oTable.fnDeleteRow( anSelected[0] );
					 
				}
				else{
					if(!force){
						var msg="Voulez-vous vraiment supprimer ces "+anSelected.length+" elements?";
						if(!confirm(msg)) return false;
					}
					  for ( var i=0 ; i<anSelected.length ; i++ ){
						  this.oTable.fnDeleteRow( anSelected[i] );
					  }
				}
				if(msg_after) alert(msg_after);
				return true;
			}else alert('Vous devez choisir au moins un element!');
			return false;
			
				
	 }
	 
	 this.removeAllLines = function(){
		 var anSelected = this.fnGetSelectedAll();
		 var msg="Voulez-vous vraiment supprimer ces "+anSelected.length+" elements?";
		 if(!confirm(msg)) return false;
		 for ( var i=0 ; i<anSelected.length ; i++ ){
			  this.oTable.fnDeleteRow( anSelected[i] );
		 }
		 return true;	 
	 }
	 
	 this.createActionAdd = function(){
		 
		 var current = this;
		 
		 $('#'+current.action_add["id_form"]).dialog({
				autoOpen: false,
				width: 600
		 });

		 $('#'+current.action_add["id_form"]+' form').unbind("submit");
			$('#'+current.action_add["id_form"]+' form').submit(function(){

				 
				if(current.validate){
					var form = $(this);
					var options = form.data('jqv');
				 	if(options.InvalidFields.length != 0) return false;
				}
				if(current.beforeAjax){
					if(!current.startTrigger('add')) return false;
				}
				var param = $(this).serializeObject();
				var displayResult = new Array();
				var btnSubmit = $(this).find('input:submit');
				btnSubmit.attr('disabled','disabled');
				btnSubmit.attr('value','En cours...');
				//enctype = $(this).attr('enctype');
				$.ajax({
					url: current.action_add["url"],
					type: current.action_add["method"],
					data: param,
					//contentType: enctype,
					success: function(msg ) {
						  unloadPage();
						  btnSubmit.attr('disabled',false);
						  btnSubmit.attr('value','Ajouter');
						  //current.__msg=msg;
						  try{
							  var result = eval('('+msg+')');
						  }catch(e){ alert(msg); }
						  current.__result=result;
						  if(!current.startTrigger('add')) return;
						  for(i=0;i<current.description_column.length;i++){
							  displayResult.push(result[i]);
						  }
						  var nl = current.oTable.fnAddData(displayResult);
						  var n = current.oTable.fnSettings().aoData[ nl[0] ].nTr;
               		     n.setAttribute('id', result[current.action_add["id_line"]]);
               		  
               		  $('#'+current.action_add["id_form"]).dialog("close");
               		  current.constructEditable();
               		 if(!current.startTriggerAfter('add')) return;
					},
					error: function(msg){
						alert(msg.responseText);
					}
				})
				return false;
			});

			$('#btnAdd'+current.Table.attr('id')).click(function(){
				$('#'+current.action_add["id_form"]).dialog('open');
				return false;
			});
	 }
	 
	 this.createActionDelete = function(){
		 var current = this;
		 $('#btnDelete'+current.Table.attr('id')).unbind('click');
		 $('#btnDelete'+current.Table.attr('id')).click( function() {
			 	var anSelected = current.fnGetSelected();
				if(anSelected.length){
					if(anSelected.length==1){
						var msg="Voulez-vous vraiment supprimer cet element?";
						var elem = anSelected[0].id;
					}
					else{
						var msg="Voulez-vous vraiment supprimer ces "+anSelected.length+" elements?";
						var elem=new Array();
						for ( var i=0 ; i<anSelected.length ; i++ ){
							  elem.push(anSelected[i].id);
						}
							
					}
					//alert(elem);return false;
						
				 	if(confirm(msg)){
				 		$('#btnDelete'+current.Table.attr('id')).attr('disabled','disabled');
				 		$('#btnDelete'+current.Table.attr('id')).attr('value','En cours...');
						
						var aData = current.oTable.fnGetData( anSelected[0] );
						
						$.ajax({
							url: current.action_delete["url"],
							type: 'get',
							data: {id: elem,data: aData[7]},
							success: function( msg ) {
								//alert(msg);return;
								  $('#btnDelete'+current.Table.attr('id')).attr('disabled',false);
								  $('#btnDelete'+current.Table.attr('id')).attr('value','Supprimer');
								  if(anSelected.length==1) var result = msg;
								  else var result =eval('('+msg+')');
								  current.__result=result;
								  if(!current.startTrigger('delete')) return;
								  if(result.toString() == elem.toString())
									  for ( var i=0 ; i<anSelected.length ; i++ ){
										  current.oTable.fnDeleteRow( anSelected[i] );
									  }
								  else alert(result);
								   if(!current.startTriggerAfter('delete')) return;
								  
							}
						})
				 	}else return false;
				}else alert('vous devez choisir un element');
			} );
		 
	 }
	 
	 this.createActionDeleteAll = function(){
		 var current = this;
		 
		 $('#btnDeleteAll'+current.Table.attr('id')).click( function() {
			        var anSelected = current.fnGetSelectedAll();
			        if(confirm("Voulez-vous vraiment supprimer tous les elements?")){
				 	if(confirm("Attention,tous les elements de la table seront supprimes")){
				 		$('#btnDeleteAll'+current.Table.attr('id')).attr('disabled','disabled');
				 		$('#btnDeleteAll'+current.Table.attr('id')).attr('value','En cours...');
						
						$.ajax({
							url: current.action_delete_all["url"],
							type: 'get',
							data: {},
							success: function( msg ) {
								  $('#btnDeleteAll'+current.Table.attr('id')).attr('disabled',false);
								  $('#btnDeleteAll'+current.Table.attr('id')).attr('value','Supprimer Tout');
								  var result = msg;
								  if(result == "OK") {
									  for ( var i=0 ; i<anSelected.length ; i++ ){
									  current.oTable.fnDeleteRow( anSelected[i] );
									  }
								  }
							}
						})
				 	}else return false;
			        }else return false;
				
			} );
		 
	 }
	 
	
	 
	 this.doDuplicate = function(nDup){
			var anSelected = this.fnGetSelected();
			var aData = this.oTable.fnGetData( anSelected[0] );
			var elem = anSelected[0].id;
			var displayResult = new Array();
			var current = this;
			$('#progressDuplicate'+current.Table.attr('id')).html(nDup+' restant...');
			//alert(nDup);return;
			$.ajax({
				url: current.action_duplicate["url"],
				type: 'get',
				data: {id: elem, data:aData[7]},
				success: function( msg ) {
					      var result =msg;
					     // alert(result);return;
					      current.__result=result;
					      if(!current.startTrigger('duplicate')){
					    	  $('#progressDuplicate'+current.Table.attr('id')).html('');
					    	  return;
					      }
						  
						  var result = eval('('+msg+')');
						  for(i=0;i<current.description_column.length;i++){
							  displayResult.push(result[i]);
						  }
						  var nl = current.oTable.fnAddData(displayResult);
						  var n = current.oTable.fnSettings().aoData[ nl[0] ].nTr;
	        		      n.setAttribute('id', result[current.action_duplicate["id_line"]]);
	        		      nDup--;
	        		      if(nDup) current.doDuplicate(nDup);
	        		      else {
	        		    	  $('#progressDuplicate'+current.Table.attr('id')).html('');
	        		    	  current.constructEditable();
	        		      }
	        		      
	        		      if(!current.startTriggerAfter('duplicate')) return;
				
				}
			})
	 }
	 
	 this.createActionDuplicate = function(){
		 var current = this;
		 $('#formDuplicate'+current.Table.attr('id')).submit( function() {
			 var nDup = $('#numberDuplicate'+current.Table.attr('id')).val() ? $('#numberDuplicate'+current.Table.attr('id')).val() : 1;
			 current.doDuplicate(nDup);
			} );
	 }
	 
	 this.generate = function(){
		 if(this.action_add['url']) this.createActionAdd();
		 if(this.action_delete['url']) this.createActionDelete();
		 if(this.action_duplicate['url']) this.createActionDuplicate();
		 if(this.action_delete_all['url']) this.createActionDeleteAll();
		 $("input[type=button]").button();
		 $("input[type=button]").css('margin','6px');
		 $("button").button();
	 }
	 
	
	 this.sheet = function(options){

		 	var obj = this;
			
			var input_updated = []; // les input qui vont être transformt au type hidden, cad qui probable modifié
			var input_changed = []; // les input qui ne sont pas modifiable à la main, mais il peut être modifié par un script
			
			var is_update = options["update"] === false ? false : true;
			
			var load_all = options["load_all"] === true ? true : false;
			
			// chaine utilisé pour déclarer des évenements globals sur tous les inputs => $(chaine).event..
			var chaine_updated = "";
			var chaine_changed = "";
			//-----------------------------------------------------------------
			if(typeof(options["updated"]) == 'undefined'){
				if(options["class"])
					var all_type_text_not_readonly = $("input.sheet-updated");
				else{
					if(!load_all)
						var all_type_text_not_readonly = obj.Table.find("tbody tr:first").find("input[type=text]:not([readonly='readonly'])");
					else
						var all_type_text_not_readonly = obj.Table.find("tbody tr").find("input[type=text]:not([readonly='readonly'])");
				}
				
				all_type_text_not_readonly.each(function(){
					if($(this).get(0).tagName == "INPUT" && $(this).attr("name")) {
						input_updated.push($(this).attr("name"));
					}
		        });
				
			}else input_updated = options["updated"];
			
			if(typeof(options["changed"]) == 'undefined'){
				
				if(options["class"])
					var all_type_text_readonly = $("input.sheet-changed");
				else
					var all_type_text_readonly = obj.Table.find("tbody tr:first").find("input[type=text][readonly='readonly']");
				
				all_type_text_readonly.each(function(){
					if($(this).get(0).tagName == "INPUT" && $(this).attr("name")) {
						input_changed.push($(this).attr("name"));
					}
		        });
				
			}else input_changed = options["changed"];

			//construire la chaine des inputs "updated"
			var tempArray = [];
			for(key=0;key<input_updated.length;key++){
				if(!input_updated[key]) continue;
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
				if(!input_changed[key]) continue;
				var reg1 = new RegExp("\\[","g");
				var reg2 = new RegExp("\\]","g");
				var ch = input_changed[key].replace(reg1,"\\[");
				ch = ch.replace(reg2,"\\]");
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
			if(is_update){
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
			}
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
			$(chaine_updated).watchProperty('value', function() {
			    $(this).change();
			});
			//---------------------------------------------------------
		
	 }
	
}