<template>
  <div>
    <notifications group="app" position="bottom right" width="450"></notifications>
  </div>
</template>
<script>
export default {
  data() {
    return {};
  },
  created() {
    // axios
    //   .get("/tournamentss")
    //   .then(response => (this.tournaments = response.data));
    //this.tournament = "la";

    window.Echo.channel("tournaments").listen(
      "TournamentAdded",
      ({ tournament }) => {
        this.$notify({
          group: "app",
          title: "<h1><b>Alert!</b></h1>",
          text: "<h2>New Tournament has been added</h2>",
          type: "success",
          speed: 1500,
          closeOnClick: true
        });
      }
    );
  }
};
</script>

