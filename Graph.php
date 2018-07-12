<?php
require_once 'core/init.php';
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="css/boostrap.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato|Open+Sans" rel="stylesheet" />
    <title>MAIN PAGE</title>
</head>
<body>
    <section class="main">
        <div class="container-fluid">
            <div class="col-sm-8 offset-sm-2">
                <div id="title"><t><h1>Graphs</h1></t></div>
                <?php
                // Create instance of graph
                $Graph_Instance = new Graph();
                // Set data into graph
                $dataPoints1 = $Graph_Instance->Generate_Graph1_List();
                $dataPoints2 = $Graph_Instance->Get_Stats_From_7_Days();
                ?>
                <script>
                window.onload = function() {

                var chart = new CanvasJS.Chart("chartContainer", {
	                theme: "dark2",
                    backgroundColor: "#2F4F4F",
	                animationEnabled: true,
	                title: {
                        fontColor: "#66ff66",
                        margin: 25,
                        fontSize: 20,
		                text: "The percentage of sold products"
	                },
	                data: [{
		                type: "pie",
		                indexLabel: "{y}",
		                yValueFormatString: "#,##0.00\"%\"",
		                indexLabelPlacement: "inside",
		                indexLabelFontColor: "#36454F",
		                indexLabelFontSize: 14,
		                indexLabelFontWeight: "bolder",
		                showInLegend: true,
		                legendText: "{label}",
		                dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
	                }]
                });
                chart.render();

                    var chart1 = new CanvasJS.Chart("chartContainer1", {
	                    animationEnabled: true,
                        backgroundColor: "#2F4F4F",
	                    theme: "dark2", // "light1", "light2", "dark1", "dark2"
	                    title: {
                            fontColor: "#66ff66",
                            margin: 25,
                            fontSize: 20,
		                    text: "Sales from the last seven days"
	                    },
	                    axisY: {
                            titleFontColor : "#ccff66", 
                            titleFontSize: 18,
		                    title: "Quantity",
		                    includeZero: false,
                            margin: 10 
	                    },
	                    data: [{
		                    type: "column",
		                    dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
	                    }]
                    });
                    chart1.render();

                }
                </script>
                <div id="chartContainer" style="min-height: 400px; max-height: 550px; max-width: 550px; margin: 50px auto 0 auto;"></div>
                <div id="chartContainer1" style="height: 500px; width: auto; margin: 50px 0 50px 0;"></div>
            </div>
        </div>
    </section>
    <a href="index.php" class="btn btn-outline-warning">Main page</a>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
 <footer class="container-fluid text-center navbar-fixed-bottom">
  <p>Piotr Murdzia - example page</p>
</footer>
</body>
</html>

<?php
            
            
            