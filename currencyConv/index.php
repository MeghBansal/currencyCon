<?php
$api_url = 'https://api.exchangeratesapi.io/latest';
$json_data = file_get_contents($api_url);
$response = json_decode($json_data, true);
 
$amount = 1;
$target_amt = 1;
$selected_base = "CAD";
$selected_target  = "CAD";
if(isset($_POST['submit'])){
    $selected_base = $_POST['base'];
    $amount = $_POST['number'];
    $selected_target = $_POST['target'];

    $url_target ='https://api.exchangeratesapi.io/latest?base='.$selected_base.'';
    $new_json_data = file_get_contents($url_target);
    $new_response = json_decode($new_json_data, true);
    //$new_response["rates"] = $new_response;

    foreach($new_response["rates"] as $key => $value){
        if($key == "$selected_target"){
            $target_amt = $value;
        }
    }

}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Currency</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"></link>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h2 class="text-center mt-5 mb-5">Currency Convertor</h2>
        <hr/>
        <div class="card mx-auto" style="width: 40vw; margin-top: 5%;">
            <div class="card-body ">
                <h4 class="card-title text-center pb-2">Choose Base Currency</h4>
                <form method="post">
                    <div class="row mb-5 justify-content-between">
                        <div class="col-md-5">
                            <input type="number" name="number" class="form-control" step="0.01" min="1" value=<?php echo $amount ?>>
                        </div>
                        <div class="col-md-5 ">
                            <select id="base" name="base" class="form-control">

                                <?php foreach($response["rates"] as $key => $value){ ?>
                                    <?php echo "<option value='$key' > $key </option>"?>
                                <?php } ?>

                            </select>
                        </div>
                    </div>
                    <hr />
                    <h4 class="card-title text-center">Choose Target Currency</h4>

                    <div class="row justify-content-between">
                        <div class="col-md-5">
                            <input type="number" class="form-control" min="0" step="0.01" value=<?php echo $target_amt*$amount ?>>
                        </div>
                        <div class="col-md-5 ">
                            <select name="target" class="form-control">

                                <?php foreach($response["rates"] as $key => $value){ ?>
                                    <?php echo "<option value='$key'> $key </option>"?>
                                <?php } ?>

                            </select>
                        </div>
                    </div>
                    <input type="submit" name="submit" class=" mt-5 btn btn-block btn-primary"></input>
                </form>
            </div>
        </div>
    </div>
</body>
