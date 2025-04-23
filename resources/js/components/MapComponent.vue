<template>
  <div class="flex flex-col">
    <p class="ml-1 text-2xl font-bold text-purple-600 uppercase">Display nearby player</p>
    <p class="pb-4 ml-1 text-md font-normal text-gray-600 italic">Update your current address</p>
    <div id="map" tabindex="0" class="max-w-5xl"></div>
    <form @submit.prevent="submit">
      <div class="flex justify-center max-w-5xl">
        <button
          type="submit"
          class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded mt-2"
        >Save Location</button>
      </div>
    </form>
  </div>
</template>
<script>
export default {
  data() {
    return {
      user_id: "",
      latitude: "",
      longitude: "",
      address: ""
    };
  },
  props: ["user"],

  methods: {
    submit() {
      axios
        .post("/loc", {
          user_id: this.user,
          latitude: this.latitude,
          longitude: this.longitude,
          address: this.address
        })
        .then(response => {
          alert("Succesfully saved");
          location = "/map/search";

          //location = response.data.message;
        })
        .catch(error => {
          console.log(error);
        });
    }
  },
  mounted() {
    var _this = this;
    geo(window, document);

    function geo(win, doc) {
      var olview = new ol.View({
          // projection: 'EPSG:4326',
          center: [0, 0],
          zoom: 3,
          minZoom: 2,
          maxZoom: 20
        }),
        baseLayer = new ol.layer.Tile({
          source: new ol.source.OSM()
        }),
        map = new ol.Map({
          target: doc.getElementById("map"),
          view: olview,
          layers: [baseLayer]
        }),
        popup = new ol.Overlay.Popup();

      //Instantiate with some options and add the Control
      var geocoder = new Geocoder("nominatim", {
        provider: "osm",
        targetType: "text-input",
        lang: "en",
        placeholder: "Search for ...",
        countrycodes: "my",
        limit: 5,
        keepOpen: false,
        autoComplete: true
      });

      map.addControl(geocoder);
      map.addOverlay(popup);

      //Listen when an address is chosen
      geocoder.on("addresschosen", function(evt) {
        // lng = evt.coordinate[0];
        // this.lat = evt.coordinate[1];
        //console.log(evt.address.details.name);
        window.setTimeout(function() {
          popup.show(evt.coordinate, evt.address.formatted);
        }, 3000);

        coor(evt.coordinate[1], evt.coordinate[0], evt.address.details.name);
      });

      //this.latitude = lat;
    }
    // this.longitude = evt.coordinate[0];
    //console.log(lat);
    function coor(lati, longi, address) {
      //console.log(lat);
      _this.latitude = lati;
      _this.longitude = longi;
      _this.address = address;
    }
  }
};
</script>

