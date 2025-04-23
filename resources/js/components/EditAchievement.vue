<template>
  <modal name="edit-achievement" height="auto" @before-open="beforeOpen">
    <!-- <p v-for="item in achievements">{{ item.id }}</p> -->
    <div class="p-4 bg-content">
      <form class="w-full p-3" @submit.prevent="submit">
        <span
          class="text-lg font-bold uppercase border-b border-gray-600 pb-4 flex justify-center text-white"
        >Edit Achievement</span>
        <div class="flex flex-wrap -mx-3 mt-10 mb-2">
          <div class="w-full px-3 mb-2">
            <label
              class="block uppercase tracking-wide text-white text-md font-semibold mb-2"
              for="grid-first-name"
            >Tournament Name</label>
            <input
              class="appearance-none bg-gray-400 block border border-gray-200 focus:outline-none focus:shadow-outline leading-tight mb-0 px-4 py-3 rounded text-black w-full"
              type="text"
              name="tournament_name"
              v-model="achievement.tournament_name"
              required
            />
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">
          <div class="w-full px-3 mb-2">
            <label
              class="block uppercase tracking-wide text-white text-md font-semibold mb-2"
              for="grid-first-name"
            >Team Name</label>
            <input
              class="appearance-none bg-gray-400 block border border-gray-200 focus:outline-none focus:shadow-outline leading-tight mb-0 px-4 py-3 rounded text-black w-full"
              name="team"
              type="text"
              v-model="achievement.team"
              required
            />
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">
          <div class="w-full px-3 mb-2">
            <label
              class="block uppercase tracking-wide text-white text-md font-semibold mb-2"
              for="grid-first-name"
            >Place</label>
            <div class="w-full">
              <div class="relative">
                <select
                  class="block appearance-none w-full bg-gray-400 border border-gray-200 text-black py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:border-gray-500 focus:shadow-outline"
                  name="place"
                  v-model="achievement.place"
                  required
                >
                  <option disabled selected v-if="achievement.place == 1">Champion</option>
                  <option disabled selected v-if="achievement.place == 2">Top 4</option>
                  <option disabled selected v-if="achievement.place == 3">Top 8</option>
                  <option disabled selected v-if="achievement.place == 4">Top 18</option>
                  <option disabled selected v-if="achievement.place == 5">Others</option>
                  <option value="1">Champion</option>
                  <option value="2">Top 4</option>
                  <option value="3">Top 8</option>
                  <option value="4">Top 18</option>
                  <option value="5">Other</option>
                </select>
                <div
                  class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-white"
                >
                  <svg
                    class="fill-current h-4 w-4"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                  >
                    <path
                      d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                    />
                  </svg>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="flex flex-wrap -mx-3">
          <div class="w-full px-3 mb-2">
            <label
              class="block uppercase tracking-wide text-white text-md font-semibold mb-2"
              for="grid-first-name"
            >Tournament Date</label>
            <input
              class="appearance-none block w-full bg-gray-400 text-black border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:shadow-outline"
              type="date"
              name="date"
              v-model="achievement.date"
              required
            />
            <div
              class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-white"
            >
              <svg
                class="fill-current h-4 w-4"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
              >
                <path
                  d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                />
              </svg>
            </div>
          </div>
        </div>
        <div class="flex justify-center items-center">
          <div>
            <a
              @click.prevent="$modal.hide('edit-achievement')"
              href="javascript:history.back()"
              class="bg-transparent hover:bg-indigo-600 text-gray-300 font-semibold hover:text-white py-2 px-4 border-2 border-indigo-600 hover:border-transparent rounded"
            >Cancel</a>
          </div>
          <div>
            <button
              type="submit"
              class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded mx-auto ml-2 border-2 border-indigo-600"
            >Submit</button>
          </div>
        </div>
      </form>
    </div>
  </modal>
</template>
<script>
export default {
  data() {
    return {
      form: {
        tournament_name: "",
        date: "",
        place: "",
        team: ""
      },
      achievement: Object
    };
  },
  //   created() {
  //     axios
  //       .get("'/players/'+id+'/get'")
  //       .then(response => console.log(response.data));
  //   },
  methods: {
    beforeOpen(event) {
      console.log(event.params.achievement);
      this.achievement = event.params.achievement;
      //   axios
      //     .get("/players/" + event.params.id + "/get")
      //     .then(response => (this.achievements = response.data));
      //.then(response => console.log(response.data));
    },
    submit() {
      axios
        .patch("/achievements/" + this.achievement.id, this.achievement)
        .then(response => {
          alert("Succesfully Update");
          //console.log(response.data);
          location.reload();
        })
        .catch(function(error) {
          console.log(error.response.data);
        });
    }
  }
};
</script>

