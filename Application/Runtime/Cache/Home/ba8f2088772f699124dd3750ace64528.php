<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>投票统计结果</title>
    <!-- 引入 echarts.js -->
    <link href="/Public/css/reset.css" type="text/css" rel="stylesheet">
    <link href="/Public/css/style.css" type="text/css" rel="stylesheet">
    <link href="/Public/css/main.css" type="text/css" rel="stylesheet">
    <link href="/Public/css/zebra.css" type="text/css" rel="stylesheet">
    <script src="/Public/js/echarts.js"></script>
    <script src="/Public/js/china.js"></script>
    <script src="/Public/js/jiangsu.js"></script>
    <script type="text/javascript" src="/Public/js/jquery-1.8.3.min.js"></script>
</head>
<body>
<div class="head">
    <div class="login-right-panel">
        <div class="login-logo"></div>
    </div>
    <div class="nav" style="height: 35px;">
    </div>
</div>
<div class="content pageVote">
    <div style="width:900px;height:600px;margin:auto;">
        <!-- 为ECharts准备一个具备大小（宽高）的Dom -->

        <div id="map" style="width: 100%;height:100%;"></div>
    </div>
</div>
<script type="text/javascript">

    var myChart = echarts.init(document.getElementById('map'));




    var geoCoordMap = {

        "南京":[118.78,32.04],
        "上海":[121.47,31.23],
        "南通":[120.88,31.98],
        "北京":[116.40,39.90],
        "深圳":[114.05,22.55],

    };

    var convertData = function (data) {
        var res = [];
        for (var i = 0; i < data.length; i++) {
            var geoCoord = geoCoordMap[data[i].name];
            if (geoCoord) {
                res.push({
                    name: data[i].name,
                    value: geoCoord.concat(data[i].value)
                });
            }
        }
        return res;
    };

    var option = {
        backgroundColor: '#404a59',
        title: {
            text: '全国投票分布情况统计',
            //subtext: 'data from PM25.in',
            sublink: 'http://www.pm25.in',
            x:'center',
            textStyle: {
                color: '#fff'
            }
        },
        tooltip: {
            trigger: 'item',
            formatter: function (params) {
                return params.name + ' : ' + params.value[2];
            }
        },
        legend: {
            orient: 'vertical',
            y: 'bottom',
            x:'right',
            data:['投票统计'],
            textStyle: {
                color: '#fff'
            }
        },
        dataRange: {
            min: 0,
            max: 200,
            calculable: true,
            color: ['#d94e5d','#eac736','#50a3ba'],
            textStyle: {
                color: '#fff'
            }
        },
        geo: {
            map: 'china',
            label: {
                emphasis: {
                    show: false
                }
            },
            itemStyle: {
                normal: {
                    areaColor: '#323c48',
                    borderColor: 'gray'
                },
                emphasis: {
                    areaColor: '#2a333d'
                }
            }
        },
        series: [
            {
                name: '投票统计',
                type: 'scatter',
                coordinateSystem: 'geo',
                data: convertData(

                    (function(){
                    var arr=[];
                    $.ajax({
                        type : 'post',
                        async : false, //同步执行
                        url : "<?php echo U('home/map/show');?>",
                        success : function(json) {
                            if (json) {
                                console.log(json);
                                arr = json;
                            }
                        },
                        error : function(errorMsg) {
                            alert("不好意思,图表请求数据失败啦!");
                            myChart.hideLoading();
                        }
                    })
                    return arr;
                })()

                ),
                symbolSize: 12,
                label: {
                    normal: {
                        show: false
                    },
                    emphasis: {
                        show: false
                    }
                },
                itemStyle: {
                    emphasis: {
                        borderColor: '#fff',
                        borderWidth: 2
                    }
                }
            }
        ]
    }

    //使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);




</script>
</body>
</html>