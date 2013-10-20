
$(document).ready(function(){
    $('#typeCheckbox6').click(function(){
		if (this.checked) {
			$('#type_other').removeAttr("disabled");
		}
		else {
			$('#type_other').attr("disabled", true);
		}
    });

    $('#sourceCheckbox5').click(function(){
		if (this.checked) {
			$('#source_referral').removeAttr("disabled");
		}
		else {
			$('#source_referral').attr("disabled", true);
		}
    });

    $('#sourceCheckbox6').click(function(){
		if (this.checked) {
			$('#source_other').removeAttr("disabled");
		}
		else {
			$('#source_other').attr("disabled", true);
		}
    });

    $('#radio_lead_other').click(function(){
		if (this.checked) {
			$('#text_lead_other').removeAttr("disabled");
		}
		else {
			$('#text_lead_other').attr("disabled", true);
		}
    });
	
    $('#radio_lead_other').click(function(){
		if (this.checked) {
			$('#text_lead_other').removeAttr("disabled");
		}
		else {
			$('#text_lead_other').attr("disabled", true);
		}
    });

    $('#radio_lead_main1').click(function(){
		if (this.checked) {
			$('#text_lead_other').attr("disabled", true);
		}
    });

    $('#radio_lead_main2').click(function(){
		if (this.checked) {
			$('#text_lead_other').attr("disabled", true);
		}
    });

    $('#radio_lead_main3').click(function(){
		if (this.checked) {
			$('#text_lead_other').attr("disabled", true);
		}
    });

    $('#radio_lead_main4').click(function(){
		if (this.checked) {
			$('#text_lead_other').attr("disabled", true);
		}
    });

    $('#schedButton').click(function(){
		$("#tab_1").removeClass('active')
		$("#tab_2").addClass('active')		
	});

	$(function() {
		$("#tags").autocomplete({
			source: "customers/autocomplete",
			minLength: 2,
			select: function( event, ui ) {
					
			},
			
			html: true, // optional (jquery.ui.autocomplete.html.js required)
	 
		  // optional (if other layers overlap autocomplete list)
			open: function(event, ui) {
				$(".ui-autocomplete").css("z-index", 1000);
			}
		});
		
		$('.typeahead').typeahead({
			source: function (query, process) {
				return $.get('/customers/autocomplete', { query: query }, function (data) {
					return process(data.options);
				});
			}
		});
	});	
});
