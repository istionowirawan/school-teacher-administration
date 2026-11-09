

  <div class="content-wrapper">
    
    <!-- Main content -->
    <section class="content">
		
		<div class="col-md-5">
		<div class="box">
			<div class="box-body">
			  <p class="text-center">
				<strong>Hasil Survey</strong>
			  </p>
				
				<?php
				echo "<table class='table table-bordered'>";
				
				echo "<tr class='info' >";
				echo "<th>No.</th>";
				echo "<th>Pertanyaan</th>";
				echo "<th>Yes</th>";
				echo "<th>No</th>";
				echo "<th>Total</th>";
				echo "</tr>";
				foreach($data_laporan->result() as $row) {
					echo "<tr>";
					echo "<td align='center' >".$row->nomor."</td>";
					echo "<td>".$row->pertanyaan_indo."</td>";
					echo "<td align='center' >".$row->jml_yes."</td>";
					echo "<td align='center'>".$row->jml_no."</td>";
					echo "<td align='center'>".$row->jml."</td>";
					echo "</tr>";
				}
				echo "</table>";
				
				echo "<script>";
				echo "var areaChartData = {";
				
				echo "labels: [";
				$tulisan = "";
				$dataYes = "";
				$dataNo = "";
				foreach($data_laporan->result() as $row2) {
					$tulisan .= "'Qestion ";
					$tulisan .= $row2->nomor;
					$tulisan .= "',";
					
					$dataYes .= $row2->jml_yes . ", ";
					$dataNo .= $row2->jml_no . ", ";
				}
				echo $tulisan;
				echo "],";
				
				  echo "datasets: [
					{
					  label: 'Electronics',
					  fillColor: 'rgba(210, 214, 222, 1)',
					  strokeColor: 'rgba(210, 214, 222, 1)',
					  pointColor: 'rgba(210, 214, 222, 1)',
					  pointStrokeColor: '#c1c7d1',
					  pointHighlightFill: '#fff',
					  pointHighlightStroke: 'rgba(220,220,220,1)',
					  data: [".$dataYes."]
					},
					{
					  label: 'Digital Goods',
					  fillColor: 'rgba(60,141,188,0.9)',
					  strokeColor: 'rgba(60,141,188,0.8)',
					  pointColor: '#3b8bba',
					  pointStrokeColor: 'rgba(60,141,188,1)',
					  pointHighlightFill: '#fff',
					  pointHighlightStroke: 'rgba(60,141,188,1)',
					  data: [".$dataNo."]
					}
				  ]
				};";
				echo "</script>";
				?>
			</div>
		</div>
		</div>
		
		<div class="col-md-7">
		<div class="box">
			<div class="box-body">
			  
			  <div class="box box-success">
				<div class="box-header with-border">
				  <h3 class="box-title">Bar Chart</h3>

				  <div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				  </div>
				</div>
				<div class="box-body">
				  <div class="chart">
					<canvas id="barChart" style="height:230px"></canvas>
				  </div>
				</div>
				<!-- /.box-body -->
			  </div>
			  
			</div>
		</div>
		</div>
		
		
		<div class="col-md-12">
			<div class="box">
            <div class="box-header">
              <h3 class="box-title">Rincian Alasan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Alasan Ya</th>
                  <th>Alasan Tidak</th>
				  <th>Pemberi alasan</th>
                </tr>
                </thead>
                
				<tbody>
                <?php
				$nomor = 1;
				foreach($data_comment->result() as $row3) {
					echo "<tr>";
					echo "<td>".$nomor."</td>";
					echo "<td>".$row3->reason1."</td>";
					echo "<td>".$row3->reason2."</td>";
					echo "<td>".$row3->user_input."</td>";
					echo "</tr>";
					$nomor++;
                }
				?>
				
				</tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
		</div>
    </section>
    <!-- /.content -->
	
  </div>

	
<script>
	//-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $("#barChart").get(0).getContext("2d");
    var barChart = new Chart(barChartCanvas);
    var barChartData = areaChartData;
    barChartData.datasets[1].fillColor = "#00a65a";
    barChartData.datasets[1].strokeColor = "#00a65a";
    barChartData.datasets[1].pointColor = "#00a65a";
    var barChartOptions = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: true,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - If there is a stroke on each bar
      barShowStroke: true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth: 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing: 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing: 1,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to make the chart responsive
      responsive: true,
      maintainAspectRatio: true
    };

    barChartOptions.datasetFill = false;
    barChart.Bar(barChartData, barChartOptions);
	
	$("#example1").DataTable({
		"pageLength": 5,
		"lengthChange": false
	});
</script>
