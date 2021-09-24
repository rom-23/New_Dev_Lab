<template>
    <v-form class="form-control elevation-2">
        <v-row>
            <v-col cols="12" md="4">
                <v-text-field
                    v-model="title"
                    :counter="10"
                    label="Title"
                    required

                    clearable
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="4">
                <v-text-field
                    v-model="slug"
                    :counter="10"
                    label="Slug"
                    required

                    clearable
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="4">
                <v-text-field
                    v-model="content"
                    label="content"
                    required

                    clearable
                ></v-text-field>
            </v-col>
            <!--            <v-col cols="10" md="10">-->
            <!--                <v-chip color="primary">Selected Value: {{ selected }} </v-chip>-->
            <!--            </v-col>-->
            <!--            <v-col cols="12" md="12">-->
            <!--                <v-select class="style-chooser" v-model="selected" :options="all_categories" :value="selected" label="name" :reduce="category => category.id" placeholder="Select Category"></v-select>-->
            <!--            </v-col>-->
        </v-row>
        <v-container class="text-center">
            <v-btn color="success" class="mt-5">Add Post</v-btn>
        </v-container>
    </v-form>
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

export default {
    name: 'NewPost',
    data() {
        return {
            selected : null,
            title    : '',
            slug     : '',
            content  : ''
        };
    },
    computed: {},
    mounted() {
    },
    created() {

    },
    methods: {}
};
</script>
