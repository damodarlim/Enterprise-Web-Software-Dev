<?php
	include('includes/adminHeader.php');
    include('PHP_GetDataFromDb.php');  
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="PHP_ExportIdea.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <!-- Card Row -->
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Ideas (Total)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php if(isset($all)){ echo $all; } else{ echo "0";}?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Ideas (Bursary)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php if(isset($bursary)){ echo $bursary; } else{ echo "0";} ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Ideas (Information Technology)</div>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php if(isset($it)){ echo $it; } else{ echo "0";}?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Ideas (Student Affair)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php if(isset($stu)){ echo $stu; } else{ echo "0";}?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Ideas (Business)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php if(isset($busi)){ echo $busi; } else{ echo "0";} ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-briefcase fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Ideas (Tourism and Hospitality Management)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php if(isset($tour)){ echo $tour; } else{ echo "0";}  ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas  fa-plane fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card -->
        <div class="row">
            <div class="col-xl-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Percentage of Ideas by Each Department</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">Bursary <span
                                class="float-right"><?php if(isset($bursary_p)){ echo $bursary_p; } else{ echo "0";} ?>%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: <?php if(isset($bursary_p)){ echo $bursary_p; } else{ echo "0";} ?>%"
                                aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">IT <span
                                class="float-right"><?php if(isset($it_p)){ echo $it_p; } else{ echo "0";} ?>%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?php if(isset($it_p)){ echo $it_p; } else{ echo "0";} ?>%"
                                aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">Student Affair <span
                                class="float-right"><?php if(isset($stu_p)){ echo $stu_p; } else{ echo "0";} ?>%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-info" role="progressbar" style="width: <?php if(isset($stu_p)){ echo $stu_p; } else{ echo "0";} ?>%"
                                aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">Business <span
                                class="float-right"><?php if(isset($busi_p)){ echo $busi_p; } else{ echo "0";} ?>%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?php if(isset($busi_p)){ echo $busi_p; } else{ echo "0";}  ?>%"
                                aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">Tourism and Hospitality Management <span
                                class="float-right"><?php if(isset($tour_p)){ echo $tour_p; } else{ echo "0";} ?>%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?php if(isset($tour_p)){ echo $tour_p; } else{ echo "0";}  ?>%"
                                aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
                <!-- Pie Chart -->
                <div class="col-xl-6">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Contributors within Each Department</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2">
                                <canvas id="myPieChart"></canvas>
                            </div>
                            <div class="mt-4 text-center small">
                                <span class="mr-2">
                                    <i class="fas fa-circle text-danger"></i> Bursary
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text-warning"></i> IT
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text-info"></i> Student Affair
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text-success"></i> Business
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text-primary"></i> Tourism and Hospitality Management
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- /.container-fluid -->

<?php
	include('includes/adminFooter.php') 
?>

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<script>
//Pie Chart
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Bursary", "Information Technology", "Student Affair", "Business", "Tourism and Hospitality Management"],
    datasets: [{
        data: [<?php if(isset($bursary)){ echo $bursary; } else{ echo "0";} ?>, <?php if(isset($it)){ echo $it; } else{ echo "0";} ?>,
         <?php if(isset($stu)){ echo $stu; } else{ echo "0";} ?>, <?php if(isset($busi)){ echo $busi; } else{ echo "0";} ?>, <?php if(isset($tour)){ echo $tour; } else{ echo "0";} ?>],
      backgroundColor: ['#e74a3b', '#f6c23e', '#36b9cc', '#50C878', '#0096FF'],
      hoverBackgroundColor: ['#800020', '#DAA520', '#008080', '#088F8F', '#7393B3'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});



function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}

</script>