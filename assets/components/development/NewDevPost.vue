<template>
    <v-form class="elevation-2 p-3">
        <v-row>
            <v-col md="4">
                <v-text-field
                    v-model="title"
                    label="title"
                    required
                    clearable
                ></v-text-field>
            </v-col>
            <v-col md="4">
                <v-text-field
                    v-model="slug"
                    label="slug"
                    required
                    clearable
                ></v-text-field>
            </v-col>
            <v-col md="4">
                <v-file-input
                    accept="image/*"
                    v-model="filename"
                    label="file name"
                    required
                    clearable
                >
                    <template v-slot:selection="{ text }">
                        <v-chip small label color="primary">{{ text }}</v-chip>
                    </template>
                </v-file-input>
            </v-col>
            <v-col sm="6">
                <v-select class="style-chooser mt-5" v-model="selected" :options="all_sections" :value="selected" label="title" :reduce="section => section.id" placeholder="Select a language"></v-select>
            </v-col>
            <v-col md="12">
                <v-textarea
                    v-model="content"
                    clearable
                    clear-icon="mdi-close-circle"
                    label="Text"
                    value="This is clearable text."
                ></v-textarea>
            </v-col>

        </v-row>
    </v-form>
</template>

<script>
import {mapGetters} from 'vuex';

export default {
    name: 'NewDevPost',
    data() {
        return {
            selected : '',
            title    : '',
            content  : '',
            filename : null,
            slug     : ''
        };
    },
    computed: {
        ...mapGetters({
            all_sections: 'sections/allSections'
        })
    },
    mounted() {
        this.$store.dispatch('sections/getSections');
    },
    created() {

    },
    methods: {

    }
};
</script>
