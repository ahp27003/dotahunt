<template>
  <modal name="achievement" height="auto" @before-open="beforeOpen">
    <!-- <p v-for="item in achievements">{{ item.id }}</p> -->

    <div class="p-4 bg-content">
      <p class="text-2xl ml-1 font-bold pb-4 capitalize text-purple-600">Latest achievements</p>
      <div class="bg-dark-100 shadow-lg text-center rounded-lg px-4 pb-6 pt-5">
        <table class="border-collapse w-full">
          <thead class="text-white">
            <th class="capitalize border-b border-gray-300 py-4">#</th>
            <th class="capitalize border-b border-gray-300 py-4">Tournament Name</th>
            <th class="capitalize border-b border-gray-300 py-4">Team</th>
            <th class="capitalize border-b border-gray-300 py-4">Place</th>
            <th class="capitalize border-b border-gray-300 py-4">Date</th>
          </thead>
          <tbody class="text-center">
            <tr
              class="hover:bg-content text-white"
              v-for="(achievement, index) in achievements"
              :key="achievement.name"
            >
              <td class="py-4 px-6 border-b border-gray-300">{{index+1}}</td>
              <td class="py-4 px-6 border-b border-gray-300">{{achievement.tournament_name}}</td>
              <td class="py-4 px-6 border-b border-gray-300">{{achievement.team}}</td>
              <td class="py-4 px-6 border-b border-gray-300" v-if="achievement.place == 1">Champion</td>
              <td class="py-4 px-6 border-b border-gray-300" v-if="achievement.place == 2">Top 4</td>
              <td class="py-4 px-6 border-b border-gray-300" v-if="achievement.place == 3">Top 8</td>
              <td class="py-4 px-6 border-b border-gray-300" v-if="achievement.place == 4">Top 18</td>
              <td class="py-4 px-6 border-b border-gray-300" v-if="achievement.place == 5">Others</td>
              <td class="py-4 px-6 border-b border-gray-300">{{achievement.date}}</td>
            </tr>
          </tbody>
        </table>
        <div class="mt-4 -mb-1 p-2">
          <a
            :href="'/players/'+id+'/achievements'"
            class="bg-pink-500 hover:bg-pink-400 text-white text-lg font-bold py-2 px-4 rounded-lg shadow-lg mt-10"
          >View all achievements</a>
        </div>
      </div>
    </div>
  </modal>
</template>
<script>
export default {
  data() {
    return {
      achievements: [],
      id: String
    };
  },
  //   created() {
  //     axios
  //       .get("'/players/'+id+'/get'")
  //       .then(response => console.log(response.data));
  //   },
  methods: {
    beforeOpen(event) {
      ///console.log(event.params.id);
      this.id = event.params.id;
      axios
        .get("/players/" + event.params.id + "/get")
        .then(response => (this.achievements = response.data));
      //.then(response => console.log(response.data));
    }
  }
};
</script>

