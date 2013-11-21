$(document).ready(function () {
    $('#btnAdd').click(function () {
        var num = $('.clonedSection').length;
        var newNum = new Number(num + 1);
		
		var parentDiv = document.getElementById("parent");
		var div = document.createElement("div");
		div.className = "clonedSection style_group_" + newNum;
		parentDiv.appendChild(div);
	
		var input = document.createElement("input");
		input.type = "text";
		input.id = "window_qty_" + newNum;
		input.placeholder = "Qty: (#)";
		input.name = "qty"+newNum;
		input.className = "input-mini styles ";
		div.appendChild(input);

		var select = document.createElement("select");
		select.id = "material_" + newNum;
		select.name = "material"+newNum;
		select.className = "materialSelect styles";
		div.appendChild(select);

		var option = document.createElement("option");
		option += '<option selected="selected">Material</option>';
		option += '<option>Wood</option>';
		option += '<option>Steel</option>';
		option += '<option>Aluminum</option>';
		option += '<option>Vinyl</option>';
		$(select).append(option);

		var select2 = document.createElement("select");
		select2.id = "style_" + newNum;
		select2.className = "styleSelect styles";
		select2.name = "style"+newNum;
		div.appendChild(select2);

		var option2 = document.createElement("option");
		option2 += '<option selected="selected">Style</option>';
		option2 += '<option>Double Hung</option>';
		option2 += '<option>Casement</option>';
		option2 += '<option>Slider</option>';
		option2 += '<option>Awning</option>';
		option2 += '<option>Hopper</option>';
		option2 += '<option>Transom</option>';
		option2 += '<option>Picture</option>';
		option2 += '<option>Other</option>';
		$(select2).append(option2);
		
		//alert("qty = "+input.name+", material = "+select.name+", & style = "+select2.name);
		
		var close = document.createElement("a");
		close.id = "close"+newNum;
		close.className = "icon-remove";
		close.click(function() {
			$(this).closest('.clonedSection').remove();
		});
		div.appendChild(close);
	});

	$('body').on('click','[id^=close]',function (e) {
		$(this).closest('.clonedSection').remove();
    });

/*	$('#saveNewLead').click(function () {
		var num = $('.clonedSection').length;		
		alert("hello world1");
		for (var i=0; i<num; i++)
		{
			alert(i+1);
			var input = document.getElementById("window_qty_"+i+1).value; 
			$('#newLeadForm').append($(input));
			alert(input);
		}

	}); */

//		$('#saveNewLead').on('click',function (e) {
	//$('form.form-inline').submit(function (e) {
	//$(document).on('submit',function (e) {
		//prevent the default submit handling
		//alert("hello world");
/*		e.preventDefault();
		for (var i=0; i<5; i++)
		{
			x=x + "The number is " + i + "<br>";
		}
		var input = $("test", { type: "hidden", name: "mydata", value: "bla" }); 
		$('#newLeadForm').append($(input));
		alert(input.toSource());
*/
		//send the data of 'this' (the matched form) to yourURL
	/*	$.post('customers/newLead', $(this).serialize(), function(data,status){
			alert("Data: " + data + "\nStatus: " + status);
		});
		$('.form-inline').submit();
	}); */
});

