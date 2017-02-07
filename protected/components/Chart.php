<?php

class Chart {

    function Piramitchart($AGE, $MAN, $WOMAN) {
        $str = "<script type='text/javascript'>
                            var categories = [" . $AGE . "];
                                $(document).ready(function() {
                                    $('#chart_content').highcharts({
                                        chart: {
                                            type: 'bar'
                                        },
                                        title: {
                                            text: 'ปิรามิดประชากร จาก 43 แฟ้ม'
                                        },
                                        subtitle: {
                                            text: ''
                                        },
                                        xAxis: [{
                                            categories: categories,
                                            reversed: false
                                        }, { // mirror axis on right side
                                            opposite: true,
                                            reversed: false,
                                            categories: categories,
                                            linkedTo: 0
                                        }],
                                        yAxis: {
                                            title: {
                                                text: null
                                            },
                                            labels: {
                                                formatter: function(){
                                                    return Highcharts.numberFormat(Math.abs(this.value),0) + ' คน';
                                                }
                                            }
                                            /*,
                                            min: -40000,
                                            max: 40000
                                            */
                                        },

                                        plotOptions: {
                                            series: {
                                                stacking: 'normal'
                                            }
                                        },

                                        tooltip: {
                                            formatter: function(){
                                                return '<b>'+ this.series.name +', อายุ '+ this.point.category +'</b><br/>'+
                                                    'จำนวน: '+ Highcharts.numberFormat(Math.abs(this.point.y), 0);
                                            }
                                        },

                                        series: [{
                                            color:'green',
                                            name: 'ชาย',
                                            data:  [" . $MAN . "]
                                        }, {
                                            color:'red',
                                            name: 'หญิง',
                                            data:  [" . $WOMAN . "]
                                        }]
                                    });
                                });
                    </script> ";
        return $str;
    }

    function PiramitNews($AGE, $MAN, $WOMAN) {
        $str = "<script type='text/javascript'>
            $(function () {
                    var categories = [$AGE];
                    $(document).ready(function () {
                        $('#chart_content').highcharts({
                            chart: {
                                type: 'bar'
                            },
                            title: {
                                text: 'Population pyramid for Germany, midyear 2010'
                            },
                            subtitle: {
                                text: 'Source: www.census.gov'
                            },
                            xAxis: [{
                                categories: categories,
                                reversed: false,
                                labels: {
                                    step: 1
                                }
                            }, { // mirror axis on right side
                                opposite: true,
                                reversed: false,
                                categories: categories,
                                linkedTo: 0,
                                labels: {
                                    step: 1
                                }
                            }],
                            yAxis: {
                                title: {
                                    text: null
                                },
                                labels: {
                                    formatter: function () {
                                        return (Math.abs(this.value) / 1000000) + 'M';
                                    }
                                },
                                min: -4000000,
                                max: 4000000
                            },

                            plotOptions: {
                                series: {
                                    stacking: 'normal'
                                }
                            },

                            tooltip: {
                                formatter: function () {
                                    return '<b>' + this.series.name + ', age ' + this.point.category + '</b><br/>' +
                                        'Population: ' + Highcharts.numberFormat(Math.abs(this.point.y), 0);
                                }
                            },

                            series: [{
                                name: 'Male',
                                data: [$MAN]
                            }, {
                                name: 'Female',
                                data: [1656154, 1787564, 1981671, 2108575, 2403438, 2366003, 2301402, 2519874,
                                    3360596, 3493473, 3050775, 2759560, 2304444, 2426504, 2568938, 1785638,
                                    1447162, 1005011, 330870, 130632, 21208]
                            }]
                        });
                    });

                }); 
                </script>";

        return $str;
    }

    function column_graph($report_name, $categories, $data) {

        $show_column_graph = " <script type='text/javascript'>   
               $(function () {
                       $('#container').highcharts({
                           chart: {
                               type: 'column'
                           },
                           title: {
                               text: '$report_name'
                           },
                           xAxis: {
                               categories: [$categories]
                           },
                           yAxis: {
                               min: 0,
                               title: {
                                   text: 'จำนวน'
                               }
                           },
                           plotOptions: {
                               column: {
                                   pointPadding: 0.2,
                                   borderWidth: 0
                               }
                           },
                           series: [{
                               name: '$report_name',
                               data: [$data]
                           }]
                       });
                   });
        </script>";
        return $show_column_graph;
    }

    function column_graph2($id, $report_name, $categories, $name1, $val1, $name2, $val2) {
        $show_column_graph = "<script type='text/javascript'> ";
        $show_column_graph .= " 
                                    $(function () {
                                            $('#$id').highcharts({
                                                title: {
                                                    text: '$report_name'
                                                },
                                                xAxis: {
                                                    categories: [$categories]
                                                },
                                                yAxis: {
                                                    min: 0,
                                                    title: {
                                                        text: 'จำนวน',
                                                    },
                                                     labels: {
                                                        formatter: function () {
                                                            return this.value;
                                                        }
                                                    }
                                                },
                                                legend: {
                                                    align: 'right',
                                                    x: -70,
                                                    verticalAlign: 'top',
                                                    y: 20,
                                                    floating: true,
                                                    backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                                                    borderColor: '#CCC',
                                                    borderWidth: 1,
                                                    shadow: false
                                                },
                                                credits: {
                                                    enabled: false
                                                },
                                                plotOptions: {
                                                    column: {
                                                        stacking: 'normal',
                                                        dataLabels: {
                                                            enabled: true,
                                                            color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                                                            style: {
                                                                textShadow: '0 0 3px black, 0 0 3px black'
                                                            }
                                                        }
                                                    }
                                                },
                                                series: [{
                                                    type: 'column',
                                                    name: '$name1',
                                                    data: [$val1],
                                                    color:'green'
                                                }, {
                                                    type: 'spline',
                                                    name: '$name2',
                                                    data: [$val2],
                                                    color: 'red'
                                                }]
                                            });
                                        });";
        $show_column_graph .= "</script>";
        return $show_column_graph;
    }

    function bar_chart($name = '', $category = '', $val1 = '', $val2 = '', $val3 = '') {
        $str = "<script type='text/javascript'> ";
        $str .= "$(function () {
                $('#chart').highcharts({
                    chart: {
                        type: 'bar'
                    },
                    title: {
                        text: '$name'
                    },
                    xAxis: {
                        categories: [$category],
                        title: {
                            text: null
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'ร้อยละ',
                            align: 'high'
                        },
                        labels: {
                            overflow: 'justify'
                        }
                    },
                    tooltip: {
                        valueSuffix: ' % '
                    },
                    plotOptions: {
                        bar: {
                            dataLabels: {
                                enabled: true
                            }
                        }
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'top',
                        x: -40,
                        y: 100,
                        floating: true,
                        borderWidth: 1,
                        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                        shadow: true
                    },
                    credits: {
                        enabled: false
                    },
                    series: [{
                        name: 'อัตราเกิด',
                        data: [$val1]
                    }, {
                        name: 'อัตราตาย',
                        data: [$val2]
                    }, {
                        name: 'เพิ่มตามธรรมชาติ',
                        data: [$val3]
                    }]
                });
            });";
        $str .= "</script>";
        return $str;
    }

    function areaspline($name = '', $category = '', $val1 = '', $val2 = '', $val3 = '') {
        $str = "<script type='text/javascript'> ";
        $str .= "$(function () {
                        $('#chart').highcharts({
                            chart: {
                                type: 'spline'
                            },
                            title: {
                                text: '$name'
                            },
                            legend: {
                                layout: 'vertical',
                                align: 'left',
                                verticalAlign: 'top',
                                x: 150,
                                y: 100,
                                floating: true,
                                borderWidth: 1,
                                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor)
                            },
                            xAxis: {
                                categories: [$category],
                                plotBands: [{ // visualize the weekend
                                    from: 4.5,
                                    to: 6.5
                                }]
                            },
                            yAxis: {
                                title: {
                                    text: 'ร้อยละ'
                                }
                            },
                            tooltip: {
                                shared: true,
                                valueSuffix: ' %'
                            },
                            credits: {
                                enabled: false
                            },
                            plotOptions: {
                                areaspline: {
                                    fillOpacity: 0.5
                                }
                            },
                            series: [{
                                name: 'อัตราเกิด',
                                data: [$val1]
                            }, {
                                name: 'อัตราตาย',
                                data: [$val2]
                            }, {
                                name: 'เพิ่มตามธรรมชาติ',
                                data: [$val3],
                                color: 'green'
                            }]
                        });
                    });";
        $str .= "</script>";
        return $str;
    }

    function graph2line($id = '', $name = '', $sub_title = '', $category = '', $name1 = '', $name2 = '', $val1 = '', $val2 = '') {
        $str = "<script type='text/javascript'> ";
        $str .= "$(function () {
                        $('#$id').highcharts({
                            chart: {
                                type: 'spline'
                            },
                            title: {
                                text: '$name'
                            },
                            subtitle: {
                                text: '$sub_title'
                            },
                            legend: {
                                layout: 'vertical',
                                align: 'right',
                                verticalAlign: 'top',
                                x: -20,
                                y: 50,
                                floating: true,
                                borderWidth: 1,
                                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor)
                            },
                            xAxis: {
                                categories: [$category],
                                plotBands: [{ // visualize the weekend
                                    from: 4.5,
                                    to: 6.5
                                }]
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: 'จำนวน'
                                }
                            },
                            tooltip: {
                                shared: true,
                                valueSuffix: 'คน'
                            },
                            credits: {
                                enabled: false
                            },
                            plotOptions: {
                                areaspline: {
                                    fillOpacity: 0.5
                                }
                            },
                            series: [{
                                name: '$name1',
                                data: [$val1],
                                color:'red'
                            }, {
                                name: '$name2',
                                data: [$val2]
                            }]
                        });
                    });";
        $str .= "</script>";
        return $str;
    }

    function gauge($id = '', $name = '', $value = '') {
        $str = "<script type='text/javascript'>
                        $(document).ready(function() {
                            $('#$id').highcharts({
                                chart: {
                                    type: 'gauge',
                                    plotBackgroundColor: null,
                                    plotBackgroundImage: null,
                                    plotBorderWidth: 0,
                                    plotShadow: false,
                                    height: 200
                                },
                                credits: {
                                    enabled: false
                                },
                                plotOptions: {
                                    gauge: {
                                        dataLabels: {
                                            style: {
                                                fontSize: '20px',
                                                color: 'red'
                                            }
                                        }
                                    }
                                },
                                plotBorderWidth: 0,
                                title: {
                                    text: '" . $name . "'
                                },
                                pane: {
                                    center: ['50%', '85%'],
                                    startAngle: -90,
                                    endAngle: 90,
                                    size: 190,
                                    background:null
                                },
                                // the value axis
                                yAxis: {
                                    min: 0,
                                    max: 100,
                                    minorTickInterval: 'auto',
                                    minorTickWidth: 1,
                                    minorTickLength: 10,
                                    minorTickPosition: 'inside',
                                    minorTickColor: '#666',
                                    tickPixelInterval: 30,
                                    tickWidth: 2,
                                    tickPosition: 'inside',
                                    tickLength: 10,
                                    tickColor: '#666',
                                    labels: {
                                        step: 2,
                                        rotation: 'auto'
                                    },
                                    title: {
                                        text: 'ร้อยละ'
                                    },
                                    plotBands: [{
                                            from: 0,
                                            to: 90,
                                            color: 'red' // green
                                        }, {
                                            from: 90,
                                            to: 100,
                                            color: '#55BF3B' // red
                                        }]
                                },
                                series: [{
                                        name: 'ร้อยละ ',
                                        data: [" . $value . "],
                                        tooltip: {
                                            valueSuffix: ''
                                        }
                                    }]

                            });
            });
            </script>";

        return $str;
    }

    function gaugekpi($id, $value,$name) {
        $str = "<script type='text/javascript'>
                        $(function () {
                            Highcharts.chart('" . $id . "', {
                                chart: {
                                    type: 'gauge',
                                    plotBackgroundColor: null,
                                    plotBackgroundImage: null,
                                    plotBorderWidth: 0,
                                    height: 200,
                                    plotShadow: false
                                },
                                title: {
                                    text: '".$name."'
                                },
                                pane: {
                                    center: ['50%', '85%'],
                                    startAngle: -90,
                                    endAngle: 90,
                                    size: 190,
                                    background: null
                                },
                                credits: {
                                    enabled: false
                                },
                                plotOptions: {
                                    gauge: {
                                        dataLabels: {
                                            style: {
                                                fontSize: '20px',
                                                color: 'red'
                                            }
                                        }
                                    }
                                },
                                // the value axis
                                yAxis: {
                                    min: 0,
                                    max: 100,
                                    minorTickInterval: 'auto',
                                    minorTickWidth: 1,
                                    minorTickLength: 10,
                                    minorTickPosition: 'inside',
                                    minorTickColor: '#666',
                                    tickPixelInterval: 30,
                                    tickWidth: 2,
                                    tickPosition: 'inside',
                                    tickLength: 10,
                                    tickColor: '#666',
                                    labels: {
                                        step: 2,
                                        rotation: 'auto'
                                    },
                                    title: {
                                        text: '%'
                                    },
                                    plotBands: [{
                                            from: 50,
                                            to: 100,
                                            color: '#55BF3B' // green
                                        }, {
                                            from: 30,
                                            to: 50,
                                            color: '#DDDF0D' // yellow
                                        }, {
                                            from: 0,
                                            to: 30,
                                            color: '#DF5353' // red
                                        }]
                                },
                                series: [{
                                        name: 'ร้อยละ',
                                        data: [" . $value . "],
                                        tooltip: {
                                            valueSuffix: ''
                                        }
                                    }]

                            },
                                    function (chart) {
                                        var point = chart.series[0].points[0],
                                                newVal,
                                                newVal = point.y;
                                        point.update(newVal);
                                    });
                        });
                    </script>";

        return $str;
    }

}

?>
