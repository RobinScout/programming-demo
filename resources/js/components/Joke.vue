<template>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <span>Chuck Norris Joke</span>
            <button class="btn btn-primary" type="button" :disabled="loading" @click="loadJoke">
                <span v-if="loading">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="sr-only">Loading...</span>
                </span>
                <span v-else>
                    Refresh
                </span>
            </button>
        </div>

        <div class="card-body">
            <div v-if="loading" class="d-flex justify-content-center">
                <div class="spinner-border" role="status">
                  <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div v-else>
                <span v-if="joke">{{ joke.value }}</span>
                <span v-else class="text-danger">Unable to load joke.</span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                loading: true,
                joke: null
            };
        },
        created() {
            this.loadJoke();
        },
        methods: {
            loadJoke() {
                this.loading = true;
                this.joke = null;

                this.$http.get('/joke/random').then(({data}) => {
                    this.joke = data;
                }).finally(() => {
                    this.loading = false;
                });
            }
        }
    }
</script>
