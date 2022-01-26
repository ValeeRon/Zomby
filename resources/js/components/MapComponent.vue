<template>
    <MglMap v-bind:accessToken="access_token"
            v-bind:mapStyle="'mapbox://styles/undead1sparrow/ckyvby31u003014k9zauruah8'"
            v-bind:center="[395.1, 47.814]"
            v-bind:zoom="10"
            v-bind:showCompass="true"
            v-bind:attributionControl="false"
            @load="onMapLoaded">
        <MglNavigationControl position="top-right" />
        <MglGeolocateControl position="top-right" >
        </MglGeolocateControl>
        <MglScaleControl />
       <MglMarker v-for="location in locations" :coordinates="location.coordinates">

            <v-icon v-if="location.type == 'food'" slot="marker"><img src="https://img.icons8.com/external-wanicon-lineal-color-wanicon/64/000000/external-fast-food-food-delivery-wanicon-lineal-color-wanicon.png"/></v-icon>
            <v-icon v-if="location.type == 'health'" slot="marker"><img src="https://img.icons8.com/color/48/000000/antibiotic.png"/></v-icon>
            <v-icon v-if="location.type == 'marker'" slot="marker"><img src="https://img.icons8.com/office/40/000000/marker.png"/></v-icon>
        </MglMarker>
    </MglMap>

</template>

<script>
import Mapbox from "mapbox-gl";
import {
    MglAttributionControl,
    MglFullscreenControl,
    MglGeolocateControl,
    MglMap,
    MglMarker,
    MglNavigationControl, MglScaleControl
} from "vue-mapbox";

export default {
    components: {
        MglMap,
        MglAttributionControl,
        MglNavigationControl,
        MglGeolocateControl,
        MglFullscreenControl,
        MglScaleControl,
        MglMarker
    },
    data() {
        return {
            access_token: "pk.eyJ1IjoidW5kZWFkMXNwYXJyb3ciLCJhIjoiY2t5dmFkamNwMGozZDJ3b3h5cnZ0cjhhMyJ9.hehib1Ux-usP7t3nrzWtdw", // your access token. Needed if you using Mapbox maps
            map_style: "mapbox://styles/undead1sparrow/ckyvby31u003014k9zauruah8", // your map style
            locations: [
                {
                    coordinates: [295.549668, 47.814],
                    type: 'food'
                },

                {
                    coordinates: [95.549668, 47.814],
                    type: 'health'
                },
                {
                    coordinates: [195.549668, 47.814],
                    type: 'marker'
                },
                {
                    coordinates: [395.549668, 47.814],
                    type: 'marker'
                },
            ]
        };
    },

    created() {
        // We need to set mapbox-gl library here in order to use it in template
        this.mapbox = Mapbox;
        this.map = null;

    },

    methods: {
        onMapLoaded(event) {
            // in component
            this.map = event.map;
            // or just to store if you want have access from other components
            this.$store.map = event.map;
        },

    }
};
</script>
