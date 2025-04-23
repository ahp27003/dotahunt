<template>
  <div class="flex flex-wrap flex-row justify-center">
    <!-- <ul v-for="tournament in tournaments">
      <p class="text-indigo-500">{{tournament.name}}</p>
      <p class="text-indigo-500">{{tournament.venue}}</p>
      <p class="text-indigo-500">{{tournament.state}}</p>
    </ul>-->

    <div
      v-for="tournament in tournaments"
      :key="tournament.name"
      class="max-w-xs rounded rounded-t-none overflow-hidden shadow-lg mx-2 mb-2 mt-2 bg-dark-100 hover:bg-content border-t-4 border-purple-700"
    >
      <div class="p-4">
        <div
          class="font-bold text-lg text-center text-white uppercase tracking-wide"
        >{{ tournament.name }}</div>

        <img
          class="max-h-1/4 object-scale-down w-full rounded-lg mt-4"
          :src="'/storage/tour/' + tournament.image"
          alt
        />
      </div>

      <div class="px-6 py-4 text-center text-gray-300">
        <p class="font-medium text-md mb-2">Prize Pool: RM {{ tournament.prizepool }}</p>
        <p class="text-base">
          <span class="font-medium capitalize">Organizer:</span>
          {{ tournament.organizer }}
        </p>
        <p class="text-base">
          <span class="font-medium capitalize">Date:</span>
          {{ tournament.start_date }} until {{ tournament.end_date }}
        </p>
        <p class="text-base">
          <span class="font-medium capitalize">venue:</span>
          {{ tournament.venue }}
        </p>
        <p class="text-base">
          <span class="font-medium capitalize">State:</span>
          {{ tournament.state }}
        </p>

      </div>

      <!-- <p v-for="user in tournament.users">{{user.name}}</p> -->

      <div class="text-center pb-3 -mt-3">
        <a
          :href="'/tournaments/interested/' + tournament.id"
          class="inline-block bg-indigo-500 rounded px-3 py-1 text-md font-semibold text-white mt-3 text-center hover:bg-indigo-600 tracking-wide border-2 border-indigo-500"
        >Interested</a>

        <!-- @php
                            $check = false;
                            foreach ($tour->users as $user) {
                                if($user->id == Auth::user()->id)
                                {
                                    $check = true;
                                    break;
                                }
                            }
                        @endphp
                        <div class="text-center pb-3 -mt-3">

                        @if($check)
                            <a href="/tournaments/notInterested/{{ $tour->id }}" class="inline-block bg-red-500 rounded-full
                                px-3 py-1 text-md font-semibold text-white mt-3 text-center hover:bg-red-600">Cancel</a>
                        @else
                        <a href="/tournaments/interested/{{ $tour->id }}" class="inline-block bg-green-500 rounded-full px-3 py-1
                            text-md font-semibold text-white mt-3 text-center hover:bg-green-600">Interested</a>
        @endif-->
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      tournaments: [],
      check: false
    };
  },

  created() {
    // axios
    //   .get("/tournamentss")
    //   .then(response => (this.tournaments = response.data));
    //this.tournament = "la";

    window.Echo.channel("tournaments").listen(
      "TournamentAdded",
      ({ tournament }) => {
        this.tournaments.push(tournament);
      }
    );
  }
};
</script>
