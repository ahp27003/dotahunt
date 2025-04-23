<template>
  <div>
    <div v-for="noti in notifications">
      <p v-text="noti"></p>
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

  created() {
    var userId = $('meta[name="userId"]').attr("content");
    Echo.private("App.User." + userId).notification(notification => {
      this.notifications.push(notification);
      console.log(notification);
    });
  }
};
</script>
