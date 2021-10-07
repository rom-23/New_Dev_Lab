<template>
    <v-container>
        <v-row justify="center">
            <v-col sm="4">
                <v-alert text dense color="teal" icon="mdi-clock-fast" border="left">
                    Users CRUD, use Symfony Custom API with VueJS DataTable
                </v-alert>
            </v-col>
        </v-row>
    <v-row justify="center">
        <v-col sm="8">
            <v-data-table
            :headers="headers"
            :items="all_users"
            sort-by="id"
            class="elevation-1"
        >
            <!--<div v-for="post in item.posts" :key="post.id">-->
            <!--    {{ post.title }}-->
            <!--</div>-->
            <template v-slot:top>
                <v-toolbar flat>
                    <v-spacer></v-spacer>
                    <v-dialog v-model="dialog" max-width="500px">
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn
                                color="primary"
                                light
                                small
                                class="mb-2"
                                v-bind="attrs"
                                v-on="on"
                                elevation="3"
                            >
                                Add User
                            </v-btn>
                        </template>
                        <v-card>
                            <v-card-title>
                                <span class="text-h6">{{ formTitle }}</span>
                            </v-card-title>
                            <v-card-text>
                                <v-container>
                                    <v-row>
                                        <v-col v-if="editedIndex !== -1" cols="12" sm="8" md="6">
                                            <v-text-field
                                                v-model="editedItem.id"
                                                label="id"
                                                disabled
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="8" md="6">
                                            <v-text-field
                                                v-model="editedItem.email"
                                                label="email"
                                                clearable
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="8" md="6">
                                            <v-text-field
                                                v-model="editedItem.roles"
                                                label="roles"
                                                clearable
                                            ></v-text-field>
                                        </v-col>
<!--                                        <v-col cols="12" sm="8" md="6">-->
<!--                                            <v-select class="style-chooser" v-model="editedItem.roles" :options="roles" :value="editedItem.roles"-->
<!--                                                      label="roles" placeholder="Select role">-->
<!--                                            </v-select>-->
<!--                                        </v-col>-->
                                        <v-col v-if="editedIndex === -1" cols="12" sm="12" md="12">
                                            <v-text-field
                                                v-model="editedItem.password"
                                                label="Password"
                                                clearable
                                            ></v-text-field>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
                                <v-btn color="blue darken-1" text @click="save">Save</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                    <v-dialog v-model="dialogDelete" max-width="500px">
                        <v-card>
                            <v-card-title class="text-body-1">Are you sure you want to delete this user?</v-card-title>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
                                <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
                                <v-spacer></v-spacer>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-toolbar>
            </template>
            <template v-slot:[`item.posts`]="{ item }">
                {{ item.posts.length }}
            </template>
            <template v-slot:[`item.actions`]="{ item }">
                <v-icon small class="mr-2" @click="editItem(item)">mdi-pencil</v-icon>
                <v-icon small @click="deleteItem(item)">mdi-delete</v-icon>
            </template>
            <template v-slot:no-data>
                <v-container>No data available...</v-container>
            </template>
    </v-data-table>
        </v-col>
    </v-row>
    </v-container>
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
import {mapGetters} from 'vuex';
export default {
    data: () => {
        return {
            selected : null,
            roles    : [
                'ROLE_USER',
                'ROLE_ADMIN'
            ],
            dialog       : false,
            dialogDelete : false,
            headers      : [
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
                    sortable : true
                },
                {
                    text     : 'Password',
                    value    : 'password',
                    align    : 'start',
                    sortable : false
                },
                {
                    text     : 'Posts',
                    value    : 'posts',
                    align    : 'start',
                    sortable : true
                },
                {
                    text     : 'Actions',
                    value    : 'actions',
                    align    : 'start',
                    sortable : false
                }
            ],
            editedIndex : -1,
            editedItem  : {
                id    : 0,
                email : '',
                roles : ''
            },
            defaultItem: {
                email    : '',
                roles    : '',
                password : ''
            }
        };
    },

    computed: {
        ...mapGetters({
            all_users: 'users/allUsers'
        }),
        formTitle() {
            return this.editedIndex === -1 ? 'New User' : 'Edit User';
        }
    },

    watch: {
        dialog(val) {
            val || this.close();
        },
        dialogDelete(val) {
            val || this.closeDelete();
        }
    },

    mounted() {
        this.$store.dispatch('users/getUsers');
    },

    created() {
    },

    methods: {
        editItem(item) {
            this.editedIndex = this.all_users.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },

        deleteItem(item) {
            this.editedIndex = this.all_users.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialogDelete = true;
        },

        deleteItemConfirm() {
            let payload = {
                id: this.editedItem.id
            };
            this.$store.dispatch('users/removeUser', payload);
            this.closeDelete();
        },

        close() {
            this.dialog = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },

        closeDelete() {
            this.dialogDelete = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },

        save() {
            if (this.editedIndex > -1) {
                let payload = {
                    id    : this.editedItem.id,
                    roles : [this.editedItem.roles],
                    email : this.editedItem.email
                };
                console.log(payload);
                this.$store.dispatch('users/updateUser', payload);
            } else {
                let payload = {
                    email    : this.editedItem.email,
                    roles    : [this.editedItem.roles],
                    password : this.editedItem.password
                };
                this.$store.dispatch('users/setUser', payload);
            }
            this.close();
        }
    }
};
</script>
