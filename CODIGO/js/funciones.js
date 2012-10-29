$(document).ajaxStart(function() {
    //$("#loading").show();
    $.mobile.showPageLoadingMsg();
});

$(document).ajaxComplete(function() {
    //$("#loading").hide();
   $.mobile.hidePageLoadingMsg();
});


$.fn.serializeObject = function() {
	var o = {};
	var a = this.serializeArray();
	$.each(a, function() {
		if (o[this.name]) {
			if (!o[this.name].push) {
				o[this.name] = [o[this.name]];
			}
			o[this.name].push(this.value || '');
		} else {
			o[this.name] = this.value || '';
		}
	});
	return o;
};


    $("#frm_login").submit(function(){
        var var_login=$(this).serializeObject();
        $.ajax({
            type: 'GET',
            contentType: 'application/json',
            data: JSON.stringify(var_login),
            //dataType: 'json',
            url: "http://<Domain>/api/2012/<API_Key>/access/login",
            success: function(datar){
                $("#result").html(datar);
            }
        });
        return false; //Esto anula el evento Submit()
    });






/*
$("#Submit_login").click(function () {
  var baseURL = "http://<Domain>/api/2012/";

  	$.getJSON(baseURL, function(data) {

		resultado = data;
                if(resultado.status=="OK")
                  {
                   $('#result').html("Login correcto, " + resultado.msg);
                }else{
                    $('#result').html("Login incorrecto, " + resultado.msg);
                $('#result').fadeIn('slow');
            }
        });

});


function comprobar_datos(F){

    var error = getDataServer("contact.php","?UserEmail="+F.UserEmail.value+"&UserFirstName="+F.UserFirstName.value+"&UserApplicationUrl="+F.UserApplicationUrl.value);

    if(error != "OK")
        $("#result").html(error).fadeIn("200");
    else{
        $("#contact").html("<span class='box2'>You will receive a email for download Diamonds route of sun. Thank you for your interesting, Enjoy.</span>").fadeIn("200");
    ;
    }
}
*/