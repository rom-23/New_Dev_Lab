<template>
    <v-container grid-list-xl>
        <v-layout row justify-space-center>
            <v-row justify="center">
                <v-col sm="6">
                    <v-alert text dense color="teal" icon="mdi-clock-fast" border="left">
                        Documentation for Developments, using ApiPlatform
                    </v-alert>
                </v-col>
            </v-row>
            <v-row justify="center">
                <v-col sm="3">
                    <v-select class="style-chooser" name="selected" v-model="selected" :options="all_sections" :value="selected"
                              label="title" placeholder="Select a language" item-value="id" item-text="title" return-object>
                    </v-select>
                    <v-btn @click="getDevelopmentBySection(selected.id)" color="success" class="mt-5">Search</v-btn>
                </v-col>
            </v-row>
        </v-layout>
        <template v-if="selected.id">
            <v-layout row justify-space-around>
                <v-flex v-for="dev in all_dev" :key="dev.id" md3>
                    <v-card elevation="2">
                        <v-card-title class="text-warning text--darken-4">{{ dev.title }}</v-card-title>
                        <v-card-text class="text-left caption" v-html="dev.content"></v-card-text>
                        <v-card-text>
                            <v-btn small color="success" class="mt-3">Add Comment</v-btn>
                        </v-card-text>
                    </v-card>
                </v-flex>
            </v-layout>
        </template>
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
    name       : 'Development',
    components : {},
    data() {
        return {
            selected : [],
            file     : null
        };
    },
    computed: {
        ...mapGetters({
            all_sections : 'sections/allSections',
            all_dev      : 'developments/allDevelopments'
        })
    },
    mounted() {
        this.$store.dispatch('sections/getSections');
    },
    methods: {
        getDevelopmentBySection(selected) {
            this.$store.dispatch('developments/getDevBySection', {sel: selected});
            // console.log(this.all_dev);
        }
        // addDocument(id) {
        //     let formData = new FormData();
        //     formData.append('file', this.file);
        //     // formData.append('id', id);
        //
        //     axios.post(`/apiplatform/developments/${id}/document`,
        //         formData,
        //         {
        //             headers: {
        //                 'Content-Type': 'multipart/form-data'
        //             }
        //         }
        //     ).then(function () {
        //         console.log('SUCCESS!!');
        //     })
        //         .catch(function () {
        //             console.log('FAILURE!!');
        //         });

        // let payload = {
        //     id   : id,
        //     file : this.file
        // };
        // this.$store.dispatch('developments/setDevelopmentDocument', formData);
        //     }
    },
    created: function () {

    }
};
</script>
