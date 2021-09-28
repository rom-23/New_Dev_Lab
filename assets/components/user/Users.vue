<template>
    <v-container>
        <v-row justify="center">
            <v-col sm="4">
                <v-alert text dense color="teal" icon="mdi-clock-fast" border="left">
                    Users CRUD, using Symfony API
                </v-alert>
            </v-col>
        </v-row>
        <v-row>
        <v-col sm="8">
            <v-data-table
                :sort-by.sync="sortBy"
                :sort-desc.sync="sortDesc"
                :headers="headers"
                :items="all_users"
                :items-per-page="9"
                class="elevation-3"
            ></v-data-table>
        </v-col>
        <v-col sm="4">
            <new-post></new-post>
        </v-col>
        </v-row>
    </v-container>
</template>
<script>
import {mapGetters} from 'vuex';
import NewPost from './NewPost';

export default {
    name       : 'Users',
    components : {NewPost},
    data() {
        return {
            sortBy   : 'id',
            sortDesc : true,
            headers  : [
                {
                    text  : 'id',
                    value : 'id',
                    align : 'start'
                },
                {
                    text     : 'email',
                    value    : 'email',
                    align    : 'start',
                    sortable : true
                },
                {
                    text     : 'Roles',
                    value    : 'roles',
                    align    : 'start',
                    sortable : false
                },
                {
                    text     : 'Password',
                    value    : 'password',
                    align    : 'start',
                    sortable : false
                }
            ]
        };
    },
    computed: {
        ...mapGetters({
            all_users: 'users/allUsers'
        })
    },
    mounted() {
        this.$store.dispatch('users/getUsers');
    },
    created: function () {
    }
}
;
</script>
