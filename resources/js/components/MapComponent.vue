<template>
    <MglMap v-bind:accessToken="access_token"
            v-bind:mapStyle="'mapbox://styles/undead1sparrow/ckyvby31u003014k9zauruah8'"
            v-bind:center="[395.1, 47.814]"
            v-bind:zoom="10"
            v-bind:showCompass="true"
            v-bind:attributionControl="false"
            @load="onMapLoaded">
        <MglNavigationControl position="top-right"/>
        <MglGeolocateControl position="top-right"/>
        <MglFullscreenControl position="top-right">
        </MglFullscreenControl>
        <MglScaleControl/>
        <MglMarker v-for="location in vitalFacilities" :coordinates="[location.location_x, location.location_y]">
            <v-icon><img src="typesOfPlaces[location.type_of_place].path_to_icon"/></v-icon>
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
    mounted() {
        this.markers = this.markers;
        this.typesOfPlaces = this.typesOfPlaces;
        this.vitalFacilities = this.vitalFacilities;
        this.loadTypesOfPlaces();
        this.loadVitalFacilities();
        //this.createMarkers();
    },
    data() {
        return {
            access_token: "pk.eyJ1IjoidW5kZWFkMXNwYXJyb3ciLCJhIjoiY2t5dmFkamNwMGozZDJ3b3h5cnZ0cjhhMyJ9.hehib1Ux-usP7t3nrzWtdw", // your access token. Needed if you using Mapbox maps
            map_style: "mapbox://styles/undead1sparrow/ckyvby31u003014k9zauruah8", // your map style
            markers: this.markers,
            typesOfPlaces: this.typesOfPlaces,
            vitalFacilities: this.vitalFacilities,
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
        loadTypesOfPlaces() {
            let self = this;
            axios.get(
                'api/typeOfPlace'
            ).then(function (response) {
                self.typesOfPlaces = response.data
                //console.log(self.typesOfPlaces)
            })
        },
        loadVitalFacilities() {
            let self = this;
            axios.get(
                'api/vitalFacility'
            ).then(function (response) {
                self.vitalFacilities = response.data
                //console.log(self.vitalFacilities)
            })
        },
        createMarkers() {
            let self = this
            for (var i = 0; i < self.vitalFacilities.length; i++) {
                self.markers.push({
                    coordinates: [self.vitalFacilities[i].location_x, self.vitalFacilities[i].location_y],
                    type: self.vitalFacilities[i].type_of_place_id
                });
                //console.log(i)
            }
        }
    }
};
</script>
