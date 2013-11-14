$(document).ready(function () {
    $('#btnAdd').click(function () {
        var num = $('.clonedSection').length;
        var newNum = new Number(num + 1);
	//	alert("num = "+num);
	//	alert("newNum = "+newNum);
		
        //var newSection = $('#style_group_' + num).clone().attr('id', 'style_group_' + newNum);
		var parentUl = document.getElementById("style_group_1");
		var div = document.createElement("div");
		div.className = "clonedSection style_group_" + newNum;
		parentUl.appendChild(div);
	//	alert("#3");
	
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

        var deleteRow = $('#btnDel_1').clone();
		deleteRow.id = "btnDel_" + newNum;
		select2.append(deleteRow);
		
/*        newSection.children(':first').children(':first').attr('id', 'window_qty_' + newNum).attr('name', 'window_qty_' + newNum);
        newSection.children(':nth-child(2)').children(':first').attr('id', 'material_' + newNum).attr('name', 'material_' + newNum);
		newSection.children(':nth-child(3)').children(':first').attr('id', 'style_' + newNum).attr('name', 'style_' + newNum);

        newSection.insertAfter('#style_group_' + num).last();
		div.insertAfter('#style_group_' + num).last();
*/
//        $('#btnDel').prop('disabled', '');

        if (newNum == 5) $('#btnAdd').prop('disabled', 'disabled');
	});

    $('btnDel').click(function () {
        var num = $('.clonedSection').length; // how many "duplicatable" input fields we currently have
        $('#style_group_' + num).remove(); // remove the last element

        // enable the "add" button
        $('#btnAdd').prop('disabled', '');

        // if only one element remains, disable the "remove" button
        if (num - 1 == 1) $('#btnDel').prop('disabled', 'disabled');
    });

    $('#btnDel').prop('disabled', 'disabled');

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