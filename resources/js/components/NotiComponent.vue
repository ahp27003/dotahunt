<template>
  <div>
    <p
      class="block text-default py-2 px-4 no-underline text-md leading-loose ml-1 my-1 hover:bg-content border-b border-gray-600"
      v-if="realnoti == false"
    >No notification</p>
    <div v-for="noti in notifications">
      <a
        class="block text-default py-2 px-4 no-underline text-md leading-loose ml-1 my-1 hover:bg-content border-b border-gray-600"
        :href="'/notifications'"
        v-if="noti.type === 'App\\Notifications\\OfferTeam'"
      >You have new offer from: Team {{ noti.team_name }}</a>

      <a
        class="block text-default py-2 px-4 no-underline text-md leading-loose ml-1 my-1 hover:bg-content border-b border-gray-600"
        :href="'/notifications'"
        v-if="noti.type === 'App\\Notifications\\AcceptOffer'"
      >{{ noti.steam_name }} has accepted your offer</a>

      <a
        class="block text-default py-2 px-4 no-underline text-md leading-loose ml-1 my-1 hover:bg-content border-b border-gray-600"
        :href="'/notifications'"
        v-if="noti.type === 'App\\Notifications\\AcceptScrim'"
      >Team {{ noti.team_name }} has accepted your invitation for scrim</a>

      <a
        class="block text-default py-2 px-4 no-underline text-md leading-loose ml-1 my-1 hover:bg-content border-b border-gray-600"
        :href="'/notifications'"
        v-if="noti.type === 'App\\Notifications\\OfferScrim'"
      >Team {{ noti.team_name }} has invited you to scrim</a>

      <a
        class="block text-default py-2 px-4 no-underline text-md leading-loose ml-1 my-1 hover:bg-content border-b border-gray-600"
        :href="'/notifications'"
        v-if="noti.type === 'App\\Notifications\\RejectOffer'"
      >{{ noti.steam_name }} has rejected your offer</a>

      <a
        class="block text-default py-2 px-4 no-underline text-md leading-loose ml-1 my-1 hover:bg-content border-b border-gray-600"
        :href="'/notifications'"
        v-if="noti.type === 'App\\Notifications\\RejectScrim'"
      >Team {{ noti.team_name }} has rejected your invitation for scrim</a>
      <a
        class="block text-default py-2 px-4 no-underline text-md leading-loose ml-1 my-1 hover:bg-content border-b border-gray-600"
        :href="'/notifications'"
        v-if="noti.type === 'App\\Notifications\\KickPlayer'"
      >You has been kick from Team {{ noti.team_name }}</a>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      notifications: []
    };
  },
  props: {
    realnoti: Boolean
  },
  created() {
    var userId = $('meta[name="userId"]').attr("content");
    Echo.private("App.User." + userId).notification(notification => {
      //this.realnoti = true;
      this.notifications.push(notification);
    });
  }
};
</script>
