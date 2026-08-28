<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');

$subDays = date('Y-m-d', strtotime('-365 days'));
$now = date('Y-m-d');

$thongkedt = thongke_donhthu($subDays, $now);

// Gom nhóm doanh thu theo ngày
$sales_by_date = [];
$total_revenue = 0;
$total_orders = count($thongkedt);
$paid_orders = 0;

foreach ($thongkedt as $tkdt) {
    if ($tkdt['trangthaitt'] == 1 || $tkdt['trangthai'] == 4) {
        $paid_orders++;
        $d = date('d/m/Y', strtotime($tkdt['ngaydat']));
        $amount = (int)$tkdt['tongbill'];
        $total_revenue += $amount;
        
        if (!isset($sales_by_date[$d])) {
            $sales_by_date[$d] = 0;
        }
        $sales_by_date[$d] += $amount;
    }
}

$chart_data = [];
foreach ($sales_by_date as $date => $revenue) {
    $chart_data[] = [
        'date' => $date,
        'doanhthu' => $revenue
    ];
}
$jsonData = json_encode($chart_data);
?>

<div class="container-fluid mt-4">
    <h2 class="text-center text-primary mb-4">Thống kê doanh thu & Hiệu suất bán hàng</h2>

    <!-- Thẻ tóm tắt chỉ số -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white shadow-sm border-0">
                <div class="card-body text-center py-4">
                    <h6 class="text-uppercase mb-2">Tổng doanh thu thực tế</h6>
                    <h3 class="fw-bold mb-0"><?= number_format($total_revenue, 0, ",", ".") ?> ₫</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white shadow-sm border-0">
                <div class="card-body text-center py-4">
                    <h6 class="text-uppercase mb-2">Đơn hàng đã thanh toán</h6>
                    <h3 class="fw-bold mb-0"><?= $paid_orders ?> / <?= $total_orders ?> đơn</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-info text-white shadow-sm border-0">
                <div class="card-body text-center py-4">
                    <h6 class="text-uppercase mb-2">Khoảng thời gian</h6>
                    <h5 class="fw-bold mb-0"><?= date('d/m/Y', strtotime($subDays)) ?> - <?= date('d/m/Y', strtotime($now)) ?></h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Biểu đồ Google Charts -->
    <div class="card shadow-sm border-0 p-4 bg-white rounded">
        <h5 class="card-title text-dark mb-4"><i class="fa-solid fa-chart-column me-2"></i>Biểu đồ doanh thu theo ngày</h5>
        <?php if (!empty($chart_data)): ?>
            <div id="columnchart_material" style="width: 100%; height: 450px;"></div>
        <?php else: ?>
            <div class="alert alert-info text-center my-4">Chưa có dữ liệu doanh thu trong khoảng thời gian này.</div>
        <?php endif; ?>
    </div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var jsonData = <?= $jsonData ?>;
        if (!jsonData || jsonData.length === 0) return;

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Ngày');
        data.addColumn('number', 'Doanh thu (VNĐ)');

        for (var i = 0; i < jsonData.length; i++) {
            data.addRow([jsonData[i].date, jsonData[i].doanhthu]);
        }

        var options = {
            chart: {
                title: 'Doanh thu bán hàng',
                subtitle: 'Thống kê theo từng ngày đặt hàng'
            },
            colors: ['#0E4BF1'],
            bars: 'vertical'
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
</script>
