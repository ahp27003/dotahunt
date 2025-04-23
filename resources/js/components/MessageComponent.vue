<template>
  <modal name="hello-world" height="auto" @before-open="beforeOpen">
    <div class="rounded-lg py-4 bg-dark-100 text-white">
      <p class="text-left font-bold text-2xl px-4 mb-3">Sending New Message to {{name}}</p>
      <form @submit.prevent="submit" class="border-t-2 border-gray-600">
        <div class="p-4">
          <p class="font-medium text-lg">Subject:</p>
          <input
            type="text"
            class="bg-white focus:outline-none focus:shadow-outline border border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal text-black"
            name="subject"
            placeholder="Subject"
            v-model="form.subject"
            required
          />
          <p class="font-medium text-lg mt-4">Message:</p>
          <textarea
            name="message"
            class="bg-white focus:outline-none focus:shadow-outline border border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal resize-none text-black"
            placeholder="Enter your message.."
            v-model="form.message"
            required
          ></textarea>

          <input type="text" name="recipients" hidden v-model="form.recipients" />

          <!-- Submit Form Input -->
          <div class="flex justify-center mt-4">
            <button
              type="submit"
              class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mr-2"
              @click.prevent="$modal.hide('hello-world')"
            >Cancel</button>
            <button
              type="submit"
              class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded"
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
        subject: "",
        message: "",
        recipients: ""
      },
      name: String
    };
  },
  created() {},
  methods: {
    beforeOpen(event) {
      this.form.recipients = event.params.user[0].id;
      this.name = event.params.user[1].name;
      //console.log(event.params.user[1].name);
    },
    submit() {
      axios.post("/messages", this.form).then(response => {
        alert("Succesfully send");
        //console.log(response.data);
        location = response.data.message;
      });
    }
  }
};
</script>

