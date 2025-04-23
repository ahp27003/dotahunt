<template>
  <modal name="spider" height="auto" @before-open="beforeOpen">
    <div class="bg-content">
      <apexchart type="radar" height="350" :options="chartOptions" :series="series" />
    </div>
  </modal>
</template>
<script>
export default {
  data() {
    return {
      carry: 0,
      offlaner: 0,
      roamer: 0,
      support: 0,
      mid: 0,
      series: [
        {
          name: "Name",
          data: []
        }
      ],
      chartOptions: {
        title: {
          text: "Most Played Roles"
        },
        chart: {
          foreColor: "#ed64a6"
        },
        colors: ["#4C51BF"],
        labels: ["Carry", "Mid", "Roamer", "Offlaner", "Support"],

        fill: {
          colors: ["#1A73E8", "#B32824"]
        },
        markers: {
          size: 4,
          colors: ["#5A67D8"]
        },
        plotOptions: {
          radar: {
            size: 120,
            polygons: {
              strokeColor: "#dac420",
              fill: {
                colors: ["#333333", "#595959"]
              }
            }
          }
        },
        yaxis: {
          tickAmount: 7
        }
      }
    };
  },
  methods: {
    beforeOpen(event) {
      //console.log(event.params.knowledge.carry);
      this.carry = event.params.knowledge.carry;
      this.mid = event.params.knowledge.mid;
      this.roamer = event.params.knowledge.roamer;
      this.offlaner = event.params.knowledge.offlaner;
      this.support = event.params.knowledge.support;
      //console.log(this.series[0].data);
      //   this.series[0].data.push(
      //     event.params.knowledge.carry,
      //     event.params.knowledge.mid,
      //     event.params.knowledge.roamer,
      //     event.params.knowledge.offlaner,
      //     event.params.knowledge.support
      //   );
      this.series[0].data.length = 0;
      this.series[0].data.push(
        event.params.knowledge.carry,
        event.params.knowledge.mid,
        event.params.knowledge.roamer,
        event.params.knowledge.offlaner,
        event.params.knowledge.support
      );
      //console.log(this.knowledges.assists);
      //   axios
      //     .get("/players/" + event.params.id + "/get")
      //     .then(response => (this.achievements = response.data));
      //.then(response => console.log(response.data));
    }
  }
};
</script>

