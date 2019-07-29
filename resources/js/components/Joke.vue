<template>
    <div class="card">
        <div class="card-header">Chuck Norris Joke</div>

        <div class="card-body">
            <div v-if="loading" class="d-flex justify-content-center">
                <div class="spinner-border" role="status">
                  <span class="sr-only">Loading...</span>
                </div>
            </div>
            <span v-else>{{ joke.value }}</span>
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

                this.$http.get('https://api.chucknorris.io/jokes/random').then(({data}) => {
                    console.log(data);
                    this.joke = data;
                }).finally(() => {
                    this.loading = false;
                });
            }
        }
    }
</script>
