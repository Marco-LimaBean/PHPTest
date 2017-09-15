$(document).ready(function () {

    //get the Query String parameters: (http://www.jquerybyexample.net/2012/06/get-url-parameters-using-jquery.html)
    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = decodeURIComponent(window.location.search.substring(1)),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : sParameterName[1];
            }
        }
    };

    dvdList = "not overwritten";

    //update form fields
    function updateFormFields() {
        //alert('updateFormFields called');
        selectedDvd = $('[name=dvd]').find(":selected").val();
        for (var i = 0; i < Object.keys(dvdList).length; i++) {
            if (dvdList[i]['id'] === parseInt(selectedDvd)) selectedDvd = dvdList[i];
        }
        $('[name=newName]').val(selectedDvd['name']);
        $('[name=date]').val(selectedDvd['release_date']);
        $('[name=category]').val(selectedDvd['category_id']);
        $('[name=description]').val(selectedDvd['description']);
    };

    //class for dvd:

    $.get('dvdEditJson.php', {}, function (response) {
        //the list of dvd from the server:
        dvdList = response;

        var id = getUrlParameter("id");
        // alert('get called. ID: ' + id);

        if (!isNaN(id)) {
            // alert('is a number')
            updateFormFields();
        }


        $('[name="dvd"]').change(
            //ask this one.
            function () {
                updateFormFields()
            }
        );
    });

    //if get id (the dvd id) has been set.


    //submit the form to the server on submit.

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
});
