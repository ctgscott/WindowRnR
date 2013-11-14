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
		input.className = "input-mini styles ";
		div.appendChild(input);

		var select = document.createElement("select");
		select.id = "material_" + newNum;
		select.className = "materialSelect styles";
		div.appendChild(select);

		var option = document.createElement("option");
		option += '<option selected="selected">Material</option>';
		option += '<option>Wood</option>';
		option += '<option>Steel</option>';
		option += '<option>Aluminum</option>';
		option += '<option>Vinyl</option>';
		$("#material_" + newNum).append(option);

		var select2 = document.createElement("select");
		select2.id = "style_" + newNum;
		select2.className = "styleSelect styles";
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
		$("#style_" + newNum).append(option2);
		
		var close = document.createElement("a");
		close.id = "close"+newNum;
		close.className = "icon-remove";
		close.click(function() {
			$(this).closest('.clonedSection').remove();
		});
		div.appendChild(close);

        var $deleteRow = $('#btnDel1').clone();
		$deleteRow[0].id = "btnDel" + newNum;
		$deleteRow.appendTo(div);

        if (newNum == 5) $('#btnAdd').prop('disabled', 'disabled');
	});

    //$("[id^=btnDel]").click(function () {
	$("#close2").click(function(e) {
	//$("[id^=btnDel]").live('click', function (e) {
	
		alert("close clicked!");
		var idClicked = e.target.id;
		alert("id clicked = "+idClicked);
        var num = $('.clonedSection').length; // how many "duplicatable" input fields we currently have
		alert("num = "+num);
        //$('.style_group_' + num).remove(); // remove the last element
		$(this).closest('.clonedSection').remove();
		
        // enable the "add" button
        $('#btnAdd').prop('disabled', '');

        // if only one element remains, disable the "remove" button
/*        if (num - 1 == 1) $("[id^=btnDel]").prop('disabled', 'disabled');
*/    });

    //$('#btnDel').prop('disabled', 'disabled');

	$('#saveNewLead').click(function () {
		var num = $('.clonedSection').length;		
		alert("hello world1");
		for (var i=0; i<num; i++)
		{
			alert(i+1);
			var input = document.getElementById("window_qty_"+i+1).value; 
			$('#newLeadForm').append($(input));
			alert(input);
		}

	});
});

//$('#newLeadForm').on('submit',function (e) {
//$('form.form-inline').submit(function (e) {
/*$(document).on('submit',function (e) {
	//prevent the default submit handling
	e.preventDefault();
	alert("hello world3");
	for (var i=0; i<5; i++)
	{
		x=x + "The number is " + i + "<br>";
	}
	var input = $("test", { type: "hidden", name: "mydata", value: "bla" }); 
	$('#newLeadForm').append($(input));
	alert(input.toSource());

	//send the data of 'this' (the matched form) to yourURL
	//$.post('customers/newLead', $(this).serialize());
	//$('.form-inline').submit();
});
*/