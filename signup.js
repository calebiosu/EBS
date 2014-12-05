// check if username is available
var email = false; 
var username = false;

// remove whitespace
function remove_whitespaces(str){
    var str=str.replace(/^\s+|\s+$/,'');
    return str;
}

$(function()
{
    $('#email').keyup(function()
    {
        var checkname=$(this).val();
        var availname=remove_whitespaces(checkname);
        if(availname!=''){
            $('.email-check').show();
            $('.email-check').fadeIn(400).html('<img src="images/ajax-loader.gif" /> ');

            var string = 'email='+ availname;

            $.ajax({
                type: "POST",
                url: "email-check.php",
                data: string,
                cache: false,
                success: function(result){
                    var result=remove_whitespaces(result);
                    if(result==''){
                        $('.email-check').removeClass("red");
                        $('.email-check').html("Avaliable");
                        $('.email-check').addClass("green");
                        email = true;
                        $("button").attr("disabled", false);
                    }
                    else{
                        $('.email-check').removeClass("green");
                        $('.email-check').html("Already taken, try another.");
                        $('.email-check').addClass("red");
                        email = false;
                        $("button").attr("disabled", true);
                    }
                }
            });
        }else{
            $('.email-check').html('');
            email = false;
            $("button").attr("disabled", true);
        }
    });
});

$(function()
{
    $('#username').keyup(function()
    {
        var checkname=$(this).val();
        var availname=remove_whitespaces(checkname);
        if(availname!=''){
            $('.username-check').show();
            $('.username-check').fadeIn(400).html('<img src="images/ajax-loader.gif" /> ');

            var String = 'username='+ availname;

            $.ajax({
                type: "POST",
                url: "username-check.php",
                data: String,
                cache: false,
                success: function(result){
                    var result=remove_whitespaces(result);
                    if(result==''){
                        $('.username-check').removeClass("red");
                        $('.username-check').html("Avaliable");
                        $('.username-check').addClass("green");
                        username = true;
                        $("button").attr("disabled", false);
                    }
                    else{
                        $('.username-check').removeClass("green");
                        $('.username-check').html("Already taken, try another");
                        $('.username-check').addClass("red");
                        username = false;
                        $("button").attr("disabled", true);
                    }
                }
            });
        }else{
            $('.username-check').html('');
            username = false;
            $("button").attr("disabled", true);
        }
    });
});

// check both passwords match
var pass = false;
$(function() {
	$("#password,#password-confirm").keyup(function() {
		var password = $("#password").val();
		if(password.length > 0 && password == $("#password-confirm").val()){
            $('.pass-check').removeClass("red");
            $('.pass-check').addClass("green");
			$(".pass-check").html("Passwords match");
            pass = true;
            $("button").attr("disabled", false);
		}
		else{
            $('.pass-check').removeClass("green");
			$('.pass-check').addClass("red");
			$(".pass-check").html("Passwords do not match!");
            pass = false;
            $("button").attr("disabled", true);
            if(password.length == 0){$(".pass-check").html("");}
		}
	});
});

// if username is available and password matches, enable submit
$(function() {
    $("#email,#username,#password,#password-confirm").keyup(function() {
        if ( email && username && pass) {
            $("button").attr("disabled", false);
        }
        else {
            $("button").attr("disabled", true);
        }
    });
});

$(function() {
    $("body").click(function() {
        if ( email && username && pass) {
            $("button").attr("disabled", false);
        }
        else {
            $("button").attr("disabled", true);
        }
    });
});

