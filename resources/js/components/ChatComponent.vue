<template>
  <div>
    <transition name="fade">
      <div
        class="bg-dark-100 rounded-lg shadow-lg flex flex-col items-center p-4"
        v-if="chat == true"
      >
        <div class="p-3">
          <img :src="'/img/default.png'" class="w-48" v-if="acc == ''" />
          <img :src="acc" class="w-48 rounded-lg" v-else />
        </div>
        <div class="p-3 text-center">
          <p class="text-xl text-gray-500 font-semibold capitalize">{{usersend}}</p>
          <p class="text-md text-gray-600 font-semibold mb-6 capitalize">Subject: {{thread.subject}}</p>
          <a
            :href="'/messages/'+ thread.id"
            class="btn-indigo text-white text-lg font-bold py-2 px-4 rounded-lg shadow-lg mt-2"
          >New Reply</a>
        </div>
      </div>
    </transition>
  </div>
</template>
<script>
export default {
  props: ["thread", "usersend", "acc", "chat"]
};
</script>
<style>
.fade-enter-active {
  transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>
