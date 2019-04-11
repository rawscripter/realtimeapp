<template>
    <v-container>
        <v-layout row class="text-xs-center">
            <v-flex xs8 offset-xs2 class="grey lighten-4">
                <v-card style="padding: 10px; margin-bottom: 20px;">
                    <v-card-title primary-title>
                        <h2>Create New Category</h2>
                    </v-card-title>
                    <v-form @submit.prevent="createCategory">
                        <v-text-field
                                v-model="form.name"
                                type="text"
                                name="title"
                                label="Question Title"
                                required>
                        </v-text-field>
                        <v-card-actions>
                            <v-btn v-if="editSlug" type="submit" primary large block color="pink">Update</v-btn>
                            <v-btn v-else type="submit" primary large block color="info">Save</v-btn>
                        </v-card-actions>
                    </v-form>
                </v-card>
                <v-card>
                    <v-toolbar color="cyan" dark dense>
                        <v-toolbar-title>Categories</v-toolbar-title>
                    </v-toolbar>
                    <v-list>
                        <div v-for="(cat, index) in categories" :key="cat.id">
                            <v-list-tile>
                                <v-list-tile-action icon small @click="editCategory(index)">
                                    <v-icon style="cursor: pointer" color="green darken-2">edit</v-icon>
                                </v-list-tile-action>
                                <v-list-tile-content>
                                    <v-list-tile-title>{{cat.name}}</v-list-tile-title>
                                </v-list-tile-content>
                                <v-list-tile-action icon small @click="deleteCategory(cat,index)">
                                    <v-icon style="cursor: pointer" color="red">delete</v-icon>
                                </v-list-tile-action>
                            </v-list-tile>
                            <v-divider></v-divider>
                        </div>
                    </v-list>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    export default {
        data() {
            return {
                categories: {},
                form: {
                    name: null,
                },
                editSlug: null,
                errors: null,
            }
        },
        created() {

            if (!User.admin()){
                this.$router.push('/forum');
            }
            axios.get('/api/category')
                .then(res => this.categories = res.data.data)
                .catch(error => console.log(error.response.data))
        },
        methods: {
            createCategory() {
                if (this.editSlug == null) {
                    this.create();
                } else {
                    this.update();
                }
            },
            create() {
                axios.post('/api/category', this.form)
                    .then(res => {
                        if (res.status == 201) {
                            this.form.name = null;
                            this.categories.unshift(res.data);
                        }
                    })
                    .catch(error => this.errors = error.response.data.error);
            },
            update() {
                axios.patch(`/api/category/${this.editSlug}`, this.form)
                    .then(res => {
                        if (res.status == 202) {
                            this.form.name = null;
                            this.categories.unshift(res.data);
                        }
                    })
                    .catch(error => this.errors = error.response.data.error);
            },

            editCategory(index) {
                this.form.name = this.categories[index].name;
                this.editSlug = this.categories[index].slug;
                this.categories.splice(index, 1);
            },

            deleteCategory(cat, index) {
                axios.delete(`/api/category/${cat.slug}`)
                    .then(res => this.categories.splice(index, 1))
                    .catch(error => console.log(error.response.data))
            }
        },

    }
</script>

<style>

</style>