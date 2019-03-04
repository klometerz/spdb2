<!-- doctype is mandatory -->
<!DOCTYPE html>
<!-- language en -->
<html lang="en">
    <head>
        <!-- title also is mandatory -->
        <title>tilte of your project</title>
        <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <form method="POST" action="?act=proc">
            <fieldset>
                <legend>Form</legend>
                <label for="username">Username: </label>
                <input type="text" name="username" id="username"> 
                <button id="fetchFields">check</button>
                <label for="posts">Level: </label>
                <input type="text" size="20" name="posts" id="posts">
                <label for="joindate">Last Login: </label>
                <input type="text" size="20" name="joindate" id="joindate">
				 <label for="joindate">Auth Code: </label>
                <input type="text" size="20" name="authcode" id="auth_code">
                <p><input type="submit" value="Submit" name="submitBtn"></p>
            </fieldset>
        </form>
        <!-- put all your javascript before the end of the body -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
        <script>
            $(document).ready(function() {
                function myrequest(e) {
                    // use $('#username') to select by id instead of $('.username') used to select by class
                    var name = $('#username').val();
                    $.ajax({
                        method: "GET",
                        url: "http://localhost/spdb/debug/autofill.php", /* online, change this to your real url */
                        data: {
                            username: name
                        },
                        dataType: 'json', /* this is not mandatory */
                        success: function( responseObject ) {
                            console.log('success');
							
                            $('#posts').val(responseObject.level);
                            $('#joindate').val(responseObject.last_login);
							 $('#auth_code').val(responseObject.auth_code);

                        },
                        failure: function() {
                            alert('fail');
                        }
                    });
                }

                $('#fetchFields').click(function(e) {
                    e.preventDefault();
                    myrequest();
                });
            });
        </script>
    </body>
</html>