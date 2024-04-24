<div class="row">
    <style>
        .box{
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;

        }
    </style>
    <div class="col-12">
        <div class="card">
            <div class="card-header p-0">
                <h3 class="card-title">
                    التقرير العام
                </h3>
            </div>

            

            <div class="card-body">
                
                <form action="" method="get">
                  <div class="row">
                   
                   
                        
                    
                    <div class="col-md-4">
                        <input type="date" name="from_date" class="form-control" wire:model.defer="from_date">
                    </div>
                    <div class="col-md-4">
                        <input type="date" name="to_date" class="form-control" wire:model.defer="to_date">
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-primary" wire:click="search">بحث</button>
                    </div>
                </form>

                    <div class="col-12">
                        <hr>
                    </div>

                    @if($from_date && $to_date)

                    <div class="col-md-4">
                        <div class="card-body btn btn-success btn-block">
                            <h4>اجمالي الوارد</h4>
                            <h3>@money($totalIncome)</h3>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card-body btn btn-danger btn-block">
                            <h4>اجمالي المصاريف</h4>
                            <h3>@money($totalOutcome)</h3>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card-body btn btn-warning btn-block">
                            <h4>صافي الربح</h4>
                            <h3>
                                @money($totalIncome - $totalOutcome)
                            </h3>
                        </div>
                    </div>

                    <div class="col-12">
                        <hr>
                    </div>

                    <div class="col-md-12">
                        <canvas id="LineChart"></canvas>
                    </div>

                  </div>
                  @endif

            </div>



    </div>
</div>




<script>
    var ctx = document.getElementById('LineChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($days),
            datasets: [{
                label: "الواردات",
                data: @json($datasets),
                backgroundColor: [
                    'rgba(54, 162, 235, 0.7)',
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                ],
                borderWidth: 1
            },
            {
                label: "المصاريف",
                data: @json($datasets2),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                ],
                borderColor: [
                  
                    'rgba(255, 99, 132, 1)',

                ],
                borderWidth: 1
            }
        ]
        },
        options: {
            responsive: true, // Adjusts the chart size responsively
            maintainAspectRatio: true, // Disables maintaining the aspect ratio
        }
    });

</script>