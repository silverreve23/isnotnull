<template>
    <article class="media" v-if="signedIn">
        <figure class="media-left">
            <p class="image is-64x64">
                <img src="https://picsum.photos/48/48">
            </p>
        </figure>
        <div class="media-content">
            <div class="field">
                <p class="control">
                    <textarea
                        name="body"
                        class="textarea"
                        placeholder="Add a text..."
                        required
                        v-model="body">
                    </textarea>
                </p>
            </div>
            <nav class="level">
                <div class="level-left">
                    <div class="level-item">
                        <button @click="addReply" type="button" class="button is-info">Submit</button>
                    </div>
                </div>
                <div class="level-right">
                    <div class="level-item">
                        <label class="checkbox">
                            <input type="checkbox"> Press enter to submit
                        </label>
                    </div>
                </div>
            </nav>
        </div>
    </article>
    <section class="section" v-else>
        <div class="container">
            <p>Please <a href="/login">login</a> to create new replay!</p>
        </div>
    </section>
</template>
<script>
    export default {
        data(){
            return {
                body: null
            };
        },
        computed: {
            signedIn(){
                return window.App.signedIn;
            },
            endpoint(){
                return location.pathname + '/replies';
            }
        },
        methods: {
            addReply(){
                axios.post(this.endpoint, {
                    body: this.body
                }).then(({data}) => {
                    this.$emit('created', data);
                    this.body = null;
                });
            }
        }
    }
</script>
