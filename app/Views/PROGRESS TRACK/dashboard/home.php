<?php $this->extend('layout/pic'); ?>

<?php $this->section('content'); ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap-grid.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap-utilities.min.css">

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Row for Cards -->
        <div class="row mb-4">
            <div class="col-md-3 col-sm-6">
                <div class="card text-white bg-primary">
                    <div class="card-body">


                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Daily</h5>
                                <p class="card-text">Description for Daily</p>
                                <p class="card-text">Tickets: <?= $ticketsDaily['ticket_count'] ?> tickets</p>
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
                    <div class="card-header bg-teal text-white"> <!-- Row 2 - Warna Teal -->
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
                    <div class="card-header bg-orange text-white"> <!-- Row 3 - Warna Orange -->
                        <h5 class="card-title mb-0">Hourly Tickets</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="lineChartHourly" style="max-height: 300px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Line Chart - PIC Tasks -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-header bg-orange text-white"> <!-- Row 3 - Warna Orange -->
                        <h5 class="card-title mb-0">PIC Tasks Over Time</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="lineChartPIC" style="max-height: 300px;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Third Row -->
        <div class="row">
            <!-- Doughnut Chart - Vendor -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-header bg-purple text-white"> <!-- Row 4 - Warna Ungu -->
                        <h5 class="card-title mb-0">Doughnut Chart - Vendor</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="doughnutVendor" style="max-height: 200px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Doughnut Chart -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-header bg-purple text-white"> <!-- Row 4 - Warna Ungu -->
                        <h5 class="card-title mb-0">Doughnut Chart</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="doughnutChart" style="max-height: 200px;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fourth Row -->
        <div class="row">
            <!-- Bar Chart -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-header bg-cyan text-dark"> <!-- Row 5 - Warna Cyan -->
                        <h5 class="card-title mb-0">Bar Chart</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="barChart" style="max-height: 200px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Line Chart -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-header bg-cyan text-dark"> <!-- Row 5 - Warna Cyan -->
                        <h5 class="card-title mb-0">Monthly Tickets</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="lineChart" style="max-height: 200px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Menambahkan Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/luxon"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-luxon"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>
    google.charts.load('current', { packages: ['gauge'] });
    google.charts.setOnLoadCallback(drawGaugeChart);

    function drawGaugeChart() {
        const totalTickets = <?= json_encode($totalTickets ?? 0) ?>;
        const maxTickets = 100;

        var data = google.visualization.arrayToDataTable([
            ['Label', 'Value'],
            ['Tickets', 0]  // Mulai dari 0 untuk animasi
        ]);

        var options = {
            width: 400, height: 200,
            redFrom: 80, redTo: 100,
            yellowFrom: 50, yellowTo: 80,
            greenFrom: 0, greenTo: 50,
            minorTicks: 5,
            max: maxTickets
        };

        var chart = new google.visualization.Gauge(document.getElementById('gaugeChart'));
        chart.draw(data, options);

        // Animasi dari 0 ke totalTickets
        let currentValue = 0;
        let step = Math.max(1, Math.ceil(totalTickets / 100)); // Langkah lebih kecil untuk animasi lebih halus

        let interval = setInterval(function () {
            if (currentValue >= totalTickets) {
                clearInterval(interval); // Hentikan animasi saat mencapai nilai akhir
            } else {
                currentValue += step;
                if (currentValue > totalTickets) currentValue = totalTickets; // Pastikan tidak melebihi total
                data.setValue(0, 1, currentValue);
                chart.draw(data, options);
            }
        }, 30); // Delay lebih kecil agar animasi lebih smooth
    }


</script>

<script>

    // Data dari PHP
    const ticketsByHour = <?= json_encode($ticketsByHour ?? []) ?>;

    // 🔹 Line Chart - Tickets Per Hour
    const hourlyLabels = Array.from({ length: 24 }, (_, i) => `${i}:00`); // Label dari 0:00 sampai 23:00
    const hourlyData = new Array(24).fill(0); // Array default dengan 24 elemen (0-23)

    // Masukkan data ke array berdasarkan jam
    ticketsByHour.forEach(ticket => {
        hourlyData[ticket.hour] = ticket.ticket_count;
    });

    const lineChartHourlyCtx = document.getElementById('lineChartHourly').getContext('2d');
    new Chart(lineChartHourlyCtx, {
        type: 'line',
        data: {
            labels: hourlyLabels,
            datasets: [{
                label: 'Tickets Per Hour',
                data: hourlyData,
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Hour of the Day'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number of Tickets'
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            }
        }
    });

    const ticketsByPicOverTime = <?= json_encode($ticketsByPicOverTime ?? []) ?>;

    // 🔹 Line Chart - PIC Tasks Over Time
    const picLabels = ticketsByPicOverTime.map(ticket => ticket.ticket_date);
    const picData = ticketsByPicOverTime.map(ticket => ticket.ticket_count);

    const lineChartPICCtx = document.getElementById('lineChartPIC').getContext('2d');
    new Chart(lineChartPICCtx, {
        type: 'line',
        data: {
            labels: picLabels,
            datasets: [{
                label: 'PIC Tasks Over Time',
                data: picData,
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    type: 'time',
                    time: {
                        unit: 'day'
                    },
                    title: {
                        display: true,
                        text: 'Date'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number of Tasks'
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            }
        }
    });


    // Data from PHP
    const tickets = <?= json_encode($tickets) ?>;
    const ticketsByStatus = <?= json_encode($ticketsByStatus) ?>;
    const ticketsByPic = <?= json_encode($ticketsByPic) ?>;

    // Bar Chart - Data based on Ticket Status
    const ticketStatuses = tickets.reduce((acc, ticket) => {
        acc[ticket.status] = (acc[ticket.status] || 0) + 1;
        return acc;
    }, {});
    const barLabels = Object.keys(ticketStatuses);
    const barData = Object.values(ticketStatuses);

    const barChartCtx = document.getElementById('barChart').getContext('2d');
    new Chart(barChartCtx, {
        type: 'bar',
        data: {
            labels: barLabels,
            datasets: [{
                label: 'Ticket Status',
                data: barData,
                backgroundColor: ['rgba(54, 162, 235, 0.6)', 'rgba(255, 206, 86, 0.6)', 'rgba(255, 99, 132, 0.6)', 'rgba(75, 192, 192, 0.6)'], // Tambahkan warna cyan
            }]
        }
    });

    // Doughnut Chart - Data based on PIC
    const picNames = ticketsByPic.map(ticket => ticket.pic_name || 'Unknown');
    const picTicketCounts = ticketsByPic.map(ticket => ticket.ticket_count);

    const doughnutChartCtx = document.getElementById('doughnutChart').getContext('2d');
    new Chart(doughnutChartCtx, {
        type: 'doughnut',
        data: {
            labels: picNames,  // Menambahkan label berdasarkan nama PIC
            datasets: [{
                data: picTicketCounts,
                backgroundColor: [
                    'rgba(255, 159, 64, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 205, 86, 0.6)',
                    'rgba(0, 128, 0, 0.6)' // Warna hijau tambahan
                ],
                borderColor: [
                    'rgba(255, 159, 64, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 205, 86, 1)',
                    'rgba(0, 128, 0, 1)' // Warna hijau tambahan
                ],
                borderWidth: 1 // Border lebih tebal agar lebih jelas
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        font: {
                            size: 14,  // Ukuran font label di legend
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function (tooltipItem) {
                            // Menambahkan teks "ticket" setelah jumlah tiket di tooltip
                            return tooltipItem.label + ': ' + tooltipItem.raw + ' tickets';
                        }
                    }
                }
            }
        }
    });


    // Line Chart - Tickets This Month
    var ctx = document.getElementById('lineChart').getContext('2d');
    var ticketsThisMonth = <?= json_encode($ticketsThisMonth); ?>;

    var labels = ticketsThisMonth.map(function (ticket) {
        return ticket.date; // Mengambil tanggal tiket
    });

    var data = ticketsThisMonth.map(function (ticket) {
        return ticket.ticket_count; // Mengambil jumlah tiket per tanggal
    });

    var lineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Tickets This Month',
                data: data,
                borderColor: '#28a745',
                backgroundColor: 'rgba(40, 167, 69, 0.2)',
                backgroundColor: 'rgba(40, 167, 69, 0.2)',
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true
                }
            }
        }
    });


    google.charts.load('current', { packages: ['gauge'] });
    google.charts.setOnLoadCallback(drawGaugeChart);

    // Subjects Data dari PHP
    const subjects = <?= json_encode($subjects); ?>;

    // Ambil deskripsi dari setiap subject jika merupakan objek
    const subjectDescriptions = subjects.map(subject => subject.description || 'Unknown');

    // Hitung jumlah kemunculan tiap deskripsi
    const subjectCounts = subjectDescriptions.reduce((acc, description) => {
        acc[description] = (acc[description] || 0) + 1;
        return acc;
    }, {});

    // Hitung total jumlah seluruh subject
    const totalSubjectCount = Object.values(subjectCounts).reduce((acc, count) => acc + count, 0);

    function drawGaugeChart() {
        var data = google.visualization.arrayToDataTable([
            ['Label', 'Value'],
            ['Subjects', totalSubjectCount] // Total subject count sebagai value
        ]);

        var options = {
            width: 400, height: 200,
            redFrom: 90, redTo: 100,
            yellowFrom: 75, yellowTo: 90,
            greenFrom: 0, greenTo: 75,
            minorTicks: 5
        };

        var chart = new google.visualization.Gauge(document.getElementById('gaugeSubjects'));
        chart.draw(data, options);

        // Animasi naik dari 0 ke nilai akhir
        var value = 0;
        var interval = setInterval(function () {
            if (value >= totalSubjectCount) {
                clearInterval(interval);
            } else {
                value += 1;
                data.setValue(0, 1, value);
                chart.draw(data, options);
            }
        }, 50);
    }

    var vendorLabels = <?= json_encode(array_column($invoicesByVendor, 'vendor_name')) ?>;
    var vendorData = <?= json_encode(array_column($invoicesByVendor, 'invoice_count')) ?>;

    const doughnutVendorCtx = document.getElementById('doughnutVendor').getContext('2d');

    new Chart(doughnutVendorCtx, {
        type: 'doughnut',
        data: {
            labels: vendorLabels,
            datasets: [{
                label: 'Invoices Per Vendor',
                data: vendorData,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',  // Merah
                    'rgba(54, 162, 235, 0.6)',  // Biru
                    'rgba(255, 206, 86, 0.6)',  // Kuning
                    'rgba(75, 192, 192, 0.6)',  // Cyan
                    'rgba(153, 102, 255, 0.6)', // Ungu
                    'rgba(0, 128, 0, 0.6)',     // Hijau
                    'rgba(255, 165, 0, 0.6)'    // Oranye (Tambahan)
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(0, 128, 0, 1)',
                    'rgba(255, 165, 0, 1)'  // Oranye (Tambahan)
                ],
                borderWidth: 1
            }]

        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            }
        }
    });
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
    </script>
<?php endif; ?>

<?php $this->endSection(); ?>