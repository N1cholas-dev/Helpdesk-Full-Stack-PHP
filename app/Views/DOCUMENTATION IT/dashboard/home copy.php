<?php $this->extend('layout/admin'); ?>

<?php $this->section('content'); ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap-grid.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap-utilities.min.css">

<div class="content-wrapper">
    <div class="container-fluid">

        <span id="profile-name" style="display: none;">Ini akan disembunyikan</span>
        <span id="userDisplay" style="display: none;">Ini akan disembunyikan</span>

        <style>
            .content-wrapper {
                background-color: #ffffff !important;
                /* Putih */
            }
        </style>

        <style>
            .card {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .card:hover {
                transform: translateY(-5px);
                box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            }

            /* Dark Mode for content-wrapper */
            body.dark-mode .content-wrapper {
                background-color: #121212 !important;
                /* Background gelap */
                color: white !important;
                /* Teks putih agar kontras */
            }

            /* Dark Mode for card elements */
            body.dark-mode .card {
                background-color: #1e1e1e !important;
                /* Background card gelap */
                color: white !important;
                /* Teks putih di dalam card */
                border: 1px solid #333;
                /* Border gelap */
            }

            body.dark-mode .card:hover {
                background-color: #333 !important;
                /* Background lebih gelap saat hover */
                transform: translateY(-5px);
                box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.3);
                /* Menambahkan shadow lebih gelap */
            }

            /* Optional: If you want to ensure the text color within card body is white for dark mode */
            body.dark-mode .card-body {
                color: white !important;
            }

            /* Optional: If the text inside card is not readable, adjust it to white */
            body.dark-mode .card-header,
            body.dark-mode .card-footer {
                color: white !important;
                /* Teks putih di header dan footer card */
            }
        </style>

        <!-- Row for Cards -->
        <div class="row mb-4">
            <div class="col-md-3 col-sm-6">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Daily</h5>
                                <p class="card-text">Description for Daily</p>
                                <p class="card-text">
                                    Tickets: <?= $ticketsDaily['ticket_count'] ?? 0 ?> tickets
                                </p>
                            </div>
                            <div>
                                <i class="fas fa-calendar-day fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Weekly</h5>
                                <p class="card-text">Description for Weekly</p>
                                <p class="card-text">Tickets: <?= $ticketsWeekly['ticket_count'] ?> tickets</p>
                            </div>
                            <div>
                                <i class="fas fa-calendar-week fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Monthly</h5>
                                <p class="card-text">Description for Monthly</p>
                                <p class="card-text">Tickets: <?= $ticketsMonthly['ticket_count'] ?> tickets</p>
                            </div>
                            <div>
                                <i class="fas fa-calendar-alt fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card text-white bg-danger">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Yearly</h5>
                                <p class="card-text">Description for Yearly</p>
                                <p class="card-text">Tickets: <?= $totalTicketsAllYears['ticket_count'] ?> tickets</p>
                            </div>
                            <div>
                                <i class="fas fa-calendar fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row for Charts -->
        <div class="row">
            <!-- Gauge Chart - Subjects -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-header bg-teal text-white"> <!-- Row 2 - Warna Teal -->
                        <h5 class="card-title mb-0">Gauge Subjects</h5>
                    </div>
                    <div class="card-body text-center d-flex justify-content-center align-items-center"
                        style="height: 250px;">
                        <div id="gaugeSubjects" style="max-width: 200px; height: auto;"></div>
                    </div>
                </div>
            </div>

            <!-- Gauge Chart - Objects -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-header bg-teal text-white">
                        <h5 class="card-title mb-0">Gauge Tickets</h5>
                    </div>
                    <div class="card-body text-center d-flex justify-content-center align-items-center"
                        style="height: 250px;">
                        <div id="gaugeChart" style="max-width: 200px; height: auto;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Second Row -->
        <div class="row">
            <!-- Line Chart - Hourly Tickets -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-header bg-orange text-white">
                        <h5 class="card-title mb-0">Hourly Tickets</h5>
                    </div>
                    <div class="card-body">
                        <div id="lineChartHourly" style="max-height: 300px; width: 100%;"></div>
                    </div>
                </div>
            </div>

            <!-- Line Chart - PIC Tasks -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-header bg-orange text-white">
                        <h5 class="card-title mb-0">PIC Tasks Over Time</h5>
                    </div>
                    <div class="card-body">
                        <div id="lineChartPIC" style="max-height: 300px; width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Third Row -->
        <div class="row">
            <!-- Doughnut Chart - Vendor -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-header bg-purple text-white">
                        <h5 class="card-title mb-0">Doughnut Chart - Vendor</h5>
                    </div>
                    <div class="card-body">
                        <div id="doughnutVendor" style="width: 100%; height: 300px;"></div>
                    </div>
                </div>
            </div>

            <!-- Doughnut Chart - PIC -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-header bg-purple text-white">
                        <h5 class="card-title mb-0">Doughnut Chart - PIC</h5>
                    </div>
                    <div class="card-body">
                        <div id="doughnutChart" style="width: 100%; height: 300px;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fourth Row -->
        <div class="row">
            <!-- Bar Chart -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-header bg-cyan text-dark">
                        <h5 class="card-title mb-0">Bar Chart</h5>
                    </div>
                    <div class="card-body">
                        <div id="barChart" style="max-height: 300px; width: 100%;"></div>
                    </div>
                </div>
            </div>

            <!-- Line Chart - Monthly Tickets -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-header bg-cyan text-dark">
                        <h5 class="card-title mb-0">Monthly Tickets</h5>
                    </div>
                    <div class="card-body">
                        <div id="lineChart" style="max-height: 200px; width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Load Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>~
<!-- Luxon untuk time scale -->
<script src="https://cdn.jsdelivr.net/npm/luxon@3.4.3/build/global/luxon.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-luxon@1.3.1/dist/chartjs-adapter-luxon.umd.js"></script>
<!-- Google Charts (gunakan hanya jika masih diperlukan) -->
<script src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
    google.charts.load('current', { packages: ['corechart', 'gauge', 'line'] });
    google.charts.setOnLoadCallback(drawAllCharts);

    function drawAllCharts() {
        drawGaugeChart();
        drawGaugeSubjects();
        drawLineChartHourly();
        drawLineChartPIC();
        drawDoughnutChartPIC();
        drawDoughnutChartVendor();
        drawBarChart();
        drawLineChart();
    }

    function drawGaugeChart() {
        const totalTickets = <?= json_encode($totalTickets ?? 0) ?>;
        const maxTickets = 200;
        var data = google.visualization.arrayToDataTable([
            ['Label', 'Value'],
            ['Tickets', 0] // Mulai dari 0 untuk animasi
        ]);

        // Tentukan warna berdasarkan jumlah tiket
        let options;
        if (totalTickets <= 50) {
            options = {
                width: 400, height: 200,
                greenFrom: 0, greenTo: 200,
                minorTicks: 5,
                max: maxTickets
            };
        } else if (totalTickets <= 150) {
            options = {
                width: 400, height: 200,
                greenFrom: 0, greenTo: 50,
                yellowFrom: 50, yellowTo: 150,
                minorTicks: 5,
                max: maxTickets
            };
        } else {
            options = {
                width: 400, height: 200,
                greenFrom: 0, greenTo: 50,
                yellowFrom: 50, yellowTo: 150,
                redFrom: 150, redTo: 200,
                minorTicks: 5,
                max: maxTickets
            };
        }

        var chart = new google.visualization.Gauge(document.getElementById('gaugeChart'));
        chart.draw(data, options);

        // **Animasi Jarum Bertahap**
        let currentValue = 0;
        let step = Math.max(1, Math.ceil(totalTickets / 50)); // Animasi lebih halus
        let interval = setInterval(() => {
            if (currentValue >= totalTickets) {
                clearInterval(interval);
            } else {
                currentValue += step;
                data.setValue(0, 1, currentValue);
                chart.draw(data, options);
            }
        }, 30); // Kecepatan animasi (30ms per step)
    }

    function drawGaugeSubjects() {
        const totalSubjects = <?= json_encode(count($subjects) ?? 0) ?>;
        const maxSubjects = 200; // Maksimal tetap 200

        var data = google.visualization.arrayToDataTable([
            ['Label', 'Value'],
            ['Subjects', 0] // Mulai dari 0 untuk animasi
        ]);

        // Warna gauge menyesuaikan jumlah Subjects
        let options;
        if (totalSubjects <= 50) {
            options = {
                width: 400, height: 200,
                greenFrom: 0, greenTo: 200,
                minorTicks: 5,
                max: maxSubjects
            };
        } else if (totalSubjects <= 150) {
            options = {
                width: 400, height: 200,
                greenFrom: 0, greenTo: 50,
                yellowFrom: 50, yellowTo: 150,
                minorTicks: 5,
                max: maxSubjects
            };
        } else {
            options = {
                width: 400, height: 200,
                greenFrom: 0, greenTo: 50,
                yellowFrom: 50, yellowTo: 150,
                redFrom: 150, redTo: 200,
                minorTicks: 5,
                max: maxSubjects
            };
        }

        var chart = new google.visualization.Gauge(document.getElementById('gaugeSubjects'));
        chart.draw(data, options);

        // **Animasi Jarum Bertahap**
        let currentValue = 0;
        let step = Math.max(1, Math.ceil(totalSubjects / 50)); // Step lebih smooth

        let interval = setInterval(() => {
            if (currentValue >= totalSubjects) {
                clearInterval(interval);
            } else {
                currentValue += step;
                if (currentValue > totalSubjects) currentValue = totalSubjects;
                data.setValue(0, 1, currentValue);
                chart.draw(data, options);
            }
        }, 30); // Animasi lebih smooth
    }

    function drawLineChartHourly() {
        var hourlyData = <?= json_encode($ticketsByHour) ?>;
        var dataArray = [['Hour', 'Tickets']];

        // Ubah format data agar sesuai dengan Google Charts
        hourlyData.forEach(entry => {
            var hourLabel = entry.hour.padStart(2, '0') + ':00'; // Format jadi '08:00'
            dataArray.push([hourLabel, parseInt(entry.ticket_count)]);
        });

        var data = google.visualization.arrayToDataTable(dataArray);

        var options = {
            title: 'Hourly Tickets',
            curveType: 'function',
            legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('lineChartHourly'));
        chart.draw(data, options);
    }

    function drawLineChartPIC() {
        const ticketsByPicOverTime = <?= json_encode($ticketsByPicOverTime ?? []) ?>;
        var dataArray = [['Date', 'Tasks']];
        ticketsByPicOverTime.forEach(ticket => {
            dataArray.push([new Date(ticket.ticket_date), parseInt(ticket.ticket_count)]);
        });
        var data = google.visualization.arrayToDataTable(dataArray);
        var options = { title: 'PIC Tasks Over Time', curveType: 'function', legend: { position: 'bottom' } };
        var chart = new google.visualization.LineChart(document.getElementById('lineChartPIC'));
        chart.draw(data, options);
    }

    function drawDoughnutChartPIC() {
        var picData = <?= json_encode($ticketsByPic) ?>;
        var dataArray = [['PIC', 'Jumlah']];
        picData.forEach(ticket => dataArray.push([ticket.pic_name || 'Unknown', parseInt(ticket.ticket_count)]));

        var data = google.visualization.arrayToDataTable(dataArray);

        var options = {
            title: 'Doughnut Chart - PIC',
            pieHole: 0.4,
            height: 300,  // Menambah tinggi chart
            chartArea: { width: '90%', height: '80%' }, // Area chart lebih luas
            legend: { position: 'right', textStyle: { fontSize: 12 } } // Legend di kanan dengan font kecil
        };

        var chart = new google.visualization.PieChart(document.getElementById('doughnutChart'));
        chart.draw(data, options);
    }

    function drawDoughnutChartVendor() {
        var vendorData = <?= json_encode($invoicesByVendor) ?>;
        var dataArray = [['Vendor', 'Jumlah']];
        vendorData.forEach(vendor => dataArray.push([vendor.vendor_name, parseInt(vendor.invoice_count)]));

        var data = google.visualization.arrayToDataTable(dataArray);

        var options = {
            title: 'Doughnut Chart - Vendor',
            pieHole: 0.4,
            height: 300,  // Menambah tinggi chart
            chartArea: { width: '90%', height: '80%' }, // Area chart lebih luas
            legend: { position: 'right', textStyle: { fontSize: 12 } } // Legend di kanan dengan font kecil
        };

        var chart = new google.visualization.PieChart(document.getElementById('doughnutVendor'));
        chart.draw(data, options);
    }

    function drawBarChart() {
        var barData = <?= json_encode($ticketsByStatus) ?>;
        var dataArray = [['Status', 'Jumlah']];

        if (barData.length > 0) {
            barData.forEach(status => dataArray.push([status.status_name, parseInt(status.ticket_count)]));
        } else {
            dataArray.push(['No Data', 0]); // Menampilkan pesan jika tidak ada data
        }

        var data = google.visualization.arrayToDataTable(dataArray);
        var options = {
            title: 'Bar Chart - Ticket Status',
            hAxis: { title: 'Jumlah Tiket', minValue: 0 },
            vAxis: { title: 'Status' }
        };

        var chart = new google.visualization.BarChart(document.getElementById('barChart'));
        chart.draw(data, options);
    }

    google.charts.load('current', { packages: ['corechart', 'line'] });
    google.charts.setOnLoadCallback(drawLineChart);

    function drawLineChart() {
        var ticketsThisMonth = <?= json_encode($ticketsThisMonth); ?>;
        var dataArray = [['Date', 'Tickets']];

        ticketsThisMonth.forEach(function (ticket) {
            var dateParts = ticket.date.split('-');
            var dateObj = new Date(parseInt(dateParts[0]), parseInt(dateParts[1]) - 1, parseInt(dateParts[2]));

            dataArray.push([dateObj, parseInt(ticket.ticket_count)]);
        });

        var data = new google.visualization.DataTable();
        data.addColumn('date', 'Date');
        data.addColumn('number', 'Tickets');

        // Jika hanya ada satu titik data dan nilainya 0, tambahkan lebih banyak data dummy agar grafik tidak aneh
        if (dataArray.length === 1 && dataArray[0][1] === 0) {
            for (let i = 1; i <= 10; i++) {
                let dummyDate = new Date();
                dummyDate.setDate(dummyDate.getDate() - i);
                dataArray.push([dummyDate, 0]);
            }
        }

        data.addRows(dataArray.slice(1));

        var options = {
            title: 'Monthly Tickets',
            hAxis: {
                title: 'Date',
                format: 'MMM dd',
                gridlines: { count: 5 },
            },
            vAxis: {
                title: 'Number of Tickets',
                minValue: 0,
            },
            colors: ['#28a745'],
            curveType: 'function',
            legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('lineChart'));
        chart.draw(data, options);
    }

</script>
<!-- Menambahkan SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.title = "HOME";
</script>

<?php if (session()->getFlashdata('success')): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Swal.fire({
                title: "Success!",
                text: "<?= esc(session()->getFlashdata('success')); ?>",
                icon: "success",
                timer: 3000,
                showConfirmButton: false
            });
        });
        document.addEventListener("DOMContentLoaded", function () {
            let profileName = document.getElementById("profileName");
            if (profileName) {
                profileName.textContent = "Loading...";
            }
        });
    </script>

<?php endif; ?>

<?php $this->endSection(); ?>