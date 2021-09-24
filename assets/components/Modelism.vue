<template>
    <v-container>
        <h4>Models List</h4>
        <v-data-table
            :headers="headers"
            :items="all_models"
            :items-per-page="9"
            class="elevation-3"
        ></v-data-table>
    </v-container>
</template>
<script>
import {mapGetters} from 'vuex';
export default {
    name: 'Modelsim',
    data() {
        return {
            headers: [
                {
                    text     : 'Name',
                    align    : 'start',
                    sortable : false,
                    value    : 'name'
                },
                {
                    text     : 'description',
                    value    : 'description',
                    align    : 'start',
                    sortable : false
                }
            ]
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
    created: function () {
    }
}
;
</script>
