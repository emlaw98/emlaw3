'use strict';

var chartInstance = null;

let dashboard = {
    chartInstance: null,

    chartLabels: [
       
    ],

    chartData: [
       
    ],

    chartConfig: function () {
        return {
            type: 'line',
            data: {
                labels: this.chartLabels,
                datasets: [
                    {
                        label: 'Số lượng công trình',
                        backgroundColor: 'rgb(255, 99, 132)',
                        borderColor: 'rgb(255, 99, 132)',
                        data: this.chartData
                    }
                ]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        }
    },

    generateChart() {
        if ($('#myChart').length) {

            this.chartInstance = new Chart(
                document.getElementById('myChart'),
                this.chartConfig()
            );
        }
    },

    getConstructionsStatisticByRangeDate(element) {
        let rangeDate = element.value;
        console.log(rangeDate);
    },

    async getStatisticByRangeDate(numberOfDate) {
        let currentDate = new Date();
        let dateStart = currentDate.setDate(currentDate.getDate() - numberOfDate);
        let rangesDates = this.getRangesDate(dateStart, new Date());

        if (this.chartInstance) {
            this.chartInstance.destroy();
        }
        
        this.chartLabels = [];
        this.chartData = [];

        let statistic = await $.post(baseUrl + '/dashboards/statistics', {
            range_date: rangesDates
        });

        if (statistic.success) {
            let statisticData = Object.values(statistic.data);

            statisticData.forEach( statisticItem => {
                this.chartLabels.push(statisticItem.date);
                this.chartData.push(statisticItem.total_construction);
            });

            this.generateChart();
        }
    },

    formatDate(date) {
        let fullDate = date.getFullYear() + '-' + ('0' + (date.getMonth()+1)).slice(-2)
                                          + '-' + ('0' + date.getDate()).slice(-2);

        return fullDate;
    },

    getRangesDate(start, end) {
        for(var ranges=[],dt=new Date(start); dt.getTime()<=end.getTime(); dt.setDate(dt.getDate()+1)){
            ranges.push(this.formatDate(new Date(dt)));
        }

        return ranges;
    }
};

$(document).ready(function () {
    if ($('#myChart').length) {
        dashboard.getStatisticByRangeDate($('#range_date').val());
    }
});
