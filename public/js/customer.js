$(document).ready(function(){
	$("#btnSchedule").click(function(){
		window.location.href = '/customers/schedule/' + document.getElementById("jobID").value;
	});
	
	$("#alert").collapse('show');

	$('#saveNewLead').click(function(){
		$("#alert").collapse('hide')
	});

	$('#scheduleBtn').click(function(){
		$("#alert").collapse('hide')
	});

	$('#scheduleNewLead').click(function(){
		$("#alert").collapse('hide')
	});
		
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
		
		$('#l_name').typeahead({
			name: 'l_name',
			remote: 'customers/typeahead?term=%QUERY',
			template: [
				'<p class="tt-name">{{l_name}}, {{f_name}}',
				'<span class="tt-custID">Cust. ID: {{id}}</span></p>',
				'<p class="tt-address">{{address}}, {{city}}</p>'
			].join(''),
			engine: Hogan
		});
		
		$('#l_name').bind('typeahead:selected', function(obj, datum) {        
			//alert(datum.toSource());
			$.ajax({
				type: "POST",
				url: "/customers/jobDetail",
				data: datum,
				success: function(data) {
					//alert(datum.toSource())
					//alert(data.toSource())
					//alert(Object.keys(data).length)
					document.getElementById("l_name").value = datum.l_name;
					document.getElementById("f_name").value = datum.f_name;
					document.getElementById("phone").value = datum.phone;
					document.getElementById("email").value = datum.email;
					
					var i=0;
					var n=Object.keys(data).length;
						
					while (i<n)
					{
						//alert(data[i].toSource());
						
						var jobs_table = document.getElementById("jobs_table");
						$("tr", jobs_table).remove();
						var tr = document.createElement("tr");
						jobs_table.appendChild(tr);

						var td = document.createElement("td");
						td.className = "prior_jobs";
						tr.appendChild(td);						
						var radio = document.createElement("input");
						radio.type = "radio";
						radio.name = "job_radios";
						radio.id = i;
						radio.val = i;
						td.appendChild(radio);

						var td = document.createElement("td");
						td.className = "prior_jobs";
						tr.appendChild(td);
						var input = document.createElement("input");
						input.type = "text";
						input.value = data[i].id;
						input.id = "jobListID";
						input.className = "input-mini";
						input.disabled = true;
						td.appendChild(input);
						
						var td = document.createElement("td");
						td.className = "prior_jobs";
						tr.appendChild(td);
						var input = document.createElement("input");
						input.type = "text";
						input.value = data[i].address;
						input.className = "address";
						input.disabled = true;
						td.appendChild(input);

						var td = document.createElement("td");
						td.className = "prior_jobs";
						tr.appendChild(td);
						var input = document.createElement("input");
						input.type = "text";
						input.value = data[i].city;
						input.className = "city";
						input.disabled = true;
						td.appendChild(input);

						var td = document.createElement("td");
						td.className = "prior_jobs";
						tr.appendChild(td);
						var input = document.createElement("input");
						input.type = "text";
						input.value = moment(data[i].lead_scheduled).format("MM/DD/YYYY, hh:mm a");
						input.className = "timestamp";
						input.disabled = true;
						td.appendChild(input);

						var td = document.createElement("td");
						td.className = "prior_jobs";
						tr.appendChild(td);
						var input = document.createElement("input");
						input.type = "text";
						input.value = moment(data[i].job_scheduled).format("MM/DD/YYYY, hh:mm a");
						input.className = "timestamp";
						input.disabled = true;
						td.appendChild(input);

						var td = document.createElement("td");
						td.className = "prior_jobs_last";
						tr.appendChild(td);
						var input = document.createElement("input");
						input.type = "text";
						input.value = moment(data[i].job_completed).format("MM/DD/YYYY, hh:mm a");
						input.className = "timestamp";
						input.disabled = true;
						td.appendChild(input);

						i++;
					}
					
					$("#jobList").collapse('show');
					
					document.getElementById("copyButton").onclick=function(){
						var radioID = $('input[name=job_radios]:checked').attr('id')
						var radioVal = $('input[name=job_radios]:checked').val() 
						//alert(radioID)
						
						document.getElementById("job_address").value = data[radioID].address;
						document.getElementById("job_city").value = data[radioID].city;
						document.getElementById("zip").value = data[radioID].zip;
						document.getElementById("built").value = data[radioID].built;
						
						$("#jobList").collapse('hide')
					};
				}
			});
		});
	});	
});
