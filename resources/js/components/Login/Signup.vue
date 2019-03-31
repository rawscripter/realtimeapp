<template>
    <v-container>
        <v-layout row class="text-xs-center">
            <v-flex xs4 offset-xs4 class="grey lighten-4">
                <v-container style="position: relative;top: 13%; margin-bottom: 50px" class="text-xs-center">
                    <v-card flat>
                        <v-card-title primary-title>
                            <h4>Signup</h4>
                        </v-card-title>
                        <v-form @submit.prevent="signup">
                            <v-text-field
                                    type="email"
                                    v-model="form.name"
                                    prepend-icon="person"
                                    name="name"
                                    label="Name"
                                    required>
                            </v-text-field>
                            <span class="red--text" v-if="errors.name">{{errors.name[0]}}</span>
                            <v-text-field
                                    type="email"
                                    v-model="form.email"
                                    prepend-icon="person"
                                    name="email"
                                    label="Email"
                                    required>
                            </v-text-field>
                            <span class="red--text" v-if="errors.email">{{errors.email[0]}}</span>
                            <v-text-field
                                    v-model="form.password"
                                    prepend-icon="lock"
                                    name="Password"
                                    label="Password"
                                    type="password"
                                    required>
                            </v-text-field>
                            <span class="red--text" v-if="errors.password">{{errors.password[0]}}</span>
                            <v-text-field
                                    v-model="form.confirm_password"
                                    prepend-icon="lock"
                                    name="Password"
                                    label="Confirm Password"
                                    type="password"
                                    required>
                            </v-text-field>
                            <span class="red--text" v-if="errors.confirm_password">{{errors.confirm_password[0]}}</span>
                            <v-card-actions>
                                <v-btn type="submit" primary large block color="info">Signup</v-btn>
                            </v-card-actions>
                            <v-card-actions>
                                <p>Already have an account?
                                    <router-link to="/login">Login</router-link>
                                </p>
                            </v-card-actions>
                        </v-form>
                    </v-card>
                </v-container>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    export default {
        name: "Login",
        data() {
            return {
                form: {
                    name: null,
                    email: null,
                    password: null,
                    confirm_password: null
                },
                errors: {}
            }
        },
        created(){
            if (User.loggedIn()){
                this.$router.push({name:'forum'})
            }
        },
        methods: {
            signup() {
                axios.post('api/auth/signup', this.form)
                    .then(res => {
                        User.responseAfterLogin(res)
                        // this.$router.push({name: 'forum'})
                    })
                    .catch(error => this.errors = error.response.data.errors);
            }
        }
    }
</script>

<style>
    .margin-top-20 {
        margin-top: 120px;
    }
</style>