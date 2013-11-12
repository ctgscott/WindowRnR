$(document).ready(function () {
    $('#btnAdd').click(function () {
        var num = $('.clonedSection').length;
        var newNum = new Number(num + 1);
		alert("num = "+num);
		alert("newNum = "+newNum);
		
        var newSection = $('#style_group_' + num).clone().attr('id', 'style_group_' + newNum);

        newSection.children(':first').children(':first').attr('id', 'window_qty_' + newNum).attr('name', 'window_qty_' + newNum);
        newSection.children(':nth-child(2)').children(':first').attr('id', 'material_' + newNum).attr('name', 'material_' + newNum);
		newSection.children(':nth-child(3)').children(':first').attr('id', 'style_' + newNum).attr('name', 'style_' + newNum);

        newSection.insertAfter('#style_group_' + num).last();

        $('#btnDel').prop('disabled', '');

        if (newNum == 5) $('#btnAdd').prop('disabled', 'disabled');
	});

    $('#btnDel').click(function () {
        var num = $('.clonedSection').length; // how many "duplicatable" input fields we currently have
        $('#pq_entry_' + num).remove(); // remove the last element

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