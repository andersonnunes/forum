<template>
    <div>
        <div v-if="signedIn">
            <div class="form-group">
                <textarea name="body" id="body" class="form-control"
                    placeholder="Have something to say?" rows="5" required v-model="body"></textarea>
            </div>

            <button type="submit" class="btn btn-secondary" @click="addReply">Post</button>
        </div>

        <p class="text-center" v-else>
            Please <a href="/login">sign in</a> to participate in this
            discussion.
        </p>
    </div>
</template>

<script>
    import 'jquery.caret';
    import 'at.js';

    export default {
        data() {
            return {
                body: ''
            }
        },

        computed: {
            signedIn() {
                return window.App.signedIn;
            }
        },

        mounted() {
            $('#body').atwho({
                at: "@",
                delay: 750,
                callbacks: {
                    remoteFilter: function (query, callback) {
                        $.getJSON("/api/users", { name: query }, function (usernames) {
                           callback(usernames);
                        });
                    }
                }
            });
        },

        methods: {
            async addReply() {
                try {
                    const { data } = await axios.post(location.pathname + '/replies', { body: this.body });

                    this.body = '';

                    flash('Your reply has been posted.');

                    this.$emit('created', data);
                } catch (error) {
                    flash(error.response.data, 'danger');
                }
            }
        }
    }
</script>
