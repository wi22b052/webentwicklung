$(document).ready(function () {
loadStammdaten()
$('#changeData').on('submit', function(event) {
    event.preventDefault();
    updateUserData();
});
})


function loadStammdaten(){
    $.ajax({
        type: "GET",
        url: "../../backend/serviceHandler.php",
        cache: false,
        data: {method: "getUserData"},
        dataType: "json",
        success: function (response) {
                console.log(response);
                $('#fname').val(response["fname"]);
                $('#lname').val(response["lname"]);
                $('#adresse').val(response["adresse"]);
                $('#plz').val(response["plz"]);
                $('#ort').val(response["ort"]);
                $('#username').val(response["username"]);
                $('#email').val(response["email"]);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
        }
        
    });
}

function updateUserData(){
    anrede = $('#anrede').val();
    fname = $('#fname').val();
    lname = $('#lname').val();
    email = $('#email').val();
    pword = $('#pword').val();
    adresse = $('#adresse').val();
    plz = $('#plz').val();
    ort = $('#ort').val();
    username = $('#username').val();
    formdata = {anrede,fname,lname,email,pword,adresse,plz,ort,username}
    console.log(formdata)
    $.ajax({
        type: "POST",
        url: "../../backend/serviceHandler.php",
        cache: false,
        data: {method: "updateUser", param:formdata},
        dataType: "json",
        success: function (response) {
                console.log(response)
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
        }
        
    })

}