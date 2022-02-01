<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-mask-body">
                <div class="card">
                    <div role="document">
                        <div class="modal-header">
                            <h5 class="modal-title">Добавить маркер</h5>
                        </div>
                        <div class="modal-body">
                            <label>
                                Название
                                <input type="text" v-model="name">
                            </label>
                            <label>
                                Тип места
                                <type-of-place-dropwown
                                    :selectedValue="type_of_place"
                                    :options="types_of_place"
                                    v-on:selected="validateSelection"
                                    :disabled="false"
                                    :maxItem="10"
                                    placeholder="Please select an option">
                                </type-of-place-dropwown>
                            </label>
                                <div class="btn-group p-1 m-1">
                                    <button type="button"
                                            class="btn dropdown-toggle"
                                            data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                        Безопасность
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                           v-on:click="is_safe = 0">Да</a>
                                        <a class="dropdown-item"
                                           v-on:click="is_safe = 1">Нет</a>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary"
                                    type="submit" v-on:click="store">Додати
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>
<script>
export default {
    props: [
        'location_x',
        'location_y',
        'types_of_place'
    ],
    name: "AddMarkerModal",
    data() {
        return {
            name: "",
            type_id: this.type_id,
            type_of_place: this.type_of_place,
            is_safe: this.is_safe,
        }
    },
    created() {
        for (const option of this.types_of_place) {
            if (option.id === this.type_of_place_id) {
                this.type_of_place = option
            }
        }
    },
    mounted() {
        this.name = this.name;
        this.type_of_place_id = this.type_of_place_id;
    },
    methods: {
        validateSelection(option) {
            this.type_id = option.id;
        },
        store() {
            var date = new Date()
            var dateString = `${date.getFullYear()}-${date.getMonth()}-${date.getDate()}`
            console.log(dateString)
            console.log('2022-01-02')
            let self = this
            axios.post('/api/vitalFacility', {
                'name': self.name,
                'type_of_place_id': self.type_id,
                'date_added': dateString,
                'location_x': self.location_x,
                'location_y': self.location_y,
                'is_safe': self.is_safe
            })
                .then(function (response) {

                })
                .catch(function (error) {
                    console.log(error);
                });
        }
    }
}
</script>
