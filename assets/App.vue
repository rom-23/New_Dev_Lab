<template>
    <v-app>
        <v-app-bar absolute app>
            <v-btn class="mx-2" small fab color="primary">
                <router-link :to="{ name: 'home'}">
                    <v-icon color="white">mdi-home</v-icon>
                </router-link>
            </v-btn>
            <v-toolbar-items class="nav navLink">
                <ul class="nav">
                    <router-link :to="{ name: 'users'}">Users</router-link>
                    <router-link :to="{ name: 'dev'}">Dev</router-link>
                    <router-link :to="{ name: 'modelism'}">Modelism</router-link>
                </ul>
            </v-toolbar-items>
            <div class="flex-grow-1"></div>
            <v-toolbar-items class="nav navLink">
                    <ul class="nav" v-if="isLoggedIn">
                        <li class="nav nav-item"><small>{{ username }}</small></li>
                        <a class="navLink" @click="logout"><em>Logout</em></a>
                    </ul>
                    <ul class="nav" v-else>
                        <router-link :to="{ name: 'dev_register'}">Register</router-link>
                        <router-link :to="{ name: 'dev_login'}">Login</router-link>
                    </ul>
            </v-toolbar-items>
        </v-app-bar>
        <v-main>
            <v-container fluid class="mt-5">
                <v-layout column justify-space-around>
                    <v-flex md10>
                        <router-view name="main"></router-view>
                        <router-view name="right"></router-view>
                    </v-flex>
                    <v-flex md8>
                        <router-view name="submain"></router-view>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-main>
        <v-footer padless color="#06988B">
            <v-col
                class="text-center"
                cols="12"
            >
                {{ new Date().getFullYear() }} — <strong>Vuetify Footer</strong>
            </v-col>
        </v-footer>
    </v-app>
</template>
<script>
import {mapGetters} from 'vuex';

export default {
    name  : 'App',
    props : {},
    data  : () => {
        return {
            drawer: false
        };
    },
    computed: {
        ...mapGetters({
            user     : 'auth/isAuthenticated',
            username : 'auth/StateUser'
        }),
        isLoggedIn: function () {
            return this.user;
        }
    },
    mounted: function () {

    },
    beforeDestroy() {

    },
    destroyed() {

    },
    methods: {
        async logout() {
            await this.$store.dispatch('auth/LogOut');
            // await this.$router.push('/app/vue-js/dev');
        }
    },
    created: function () {

    }
};
</script>

<style scoped>

</style>
