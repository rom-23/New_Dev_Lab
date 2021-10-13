<template>
    <v-dialog v-model="dialog" persistent max-width="600px" min-width="360px">
        <div>
            <v-card class="px-4">
                <v-card-text>
                    <v-form ref="loginForm" v-model="valid" lazy-validation>
                        <v-row>
                            <v-col cols="12">
                                <v-text-field v-model="username" label="e-mail" required></v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-text-field v-model="password" label="Password" counter></v-text-field>
                            </v-col>
                            <v-spacer></v-spacer>
                            <v-col class="d-flex" cols="12" sm="3" xsm="12" align-end>
                                <v-btn x-large block color="success" @click="validate">Login</v-btn>
                            </v-col>
                        </v-row>
                    </v-form>
                </v-card-text>
            </v-card>
        </div>
    </v-dialog>
</template>
<script>
import axios from 'axios';
export default {
    name : 'Login',
    data : () => {
        return {
            dialog   : true,
            valid    : true,
            username : '',
            password : '',
            verify   : ''
        };
    },
    computed : {},
    methods  : {
        validate() {
            axios
                .post('/apiplatform/login', {
                    username : this.username,
                    password : this.password
                })
                .then(response => {
                    console.log(response.data);
                    //this.$emit('user-authenticated', userUri);
                    //this.email = '';
                    //this.password = '';
                }).catch(error => {
                    console.log(error.response.data);
                });
        }
    }
};
</script>
