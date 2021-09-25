<template>
    <v-container>
        <h4>Models List</h4>
        <v-layout row justify-space-around>
            <v-card  class="mx-auto my-12" v-for="model in all_models" :key="model.id" :loading="loading" max-width="374">
                <v-img max-width="374" :src="getImgUrl('models',model.filename)" v-bind:alt="model.filename"></v-img>
                <v-card-title>{{ model.name }}</v-card-title>
                <v-card-text>
                    <div class="my-4 text-subtitle-1">{{ model.description }}</div>
                    <v-chip-group v-for="(item, key) in model.categories" :key="key">
                        <v-chip>{{ item.name }}</v-chip>
                    </v-chip-group>
                </v-card-text>
                <v-divider class="mx-4"></v-divider>
                <v-card-title>Gallery</v-card-title>
                <v-card-title v-for="(item) in model.images" :key="item.id">
                    <v-img max-width="374" :src="getImgUrl('modelsAttachments',item.path)" v-bind:alt="item.path"></v-img>
                </v-card-title>
                <v-card-actions>
                    <v-btn color="deep-purple lighten-2" text>
                        Reserve
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-layout>
    </v-container>
</template>
<script>

import {mapGetters} from 'vuex';

export default {
    name: 'Modelsim',
    data() {
        return {
            loading: false
        };
    },
    computed: {
        ...mapGetters({
            all_models: 'models/allModels'
        })
    },
    mounted() {
        this.$store.dispatch('models/getModels');
    },
    methods: {
        getImgUrl(folder, filename) {
            return '/uploads/images/' + folder + '/' + filename;
        }
    },
    created: function () {

    }
}
;
</script>
