<template>
    <v-container>
        <v-container>
            <v-banner elevation="5" two-line max-width="850px">
                <v-avatar slot="icon" color="deep-purple accent-4" size="40">
                    <v-icon icon="mdi-lock" color="white">mdi-lock</v-icon>
                </v-avatar>
                Three line text string example with two actions. One to two lines is preferable. Three lines should be considered the maximum string length on desktop in order to keep messages short and actionable.
                <template v-slot:actions>
                    <a :href="test">Test Routing</a>
                </template>
            </v-banner>
        </v-container>
        <v-layout>
<!--            <HomeCard></HomeCard>-->
        </v-layout>
    </v-container>
</template>
<script>
// import HomeCard from './HomeCard';

export default {
    name       : 'example',
    components : {},
    data       : () => {
        return {
            test: window.symfonyRoutes.edit_data
        };
    }
};
</script>
<style scoped>
</style>
