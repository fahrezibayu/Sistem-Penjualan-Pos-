<footer>
    <div class="footer clearfix mb-0 text-muted">
        <div class="float-start">
            <p>2021 &copy; {{ $profile->nama_aplikasi }}</p>
        </div>
        <div class="float-end">
            <p> Made with <span class="text-danger"><i class="bi bi-heart-fill"></i></span> by {{ $profile->nama }} </p>
        </div>
    </div>
</footer>

<script src="{{ asset('assets/js/app.js') }}"></script>
<script src="{{ asset('assets/js/extensions/datatables.js') }}"></script>
<script src="{{ asset('assets/js/extensions/form-element-select.js') }}"></script>
<script src="{{ asset('assets/js/extensions/filepond.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript" src="http://momentjs.com/downloads/moment-with-locales.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/js/extensions/bootstrap-material-datetimepicker.js') }}"></script>
<script src="{{ asset('assets/js/apps.js') }}"></script>
<script>
    $(function() {
        $('#date').bootstrapMaterialDatePicker({
            time: false,
            clearButton: true,
            format: 'DD-MM-YYYY'
        });
        $('#date2').bootstrapMaterialDatePicker({
            time: false,
            clearButton: true,
            format: 'DD-MM-YYYY'
        });
    })

    var url_chart = "{{ url('dashboard/chart') }}";
    var Month = new Array();
    var Pendapatan = new Array();
    const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Augustus", "September", "Oktober", "November", "Desember"
    ];
    $.get(url_chart, function(response) {
        response.forEach(function(data) {
            Month.push(monthNames[data.bulan]);
            Pendapatan.push(data.pendapatan);
        });
        var options = {
            series: [{
                name: 'Pendapatan',
                data: Pendapatan
            }],
            chart: {
                height: 350,
                type: 'bar',
            },
            plotOptions: {
                bar: {
                    borderRadius: 10,
                    dataLabels: {
                        position: 'top', // top, center, bottom
                    },
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function(val) {
                    return "Rp" +val;
                },
                offsetY: -15,
                style: {
                    fontSize: '12px',
                    colors: ["#BED1E6"]
                }
            },

            xaxis: {
                categories: Month,
                position: 'top',
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                crosshairs: {
                    fill: {
                        type: 'gradient',
                        gradient: {
                            colorFrom: '#D8E3F0',
                            colorTo: '#BED1E6',
                            stops: [0, 100],
                            opacityFrom: 0.4,
                            opacityTo: 0.5,
                        }
                    }
                },
                tooltip: {
                    enabled: true,
                }
            },
            yaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    show: false,
                    formatter: function(val) {
                        return "Rp"+val;
                    }
                }

            },
            title: {
                text: 'Statistik Penjualan',
                floating: true,
                offsetY: 330,
                align: 'center',
                style: {
                    color: '#BED1E6'
                }
            }
        };
        new ApexCharts(document.querySelector("#chart"), options).render();
    })
    document
        .getElementById('alert_password').style.display = "none";

    function _password() {
        var id = $("#id").val();
        var password1 = $("#password").val();
        var password2 = $("#password2").val();
        $.ajax({
            type: 'POST',
            url: "profile/update_password",
            data: {
                password1: password1,
                password2: password2,
                id: id
            },
            success: function() {
                document.getElementById('alert_password').style.display = "block";
                setInterval(() => {
                    window.location = "{{ url('/sign_out') }}"
                }, 3000);
            }
        });
    }

    function checkPassword() {
        $('#error_password2').text('');

        var password1 = $("#password").val();
        var password2 = $("#password2").val();
        var element = document.getElementById("password2");

        if (password1 != password2) {
            document.getElementById("simpan").disabled = true;
            element.classList.remove("is-valid");
            element.classList.add("is-invalid");
        } else {
            document.getElementById("simpan").disabled = false;
            element.classList.remove("is-invalid");
            element.classList.add("is-valid");
        }

    }
</script>
