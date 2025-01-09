<script>
    let charts = {};

    const createChart = (nodeId) => {
        const chartOptions = {
            series: [{
                name: nodeId,
                data: []
            }],
            chart: {
                type: 'line',
                height: 350,
                animations: {
                    enabled: true,
                    easing: 'linear',
                    dynamicAnimation: {
                        speed: 1000
                    }
                },
                padding: {
                    left: 10,
                    right: 10,
                    top: 10,
                    bottom: 20
                },
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function(val, opts) {
                    const dataLength = opts.w.config.series[0].data
                        .length;
                    return opts.dataPointIndex === dataLength - 1 ?
                        val : '';
                },
                offsetY: -10,
                offsetX: -10,
                style: {
                    // colors: ['#FF4560'],
                    fontSize: '12px',
                    fontWeight: 'bold',
                }
            },
            stroke: {
                curve: 'smooth'
            },
            title: {
                text: `Chart ${nodeId}`,
                align: 'left'
            },
            markers: {
                size: 0
            },
            xaxis: {
                type: "datetime",
                labels: {
                    formatter: (value) => {
                        return new Date(value).toLocaleString('id-ID', {
                            timeZone: 'Asia/Jakarta',
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit',
                        });
                    },
                },
            },
            yaxis: {
                title: {
                    text: 'Impedance'
                }
            },
            legend: {
                show: false
            },
        };

        const chartDiv = document.createElement('div');
        chartDiv.id = `chart-${nodeId}`;
        document.getElementById('charts').appendChild(chartDiv);

        const chart = new ApexCharts(chartDiv, chartOptions);
        chart.render();
        charts[nodeId] = chart;
    }

    const fetchNodeData = (selectedNodes) => {
        fetch(`/nodes/node-data?nodes=${selectedNodes.join(',')}`)
            .then(response => response.json())
            .then(data => {
                Object.keys(data).forEach(nodeId => {
                    if (charts[nodeId]) {
                        const localizedData = data[nodeId].map(point => ({
                            x: new Date(point.x).toLocaleString('en-US', {
                                timeZone: 'Asia/Jakarta'
                            }),
                            y: point.y
                        }));
                        charts[nodeId].updateSeries([{
                            data: localizedData
                        }]);
                    }
                });
            });
    }

    const view = (id) => {
        $.ajax({
            type: "get",
            url: `/nodes/detail/${id}`,
            dataType: "json",
            success: function(response) {
                $('#viewModal').modal('show');
                $('#createdAt').text(response.created_at);
                $('#Fasa').text(response.fasa);
                $('#Imaginer').text(response.imaginer);
                $('#Latitude').text(response.latitude);
                $('#Longitude').text(response.longitude);
                $('#Impedance').text(response.impedance);
                $('#Real').text(response.real);
            }
        });
    }

    $('#nodeChart').on('change', function() {
        const selectedNodes = $(this).val() || [];

        Object.keys(charts).forEach(nodeId => {
            if (!selectedNodes.includes(nodeId)) {
                charts[nodeId].destroy();
                delete charts[nodeId];
                document.getElementById(`chart-${nodeId}`).remove();
            }
        });

        selectedNodes.forEach(nodeId => {
            if (!charts[nodeId]) {
                createChart(nodeId);
            }
        });

        fetchNodeData(selectedNodes);
    });

    setInterval(() => {
        const selectedNodes = $('#nodeChart').val() || [];

        if (selectedNodes.length > 0) {
            fetchNodeData(selectedNodes);
        }

        $('#table').DataTable().ajax.reload(null, false);
    }, 2000);

    $(function() {
        $('#nodeChart').select2({
            placeholder: "Select Nodes",
            allowClear: true,
            closeOnSelect: false
        });

        $('#nodeChart').val(['node1', 'node7']).trigger('change');

        $('#table').DataTable({
            order: [],
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            filter: true,
            processing: true,
            responsive: true,
            serverSide: true,
            processing: true,
            scroller: {
                loadingIndicator: false
            },
            pagingType: "full_numbers",
            ajax: {
                url: '/nodes/table',
                data: function(data) {
                    data.node = $('#nodeFilter').val();
                },
            },
            "aaSorting": [0],
            "bFilter": false,
            "columns": [{
                    data: 'created_at',
                    name: 'created_at',
                },
                {
                    data: 'impedance',
                    name: 'impedance',
                },
                {
                    data: 'status',
                    name: 'status',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    searchable: false,
                    orderable: false
                },
            ],
        });

        $('.filter').change(function(e) {
            e.preventDefault();

            $('#table').DataTable().ajax.reload(null, false);
        });
    });
</script>
