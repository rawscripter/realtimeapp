<template>
    <v-container>
        <v-layout row class="text-xs-center">
            <v-flex xs4 offset-xs4 class="grey lighten-4">
                <v-container style="position: relative;top: 13%; margin-bottom: 50px" class="text-xs-center">
                    <v-card flat>
                        <v-card-title primary-title>
                            <h4>Login</h4>
                        </v-card-title>
                        <v-form @submit.prevent="login">
                            <v-text-field
                                    type="email"
                                    v-model="form.email"
                                    prepend-icon="person"
                                    name="email"
                                    label="Email"
                                    required>
                            </v-text-field>
                            <v-text-field
                                    v-model="form.password"
                                    prepend-icon="lock"
                                    name="Password"
                                    label="Password"
                                    type="password"
                                    required>
                            </v-text-field>
                            <v-card-actions>
                                <v-btn type="submit" primary large block color="success">Login</v-btn>
                            </v-card-actions>
                            <v-card-actions>
                                <p>Don't have account?
                                    <router-link to="/signup">Signup</router-link>
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
                    email: null,
                    password: null
                }
            }
        },
        created(){
          if (User.loggedIn()){
              this.$router.push({name:'forum'})
          }
        },
        methods: {
            login() {
                User.login(this.form);
                // this.$router.push({name: 'forum'})
            }
        }
    }
</script>

<style>
    .margin-top-20 {
        margin-top: 120px;
    }
</style>