<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
	<link rel="stylesheet" href="500.css">
</head>

<body>
<div class="error-500" data-text="Oh no! Our spaghetti code is not working properly. We will be back soon!">
	<spaguetti>
		<fork></fork>
		<meat></meat>
		<pasta></pasta>
		<plate></plate>
		<a href="index.php">Go Back</a>
	</spaguetti>
</div>

<script>
    const error = document.querySelector(".error-500");
    let i = 0, data = "", text = error.getAttribute("data-text");

    let typing = setInterval(() => {
        if(i == text.length){
            clearInterval(typing);
        }else{
            data += text[i];
            document.querySelector(".error-500").setAttribute("data-text", data);
            i++;
        }
    }, 100);
</script>
</body>



</html>