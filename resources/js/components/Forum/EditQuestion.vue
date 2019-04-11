<template>
    <v-container fluid>
        <v-layout row class="text-xs-center">
            <v-flex class="grey lighten-4">
                <v-container style="position: relative;top: 13%; margin-bottom: 50px" class="text-xs-center">
                    <v-card style="padding: 20px">
                        <v-card-title primary-title>
                            <h2>Ask Question</h2>
                        </v-card-title>
                        <v-form @submit.prevent="updateQuestion">
                            <v-text-field
                                    v-model="form.title"
                                    type="text"
                                    name="title"
                                    label="Question Title"
                                    required>
                            </v-text-field>
                            <markdown-editor v-model="form.body" ref="markdownEditor"></markdown-editor>
                            <v-card-actions>
                                <v-btn type="submit" small color="teal">
                                    Save
                                </v-btn>
                                <v-btn @click="cancel" small>
                                    Cancel
                                </v-btn>

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
        props: ['question'],
        data() {
            return {
                form: {
                    title: null,
                    body: null,
                },
                errors: null,
            }
        },
        mounted() {
            this.form = this.question
        },
        methods: {
            updateQuestion() {
                axios.patch(`/api/question/${this.form.slug}`, this.form)
                    .then(res => {
                        if (res.status == 202) {
                            this.cancel()
                        }
                    })
                    .catch(error => this.errors = error.response.data.error)
            },
            cancel() {
                EventBus.$emit('cancelEditing')
            }
        }
    }
</script>

<style>

</style>