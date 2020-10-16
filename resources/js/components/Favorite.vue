<template>
    <button @click="toggle" class="button" :class="classes">
        <span class="icon"><i class="fas fa-heart"></i></span>
        <span v-text="count"></span>
    </button>
</template>

<script>
    export default {
        props: ['reply'],
        data(){
            return {
                active: this.reply.isFavorited,
                count: this.reply.favoritesCount,
            };
        },
        computed: {
            classes(){
                return [this.active ? 'is-primary' : null];
            },
            endpoint(){
                return `/replies/${this.reply.id}/favorites`;
            }
        },
        methods: {
            toggle(){
                !this.active ? this.favorite() : this.unfavorite();
            },
            favorite(){
                axios.post(this.endpoint);

                window.flash('Your reply has beed liked!');

                this.active = true; this.count++;
            },
            unfavorite(){
                axios.delete(this.endpoint);

                window.flash('Your reply has beed liked!');

                this.active = false; this.count--;
            }
        }
    }
</script>

<style>
    .notification {
        position: fixed;
        bottom: 5px;
        right: 5px;
        width: 310px;
    }
</style>
