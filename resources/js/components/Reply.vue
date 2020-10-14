<template>
    <div class="notification" v-if="show">
        <button @click="hide" class="delete"></button>
        {{ body }}
    </div>
</template>

<script>
    import Favorite from './Favorite';

    export default {
        props: ['attributes'],
        components: {Favorite},
        data(){
            return {
                editing: false,
                body: this.attributes.body,
            };
        },
        methods: {
            update(){
                axios.patch('/replies/' + this.attributes.id, {
                    body: this.body
                }).then(responce => window.flash('Your reply has beed updated!'));

                this.editing = false;
            },
            destroy(){
                axios.delete('/replies/' + this.attributes.id).then(
                    responce => {
                        $(this.$el).fadeOut(300, () => {
                            window.flash('Your reply has beed deleted!');
                        });
                    }
                );
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
