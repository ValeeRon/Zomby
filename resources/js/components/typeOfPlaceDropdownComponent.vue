<template>
    <div class="dropdown" v-if="options">
        <!-- Dropdown Input -->
        <input class="dropdown-input"
               @focus="showOptions()"
               @blur="hideOptions"
               v-on:change="search"
               v-model="searchFilter"
               :disabled="disabled"
               :placeholder="placeholder" />
        <!-- Dropdown Menu -->
        <div class="dropdown-content"
             v-show="optionsShown">
            <div
                class="dropdown-item"
                v-for="(option, index) in filteredOptions"
                @mousedown="selectOption(option)"
                :key="index">
                {{ option.name}}<img v-bind:src="option.path_to_icon">
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "typeOfPlaceDropdownComponent",
    props: [
        'options',
        'placeholder',
        'disabled',
        'maxItem',
        'selectedValue'
    ],
    data() {
        return {
            selected: {},
            optionsShown: false,
            searchFilter: ''
        }
    },
    mounted() {
        if(this.selectedValue){
            this.searchFilter = this.selectedValue.name;
            this.selected = this.selectedValue;
            this.selectOption(this.selected);
        }
    },
    computed: {
        filteredOptions() {
            const filtered = [];
            const regOption = new RegExp(this.searchFilter, 'ig');
            for (const option of this.options) {
                if (this.searchFilter.length < 1 || option.name.match(regOption)){
                    if (filtered.length < this.maxItem) filtered.push(option);
                }
            }
            return filtered;
        }
    },
    methods: {
        hideOptions(){
            this.optionsShown = false
        },
        selectOption(option) {
            this.selected = option;
            this.optionsShown = false;
            this.searchFilter = this.selected.name;
            this.$emit('selected', this.selected);
        },
        showOptions(){
            if (!this.disabled) {
                this.searchFilter = '';
                this.optionsShown = true;
            }
        },
        search() {
            if (this.filteredOptions.length === 0) {
                this.selected = {};
            } else {
                this.selected = this.filteredOptions[0];
            }
        }
    },
}
</script>

<style lang="scss" scoped>
.dropdown {
    position: relative;
    display: block;
    margin: auto;
    .dropdown-input {
        cursor: pointer;
        border: 1px solid #c0c2c4;
        border-radius: 3px;
        color: #333;
        display: block;
        padding: 6px;
        min-width: 250px;
        max-width: 250px;
        background: #fff url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='4' height='5' viewBox='0 0 4 5'%3e%3cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3e%3c/svg%3e") right 0.75rem center/8px 10px no-repeat;
    }
    .dropdown-content {
        position: absolute;
        background-color: #fff;
        min-width: 248px;
        max-width: 248px;
        max-height: 248px;
        border: 1px solid #e7ecf5;
        box-shadow: 0px -8px 34px 0px rgba(0,0,0,0.05);
        overflow: auto;
        z-index: 1;
        .dropdown-item {
            color: black;
            padding: 8px;
            text-decoration: none;
            display: block;
            cursor: pointer;
            &:hover {
                background-color: #e7ecf5;
            }
        }
    }
    .dropdown:hover .dropdowncontent {
        display: block;
    }
}
</style>
