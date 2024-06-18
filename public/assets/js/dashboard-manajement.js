$(function () {

    $.ajax({
        url: '/manajement/dashboard',
        type: 'get',
        dataType: 'json',
        success: function (data) {
            $('#userCount').text(`${data.customer_count} Pelanggan`);
            $('#earning').text(`Rp. ${data.total_earning.toLocaleString('id-ID')}`);
            monthlyIncome(data.monthly_income);
            customerCount(data.customer_role);
            earning(data.earning);
            console.log(data);
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
    function customerCount(data) {
        var roleCounts = data.reduce((counts, customerCount) => {
            var tariff_name = customerCount.tariff_name;
            counts[tariff_name] = (counts[tariff_name] || 0) + 1;
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
            colors: [
				"#FFD1DC", "#FFABAB", "#FFC3A0", "#FFCC99", "#D4A5A5", 
				"#D5CBB2", "#D1E231", "#99E1D9", "#88D8B0", "#A8E6CF", 
				"#D6FFB7", "#B5EAD7", "#C7CEEA", "#E2F0CB", "#FFDAC1", 
				"#E0BBE4", "#957DAD", "#D291BC", "#FEC8D8", "#FFDFD3", 
				"#BDE4F4", "#D6EADF", "#E4F9F5", "#B4F8C8", "#F4ACB7", 
				"#F4E1D2", "#E8E8E4", "#D3E0DC", "#E1E8DC", "#F6E5E5", 
				"#D5F4E6", "#D0F0C0", "#F8EDD1", "#ECE4DB", "#FFF5DB", 
				"#FFEBE8", "#FFC8DD", "#F3E8EE", "#E1F7D5", "#FFDDF4", 
				"#FCE4EC", "#F8BBD0", "#F48FB1", "#F06292", "#EC407A", 
				"#E91E63", "#D81B60", "#C2185B", "#AD1457", "#880E4F"
			],

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
