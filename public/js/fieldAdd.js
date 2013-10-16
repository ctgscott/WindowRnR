$(document).ready(function () {
    $('#btnAdd').click(function () {
        var num = $('.clonedSection').length;
        var newNum = new Number(num + 1);

        var newSection = $('#style_group_' + num).clone().attr('id', 'style_group_' + newNum);

        newSection.children(':first').children(':first').attr('id', 'year_' + newNum).attr('name', 'year_' + newNum);
        newSection.children(':nth-child(2)').children(':first').attr('id', 'qualification_' + newNum).attr('name', 'qualification_' + newNum);

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
});

$('#changeMe').on('submit', function (e) {
    //prevent the default submithandling
    e.preventDefault();
    //send the data of 'this' (the matched form) to yourURL
    $.post('changeMeToo.php', $(this).serialize());
});