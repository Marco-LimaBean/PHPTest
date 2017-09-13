$(document).ready(function () {

    // $dvd = $('[name=dvd]');
    $('[name=newName]').val('123');

    // JSON.parse('dvdList');


    xmlhttp = new XMLHttpRequest();
    dvdList = "not overwritten";

    //class for dvd:

    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            dvdList = JSON.parse(this.responseText);
            // $('[name=test]').val(myObj.data(1));
            // dvdList = myObj;
            $('[name=test]').val(dvdList[0]['name']);
        }
    };
    xmlhttp.open("POST", "dvdEditJson.php");
    xmlhttp.send();


    // language=JQuery-CSS
    $('[name=dvd]').change(function () {
        selectedDvd = $('[name=dvd]').find(":selected").val();
        for (var i = 0; i < Object.keys(dvdList).length; i++) {
            if (dvdList[i]['id'] === parseInt(selectedDvd)) selectedDvd = dvdList[i];
        }
        $('[name=newName]').val(selectedDvd['name']);
        $('[name=date]').val(selectedDvd['release_date']);
        $('[name=category]').val(selectedDvd['category_id']);
        $('[name=description]').val(selectedDvd['description']);
    });

    // function send(){
    var submitButton = $('[name=reset]');
    var form = $('#editDvd');

    form.submit(function (event) {
        submitButton.attr("disabled", "disabled");
        // alert('Send button clicked!');
        window.setTimeout(function () {
            submitButton.removeAttr("disabled"); // enable button
        }, 2000 /* 2 sec */);
        event.preventDefault();

        //get user DVD data
        if($('[name=dvd]').html !== '---'){
            selectedDvd['name'] = $('[name=newName]').val();
            selectedDvd['release_date'] = $('[name=date]').val();
            selectedDvd['category_id'] = $('[name=category]').val();
            selectedDvd['description'] = $('[name=description]').val();
        }

        $.ajax({
            url: 'dvdEditSave.php',
            type: 'post',
            data: {dvd: JSON.stringify(selectedDvd)},
            success: function (data) {
                $('#message').html(data);
            }
        });
    });


    //
    // $.ajax({
    //     type: "POST",
    //     url: 'dvdEdit',
    //     data: data,
    //     success: success,
    //     dataType: dataType
    // });

    alert('JQuery Executed');
});
