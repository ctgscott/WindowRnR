
$(document).ready(function(){
    $('#typeCheckbox6').click(function(){
		if (this.checked) {
			$('#type_other').removeAttr("disabled");
		}
		else {
			$('#type_other').attr("disabled", true);
		}
    });
});

$(document).ready(function(){
    $('#radio_lead_other').click(function(){
		if (this.checked) {
			$('#text_lead_other').removeAttr("disabled");
		}
		else {
			$('#text_lead_other').attr("disabled", true);
		}
    });
});

$(document).ready(function(){
    $('#radio_lead_main1').click(function(){
		if (this.checked) {
			$('#text_lead_other').attr("disabled", true);
		}
    });
});

$(document).ready(function(){
    $('#radio_lead_main2').click(function(){
		if (this.checked) {
			$('#text_lead_other').attr("disabled", true);
		}
    });
});

$(document).ready(function(){
    $('#radio_lead_main3').click(function(){
		if (this.checked) {
			$('#text_lead_other').attr("disabled", true);
		}
    });
});

$(document).ready(function(){
    $('#radio_lead_main4').click(function(){
		if (this.checked) {
			$('#text_lead_other').attr("disabled", true);
		}
    });
});

$(document).ready(function(){
    $('#schedButton').click(function(){
		$("#tab_1").removeClass('active')
		$("#tab_2").addClass('active')		
	});
});

