function dataDepend(sel_F,sel_E){
	
	var __sel_F, //la liste deroulante Source
		__sel_E, //la liste deroulante Desinataire
		__source, //les relations source
		__destin, //les relation destin
		__rel, //les relation intermidiaire
		__depend, //regroupement de tous les relations
		__data, //les donnees recupere
		__result, //resultat ajax (string)
		__dataResult, //resultat ajax (array)
		__empty, //afficher ou non le choix vide
		__selected,//definir le choix par default
		__reload,//recharger la liste destin ou non
		__xhr,//instance ajax
		__trigger,//trigger execute apres le retour Ajax
		__where,//definir plus de condition
		__convertDate,//converti la date automatiquement
		__regex,//les expressions reguliers
		__is_disabled_current,//desactiver la liste source
		__is_disabled_depend,//desactiver la liste destin
		__is_get_all,//recuperer tous les donnee si le choix vide est selectionner (oui/non)
		__add_query,//ajouter plus de requete
		__use_query,//utiliser un requete pour faire la dependance
		__url_query,//utiliser un url pour faire la dependance
		__use_param,//utiliser d'autre parametres pour la dependance
		__is_event,//activer la recursivite des evenements change si le choix destin est non vide (oui/non)
		__is_event_empty; //activer la recursivite des evenements change si le choix destin est vide (oui/non)
	
	if(typeof this.__url == 'undefined'){
		this.__url = "";
	}
	
	this.__sel_F = sel_F;
	this.__sel_E = sel_E;
	this.__rel = new Array();
	this.__selected = new Array();
	this.__empty = '';
	this.__reload = true;
	this.__trigger = function(){};
	this.__where = new Array();
	this.__source = new Array();
	this.__convertDate = true;
	this.__is_disabled_current = false;
	this.__is_disabled_depend = false;
	this.__is_get_all = false;
	this.__use_query = '';
	this.__use_param = '';
	this.__is_event = true;
	this.__is_event_empty = false;
	this.__regex = [{
		'datetime': "^(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4} ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$",
		'date': "^(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}$"
	}];
	
	$("#"+this.__sel_F).data("disabled",$("#"+this.__sel_F).is(":disabled"));
	$("#"+this.__sel_E).data("disabled",$("#"+this.__sel_E).is(":disabled"));
	
	this.setSource = function(src,src_depend){
		var srcArray = new Array();
		srcArray.push(src);
		srcArray = srcArray.concat(src_depend);
		this.__source = srcArray;
	};
	
	this.andWhere = function(where){
		this.__where.push(where);
	}
	
	this.isGetAll = function(join){
		this.__is_get_all = !join ? true : join;
	}
	
	this.setTrigger = function(func){
		this.__trigger = func;
	}
	
	this.setDestin = function(dst,dst_depend){
		var dstArray = new Array();
		dstArray.push(dst);
		dstArray = dstArray.concat(dst_depend);
		this.__destin = dstArray;
	};
	
	this.setData = function(data){
		this.__data = data;
	};
	
	this.setReload = function(reload){
		this.__reload = reload;
	};
	
	this.setSelected = function(selected){
		this.__selected = selected;
	};
	
	this.setEmpty = function(empty){
		this.__empty = empty;
	};
	
	this.interruptEvent = function(){
		this.__is_event = false;
	}
	
	this.enableEventEmpty = function(){
		this.__is_event_empty = true;
	}
	
	this.setRelation = function(tab,tab_depend){
		var tabArray = new Array();
		tabArray.push(tab);
		tabArray = tabArray.concat(tab_depend);
		this.__rel.push(tabArray);
	};
	
	this.setCurrentDisabled = function(){
		$('#'+this.__sel_F).attr("disabled","disabled");
		this.__is_disabled_current = "disabled";
	}
	
	this.setDependDisabled = function(){
		$('#'+this.__sel_E).attr("disabled","disabled");
		this.__is_disabled_depend = "disabled";
	}
	
	this.getValue = function(){
		return $('#'+this.__sel_F).val();
	}
	
	this.useQuery = function(useQuery){
		this.__use_query = useQuery;
	}
	
	this.useUrl = function(url){
		this.__use_url = url;
	}
	
	this.useParam = function(param){
		this.__use_param = param;
	}
	
	this.setDependanceChoice = function(){
		var url = dataDepend.__url;
		var current = this;
		
		$('#'+this.__sel_F).change(function(){
			var currentObj = $(this);
			var dependObj = $('#'+current.__sel_E);
			var value_F = currentObj.val() != null ? currentObj.val() : "";
			//if(!value_F) return;
			current.addLoading();
			//if(!value_F) return false;
			if(typeof(value_F) != 'number') value_F = "'"+value_F+"'";

			if(!current.__use_query && current.__source) {
				current.__source[3] = value_F;
			}
			else{
				var reg = new RegExp("\#\:((?!\#).)+\#","g");
				use_query = current.__use_query.replace(reg, function(match){
					match = match.replace("#:","");
					match = match.replace("#","");
					match = $("#"+match).val();
					match = match != null ? match : "";
					return match;
				});
			}
			//current.setup();
						
			currentObj.attr('disabled','disabled');
			dependObj.attr('disabled','disabled');
			if(current.__xhr) current.__xhr.abort();
			
			if(!current.__use_query){
				var paramAjax = {d: current.__depend, where: current.__where, all: current.__is_get_all, add_query: current.__add_query};
			}else{
				var param = "";
				var useParam = current.__use_param;
				if(value_F) {
					param = useParam.replace('?',current.getValue() != null ? current.getValue() : "");
				}
				//alert(current.__use_query+' '+param);return;
				var paramAjax = {q: use_query+' '+param};
				url = current.__use_url;
			}
			
			current.__xhr = $.ajax({
				url: url,
				type: 'post',
				data: paramAjax,
				success: function( msg ) {
					//alert(msg);
					currentObj.attr('disabled',currentObj.data("disabled"));
					dependObj.attr('disabled',dependObj.data("disabled"));
					current.__result = msg;
					current.__dataResult = eval('('+msg+')');
					if($('#'+current.__sel_E).get(0).tagName == 'SELECT')
						current.constructChoice();
					else if($('#'+current.__sel_E).get(0).tagName == 'INPUT')
						current.constructInput();
					else alert("L'element target doit etre un SELECT ou INPUT");
					//chosen select **********************************
					$('#'+current.__sel_E).trigger("liszt:updated");
					//************************************************
					current.__trigger();
					current.__xhr.abort();
					current.removeLoading();
					if(($('#'+current.__sel_E).val() && current.__is_event) || current.__is_event_empty) $('#'+current.__sel_E).change();
				},
				error: function( msg ) {
					currentObj.attr('disabled',currentObj.data("disabled"));
					dependObj.attr('disabled',dependObj.data("disabled"));
					//alert(msg.responseText);
					current.__xhr.abort();
				}
			});
		});
		
	}
	
	this.constructChoice = function(){
		var data = eval('('+this.__result+')');
		var select = $('#'+this.__sel_E);
		if(this.__reload){
			select.find('option').remove();
			if(this.__empty !== false) select.append('<option value="">'+this.__empty+'</option>');
			for(key in data){
				if(key == 'remove' || key == 'indexOf') continue;
				if((this.__selected['value'] && data[key][this.__data['value']] == this.__selected['value']) || 
				   (this.__selected['libel'] && data[key][this.__data['libel']] == this.__selected['libel']))
					is_selected = "selected";
				else is_selected = "";
				select.append("<option value='"+data[key][this.__data['value']]+"' "+is_selected+">"+data[key][this.__data['libel']]+"</option>");
			}
		}else{
			if(data.length){
				var elem = data[0];
				select.val(elem[this.__data['value']]);
			}
		}
	}
	
	this.addLoading = function(){
		//$('#'+this.__sel_F).after("<span class='depend-loading'>En cours...</span>");
		$('#'+this.__sel_E).next(".depend-loading-img").remove();
		$('#'+this.__sel_E).after("<img class='depend-loading-img' src='/images/loading.gif'>");
	}
	
	this.removeLoading = function(){
		$('#'+this.__sel_F).next('.depend-loading').remove();
		$('#'+this.__sel_E).next('.depend-loading-img').remove();
	}
	
	this.constructInput = function(){
		var data = eval('('+this.__result+')');
		var input = $('#'+this.__sel_E);
		var type = input.get(0).type;
		var value = data[0] ? data[0][this.__data['value']] : '';
		if(type == "text" || type == "hidden") {
			input.val(value);
		}else if(type == "checkbox"){
			if(value != 0) input.attr("checked","checked");
			else input.attr("checked",false);
		}
	}
	
	this.setup = function(){
		this.__depend = new Array();
		if(this.__source !== 'undefined') this.__depend.push(this.__source);
		if(this.__rel.length) this.__depend = this.__depend.concat(this.__rel);
		this.__depend.push(this.__destin);
		if(this.__source.length == 0) this.__depend.push(this.__data);
		this.setDependanceChoice();
	};
	
	this.addQuery = function(add_query){
		this.__add_query = add_query;
	};
	
}

dataDepend.setUrl = function(url){
	dataDepend.__url = url;
};