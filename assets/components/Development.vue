<template>
    <v-container>
        <v-row justify="center">
            <v-col sm="4">
            <v-alert text dense color="teal" icon="mdi-clock-fast" border="left">
                Documentation for Developments, using ApiPlatform
            </v-alert>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col sm="2">
                <v-select class="style-chooser" v-model="selected" :options="all_sections" :value="selected" label="title" :reduce="section => section.id" placeholder="Select a language"></v-select>
                <v-btn @click="getDevelopmentBySection" color="success" class="mt-5">Search</v-btn>
            </v-col>
        </v-row>
        <v-layout>
            <v-card elevation="2" class="mx-auto my-12" v-for="dev in all_dev" :key="dev.id">
                <v-card-title class="text-warning text--darken-4">{{ dev.title }}</v-card-title>
                <v-card-text class="text-left" v-html="dev.content"></v-card-text>
            </v-card>
        </v-layout>
    </v-container>
</template>
<style>
.style-chooser .vs__selected {
    text-transform: lowercase;
    font-variant: small-caps;
}

.style-chooser .vs__search::placeholder {
    color: #394066;
    text-transform: lowercase;
    font-variant: small-caps;
}

.style-chooser .vs__dropdown-menu {
    padding: 0;
    margin-top: 0.1em;
    background: #ffffff;
    border: none;
    color: #394066;
    text-transform: lowercase;
    font-variant: small-caps;
}

.style-chooser .vs__clear {
    fill: #c42265;
}

.style-chooser .vs__open-indicator {
    fill: rgba(22, 184, 61, 0.67);
}

.style-chooser .vs__dropdown-option--highlight {
    background: rgba(22, 184, 61, 0.67);;
}
</style>
<script>
import {mapGetters} from 'vuex';

export default {
    name: 'Development',
    data() {
        return {
            selected: null
        };
    },
    computed: {
        ...mapGetters({
            all_dev      : 'developments/allDevelopments',
            all_sections : 'sections/allSections'
        })
    },
    mounted() {
        this.$store.dispatch('developments/getDevelopments');
        this.$store.dispatch('sections/getSections');
    },
    methods: {
        getDevelopmentBySection() {
            this.$store.dispatch('developments/getDevBySection', {sel: this.selected});
        }
    },
    created: function () {

    }
};
</script>
