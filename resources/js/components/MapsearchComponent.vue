<template>
  <div class="flex flex-col">
    <p class="ml-1 text-2xl font-bold text-purple-600 uppercase mb-2">Display nearby player</p>
    <div id="map" tabindex="0" class="max-w-6xl"></div>
  </div>
</template>
<script>
export default {
  props: ["locations", "users", "accounts", "center", "searcher"],
  methods: {},
  mounted() {
    var tengah = ol.proj.transform(
      [
        this.center.coordinate.coordinates[0],
        this.center.coordinate.coordinates[1]
      ],
      "EPSG:900913",
      "EPSG:900913"
    );

    //console.log(this.locations[0].coordinate.coordinates);

    var view = new ol.View({
      center: tengah,
      zoom: 14 // 5
    });

    var vectorSource = new ol.source.Vector({});
    var places = [
      [
        11309119.314336767,
        355596.4074399446,
        "http://maps.google.com/mapfiles/ms/micons/blue.png"
      ],
      [
        11310070.774330724,
        356207.3101690329,
        "http://maps.google.com/mapfiles/ms/micons/blue.png"
      ],
      [
        11309258.355987966,
        356120.4458968876,
        "http://maps.google.com/mapfiles/ms/micons/blue.png" /* [113, 140, 0]*/
      ]
    ];

    //center punya point
    var features = [];
    var iconFeature = new ol.Feature({
      geometry: new ol.geom.Point(
        ol.proj.transform(
          [
            this.center.coordinate.coordinates[0],
            this.center.coordinate.coordinates[1]
          ],
          "EPSG:900913",
          "EPSG:3857"
        )
      )
    });

    //if(this.center.user_id == this.searcher.user_id)
    var iconStyle = [
      new ol.style.Style({
        image: new ol.style.Icon({
          anchor: [0.5, 0.5],
          anchorXUnits: "fraction",
          anchorYUnits: "fraction",
          src: this.searcher.avatar_url,
          crossOrigin: "anonymous",
          scale: 0.3
        })
      }),
      new ol.style.Style({
        text: new ol.style.Text({
          text: "Your location",
          offsetY: -25,
          fill: new ol.style.Fill({
            color: "red"
          }),
          font: "15px sans-serif",
          stroke: "true",
          backgroundStroke: "true"
        })
      })
    ];

    iconFeature.setStyle(iconStyle);
    vectorSource.addFeature(iconFeature);

    //other punya point
    for (var i = 0; i < this.locations.length; i++) {
      var iconFeature = new ol.Feature({
        geometry: new ol.geom.Point(
          ol.proj.transform(
            [
              this.locations[i].coordinate.coordinates[0],
              this.locations[i].coordinate.coordinates[1]
            ],
            "EPSG:900913",
            "EPSG:3857"
          )
        )
      });

      var iconStyle = [
        new ol.style.Style({
          image: new ol.style.Icon({
            anchor: [0.5, 0.5],
            anchorXUnits: "fraction",
            anchorYUnits: "fraction",
            src: this.accounts[i].avatar_url,
            crossOrigin: "anonymous",
            scale: 0.2
          })
        }),

        new ol.style.Style({
          text: new ol.style.Text({
            text: this.accounts[i].steam_name,
            offsetY: -25,
            fill: new ol.style.Fill({
              color: "red"
            }),
            font: "15px sans-serif",
            stroke: "true",
            backgroundStroke: "true"
          })
        })
      ];
      iconFeature.setStyle(iconStyle);
      vectorSource.addFeature(iconFeature);
    }
    // for (var i = 0; i < places.length; i++) {
    //   var iconFeature = new ol.Feature({
    //     geometry: new ol.geom.Point(
    //       ol.proj.transform(
    //         [places[i][0], places[i][1]],
    //         "EPSG:900913",
    //         "EPSG:3857"
    //       )
    //     )
    //   });

    //   var iconStyle = new ol.style.Style({
    //     image: new ol.style.Icon({
    //       anchor: [0.5, 0.5],
    //       anchorXUnits: "fraction",
    //       anchorYUnits: "fraction",
    //       src: places[i][2],
    //       color: places[i][3],
    //       crossOrigin: "anonymous",
    //       scale: 0.4
    //     })
    //   });
    //   iconFeature.setStyle(iconStyle);
    //   vectorSource.addFeature(iconFeature);
    // }

    var vectorLayer = new ol.layer.Vector({
      source: vectorSource,
      updateWhileAnimating: true,
      updateWhileInteracting: true
    });

    var map = new ol.Map({
      target: "map",
      view: view,
      layers: [
        new ol.layer.Tile({
          preload: 3,
          source: new ol.source.OSM()
        }),
        vectorLayer
      ],
      loadTilesWhileAnimating: true
    });
  }
};
</script>

