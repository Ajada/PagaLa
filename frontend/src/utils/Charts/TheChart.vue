<template>
  <div class="chart">
    <Bar
      class="w-50"
      id="chart"
      ref="chart"
      :data="chartData"
      :options="chartOptions"
      :width="350"
      :height="250"
    />
  </div>
</template>

<script>
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarController, CategoryScale, LinearScale, ArcElement, BarElement } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarController, CategoryScale, LinearScale, ArcElement, BarElement)

// const colors = ['#3399FF', '#66CC99', '#FF6666', '#FFCC66', '#FF99CC']

export default {
  name: 'ChartComponent',
  props: {
    labels: Array,
    colors: Array,
    data: Array
  },
  components: {
    Bar
  },
  data () {
    return {
      chartData: {
        labels: this.labels,
        datasets: [
          {
            label: 'Total',
            backgroundColor: this.colors,
            borderColor: this.colors,
            borderWidth: 1,
            data: this.data
          }
        ]
      },
      chartOptions: {
        responsive: false,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              precision: 0
            }
          }
        }
      },
      chartType: 'doughnut',
      labelColors: this.colors
    }
  },
  watch: {
    data () {
      this.updateChartData()
    }
  },
  methods: {
    updateChartData () {
      this.chartData = {
        labels: this.labels,
        datasets: [
          {
            label: 'Total',
            backgroundColor: this.colors,
            borderColor: this.colors,
            data: this.data
          }
        ]
      }
      this.refreshChart()
    },
    refreshChart () {
      this.$nextTick(() => {
        const chart = this.$refs.chart
        if (chart && chart.chart) { chart.chart.update() }
      })
    }
  }
}
</script>

<style scoped>
.chart {
  margin: 1rem auto 1rem;
  overflow: hidden;
}
</style>
