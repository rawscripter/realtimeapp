<template>
    <v-container>
        <v-layout row class="text-xs-center">
            <v-flex md6 offset-md3 class="grey lighten-4">
                <v-container style="position: relative;top: 13%; margin-bottom: 50px" class="text-xs-center">
                    <v-card-title primary-title>
                        <h2>Ask Question</h2>
                    </v-card-title>
                    <v-form @submit.prevent="askquestion">
                        <v-text-field
                                v-model="form.title"
                                type="text"
                                name="title"
                                label="Question Title"
                                required>
                        </v-text-field>
                        <v-autocomplete
                                :items="categories"
                                label="Select a category"
                                v-model="form.category_id"
                                item-text="name"
                                item-value="id"
                        ></v-autocomplete>
                        <markdown-editor v-model="form.body" ref="markdownEditor"></markdown-editor>
                        <v-card-actions>
                            <v-btn type="submit" primary large block color="info">Ask Question</v-btn>
                        </v-card-actions>
                    </v-form>
                </v-container>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    export default {
        name: "Create",
        data() {
            return {
                categories: [],
                form: {
                    title: null,
                    body: null,
                    category_id: null,
                },
                errors: null,
            }
        },
        created() {
            axios.get('/api/category')
                .then(res=> {
                    this.categories = res.data.data
                })
                .catch(error => console.log(error.response))
        },
        methods:{
            askquestion(){
               axios.post('/api/question',this.form)
                   .then(res => {
                       if (res.status == 201){
                           this.$router.push(res.data.path)
                       }
                   })
                   .catch(error => this.errors = error.response.data.error)
            }
        }
    }
</script>

<style>

</style>