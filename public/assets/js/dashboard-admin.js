$(function () {

    $.ajax({
        url: '/admin/dashboard',
        type: 'get',
        dataType: 'json',
        success: function (data) {
            // console.log(data);
            $('#userCount').text(`${data.user_count} Pengguna`);
            $('#earning').text(`Rp. ${data.total_earning.toLocaleString('id-ID')}`);
            monthlyIncome(data.monthly_income);
            userCount(data.users);
            earning(data.earning);
        }
    });

    // =====================================
    // Monthly Income
    // =====================================
    function monthlyIncome(data) {
        var series = Object.values(data);
        var categories = Object.keys(data);
        var options = {
            series: [{
                data: series
            }],
            chart: {
                height: 350,
                type: 'bar',
                events: {
                    click: function (chart, w, e) {
                        // console.log(chart, w, e)
                    }
                }
            },
            colors: ["#5D87FF", "#ecf2ff", "#F9F9FD"],
            plotOptions: {
                bar: {
                    columnWidth: '45%',
                    distributed: true,
                }
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                show: false
            },
            xaxis: {
                categories: [
                    categories
                ],
                labels: {
                    style: {
                        colors: ["#5D87FF", "#ecf2ff", "#F9F9FD"],
                        fontSize: '12px'
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

    }

    // =====================================
    // User Count
    // =====================================
    function userCount(data) {
        var roleCounts = data.reduce((counts, user) => {
            var role = user.role;
            counts[role] = (counts[role] || 0) + 1;
            return counts;
        }, {});

        var series = Object.values(roleCounts);
        var labels = Object.keys(roleCounts);

        var userCount = {
            color: "#adb5bd",
            series: series,
            labels: labels,
            chart: {
                width: 180,
                type: "donut",
                fontFamily: "Plus Jakarta Sans', sans-serif",
                foreColor: "#adb0bb",
            },
            plotOptions: {
                pie: {
                    startAngle: 0,
                    endAngle: 360,
                    donut: {
                        size: '75%',
                    },
                },
            },
            stroke: {
                show: false,
            },

            dataLabels: {
                enabled: false,
            },

            legend: {
                show: false,
            },
            colors: ["#5D87FF", "#ecf2ff", "#F9F9FD", "#FFC542", "#FF5B5C"],

            responsive: [{
                breakpoint: 991,
                options: {
                    chart: {
                        width: 150,
                    },
                },
            }, ],
            tooltip: {
                theme: "dark",
                fillSeriesColor: false,
            },
        };

        var chart = new ApexCharts(document.querySelector("#breakup"), userCount);
        chart.render();
    }



    // =====================================
    // Earning
    // =====================================
    function earning(data) {
        var earningCounts = data.reduce((counts, earning) => {
            var date = earning.created_at.split('T')[0]; // Mengambil hanya tanggal, bukan waktu
            counts[date] = (counts[date] || 0) + earning.billing_costs;
            return counts;
        }, {});
        var dataEarn = Object.values(earningCounts);
        var earning = {
            chart: {
                id: "sparkline3",
                type: "area",
                height: 60,
                sparkline: {
                    enabled: true,
                },
                group: "sparklines",
                fontFamily: "Plus Jakarta Sans', sans-serif",
                foreColor: "#adb0bb",
            },
            series: [{
                name: "Earnings",
                color: "#49BEFF",
                data: dataEarn,
            }, ],
            stroke: {
                curve: "smooth",
                width: 2,
            },
            fill: {
                colors: ["#f3feff"],
                type: "solid",
                opacity: 0.05,
            },

            markers: {
                size: 0,
            },
            tooltip: {
                theme: "dark",
                fixed: {
                    enabled: true,
                    position: "right",
                },
                x: {
                    show: false,
                },
            },
        };
        new ApexCharts(document.querySelector("#earning"), earning).render();
    }

})
