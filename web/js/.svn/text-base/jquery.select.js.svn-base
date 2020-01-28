(function($){
	// définition du plugin jQuery
   $.fn.moveOptions = function(params) {
		//définir les paramétres par défaut
		var defaults = 	{src : "source", dst : "destin", selected: true};

        // Fusionner les paramètres par défaut et ceux de l'utilisateur
        var params = $.extend(defaults, params);

        // Traverser tous les nœuds.
        return this.each(function() {
        	$(this).click(function(){
				$("#"+params.src+" option:selected").each(function(){
					var option = $(this).detach();
					option.appendTo($("#"+params.dst));
					if(!params.selected){
						option.prop("selected", "");					
					} 
				});	
			});
        });
   };
   
   	$.GmoveOptions = function(destination, source, params, selectBool){
		var move = new selectMultiple(destination, source, params);
		//true: selectionner dans la source
		move.moveOptions(selectBool); 
	};
})(jQuery);

function selectMultiple(destination, source, params){
	// definir les variables cible et destination
	var __source,
	    __destination,
		__params,
		__defaults;

	// initialiser les variables passés en paramétres
	if(typeof(params) == "undefined")
		params = {};
		
	this.__source = source;
	this.__destination = destination;
	this.__defaults = {bttnPush: "push_" + this.__destination, bttnSubtract: "subtract_" + this.__destination};
	this.__params = $.extend(this.__defaults, params);
	
	// utiliser le plugin moveOptions pour définir toute une structure de move des options d'un select à un autre
	this.moveOptions = function(selectBool){
		if(typeof(selectBool) == "undefined")
			selectBool = false;
		$("#" + this.__params.bttnPush).moveOptions({src: this.__source, dst: this.__destination});
		$("#" + this.__params.bttnSubtract).moveOptions({src: this.__destination, dst: this.__source, selected: selectBool});
	};
}
