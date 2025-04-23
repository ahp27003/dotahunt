<template>
  <modal name="stats" height="auto" @before-open="beforeOpen">
    <div class="p-4 bg-content">
      <p
        class="text-2xl ml-1 font-bold pb-4 capitalize text-purple-600"
      >Average Statistic in {{knowledges.matches}} Matches</p>
      <div class="bg-dark-100 shadow-lg text-center rounded-lg px-4 pb-6 pt-5">
        <table class="border-collapse w-full">
          <thead class="text-white">
            <th class="capitalize border-b border-gray-300 py-4">Winrate</th>
            <th class="capitalize border-b border-gray-300 py-4">GPM</th>
            <th class="capitalize border-b border-gray-300 py-4">XPPM</th>
            <th class="capitalize border-b border-gray-300 py-4">lH</th>
            <th class="capitalize border-b border-gray-300 py-4">HD</th>
            <th class="capitalize border-b border-gray-300 py-4">TD</th>
            <th class="capitalize border-b border-gray-300 py-4">WARD</th>
            <th class="capitalize border-b border-gray-300 py-4">DEWARD</th>
            <th class="capitalize border-b border-gray-300 py-4">K</th>
            <th class="capitalize border-b border-gray-300 py-4">D</th>
            <th class="capitalize border-b border-gray-300 py-4">A</th>
          </thead>
          <tbody class="text-center">
            <tr class="hover:bg-content text-white">
              <td>{{knowledges.winrate}}%</td>
              <td>{{knowledges.gpm}}</td>
              <td>{{knowledges.xppm}}</td>
              <td>{{knowledges.lasthit}}</td>
              <td>{{knowledges.hero_dmg}}</td>
              <td>{{knowledges.tower_dmg}}</td>
              <td>{{knowledges.ward}}</td>
              <td>{{knowledges.deward}}</td>
              <td>{{knowledges.kills}}</td>
              <td>{{knowledges.assists}}</td>
              <td>{{knowledges.death}}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </modal>
</template>
<script>
export default {
  data() {
    return {
      knowledges: []
    };
  },
  //   created() {
  //     axios
  //       .get("'/players/'+id+'/get'")
  //       .then(response => console.log(response.data));
  //   },
  methods: {
    beforeOpen(event) {
      //console.log(event.params.knowledge);
      this.knowledges = event.params.knowledge;
      //console.log(this.knowledges.assists);
      //   axios
      //     .get("/players/" + event.params.id + "/get")
      //     .then(response => (this.achievements = response.data));
      //.then(response => console.log(response.data));
    }
  }
};
</script>

