<template>
    <div>
        <v-btn icon @click="likeBtn">
            <v-icon :color="color"> favorite</v-icon>
            {{count}}
        </v-btn>
    </div>
</template>

<script>
    export default {
        props: ['like'],
        name: "Like",
        data() {
            return {
                liked: this.like.isLiked,
                count: this.like.like_count,
            }
        },
        computed: {
            color() {
                return this.liked ? 'red' : 'black';
            }
        },
        methods: {
            likeBtn() {
                if (User.loggedIn()) {

                    if (this.liked) {
                        this.decr()
                    } else {
                        this.incr();
                    }
                    this.liked = !this.liked;
                }
            },
            incr() {
                axios.post(`/api/${this.like.id}/like`)
                    .then(res => this.count++)
                    .catch(error => console.log(error.response.data));
            },
            decr() {

                axios.delete(`/api/${this.like.id}/like`)
                    .then(res => this.count--)
                    .catch(error => console.log(error.response.data));
            },


        },
        created() {
            window.Echo.channel('likeChannel')
                .listen('LikeEvent', (e) => {
                    if (this.like.id == e.id){
                       e.type == 1 ? this.count++ : this.count--;
                    }
                })
        }
    }
</script>

<style scoped>

</style>