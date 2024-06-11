<template>
    <div id="map-container" class="h-96 rounded-md border-2 border-grat-200">
        <div id="map" ref="mapRef" class="w-full h-full" />
    </div>
</template>

<script>
import Radar from "radar-sdk-js";

import { shallowRef, onMounted, onUnmounted, markRaw, reactive } from "vue";

import axios from "axios";

export default {
    name: "RadarMap",

    data() {
        return {
            mapPoints: [],
        };
    },

    methods: {
        initializeMap() {
            axios

                .get("/api/google-maps/markers")

                .then((response) => {
                    this.mapPoints = response.data.markers;

                    console.log(this.mapPoints);
                })

                .catch((error) => {
                    console.error(error);
                });
        },
    },

    setup(props, { emit }) {
        const mapRef = shallowRef(null);

        const map = shallowRef(null);

        const localMapPoints = reactive([]);

        const markers = reactive([]); // Array to store actual Mapbox marker instances

        const loadMarkers = () => {
            axios

                .get("/api/google-maps/markers")

                .then((response) => {
                    localMapPoints.push(...response.data.markers);

                    localMapPoints.forEach((point) => {
                        const marker = new Radar.ui.marker({ color: "#007aff" })

                            .setLngLat([point.lng, point.lat])

                            .addTo(map.value);

                        markers.push(marker); // Store the marker instance
                    });

                    emit("markerPoints", localMapPoints);
                })

                .catch((error) => {
                    console.error(error);
                });
        };

        const clearMarkers = () => {
            markers.forEach((marker) => {
                marker.remove(); // Remove the marker from the map
            });

            markers.length = 0; // Clear the markers array

            localMapPoints.length = 0; // Clear the localMapPoints array

            emit("markerPoints", localMapPoints);

            console.log(localMapPoints);
        };

        const focusOnPoint = (lat, lng) => {
            map.value.flyTo({
                center: [lng, lat],

                zoom: 18,
            });

            window.scrollTo(0, 0);
        };

        onMounted(() => {
            Radar.initialize(
                "prj_live_pk_de25bd1267979358899fec75949c28423c7b1d48"
            );

            // create a map

            map.value = markRaw(
                Radar.ui.map({
                    container: mapRef.value,

                    style: "radar-default-v1",

                    center: [22.48504895146374, 58.25290029496395],

                    zoom: 14,
                })
            );

            // add a click event listener to the map

            map.value.on("click", function (e) {
                emit("location-selected", e.lngLat);
            });

            loadMarkers();
        }),
            onUnmounted(() => {
                map.value?.remove();
            });

        return {
            map,
            mapRef,
            loadMarkers,
            focusOnPoint,
            clearMarkers,
        };
    },
};
</script>

<style>
@import "radar-sdk-js/dist/radar.css";
</style>