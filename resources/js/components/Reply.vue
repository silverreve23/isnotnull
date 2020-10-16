<template>
    <div :id="'reply-'+id" class="card">
      <div class="card-content">
        <div class="media">
          <div class="media-left">
            <figure class="image is-48x48">
              <img :src="'https://picsum.photos/48/48?r=' + (Math.random() * 10)" alt="Placeholder image">
            </figure>
          </div>
          <div class="media-content">
            <p class="title is-6">
                <a :href="'/profiles'+data.owner.name">
                    <sometag v-pre>@</sometag>{{ data.owner.name }}
                </a>
            </p>
            <p class="subtitle is-6">
                <small>{{ data.created_at }}</small>
            </p>
          </div>
          <div class="media-right">
              <favorite :reply="data" v-if="signedIn"></favorite>

              <button v-if="canUpdate" @click="destroy" type="submit" class="button is-text is-small" name="button">Delete</button>
              <button v-if="canUpdate" @click="editing = true" type="submit" class="button is-text is-small" name="button">Edit</button>
          </div>
        </div>
        <div class="content">
            <div v-if="editing">
                <textarea v-model="body" class="textarea" name="name" rows="3"></textarea>
            </div>
            <p v-else v-text="body"></p>
            <div v-if="editing" class="mt-1">
                <div class="buttons">
                    <button @click="editing = false" type="button" class="button is-small" name="button">Cancel</button>
                    <button @click="update" type="button" class="button is-small" name="button">Update</button>
                </div>
            </div>
        </div>
      </div>
    </div>
</template>
<script>
    import Favorite from './Favorite';

    export default {
        props: ['data'],
        components: {Favorite},
        data(){
            return {
                editing: false,
                id: this.data.id,
                body: this.data.body
            };
        },
        computed: {
            signedIn(){
                return window.App.signedIn;
            },
            canUpdate(){
                return this.authorize(user => user.id == this.data.user_id);
            },
        },
        methods: {
            update(){
                axios.patch('/replies/' + this.data.id, {
                    body: this.body
                }).then(responce => {
                    this.$emit('updated', this.data.id);
                    this.editing = false;
                });
            },
            destroy(){
                axios.delete('/replies/' + this.data.id).then(
                    responce => {
                        this.$emit('deleted', this.data.id);
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
