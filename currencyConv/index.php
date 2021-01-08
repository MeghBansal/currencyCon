<?php
$api_url = 'https://api.exchangeratesapi.io/latest';
$json_data = file_get_contents($api_url);
$response = json_decode($json_data, true);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Currency</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"></link>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            document.getElementById("baseAmount").defaultValue = "1";
            document.getElementById("targetAmount").defaultValue = "1";

        $("#base").change(function(){
            var selectedBase = $('#base').val(); 
            var targetBase = $("#target").val();
            var baseAmount = $("#baseAmount").val();

            url =`https://api.exchangeratesapi.io/latest?base=${selectedBase}`;
            $.getJSON(url,(item)=>{
                $(function() {
                    $("#targetAmount").val(item.rates[targetBase]*baseAmount);
                });
            });
        })
        $("#target").change(function(){
            var selectedBase = $('#base').val(); 
            var targetBase = $("#target").val();
            var targetAmount = $("#targetAmount").val();
            //var baseAmount = $("#baseAmount").val();
            
            url =`https://api.exchangeratesapi.io/latest?base=${targetBase}`;
            $.getJSON(url,(item)=>{
                $(function() {
                    $("#baseAmount").val(item.rates[selectedBase]*targetAmount);
                });
            });
        })
        $("#baseAmount").on("input",function(){
            var selectedBase = $('#base').val(); 
            var targetBase = $("#target").val();
            //var targetAmount = $("#targetAmount").val();
            var baseAmount = $("#baseAmount").val();
            
            url =`https://api.exchangeratesapi.io/latest?base=${selectedBase}`;
            $.getJSON(url,(item)=>{
                $(function() {
                    $("#targetAmount").val(item.rates[targetBase]*baseAmount);
                });
            });
        })
        $("#targetAmount").on("input",function(){
            var selectedBase = $('#base').val(); 
            var targetBase = $("#target").val();
            var targetAmount = $("#targetAmount").val();
            //var baseAmount = $("#baseAmount").val();
            
            url =`https://api.exchangeratesapi.io/latest?base=${targetBase}`;
            $.getJSON(url,(item)=>{
                $(function() {
                    $("#baseAmount").val(item.rates[selectedBase]*targetAmount);
                });
            });
        })
    });
      </script>
</head>
<body>
    <div class="container">
        <h2 class="text-center mt-5 mb-5">Currency Convertor</h2>
        <hr/>
        <div class="card mx-auto col-xs-12 col-sm-6 col-sm-offset-3" style=" margin-top: 5%;">
            <div class="card-body ">
                <h4 class="card-title text-center pb-2">Choose Base Currency</h4>
                <form method="post">
                    <div class="row mb-2 justify-content-between">
                        <div class="col-md-5">
                            <input type="number" placeholder="1" id="baseAmount" class="form-control" min="1" value=''>
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
                    <h4 class=" pt-2 pb-2 card-title text-center">Choose Target Currency</h4>

                    <div class="row justify-content-between">
                        <div class="col-md-5">
                            <input type="number" id="targetAmount" class="form-control" placeholder="1" min="1" value=''>
                        </div>
                        <div class="col-md-5 ">
                            <select id="target" name="target" class="form-control">

                                <?php foreach($response["rates"] as $key => $value){ ?>
                                    <?php echo "<option value='$key'> $key </option>"?>
                                <?php } ?>

                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
