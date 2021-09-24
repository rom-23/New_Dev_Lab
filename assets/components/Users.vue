<template>
    <v-container>
        <h4>Users List</h4>
    <v-data-table
        :headers="headers"
        :items="all_users"
        :items-per-page="9"
        class="elevation-3"
    ></v-data-table>
    </v-container>
</template>
<script>
import {mapGetters} from 'vuex';
export default {
    name: 'Users',
    data() {
        return {
            headers: [
                {
                    text     : 'Name',
                    align    : 'start',
                    sortable : false,
                    value    : 'username'
                },
                {
                    text     : 'email',
                    value    : 'email',
                    align    : 'start',
                    sortable : false
                },
                {
                    text     : 'Roles',
                    value    : 'roles',
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
