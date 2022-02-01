<template>
    <div class="row h-100">
        <div class="col-md-3 col-12 h-md-100 pb-2 pb-md-0">
            <div class="btn-group p-1 m-1">
                <button type="button"
                        class="btn dropdown-toggle"
                        data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    Тип места
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item"
                       v-on:click="selectedPlaceId = null">Все места</a>
                    <a class="dropdown-item"
                       v-for="type_of_place in typesOfPlaces"
                       v-on:click="selectedPlaceId = type_of_place.id"
                    ><img v-bind:src="type_of_place.path_to_icon"/>{{ type_of_place.name }}</a>
                </div>
            </div>
            <div class="btn-group p-1 m-1">
                <button type="button"
                        class="btn dropdown-toggle"
                        data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    Безопасность
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item"
                       v-on:click="selectedIsSafe = null">Игнорировать</a>
                    <a class="dropdown-item"
                       v-on:click="selectedIsSafe = 0">Да</a>
                    <a class="dropdown-item"
                       v-on:click="selectedIsSafe = 1">Нет</a>
                </div>
            </div>
            <button type="button" class="btn btn-warning"
                v-on:click="selectedIsSafe = null; selectedPlaceId = null">Очистить фильтры</button>
            <ul class="list-group">
                <li class="list-group-item d-flex w-100 justify-content-between"
                    v-for="(location, index) in vitalFacilities"
                    v-on:click="center_y = location.location_y; center_x = location.location_x; activeIndex = index"
                    v-bind:class="index == activeIndex ? 'active' : !location.is_safe ? 'bg-success' : 'bg-danger'"
                    v-if="(selectedPlaceId == null || selectedPlaceId == location.type_of_place_id) && (selectedIsSafe == null || selectedIsSafe == location.is_safe)"
                    ><img v-bind:src="location.path_to_icon"/>
                    <h5 class="mb-1">{{ location.name }}</h5>
                    <div v-on:click="location.is_safe = !location.is_safe; changeIsSafe(location)">
                        <img v-if="location.is_safe" src="https://img.icons8.com/dusk/40/000000/skull.png"/>
                        <img v-else src="https://img.icons8.com/dusk/40/000000/deciduous-tree.png"/>
                    </div>
                </li>
            </ul>
        </div>
        <div class="col-md-9 h-100 col-12 h-md-100">
            <MglMap v-bind:accessToken="access_token"
                    v-bind:mapStyle="map_style"
                    v-bind:center="[center_x, center_y]"
                    v-bind:zoom="10"
                    v-bind:showCompass="true"
                    v-bind:attributionControl="false"
                    @load="onMapLoaded">
                <MglNavigationControl position="top-right"/>
                <MglGeolocateControl position="top-right"/>
                <MglFullscreenControl position="top-right">
                </MglFullscreenControl>
                <MglScaleControl/>
                <MglMarker v-for="location in vitalFacilities"
                           :coordinates="[location.location_x, location.location_y]">
                    <v-icon slot="marker"><img v-bind:src="location.path_to_icon"/></v-icon>
                </MglMarker>
                <MglMarker ref="dragMarker"
                           v-bind:coordinates="dragMarkerCoord"
                           v-bind:draggable="true"
                           v-on:dragend="onDragEnd">
                </MglMarker>
            </MglMap>
        </div>
        <add-marker-modal
            :location_x="dragMarkerCoord[0]"
            :location_y="dragMarkerCoord[1]"
            :types_of_place="typesOfPlaces">
        </add-marker-modal>
    </div>
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
        this.typesOfPlaces = this.typesOfPlaces;
        this.vitalFacilities = this.vitalFacilities;
        this.dragMarkerCoord = [395.1, 47.814];
        this.loadTypesOfPlaces();
        this.loadVitalFacilities();
    },
    data() {
        return {
            access_token: "pk.eyJ1IjoidW5kZWFkMXNwYXJyb3ciLCJhIjoiY2t5dmFkamNwMGozZDJ3b3h5cnZ0cjhhMyJ9.hehib1Ux-usP7t3nrzWtdw", // your access token. Needed if you using Mapbox maps
            map_style: "mapbox://styles/undead1sparrow/ckyvby31u003014k9zauruah8", // your map style
            center_x: 395.1,
            center_y: 47.814,
            typesOfPlaces: this.typesOfPlaces,
            vitalFacilities: this.vitalFacilities,
            dragMarkerCoord: this.dragMarkerCoord,
            activeIndex: this.activeIndex,
            selectedPlaceId: this.selectedPlaceId,
            selectedIsSafe: this.selectedIsSafe
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
            })
        },
        loadVitalFacilities() {
            let self = this;
            axios.get(
                'api/vitalFacility'
            ).then(function (response) {
                self.vitalFacilities = response.data
            })
        },
        onDragEnd() {
            this.dragMarkerCoord = [this.$refs.dragMarker.$data.marker._lngLat.lng, this.$refs.dragMarker.$data.marker._lngLat.lat];
            this.center_x = this.dragMarkerCoord[0];
            this.center_y = this.dragMarkerCoord[1];
        },
        changeIsSafe(vitalFacility) {
            let self = this
            axios.put('/api/vitalFacility/' + vitalFacility.id, {
                'name': vitalFacility.name,
                'type_of_place_id': vitalFacility.type_of_place_id,
                'date_added': vitalFacility.date_added,
                'location_x': vitalFacility.location_x,
                'location_y': vitalFacility.location_y,
                'is_safe': vitalFacility.is_safe
            })
        }
    }
};
</script>

<style>
.coordinates {
    background: rgba(0, 0, 0, 0.5);
    color: #fff;
    position: absolute;
    bottom: 40px;
    left: 10px;
    padding: 5px 10px;
    margin: 0;
    font-size: 11px;
    line-height: 18px;
    border-radius: 3px;
    display: none;
}
</style>
