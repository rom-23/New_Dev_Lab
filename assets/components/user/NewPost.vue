<template>
    <v-form class="elevation-2 p-3">
        <v-row>
            <v-col cols="12" md="6">
                <v-text-field
                    v-model="email"
                    label="email"
                    required
                    clearable
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field
                    v-model="password"
                    label="Password"
                    required
                    clearable
                ></v-text-field>
            </v-col>
            <v-col md="7">
                <v-select class="style-chooser" v-model="selected" :options="roles" :value="selected" label="Roles" placeholder="Select role"></v-select>
            </v-col>
            <v-col md="4">
                <v-btn block color="success" class="mt-3" @click="addUser">Add</v-btn>
            </v-col>
        </v-row>
    </v-form>
</template>
<style>
.style-chooser .vs__selected {
    text-transform: lowercase;
    font-variant: traditional;
}
.style-chooser{
    margin-top: 1em;
}
.style-chooser .vs__search::placeholder {
    color: #394066;
    text-transform: lowercase;
    font-variant: traditional;
}
.style-chooser .vs__dropdown-menu {
    padding: 0;
    margin-top: 0.1em;
    background: #ffffff;
    border: none;
    color: #394066;
    text-transform: lowercase;
    font-variant: traditional;
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
            email    : '',
            password : '',
            roles    : [
                'ROLE_USER',
                'ROLE_ADMIN'
            ]
        };
    },
    computed: {},
    mounted() {
    },
    created() {

    },
    methods: {
        addUser() {
            let payload = {
                email    : this.email,
                roles    : [this.selected],
                password : this.password
            };
            this.$store.dispatch('users/setUser', payload);
        }
    }
};
</script>
