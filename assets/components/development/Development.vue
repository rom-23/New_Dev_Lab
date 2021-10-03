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
        <v-layout column align-content-space-around>
            <v-card elevation="2" class="mx-auto my-12" v-for="dev in all_dev" :key="dev.id">
                <v-card-title class="text-warning text--darken-4">{{ dev.title }}</v-card-title>
                <v-card-text class="text-left" v-html="dev.content"></v-card-text>
                <v-card-text>
                    <v-file-input
                        accept=".pdf"
                        v-model="file"
                        label="file"
                        required
                        clearable
                    >
                        <template v-slot:selection="{ text }">
                            <v-chip small label color="primary">{{ text }}</v-chip>
                        </template>
                    </v-file-input>
                </v-card-text>
                <v-card-text>
                    <v-btn color="success" class="mt-3" @click="addDocument(dev.id)">Add File</v-btn>
                </v-card-text>
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
import axios from 'axios';

export default {
    name       : 'Development',
    components : {},
    data() {
        return {
            selected : null,
            file     : null
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
        },
        addDocument(id) {
            let formData = new FormData();
            formData.append('file', this.file);
            // formData.append('id', id);

            axios.post(`/apiplatform/developments/${id}/document`,
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
            ).then(function() {
                console.log('SUCCESS!!');
            })
                .catch(function() {
                    console.log('FAILURE!!');
                });

            // let payload = {
            //     id   : id,
            //     file : this.file
            // };
            // this.$store.dispatch('developments/setDevelopmentDocument', formData);
        }
    },
    created: function () {

    }
};
</script>
