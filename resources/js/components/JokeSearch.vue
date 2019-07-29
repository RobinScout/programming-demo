<template>
    <div>
        <input type="text" class="form-control" placeholder="Search" v-model="searchTerm" @input="debounceSearch">
        <joke-analysis class="mt-1" :jokes="jokes" :loading="loading" :matchTerms="searchTerms"></joke-analysis>
        <joke-list :jokes="jokes" :loading="loading" :matchTerms="searchTerms" class="mt-1"></joke-list>
  </div>
    </div>
</template>

<script>
    import JokeList from './JokeList.vue';
    import JokeAnalysis from './JokeAnalysis.vue';

    import { debounce } from 'lodash';
    import axios from 'axios'
    const CancelToken = axios.CancelToken;
    let cancelSearch = null;

    export default {
        components: { JokeList, JokeAnalysis },
        data() {
            return {
                loading: false,
                searchTerm: '',
                jokes: []
            };
        },
        computed: {
            searchTerms() {
                return this.searchTerm.match(/\S+/g) || [];
            }
        },
        methods: {
            executeSearch() {
                if (cancelSearch) {
                    cancelSearch();
                    cancelSearch = null;
                }

                this.jokes = [];
                if (!this.searchTerm) {
                    return;
                }

                this.loading = true;

                this.$http.get('/joke/search', {
                    params: { values: this.searchTerms },
                    cancelToken: new CancelToken(function executor(c) {
                        cancelSearch = c;
                    })
                }).then(({ data }) => {
                    this.jokes = data;
                }).catch(thrown => {
                  if (!axios.isCancel(thrown)) {
                    // Handle error
                  }
                }).finally(() => {
                    this.loading = false;
                    cancelSearch = null;
                });
            },
            debounceSearch: debounce(function () { this.executeSearch(); }, 250)
        }
    }
</script>
