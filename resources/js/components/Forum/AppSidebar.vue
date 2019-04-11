<template>
    <v-card>
        <v-toolbar color="cyan" dark dense>
            <v-toolbar-title>Categories</v-toolbar-title>
        </v-toolbar>

        <v-list>
            <v-list-tile v-for="cat in categories" :key="cat.id">
                <v-list-tile-content>
                    <v-list-tile-title>{{cat.name}}</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
        </v-list>
    </v-card>
</template>

<script>
    export default {
        name: "AppSidebar",
        data() {
            return {
                categories: {},
            }
        },
        created() {
            axios.get('/api/category')
                .then(res => this.categories = res.data.data)
                .catch(error => console.log(error.response.data))
        }

    }
</script>

<style scoped>

</style>