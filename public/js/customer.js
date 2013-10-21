
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
		
		$('#l_name').typeahead({
			name: 'l_name',
			remote: 'customers/typeahead?term=%QUERY',
			template: [                                                                 
				'<p class="">{{jobAddress}}</p>',                              
				'<p class="">{{jobTown}}</p>',                                      
				'<p class="">{{map}}</p>'                         
			].join(''), 
			engine: Hogan
		});
		
		$('#l_name').bind('typeahead:selected', function(obj, datum) {        
			alert(JSON.stringify(obj)); // object
			// outputs, e.g., {"type":"typeahead:selected","timeStamp":1371822938628,"jQuery19105037956037711017":true,"isTrigger":true,"namespace":"","namespace_re":null,"target":{"jQuery19105037956037711017":46},"delegateTarget":{"jQuery19105037956037711017":46},"currentTarget":
			alert(JSON.stringify(datum)); // contains datum value, tokens and custom fields
			// outputs, e.g., {"redirect_url":"http://localhost/test/topic/test_topic","image_url":"http://localhost/test/upload/images/t_FWnYhhqd.jpg","description":"A test description","value":"A test value","tokens":["A","test","value"]}
			// in this case I created custom fields called 'redirect_url', 'image_url', 'description'       
		});
	});	
});
