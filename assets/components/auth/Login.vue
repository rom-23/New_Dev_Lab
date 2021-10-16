<template>
    <v-container>
        <v-row justify="center">
            <v-col md="4">
                <v-card
                    class="mx-auto"
                    max-width="644"
                    outlined
                >
                    <v-list-item>
                        <v-list-item-content>
                            <v-list-item-title class="mb-1 text-success">
                                Connect to API
                            </v-list-item-title>
                            <v-form>
                                <v-container v-if="error" class="alert alert-danger">
                                    {{ error }}
                                </v-container>
                                <v-row justify="center">
                                    <v-col md="4">
                                        <v-text-field
                                            v-model="username"
                                            label="email"
                                            required
                                            clearable
                                        ></v-text-field>
                                    </v-col>
                                    <v-col md="4">
                                        <v-text-field
                                            v-model="password"
                                            label="password"
                                            required
                                            clearable
                                        ></v-text-field>
                                    </v-col>
                                </v-row>
                                <v-spacer></v-spacer>
                                <button @click="handleSubmit" type="submit" class="btn btn-outline-info btn-sm mt-3">Log in</button>
                            </v-form>
                        </v-list-item-content>
                    </v-list-item>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>
<script>
import {mapActions} from 'vuex';

export default {
    name : 'Login',
    data : () => {
        return {
            username : '',
            password : '',
            error    : ''
        };
    },
    computed : {},
    methods  : {
        ...mapActions({
            LogIn: 'auth/LogIn'
        }),
        handleSubmit() {
            this.error = '';
            let payload = {
                username : this.username,
                password : this.password
            };
            try {
                this.LogIn(payload);
                // console.log(this.$route.query.nextUrl);
                // if (this.$route.params.nextUrl != null) {
                //     this.$router.push(this.$route.params.nextUrl);
                // }
                // this.$router.replace(this.$route.query.redirect);
                // await this.$router.replace(this.$route.query.from);
                this.$router.replace('/app/vue-js/users');
            } catch (error) {
                this.error = error.message;
            }
        }
    }
};
</script>
