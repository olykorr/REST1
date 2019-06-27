<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <div id="restData">

    </div>

    <button id="getData">getData</button>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        (function($){
            $('#getData').click(function(){
                $.ajax({
                    type: "POST",
                    dataType: "text",
                    url: "http://localhost/~user16/REST/server/api/cars/",
					data: {
                    },
                    success: function(res){
                        $('#restData').text(res);
                    }
                });
            });
        }(jQuery));
    </script>
</body>
</html>
