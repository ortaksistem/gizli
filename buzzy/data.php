<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="//www.google.com/jsapi"></script>
    <script type="text/javascript">
        google.load('visualization', '1', { packages: ['corechart'] });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                contentType: 'application/json',
                url: 'data1.php',
                data: '{}',
                success:
                    function(response) {
                        drawVisualization(response.d);
                    }
 
            });
        })
 
        function drawVisualization(dataValues) {

            data.addColumn('string', 'Column Name');
            data.addColumn('number', 'Column Value');
 
            var data = google.visualization.arrayToDataTable(dataValues);
 
            new google.visualization.PieChart(document.getElementById('visualization')).
                draw(data, { title: "Google Charts Example" });          
        }
 
         
    </script>
</head>
<body>
    <form id="form1" runat="server">
        <div id="visualization" style="width: 600px; height: 400px;"></div>asda
    </form>
</body>
</html>