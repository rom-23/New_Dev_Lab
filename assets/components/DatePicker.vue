<template>
    <v-row>
        <v-col cols="6" class="p-5">
            <v-date-picker v-model="picker"></v-date-picker>
        </v-col>
        <v-col cols="6" class="pt-5">
            <v-btn
                elevation="2"
            >
                <router-link :to="{ name: 'home'}">Info</router-link>
            </v-btn>
            <router-view name="right"></router-view>
        </v-col>
    </v-row>
</template>
<script>
export default {
    name: 'datePicker',
    data() {
        return {
            picker: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)
        };
    }
};
</script>
